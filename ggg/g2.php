<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$file = 'https://drive.google.com/get_video_info?docid=1ZnSDcxIenRXBsL0KUYJsr1Pi_fwRCPJK';

$curl = curl_init($file);

curl_setopt_array($curl , [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => true,
    CURLOPT_FRESH_CONNECT => true,
    CURLOPT_SSL_VERIFYPEER => true,

]);
// HERE WE GOT THE COOKIES
$data = curl_exec($curl);

preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $data, $result);
$dataA = urldecode(urldecode($data));
$data = explode('|' , $dataA);
$data =  $data[4];
$urls = explode('&url=' , $data);
curl_close($curl);

preg_match('/(&fmt_stream_map=)(.*)(&url_encoded_fmt_stream_map)/', $dataA, $matches);
$NEWURLA = urldecode($matches[2]);
$UR = explode('|', $NEWURLA);
$inicial = substr($UR[1], 0, -3);

$opciones = array('http' => array(
    'method' => 'GET',
    'header'  => 'Cookie: '.$result[1][0].'; '.$result[1][2].';\r\n'
));
$contexto  = stream_context_create($opciones); //crea el contexto para el stream
$resultado = file_get_contents($inicial, false, $contexto, -1, 3000000);
file_put_contents('pelicula1.mp4', $resultado, FILE_APPEND | LOCK_EX);
echo 'Se ha descargado la pelicula';

echo('<pre>');
echo $inicial;
echo('</pre>');