<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='cuerpo'>
<div class="contenido" align="center">
<?=validation_errors('<div class="errores">','</div>'); ?>
<?php
	$this->load->helper('form');
	
	$datos= array('name'=>'AltaUsuario');
	
	echo form_open('index.php/main_controller/cambio_dom',$datos);
	
	echo'<p>Introduzca su nuevo domicilio</p>';
	echo "<input type='text' name='Dom' align='center' />"; echo form_error('Dom'); echo "<br>";
	echo '<br>';
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>

</div>

</section>

</body>
</html>