<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>
<body>

<section class='cuerpo'>
<?php
	$this->load->helper('form');
	
	echo form_open(base_url().'index.php/main_controller/acceder');
	echo '<div class="contenido" align="center">';
	echo "<input type='text' name='user' placeholder=' Usuario'/>";echo form_error('user');echo '<br>';
	echo "<input type='password' name='pass' placeholder=' Contraseña'/>";echo form_error('pass');echo '<br>';
	echo form_submit('submit','Login');
	echo "<p>Si ha olvidado su contraseña, pulse <a href='".base_url()."index.php/main_controller/reset_pass'> aquí </a></p>";
	echo '</div>';
	echo form_close();
?>
</section>

</body>
</html>