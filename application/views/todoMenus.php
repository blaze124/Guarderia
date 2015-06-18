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
	echo '<p>Menús Mensuales</p>';
	foreach($res1 as $valor)
	{
		echo $valor['id'].' - '.$valor['titular'].' - '.$valor['fecha'].'<a href="'.base_url().'index.php/mainController/verMenus/'.$valor['id'].'"><img src="<?php echo base_url()?>imagenes/logo/ir.png" style="vertical-align: middle;"></a>'.'<br>';
	}

	
?>

</section>

</body>
</html>