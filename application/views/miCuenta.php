<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='cuerpo' >

	<h1 align='center' class='titulo'>Mi Cuenta</h1>
	<?php

		if($res1['rol'] == 'ADMIN'){ $rol = 'Administrador'; }
		elseif($res1['rol'] == 'ALUM'){ $rol = 'Alumno'; }
		else{ $rol = 'Profesor'; }
		
		echo('<div class="contenido" align="center"><h3 class="titulo">Datos de Usuario</h3>');
		echo('<p><b>Usuario</b>: '.$res1['nickname'].'><br>');
		echo('<b>Nombre y Apellidos</b>: '.$res1['nombre'].' '.$res1['apellidos'].'<br>');
		echo('<b>Fecha de Nacimiento</b>: '.$res1['f_nac'].'<br>');
		echo('<b>Domicilio</b>: '.$res1['domicilio'].' <a href="'.base_url().'index.php/mainController/nuevoDom"><button type="button">Modificar</button></a><br>');
		echo('<b>Tipo de Usuario</b>: '.$rol.'<br>');
		
		if(!isset($res2)){
			echo('<b>Email</b>: '.$res1['email'].' <a href="'.base_url().'index.php/mainController/nuevoEmail/'.$res1['id'].'"><button type="button">Modificar</button></a><br>');
			echo('</p></div>');
		}

		else{
			echo('</p></div>');
			$i = 0;
			while($i < count($res2)){
				echo('<div class="contenido" align="center"><h3 class="titulo">Datos del Tutor'.($i+1).' </h3>');
				echo('<p><b>Nombre y Apellidos</b>: '.$res2[$i]['nombre'].' '.$res2[$i]['apellidos'].'<br>');
				echo('<b>Email</b>: '.$res2[$i]['email'].' <a href="'.base_url().'index.php/mainController/nuevoEmail/'.$res2[$i]['id'].'"><button type="button">Modificar</button></a><br>');
				echo('<b>Teléfono</b>: '.$res2[$i]['telefono'].'<br></p></div>');
				$i++;
			}
		}
		
		echo('<a href="'.base_url().'index.php/mainController/nuevaPass"><button type="button">Modificar Contraseña</button></a>');
	?>
</section>

</body>
</html>
