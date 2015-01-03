<!doctype html>
<?php
session_start();

class MainController extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mainModel');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('email');
	}
	
	function index()
	{
		$this->load->view('cabecera');
		$this->load->view('menu');
		$this->load->view('cuerpo');
		$this->load->view('pie_pag');		
	}
	
	function sesionPadres()
	{
		$this->load->view('cabecera');
		$this->load->view('menu_padres');
		$this->load->view('cuerpo');
		$this->load->view('pie_pag');
	}
	
	function sesionProfes()
	{
		$this->load->view('cabecera');
		$this->load->view('menu_prof');
		$this->load->view('cuerpo');
		$this->load->view('pie_pag');
	}
	
	function sesionAdmin()
	{
		$this->load->view('cabecera');
		$this->load->view('menu_admin');
		$this->load->view('cuerpo');
		$this->load->view('pie_pag');
	}
	
	function accesoAlta(){
		$this->load->view('cabecera');
		$this->load->view('menu_admin');
		$this->load->view('AddUser');
		$this->load->view('pie_pag');	
	}
	
	function AltaUsuario()
	{
		$this->load->database();
		
		
		$this->form_validation->set_rules('nickname','Usuario','required|is_unique[usuario.nickname]');
		$this->form_validation->set_rules('Nombre','Nombre','required');
		$this->form_validation->set_rules('Apellidos','Apellidos','required');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[usuario.email]');
		$this->form_validation->set_rules('dni','DNI','required|is_unique[usuario.dni]|min_length[9]|max_lenght[9]');
		$this->form_validation->set_rules('Dom','Domicilio','required');
		$this->form_validation->set_rules('fnac','Fecha de nacimiento','required');
		$this->form_validation->set_rules('TelContacto','Teléfono','required');
		$this->form_validation->set_rules('email_t','Email del tutor','required|valid_email|is_unique[tutor.email]');
		$this->form_validation->set_rules('dniT','DNI del tutor','required|is_unique[tutor.dni]|min_length[9]|max_lenght[9]');
		
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
							  Tu usuario para acceder al sistema será ".$data['nickname']."<br>
							  Tu contraseña es ".$pass."<br>
							  Recuerda que en tu perfil podrás cambiar la contraseña por la que tu prefieras";
				
				$this->enviarMail("Bienvenido a la guarderia Bahia Blanca",$cuerpo_mail,$data['email']);
				
				$password = $this->crypt_blowfish($pass);
				
				$this->mainModel->altaUser($data,$password);
				header('Location: http://localhost/Guarderia/index.php/mainController/sesionAdmin');
			}
		}
	}
		
	function cerrarSesion()
	{
		session_destroy();
		header('location: http://localhost/Guarderia');
	}
	
	function localizanos()
	{
		$this->load->view('cabecera');
		$this->load->view('menu');
		$this->load->view('localizanos');
		$this->load->view('pie_pag');
	}
	
	function Acceso()
	{
		$this->load->view('cabecera');
		$this->load->view('menu');
		$this->load->view('acceso');
		$this->load->view('pie_pag');
	}
	
	function Acceder()
	{		
		$this->load->database();
		$this->load->model('mainModel');
		
		if($this->input->post('submit'))
		{ 
			if($this->input->post('user') == '')
			{
				//mostrar error por entrar sin usuario
				header('location: http://localhost/Guarderia');
			}
			else
			{
				$usuario=$this->input->post('user');
				$pass=$this->input->post('pass');
				
				$consulta = $this->mainModel->iniciaSesion($usuario);
				
				if($consulta == 0)
				{
					//Mensaje de error por inventarse usuario
					header('location: http://localhost/Guarderia/index.php/no_existe');
				}
				else
				{
					$rol=$this->mainModel->getRol($usuario);
					if($rol == 'ALUM'){$_SESSION['rol']=0; header('location: http://localhost/Guarderia/index.php/mainController/sesionPadres');}
					if($rol == 'PROF'){$_SESSION['rol']=1; header('location: http://localhost/Guarderia/index.php/mainController/sesionProfes');}
					if($rol == 'ADMIN'){$_SESSION['rol']=2; header('location: http://localhost/Guarderia/index.php/mainController/sesionAdmin');}

					header('location: http://localhost/Guarderia');
				}
			}
		}
	}
	
	function enviarMail($asunto,$contenido,$destino)
	{
		$configMail=array(
			'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
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
        
		$this->email->send();
	}
	
	function crypt_blowfish($password, $digito = 7) {  
		$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';  
		$salt = sprintf('$2a$%02d$', $digito);  
		for($i = 0; $i < 22; $i++)  
		{  
		 $salt .= $set_salt[mt_rand(0, 63)];  
		}  
		return crypt($password, $salt);  
	} 
}
?>
