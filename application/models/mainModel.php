<?php

class MainModel extends CI_Model{
	function __construct(){ parent::__construct(); }	

	function iniciaSesion($datos)
	{
		$this->db->select('*');
		$this->db->from('acceso');
		$this->db->where('nickname',$datos['nickname']);
		$consulta=$this->db->get();
		$res = $consulta->num_rows();
		
		return $res;
	}
	
	function getRol($usuario)
	{
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('nickname',$usuario);
		$consulta=$this->db->get();
		
		$res = $consulta->row_array();
		return $res['rol'];
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
				'nombre'=>$datos['nombre'],
				'apellidos'=>$datos['apellidos'],
				'rol'=>$datos['rol'],
				'domicilio'=>$datos['domicilio'],
				'f_nac'=>$datos['f_nac']
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

	function addContenido($datos,$ruta)
	{
		$this->db->insert('noticia',$datos);
		if($ruta == './imagenes/Novedades/' || $ruta == './imagenes/Cursos/' || $ruta == './imagenes/Menus/'){
			$ruta = NULL;
		}
		
		if($ruta != NULL)
		{
			$imagen = array(
				'id_noticia'=>$this->db->insert_id(),
				'ruta'=>$ruta
			);
			
			$this->db->insert('imagen',$imagen);
		}
	
	}

	function getContenido($tipo)
	{
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('tipo',$tipo);
		
		$return = $this->db->get();
		$i = 0;
		$res[0]=0;
		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res[$i] = $return->row_array($i);
				$i++;			
			}
		}
		return $res;
	}
	function delContenido($id)
	{
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('id',$id);	
		$this->db->delete();
		
		$this->db->select('*');
		$this->db->from('imagen');
		$this->db->where('id_noticia',$id);
		$this->db->delete();
	}
}
?>