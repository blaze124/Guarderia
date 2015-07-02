<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class="cuerpo" align="center">
	<h2 class="titulo" >Correo electrónico directo con el centro</h2>
	<div class='contenido'>
		<?php
			$this->load->helper('form');
			$datos= array('name'=>'sendMail','enctype'=>"multipart/form-data");
			echo form_open('index.php/mainController/sendMail',$datos);
		
			echo"Asunto:<br><input type='text' size='79' name='asunto'><br>";echo form_error('asunto');
			echo 'Cuerpo:<br><textarea cols="80" rows="10" name="cuerpo"></textarea><br>';echo form_error('cuerpo');
			if(isset($user)){
				echo '<input type="hidden" name="user" value='.$user.'>';
			}
			echo form_submit('submit','Enviar');
		
			echo form_close();
		?>
	</div>
</section>

</body>
</html>