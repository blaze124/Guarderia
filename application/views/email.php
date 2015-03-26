<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class="cuerpo" align="center">
	<h2 class="titulo" >Correo electrónico directo con el centro</h2>
	
	<?php
		$this->load->helper('form');
		$datos= array('name'=>'sendMail','enctype'=>"multipart/form-data");
		echo form_open('index.php/mainController/sendMail',$datos);
	
		echo"Asunto:<br><input type='text' size='79' name='asunto'><br>";echo form_error('asunto');
		echo 'Cuerpo:<br><textarea cols="80" rows="10" name="cuerpo"></textarea><br>';echo form_error('cuerpo');
		
		echo form_submit('submit','Enviar');
	
		echo form_close();
	?>
	
</section>

</body>
</html>