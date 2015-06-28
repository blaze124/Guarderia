<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='cuerpo'>
<div class="contenido" align="center">
<?php
	$this->load->helper('form');
	
	$datos= array('name'=>'AltaUsuario');
	
	echo form_open('http://localhost/Guarderia/index.php/mainController/cambioEmail',$datos);
	
	echo '<p>Introduzca su nueva dirección de  email</p>';
	echo "<input type='email' name='email' align='center' />";echo form_error('email'); echo "<br>";
	echo '<br>';
	echo '<input type="hidden" name="id" value='.$id.'>';
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>

</div>

</section>

</body>
</html>