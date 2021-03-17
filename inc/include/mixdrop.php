#!/usr/bin/php
<?php 
include __DIR__ . '/../config.php';
$key = "rRtBz4aZ0yrHNIY";
$file = $argv[1];
$emill = 'yaxesa6370@mailapp.top';
$url = 'https://ul.mixdrop.co/api';

if (function_exists('curl_file_create')) {
    $cFile = curl_file_create($file);
  } else {
    $cFile = '@' . realpath($file);
  }


  // POST the file & user_id to the server
$post = array('email' => $emill, 'key' => $key,'file'=> $cFile);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec ($ch);
curl_close ($ch);

$result = json_decode($result, true);

echo "https://mixdrop.co/f/" . $result['result']['fileref'];





// $request = curl_init('http://example.com/');

// curl_setopt($request, CURLOPT_POST, true);
// curl_setopt(
//     $request,
//     CURLOPT_POSTFIELDS,
//     array(
//       'file' => '@' . realpath('example.txt')
//     ));

// curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
// $result = curl_exec($request);

// curl_close($request);






?>