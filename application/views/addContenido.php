<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">

</head>

<body>

<section class="formulario">
<?=validation_errors('<div class="errores">','</div>'); ?>
<?php
	$this->load->helper('form');
	$datos= array('name'=>'agregaCont','enctype'=>"multipart/form-data");
	echo form_open('index.php/mainController/agregaCont',$datos);
	
	echo "<p>Tipo de noticia</p>";
	echo "Novedades<input type='radio' name='tipo' value='NOV'  checked/> ";
	echo " Cursos para padres<input type='radio' name='tipo' value='CUR' /> ";
	echo " Menus mensuales<input type='radio' name='tipo' value='COM' /><br> ";
	
	echo "Pública<input type='radio' name='priv' value='PUBLICO'  checked/> ";
	echo " Privada<input type='radio' name='priv' value='PRIVADO' /><br> ";
	
	echo "<p>Título</p>";
	echo "<input type='text' name='titulo' /><br>";
	
	echo "<p>Cuerpo</p>";
	echo '<textarea cols="100" rows="10" name="cuerpo"></textarea><br>';
	
	echo "<p>Insertar imágenes</p>";
	echo '<input type="file" name="userfile" /><br>';
	
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>

</section>

</body>
</html>