<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='cuerpo' >

	<?php

		echo'<h1 align="center" class="titulo">Datos del Alumno</h1>';
		
		echo('<h3 class="titulo">Datos de Usuario</h3>');
		echo('<b>Usuario</b>: '.$res[0]['nickname'].'<br>');
		echo('<b>Nombre y Apellidos</b>: '.$res[0]['nombre'].' '.$res[0]['apellidos'].'<br>');
		echo('<b>Fecha de Nacimiento</b>: '.$res[0]['f_nac'].'<br>');
		echo('<b>Domicilio</b>: '.$res[0]['domicilio']);
		
		echo('<h3 class="titulo">Datos del Tutor 1</h3>');
		echo('<b>Nombre y Apellidos</b>: '.$res[1]['nombre'].' '.$res[1]['apellidos'].'<br>');
		echo('<b>Email</b>: '.$res[1]['email'].'<br>');
		echo('<b>Teléfono</b>: '.$res[1]['telefono'].'<br>');
	
		echo('<h3 class="titulo">Datos del Tutor 2</h3>');
		echo('<b>Nombre y Apellidos</b>: '.$res[2]['nombre'].' '.$res[2]['apellidos'].'<br>');
		echo('<b>Email</b>: '.$res[2]['email'].'<br>');
		echo('<b>Teléfono</b>: '.$res[2]['telefono'].'<br>');
		
		echo('<h3 class="titulo">Datos Administrativos</h3>');
		
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
			case 'MATINAL':
				echo('<b>Horario</b>: Horario Matinal<br>');
				break;
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
	
	echo('<br><a href="http://localhost/Guarderia/index.php/mainController/consultaAlumnos"><button type="button">Volver a selección de alumnos</button></a>');
	
	?>
	
</section>

</body>
</html>
