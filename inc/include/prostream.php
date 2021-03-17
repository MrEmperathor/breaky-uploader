#!/usr/bin/php
<?php 
include __DIR__ . '/../config.php';
$ip = file_get_contents("https://api.ipify.org");

$arrContextOptions=array(
  "ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
  ),
);  



$key = $CONFIG["prostream"];

$ruta = $argv[1];
$file = $argv[2];

$ruta = str_replace('/var/www/html/', 'http://'.$ip.'/', $ruta);
$url = urlencode($ruta.'/'.$file);

$result = file_get_contents('https://prostream.to/api/upload/url?key='.$key.'&url='.$url);

$code = json_decode($result, true);
echo "https://prostream.to/".$code['result']['filecode'];







?>