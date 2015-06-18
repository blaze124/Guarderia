<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>


<body>

<section class='cuerpo'>

<?php
	$i = 0;
	echo '<p>Novedades</p>';
	foreach($res1 as $valor)
	{
		echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/mainController/borrarContenido/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/error.png" style="vertical-align: middle;"></a>'.'<br>';
	}
	echo '<p>Cursos</p>';
	foreach($res2 as $valor)
	{
		echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/mainController/borrarContenido/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/error.png" style="vertical-align: middle;"></a>'.'<br>';
	}
	echo '<p>Menus mensuales</p>';
	foreach($res3 as $valor)
	{
		echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/mainController/borrarContenido/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/error.png " style="vertical-align: middle;"></a>'.'<br>';
	}
?>

</section>

</body>
</html>