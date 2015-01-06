<!doctype html>
<html>
<head>
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
<link href="../../CSS/lightbox.css" rel="stylesheet" />
<script src="../../js/jquery-1.11.0.min.js"></script>
<script src="../../js/lightbox.min.js"></script>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php
	$i = 0;
	echo '<center><header class="cabeceras"><h3>Nuevos Contenidos<h3></header><center>';
	foreach($res as $valor)
	{
		echo '<div class="contenido">';
		echo '<center><div class="titulo"><h2>'.$valor['titular'].'</h2></div>';
		$foto = str_replace("C:/xampp/htdocs/","http://localhost/",$valor['ruta']);
		echo '<a href="'.$foto.'" data-lightbox="image-1" data-title="'.$valor['titular'].'"><img src="'.$foto.'"/></a>';
		echo '<div class="text_cont"><p>'.$valor['cuerpo'].'</p></div>';
		echo '<div class="tipo">'.$valor['tipo'].'  - '.$valor['fecha'].'</div>';
		echo '</center></div>';
	}
	
?>
<br><br><br><br><br>
</body>
</html>
