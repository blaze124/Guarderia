<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='cuerpo'>

	<?php
		echo '<div class="contenido" align="center">';
			echo('<h3 class="titulo">Datos de Usuario</h3>');
			echo('<p><b>Usuario</b>: '.$res['nickname'].'<br>');
			echo('<b>Nombre y Apellidos</b>: '.$res['nombre'].' '.$res['apellidos'].'<br>');
			echo('<b>DNI</b>: '.$res['DNI'].'<br>');
			echo('<b>Correo Electrónico</b>: '.$res['email'].'<br>');

			echo('<br><a href="'.base_url().'index.php/main_controller/mod_usuario/'.$res['id'].'"><button type="button">Modificar datos del usuario</button></a>');
			echo('<br><a href="'.base_url().'index.php/main_controller/consulta_alumnos"><button type="button">Volver a consultar usuarios</button></a>');
			
		echo '</div>';
	?>
	
</section>

</body>
</html>
