<?php

$code = $_GET['url'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.cuevana3.io/ir/redirect_ddh.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_HEADER=> true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('url' => $code),
  CURLOPT_HTTPHEADER => array(
    'authority: api.cuevana3.io'
  ),
));


$response = curl_exec($curl);
curl_close($curl);

$pattern='/https:\/\/damedamehoy.xyz\/embed.html#.*/m';
if (preg_match($pattern, $response, $match))
    $code =  str_replace("https://damedamehoy.xyz/embed.html#", "",$match[0]); 

if(empty($code)){
    exit(json_encode([ "status"=> false, "msg"=> "request not valided"]));
}

$json = file_get_contents("https://damedamehoy.xyz/details.php?v={$code}");

$json_decode = json_decode($json,true);

if($json_decode['status'] == "200"){
    header("Location: {$json_decode['file']}"); 
    die();
}
