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
	
	echo form_open('http://localhost/Guarderia/index.php/mainController/AltaUsuario');
	
	echo "Nickname: <input type='text' name='nickname' />";
	echo'<br>';
	echo "Nombre: <input type='text' name='Nombre' />";
	echo '<br>';
	echo "Apellidos: <input type='text' name='Apellidos' />";
	echo '<br>';
	echo "ROL: Administrador <input type='radio'name='ROL' value='ADMIN'/> ";
	echo " Profesor <input type='radio'name='ROL' value='PROF'/> ";
	echo " Alumno <input type='radio'name='ROL' value='ALUM'/> ";
	echo '<br>';
	echo "Domicilio: <input type='text' name='Dom' />"; echo "<br>";
	echo "Fecha de Nacimiento: <input type='date' name='fnac' />";
	echo '<br>';
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>
</section>

</body>
</html>