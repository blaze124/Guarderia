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
	
	echo form_open('index.php/main_controller/reinicia_pass');
	
	echo'<p>Introduzca su nombre de usuario</p>';
	echo "<input type='text' name='nombre' align='center' placeholder='Nombre de usuario' />"; echo form_error('nombre'); echo "<br>";
	echo '<br>';
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>

</div>

</section>

</body>
</html>