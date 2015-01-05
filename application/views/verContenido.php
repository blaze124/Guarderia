<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php
	$i = 0;
	echo '<h3>Nuevos Contenidos<h3>';
	foreach($res as $valor)
	{
		echo '<div class="Contenido">';
		echo '<center><div class="titulo"><h2>'.$valor['titular'].'</h2></div>';
		echo '<div class="img_cont">'.$valor['ruta'].'</div>'.'<br>';
		echo '<img src="'.$valor['ruta'].'"/>';
		echo '<div class="text_cont"><p>'.$valor['cuerpo'].'</p></div>';
		echo '<div class="text_cont"><p>'.$valor['tipo'].'</p></div>';
		echo '<div class="fecha">'.$valor['fecha'].'</div>';
		echo '</center></div>';
	}
	
?>

</body>
</html>
