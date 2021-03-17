#!/usr/bin/php
<?php
include __DIR__ . '/../config.php';


$my_key = $CONFIG["evoload"];

$context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
  );
  
$data = file_get_contents("https://evoload.io/v1/EvoAPI/$my_key/get-server", false, $context);

var_dump($data);
  
// Decode JSON
$data = json_decode($data,true);
$srv_url = $data['url'];
// Set your User_ID
$api_key = $my_key;

// Your File Location
$file = $argv[1];
if (function_exists('curl_file_create')) {
$cFile = curl_file_create($file);
} else {
$cFile = '@' . realpath($file);
}

// POST the file & user_id to the server
$post = array('key' => $api_key,'file'=> $cFile);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$srv_url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result=curl_exec ($ch);
curl_close ($ch);
echo print_r($result);
// {status: 200, code: "wCbq4YoBd0UpSN", title: "bash.txt" , url:"https://evoload.io"}

$final_url = $result['url']. "/e/". $result['code'];
echo $final_url;

// returns https://evoload.io/e/wCbq4YoBd0UpSN
?>
