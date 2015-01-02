<!doctype html>
<?php
session_start();

class MainController extends CI_Controller{
	
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
		$this->load->model('mainModel');
		
		if($this->input->post('submit'))
		{
			$data=array(
				'nickname'=>$this->input->post('nickname'),
				'nombre'=>$this->input->post('Nombre'),
				'apellidos'=>$this->input->post('Apellidos'),
				'rol'=>$this->input->post('ROL'),
				'domicilio'=>$this->input->post('Dom'),
				'f_nac'=>$this->input->post('fnac')
			);
			
			$pass=substr(md5(microtime()),1,8);
			$this->mainModel->altaUser($data,$pass);
			header('Location: http://localhost/Guarderia');
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
	
	function Acceder()
	{
		$this->load->view('cabecera');
		$this->load->view('menu');
		$this->load->view('acceso');
		$this->load->view('pie_pag');	
		
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
}
?>
