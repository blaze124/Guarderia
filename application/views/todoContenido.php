<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url()?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
</head>


<body>

<section class='cuerpo'>

<?php
	$i = 0;
	echo '<p>Novedades</p>';
	foreach($res1 as $valor)
	{
		echo $valor['fecha'].' - '.$valor['titular'].'<a href="'.base_url().'index.php/mainController/verContenidoSimple/'.$valor['id'].'"><img src="<?php echo base_url()?>imagenes/logo/ir.png" style="vertical-align: middle;"></a>'.'<br>';
	}
	echo '<p>Cursos</p>';
	foreach($res2 as $valor)
	{
		echo $valor['fecha'].' - '.$valor['titular'].'<a href="'.base_url().'index.php/mainController/verContenidoSimple/'.$valor['id'].'"><img src="<?php echo base_url()?>imagenes/logo/ir.png" style="vertical-align: middle;"></a>'.'<br>';
	}
	
?>

</section>

</body>
</html>