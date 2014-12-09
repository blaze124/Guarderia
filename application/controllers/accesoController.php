<!doctype html>
<?php

class AccesoController extends CI_Controller{
	
	function index()
	{
		$this->load->view('cabecera');;
		$this->load->view('menu');
		$this->load->view('acceso');
		$this->load->view('pie_pag');
	}
}

?>