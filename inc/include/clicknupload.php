#!/usr/bin/php
<?php 
include __DIR__ . '/../config.php';

$arrContextOptions=array(
  "ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
  ),
);  

$key = $CONFIG["clicknupload"];
$ob_url = json_decode(file_get_contents("https://clicknupload.org/api/upload/server?key=".$key, false, stream_context_create($arrContextOptions)), true);

// var_dump($ob_url);
$url = $ob_url['upload_url'];
$file = $argv[1];


if (function_exists('curl_file_create')) {
    $cFile = curl_file_create($file);
  } else {
    $cFile = '@' . realpath($file);
  }

  // POST the file & user_id to the server
$post = array('api_key' => $key,'file'=> $cFile);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec ($ch);
curl_close ($ch);
// echo substr($result,0,-1)."";
// print $result;
// preg_match_all('/name="fn">([\w\-]+)</', $result, $matches);
// var_dump($result);

$code = json_decode($result, true);
// var_dump($code);
echo "https://clicknupload.org/".$code[0]["file_code"];
// preg_match('/name="fn">(.*?)</', $result, $matches);
// // var_dump($matches);
// echo "https://dropapk.to/".$matches[1];






?>