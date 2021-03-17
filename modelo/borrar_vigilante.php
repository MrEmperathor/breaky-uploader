<?php
include 'conexion.php';
// Borra los datos del vigilante seleccionado
$borrar = "delete from vigilante where documento=$_REQUEST[borrar]";
//Ejecutar consulta
$resultado= mysqli_query($conexion, $borrar);
if (!$resultado) {
	
	//muestra el mensaje error al borrar vigilante
	header("location:../vista/listado_vigilantes.php?errorborrar");
	
} else {
	header("location:../vista/listado_vigilantes.php");
}
//Cerrar conexion
mysqli_close($conexion);
?>