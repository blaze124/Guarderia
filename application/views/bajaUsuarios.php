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
	echo '<div class="contenido">';
	echo '<p>Administradores</p>';
	foreach($res1 as $valor)
	{
		echo $valor['nickname'].' - '.$valor['nombre'].' '.$valor['apellidos'].'<a href="'.base_url().'index.php/mainController/borrarUsuario/'.$valor['id'].'/ADMIN"><img src="'.base_url().'imagenes/logo/error.png" style="vertical-align: middle; height:25px; width:25px;"></a>'.'<br>';
	}
	echo '<p>Usuarios para Alumnos</p>';
	foreach($res2 as $valor)
	{
		echo $valor['nickname'].' - '.$valor['nombre'].' '.$valor['apellidos'].'<a href="'.base_url().'index.php/mainController/borrarUsuario/'.$valor['id'].'/ALUM"><img src="'.base_url().'imagenes/logo/error.png" style="vertical-align: middle; height:25px; width:25px;"></a>'.'<br>';
	}
	echo '<p>Profesores</p>';
	foreach($res3 as $valor)
	{
		echo $valor['nickname'].' - '.$valor['nombre'].' '.$valor['apellidos'].'<a href="'.base_url().'index.php/mainController/borrarUsuario/'.$valor['id'].'/PROF"><img src="'.base_url().'imagenes/logo/error.png" style="vertical-align: middle; height:25px; width:25px;"></a>'.'<br>';
	}
	echo '</div>';
?>

</section>

</body>
</html>