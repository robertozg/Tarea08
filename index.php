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

$rut= $_POST['rut'];
$password= $_POST['password'];

//Guarda en $srt el valor de la contraseña en mayuscula y codificada en SHA256
 $password = strtoupper($password);
 $password = hash("SHA256", $password);
 
 $rut = str_replace('.', '-', $rut); 
 
//Creacion de un arreglo       y
$parametros=array();
$parametros['rut']= $rut;
$parametros['password']= $password;

$objClienteSOAP = new soapclient("http://informatica.utem.cl:8011/dirdoc-auth/ws/auth?wsdl");
$objRespuesta = $objClienteSOAP->autenticar($parametros);
// Cómo llega el objeto
//var_dump($objRespuesta);

// Comparación con tipos
$codigo = (int) $objRespuesta->return->codigo;
$res = (string) $objRespuesta->return->descripcion;
//echo "Rut: $rut";
//echo "Password $password";
//echo "Codigo: $codigo <br />";
//echo "Codigo: $res <br />";

if ($codigo == 1) 
{
	echo "<h1>¡Bienvenido(a)!</h1>";
	echo "<p>$res  </p>";
} else 

{
	echo "<h1>¡Rechazado!</h1>";
	echo "<p>$res  </p>";
}

?>
</body>

</html>
