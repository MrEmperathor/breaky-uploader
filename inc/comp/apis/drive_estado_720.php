<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'gdrive.php';
use \Marxvn\gdrive;
$id = $_GET["id"];

if(isset($_GET["id"])){

    // $u = 'https://drive.google.com/file/d/1ZnSDcxIenRXBsL0KUYJsr1Pi_fwRCPJK/view';
    // $u = 'https://drive.google.com/file/d/1Wjq7TJDQoWq78kmaAXVerovxttb27Ygy/view';
    $u = 'https://drive.google.com/file/d/'.$id.'/view';
    $gdrive = new gdrive;
    $gdrive->getLink($u);
    $links = json_decode($gdrive->getSources());

    foreach ($links as $key => $value) {
        switch ($value->label) {
            case '360':
                $estado360 = true;
                break;
            case '480':
                $estado480 = true;
                break;
            case '720':
                $estado720 = true;
                break;
            case '1080':
                $estado1080 = true;
                break;
            default:
                echo "No hay calidad disponible";
                break;
        }
    }


    $estado720 = (!empty($estado720)) ? true : false; 
    $estado1080 = (!empty($estado1080)) ? true : false;
    $estado360 = (!empty($estado360)) ? true : false;
    $estado480 = (!empty($estado480)) ? true : false;

    $salida = array("p1080p" => $estado1080, "p720p" => $estado720, "p480p" => $estado480, "p360p" => $estado360);
    echo json_encode($salida);

    

    // echo('<pre>');
    // print_r($links);
    // var_dump($links[0]);
    // echo('</pre>');

    // $resultado = file_get_contents($links[0]->file);
    // file_put_contents('pelicula1.mp4', $resultado);

    // $handle = fopen($links[0]->file, "r");
    // $contents = stream_get_contents($handle);
    // fclose($handle);
    // echo 'Se ha descargado la pelicula';

    // echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

    // $navegador = get_browser();
    // print_r($navegador);
}
