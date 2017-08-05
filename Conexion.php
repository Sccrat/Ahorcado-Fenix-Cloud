<?php
	error_reporting(0);
	
	define("cServidor", "localhost");
	define("cUsuario", "root");
	define("cPass","");
	define("cBd","fenixcloud");

    $conectar = mysqli_connect(cServidor, cUsuario, cPass, cBd);
	$conectarweb = mysqli_connect("", "root", "", "fenixcloud");
	mysqli_query($conectar,"SET NAMES 'utf8'");

?>
