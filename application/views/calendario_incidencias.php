<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />

	<link href="<?php echo base_url() ?>css/estilosPrincipal.css" type="text/css" rel="stylesheet" />

</head>

<body>

<section class='cuerpo'>
	<div class="contenido-calendario">

		<?php 

			if(count($incidencias) != 0){
				foreach ($incidencias as $valor) {
					$valor['fecha'] = substr($valor['fecha'], -2);
					if($valor['fecha'] < 10){substr($valor['fecha'], -1);}

					$datos[$valor['fecha']] = '<a href="'.base_url().'index.php/mainController/verIncidencia/'.$valor['id'].'">Evento '.$valor['id'].'</a>';
				}

				echo $this->calendar->generate($anno,$mes, $datos);
			}
			else{
				echo $this->calendar->generate($anno,$mes);
			}
			if($_SESSION['rol'] == 1){
				echo '<br><a href="'.base_url().'index.php/mainController/addIncidencia" ><button>Añadir Incidencia</button></a>';
			}
		?>

	</div>
</section>


</body>
</html>