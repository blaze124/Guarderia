<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url()?>css/lightbox.css" rel="stylesheet" />
<script src="<?php echo base_url()?>js/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url()?>js/lightbox.min.js"></script>
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

		echo '<div><p>'.$valor['cuerpo'].'</p></div>';

		echo'<p class="comentario">**Click sobre la imagen para ver en tamaño completo**</p>';
		
		foreach($valor['ruta'] as $img){
			$foto = str_replace("C:/xampp/htdocs/Guarderia/",base_url(),$img);
			echo '<a href="'.$foto.'" data-lightbox="image-1" data-title="'.$valor['titular'].'"><img src="'.$foto.'"/></a>';
		}
		
		if($valor['tipo'] == 'NOV'){$tipo = 'Novedades';}
		else{$tipo = 'Cursos';}
		
		echo '<div class="tipo">'.$valor['fecha'].'</div>';
		echo '<p>Para ver la imagen en más grande, pulse <a href="'.$foto.'" target="_blank"><b>aquí</b></a></p>';
		echo '</center></div>';
	}
	echo '<a href="'.base_url().'index.php/mainController/todoMenus"><p align="center"><button>Ver todos los menús</button></p></a>';
?>
</section>
</body>
</html>