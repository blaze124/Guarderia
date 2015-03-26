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
	echo "Administrador <input type='radio'name='ROL' value='ADMIN' onClick='mostrar_campos();' /> ";
	echo " Profesor <input type='radio'name='ROL' value='PROF' onClick='mostrar_campos();' /> ";
	echo " Usuario para tutores <input type='radio'name='ROL' value='ALUM' onClick='mostrar_campos();' checked/> ";
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
		<p>Datos del tutor</p>
		Nombre del tutor: <input type="text" name="NombreTutor" value="Nombre del tutor" /><br>
		Apellidos del tutor: <input type="text" name="ApellidosTutor" value="Apellidos del tutor" /><br>
		Email:<input type="email" name="email_t" value="xxxx@gmail.com" /><br>
		Teléfono:<input type="tel" name="TelContacto" value="000000000" /><br>
		DNI:<input type="text" name="dniT" value="123456789" /><br>
		</div>';echo form_error('TelContacto'); echo form_error('dniT'); echo form_error('email_t');
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>
</section>

</body>
</html>