#!/usr/bin/php
<?php

// echo $_SERVER['DOCUMENT_ROOT']."../";
// echo __FILE__;
include __DIR__ . '/../config.php';

$cliente_id = $CONFIG["fembedCleinte"];
$cliente_secret = $CONFIG["fembedSecret"];


$RUU = $argv[1];
$MiPeli = $argv[2];

$IP = shell_exec("curl https://api.ipify.org/ 2>/dev/null");

$RUU=escapeshellarg($RUU);
$MiPeli=escapeshellarg($MiPeli);


$IP = str_replace("'", "", $IP);
$RUT = str_replace("'", "", $RUU);
$RUT = str_replace("/var/www/html/", "", $RUT);
$MiPeli = str_replace("'", "", $MiPeli);




// $IP = shell_exec("curl https://api.ipify.org/ 2>/dev/null");
// $ARCHIVO = shell_exec("ls  *.mkv *.mp4 *.avi *.mpg 2>/dev/null");
// echo $ARCHIVO;

// $RUTA = shell_exec('pwd');
// echo $RUTA;

//  $IP=escapeshellarg($IP); 
//  $RUTA=escapeshellarg($RUTA);
//  $ARCHIVO=escapeshellarg($ARCHIVO);

//  $IP = str_replace("'", "", $IP);
//  $RUTA = str_replace("'", "", $RUTA);
//  $ARCHIVO = str_replace("'", "", $ARCHIVO);
//  $RUTA = str_replace("/var/www/html/", "", $RUTA);

// $ARCHIVO2=preg_replace("/\s+/"," ",$ARCHIVO);
// $ARCHIVO2 = trim($ARCHIVO2);
// $RUTA2=preg_replace("/\s+/"," ",$RUTA);
// $RUTA2 = trim($RUTA2);


$MiPeli = rawurlencode($MiPeli);
// echo "$MiPeli";
print  "\n";
$iprt = "http://$IP/$RUT/$MiPeli";
// $iprt = rawurlencode($iprt);
// echo $iprt;

$file_array = array(
	"link" => $iprt,
	"headers" => "cine24h");

$file_json = (json_encode($file_array));
var_dump($file_json);
print  "\n";

// echo $iprt;
print  "\n";

function curl ($cliente_id,$token,$file_json){

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, 'https://www.fembed.com/api/download'); 
	curl_setopt($ch, CURLOPT_HEADER, FALSE); 
	curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS,"client_id=$cliente_id&client_secret=$token&file_id=IdOfVideo&title=NEW_TITLE");
	curl_setopt($ch, CURLOPT_POSTFIELDS,"client_id=$cliente_id&client_secret=$token&links=[$file_json]");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 

	$data = curl_exec($ch); 
	curl_close($ch);
	echo $data;
}
$cuenta = curl($cliente_id,$cliente_secret,$file_json);

// $cuenta = shell_exec('curl -X POST https://www.fembed.com/api/download -d "client_id="'.$cliente_id.'"&client_secret="'.$cliente_secret.'"" -d "links=[{\"link\": \""'.$iprt.'"\", \"headers\": \"pelishd\"}]" -H "Content-Type: application/x-www-form-urlencoded" 2>/dev/null');

// echo $cuenta;


$k = json_decode($cuenta, true);

// print_r($k);

$sID = $k['data'][0];
$sID=escapeshellarg($sID);
$TasID=preg_replace("/\s+/"," ",$sID);
$TasID = trim($TasID);


	$cuenta2 = shell_exec('curl -X POST https://www.fembed.com/api/downloading -d "client_id="'.$cliente_id.'"&client_secret="'.$cliente_secret.'"" -d "task_id="'.$TasID.'"" -H "Content-Type: application/x-www-form-urlencoded" 2>/dev/null');


$j = json_decode($cuenta2, true);

// print_r($j);


 if (isset($j['data'][0]['status'])) {
 	// echo "Esperando 5 Seg.";
 	sleep(5);

 while (true) {
 	
 	if (isset($j['data'][0]['file_id'])) {
 		// echo "ENLACES DE DESCARGA CONSEUIDO...";
 		$Link_Fembed = $j['data'][0]['file_id'];
 		print  "\n";
 		echo "https://www.fembed.com/f/".$Link_Fembed;
 		print  "\n";


 			// $cuenta2 = shell_exec('curl -X POST https://www.fembed.com/api/downloading -d "client_id=209631&client_secret=251793f59806ff50634bedb8ed00b860003b" -d "task_id="'.$TasID.'"" -H "Content-Type: application/x-www-form-urlencoded" 2>/dev/null');
 			// $j = json_decode($cuenta2, true);

 		// shell_exec('curl -X POST https://www.fembed.com/api/downloading -d "client_id=209631&client_secret=251793f59806ff50634bedb8ed00b860003b" -d "remove_ids=[\""'.$TasID.'"\"]" -H "Content-Type: application/x-www-form-urlencoded"');
 		break;

 	}
 	// echo "Esperando 15 Seg.";
 	sleep(5);
 	$cuenta2 = shell_exec('curl -X POST https://www.fembed.com/api/downloading -d "client_id="'.$cliente_id.'"&client_secret="'.$cliente_secret.'"" -d "task_id="'.$TasID.'"" -H "Content-Type: application/x-www-form-urlencoded" 2>/dev/null');
 	$j = json_decode($cuenta2, true);
 	// print_r($j);

 }

 }else{
 	echo $k['data'][0];
 }


 // $stringJSON = get_magic_quotes_gpc() ? stripslashes($_GET['jsonstring']) : $_GET['jsonstring']; 

// $datos = $argv[1];
// $jsonData = stripslashes(html_entity_decode($jsonData));

// $k=json_decode($jsonData,true);

// print_r($k);
// echo "......TODOS LOS DATOS RECIVIDOS.....";
// print_r($datos);
// $datos = stripslashes(html_entity_decode($datos));

// $k=json_decode($datos,true);


// echo $k['data'][0];
// print_r($k);

// do {
//     sleep(5);
// } while (isset($k['data']['file_id']));
// $daato = exec('curl -X POST https://www.fembed.com/api/account -d "client_id=209631&client_secret=251793f59806ff50634bedb8ed00b860003b" -H "Content-Type: application/x-www-form-urlencoded"');
// // $DataC = shell_exec('curl -X POST https://www.fembed.com/api/account -d "client_id=209631&client_secret=251793f59806ff50634bedb8ed00b860003b" -H "Content-Type: application/x-www-form-urlencoded');
// echo $daato;


 // if (isset($k['data'][0]['status'])) {
 // 	$IDvideo = $k['data'][0]['file_id'];

 // while (true) {
 // 	sleep(10);
 // 	if (isset($IDvideo)) {
 // 		echo $k['data'][0]['file_id'];
 // 		break;
 // 	}
 // }

 // }else{
 // 	echo $k['data'][0];
 // }






// echo "este es mi Identificacion:".$k['data']['id'];
// $json = json_decode($json, true);




?>
