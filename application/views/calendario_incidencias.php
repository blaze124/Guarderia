<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />

<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">

</head>

<body>

<section class='cuerpo'>
	<div class="contenido-calendario">

		<?php 

			if(count($incidencias) != 0){
				foreach ($incidencias as $valor) {
					$fecha = date("d-m-Y",strtotime($valor['fecha']));
					$valor['fecha'] = substr($valor['fecha'], -2);

					if(intval($valor['fecha'] ) < 10){$valor['fecha'] = substr($valor['fecha'], -1);} 

					if(isset( $datos[$valor['fecha']] )){
						$cad = $datos[$valor['fecha']];
						$datos[$valor['fecha']] = $cad.'<br><a href="'.base_url().'index.php/main_controller/ver_incidencia/'.$valor['id'].'">Evento día '.$fecha.'<br>Grupo '.$valor['grupo'].'</a><br>';
					}
					else{
						$datos[$valor['fecha']] = '<a href="'.base_url().'index.php/main_controller/ver_incidencia/'.$valor['id'].'">Evento día '.$fecha.'<br>Grupo '.$valor['grupo'].'</a><br>';
					}
				}

				echo $this->calendar->generate($anno,$mes, $datos);
			}
			else{
				echo $this->calendar->generate($anno,$mes);
			}
			if($_SESSION['rol'] == 1){
				echo '<br><a href="'.base_url().'index.php/main_controller/add_incidencia" ><div align="center"><button>Añadir Incidencia</button></div></a>';
			}
		?>

	</div>
</section>


</body>
</html>