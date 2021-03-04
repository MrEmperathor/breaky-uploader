<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'gdrive.php';
use \Marxvn\gdrive;
// $u = 'https://drive.google.com/file/d/1ZnSDcxIenRXBsL0KUYJsr1Pi_fwRCPJK/view';
$u = 'https://drive.google.com/file/d/1Wjq7TJDQoWq78kmaAXVerovxttb27Ygy/view';
$gdrive = new gdrive;
$gdrive->getLink($u);
$links = json_decode($gdrive->getSources());


echo('<pre>');
print_r($links);
var_dump($links[0]);
echo('</pre>');

// $resultado = file_get_contents($links[0]->file);
// file_put_contents('pelicula1.mp4', $resultado);

// $handle = fopen($links[0]->file, "r");
// $contents = stream_get_contents($handle);
// fclose($handle);
// echo 'Se ha descargado la pelicula';

// echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

// $navegador = get_browser();
// print_r($navegador);
