<?php 
include '../xion/conexion.php';

if ($_GET) {
	$id = $_GET['i'];
	$sql_unico = 'SELECT * FROM pelis WHERE id=?';

	$gsent_unico = $pdo->prepare($sql_unico);
	$gsent_unico->execute(array($id));

	$resultado_unico = $gsent_unico->fetch();


	echo '<pre>'.$resultado_unico['7FREE'].'</pre>';



	}

 ?>