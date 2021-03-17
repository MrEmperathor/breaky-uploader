#!/usr/bin/php
<?php
include __DIR__ . '/../config.php';
$claveApi = $CONFIG["Acortador2"];
$enlace = $argv[1];
$enlacesD = urlencode($enlace);
// $claveApi = "f6236d9aa7aeb0a3cb29cb1d85eb08a2d17a0928";
// $enlace = $argv[1];
// echo ouo_io($claveApi, $enlace); //Salida: algo como http://ouo.io/D5UZXp

$json = file_get_contents("https://short.pe/api?api=".$claveApi."&url=".$enlacesD);
$ll = json_decode($json, true);

echo $ll['shortenedUrl'];


?>
