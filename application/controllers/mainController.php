<!doctype html>
<?php
session_start();

class MainController extends CI_Controller{
	/**
	* Funcion constructor de la clase Controlador de nuestro proyecto
	*/ 
	function __construct(){
		parent::__construct();
		$this->load->model('mainModel');
		$this->load->helper('form');
		$this->load->helper('email');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="mens_error">', '</div>');
		$this->load->library('email');
	}
	
	/**
	* Funcion que carga la pantalla principal de bienvenida
	*/
	function index(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('cuerpo');
		$this->load->view('pie_pag');		
	}
	
	/**
	* Funcion que carga la pantalla con el formulario de registro de usuarios
	*/
	function accesoAlta(){
		$this->load->view('cabecera');
		$this->load->view('menu_admin');
		$this->load->view('AddUser');
		$this->load->view('pie_pag');	
	}
	
	/**
	*	Metodo que procesa el registro de usuarios en base a un formulario
	*/
	function AltaUsuario(){
		$this->load->database();

		$this->form_validation->set_rules('nickname','Usuario','required|is_unique[usuario.nickname]');
		$this->form_validation->set_rules('Nombre','Nombre','required');
		$this->form_validation->set_rules('Apellidos','Apellidos','required');
		$this->form_validation->set_rules('email','Email','valid_email|is_unique[usuario.email]');
		$this->form_validation->set_rules('dni','DNI','is_unique[usuario.dni]|min_length[9]|max_lenght[9]');
		$this->form_validation->set_rules('Dom','Domicilio','required');
		$this->form_validation->set_rules('fnac','Fecha de nacimiento','required');
		$this->form_validation->set_rules('TelContacto','Teléfono','required');
		$this->form_validation->set_rules('email_t','Email del tutor','valid_email|is_unique[tutor.email]');
		$this->form_validation->set_rules('dniT','DNI del tutor','min_length[9]|max_lenght[9]');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('is_unique','El valor para %s ya existe');
		$this->form_validation->set_message('valid_email','Direccion de email ya en uso');
		$this->form_validation->set_message('min_length','%s muy corto');
		$this->form_validation->set_message('max_length','%s muy largo');
		
		if($this->form_validation->run() == FALSE){
			$this->accesoAlta();
		}
		else{
			if($this->input->post('submit'))
			{
				$data=array(
					'nickname'=>$this->input->post('nickname'),
					'nombre'=>$this->input->post('Nombre'),
					'apellidos'=>$this->input->post('Apellidos'),
					'rol'=>$this->input->post('ROL'),
					'domicilio'=>$this->input->post('Dom'),
					'f_nac'=>$this->input->post('fnac'),
					'dni'=>$this->input->post('dni'),
					'email'=>$this->input->post('email'),
					'nombreT'=>$this->input->post('NombreTutor'),
					'apellidosT'=>$this->input->post('ApellidosTutor'),
					'telefono'=>$this->input->post('TelContacto'),
					'dni_t'=>$this->input->post('dniT'),
					'email_t'=>$this->input->post('email_t')
				);
				
				$pass=substr(md5(microtime()),1,8);
				
				$cuerpo_mail="Bienvenido, nos complace mucho darte la bienvenida a nuestra guarderia<br>
							  Tu usuario para acceder al sistema es: ".$data['nickname']."<br>
							  Tu contraseña es: ".$pass."<br>
							  Recuerda que en tu perfil podrás cambiar la contraseña por la que tu prefieras";
				
				if($data['rol'] == 'PROF' || $data['rol'] == 'ADMIN')
				{
					$destino = $data['email'];
				}
				
				else{
					$destino = $data['email_t'];
				}
				$this->enviarMail("Bienvenido a la guarderia Bahia Blanca",$cuerpo_mail,$destino);
				
				$password = $this->crypt_blowfish($pass);
				
				$this->mainModel->altaUser($data,$password);
				header('Location: http://localhost/Guarderia');
			}
		}
	}
	
	/**
	* Metodo que cierra la sesión activa
	*/
	function cerrarSesion(){
		session_destroy();
		header('location: http://localhost/Guarderia');
	}
	
	/**
	* Funcion que carga la pantalla con informacion sobre la ubicacion de la guarderia
	*/
	function localizanos(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('localizanos');
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que nos muestra el formulario de acceso para usuarios registrados
	*/
	function Acceso(){
		$this->load->view('cabecera');
		$this->load->view('menu');
		$this->load->view('acceso');
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que procesa el formulario de acceso e inicia la sesion
	*/
	function Acceder(){		
		$this->load->database();

		$this->form_validation->set_rules('user','Usuario','required');
		$this->form_validation->set_rules('pass','Contraseña','required');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->Acceso();
		}
		else{
			if($this->input->post('submit')){
				$datos=array(
					'nickname'=>$this->input->post('user'),
					'password'=>$this->input->post('pass')
				);

				$consulta=$this->mainModel->iniciaSesion($datos);
				if( crypt($this->input->post('pass'),$consulta['password']) == $consulta['password'] )
				{
					$rol = $this->mainModel->getRol($this->input->post('user'));
					if($rol == 'ALUM'){$_SESSION['rol'] = 0;}
					else if($rol == 'PROF'){$_SESSION['rol'] = 1;}
					else{$_SESSION['rol'] = 2;}
					$_SESSION['user'] = $datos['nickname'];
					$this->index();
				}
				else{
					show_error('Datos de acceso no son correctos');
				}
			}
		}
	}
	
	/**
	* Funcion que nos muestra el formulario que nos permite añadir contenidos a la web
	*/
	function addContenido(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('addContenido');
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que procesa el formulario de adicion de contenidos
	*/
	function agregaCont(){
		$this->load->database();
		$this->load->library('Upload');
		$this->load->helper('url');	
		$this->form_validation->set_rules('titulo','Titulo','required');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->addContenido();
		}
		else{
			if($this->input->post('submit')){
				$datos=array(
				'titular'=>$this->input->post('titulo'),
				'cuerpo'=>nl2br($this->input->post('cuerpo')),
				'tipo'=>$this->input->post('tipo'),
				'privilegios'=>$this->input->post('priv'),
				'fecha'=>date('Y-m-d')
				);
			
				if($datos['tipo']=='NOV'){
					$path = 'imagenes/Novedades/';
				}
				else if($datos['tipo']=='CUR'){
					$path = 'imagenes/Cursos/';
				}
				else{
					$path = 'imagenes/Menus/';
				}
				
					$this->upload->initialize(array(
						'upload_path'   => $path,
						'allowed_types' => 'gif|jpg|png|GIF|JPG|PNG|jpeg|JPEG',
						'max_size' => '10000',
						'is_image' => TRUE
					));
					
					if($this->upload->do_multi_upload('userfile')){
						
						$info = $this->upload->get_multi_upload_data();
						
						$id = $this->mainModel->addContenido($datos);
						print_r($this->upload->get_multi_upload_data());
						
						foreach($info as $vec)
						{
							$ruta = $vec['full_path'];
							
							$this->mainModel->addImagen($id,$ruta);
						}
						
						header('Location: http://localhost/Guarderia');
					}
					else{
						
					}
			}
			
		}
	}
	
	/**
	* Funcion que nos muestra todo el contenido de la web para permitir el borrado de contenidos
	*/
	function delContenido(){
		$this->load->database();
		$data['res1']=$this->mainModel->getContenido('NOV');
		$data['res2']=$this->mainModel->getContenido('CUR');
		$data['res3']=$this->mainModel->getContenido('COM');
		$this->load->view('cabecera');
		$this->load->view('menu_admin');
		$this->load->view('delContenido',$data);
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que ccarga todo el contenido para que el usuario acceda a una noticia anterior
	*/
	function todoContenido(){
		$this->load->database();
		if(!isset($_SESSION['rol'])){
			$data['res1']=$this->mainModel->getContenidoPub('NOV');
			$data['res2']=$this->mainModel->getContenidoPub('CUR');
		}
		else{
			$data['res1']=$this->mainModel->getContenido('NOV');
			$data['res2']=$this->mainModel->getContenido('CUR');
		}

		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('todoContenido',$data);
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que nos carga una noticia con campo id = $id
	*/
	function verContenidoSimple($id){
		$this->load->database();
		$data['res'] = $this->mainModel->getContenidoSimple($id);
		$data['id'] = $id;
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('verContenido',$data);
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que borra el contenido con campo id = $id
	*/
	function borrarContenido($id){
		$this->load->database();
		$this->mainModel->delContenido($id);
		$this->delContenido();
	}
	
	/**
	* Funcion que obtiene de la base de datos las noticias mas recientes para mostrarlas a los usuarios
	*/
	function verContenido(){
		$this->load->database();
		
		if(!isset($_SESSION['rol'])){
			$data['res']=$this->mainModel->verContenidoPub();
		}
		else{
			$data['res']=$this->mainModel->verContenido();
		}
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('verContenido',$data);
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que carga todos los menus mensuales para que el usuario los consulte
	*/
	function todoMenus(){
		$this->load->database();

		$data['res1']=$this->mainModel->getContenido('COM');

		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('todoMenus',$data);
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que obtiene de la base de datos el menu mensual con id = $id
	*/
	function verMenus($id){
		$this->load->database();
		$data['res']=$this->mainModel->verMenusMensId($id);
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('menus_mensuales',$data);
		$this->load->view('pie_pag');
	}

	/**
	* Funcion que carga de la base de datos el menu mensual mas reciente
	*/
	function menus_mens(){
		$this->load->database();
		$data['res']=$this->mainModel->verMenusMens();
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('menus_mensuales',$data);
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que muestra todos los usuarios del sistema para darlos de baja
	*/
	function accesoBaja(){
		$this->load->database();
		$data['res1']=$this->mainModel->getUsuarios('ADMIN');
		$data['res2']=$this->mainModel->getUsuarios('ALUM');
		$data['res3']=$this->mainModel->getUsuarios('PROF');
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('bajaUsuarios',$data);
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que efectua la baja de un usuario
	*/
	function borrarUsuario($id){
		$this->load->database();
		$this->mainModel->bajaUsuario($id);
		
		$data['res1']=$this->mainModel->getUsuarios('ADMIN');
		$data['res2']=$this->mainModel->getUsuarios('ALUM');
		$data['res3']=$this->mainModel->getUsuarios('PROF');
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('bajaUsuarios',$data);
		$this->load->view('pie_pag');
	}
	
	/**
	* Funcion que cargara el apartado correspondiente al perfil del usuario
	*/
	function miCuenta(){
		$this->load->database();
		
		$data['res1'] = $this->mainModel->datosUsuario($_SESSION['user']);
		
		if($data['res1']['rol'] == 'ALUM'){
			$data['res2'] = $this->mainModel->datosTutor($_SESSION['user']);
		}
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('miCuenta',$data);
		$this->load->view('pie_pag');	
	}
	
	/**
	* Funcion que mostrara el formulario de modificacion del domicilio de un usuario del sistema
	*/
	function nuevoDom(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('nuevoDom');
		$this->load->view('pie_pag');	
	}
	
	/**
	* Funcion que efectua el cambio de domicilio
	*/
	function cambioDom(){
		$this->load->database();
		
		$this->form_validation->set_rules('Dom','domicilio','required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->nuevoDom();
		}
		else{
			if($this->input->post('submit')){
				$data = array(
					'nickname'=>$_SESSION['user'],
					'domicilio'=>$this->input->post('Dom')
				);
				$this->mainModel->cambioDom($data);
				$this->miCuenta();
			}
		}
	}
	
	/**
	* Funcion que mostrara el formulario de modificacion de la direccion de email de un usuario del sistema
	*/
	function nuevoEmail(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('nuevoEmail');
		$this->load->view('pie_pag');	
	}
	
	/**
	* Funcion que efectua el cambio de direccion de email
	*/
	function cambioEmail(){
		$this->load->database();
		
		$this->form_validation->set_rules('email','email','valid_email|required|is_unique[usuario.email]|is_unique[tutor.email]');
		$this->form_validation->set_message('required','El campo %s es obligatorio.');
		$this->form_validation->set_message('is_unique','El %s introducido ya existe en el sistema.');
		
		if($this->form_validation->run() == FALSE){
			$this->nuevoEmail();
		}
		else{
			if($this->input->post('submit')){
				$data = array(
					'nickname'=>$_SESSION['user'],
					'email'=>$this->input->post('email')
				);
				$this->mainModel->cambioEmail($data);
				
				$asunto = "Cambio email Guarderia Bahia Blanca";
				$cuerpo = "Su solicitud de cambio de direccion de correo electrónico ha sido realizada satisfactoriamente.<br><br>
				Este mensaje se ha generado automáticamente, no lo responda.<br>";
				
				$this->enviarMail($asunto,$cuerpo,$data['email']);
				
				$this->miCuenta();
			}
		}
	}
	
	/**
	* Funcion que mostrará el formulario para cambiar la contraseña de un usuario
	*/
	function nuevaPass(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('nuevaPass');
		$this->load->view('pie_pag');	
	}
	
	/**
	* Funcion que efectua el cambio de contraseña para el usuario actual
	*/
	function cambioPass(){
		$this->load->database();
		
		$this->form_validation->set_rules('pass1','nueva contraseña','required|min_length[8]|max_length[16]|matches[pass2]');
		$this->form_validation->set_rules('pass2','repita nueva contraseña','required|min_length[8]|max_length[16]');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio.');
		$this->form_validation->set_message('min_length','La contraseña introducida es demasiado corta.');
		$this->form_validation->set_message('max_lenght','La contraseña introducida es demasiado larga.');
		$this->form_validation->set_message('matches','Las contraseñas introducidas no son iguales.');
		
		if($this->form_validation->run() == FALSE){
			$this->nuevaPass();
		}
		else{
			if($this->input->post('submit')){
				
				$cuerpo="Su contraseña ha sido cambiada satisfactoriamente<br>
							  Tu nueva contraseña es: ".$this->input->post('pass1')."<br>";
				$asunto = "Cambio contraseña Guardería Bahía Blanca";
				
				$datos=$this->mainModel->datosUsuario($_SESSION['user']);
				if( $datos['rol'] == 'ALUM' ){ $datos = $this->mainModel->datosTutor($_SESSION['user']); }
				
				$this->enviarMail($asunto,$cuerpo,$datos['email']);
				
				$pass = $this->crypt_blowfish($this->input->post('pass1'));
				
				$data = array( 'nickname' => $_SESSION['user'],
									 'password' => $pass);
				
				$this->mainModel->cambioPass($data);
				$this->miCuenta();
			}
		}
	}
	
	/**
	* Funcion que mostrará el formulario de envío de email desde un tutor al centro
	*/
	function emailCentro(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('email');
		$this->load->view('pie_pag');	
	}
	
	/**
	* Función que envia un email de un tutor al centro
	*/
	function sendMail(){
		$this->form_validation->set_rules('asunto','Asunto','required');
		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->emailCentro();
		}
		else{
			if($this->input->post('submit')){
				$cuerpo = "Email enviado por el usuario: ".$_SESSION['user'].".<br><br>".nl2br($this->input->post('cuerpo'));
				$asunto = $this->input->post('asunto');
				$destino = 'guarderia.bahiablanca@gmail.com';
				
				$this->enviarMail($asunto,$cuerpo,$destino);
				
				$this->index();
			}
		}
	}
	
	/**
	* Función que permite al administrador comunicarse con el tutor de un alumno
	*/
	function mailTutores($res=null){
		if( !isset($res) ){
			$this->load->view('cabecera');
			$this->tipoMenu();
			$this->load->view('buscaUsuarios');
			$this->load->view('pie_pag');
		}
		else{
			
			$data['res']= array($res);
			
			$this->load->view('cabecera');
			$this->tipoMenu();			
			$this->load->view('buscaUsuarios',$data);
			$this->load->view('pie_pag');
		}
	}
	
	/**
	* Función que buscará los alumnos cuyo nombre se contenga la cadena introducida
	*/
	function buscaUsuarios(){
		$this->load->database();
		
		$this->form_validation->set_rules('busqueda','busqueda','required');

		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->mailTutores();
		}
		else{
			if($this->input->post('submit')){
				$res = $this->mainModel->buscaUsuarios($this->input->post('busqueda'));
				$this->mailTutores($res);
			}
		}
	}
	
	/**
	* Función que en base a un alumno, le envía un email al tutor asociado a la cuenta
	*/
	function mailTutor($usuario){
		
		$data['user'] = $usuario;
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('emailTutor',$data);
		$this->load->view('pie_pag');	
	}
	
	/**
	* Función que enviará un correo electrónico al tutor del alumno seleccionado
	*/
	function sendMailTutor(){
		$this->load->database();
		
		$this->form_validation->set_rules('asunto','Asunto','required');
		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->emailCentro();
		}
		else{
			if($this->input->post('submit')){
				
				$dat = $this->mainModel->datosTutor($this->input->post('user'));
				
				$cuerpo = nl2br($this->input->post('cuerpo'));
				$asunto = $this->input->post('asunto');
				echo $destino = $dat['email'];
				
				$this->enviarMail($asunto,$cuerpo,$destino);
				
				$this->index();
			}
		}
	}
	
	/**
	* Funcion auxiliar que determina que menu lateral mostrar en funcion del tipo de usuario que acceda a la web
	*/
	function tipoMenu(){
		if(!isset($_SESSION['rol'])){
			$this->load->view('menu');	
		}
		else
		{
			if($_SESSION['rol'] == 0){
				$this->load->view('menu_padres');
			}
			else if($_SESSION['rol'] == 1){
				$this->load->view('menu_prof');
			}
			else{
				$this->load->view('menu_admin');
			}	
		}	
	}
	
	/**
	* Funcion auxiliar empleada para enviar emais
 	*/
	function enviarMail($asunto,$contenido,$destino){
		$configMail=array(
			'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'guarderia.bahiablanca@gmail.com',
            'smtp_pass' => 'guarderia1234',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
		);
		
		$this->email->initialize($configMail);
		
		$this->email->from('guarderia.bahiablanca@gmail.com','Guarderia Bahia Blanca');
        $this->email->to($destino);
        $this->email->subject($asunto);
        $this->email->message($contenido);
        
		if (!$this->email->send()) {
			// Raise error message
			show_error($this->email->print_debugger());
		}
	}
	
	/**
	* Funcion auxiliar que se emplea para encriptar informacion
	*/
	function crypt_blowfish($password, $digito = 7) {  
		$salt = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz./';
		$saltc = sprintf('$2x$%02d$', $digito);
		for($i = 0; $i < 22; $i++){
			$saltc .= $salt[ rand(0, strlen($salt)-1) ];
		}
		return crypt($password, $salt);  
	} 
}
?>