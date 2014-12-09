<!doctype html>
<?php

class EmailController extends CI_Controller{
	
	function index()
	{
		$this->load->view('cabecera');
		$this->load->view('menu_padres');
		$this->load->view('email');
		$this->load->view('pie_pag');	
	}	
}

?>