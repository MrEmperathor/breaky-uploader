<?php
include 'conexion.php';
// Borra los datos del administrador seleccionado
$borrar = "delete from administrador where documento=$_REQUEST[borrar]";
//Ejecutar consulta
$resultado= mysqli_query($conexion, $borrar);
if (!$resultado) {
	
	//muestra el mensaje error al borrar administrador
	header("location:../vista/listado_administradores.php?errorborrar");
	
} else {
	header("location:../vista/listado_administradores.php");
}
//Cerrar conexion
mysqli_close($conexion);
?>