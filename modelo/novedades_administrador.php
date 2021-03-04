<?php
include 'conexion.php';
//Recibir los datos y almacenarlos en variables
$novedades = $_POST["novedades"];
// Inserta la novedad
$actualizar = "insert into novedades (observacion, rol) values ('$novedades', 'administrador')";
//Ejecutar consulta
$resultado= mysqli_query($conexion, $actualizar);
if (!$resultado) {
	
	header("location:../vista/novedades_administrador.html");
	
} else {
	
	header("location:../vista/inicio_administrador.php");
}
//Cerrar conexion
mysqli_close($conexion);
?>