<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='formulario'>
<?=validation_errors('<div class="errores">','</div>'); ?>
<?php
	$this->load->helper('form');
	
	$datos= array('name'=>'AltaUsuario');
	
	echo form_open('http://localhost/Guarderia/index.php/mainController/cambioDom',$datos);
	
	echo'<p>Introduzca su nuevo domicilio</p>';
	echo "<input type='text' name='Dom' align='center' />"; echo form_error('Dom'); echo "<br>";
	echo '<br>';
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>
</section>

</body>
</html>