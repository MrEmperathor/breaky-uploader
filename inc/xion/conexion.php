<?php 
require(__DIR__ . '/../config.php');
// require_once('inc/config.php');
// include(realpath(dirname(__FILE__) . '/../config.php'));
// require_once($_SERVER['DOCUMENT_ROOT']."/panel/inc/config.php");



// if ($permiso == "admin2") {

    

// }else {
//     session_start();
//     if ($_SESSION['nombre'] == $CONFIG["EmbedUser"]) {

//         $nameBase = $CONFIG["nameBase"];
    
//     }elseif ($_SESSION['nombre'] == $CONFIG["EmbedUser2"]) {
    
//         $nameBase = $CONFIG["nameBase2"];
        
//     }
// }

if (!empty($permiso) == "admin2") {

    $nameBase = $CONFIG["nameBase2"];

}else {
    $nameBase = $CONFIG["nameBase"];
    if (!empty($_SESSION)) {
        if ($_SESSION['nombre'] == $CONFIG["EmbedUser"]) $nameBase = $CONFIG["nameBase"];
        if ($_SESSION['nombre'] == $CONFIG["EmbedUser2"]) $nameBase = $CONFIG["nameBase2"];
    }
    

}


    $link = 'mysql:host=localhost;dbname=' . $nameBase;
    $usuario = $CONFIG["dbUser"];
    $pass = $CONFIG["dbPass"];


try{
	$pdo = new PDO($link, $usuario, $pass);

	// echo "Conectado";

// 	foreach($pdo->query('SELECT * FROM `pelis`
// ') as $fila) {
//         print_r($fila);
// }


}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

 ?>