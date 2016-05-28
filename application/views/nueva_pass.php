<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='cuerpo'>
<div class="contenido" align="center">
<?php
	$this->load->helper('form');
	
	$datos= array('name'=>'AltaUsuario');
	
	echo form_open('index.php/main_controller/cambio_pass',$datos);
	
	echo'<p>Introduzca su nueva contraseña</p>';
	echo'<p class="comentario">Las contraseñas deben tener entre 8 y 16 caracteres.</p>';

	echo "<input type='password' name='pass1' align='center' placeholder='Nueva contraseña'/>"; echo form_error('pass1'); echo "<br>";
	echo "<input type='password' name='pass2' align='center' placeholder='Repita la nueva contraseña'/>"; echo form_error('pass2'); echo "<br>";
	echo '<br>';
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>

</div>

</section>

</body>
</html>