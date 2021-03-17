<?php
include 'conexion.php';
//Recibir los datos y almacenarlos en variables
$nombre = $_POST["nombre"];
$documento = $_POST["documento"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$contrasena=$_POST["contrasena"];

// Actualiza los datos del vigilante seleccionado
$actualizar = "update vigilante set documento=$documento, nombre='$nombre', correo='$correo',telefono=$telefono, contrasena='$contrasena' where documento=$documento";
//Ejecutar consulta
$resultado= mysqli_query($conexion, $actualizar);
if (!$resultado) {
	//muestra el mensaje error al actualizar vigilante
	header("location:../vista/listado_vigilantes.php?error");
	
} else {
	//muestra el mensaje vigilante actualizado
	header("location:../vista/listado_vigilantes.php?actualizado");
}
//Cerrar conexion
mysqli_close($conexion);
?>