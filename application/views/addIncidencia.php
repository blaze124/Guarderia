<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">

</head>

<body>

<section class="cuerpo">
<?php
	$this->load->helper('form');
	$datos= array('name'=>'addInc','enctype'=>"multipart/form-data");
	echo form_open('index.php/mainController/addInc',$datos);
	
	echo "<p>Qué ha sucedido hoy</p>";
	echo '<textarea cols="100" rows="20" name="cuerpo"></textarea><br>';
	
	echo form_submit('submit','Aceptar');
	echo form_close();

	echo '<a href="'.base_url().'index.php/mainController/incidencias"><button>Volver</button></a>';
?>
<br><br><br><br><br><br>
</section>

</body>
</html>