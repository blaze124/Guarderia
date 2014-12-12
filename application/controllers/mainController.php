<!doctype html>
<?php
session_start();

class MainController extends CI_Controller{
	
	function index()
	{
		if(!isset($_SESSION['rol']))
		{
			$this->load->view('cabecera');;
			$this->load->view('menu');
			$this->load->view('cuerpo');
			$this->load->view('pie_pag');	
		}
		elseif($_SESSION['rol'] == 0)
		{
			$this->load->view('cabecera');;
			$this->load->view('menu_padres');
			$this->load->view('cuerpo');
			$this->load->view('pie_pag');	
		}
		elseif($_SESSION['rol'] == 1)
		{
			$this->load->view('cabecera');;
			$this->load->view('menu_prof');
			$this->load->view('cuerpo');
			$this->load->view('pie_pag');	
		}
		elseif($_SESSION['rol'] == 2)
		{
			$this->load->view('cabecera');;
			$this->load->view('menu_admin');
			$this->load->view('cuerpo');
			$this->load->view('pie_pag');	
		}	
	}
}

?>
