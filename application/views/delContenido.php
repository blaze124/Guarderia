<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>


<body>

<section class='cuerpo'>

<?php
	$i = 0;
	echo '<p>Novedades</p>';
	foreach($res1 as $valor)
	{
		
		echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<br>';
	}
	echo '<p>Cursos</p>';
	foreach($res2 as $valor)
	{
		echo $valor.'<br>';
	}
	echo '<p>Menus mensuales</p>';
	foreach($res3 as $valor)
	{
		echo $valor.'<br>';
	}
?>

</section>

</body>
</html>