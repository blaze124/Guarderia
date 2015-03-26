<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
<link href="http://localhost/Guarderia/css/lightbox.css" rel="stylesheet" />
<script src="http://localhost/Guarderia/js/jquery-1.11.0.min.js"></script>
<script src="http://localhost/Guarderia/js/lightbox.min.js"></script>
</head>

<body>
<section class="cuerpo">

	<?php
	$i = 0;
	$t = count($res);
	for($i = 0; $i < $t; $i++)
	{
		$r = $res[$i]['ruta'];
		$res[$i]['ruta'] = array($r);
		
		$j = $i+1;
		
		while($j < $t)
		{
			if($res[$i]['id'] == $res[$j]['id'])
			{
				$res[$i]['ruta'][] = $res[$j]['ruta'];
				unset($res[$j]);
				$res = array_values($res);
				$t--;
			}
			else
			{
				$j++;
			}
		}
	}

	foreach($res as $valor)
	{		
		echo '<div class="contenido">';
		echo '<center><div class="titulo"><h2>'.$valor['titular'].'</h2></div>';

		echo '<div class="text_cont"><p>'.$valor['cuerpo'].'</p></div>';

		echo'<p class="comentario">**Click sobre la imagen para ver en tamaño completo**</p>';
		
		foreach($valor['ruta'] as $img){
			$foto = str_replace("C:/xampp/htdocs/","http://localhost/",$img);
			echo '<a href="'.$foto.'" data-lightbox="image-1" data-title="'.$valor['titular'].'"><img src="'.$foto.'"/></a>';
		}
		
		if($valor['tipo'] == 'NOV'){$tipo = 'Novedades';}
		else{$tipo = 'Cursos';}
		
		echo '<div class="tipo">'.$valor['fecha'].'</div>';
		echo '</center></div>';
	}
	
	echo '<a href="http://localhost/Guarderia/index.php/mainController/todoMenus"><p align="center">Ver los menús de otros meses</p></a>';
?>
</section>
</body>
</html>