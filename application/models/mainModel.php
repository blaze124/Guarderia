<?php

class MainModel extends CI_Model{
	/**
	* Funcion constructor del modelo de nuestra web
	*/
	function __construct(){
		parent::__construct();
	}	

	/**
	* Funcion que obtiene los datos de sesion de un usuario del sistema
	*/
	function iniciaSesion($datos){
		$this->db->select('*');
		$this->db->from('acceso');
		$this->db->where('nickname',$datos['nickname']);
		$consulta=$this->db->get();
		$res = $consulta->row_array();
		
		return $res;
	}
	
	/**
	* Funcion que obtiene el rol asociado a un usuario del sistema
	*/
	function getRol($usuario){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('nickname',$usuario);
		$consulta=$this->db->get();
		
		if($consulta->num_rows() != 0){
			$res = $consulta->row_array();
			return $res['rol'];
		}
		else{
			$this->db->select('*');
			$this->db->from('usuario_alumno');
			$this->db->where('nickname',$usuario);
			$consulta=$this->db->get();

			$res = $consulta->row_array();
			return $res['rol'];
		}
		
	}
	
	/**
	* Funcion que almacena en la base de datos la informacion asociada a un usuario
	*/
	function altaUser($datos,$pass){
		if($datos['rol'] != 'ALUM'){
			$insert=array(
				'nickname'=>$datos['nickname'],
				'nombre'=>$datos['nombre'],
				'apellidos'=>$datos['apellidos'],
				'rol'=>$datos['rol'],
				'domicilio'=>$datos['domicilio'],
				'f_nac'=>$datos['f_nac'],
				'dni'=>$datos['dni'],
				'email'=>$datos['email'],
				'grupo'=>$datos['grupo']
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
				'f_nac'=>$datos['f_nac'],
				'grupo'=>$datos['grupo']
			);
			$insert2=array(				
				'nickname'=>$datos['nickname'],
				'nombre'=>$datos['nombreT'],
				'apellidos'=>$datos['apellidosT'],
				'dni'=>$datos['dni_t'],
				'email'=>$datos['email_t'],
				'telefono'=>$datos['telefono']
			);
			$insert3=array(				
				'nickname'=>$datos['nickname'],
				'nombre'=>$datos['nombreT2'],
				'apellidos'=>$datos['apellidosT2'],
				'dni'=>$datos['dni_t2'],
				'email'=>$datos['email_t2'],
				'telefono'=>$datos['telefono2']
			);
			$insert4=array(
				'nickname'=>$datos['nickname'],
				'horario'=>$datos['horario'],
				'pago'=>$datos['pago'],
				'fotos'=>$datos['fotos'],
				'observaciones'=>$datos['observaciones']
			);
			
			$this->db->insert('usuario_alumno',$insert);
			$this->db->insert('tutor',$insert2);
			if ($insert3['nombre'] != null) {
				$this->db->insert('tutor',$insert3);
			}
			
			$this->db->insert('datosalum',$insert4);
		}
		$acceso=array('nickname'=>$datos['nickname'], 'password' => $pass);
		$this->db->insert('acceso',$acceso);
	}

	/**
	* Funcion que permite añadir contenidos al sistema
	*/
	function addContenido($datos){
		$this->db->insert('noticia',$datos);
		
		return $this->db->insert_id();
	}
	
	/**
	* Funcion que almacena la ruta de una imagen asociada a una noticia en la base de datos
	*/
	function addImagen($id,$ruta){
		$datos = array(
			'id_noticia' => $id,
			'ruta' => $ruta
		);
		
		$this->db->insert('imagen',$datos);
	}

	/**
	* Funcion que nos selecciona todos los contenidos de un tipo determinado por $tipo
	*/
	function getContenido($tipo){
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
	
	/**
	* Funcion que nos selecciona todos los contenidos de un tipo determinado por $tipo y que ademas sean publicos
	*/
	function getContenidoPub($tipo){
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('tipo',$tipo);
		$this->db->where('privilegios','PUBLICO');
		
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
	
	/**
	* Funcion que obtiene el contenido de la base de datos que tenga como identificador el valor $id
	*/
	function getContenidoSimple($id){
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('noticia.id',$id);
		$this->db->where('tipo','NOV');
		$this->db->or_where('tipo','CUR');
		$this->db->order_by('noticia.id','desc');
		$this->db->limit(5);
		$return = $this->db->get();
		$i = 0;
		$res[0]=0;
		$res1[0]=0;
		$res2[0]=0;
		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res1[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[0] = $res1;
	
		$vec = array();
		$i=0;

		foreach($res1 as $valor){
			array_push($vec, $valor['id']);
		}

		$a = min($vec);
		$b = max($vec);

		$this->db->select('*');
		$this->db->from('imagen');
		$this->db->where('id_noticia <=', $b);
		$this->db->where('id_noticia >=', $a);

		$return = $this->db->get();

		$i = 0;

		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res2[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[1] = $res2;

		return $res;
	}
	
	/**
	* Funcion que nos carga los contenidos más recientes para mostrarselos a los usuarios
	*/
	function verContenido(){
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('tipo','NOV');
		$this->db->or_where('tipo','CUR');
		$this->db->order_by('noticia.id','desc');
		$this->db->limit(5);
		
		$return = $this->db->get();
		$i = 0;
		$res[0]=0;
		$res1[0]=0;
		$res2[0]=0;
		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res1[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[0] = $res1;
	
		$vec = array();
		$i=0;

		foreach($res1 as $valor){
			array_push($vec, $valor['id']);
		}

		$a = min($vec);
		$b = max($vec);

		$this->db->select('*');
		$this->db->from('imagen');
		$this->db->where('id_noticia <=', $b);
		$this->db->where('id_noticia >=', $a);

		$return = $this->db->get();

		$i = 0;

		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res2[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[1] = $res2;

		return $res;
	
	}
	
	/**
	* Funcion que nos carga los contenidos más recientes para mostrarselos a los usuarios no registrados en el sistema
	*/
	function verContenidoPub(){
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('privilegios','PUBLICO');
		$this->db->where('tipo','NOV');
		$this->db->or_where('tipo','CUR');
		$this->db->order_by('noticia.id','desc');
		$this->db->limit(5);
		
		$return = $this->db->get();
		$i = 0;
		$res[0]=0;
		$res1[0]=0;
		$res2[0]=0;
		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res1[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[0] = $res1;
	
		$vec = array();
		$i=0;

		foreach($res1 as $valor){
			array_push($vec, $valor['id']);
		}

		$a = min($vec);
		$b = max($vec);

		$this->db->select('*');
		$this->db->from('imagen');
		$this->db->where('id_noticia <=', $b);
		$this->db->where('id_noticia >=', $a);

		$return = $this->db->get();

		$i = 0;

		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res2[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[1] = $res2;

		return $res;
	}
	
	/**
	* Funcion que elimina una noticia del sistema y elimina todas las imagenes asociadas a estas noticias
	*/
	function delContenido($id){	
		$this->db->select('*');
		$this->db->from('imagen');
		$this->db->where('id_noticia',$id);
		$consulta = $this->db->get();
				
		foreach($consulta->result_array() as $valor)
		{
			unlink($valor['ruta']);
		}
	
		$this->db->delete('noticia',array('id'=>$id));
		
		$this->db->delete('imagen',array('id_noticia'=>$id));
	}

	/**
	* Funcion que elimina una incidencia y sus comentarios del sistema
	*/
	function delIncidencia($id){	
		
		$this->db->delete('incidencia',array('id'=>$id));
		
		$this->db->delete('comentario',array('incidencia'=>$id));
	}
	
	/**
	* Funcion que carga el menu mensual más reciente introducido en el sistema
	*/
	function verMenusMens(){
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('tipo','COM');
		$this->db->order_by('noticia.id','desc');
		$this->db->limit(5);
		
		$return = $this->db->get();
		$i = 0;
		$res[0]=0;
		$res1[0]=0;
		$res2[0]=0;
		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res1[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[0] = $res1;
	
		$vec = array();
		$i=0;

		foreach($res1 as $valor){
			array_push($vec, $valor['id']);
		}

		$a = min($vec);
		$b = max($vec);

		$this->db->select('*');
		$this->db->from('imagen');
		$this->db->where('id_noticia <=', $b);
		$this->db->where('id_noticia >=', $a);

		$return = $this->db->get();

		$i = 0;

		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res2[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[1] = $res2;

		return $res;
	}
	
	/**
	* Funcion que carga el menu mensual indicado con el identificador $id
	*/
	function verMenusMensId($id){
		$this->db->select('*');
		$this->db->from('noticia');
		$this->db->where('id',$id);
		$this->db->where('tipo','COM');
		$this->db->order_by('noticia.id','desc');
		$this->db->limit(5);
		
		$return = $this->db->get();
		$i = 0;
		$res[0]=0;
		$res1[0]=0;
		$res2[0]=0;
		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res1[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[0] = $res1;
	
		$vec = array();
		$i=0;

		foreach($res1 as $valor){
			array_push($vec, $valor['id']);
		}

		$a = min($vec);
		$b = max($vec);

		$this->db->select('*');
		$this->db->from('imagen');
		$this->db->where('id_noticia <=', $b);
		$this->db->where('id_noticia >=', $a);

		$return = $this->db->get();

		$i = 0;

		if($return->num_rows() != 0){
			while($i < $return->num_rows())
			{
				$res2[$i] = $return->row_array($i);
				$i++;			
			}
		}

		$res[1] = $res2;

		return $res;
	}

	/**
	* Funcion que obtiene los datos de todos los usuarios del sistema en funcion de su rol
	*/
	function getUsuarios($rol){
		if($rol == 'ALUM'){
			$this->db->select('*');
			$this->db->from('usuario_alumno');
			$this->db->order_by('usuario_alumno.id','asc');
			
			$return = $this->db->get();
		}
		else{
			$this->db->select('*');
			$this->db->from('usuario');
			$this->db->where('rol',$rol);
			$this->db->order_by('usuario.id','asc');
			
			$return = $this->db->get();
		}
		
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

	/**
	* Funcion que elimina al usuario del sistema con identificador = $id
	*/
	function bajaUsuario($id,$rol){
		if($rol != 'ALUM'){
			$this->db->select('*');
			$this->db->from('usuario');
			$this->db->where('id',$id);

			$ret = $this->db->get();
			$res = $ret->row_array();

			$this->db->delete('acceso',array('nickname'=>$res['nickname']));
			$this->db->delete('usuario',array('id'=>$res['id']));
		}
		else{
			$this->db->select('*');
			$this->db->from('usuario_alumno');
			$this->db->where('id',$id);
			
			$ret = $this->db->get();
			$res = $ret->row_array();

			$this->db->delete('tutor',array('nickname'=>$res['nickname']));
			$this->db->delete('acceso',array('nickname'=>$res['nickname']));
			$this->db->delete('datosalum',array('nickname'=>$res['nickname']));
			$this->db->delete('usuario_alumno',array('id'=>$res['id']));
		}
	}

	/**
	* Funcion que obtendra toda la informacion de un usuario para mostrarsela
	*/
	function datosUsuario($user,$rol){
		if($rol != 0){
			$this->db->select('*');
			$this->db->from('usuario');
			$this->db->where('nickname',$user);
			
			$res = $this->db->get();
			return $res->row_array();
		}
		else{
			$this->db->select('*');
			$this->db->from('usuario_alumno');
			$this->db->where('nickname',$user);
			
			$res = $this->db->get();
			return $res->row_array();
		}
	}
	
	/**
	* Funcion que obtendra toda la informacion del tutor asociado a un alumno para mostrarsela
	*/
	function datosTutor($user){
		$this->db->select('*');
		$this->db->from('tutor');
		$this->db->where('nickname',$user);
		$this->db->order_by('tutor.id','asc');
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

	/**
	* Funcion que actualiza el domicilio de un usuario
	*/
	function cambioDom($data,$rol){
		$cambio = array('domicilio'=>$data['domicilio']);
		
		if($rol != 0){
			$this->db->where('nickname',$data['nickname']);
			$this->db->update('usuario',$cambio);
		}
		else{
			$this->db->where('nickname',$data['nickname']);
			$this->db->update('usuario_alumno',$cambio);
		}	
	}
	
	/**
	* Funcion que actualiza la direccion de email de un usuario
	*/
	function cambioEmail($data){
		$cambio = array('email'=>$data['email']);
		
		if($data['rol'] == '0'){
			$this->db->where('id',$data['id']);
			$this->db->update('tutor',$cambio);
		}
		else{
			$this->db->where('id',$data['id']);
			$this->db->update('usuario',$cambio);
		}
	}

	/**
	* Funcion que actualiza la contraseña de un usuario
	*/
	function cambioPass($data){
		$cambio = array('password'=>$data['password']);
		
		$this->db->where('nickname',$data['nickname']);
		$this->db->update('acceso',$cambio);
	}

	/**
	* Funcion que buscara a todos los alumnos que contenga una cadena de caracteres en su nombre de usuario
	*/
	function buscaUsuarios( $cadena,$usuario=null){
		if(!isset($usuario)){
			$this->db->select('*');
			$this->db->from('usuario_alumno');
			$this->db->like('nickname',$cadena,'both');
			$return =$this->db->get();
				
		}
		else{
		
			$this->db->select('*');
			$this->db->from('usuario');
			$this->db->where('nickname',$usuario);
			$tutor =$this->db->get()->row_array();

			$this->db->select('*');
			$this->db->from('usuario_alumno');
			$this->db->where('grupo',$tutor['grupo']);
			$this->db->like('nickname',$cadena,'both');
			$return =$this->db->get();
		}
		
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

	/**
	* Función que buscará los datos de todos los alumnos
	*/
	function getAlumnos(){
		$this->db->select('*');
		$this->db->from('usuario_alumno');
		$this->db->order_by('usuario_alumno.id','asc');
		
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
	
	/**
	* Función que buscará los datos de un único alumno
	*/
	function getAlumno($id){
		$this->db->select('*');
		$this->db->from('usuario_alumno');
		$this->db->where('id',$id);
		
		$res[0] = $this->db->get()->row_array();
		
		$this->db->select('*');
		$this->db->from('tutor');
		$this->db->where('nickname',$res[0]['nickname']);
		$this->db->order_by('id','asc');
		
		$return = $this->db->get();
		
		$i = 1;
		$j = 0;
		$res[1]=0;
		if($return->num_rows() != 0){
			while($j < $return->num_rows())
			{
				$res[$i] = $return->row_array($j);
				$i++;
				$j++;
			}
		}
		
		$this->db->select('*');
		$this->db->from('datosalum');
		$this->db->where('nickname',$res[0]['nickname']);
		
		$res[$i]=$this->db->get()->row_array();
		
		return $res;
	}

	/**
	* Función que almacenará una incidencia en la tabla eventos
	*/
	function addInc($cuerpo){
		
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('nickname',$_SESSION['user']);
		
		$ret = $this->db->get()->row_array();

		$grupo = $ret['grupo'];

		$data = array(
			'fecha' => date('Y-m-d'),
			'cuerpo' => $cuerpo,
			'grupo' => $grupo);

		$this->db->insert('incidencia',$data);
	}

	/**
	* Función que nos devolverá todas las incidencias del mes del año seleccionado
	*/
	function incidencias_mens($anno,$mes){

		$fecha = $anno.'-'.$mes;
		
		if($_SESSION['rol'] != 2){
			if($_SESSION['rol'] == 1){
				$this->db->select('*');
				$this->db->from('usuario');
				$this->db->where('nickname',$_SESSION['user']);
			}
			elseif($_SESSION['rol'] == 0){
				$this->db->select('*');
				$this->db->from('usuario_alumno');
				$this->db->where('nickname',$_SESSION['user']);
			}

			$ret = $this->db->get()->row_array();

			$grupo = $ret['grupo'];

			$this->db->select('*');
			$this->db->from('incidencia');
			$this->db->like('fecha',$fecha,'after');
			$this->db->where('grupo',$grupo);

			$return = $this->db->get();

			$i=0;
			$j=0;
			$res = array();
			if($return->num_rows() != 0){
				while($j < $return->num_rows())
				{
					$res[$i] = $return->row_array($i);
					$i++;
					$j++;
				}
			}
		}
		else{
			$this->db->select('*');
			$this->db->from('incidencia');
			$this->db->like('fecha',$fecha,'after');

			$return = $this->db->get();

			$i=0;
			$j=0;
			$res = array();
			if($return->num_rows() != 0){
				while($j < $return->num_rows())
				{
					$res[$i] = $return->row_array($i);
					$i++;
					$j++;
				}
			}
		}
		return $res;
	}

	/**
	* Función que nos devolverá la incidencia con la id seleccionada
	*/
	function getIncidencia($id){
		$this->db->select('*');
		$this->db->from('incidencia');
		$this->db->where('id',$id);

		return $ret = $this->db->get()->row_array();
	}

	/**
	* Función que nos devolverá la información de todas las incidencias registradas
	*/
	function getIncidencias(){
		$this->db->select('*');
		$this->db->from('incidencia');
		
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

	/**
	* Funcion que nos almacenará en la base de datos los comentarios que realicen los tutores
	*/
	function addCom($datos){
		$this->db->insert('comentario',$datos);
	}

	/**
	* Función que nos devolverá los comentarios de los tutores a la incidencia con id equivalente al parámetro
	*/
	function getComentarios($id){
		$this->db->select('*');
		$this->db->from('comentario');
		$this->db->where('incidencia',$id);

		$return = $this->db->get();

		$i=0;
		$j=0;
		$res=array();
		if($return->num_rows() != 0){
			while($j < $return->num_rows())
			{
				$res[$i] = $return->row_array($i);
				$i++;
				$j++;
			}
		}
		
		return $res;
	}

	/**
	* Función que nos devolverá la información de todos los tutores dados de alta para enviarles un mensaje difundido
	* Si se especifica un grupo solo se seleccionarán los tutores cuyo hijo pertenezca ese grupo
	*/
	function getTutores($grupo){

		if(!isset($grupo)){
			$this->db->select('*');
			$this->db->from('tutor');
			$return = $this->db->get();

			$i=0;
			$j=0;
			$res=array();
			if($return->num_rows() != 0){
				while($j < $return->num_rows())
				{
					$res[$i] = $return->row_array($i);
					$i++;
					$j++;
				}
			}
			
			return $res;
		}
		else{
			$this->db->select('*');
			$this->db->from('usuario_alumno');
			$this->db->where('grupo',$grupo);
			$return1 = $this->db->get()->row_array();

			$this->db->select('*');
			$this->db->from('tutor');
			$this->db->where('nickname',$return1['nickname']);
			$return = $this->db->get();

			$i=0;
			$j=0;
			$res=array();
			if($return->num_rows() != 0){
				while($j < $return->num_rows())
				{
					$res[$i] = $return->row_array($i);
					$i++;
					$j++;
				}
			}
			
			return $res;
		}
	}

	/**
	* Función auxiliar que nos devolverá el grupo de un profesor
	*/
	function getGrupo($nickname){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('nickname',$nickname);
		$return = $this->db->get()->row_array();

		return $return['grupo'];
	}
}
?>