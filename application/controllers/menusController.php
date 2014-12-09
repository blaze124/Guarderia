<!doctype html>
<?php

class MenusController extends CI_Controller{
	
	function index()
	{
		$this->load->view('cabecera');;
		$this->load->view('menu');
		$this->load->view('menus_mensuales');
		$this->load->view('pie_pag');	
	}
}

?>