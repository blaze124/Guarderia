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
		
		$res=$consulta->row->rol;
		
		return $res;
	}
	
	function altaUser($datos,$pass)
	{
		$this->db->insert('usuario',$datos);
		$acceso=array('nickname'=>$datos['nickname'], 'password' => $pass);
		$this->db->insert('acceso',$acceso);
	}

}
?>