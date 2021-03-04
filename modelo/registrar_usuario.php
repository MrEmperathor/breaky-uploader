<?php
include 'conexion.php';
//Recibir los datos y almacenarlos en variables
$nombre = $_POST["nombre"];
$documento = $_POST["documento"];
$vehiculo = $_POST["vehiculo"];
$placa = $_POST["placa"];



// Consulta para insertar
$insertar=$mysql->query("INSERT INTO usuario(nombre, documento, vehiculo, placa, horaingreso) VALUES ('$nombre','$documento', '$vehiculo', '$placa', now())");
      if ($mysql->error)
	  {
		  //muestra el mensaje error al registrar el ingreso del usuario
		  die (header("location:../vista/ingreso_usuario.php?error"));
          echo 'Error al registrarse';
	  }
	  
if (!$insertar) {
	
	//muestra el mensaje error al registrar el ingreso del usuario
	header("location:../vista/ingreso_usuario.php?error");
    echo 'Error al registrarse';
} else {
	//muestra el mensaje ingreso del usuario registrado
	header("location:../vista/inicio_vigilante.php?registrado");
    echo 'Usuario registrado exitosamente';
}
//Cerrar conexion
$mysql->close();
?>