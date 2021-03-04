<?php
include 'conexion.php';
//Recibir los datos y almacenarlos en variables
$novedades = $_POST["observaciones"];
// Inserta la novedad
$actualizar = "insert into novedades (observacion) values ('$novedades')";
//Ejecutar consulta
$resultado= mysqli_query($conexion, $actualizar);
if (!$resultado) {
	
	header("location:../vista/novedades_vigilante.html");
	
} else {

	header("location:../vista/inicio_vigilante.php");
}
//Cerrar conexion
mysqli_close($conexion);
?>