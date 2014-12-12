<!doctype html>
<?php

class LoginController extends CI_Controller{

	function index()
	{
		session_start();
		
		$this->load->database();
		$this->load->model('mainModel');
		$this->load->view('cabecera');
		$this->load->view('menu_padres');
		$this->load->view('cuerpo');
		$this->load->view('pie_pag');
	}	
}

?>