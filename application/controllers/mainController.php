<!doctype html>
<?php
session_start();

class MainController extends CI_Controller{
	/**
	* Funcion constructor de la clase Controlador de nuestro proyecto
	*/ 
	function __construct(){

		$preferencias = array(
			'start_day' => 'monday',
			'month_type' => 'long',
			'day_type' => 'long',
			'show_next_prev' => 'true',
			'next_prev_url' => 'http://localhost/Guarderia/index.php/mainController/incidencias');

		$preferencias['template'] = '
		    {table_open}<table class="calendar">{/table_open}
		    {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
		    {cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
		    {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
		    {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
		    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
		'; 

		parent::__construct();
		$this->load->model('mainModel');
		$this->load->helper('download');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="mens_error">', '</div>');
		$this->load->library('calendar',$preferencias);
	}
	
	/**
	* Funcion que carga la pantalla principal de bienvenida
	*/
	function index(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('cuerpo');
	}
	
	/**
	* Funcion que carga la pantalla con el formulario de registro de usuarios
	*/
	function accesoAlta(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('AddUser');
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
					'grupo'=>$this->input->post('Grupo'),
					'email'=>$this->input->post('email'),
					'nombreT'=>$this->input->post('NombreTutor'),
					'apellidosT'=>$this->input->post('ApellidosTutor'),
					'telefono'=>$this->input->post('TelContacto'),
					'dni_t'=>$this->input->post('dniT'),
					'email_t'=>$this->input->post('email_t'),
					'nombreT2'=>$this->input->post('NombreTutor2'),
					'apellidosT2'=>$this->input->post('ApellidosTutor2'),
					'telefono2'=>$this->input->post('TelContacto2'),
					'dni_t2'=>$this->input->post('dniT2'),
					'email_t2'=>$this->input->post('email_t2'),
					'horario'=>$this->input->post('horario'),
					'pago'=>$this->input->post('pago'),
					'fotos'=>$this->input->post('autorizacion')
				);
				
				$pass=substr(md5(microtime()),1,8);
				
				$cuerpo_mail="Bienvenido, nos complace mucho darte la bienvenida a nuestra guarderia<br>
							  Tu usuario para acceder al sistema es: ".$data['nickname']."<br>
							  Tu contraseña es: ".$pass."<br>
							  Recuerda que en tu perfil podrás cambiar la contraseña por la que tu prefieras";
				
				if($data['rol'] == 'PROF' || $data['rol'] == 'ADMIN')
				{
					$dest = $data['email'];
					$this->enviarMail("Bienvenido a la Guardería Bahía Blanca",$cuerpo_mail,$dest);
				}
				
				else{
					$destino = $data['email_t'];
					$destino2 = $data['email_t2'];
					
					$this->enviarMail("Bienvenido a la Guardería Bahía Blanca",$cuerpo_mail,$destino);
					$this->enviarMail("Bienvenido a la Guardería Bahía Blanca",$cuerpo_mail,$destino2);
				}
				
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
		header('Location: http://localhost/Guarderia');
	}
	
	/**
	* Funcion que carga la pantalla con informacion sobre la ubicacion de la guarderia
	*/
	function localizanos(){
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('localizanos');
	}
	
	/**
	* Funcion que nos muestra el formulario de acceso para usuarios registrados
	*/
	function Acceso(){
		$this->load->view('cabecera');
		$this->load->view('menu');
		$this->load->view('acceso');
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
					$this->Acceso();
				}
			}
		}
	}
	
	/**
	* Funcion que nos muestra el formulario que nos permite añadir contenidos a la web
	*/
	function addContenido(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] == 0){
			show_404();
		}
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('addContenido');
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
						
						if($datos['privilegios'] == 'PRIVADO'){
							$tutores = $this->mainModel->getTutores();
							$i=0;
							$emails=array();
							foreach ($tutores as $valor) {
								$emails[$i] = $valor['email'];
							}

							$cuerpo = "Se ha realizado una nueva publicación en la página web de la Guardería que podría ser de su interés<br>";
							$asunto = "Guardería Bahía Blanca: Nuevo contenido disponible";
							$this->enviarMailOculto($emails,$cuerpo,$asunto);
						}

						header('Location:'.base_url());
					}
			}
			
		}
	}
	
	/**
	* Funcion que nos muestra todo el contenido de la web para permitir el borrado de contenidos
	*/
	function delContenido(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();
		$data['res1']=$this->mainModel->getContenido('NOV');
		$data['res2']=$this->mainModel->getContenido('CUR');
		$data['res3']=$this->mainModel->getContenido('COM');
		$this->load->view('cabecera');
		$this->load->view('menu_admin');
		$this->load->view('delContenido',$data);

	}
	
	/**
	* Funcion que carga todo el contenido para que el usuario acceda a una noticia anterior
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
	}
	
	/**
	* Funcion que muestra todos los usuarios del sistema para darlos de baja
	*/
	function accesoBaja(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();
		$data['res1']=$this->mainModel->getUsuarios('ADMIN');
		$data['res2']=$this->mainModel->getUsuarios('ALUM');
		$data['res3']=$this->mainModel->getUsuarios('PROF');
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('bajaUsuarios',$data);
	}
	
	/**
	* Funcion que efectua la baja de un usuario
	*/
	function borrarUsuario($id){
		$this->load->database();
		$this->mainModel->bajaUsuario($id,$_SESSION['rol']);
		
		header('Location:'.base_url().'/index.php/mainController/accesoBaja');
	}
	
	/**
	* Funcion que cargara el apartado correspondiente al perfil del usuario
	*/
	function miCuenta(){
		if( !isset($_SESSION['rol']) ){
			show_404();
		}
		$this->load->database();
		
		$res1 = $this->mainModel->datosUsuario($_SESSION['user'],$_SESSION['rol']);
		$data['res1'] = $res1;
		
		if($res1['rol'] == 'ALUM'){
			$res2 = $this->mainModel->datosTutor($_SESSION['user']);
			$data['res2'] = $res2;
		}
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('miCuenta',$data);
	}
	
	/**
	* Funcion que mostrara el formulario de modificacion del domicilio de un usuario del sistema
	*/
	function nuevoDom(){
		if( !isset($_SESSION['rol']) ){
			show_404();
		}
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('nuevoDom');
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
				$this->mainModel->cambioDom($data,$_SESSION['rol']);
				$this->miCuenta();
			}
		}
	}
	
	/**
	* Funcion que mostrara el formulario de modificacion de la direccion de email de un usuario del sistema
	*/
	function nuevoEmail($id){
		if( !isset($_SESSION['rol']) ){
			show_404();
		}

		$data = array('id'=>$id);
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('nuevoEmail',$data);	
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
					'rol' => $_SESSION['rol'],
					'email'=>$this->input->post('email'),
					'id' => $this->input->post('id')
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
		if( !isset($_SESSION['rol']) ){
			show_404();
		}
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('nuevaPass');	
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
							  La nueva contraseña es: ".$this->input->post('pass1')."<br>";
				$asunto = "Cambio contraseña Guardería Bahía Blanca";
				
				$datos=$this->mainModel->datosUsuario($_SESSION['user'],$_SESSION['rol']);
				if( $datos['rol'] == 'ALUM' ){ 
					$datos = $this->mainModel->datosTutor($_SESSION['user']); 
					foreach ($datos as $valor) {
						$this->enviarMail($asunto,$cuerpo,$valor['email']);
					}
				}
				else{
					$this->enviarMail($asunto,$cuerpo,$datos['email']);
				}
				
				
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
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 0){
			show_404();
		}
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('email');
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
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] == 0){
			show_404();
		}
		if( !isset($res) ){
			$this->load->view('cabecera');
			$this->tipoMenu();
			$this->load->view('buscaUsuarios');
		}
		else{
			
			$data['res']= array($res);
			
			$this->load->view('cabecera');
			$this->tipoMenu();			
			$this->load->view('buscaUsuarios',$data);
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
				if($_SESSION['rol'] == 2){
					$res = $this->mainModel->buscaUsuarios($this->input->post('busqueda'));	
				}
				else{
					$res = $this->mainModel->buscaUsuarios($this->input->post('busqueda'),$_SESSION['user']);
				}
				$this->mailTutores($res);
			}
		}
	}
	
	/**
	* Función que en base a un alumno, le envía un email al tutor asociado a la cuenta
	*/
	function mailTutor($usuario){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] == 0){
			show_404();
		}
		$data['user'] = $usuario;
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('emailTutor',$data);
	}
	
	/**
	* Función que enviará un correo electrónico a los tutores del alumno seleccionado
	*/
	function sendMailTutor(){
		$this->load->database();
		
		$this->form_validation->set_rules('asunto','Asunto','required');
		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->mailTutor();
		}
		else{
			if($this->input->post('submit')){
				
				$dat = $this->mainModel->datosTutor($this->input->post('user'));
				
				$cuerpo = nl2br($this->input->post('cuerpo'));
				$asunto = $this->input->post('asunto');
				
				for($i=0; $i < count($dat); $i++){

					$this->enviarMail($asunto,$cuerpo,$dat[$i]['email']);
				}
				
				$this->index();
			}
		}
	}
	
	/**
	* Función que nos listará los alumnos registrados en el sistema
	*/
	function consultaAlumnos(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();
		
		$data['res']=$this->mainModel->getAlumnos('ALUM');
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('consultaAlumnos',$data);
	}
	
	/**
	* Función que nos mostrará toda la información relativa a un alumno seleccionado previamente
	*/
	function verAlumnoSimple($id){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();
		
		$data['res']=$this->mainModel->getAlumno($id);
		
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('consultaAlumno',$data);
	}
	
	/**
	* Función que nos mostrará el calendario para añadir incidencias
	*/
	function incidencias($anno = null, $mes = null){
		if(!isset($_SESSION['rol'])){
			show_404();
		}

		$this->load->database();
		
		if ($anno == null) {
			$anno = date('Y');
		}
		if($mes == null){
			$mes = date('m');
		}

		$incidencias = $this->mainModel->incidencias_mens($anno,$mes);

		$data = array(
			'anno' => $anno,
			'mes' => $mes,
			'incidencias' => $incidencias
 			);

        $this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('calendario_incidencias',$data);
	}

	/**
	* Función que nos mostrará una incidencia desde el calendario
 	*/
 	function verIncidencia($id){
 		if(!isset($_SESSION['rol'])){
			show_404();
		}
 		$this->load->database();

 		$incidencia=$this->mainModel->getIncidencia($id);
 		$comentarios=$this->mainModel->getComentarios($id);

 		$data = array(
 			'incidencia' => $incidencia,
 			'comentarios' => $comentarios,
 			'id' => $id);

 		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('verIncidencia',$data);

 	}
	
	/**
	* Función que nos muestra el formulario para registrar las incidencias diarias
	*/
	function addIncidencia(){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('addIncidencia');
	}

	/**
	* Función que almacenará la incidencia nueva en la base de datos para mostrarla posteriormente a los usuarios
	*/
	function addInc(){
		$this->load->database();

		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');

		if($this->form_validation->run() == FALSE){
			$this->addIncidencia();
		}
		else{
			if($this->input->post('submit')){
				$cuerpo = nl2br($this->input->post('cuerpo'));
			}
			$this->mainModel->addInc($cuerpo);

			$grupo = $this->mainModel->getGrupo($_SESSION['user']);

			$tutores = $this->mainModel->getTutores($grupo);

			$i=0;
			$emails=array();
			foreach ($tutores as $valor) {
				$emails[$i] = $valor['email'];
			}

			$cuerpo = "Se ha publicado en la web de la guardería qué ha hecho su hijo en el día de hoy.<br>
					   Si desea comprobarlo y darnos su opinión solo tiene que acceder a la sección habilitada para este fin.<br>
					   Cualquier sugerencia será agradecida ya que nos ayudará a dar un mejor servicio para todos.<br><br>
					   Que tenga un buen día.";
			$asunto = "Guardería Bahía Blanca: Actividad diaria";
			$this->enviarMailOculto($emails,$cuerpo,$asunto);

			$this->incidencias();
		}
	}

	/**
	* Función que nos mostrará el formulario para que los tutores añadan comentarios a las incidencias diarias
	*/
	function addComentario($id){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('addComentario',array('id'=>$id));
	}

	/**
	* Función que almacenará el comentario del tutor en la base de datos
	*/
	function addCom(){
		$this->load->database();

		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');

		if($this->form_validation->run() == FALSE){
			$this->addComentario();
		}
		else{
			if($this->input->post('submit')){
				$cuerpo = nl2br($this->input->post('cuerpo'));
				$id= $this->input->post('id');

				$datos = array('cuerpo' => $cuerpo,
							   'evento' => $id,
							   'nickname' => $_SESSION['user']);
			}

			$this->mainModel->addCom($datos);
			$this->incidencias();
		}
	}

	/**
	* Función que mostrará el apartado de cómo trabajamos
	*/
	function trabajamos(){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('como_trabajamos');
	}

	/**
	* Función que mostrará el apartado de qué ofrecemos
	*/
	function ofrecemos(){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('ofrecemos');
	}

	/**
	* Función que mostrará el apartado acerca de las instalaciones del centro
	*/
	function instalaciones(){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('instalaciones');
	}

	/**
	* Función que mostrará el apartado sobre el proyecto educativo
	*/
	function proyecto_edu(){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('proyecto_edu');
	}

	/**
	* Función que mostrará el apartado de las señas de identidad del centro
	*/
	function identidad(){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('identidad');
	}

	/**
	* Función que mostrará el apartado acerca de cómo es un día en la escuela
	*/
	function dia_escuela(){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('dia_en_escuela');
	}

	/**
	* Función que mostrará el apartado de contacto
	*/
	function contacto(){
		$this->load->view('cabecera');
        $this->tipoMenu();
        $this->load->view('contacto');
	}

	/**
	* Función que procesara el formulario de contacto
	*/
	function consultaPublica(){

		$this->form_validation->set_rules('nombre','Nombre','required');
		$this->form_validation->set_rules('email','email','required');

		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->contacto();
		}
		else{
			if($this->input->post('submit')){
				$consulta = nl2br($this->input->post('consulta'));
				$nombre= $this->input->post('nombre');
				$email = $this->input->post('email');
				
				$destino = 'guarderia.bahiablanca@gmail.com';
				$asunto = 'Consulta desde la web';

				$cuerpo = 'Tiene una consulta realizada desde la web.<br>
						   El nombre del interesado es: '.$nombre.'<br>
						   Su correo electrónico es: '.$email.'<br>
						   La consulta es la siguiente: <br><br>'.$consulta;

				$this->enviarMail($asunto,$cuerpo,$destino);
			}
			$this->index();
		}
	}
	
 	/**
	* Funcion auxiliar que determina que menu mostrar en funcion del tipo de usuario que acceda a la web
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
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'guarderia.bahiablanca@gmail.com',
            'smtp_pass' => 'guarderia1234',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'validate' => true
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
	* Función que enviará los mensajes con copia oculta para grupos de tutores
	*/
	function enviarMailOculto($emails,$cuerpo,$asunto){
		$configMail=array(
			'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'guarderia.bahiablanca@gmail.com',
            'smtp_pass' => 'guarderia1234',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'validate' => true
		);
		
		$this->email->initialize($configMail);
		
		$this->email->from('guarderia.bahiablanca@gmail.com','Guarderia Bahia Blanca');
		$this->email->bcc($emails);
        $this->email->subject($asunto);
        $this->email->message($cuerpo);
        
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