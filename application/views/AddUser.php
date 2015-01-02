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
	echo " Alumno <input type='radio'name='ROL' value='ALUM' onClick='mostrar_campos();' checked/> ";
	echo '<br>';
	echo "Nickname: <input type='text' name='nickname' />";
	echo'<br>';
	echo "Nombre: <input type='text' name='Nombre' />";
	echo '<br>';
	echo "Apellidos: <input type='text' name='Apellidos' />";
	echo '<br>';
	echo '<div id="no_alum" style="display:none;">
		Email:<input type="email" name="email"><br>
		DNI:<input type="text" name="dni"><br>
		</div>';
	echo "Domicilio: <input type='text' name='Dom' />"; echo "<br>";
	echo "Fecha de Nacimiento: <input type='date' name='fnac' />";
	echo '<br>';
	
	
	echo '<div id="alum" style="display:block;">
		<p>Datos del tutor</p>
		Nombre del tutor: <input type="text" name="NombreTutor" /><br>
		Apellidos del tutor: <input type="text" name="ApellidosTutor" /><br>
		Email:<input type="email" name="email" /><br>
		Teléfono:<input type="tel" name="TelContacto" /><br>
		DNI:<input type="text" name="dni" /><br>
		</div>';
		
	echo form_submit('submit','Aceptar');
	
	echo form_close();
?>
</section>

</body>
</html>