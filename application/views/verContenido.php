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

	if(!isset($_SESSION['rol'])){
		for($i=0; $i < count($res);$i++){
			if($res[$i]['privilegios'] == 'PRIVADO'){
				unset($res[$i]);
			}
		}
	}
	
	$res=array_values($res);
	
	if(isset($id)){
		for($i=0; $i < count($res);$i++){
			if($res[$i]['id'] != $id){
				unset($res[$i]);
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
			echo '<a href="'.$foto.'" data-lightbox="image-1" data-title="'.$valor['titular'].'"><img class="img_cont" src="'.$foto.'"/></a>';
		}
		
		if($valor['tipo'] == 'NOV'){$tipo = 'Novedades';}
		else{$tipo = 'Escuela de padres';}
		
		echo '<div class="tipo">'.$tipo.' - '.$valor['fecha'].'</div>';
		echo '</center></div>';
	}
	
	echo '<a href="http://localhost/Guarderia/index.php/mainController/todoContenido"><p align="center">Ver todas las noticias</p></a>';
?>

	
</section>
</body>
</html>
