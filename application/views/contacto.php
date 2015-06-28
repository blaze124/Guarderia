<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url() ?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
<link href="<?php echo base_url() ?>css/lightbox.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>js/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url() ?>js/lightbox.min.js"></script>
</head>

<body>

<section class='cuerpo'>
    <h1 class="titulo" align="center">Contacta con Nosotros</h1>
    <div class="contenido">
    	<p align="center">
    		Para contactar con nosotros ofrecemos diversas opciones, como acceder a nuestra página en redes sociales haciendo click en los iconos que se encuentran en nuestra barra de nevegación, llamando por teléfono a cualquiera de los números que ponemos a continuación a su disposición, a través de correo electrónico a la cuenta que se indica abajo, o mediante una consulta directa desde el formulario que se encuetra más abajo.<br>
    		<br>
    		<b>Teléfono de contacto</b>:956256906 / 629692945<br>
    		<b>Dirección de correo electrónico</b>:guarderia.bahiablanca@gmail.com
    	</p>
        <div align="center">
        	<?php
        		$this->load->helper('form');
    			$datos= array('name'=>'consultaPublica','enctype'=>"multipart/form-data");
    			echo form_open(base_url().'index.php/mainController/consultaPublica',$datos);
    		
    			echo "Nombre y Apellidos:<input type='text' size='50' name='nombre' /><br>";

    			echo "Correo Electrónico:<input type='email' size='50' name='email' /><br>";echo form_error('email');
    			
    			echo 'Mensaje:<br><textarea cols="75" rows="15" name="consulta"></textarea><br>';

    			echo form_submit('submit','Enviar');
    		
    			echo form_close();
        	?>
        </div>
    </div>
</section>

</body>