<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='cuerpo' >

	<?php		
		echo '<div class="contenido" align="center">';

		echo('<h3 class="titulo">Datos de Usuario</h3>');
		echo('<p><b>Usuario</b>: '.$res[0]['nickname'].'<br>');
		echo('<b>Nombre y Apellidos</b>: '.$res[0]['nombre'].' '.$res[0]['apellidos'].'<br>');
		echo('<b>Fecha de Nacimiento</b>: '.$res[0]['f_nac'].'<br>');
		echo('<b>Domicilio</b>: '.$res[0]['domicilio'].'<br>');
		echo('<b>Grupo</b>: '.$res[0]['grupo'].'</p>');
		
		echo('<h3 class="titulo">Datos del Tutor 1</h3>');
		echo('<p><b>Nombre y Apellidos</b>: '.$res[1]['nombre'].' '.$res[1]['apellidos'].'<br>');
		echo('<b>Email</b>: '.$res[1]['email'].'<br>');
		echo('<b>Teléfono</b>: '.$res[1]['telefono'].'</p>');
	
		echo('<h3 class="titulo">Datos del Tutor 2</h3>');
		echo('<p><b>Nombre y Apellidos</b>: '.$res[2]['nombre'].' '.$res[2]['apellidos'].'<br>');
		echo('<b>Email</b>: '.$res[2]['email'].'<br>');
		echo('<b>Teléfono</b>: '.$res[2]['telefono'].'</p>');
		
		echo('<h3 class="titulo">Datos Administrativos</h3><p>');
		
		switch($res[3]['horario']){
			case 'ESCOLAR':
				echo('<b>Horario</b>: Horario Escolar<br>');
				break;
			case 'COMEDOR':
				echo('<b>Horario</b>: Horario de Comedor<br>');
				break;
			case 'COMPLETO':
				echo('<b>Horario</b>: Horario Completo<br>');
				break;
		}
		
		if($res[3]['matinal'] == 1){
			echo('<b>Horario Matinal</b>: Sí<br>');
		}else{
			echo('<b>Horario Matinal</b>: No<br>');
		}

		switch($res[3]['pago']){
			case 'EFECTIVO':
				echo('<b>Forma de Pago</b>: Pago en Efectivo<br>');
				break;
			case 'DOMICILIACION':
				echo('<b>Forma de Pago</b>: Domiciliación Bancaria<br>');
				break;
		}
		
		switch($res[3]['fotos']){
			case 1:
				echo('<b>Autorización para fotografías</b>: Sí<br>');
				break;
			case 0:
				echo('<b>Autorización para fotografías</b>: No<br>');
				break;
		}
		
	echo '</p>';

	if(isset($res[3]['observaciones'])){
		echo('<h3 class="titulo">Observaciones</h3><p>'.$res[3]['observaciones'].'</p>');
	}

	echo('<br><a href="'.base_url().'index.php/main_controller/mod_alumno/'.$res[0]['id'].'"><button type="button">Modificar datos del usuario</button></a>');
	echo('<br><a href="'.base_url().'index.php/main_controller/consulta_alumnos"><button type="button">Volver a consultar usuarios</button></a>');
	
	echo '</div>';

	?>
	
</section>

</body>
</html>
