<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>


<body>

<section class='cuerpo'>

	<?php
		$i = 0;
		echo '<div class="contenido">';		
		echo '<p><b>Alumnos</b></p>';
		foreach($res as $valor)
		{
			if($res['0'] == 0){
			echo '<p> No hay Alumnos registrados.</p>';
			}
			else{
				echo $valor['nickname'].' - '.$valor['nombre'].' '.$valor['apellidos'].'<a href="'.base_url().'index.php/mainController/verAlumnoSimple/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/ir.png" style="vertical-align: middle; width:30px; height:30px;" /></a>'.'<br>';
			}
		}
		echo '</div>';
	?>

</section>

</body>
</html>