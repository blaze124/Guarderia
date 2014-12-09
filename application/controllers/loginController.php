<!doctype html>
<?php

class LoginController extends CI_Controller{

	function index()
	{
		$this->load->view('cabecera');
		$this->load->view('menu_padres');
		$this->load->view('cuerpo');
		$this->load->view('pie_pag');
	}	
}

?>