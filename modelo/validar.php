<?php

include "../controlador/app.php";
// require_once('../inc/xion/conexion.php');
include '../inc/config.php';
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
$documento=$_POST['documento'];
$contrasena=$_POST['contrasena'];

if($CONFIG["EmbedUser"] === $documento && $CONFIG["EmbedPass"] === $contrasena) {

	if (empty($_COOKIE['usuario'])) {
		$datos_validar = base64_encode("esternocleitomastoideo");
		setcookie("usuario", $datos_validar, time() + 84600, "/");
	}
	
	// $datos_validar = base64_encode("esternocleitomastoideo");
	// setcookie("usuario", $datos_validar, time() + 84600);
	$_SESSION["validar"]="true";
	$_SESSION["password"]= $CONFIG["EmbedPass"];
	$_SESSION["nombre"]= $CONFIG["EmbedUser"];

	$_SESSION["apellido"]= "Breaky";
	$_SESSION["cargo"] = "administrador";
		$datos_validar = base64_encode("esternocleitomastoideo");


// $datos_validar = base64_encode("esternocleitomastoideo");
// 		setcookie("usuario", $datos_validar, time() - 84600);
// var_dump($_COOKIE["usuario"]);
	header("location:../?id=cms");
}elseif ($CONFIG["EmbedUser2"] === $documento && $CONFIG["EmbedPass2"] === $contrasena) {

	if (empty($_COOKIE['usuario'])) {
		$datos_validar = base64_encode("esternocleitomastoideo2");
		setcookie("usuario", $datos_validar, time() + 84600, "/");
	}
	$_SESSION["validar"]="true";
	$_SESSION["password"]= $CONFIG["EmbedPass"];
	$_SESSION["nombre"]= $CONFIG["EmbedUser2"];

	$_SESSION["apellido"]= "Breaky";
	$_SESSION["cargo"] = "administrador";
	header("location:../?id=cms");
}
else{
	// muestra error de autentificacion
		header("location:../index.php?error");
}

?>