<?php
include 'conexion.php';
//Recibir los datos y almacenarlos en variables
$documento = $_POST["documento"];
$placa = $_POST["placa"];

// Consultas para actualizar los datos del usuario

$vehiculo=$mysql->query("select * from usuario where documento=$documento and placa='$placa'");
 if ($mysql->error)
	  {
		   //muestra el mensaje error al registrar la salida del usuario
		   die (header("location:../vista/salida_usuario.php?error"));	
	  }
	  
$usu=$vehiculo->fetch_array();


//actualiza los datos del usuario
$mysql->query("update usuario 
set horasalida=now(), 
duracion=timediff(horasalida,horaingreso)
where documento=$usu[documento]");

if ($mysql->error)
	  {
		   //muestra el mensaje error no conincide el documento con la placa
		   die (header("location:../vista/salida_usuario.php?error2"));	
	  }

//seleccionar los datos del usuario actualizado
$consulta=$mysql->query("select * from usuario where documento=$documento")
or die ($mysql->error."aqui esta el error seleccionar");
$con=$consulta->fetch_array();

//copia los datos del usuario actualizado en la tabla cobrados

$mysql->query("insert into cobrados (documento, nombre, vehiculo, placa, horaingreso, horasalida, duracion) values ('$con[documento]','$con[nombre]','$con[vehiculo]','$con[placa]','$con[horaingreso]','$con[horasalida]','$con[duracion]')")
or die ($mysql->error."aqui esta el error copiar");


//borra los datos del usuario actualizado de la tabla usuario
$mysql->query("delete from usuario where documento=$documento")
or die ($mysql->error."aqui esta el error borrar");


if (!$vehiculo) {
	
	//muestra el mensaje error al registrar la salida del usuario
	header("location:../vista/salida_usuario.php?error");
} else {
	//muestra el mensaje registrada la salida del vehiculo
	header("location:../vista/inicio_vigilante.php?actualizado");
}
//Cerrar conexion
$mysql->close();
?>