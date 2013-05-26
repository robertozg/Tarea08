<!DOCTYPE html>
<html>
<head> 
<title> Página <?php echo date('y-m-d'); ?> </title> 
<meta charset="utf-8" />
<link rel="stylesheet" href="estilo.css" type="text/css"/>
</head>
<body>
<?php

include('lib/nusoap.php');

$rut = $_POST["rut"];
$password = $_POST["password"];

$password = strtoupper($password);
$password = hash("SHA256", $password);

$parametros = array();
$parametros["rut"] = $rut;
$parametros["password"] = $password;

$objClienteSOAP = new soapclient("http://informatica.utem.cl:8011/dirdoc-auth/ws/auth?wsdl");
$objRespuesta = $objClienteSOAP->autenticar($parametros);

//var_dump($objRespuesta);

$codigo =  $objRespuesta->return->codigo;
$descripcion =  $objRespuesta->return->descripcion;

if ($codigo == 1) 
	echo "<h1>¡Bienvenido(a)!</h1>";
 else 
	echo "<h1>¡Rechazado!</h1>";
?>
</body>
</html>
