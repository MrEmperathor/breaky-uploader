<?php
include 'conexion.php';
//Recibir los datos y almacenarlos en variables
$nombre = $_POST["nombre"];
$documento = $_POST["documento"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$contrasena=$_POST["contrasena"];

// Actualiza los datos del administrador seleccionado
$actualizar = "update administrador set documento=$documento, nombre='$nombre', correo='$correo',telefono=$telefono, contrasena='$contrasena' where documento=$documento";
//Ejecutar consulta
$resultado= mysqli_query($conexion, $actualizar);
if (!$resultado) {
	//muestra el mensaje error al actualizar administrador
	header("location:../vista/listado_administradores.php?error");
	
} else {
	//muestra el mensaje administrador actualizado
	header("location:../vista/listado_administradores.php?actualizado");
}
//Cerrar conexion
mysqli_close($conexion);
?>