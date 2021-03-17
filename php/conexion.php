<?php 
session_start();
include('../inc/config.php');
if ($_SESSION['nombre'] == $CONFIG["EmbedUser"]) {
	$bd = $CONFIG["nameBase"];
}else{
	$bd = $CONFIG["nameBase2"];
}

$servidor = $CONFIG["LocalHost"];
$usuario = $CONFIG["dbUser"];
$password = $CONFIG["dbPass"];

function conexion(){
	global $servidor, $usuario, $password, $bd;

	// $servidor="localhost";
	// $usuario="root";
	// $password="Alberthvps20199";
	// $bd="uploaddl";

	$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
	// $link = 'mysql:host=localhost;dbname=uploaddl';
	// $usuario = 'root';
	// $pass = 'muJK6V3T2GAW';

	// try{
	// 	$conexion = new PDO($link, $usuario, $pass);

	// 	// echo "Conectado";

	// // 	foreach($pdo->query('SELECT * FROM `pelis`
	// // ') as $fila) {
	// //         print_r($fila);
	// // }


	// }catch (PDOException $e) {
	//     print "¡Error!: " . $e->getMessage() . "<br/>";
	//     die();
	// }

	return $conexion;
}



 ?>