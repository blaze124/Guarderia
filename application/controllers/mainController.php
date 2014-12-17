<!doctype html>
<?php
session_start();

class MainController extends CI_Controller{
	
	function index()
	{
		if($_SESSION['rol'] == NULL)
		{
			$this->load->view('cabecera');
			$this->load->view('menu');
			$this->load->view('cuerpo');
			$this->load->view('pie_pag');	
		}
		elseif($_SESSION['rol'] == 0)
		{
			$this->load->view('cabecera');
			$this->load->view('menu_padres');
			$this->load->view('cuerpo');
			$this->load->view('pie_pag');	
		}
		elseif($_SESSION['rol'] == 1)
		{
			$this->load->view('cabecera');
			$this->load->view('menu_prof');
			$this->load->view('cuerpo');
			$this->load->view('pie_pag');	
		}
		elseif($_SESSION['rol'] == 2)
		{
			$this->load->view('cabecera');
			$this->load->view('menu_admin');
			$this->load->view('cuerpo');
			$this->load->view('pie_pag');	
		}	
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
			$this->mainModel->altaUser($data);
			header('Location: http://localhost/Guarderia');
		}
	}
		
	function cerrarSesion()
	{
		$_SESSION['rol'] = NULL;
		header('location: http://localhost/Guarderia');
	}
}
?>
