#!/usr/bin/php
<?php 
// ini_set('error_reporting', E_ALL|E_STRICT);
// ini_set('display_errors', '1');
include __DIR__ . '/../config.php';

$arrContextOptions=array(
  "ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
  ),
);  
$key = $CONFIG["Gounlimited"];
// // $key = '5735fajqp4n1imi3p8g6';
// $key = '20093tabimqj3sfujktvl';
$ob_url = json_decode(file_get_contents("https://api.gounlimited.to/api/upload/server?key=".$key, false, stream_context_create($arrContextOptions)), true);

// var_dump($ob_url);
$url = $ob_url['result'];
$file = $argv[1];
$url2 = str_replace('https', 'http', $url);

if (function_exists('curl_file_create')) {
    $cFile = curl_file_create($file);
  } else {
    $cFile = '@' . realpath($file);
  }

  // POST the file & user_id to the server
$post = array('api_key' => $key, 'file' => $cFile);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url2);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec ($ch);
curl_close ($ch);
// echo substr($result,0,-1)."";
// print $result;
// preg_match_all('/name="fn">([\w\-]+)</', $result, $matches);
// var_dump($result);
preg_match('/name="fn">(.*?)</', $result, $matches);
// var_dump($matches);
echo (( $matches[1] )) ? 'https://gounlimited.to/'.$matches[1] : "Ocurrio un error con el servidor";
// echo "https://gounlimited.to/".$matches[1];






?>