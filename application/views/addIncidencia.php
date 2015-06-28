<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">

</head>

<body>

<section class="cuerpo">
<?php
	$this->load->helper('form');
	$datos= array('name'=>'addInc','enctype'=>"multipart/form-data");
	echo form_open('index.php/mainController/addInc',$datos);
	
	echo '<div class="contenido" align="center">';

	echo "<p>Qué ha sucedido hoy</p>";
	echo '<textarea cols="100" rows="15" name="cuerpo"></textarea><br>';
	
	echo form_submit('submit','Aceptar');
	echo form_close();

	echo '</div>';

?>
<br><br><br><br><br><br>
</section>

</body>
</html>