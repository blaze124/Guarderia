<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">

</head>

<body>

<section class="cuerpo">
<?php
	$this->load->helper('form');
	$datos= array('name'=>'agrega_cont','enctype'=>"multipart/form-data");
	echo form_open('index.php/main_controller/agrega_cont',$datos);
	
	echo '<div class="contenido" align="center">';

	echo "<p>Tipo de noticia</p>";
	if($_SESSION['rol']==2){
		echo "Novedades<input type='radio' name='tipo' value='NOV'  checked/> ";
		echo " Escuela de padres<input type='radio' name='tipo' value='CUR' /> ";
		echo " Menús mensuales<input type='radio' name='tipo' value='COM' /><br> ";
	}
	else{
		echo " Cursos para padres<input type='radio' name='tipo' value='CUR' checked /><br>";
	}
	
	echo "Público<input type='radio' name='priv' value='PUBLICO' /> ";
	echo " Privado<input type='radio' name='priv' value='PRIVADO' checked/><br> ";
	
	echo "<p>Título</p>";
	echo "<input type='text' name='titulo' />"; echo form_error('titulo'); echo"<br>";
	
	echo "<p>Cuerpo</p>";
	echo '<textarea cols="80" rows="20" name="cuerpo"></textarea><br>';
	
	echo "<p>Insertar imágenes</p>";
	echo '<input type="file" name="userfile[]" multiple /><br>';
	
	echo form_submit('submit','Aceptar');
	
	echo '</div>';

	echo form_close();
?>
<br><br><br><br><br><br>
</section>

</body>
</html>