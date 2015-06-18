<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class="cuerpo" align="center">
	<h2 class="titulo" >Búsqueda de usuarios para contactar<br> por correo electrónico</h2>
	
	<?php
		$this->load->helper('form');
		$datos= array('name'=>'buscaUsuarios','enctype'=>"multipart/form-data");
		echo form_open('index.php/mainController/buscaUsuarios',$datos);
	
		echo"<br><input type='text' size='50' name='busqueda'><br>";echo form_error('busqueda');
		
		echo form_submit('submit','Buscar');
		
		if( isset($res) ){
			echo'<br><br>';

			foreach ($res['0'] as $valor){
				echo '<b>Usuario:</b> '.$valor['nickname'];
				echo'<a href="'.base_url().'index.php/mainController/mailTutor/'.$valor['nickname'].'"><img src="'.base_url().'imagenes/logo/ir.png" style="vertical-align: middle;"></a>';
				echo'<br>';
			}
		}
	
		echo form_close();
	?>
	
</section>

</body>
</html>