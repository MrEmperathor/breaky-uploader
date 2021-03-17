<?php

include "controlador/app.php";
require('modelo/conexion.php');

$datos =false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $sql = 'SELECT * FROM `usuarios` WHERE  `documento` =  "'.$_POST["documento"].'"  ';
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_all(MYSQLI_ASSOC);
            $hoy = date("Y-m-d H:i:s");
            $sql = 'SELECT * FROM `parqueos` WHERE usuario_id = "'.$usuario[0]["id"].'" AND horasalida = "" ';
            $result2 = $conexion->query($sql);
            if ($result2->num_rows > 0) {
                $parqueo = $result2->fetch_all(MYSQLI_ASSOC);
                $date1 = new DateTime($parqueo[0]["horaingreso"]);
                $date2 = new DateTime("now");
                $diff = $date1->diff($date2);
                $duracion = ( ($diff->days * 24 ) * 60 ) + ( $diff->i );
                $sql = 'UPDATE `parqueos` Set `horasalida` = "'.$hoy.'", `duracion` = "'.$duracion.'" WHERE horasalida= "" AND id = '.$parqueo[0]["id"].' ';
                $conexion->query($sql);
            }else{
                echo '<script>
                        alert("El usuario ingresado no esta dentro del parqueadero");   
                    </script>';
            }


    }else {
        
        $usuario = null;
        echo '<script>
        alert("El usuario ingresado no esta dentro del parqueadero");
        
      </script>';
    }

    
}


?>


<div class="container ">
            <div class="content-wrapper">
                    <div class="col-md-12 text-center p-4">
                        <a class="btn btn-danger" href="?id=cms">Volver</a>
                    </div>
                    <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body mt-5 mx-auto">
                            <form class="form-inline" method="post">
                                    <div class="form-group p-3 ">
                                        <span>Documento: <span>
                                        <input type="number" class="form-control p-4" name="documento" placeholder="Cedula" required>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">FINALIZAR</button>
                                    </div>
                            </form>
                            </div>
                        </div>
                    </div> 
                    
                    
                        </div>
            </div>
    </div>   
</div>