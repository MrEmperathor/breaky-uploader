#!/usr/bin/php

<?php

include __DIR__ . '/../config.php';
$my_key = $CONFIG["JetloadKey"];

$context = stream_context_create(
  array(
      "http" => array(
          "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
      )
  )
);

$data = file_get_contents("https://jetload.net/api/v2/upload/$my_key", false, $context);

$data = json_decode($data,true);

// print_r($data);
$url = $data['hostname'].$data['path'];
$user_id = $data['upload_id']['user_id'];
$file = $argv[1];

// echo $url;
// echo "";
// echo $user_id;
// echo "";
// echo $file;
// echo "";



if (function_exists('curl_file_create')) {
    $cFile = curl_file_create($file);
  } else {
    $cFile = '@' . realpath($file);
  }


  // POST the file & user_id to the server
$post = array('upload_id' => $user_id,'file'=> $cFile);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec ($ch);
curl_close ($ch);
// echo substr($result,0,-1)."";
print $result;



// should print
// 'https://jetload.net/video or file link'
?>
