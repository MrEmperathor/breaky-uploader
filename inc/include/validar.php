#!/usr/bin/php
<?php 
$ruta = str_replace(basename(__FILE__), "", __FILE__);
$rr1 = str_replace("/include/", "/xion/", $ruta);

if ($argv) {
	$id = $argv[1];
	if(!empty($argv[2])) $permiso = $argv[2];
	include_once($rr1.'conexion.php');

	$sql_leer = "SELECT * FROM pelis WHERE TMDB LIKE '%$id%' ORDER BY TMDB";
	$gsent = $pdo->prepare($sql_leer);
	$gsent->execute();

	$resultado = $gsent->fetchAll();
print "\n";
	foreach ($resultado as $datos) {
		echo $datos['nombre']." ".$datos['calidad']." ".$datos['idioma'];
		print "\n";
	}
print "\n";


}

 ?>