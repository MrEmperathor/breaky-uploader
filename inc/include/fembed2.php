#!/usr/bin/php
<?php

$base_api = 'https://www.fembed.com/api';
$cliente_id = '310616';
$token = 'a23b6b25edffbf2e';
$folder_id = '10380';

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, 'https://www.fembed.com/api/upload'); 
curl_setopt($ch, CURLOPT_HEADER, FALSE); 
curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS,"client_id=$cliente_id&client_secret=$token&file_id=IdOfVideo&title=NEW_TITLE");
curl_setopt($ch, CURLOPT_POSTFIELDS,"client_id=$cliente_id&client_secret=$token");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 

$data = curl_exec($ch); 
curl_close($ch);

var_dump($data);//response data

$data2 = json_decode($data,true);
echo "===============";
var_dump($data2);
$url_subida = $data2['data']['url'];
$token_subida = $data2['data']['token'];


echo "mi url: $url_subida";
echo "mi token: $token_subida";





?>