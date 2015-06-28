<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>


<body>

<section class='cuerpo'>

<?php
	$i = 0;
	echo '<div class="titulo" align="center"><h2>Qué hemos hecho hoy</h2></div>';
	echo '<div class="contenido"><p align="center">'.$incidencia['cuerpo'].'</p></div>';
	echo '<div class="titulo" align="center"><h2>Comentarios</h2></div>';
	foreach($comentarios as $valor)
	{	
		echo '<div class="contenido">';
		echo '<p><b>Usuario</b>: '.$valor['nickname'].'</p>';
		echo '<p>'.$valor['cuerpo'].'</p>';
		echo '</div>';
	}
	if($_SESSION['rol'] == 0){
		echo '<a href="'.base_url().'index.php/mainController/addComentario/'.$id.'"><div align="center"><button>Añadir comentario</button></div></a>';
	}
?>

</section>

</body>
</html>