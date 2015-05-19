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
	echo '<div class="titulo"><h2>Qué hemos hecho hoy</h2></div>';
	echo $incidencia['cuerpo'];
	echo '<div class="titulo"><h2>Comentarios</h2></div>';
	foreach($comentarios as $valor)
	{
		echo '<p>'.$valor['cuerpo'].'</p>';
	}
	
?>

</section>

</body>
</html>