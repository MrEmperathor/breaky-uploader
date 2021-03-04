<?php
ini_set('error_reporting', E_ALL|E_STRICT);
ini_set('display_errors', '1');



$tmdb_id = $_GET['id'];
$idioma = $_GET['idioma'];

if (!empty($tmdb_id)) {

    $permiso = 'admin2';

    include 'xion/conexion.php';
    $tamano = strlen($tmdb_id);

    $sql_leer = "SELECT * FROM pelis WHERE TMDB LIKE '%$tmdb_id%' ORDER BY TMDB";
    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute();

    $resultado = $gsent->fetchAll();

    $calidad = array();
    foreach ($resultado as $key => $value) {

        if($value["TMDB"] == $tmdb_id && $value["idioma"] == $idioma) $calidad[] = $value["calidad"];
        // if(strlen($value["calidad"]) == $tamano) $calidad[] = $value["calidad"];
    }

    if (in_array("(720)", $calidad)) {
        echo false;
    }else{
        echo true;
    }

    // echo('<pre>');
    // var_dump($resultado);
    // echo('</pre>');
}

?>