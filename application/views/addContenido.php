<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">

</head>

<body>

<section class="formulario">
<?php
	$this->load->helper('form');
	$datos= array('name'=>'agregaCont','enctype'=>"multipart/form-data");
	echo form_open('index.php/mainController/agregaCont',$datos);
	
	echo "<p>Tipo de noticia</p>";
	if($_SESSION['rol']==2){
		echo "Novedades<input type='radio' name='tipo' value='NOV'  checked/> ";
		echo " Escuela de padres<input type='radio' name='tipo' value='CUR' /> ";
		echo " Menús mensuales<input type='radio' name='tipo' value='COM' /><br> ";
	}
	else{
		echo " Cursos para padres<input type='radio' name='tipo' value='CUR' checked /><br>";
	}
	
	echo "Público<input type='radio' name='priv' value='PUBLICO'  checked/> ";
	echo " Privado<input type='radio' name='priv' value='PRIVADO' /><br> ";
	
	echo "<p>Título</p>";
	echo "<input type='text' name='titulo' />"; echo form_error('titulo'); echo"<br>";
	
	echo "<p>Cuerpo</p>";
	echo '<textarea cols="100" rows="20" name="cuerpo"></textarea><br>';
	
	echo "<p>Insertar imágenes</p>";
	echo '<input type="file" name="userfile[]" multiple /><br>';
	
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>
<br><br><br><br><br><br>
</section>

</body>
</html>