#!/usr/bin/php
<?php
// ini_set('error_reporting', E_ALL|E_STRICT);
// ini_set('display_errors', '1');
include __DIR__ . '/../config.php';

$token = $CONFIG["UptoboxSses"];
$url = 'https://uptobox.com/api/upload';
$data = [
    'token' => $token
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);

$result = curl_exec($curl);
curl_close($curl);

$resultt = json_decode($result, true);
// var_dump($resultt);

$file = $argv[1];
$rrr = "http:".$resultt["data"]["uploadLink"];


if (function_exists('curl_file_create'))
{
    $cFile = curl_file_create($file);
}else{
    $cFile = '@' . realpath($file);
}
// var_dump($cFile);
  // POST the file & user_id to the server
$post = array('files'=> $cFile);

// var_dump($post);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$rrr);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$rresult = curl_exec ($ch);
curl_close ($ch);
$rresult = json_decode($rresult, true);
// var_dump($rresult);
print $rresult['files'][0]['url'];

?>