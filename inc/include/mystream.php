#!/usr/bin/php
<?php

// http://51.195.148.50/de/file/1/GGGG%20(720)%20LAT.mkv
// /var/www/html/de/file/1
include __DIR__ . '/../config.php';

$file = rawurlencode($argv[1]);
$ruta = $argv[2];
$IP = shell_exec("curl https://api.ipify.org/ 2>/dev/null");

$path = str_replace('/var/www/html', '', $ruta);
$uri = 'http://' . $IP . $path . '/' . $file;
$file_upload = "url=$uri&path=/";

$token = $CONFIG["mystream"];
$url_upload = "https://api.mystream.to/v1/remote-upload";
$url_info = "https://api.mystream.to/v1/file/";

function cURL($url_upload, $token, $file_upload = ''){

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "$url_upload"); 
    curl_setopt($ch, CURLOPT_HEADER, FALSE); 
    curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS,"client_id=$cliente_id&client_secret=$token&file_id=IdOfVideo&title=NEW_TITLE");
    curl_setopt($ch, CURLOPT_POSTFIELDS,"$file_upload");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: $token"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    
    $data = curl_exec($ch);
    
    curl_close($ch);
    $data = json_decode($data, true);
    return $data;
    // var_dump($data);//response data

}

$file_code_json = cURL($url_upload, $token, $file_upload);
$file_code = $file_code_json["result"]["file_code"];

// var_dump($file_code_json);

while (true) {
    if ($file_code_json["success"] == 1) {
        $curl_url = $url_info . $file_code . ' ' . '-H "Authorization: ' . $token.'"';
        $file_info = json_decode(shell_exec("curl $curl_url 2>/dev/null"), true);

        // var_dump($file_info);
        if (($file_info["success"] == 1)) {
            echo "https://embed.mystream.to/" . $file_code;
            break;
        }
    }else{
        echo "error al subir el archivo";
        break;
    }
    sleep(3);
    
}



?>
