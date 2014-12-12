<?php

class MainModel extends CI_Model{
	function __construct(){ parent::__construct(); }	

	function iniciaSesion($usuario)
	{
		$query="select * from acceso where nickname='".$usuario."'";
		$consulta=$this->db->query($query);
		
		if($consulta->num_rows() != 0){
			return $consulta;
		}
		else{return FALSE;}
	}
	
	function getRol($usuario)
	{
		$query="select * from usuario where nickname='".$usuario."'";
		$consulta=$this->db->query($query);
		
		return $consulta;
	}
}

?>