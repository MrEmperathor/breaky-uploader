<?php
include 'conexion.php';
//Recibir los datos y almacenarlos en variables
$nombre = $_POST["nombre"];
$documento = $_POST["documento"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$contrasena = $_POST["contrasena"];
// Consulta para insertar
$insertar = "INSERT INTO vigilante (nombre, documento, correo, telefono, contrasena) VALUES ('$nombre',
'$documento', '$correo', '$telefono', '$contrasena')";
//Ejecutar consulta
$resultado= mysqli_query($conexion, $insertar);
if (!$resultado) {
	header("location:../vista/nuevo_vigilante.php?error");
    
} else {
	header("location:../vista/inicio_administrador.php?registrado");
}
//Cerrar conexion
mysqli_close($conexion);

?>