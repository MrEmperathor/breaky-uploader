<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// $s = `rclone config --config=/var/www/.rclone/rclone.config`;
// var_dump($s);
// $c= `megadf --config /var/www/.megarc`;
// var_dump($c);

// var_dump(shell_exec('whoami'));
$ruta = $_GET['ruta'];
$nombre = $_GET['nombre'];
$tmdb = $_GET['tmdb'];
$idioma = $_GET['idioma'];
$id_drive = $_GET['iddrive'];


$ruta = "/var/www/html/de/file2/$ruta";
// $id_drive = "1JyePmaSRwvsAF_MPtaz-P7naTKSBik1V";
// $nombre = "prueba77720Tessemifinnal";
// $tmdb = 12342;
// $idioma = "INGLES";

$dd = `cd $ruta; 77 "$id_drive"`;
// var_dump($dd);
// var_dump(shell_exec('77 "'.$id_drive.'" "'.$ruta.'"'));
// system('sudo 77 "'.$id_drive.'" "'.$ruta.'"');


if(preg_match("/download completed/i", $dd)){
    echo "ARCHIVO DESCARGADO CON EXITO";
    $subida = `cd $ruta; 77de.sh "$tmdb" "$nombre" "$idioma" "${id_drive}"`;

}else{
    echo "no se pudo completar la descarga";
}


exit();