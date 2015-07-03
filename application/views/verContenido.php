<!doctype html>
<html>
<head>
<link href="<?php echo base_url() ?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url() ?>css/lightbox.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>js/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url() ?>js/lightbox.min.js"></script>
<meta charset="utf-8">
</head>

<body>
<section class="cuerpo">
<?php

	if($res['0'] == 0){
		echo '<div class="contenido"><p align="center"> Aún no se ha añadido ningún contenido de este tipo. Disculpe las molestias.</p></div>';
	}
	else{
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

			echo '<div><p>'.$valor['cuerpo'].'</p></div>';
			
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
		
		echo '<a href="'.base_url().'index.php/mainController/todoContenido"><p align="center"><button>Ver todas las noticias</button></p></a>';
	}
?>

	
</section>
</body>
</html>
