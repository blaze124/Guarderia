<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>


<body>

<section class='cuerpo'>

<?php
	$i = 0;
	echo '<div class="contenido" >';
	echo '<p><b>Novedades</b></p>';
	foreach($res1 as $valor)
	{
		if($res1['0'] == 0){
			echo '<p> Aún no se ha añadido ningún contenido de este tipo.</p>';
		}
		else{
			echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/main_controller/borrar_contenido/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/error.png" style="vertical-align: middle; height:25px; width:25px;"></a>'.'<br>';
		}
	}
	echo '<p><b>Cursos</b></p>';
	foreach($res2 as $valor)
	{
		if($res2['0'] == 0){
			echo '<p> Aún no se ha añadido ningún contenido de este tipo.</p>';
		}
		else{
			echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/main_controller/borrar_contenido/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/error.png" style="vertical-align: middle; height:25px; width:25px;"></a>'.'<br>';
		}	
	}
	echo '<p><b>Menus mensuales</b></p>';
	foreach($res3 as $valor)
	{
		if($res3['0'] == 0){
			echo '<p> Aún no se ha añadido ningún contenido de este tipo.</p>';
		}
		else{
			echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/main_controller/borrar_contenido/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/error.png " style="vertical-align: middle; height:25px; width:25px;"></a>'.'<br>';
		}
	}
	echo '<p><b>Incidencias</b></p>';
	foreach($res4 as $valor)
	{
		if($res4['0'] == 0){
			echo '<p> Aún no se ha añadido ningún contenido de este tipo.</p>';
		}
		else{
			echo $valor['id'].' - '.$valor['grupo'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/main_controller/borrar_incidencia/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/error.png " style="vertical-align: middle; height:25px; width:25px;"></a>'.'<br>';
		}
	}


	echo '</div>';
?>

</section>

</body>
</html>