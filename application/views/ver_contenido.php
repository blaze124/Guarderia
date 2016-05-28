<!doctype html>
<html>
<head>
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url() ?>css/lightbox.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>js/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url() ?>js/lightbox.min.js"></script>
<meta charset="utf-8">
</head>

<body>
<section class="cuerpo">
<?php

	if($res[0] == 0){

		echo '<div class="contenido"><p align="center"> Aún no se ha añadido ningún contenido de este tipo. Disculpe las molestias.</p></div>';
	}
	else{
	
		$noticia[0] = 0;

		$datos = $res[0];
		$rutas = $res[1];

		foreach($datos as $valor){
			$noticia[$valor['id']]['titular'] = $valor['titular'];
			$noticia[$valor['id']]['cuerpo'] = $valor['cuerpo'];
			$noticia[$valor['id']]['fecha'] = $valor['fecha'];
			$noticia[$valor['id']]['tipo'] = $valor['tipo'];

			$noticia[$valor['id']]['rutas'] = array();

			foreach($rutas as $imgs){
				if($valor['id'] == $imgs['id_noticia']){
					array_push($noticia[$valor['id']]['rutas'], $imgs['ruta']);
				}
			}
		}

		foreach($noticia as $valor){

			if($valor == 0){}
			else{
				echo '<div class="contenido">';
				echo '<center><div class="titulo"><h2>'.$valor['titular'].'</h2></div>';

				echo '<div><p>'.$valor['cuerpo'].'</p></div>';
				
				echo'<p class="comentario">**Click sobre la imagen para ver en tamaño completo**</p>';

				$i=0;

				$rutas = $valor['rutas'];
				
				foreach($rutas as $img){

					if( strpos($img,'.pdf') ){
						$pdf[$i] = $img;
						$i++;
					}
					else{
						$foto = str_replace("/home/guarderidl/www/", base_url(), $img);

						echo '<a href="'.$foto.'" data-lightbox="image-1" data-title="'.$valor['titular'].'"><img class="img_cont" src="'.$foto.'"/></a>';
					}
				}

				if(! empty($pdf) ){
					foreach ($pdf as $val) {
						$ruta = str_replace("/home/guarderidl/www/", base_url(), $val);
						echo '<br><a href="'.$ruta.'" target="_blank">Fichero PDF: '.basename($ruta).'</a><br>';
					}
				}
				
				if($valor['tipo'] == 'NOV'){$tipo = 'Novedades';}
				else{$tipo = 'Escuela de padres';}
				echo '<br>';
				echo '<div class="tipo">'.$tipo.' - '.$valor['fecha'].'</div>';
				echo '</center></div>';

				$pdf = null;
			}
		}
			echo '<a href="'.base_url().'index.php/main_controller/todo_contenido"><p align="center"><button>Ver todas las noticias</button></p></a>';

	}
?>

	
</section>
</body>
</html>
