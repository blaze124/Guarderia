<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>

<body>

<section class='cuerpo'>
<div class="contenido" align="center">
<?=validation_errors('<div class="errores">','</div>'); ?>
<?php
	$this->load->helper('form');
	
	echo form_open('index.php/main_controller/modifica_alumno');
	
	echo'<p>Modifique los datos que desee</p>';
	echo "<input type='text' name='nombre_alum' align='center' placeholder='Nombre alumno' value=".$res[0]['nombre']." />"; echo form_error('nombre_alum'); echo "<br>";
	echo "<input type='text' name='apellidos_alum' align='center' placeholder='Apellidos alumno' value='".$res[0]['apellidos']."' />"; echo form_error('apellidos_alum'); echo "<br>";
	echo "<input type='date' name='f_nac' align='center' placeholder='Fecha de nacimiento: dd/mm/aaaa' value=".$res[0]['f_nac']." />"; echo form_error('f_nac'); echo "<br>";
	echo "<input type='text' name='nombre_t1' align='center' placeholder='Nombre tutor 1' value=".$res[1]['nombre']." />"; echo form_error('nombre_t1'); echo "<br>";
	echo "<input type='text' name='apellidos_t1' align='center' placeholder='Apellidos tutor 1' value=".$res[1]['apellidos']." />"; echo form_error('apellidos_t1'); echo "<br>";
	echo "<input type='text' name='telefono_t1' align='center' placeholder='Telefono tutor 1' value=".$res[1]['telefono']." />"; echo form_error('telefono_t1'); echo "<br>";
	echo "<input type='text' name='nombre_t2' align='center' placeholder='Nombre tutor 2' value=".$res[2]['nombre']." />"; echo form_error('nombre_t2'); echo "<br>";
	echo "<input type='text' name='apellidos_t2' align='center' placeholder='Apellidos tutor 2' value=".$res[2]['apellidos']." />"; echo form_error('apellidos_t2'); echo "<br>";
	echo "<input type='text' name='telefono_t2' align='center' placeholder='Telefono tutor 2' value=".$res[2]['telefono']." />"; echo form_error('telefono_t2'); echo "<br>";
	echo "<input type='hidden' name='id_alum' value=".$res[0]['id']." />";
	echo "<input type='hidden' name='id_t1' value=".$res[1]['id']." />";
	echo "<input type='hidden' name='id_t2' value=".$res[2]['id']." />";
	echo '<br>';
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>

</div>

</section>

</body>
</html>