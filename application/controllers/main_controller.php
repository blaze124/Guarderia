<!doctype html>
<?php
session_start();

class Main_controller extends CI_Controller{
	/**
	* Funcion constructor de la clase Controlador de nuestro proyecto
	*/ 
	function __construct(){

		$preferencias = array(
			'start_day' => 'monday',
			'month_type' => 'long',
			'day_type' => 'long',
			'show_next_prev' => 'true',
			'next_prev_url' => 'http://www.guarderiabahiablanca.es/index.php/main_controller/incidencias'
			);

		$preferencias['template'] = '
		    {table_open}<table class="calendar">{/table_open}
		    {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
		    {cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
		    {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
		    {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
		    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
		'; 

		parent::__construct();
		$this->load->model('Main_model');
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
		$this->tipo_menu();
		$this->load->view('cuerpo');
	}
	
	/**
	* Funcion que carga la pantalla con el formulario de registro de usuarios
	*/
	function acceso_alta(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('add_user');
	}
	
	/**
	*	Metodo que procesa el registro de usuarios en base a un formulario
	*/
	function alta_usuario(){
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
			$this->acceso_alta();
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
					'fotos'=>$this->input->post('autorizacion'),
					'matinal'=>$this->input->post('matinal'),
					'observaciones'=>nl2br($this->input->post('observaciones'))
				);
				
				$pass=substr(md5(microtime()),1,8);
				
				$cuerpo_mail="Bienvenido, nos complace mucho darte la bienvenida a nuestra guarderia<br>
							  Tu usuario para acceder al sistema es: ".$data['nickname']."<br>
							  Tu contraseña es: ".$pass."<br>
							  Recuerda que en tu perfil podrás cambiar la contraseña por la que tu prefieras";
				
				if($data['rol'] == 'PROF' || $data['rol'] == 'ADMIN')
				{
					$dest = $data['email'];
					$this->enviar_mail("Bienvenido a la Guardería Bahía Blanca",$cuerpo_mail,$dest);
				}
				
				else{
					$destino = $data['email_t'];
					$destino2 = $data['email_t2'];
					
					$this->enviar_mail("Bienvenido a la Guardería Bahía Blanca",$cuerpo_mail,$destino);
					if($destino2 != null){
						$this->enviar_mail("Bienvenido a la Guardería Bahía Blanca",$cuerpo_mail,$destino2);
					}
				}
				
				$password = $this->crypt_blowfish($pass);
				
				$this->Main_model->alta_user($data,$password);
				header('Location: '.base_url().'index.php/main_controller/acceso_alta');
			}
		}
	}
	
	/**
	* Metodo que cierra la sesión activa
	*/
	function cerrar_sesion(){
		session_destroy();
		header('Location: '.base_url());
	}
	
	/**
	* Funcion que carga la pantalla con informacion sobre la ubicacion de la guarderia
	*/
	function localizanos(){
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('localizanos');
	}
	
	/**
	* Funcion que nos muestra el formulario de acceso para usuarios registrados
	*/
	function acceso(){
		$this->load->view('cabecera');
		$this->load->view('menu');
		$this->load->view('acceso');
	}
	
	/**
	* Funcion que procesa el formulario de acceso e inicia la sesion
	*/
	function acceder(){		
		$this->load->database();

		$this->form_validation->set_rules('user','Usuario','required');
		$this->form_validation->set_rules('pass','Contraseña','required');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->acceso();
		}
		else{
			if($this->input->post('submit')){
				$datos=array(
					'nickname'=>$this->input->post('user'),
					'password'=>$this->input->post('pass')
				);

				$consulta=$this->Main_model->inicia_sesion($datos);

				if($consulta == array()){
					$this->acceso();
				}
				elseif( crypt($this->input->post('pass'),$consulta['password']) == $consulta['password'] )
				{
					$rol = $this->Main_model->get_rol($this->input->post('user'));
					if($rol == 'ALUM'){$_SESSION['rol'] = 0;}
					else if($rol == 'PROF'){$_SESSION['rol'] = 1;}
					else{$_SESSION['rol'] = 2;}
					$_SESSION['user'] = $datos['nickname'];
					$this->index();
				}
				else{
					$this->acceso();
				}
			}
		}
	}
	
	/**
	* Funcion que nos muestra el formulario que nos permite añadir contenidos a la web
	*/
	function add_contenido(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] == 0){
			show_404();
		}
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('add_contenido');
	}
	
	/**
	* Funcion que procesa el formulario de adicion de contenidos
	*/
	function agrega_cont(){
		$this->load->database();
		$this->load->library('Upload');
		$this->load->helper('url');	
		$this->form_validation->set_rules('titulo','Titulo','required');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->add_contenido();
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
						'allowed_types' => 'gif|jpg|png|GIF|JPG|PNG|jpeg|JPEG|pdf|PDF',
						'max_size' => '1000000',
						));
					
					if($this->upload->do_multi_upload('userfile')){
						
						$info = $this->upload->get_multi_upload_data();
						
						$id = $this->Main_model->add_contenido($datos);
						print_r($this->upload->get_multi_upload_data());
						
						foreach($info as $vec)
						{
							$ruta = $vec['full_path'];
							
							$this->Main_model->add_imagen($id,$ruta);
						}
						
						$tutores = $this->Main_model->get_tutores_full();
						$i=0;
						$emails=array();

						foreach ($tutores as $valor) {
							$emails[$i] = $valor['email'];

							$cuerpo = "Se ha realizado una nueva publicación en la página web de la Guardería que podría ser de su interés<br>";
							$asunto = "Guardería Bahía Blanca: Nuevo contenido disponible";
							$this->enviar_mail($valor['email'],$cuerpo,$asunto);
							
							echo $emails[$i]."<br>";
						}

						
						header('Location:'.base_url());
					}
			}
			
		}
	}
	
	/**
	* Funcion que nos muestra todo el contenido de la web para permitir el borrado de contenidos
	*/
	function del_contenido(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();
		$data['res1']=$this->Main_model->get_contenido('NOV');
		$data['res2']=$this->Main_model->get_contenido('CUR');
		$data['res3']=$this->Main_model->get_contenido('COM');
		$data['res4']=$this->Main_model->get_incidencias();
		$this->load->view('cabecera');
		$this->load->view('menu_admin');
		$this->load->view('del_contenido',$data);

	}
	
	/**
	* Funcion que carga todo el contenido para que el usuario acceda a una noticia anterior
	*/
	function todo_contenido(){
		$this->load->database();
		if(!isset($_SESSION['rol'])){
			$data['res1']=$this->Main_model->get_contenido_pub('NOV');
			$data['res2']=$this->Main_model->get_contenido_pub('CUR');
		}
		else{
			$data['res1']=$this->Main_model->get_contenido('NOV');
			$data['res2']=$this->Main_model->get_contenido('CUR');
		}

		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('todo_contenido',$data);
	}
	
	/**
	* Funcion que nos carga una noticia con campo id = $id
	*/
	function ver_contenidoSimple($id){
		$this->load->database();
		$data['res'] = $this->Main_model->get_contenido_simple($id);
		$data['id'] = $id;
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('ver_contenido',$data);
	}
	
	/**
	* Funcion que borra el contenido con campo id = $id
	*/
	function borrar_contenido($id){
		$this->load->database();
		$this->Main_model->del_contenido($id);
		$this->del_contenido();
	}
	
	/**
	* Funcion que borra la incidencia con campo id = $id y los comentarios asociados
	*/
	function borrar_incidencia($id){
		$this->load->database();
		$this->Main_model->del_incidencia($id);
		$this->del_contenido();
	}

	/**
	* Funcion que obtiene de la base de datos las noticias mas recientes para mostrarlas a los usuarios
	*/
	function ver_contenido(){
		$this->load->database();
		
		if(!isset($_SESSION['rol'])){
			$data['res']=$this->Main_model->ver_contenido_pub();
		}
		else{
			$data['res']=$this->Main_model->ver_contenido();
		}
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('ver_contenido',$data);
	}
	
	/**
	* Funcion que carga todos los menus mensuales para que el usuario los consulte
	*/
	function todo_menus(){
		$this->load->database();

		$data['res1']=$this->Main_model->get_contenido('COM');

		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('todo_menus',$data);
	}
	
	/**
	* Funcion que obtiene de la base de datos el menu mensual con id = $id
	*/
	function ver_menus($id){
		$this->load->database();
		$data['res']=$this->Main_model->ver_menus_mens_id($id);
		
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('menus_mensuales',$data);
	}

	/**
	* Funcion que carga de la base de datos el menu mensual mas reciente
	*/
	function menus_mens(){
		$this->load->database();
		$data['res']=$this->Main_model->ver_menus_mens();
		
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('menus_mensuales',$data);
	}
	
	/**
	* Funcion que muestra todos los usuarios del sistema para darlos de baja
	*/
	function acceso_baja(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();
		$data['res1']=$this->Main_model->get_usuarios('ADMIN');
		$data['res2']=$this->Main_model->get_usuarios('ALUM');
		$data['res3']=$this->Main_model->get_usuarios('PROF');
		
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('baja_usuarios',$data);
	}
	
	/**
	* Funcion que efectua la baja de un usuario
	*/
	function borrar_usuario($id,$rol){
		$this->load->database();
		$this->Main_model->baja_usuario($id,$rol);
		
		header('Location:'.base_url().'index.php/main_controller/acceso_baja');
	}
	
	/**
	* Funcion que cargara el apartado correspondiente al perfil del usuario
	*/
	function mi_cuenta(){
		if( !isset($_SESSION['rol']) ){
			show_404();
		}
		$this->load->database();
		
		$res1 = $this->Main_model->datos_usuario($_SESSION['user'],$_SESSION['rol']);
		$data['res1'] = $res1;
		
		if($res1['rol'] == 'ALUM'){
			$res2 = $this->Main_model->datos_tutor($_SESSION['user']);
			$data['res2'] = $res2;
		}
		
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('mi_cuenta',$data);
	}
	
	/**
	* Funcion que mostrara el formulario de modificacion del domicilio de un usuario del sistema
	*/
	function nuevo_dom(){
		if( !isset($_SESSION['rol']) ){
			show_404();
		}
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('nuevo_dom');
	}
	
	/**
	* Funcion que efectua el cambio de domicilio
	*/
	function cambio_dom(){
		$this->load->database();
		
		$this->form_validation->set_rules('Dom','domicilio','required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->nuevo_dom();
		}
		else{
			if($this->input->post('submit')){
				$data = array(
					'nickname'=>$_SESSION['user'],
					'domicilio'=>$this->input->post('Dom')
				);
				$this->Main_model->cambio_dom($data,$_SESSION['rol']);
				$this->mi_cuenta();
			}
		}
	}
	
	/**
	* Funcion que mostrara el formulario de modificacion de la direccion de email de un usuario del sistema
	*/
	function nuevo_email($id){
		if( !isset($_SESSION['rol']) ){
			show_404();
		}

		$data = array('id'=>$id);
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('nuevo_email',$data);	
	}
	
	/**
	* Funcion que efectua el cambio de direccion de email
	*/
	function cambio_email(){
		$this->load->database();
		
		$this->form_validation->set_rules('email','email','valid_email|required|is_unique[usuario.email]|is_unique[tutor.email]');
		$this->form_validation->set_message('required','El campo %s es obligatorio.');
		$this->form_validation->set_message('is_unique','El %s introducido ya está en uso.');
		
		if($this->form_validation->run() == FALSE){
			$this->nuevo_email();
		}
		else{
			if($this->input->post('submit')){
				$data = array(
					'nickname'=>$_SESSION['user'],
					'rol' => $_SESSION['rol'],
					'email'=>$this->input->post('email'),
					'id' => $this->input->post('id')
				);
				$this->Main_model->cambio_email($data);
				
				$asunto = "Cambio email Guarderia Bahia Blanca";
				$cuerpo = "Su solicitud de cambio de direccion de correo electrónico ha sido realizada satisfactoriamente.<br><br>
				Este mensaje se ha generado automáticamente, no lo responda.<br>";
				
				$this->enviar_eail($asunto,$cuerpo,$data['email']);
				
				$this->mi_cuenta();
			}
		}
	}
	
	/**
	* Funcion que mostrará el formulario para cambiar la contraseña de un usuario
	*/
	function nueva_pass(){
		if( !isset($_SESSION['rol']) ){
			show_404();
		}
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('nueva_pass');	
	}
	
	/**
	* Funcion que efectua el cambio de contraseña para el usuario actual
	*/
	function cambio_pass(){
		$this->load->database();
		
		$this->form_validation->set_rules('pass1','nueva contraseña','required|min_length[8]|max_length[16]|matches[pass2]');
		$this->form_validation->set_rules('pass2','repita nueva contraseña','required|min_length[8]|max_length[16]');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio.');
		$this->form_validation->set_message('min_length','La contraseña introducida es demasiado corta.');
		$this->form_validation->set_message('max_lenght','La contraseña introducida es demasiado larga.');
		$this->form_validation->set_message('matches','Las contraseñas introducidas no son iguales.');
		
		if($this->form_validation->run() == FALSE){
			$this->nueva_pass();
		}
		else{
			if($this->input->post('submit')){
				
				$cuerpo="Su contraseña ha sido cambiada satisfactoriamente<br>
							  La nueva contraseña es: ".$this->input->post('pass1')."<br>";
				$asunto = "Cambio contraseña Guardería Bahía Blanca";
				
				$datos=$this->Main_model->datos_usuario($_SESSION['user'],$_SESSION['rol']);
				if( $datos['rol'] == 'ALUM' ){ 
					$datos = $this->Main_model->datos_tutor($_SESSION['user']); 
					foreach ($datos as $valor) {
						if($valor['email'] != null || $valor['email'] != "" )
							$this->enviar_mail($asunto,$cuerpo,$valor['email']);
					}
				}
				else{
					$this->enviar_mail($asunto,$cuerpo,$datos['email']);
				}
				
				
				$pass = $this->crypt_blowfish($this->input->post('pass1'));
				
				$data = array( 'nickname' => $_SESSION['user'],
									 'password' => $pass);
				
				$this->Main_model->cambio_pass($data);
				$this->mi_cuenta();
			}
		}
	}
	
	/**
	* Funcion que mostrará el formulario de envío de email desde un tutor al centro
	*/
	function email_centro(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 0){
			show_404();
		}
		
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('email');
	}
	
	/**
	* Función que envia un email de un tutor al centro
	*/
	function send_mail(){
		$this->form_validation->set_rules('asunto','Asunto','required');
		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->email_centro();
		}
		else{
			if($this->input->post('submit')){
				$cuerpo = "Email enviado por el usuario: ".$_SESSION['user'].".<br><br>".nl2br($this->input->post('cuerpo'));
				$asunto = $this->input->post('asunto');
				$destino = 'guarderia.bahiablanca@gmail.com';
				
				$this->enviar_mail($asunto,$cuerpo,$destino);
				
				$this->index();
			}
		}
	}
	
	/**
	* Función que permite al administrador comunicarse con el tutor de un alumno
	*/
	function mail_tutores($res=null){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] == 0){
			show_404();
		}
		if( !isset($res) ){
			$this->load->view('cabecera');
			$this->tipo_menu();
			$this->load->view('busca_usuarios');
		}
		else{
			if($res[0] == 0){
				$this->load->view('cabecera');
				$this->tipo_menu();
				$this->load->view('busca_usuarios');
			}
			else{
				$data['res']= array($res);
			
				$this->load->view('cabecera');
				$this->tipo_menu();			
				$this->load->view('busca_usuarios',$data);	
			}
			
		}
	}
	
	/**
	* Función que buscará los alumnos cuyo nombre se contenga la cadena introducida
	*/
	function busca_usuarios(){
		$this->load->database();
		
		$this->form_validation->set_rules('busqueda','busqueda','required');

		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->mail_tutores();
		}
		else{
			if($this->input->post('submit')){
				if($_SESSION['rol'] == 2){
					$res = $this->Main_model->busca_usuarios($this->input->post('busqueda'));	
				}
				else{
					$res = $this->Main_model->busca_usuarios($this->input->post('busqueda'),$_SESSION['user']);
				}
				$this->mail_tutores($res);
			}
		}
	}
	
	/**
	* Función que en base a un alumno, le envía un email al tutor asociado a la cuenta
	*/
	function mail_tutor($usuario){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] == 0){
			show_404();
		}
		if(!isset($usuario)){
			$this->mail_tutores();
		}
		$data['user'] = $usuario;
		
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('email_tutor',$data);
	}
	
	/**
	* Función que enviará un correo electrónico a los tutores del alumno seleccionado
	*/
	function send_mail_tutor(){
		$this->load->database();
		
		$this->form_validation->set_rules('asunto','Asunto','required');
		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		
		if($this->form_validation->run() == FALSE){
			$this->mail_tutor($this->input->post('user'));
		}
		else{
			if($this->input->post('submit')){
				
				$dat = $this->Main_model->datos_tutor($this->input->post('user'));
				
				$cuerpo = nl2br($this->input->post('cuerpo'));
				$asunto = $this->input->post('asunto');
				
				for($i=0; $i < count($dat); $i++){

					$this->enviar_mail($asunto,$cuerpo,$dat[$i]['email']);
				}
				
				header('Location: '.base_url());
			}
		}
	}
	
	/**
	* Función que nos listará los alumnos registrados en el sistema
	*/
	function consulta_alumnos(){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();
		
		$data['res']=$this->Main_model->get_alumnos('ALUM');
		$data['res2']=$this->Main_model->get_admins();
		$data['res3']=$this->Main_model->get_profs();
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('consulta_alumnos',$data);
	}
	
	/**
	* Función que nos mostrará toda la información relativa a un alumno seleccionado previamente
	*/
	function ver_alumno_simple($id){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();
		
		$data['res']=$this->Main_model->get_alumno($id);
		
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('consulta_alumno',$data);
	}
	
	function ver_usuario_simple($id){
		if( !isset($_SESSION['rol']) || $_SESSION['rol'] != 2){
			show_404();
		}
		$this->load->database();

		$data['res']=$this->Main_model->get_usuario($id);
		
		$usuario = $data['res'];

		if($_SESSION['user'] == $usuario['nickname']){
			header('Location: '.base_url().'index.php/main_controller/mi_cuenta');
		}else{			
		$this->load->view('cabecera');
		$this->tipo_menu();
		$this->load->view('consulta_usuario',$data);			
		}
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

		$incidencias = $this->Main_model->incidencias_mens($anno,$mes);

		$data = array(
			'anno' => $anno,
			'mes' => $mes,
			'incidencias' => $incidencias
 			);

        $this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('calendario_incidencias',$data);
	}

	/**
	* Función que nos mostrará una incidencia desde el calendario
 	*/
 	function ver_incidencia($id){
 		if(!isset($_SESSION['rol'])){
			show_404();
		}
 		$this->load->database();

 		$incidencia=$this->Main_model->get_incidencia($id);
 		$comentarios=$this->Main_model->get_comentarios($id);

 		$data = array(
 			'incidencia' => $incidencia,
 			'comentarios' => $comentarios,
 			'id' => $id);

 		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('ver_incidencia',$data);

 	}
	
	/**
	* Función que nos muestra el formulario para registrar las incidencias diarias
	*/
	function add_incidencia(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('add_incidencia');
	}

	/**
	* Función que almacenará la incidencia nueva en la base de datos para mostrarla posteriormente a los usuarios
	*/
	function add_inc(){
		$this->load->database();

		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');

		if($this->form_validation->run() == FALSE){
			$this->add_incidencia();
		}
		else{
			if($this->input->post('submit')){
				$cuerpo = nl2br($this->input->post('cuerpo'));
			}
			$this->Main_model->add_inc($cuerpo);

			$grupo = $this->Main_model->get_grupo($_SESSION['user']);

			$tutores = $this->Main_model->get_tutores($grupo);

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
			$this->enviar_mail_oculto($emails,$cuerpo,$asunto);

			$this->incidencias();
		}
	}

	/**
	* Función que nos mostrará el formulario para que los tutores añadan comentarios a las incidencias diarias
	*/
	function add_comentario($id){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('add_comentario',array('id'=>$id));
	}

	/**
	* Función que almacenará el comentario del tutor en la base de datos
	*/
	function add_com(){
		$this->load->database();

		$this->form_validation->set_rules('cuerpo','Cuerpo','required');
		
		$this->form_validation->set_message('required','El campo %s es obligatorio');

		if($this->form_validation->run() == FALSE){
			$this->add_comentario();
		}
		else{
			if($this->input->post('submit')){
				$cuerpo = nl2br($this->input->post('cuerpo'));
				$id= $this->input->post('id');

				$datos = array('cuerpo' => $cuerpo,
							   'incidencia' => $id,
							   'nickname' => $_SESSION['user']);
			}

			$this->Main_model->add_com($datos);
			$this->incidencias();
		}
	}

	/**
	* Función que mostrará el apartado de cómo trabajamos
	*/
	function trabajamos(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('como_trabajamos');
	}

	/**
	* Función que mostrará el apartado de qué ofrecemos
	*/
	function ofrecemos(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('ofrecemos');
	}

	/**
	* Función que mostrará el apartado acerca de las instalaciones del centro
	*/
	function instalaciones(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('instalaciones');
	}

	/**
	* Función que mostrará el apartado sobre el proyecto educativo
	*/
	function proyecto_edu(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('proyecto_edu');
	}

	/**
	* Función que mostrará el apartado de las señas de identidad del centro
	*/
	function identidad(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('identidad');
	}

	/**
	* Función que mostrará el apartado acerca de cómo es un día en la escuela
	*/
	function dia_escuela(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('dia_en_escuela');
	}

	/**
	* Función que mostrará el apartado de contacto
	*/
	function contacto(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('contacto');
	}

	/**
	* Función que procesara el formulario de contacto
	*/
	function consulta_publica(){

		$this->form_validation->set_rules('nombre','Nombre','required');
		$this->form_validation->set_rules('email','Correo Electrónico','required');
		$this->form_validation->set_rules('consulta','Mensaje','required');

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

				$this->enviar_mail($asunto,$cuerpo,$destino);
			}
			$this->index();
		}
	}
	
	function mod_alumno($id){
		if(!isset($_SESSION['rol'])){
			show_404();
		}
 		$this->load->database();

 		$data['res'] = $this->Main_model->get_alumno($id);

		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('modifica_alumno',$data);
	}

	function mod_usuario($id){
		if(!isset($_SESSION['rol'])){
			show_404();
		}
 		$this->load->database();

 		$data['usuario'] = $this->Main_model->get_usuario($id);

		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('modifica_usuario',$data);
	}

	function modifica_usuario(){
		$this->load->database();

		if($this->input->post('submit')){
			$id= $this->input->post('id_usuario');

			$datos = array('nombre' => $this->input->post('nombre'),
						   'apellidos' =>$this->input->post('apellidos'));

			$this->Main_model->modifica_usuario($id,$datos);
			header('Location: '.base_url().'index.php/main_controller/ver_usuario_simple/'.$id);
		}
	}


	function modifica_alumno(){
		$this->load->database();

		if($this->input->post('submit')){
			$id_a= $this->input->post('id_alum');
			$id_t1= $this->input->post('id_t1');
			$id_t2= $this->input->post('id_t2');
			

			$datos_a = array('nombre' => $this->input->post('nombre_alum'),
						   'apellidos' => $this->input->post('apellidos_alum'),
						   'f_nac' => $this->input->post('f_nac'));

			$datos_t1 = array('nombre' => $this->input->post('nombre_t1'),
							'apellidos' => $this->input->post('apellidos_t1'),
							'telefono' => $this->input->post('telefono_t1'));
			
			$datos_t2 = array('nombre' => $this->input->post('nombre_t2'),
							'apellidos' => $this->input->post('apellidos_t2'),
							'telefono' => $this->input->post('telefono_t2'));

			$this->Main_model->modifica_alumno($id_a,$id_t1,$id_t2,$datos_a,$datos_t1,$datos_t2);
		header('Location: '.base_url().'index.php/main_controller/ver_alumno_simple/'.$id_a);
		}
	}

	function reset_pass(){
		$this->load->view('cabecera');
        $this->tipo_menu();
        $this->load->view('reset_pass');
	}

	function reinicia_pass(){
		$this->form_validation->set_rules('nombre','Nombre de usuario','required');
		$this->form_validation->set_message('required','El campo Nombre de usuario es obligatorio');

		if($this->form_validation->run() == FALSE){
			$this->reset_pass();
		}
		else{
			if($this->input->post('submit')){
				$nombre = $this->input->post('nombre');

				$correos = $this->Main_model->get_correos($nombre);

				$pass = substr(md5(microtime()),1,8);

				$asunto = 'Restablecer contraseña';

				$cuerpo = 'En respuesta a su solicitud, se le notifica que su nueva contraseña de acceso al sistema es:<br>-Contraseña: '.$pass;

				$pass1 = $this->crypt_blowfish($pass);
				
				$password = array(
					'password' => $pass1);

				$this->Main_model->reset_pass($password, $nombre);
				foreach ($correos as $email) {
				
					$c = $email['email'];
					if($c != null || $c != "")
						$this->enviar_mail($asunto,$cuerpo,$c);

				}
			}
			header('Location: '.base_url().'index.php/main_controller/acceso');
		}
	}


	function existe_usuario($nombre){
		$this->load->database();

		$res = $this->Main_model->existe_usuario($nombre);

		if(!$res){
			$this->form_validation->set_message('existe_usuario','El usuario introducido no existe');
			return false;
		}else{
			return true;
		}
	}

 	/**
	* Funcion auxiliar que determina que menu mostrar en funcion del tipo de usuario que acceda a la web
	*/
	function tipo_menu(){
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
	function enviar_mail($asunto,$contenido,$destino){
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
	function enviar_mail_oculto($emails,$cuerpo,$asunto){
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
		$this->email->to('guarderia.bahiablanca@gmail.com');
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