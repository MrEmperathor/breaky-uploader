<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// file_put_contents('holaaaaaa.mp4', "holaaaa");
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

// stream_context_create(['socket' => ['bindto' => '[::]:0']])
// $opcioness = array('socket' => array(
//     'bindto' => '[::]:0'
// // ));
// $opcioness = array('http' => array(
//     'method'  => 'GET',
//         'header'  => 'Connection: close\r\n'.
//         'Content-type: text/plain;charset=UTF-8\r\n'.
//         'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6\r\n'
// ));
// $opciones1 = stream_context_create($opcioness);
// $data = file_get_contents($file, false, $opciones1);

preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $data, $result);
$cookiess = $result[1][0];
$cookies = str_replace('DRIVE_STREAM=' , '' , $cookiess);

// $result = array();
// foreach ($http_response_header as $hdr) {
//     if (preg_match('/^Set-Cookie:\s*([^;]+)/', $hdr, $matches)) {
//         parse_str($matches[1], $tmp);
//         for ($i=0; $i <=count($matches[1]) ; $i++) { 
//             $result[1][$i] = $tmp;
            
//         }
//     }
// }
// print_r($cookies);

echo "</br>-----COOKIES----</br>";
echo('<pre>');
var_dump($result);
var_dump($http_response_header);
echo('</pre>');
// HERE WE GOT THE STREAMING URLS
$dataA = urldecode(urldecode($data));
echo "</br>-----HEADERS----</br>";

echo('<pre>');
var_dump($dataA);
echo('</pre>');
// echo('<pre>');
// var_dump($http_response_header);
// echo('</pre>');
$data = explode('|' , $dataA);
$data =  $data[4];
$urls = explode('&url=' , $data);

curl_close($curl);
////////////////
echo "-----URLS DESCARGADAS----</br>";
echo('<pre>');
var_dump($urls);
echo('</pre>');

echo "</br>-----NEW URLS----</br>";
preg_match('/(&fmt_stream_map=)(.*)(&url_encoded_fmt_stream_map)/', $dataA, $matches);
$NEWURLA = urldecode($matches[2]);
// $result = str_replace('%2C', ',', $result);
$UR = explode('|', $NEWURLA);
$inicial = substr($UR[1], 0, -3);
echo('<pre>');
var_dump(substr($UR[1], 0, -3));
var_dump($UR);
echo('</pre>');

echo "</br>-----RESULT----</br>";

echo('<pre>');
var_dump($result);
echo('</pre>');

echo "</br>-----PARAMETROS A ENVIAR----</br>";

$opciones = array('http' => array(
    'method' => 'GET',
    'header'  => 'Cookie: '.$result[1][0].'; '.$result[1][2].';\r\n'
));
// $opciones = array('http' => array(
//     'method'  => 'GET',
//         'header'  => 'Connection: close\r\n'.
//         'Content-type: text/plain;charset=UTF-8\r\n'.
//         'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6\r\n'.
//         'Cookie: '.$result[1][0].'; '.$result[1][2].';\r\n'
// ));
// $opciones = array('http' => array(
//     'method' => 'GET',
//     'header'  => 'Connection: close\r\n'.
//     'Cookie: '.$result[1][0].'; '.$result[1][2].';\r\n'
// ));

$contexto  = stream_context_create($opciones); //crea el contexto para el stream
$resultado = file_get_contents($inicial);
// echo file_get_contents($inicial, false, $contexto);
file_put_contents('peliculaaa2.mp4', $resultado);
echo 'Se ha descargado la pelicula';

// echo "</br>-----RESULT FINAL----</br>";

// $coooo = $result[1][0].'; '.$result[1][2].';\r\n';
// $ch = curl_init($inicial);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// // get headers too with this line
// curl_setopt($ch, CURLOPT_HEADER, 1);
// // curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
// // curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
// curl_setopt($ch, CURLOPT_COOKIE, $coooo);
// $mipeli = curl_exec($ch);
// curl_close($ch);
// file_put_contents('peliculaaa4.mp4', $mipeli);
// echo 'Se ha descargado la pelicula';
// // echo('<pre>');
// // var_dump($opciones);
// // var_dump($resultado);
// // echo('</pre>');

// $opciones = array('http' =>
//     array(
//         'method'  => 'GET',
//         'header'  => 'Connection: close\r\n'.
//         'Content-type: text/plain;charset=UTF-8\r\n'.
//         'Referer: http://www.webanterior\r\n'.
//         'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6\r\n'.
//         'Cookie: variableCookie1=valorCookie1; variablecookie2=valor2; variablecookie3=valor3; SESSIONID=TkddJlDQnk7vKKj7KvcKptGRJKgrhv4yKHZNTVdttdfqWKtG1LdT!;\r\n'
//     )
// );
//  'header'=>'Connection: close\r\n'
// $contexto  = stream_context_create($opciones); //crea el contexto para el stream
// $resultado = file_get_contents('http://www.webexterna.com/fichero.asp', false, $contexto);



// 'array(2) {
//     [0]=>
//     array(3) {
//       [0]=>
//       string(36) "set-cookie: DRIVE_STREAM=NFaxTd_ay5s"
//       [1]=>
//       string(191) "set-cookie: NID=199=jaLlv31PkoIDXkFzFitrROshTlW4hMn24VdsPYwdc9dHPJvvq-ZLzg-TzjfIyHqpw21onTvAY5CbNLW-ZY2mM1_M8wyc54G4vgjAV4pyIbVjKAfMUjIkGZgzqLcHsqs-E6uBzzomIytcWhWCC7oWffcRrrvEHsb6we0i3dqT8Ko"
//       [2]=>
//       string(191) "set-cookie: NID=199=NIudhchnW4UddH-sVJFevv5SPxeZGWnATlaHGEulsLwxZbD4ltx8O5TzCQHeMGBcN-u1dh-TnEfG75dforY07eOqPK4ohcaZra5RkxHaCwAbr2qNb8cXUXtpNKfGXaPiPaBNkA1TuZtd0B_CzCNlPZniwbH6DJ1hGnh-8oI1Uho"
//     }
//     [1]=>
//     array(3) {
//       [0]=>
//       string(24) "DRIVE_STREAM=NFaxTd_ay5s"
//       [1]=>
//       string(179) "NID=199=jaLlv31PkoIDXkFzFitrROshTlW4hMn24VdsPYwdc9dHPJvvq-ZLzg-TzjfIyHqpw21onTvAY5CbNLW-ZY2mM1_M8wyc54G4vgjAV4pyIbVjKAfMUjIkGZgzqLcHsqs-E6uBzzomIytcWhWCC7oWffcRrrvEHsb6we0i3dqT8Ko"
//       [2]=>
//       string(179) "NID=199=NIudhchnW4UddH-sVJFevv5SPxeZGWnATlaHGEulsLwxZbD4ltx8O5TzCQHeMGBcN-u1dh-TnEfG75dforY07eOqPK4ohcaZra5RkxHaCwAbr2qNb8cXUXtpNKfGXaPiPaBNkA1TuZtd0B_CzCNlPZniwbH6DJ1hGnh-8oI1Uho"
//     }
//   }'


