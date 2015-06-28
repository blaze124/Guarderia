<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">

<script type="text/javascript">
<!-- 
	function mostrar_campos()
	{
		if(document.AltaUsuario.ROL[0].checked==true || document.AltaUsuario.ROL[1].checked==true)
		{
			document.getElementById('no_alum').style.display='block';
			document.getElementById('alum').style.display='none';	
		}
		else if(document.AltaUsuario.ROL[2].checked==true)
		{
			document.getElementById('no_alum').style.display='none';
			document.getElementById('alum').style.display='block';
		}
		else{
			document.getElementById('no_alum').style.display='none';
			document.getElementById('alum').style.display='none';	
		}
	}
-->
</script>

</head>
<body>


<section class='cuerpo'>
<?php
	$this->load->helper('form');
	
	$datos= array('name'=>'AltaUsuario');
	
	echo form_open('index.php/mainController/AltaUsuario',$datos);
	
	echo '<div class="contenido" align="center">';

	echo'<p>Datos del usuario</p>';
	echo "Administrador <input type='radio' name='ROL' value='ADMIN' onClick='mostrar_campos();' /> ";
	echo " Profesor <input type='radio' name='ROL' value='PROF' onClick='mostrar_campos();' /> ";
	echo " Usuario para tutores <input type='radio' name='ROL' value='ALUM' onClick='mostrar_campos();' checked/> ";
	echo '<br>';
	echo "<input type='text' name='nickname' placeholder=' Usuario'/>"; echo form_error('nickname');
	echo'<br>';
	echo "<input type='text' name='Nombre' placeholder=' Nombre'/>"; echo form_error('Nombre');
	echo '<br>';
	echo "<input type='text' name='Apellidos' placeholder=' Apellidos'/>"; echo form_error('Apellidos');
	echo '<br>';
	echo '<div id="no_alum" style="display:none;">
		<input type="email" name="email" placeholder=" e-mail"><br>
		<input type="text" name="dni" placeholder=" DNI"><br>
		</div>'; echo form_error('email'); echo form_error('dni');
	echo "<input type='text' name='Grupo' placeholder=' Grupo'><br>";
	echo "<input type='text' name='Dom' placeholder=' Domicilio'/>"; echo form_error('Dom'); echo "<br>";
	echo "<input type='date' name='fnac' placeholder=' Fecha de nacimiento'/>";echo form_error('fnac');
	echo '<br>';
	
	
	echo '<div id="alum" style="display:block;">
		<p>Datos del tutor 1</p>
		<input type="text" name="NombreTutor" placeholder=" Nombre del tutor" /><br>
		<input type="text" name="ApellidosTutor" placeholder=" Apellidos del tutor" /><br>
		<input type="email" name="email_t" placeholder=" e-mail del tutor" /><br>
		<input type="tel" name="TelContacto" placeholder=" Teléfono de contacto"/><br>
		<input type="text" name="dniT" placeholder=" DNI del tutor"/><br>
		<br>
		<p>Datos del tutor 2</p>
		<input type="text" name="NombreTutor2" placeholder=" Nombre del tutor"/><br>
		<input type="text" name="ApellidosTutor2" placeholder=" Apellidos del tutor"/><br>
		<input type="email" name="email_t2" placeholder=" e-mail del tutor"/><br>
		<input type="tel" name="TelContacto2" placeholder=" Telefono de contacto"/><br>
		<input type="text" name="dniT2" placeholder=" DNI del tutor"/><br>
		<br>
		<p>Horario Seleccionado</p>
		<input type="radio" name="horario" value="ESCOLAR"> Escolar (9:00 - 13:00)<br>
		<input type="radio" name="horario" value="COMPLETO"> Completo (9:00 - 17:00)<br>
		<input type="radio" name="horario" value="MATINAL"> Aula Matinal (7:30 - 9:00)<br>
		<input type="radio" name="horario" value="COMEDOR"> Comedor (9:00 - 14:00)<br>
		<br>
		<p>Forma de pago</p>
		<input type="radio" name="pago" value="EFECTIVO"> Pago en Efectivo<br>
		<input type="radio" name="pago" value="DOMICILIACION"> Domiciliación Bancaria<br>
		<br>
		<p>Autorización para fotografías</p>
		<input type="radio" name="autorizacion" value="1"> Sí<br>
		<input type="radio" name="autorizacion" value="0"> No<br>
		<br>
		</div>';
	
		echo form_submit('submit','Aceptar');
	
	echo '</div>';
		
	echo form_close();
?>
</section>
<br><br><br><br>
</body>
</html>