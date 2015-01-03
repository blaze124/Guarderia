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
		if($datos['rol'] != 'ALUM'){
			$insert=array(
				'nickname'=>$datos['nickname'],
				'nombre'=>$datos['nombre'],
				'apellidos'=>$datos['apellidos'],
				'rol'=>$datos['rol'],
				'domicilio'=>$datos['domicilio'],
				'f_nac'=>$datos['f_nac'],
				'dni'=>$datos['dni'],
				'email'=>$datos['email']
			);	
			$this->db->insert('usuario',$insert);
		}
		else{
			$insert=array(
				'nickname'=>$datos['nickname'],
				'nombre'=>$datos['Nombre'],
				'apellidos'=>$datos['Apellidos'],
				'rol'=>$datos['ROL'],
				'domicilio'=>$datos['Dom'],
				'f_nac'=>$datos['fnac']
			);
			$insert2=array(				
				'nickname'=>$datos['nickname'],
				'nombre'=>$datos['nombreT'],
				'apellidos'=>$datos['apellidosT'],
				'dni'=>$datos['dni_t'],
				'email'=>$datos['email_t'],
				'telefono'=>$datos['telefono']
			);
			
			$this->db->insert('usuario',$insert);
			$this->db->insert('tutor',$insert2);
		}
		$acceso=array('nickname'=>$datos['nickname'], 'password' => $pass);
		$this->db->insert('acceso',$acceso);
	}

}
?>