<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='formulario'>

<?php
	$this->load->helper('form');
	
	$datos= array('name'=>'AltaUsuario');
	
	echo form_open('http://localhost/Guarderia/index.php/mainController/cambioPass',$datos);
	
	echo'<p>Introduzca su nueva contraseña</p>';
	echo'<p class="comentario">Las contraseñas deben tener entre 8 y 16 caracteres.</p>';

	echo "Nueva contraseña:<input type='password' name='pass1' align='center' />"; echo form_error('pass1'); echo "<br>";
	echo "Repita la nueva contraseña:<input type='password' name='pass2' align='center' />"; echo form_error('pass2'); echo "<br>";
	echo '<br>';
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>
</section>

</body>
</html>