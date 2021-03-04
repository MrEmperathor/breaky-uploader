<?php
require_once('../inc/config.php');
session_start(); // este por si no la has iniciado en la pagina que planeas destruirla, de lo contrario no te destruirá nada

if($_SESSION["nombre"] = $CONFIG["EmbedUser"]){

    $datos_validar = base64_encode("esternocleitomastoideo");
    setcookie("usuario", $datos_validar, time() - 84600, "/");

}elseif ($_SESSION["nombre"] = $CONFIG["EmbedUser2"]) {

    $datos_validar = base64_encode("esternocleitomastoideo2");
    setcookie("usuario", $datos_validar, time() - 84600, "/");
}

session_destroy();
session_unset();

header("Location: ../index.php");
die();