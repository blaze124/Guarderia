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
		echo $valor['fecha'].' - '.$valor['titular'].'<a href="http://localhost/Guarderia/index.php/mainController/verContenidoSimple/'.$valor['id'].'"><img src="http://localhost/Guarderia/imagenes/logo/ir.png" style="vertical-align: middle;"></a>'.'<br>';
	}
	echo '<p>Cursos</p>';
	foreach($res2 as $valor)
	{
		echo $valor['fecha'].' - '.$valor['titular'].'<a href="http://localhost/Guarderia/index.php/mainController/verContenidoSimple/'.$valor['id'].'"><img src="http://localhost/Guarderia/imagenes/logo/ir.png" style="vertical-align: middle;"></a>'.'<br>';
	}
	
?>

</section>

</body>
</html>