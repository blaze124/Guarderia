<!doctype html>
<?php

class Errors extends CI_Controller{

	private $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
	}

	function error_404()
	{
		//llamamos a la vista que muestra el error 404 personalizado
		$this->load->view('cabecera');
		$this->tipoMenu();
		$this->load->view('errors/404');
		$this->load->view('pie_pag');
		
	}
}

?>