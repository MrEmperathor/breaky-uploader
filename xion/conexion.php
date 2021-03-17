<?php 
require_once(__DIR__ . '/../config.php');

$nameBase = $CONFIG["nameBase"];
$link = 'mysql:host=localhost;dbname=' . $nameBase;
$usuario = $CONFIG["dbUser"];
$pass = $CONFIG["dbPass"];
$servername = "localhost";

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