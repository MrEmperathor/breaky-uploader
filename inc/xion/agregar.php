#!/usr/bin/php
<?php 

// include '/var/www/html/panel/inc/xion/conexion.php';
// include($_SERVER['DOCUMENT_ROOT'].'/panel/inc/xion/conexion.php');
// $ruta = str_replace(basename(__FILE__), "", __FILE__);
// $rr1 = str_replace("/include/", "/xion/", $ruta);
// include($rr1.'conexion.php');
// include 'conexion.php';

// LEER DATOS DE COLOUMNA

/* $sql_leer = 'SELECT * FROM pelis';

$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado = $gsent->fetchAll();
*/
// PINTAR ARRAY
// var_dump($resultado);


// foreach ($resultado as $dato) {
// 	echo $dato['links'];
// }


// AGREGAR
// $argv[1];
if($argv){

	// unset($argv[0]);
	// $e = base64_decode($argv[1]);
	$enlaces = (empty($argv[1])) ? " " : base64_decode($argv[1]);
	$iid = (empty($argv[2])) ? " " : $argv[2];
	if(!empty($argv[3])) $permiso = $argv[3];
	$bc = base64_decode($argv[4]);

	$backup_url = (empty($bc)) ? " " : $bc;
	// $permiso = (empty($argv[3])) ? " " : $argv[3];
	
	

	// $descarga = (empty($argv[2])) ? " " : $argv[2];
	// $lvip =(empty($argv[3])) ? " " : $argv[3];
	// $lfree = (empty($argv[4])) ? " " : $argv[4];
	// $iid = (empty($argv[5])) ? " " : $argv[5];

	include 'conexion.php';


	
	$sql_editar = 'UPDATE pelis SET links=?, Backup=? WHERE id=?';
	$sentencia_editar = $pdo->prepare($sql_editar);
	$sentencia_editar->execute(array($enlaces,$backup_url,$iid));

	//cerramos conexión base de datos y sentencia
	$pdo = null; 
	$sentencia_editar = null; 



	// include_once 'conexion.php';

	// $sql_editar = 'UPDATE pelis SET 7VIP=?,7FREE=? WHERE id=?';
	// $sentencia_editar = $pdo->prepare($sql_editar);
	// $sentencia_editar->execute(array($tvip,$tfree,$calidad));

	// //cerramos conexión base de datos y sentencia
	// $pdo = null; 
	// $sentencia_editar = null; 

	// realizamos la consulta para obtener el mayor id insertado
 //  $sql = "SELECT MAX(id) AS id FROM pelis";
	// // $sql = "SELECT id, nombre FROM pelis ORDER BY id DESC LIMIT 5";
 //  $query = $pdo->prepare($sql);
 //  $query->execute();
 //  $row = $query->fetch();
 
 //  // imprimimos el valor obtenido, en este caso el mayor id insertado en una tabla
 //  print "\n";
 //  echo $row['id'];
 //  // var_dump($row);
 //  print "\n";

// do {
//     echo $row['campo_id'].' - '.$row['campo_name'].'<br>';
//   } while ($rows = $query->fetch());





	// $sql_agregar = 'INSERT INTO pelis (TMDB,nombre,calidad,idioma,links,DLinks,LVIP,LFREE,7VIP,7FREE) VALUES (?,?,?,?,?,?,?,?,?,?)';
	// $sentencia_agregar = $pdo->prepare($sql_agregar);
	// $sentencia_agregar->execute(array($TMBDid,$name,$calidad,$idioma,$enlaces,$descarga,$lvip,$lfree,$tvip,$tfree));

	// //cerramos conexión base de datos y sentencia
 //    $sentencia_agregar = null;
 //    $pdo = null;
 //    // header('location:index.php');


}

// if ($_GET) {
// 	$id = $_GET['id'];
// 	$sql_unico = 'SELECT * FROM colores WHERE id=?';

// 	$gsent_unico = $pdo->prepare($sql_unico);
// 	$gsent_unico->execute(array($id));

// 	$resultado_unico = $gsent_unico->fetch();

// 	// var_dump($resultado_unico);


// }
// <?php echo("<img src='". $config['images']['base_url'] . $config['images']['poster_sizes'][4] . $result['poster_path'] . "'/>"); 

