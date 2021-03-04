#!/usr/bin/php
<?php 
include __DIR__ . '/../config.php';
$key = "44571vd4lapvx059bbsiq";
// https://clipwatching.com/api/account/info?key=44571vd4lapvx059bbsiq
// https://clipwatching.com/api/upload/url?key=44571vd4lapvx059bbsiq&url=http://167.86.105.129/panel/inc/include/serie2.mkv
$ob_url = json_decode(file_get_contents("https://clipwatching.com/api/upload/server?key=".$key), true);
var_dump($ob_url);
$url = $ob_url['result'];
$file = $argv[1];


if (function_exists('curl_file_create')) {
    $cFile = curl_file_create($file);
  } else {
    $cFile = '@' . realpath($file);
  }

echo "url a envir: ".$url;
echo "------------";
// echo "arhivo a enviar: ".$cFile;


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

var_dump($result);

// preg_match('/name="fn">(.*?)</', $result, $matches);
// // var_dump($matches);
// echo "https://gounlimited.to/".$matches[1];






?>