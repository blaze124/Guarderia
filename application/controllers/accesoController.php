<!doctype html>
<?php
session_start();

class AccesoController extends CI_Controller{
	
	function index()
	{
		$this->load->view('cabecera');;
		$this->load->view('menu');
		$this->load->view('acceso');
		$this->load->view('pie_pag');
	}
	
	function acceder()
	{
		$this->load->database();
		$this->load->model('mainModel');
		
		if($this->input->post('submit'))
		{
			if(($this->input->post('user') == '')|| ($this->input->post('pass') == ''))
			{
				//mostrar error por entrar sin usuario
				header('location: http://localhost/Guarderia');
			}
			else
			{
				$usuario=$this->input->post('user');
				$pass=$this->input->post('pass');
				
				$consulta = $this->mainModel->iniciaSesion($usuario);
				
				if($consulta == FALSE)
				{
					//Mensaje de error por inventarse usuario
					header('location: http://localhost/Guarderia');
				}
				else
				{
					$row = $consulta->row();
					if( ($row['nickname'] == $usuario)&&( password_verify($pass,$row['password'])) )
					{
						$rol=$this->mainModel->getRol($rol['nickname']);
						if($rol == 'ALUM'){$_SESSION['rol']=0;}
						if($rol == 'PROF'){$_SESSION['rol']=1;}
						if($rol == 'ADMIN'){$_SESSION['rol']=2;}
					}
					header('location: http://localhost/Guarderia');
				}
			}
		}
	}
}

?>