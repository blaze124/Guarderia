<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://localhost/Guarderia/css/estilosPrincipal.css" type="text/css" rel="stylesheet">

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


<section class='formulario'>
<?php
	$this->load->helper('form');
	
	$datos= array('name'=>'AltaUsuario');
	
	echo form_open('http://localhost/Guarderia/index.php/mainController/AltaUsuario',$datos);
	
	echo'<p>Datos del usuario</p>';
	echo "Administrador <input type='radio' name='ROL' value='ADMIN' onClick='mostrar_campos();' /> ";
	echo " Profesor <input type='radio' name='ROL' value='PROF' onClick='mostrar_campos();' /> ";
	echo " Usuario para tutores <input type='radio' name='ROL' value='ALUM' onClick='mostrar_campos();' checked/> ";
	echo '<br>';
	echo "Usuario: <input type='text' name='nickname' />"; echo form_error('nickname');
	echo'<br>';
	echo "Nombre: <input type='text' name='Nombre' />"; echo form_error('Nombre');
	echo '<br>';
	echo "Apellidos: <input type='text' name='Apellidos' />"; echo form_error('Apellidos');
	echo '<br>';
	echo '<div id="no_alum" style="display:none;">
		Email:<input type="email" name="email"><br>
		DNI:<input type="text" name="dni"><br>
		</div>'; echo form_error('email'); echo form_error('dni');
	echo "Domicilio: <input type='text' name='Dom' />"; echo form_error('Dom'); echo "<br>";
	echo "Fecha de Nacimiento: <input type='date' name='fnac' />";echo form_error('fnac');
	echo '<br>';
	
	
	echo '<div id="alum" style="display:block;">
		<p>Datos del tutor 1</p>
		Nombre del tutor: <input type="text" name="NombreTutor"  /><br>
		Apellidos del tutor: <input type="text" name="ApellidosTutor"  /><br>
		Email:<input type="email" name="email_t"  /><br>
		Teléfono:<input type="tel" name="TelContacto" /><br>
		DNI:<input type="text" name="dniT" /><br>
		<br>
		<p>Datos del tutor 2</p>
		Nombre del tutor: <input type="text" name="NombreTutor2" /><br>
		Apellidos del tutor: <input type="text" name="ApellidosTutor2" /><br>
		Email:<input type="email" name="email_t2" /><br>
		Teléfono:<input type="tel" name="TelContacto2" /><br>
		DNI:<input type="text" name="dniT2" /><br>
		<br>
		<p>Horario Seleccionado</p>
		<input type="radio" name="horario" value="ESCOLAR"> Horario Escolar (9:00 - 13:00)<br>
		<input type="radio" name="horario" value="COMPLETO"> Horario Completo (9:00 - 17:00)<br>
		<input type="radio" name="horario" value="MATINAL"> Aula Matinal (7:30 - 9:00)<br>
		<input type="radio" name="horario" value="COMEDOR"> Horario Escolar con comedor (9:00 - 14:00)<br>
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
	echo form_close();
?>
</section>
<br><br><br><br>
</body>
</html>