<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

require_once('dom/simple_html_dom.php');
// include_once('functions/funtions.php');

// require('dom/Snoopy.class.php');

include_once "class.php";


if(isset($_GET['url'])) $url = $_GET['url'];
if(isset($_GET['pl'])) $pl   = $_GET['pl'];


if (isset($url)) {

    $class          = new ExtraEnlaces();
    $urls           = $class->EnlacesHome($url);
    $playersl       = $class->EnlacePlayerIdioma($urls["enlace"]);
    


    $urls["player"] = $playersl;

    echo json_encode($urls);


    // echo('<pre>');
    // print_r($urls);
    // echo('</pre>');
}elseif (isset($pl)) {

    $class      = new ExtraEnlaces();
    // echo 'tratando de entrar a '. $pl. '<br>';
    // $enlacesD = $class->EnlacePlayerLink($pl."&lang=en");

    $pl         = base64_decode($pl);
    $enlacesD   = $class->EnlacePlayerLink($pl);

    echo json_encode($enlacesD);

    // echo('<pre>');
    // print_r($enlacesD);
    // echo('</pre>');

}elseif (isset($_GET["id"])) {

    $nombre_peli = $_GET["id"];
    include('TMDb.php');
 
    $tmdb           = new TMDb('be58b29465062a3b093bc17dacef8bf3', 'es');
    $pelis          = $tmdb->searchMovie($nombre_peli);

    echo json_encode($pelis);

}elseif (isset($_GET["peso"])) {
    
    $idGd           = new ExtraEnlaces();
    $presoResicido  = $idGd->BuscarPeso($_GET["peso"]);

    echo json_encode($presoResicido);

}
// }elseif ($pl) {

//     $class = new ExtraEnlaces();
//     $playersl = $class->EnlacePlayerIdioma($pl);
//     echo json_encode($playersl);

//     // foreach ($playersl as $key => $value) {
//     //     $enlacesD = $class->EnlacePlayerLink($value);
//     // }
// }








// $playersl = $class->EnlacePlayerIdioma($urls["enlace"][0]);

// $enlacesD = $class->EnlacePlayerLink($playersl[0]);
// print_r($enlacesD);


// echo "Hola mundo";

?>