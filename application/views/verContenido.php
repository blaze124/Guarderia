<!doctype html>
<html>
<head>
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php
	$i = 0;
	echo '<h3>Nuevos Contenidos<h3>';
	foreach($res as $valor)
	{
		echo '<div class="contenido">';
		echo '<center><div class="titulo"><h2>'.$valor['titular'].'</h2></div>';
		echo '<div class="img_cont">'.$valor['ruta'].'</div>';
		echo '<img src="'.$valor['ruta'].'"/>';
		echo '<div class="text_cont"><p>'.$valor['cuerpo'].'</p></div>';
		echo '<div class="tipo">'.$valor['tipo'].'</div>';
		echo '<div class="fecha">'.$valor['fecha'].'</div>';
		echo '</center></div>';
	}
	
?>

</body>
</html>
