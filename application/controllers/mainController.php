<!doctype html>
<?php

class MainController extends CI_Controller{
	
	function index()
	{
		$this->load->view('cabecera');;
		$this->load->view('menu');
		$this->load->view('cuerpo');
		$this->load->view('pie_pag');		
	}
}

?>
