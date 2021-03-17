#!/usr/bin/php
<?php 

include __DIR__ . '/../config.php';
$pass = $CONFIG["VerystreamPass"];
$user = $CONFIG["VerystreamUser"];
$archivo = $argv[1];



$output = json_decode(file_get_contents("https://api.verystream.com/file/ul?login=".$user."&key=".$pass), true);
$urldestino = $output['result']['url'];

$download = `/var/www/html/panel/inc/comp/sh/./espacio.sh "$archivo" $urldestino`;

$salidaEnlacee = json_decode($download, true);
echo $salidaEnlacee['result']['url'];
// $salidaEnlace = str_replace('/stream/', '/e/', $salidaEnlacee['result']['url']);


 ?>

