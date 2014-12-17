<?php

class MainModel extends CI_Model{
	function __construct(){ parent::__construct(); }	

	function iniciaSesion($usuario)
	{
		$this->db->where('nickname',$usuario);
		$query=$this->db->get('acceso');
		
		return $query->num_rows();
	}
	
	function getRol($usuario)
	{
		$query="select * from usuario where nickname='".$usuario."'";
		$consulta=$this->db->query($query);
		
		$this->db->where('nickname',$usuario);
		$query=$this->db->get('acceso');
		
		$consulta=$query->row->rol;
		
		return $consulta;
	}
	
	function altaUser($datos)
	{
		$this->db->insert('usuario',$datos);
		$nickname=array('nickname'=>$datos['nickname']);
		$this->db->insert(acceso,$nickname);
	}

}
?>