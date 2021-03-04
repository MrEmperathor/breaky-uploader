<?php
require('modelo/conexion.php');

$sql = "DELETE FROM `usuario_datos` WHERE `id` = " . $_GET["item"];

if ($conexion->query($sql) === TRUE) {
    echo '<script>
			alert("Elemento Eliminado");
 			window.location="?id=agregar_datos&usuario='.$_GET["usuario"] .'";
          </script>';
} else {
    echo '<script>
             alert("Elemento Eliminado");
             window.location="?id=agregar_datos&usuario='.$_GET["usuario"] .'";
          </script>';
}

$conexion->close();

die();
