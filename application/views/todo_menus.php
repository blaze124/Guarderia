<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilos_principal.css" type="text/css" rel="stylesheet">
</head>


<body>

<section class='cuerpo'>
<div class="contenido">
<?php
	$i = 0;
	echo '<p>Menús Mensuales</p>';
	foreach($res1 as $valor)
	{
		echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/main_controller/ver_menus/'.$valor['id'].'"><img src="'.base_url().'imagenes/logo/ir.png" style="vertical-align: middle; height:25px; width:25px;"></a>'.'<br>';
	}

	
?>
</div>
</section>

</body>
</html>