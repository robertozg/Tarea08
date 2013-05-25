<!DOCTYPE html>
<html>
<head> 
<title> Página </title>
<meta charset="utf-8" />
<link rel="stylesheet" href="estilo.css" type="text/css"/>
</head>
<body>
<?php

include('lib/nusoap.php');

$rut = $_POST['rut'];
$password = $_POST['password'];

$password = strtoupper($password);
$password = hash("SHA256", $password);
 
$rut = str_replace('.', '-', $rut); 
 

$parametros = array();
$parametros['rut'] = $rut;
$parametros['password'] = $password;

$objClienteSOAP = new soapclient("http://informatica.utem.cl:8011/dirdoc-auth/ws/auth?wsdl");
$objRespuesta = $objClienteSOAP->autenticar($parametros);

//var_dump($objRespuesta);


$codigo = (int) $objRespuesta->return->codigo;
$res = (string) $objRespuesta->return->descripcion;


if ($codigo == 1) 
	echo "<h1>¡Bienvenido(a)!</h1>";
 else 
	echo "<h1>¡Rechazado!</h1>";

?>
</body>

</html>
