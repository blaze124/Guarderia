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
	echo '<p>Administradores</p>';
	foreach($res1 as $valor)
	{
		echo $valor['id'].' - '.$valor['nickname'].' - '.$valor['nombre'].' '.$valor['apellidos'].' - '.$valor['email'].'<a href="http://localhost/Guarderia/index.php/mainController/borrarUsuario/'.$valor['id'].'"><img src="http://localhost/Guarderia/imagenes/logo/error.png" style="vertical-align: middle;"></a>'.'<br>';
	}
	echo '<p>Usuarios para Alumnos</p>';
	foreach($res2 as $valor)
	{
		echo $valor['id'].' - '.$valor['nickname'].' - '.$valor['nombre'].' '.$valor['apellidos'].' - '.$valor['email'].'<a href="http://localhost/Guarderia/index.php/mainController/borrarUsuario/'.$valor['id'].'"><img src="http://localhost/Guarderia/imagenes/logo/error.png" style="vertical-align: middle;"></a>'.'<br>';
	}
	echo '<p>Profesores</p>';
	foreach($res3 as $valor)
	{
		echo $valor['id'].' - '.$valor['nickname'].' - '.$valor['nombre'].' '.$valor['apellidos'].' - '.$valor['email'].'<a href="http://localhost/Guarderia/index.php/mainController/borrarUsuario/'.$valor['id'].'"><img src="http://localhost/Guarderia/imagenes/logo/error.png" style="vertical-align: middle;"></a>'.'<br>';
	}
?>

</section>

</body>
</html>