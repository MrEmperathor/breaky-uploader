#!/usr/bin/php
<?php
include __DIR__ . '/../config.php';
$claveApi = $CONFIG["Acortador1"];

function ouo_io($claveApi, $enlace)
{
 
	//Petición GET
	$acortado = @file_get_contents(
	            "http://ouo.io/api/"
	            . urlencode($claveApi)
	            . "?s="
	            . urlencode($enlace));
 
 
	// Comprobar si lo que obtuvimo
	// es un enlace válido utilizando una
	// expresión regular
	// https://ouo.io/api/25l4m9Mn?s=yourdestinationlink.com
 
    if (preg_match('/^http:\/\/ouo\.io\/\w+$/', $acortado) !== 1)
        // throw new Exception("Enlace inesperado al acortar con ouo.io: " . $acortado);
    return $acortado;
}
 
$enlace = $argv[1];
echo ouo_io($claveApi, $enlace); //Salida: algo como http://ouo.io/D5UZXp
?>