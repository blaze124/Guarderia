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
	
	echo form_open('http://localhost/Guarderia/index.php/mainController/Acceder');
	
	echo "Usuario: <input type='text' name='user' />";echo form_error('user');echo '<br>';
	echo "Contraseña: <input type='password' name='pass' />";echo form_error('pass');echo '<br>';
	echo form_submit('submit','Login');
	
	echo form_close();
?>
</section>

</body>
</html>