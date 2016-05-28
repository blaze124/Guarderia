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
	
	echo form_open('index.php/main_controller/modifica_usuario');
	
	echo'<p>Modifique los datos que desee</p>';
	echo "<input type='text' name='nombre' align='center' placeholder='Nombre usuario' value=".$usuario['nombre']." />"; echo form_error('nombre'); echo "<br>";
	echo "<input type='text' name='apellidos' align='center' placeholder='Apellidos usuario' value='".$usuario['apellidos']."' />"; echo form_error('apellidos'); echo "<br>";
	echo "<input type='hidden' name='id_usuario' value=".$usuario['id']." />";
	echo '<br>';
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>

</div>

</section>

</body>
</html>