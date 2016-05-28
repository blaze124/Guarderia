<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class="cuerpo" align="center">
	<h2 class="titulo" >Correo electrónico directo con el usuario</h2>
	
	<?php

		$this->load->helper('form');
		$datos= array('name'=>'sendMailTutor','enctype'=>"multipart/form-data");
		echo form_open('index.php/main_controller/send_mail_tutor',$datos);
	
		echo '<div class="contenido">';

		echo"Asunto:<br><input type='text' size='79' name='asunto'><br>";echo form_error('asunto');
		echo 'Cuerpo:<br><textarea cols="80" rows="10" name="cuerpo"></textarea><br>';echo form_error('cuerpo');
		echo'<input type="hidden" name="user" value="'.$user.'"/>';
		echo form_submit('submit','Enviar');
	
		echo '</div>';

		echo form_close();
	?>
	
</section>

</body>
</html>