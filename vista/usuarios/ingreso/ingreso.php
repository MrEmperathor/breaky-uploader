<?php
include "controlador/app.php";
require('modelo/conexion.php');

$datos =false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $sql = 'SELECT * FROM `usuarios` WHERE  `documento` =  "'.$_POST["documento"].'"';
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_all(MYSQLI_ASSOC);
        $_SESSION['ingreso_nombre'] = $usuario[0]["nombre"].' '.$usuario[0]["apellido"];
        $_SESSION['ingreso_id'] = $usuario[0]["id"];
        $_SESSION['ingreso_documento']= $usuario[0]["documento"];
        echo '<script>
 			window.location="?id=ingreso_informacion";
          </script>';
    }else {
        echo '<div class="alert alert-light alert-dismissible fade show" role="alert">
        <strong>EL USUARIO NO EXISTE!</strong> se recomienda hacer el registro por lo tanto no podra parquear.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }

    
}

?>


<div class="container ">
            <div class="content-wrapper">
                    <div class="col-md-12 text-center p-4">
                        <a class="btn btn-danger" href="index.php?id=cms">Volver</a>
                    </div>
                    <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body mt-5 mx-auto">
                            <form class="form-inline" method="post">
                                    <div class="form-group p-3 ">
                                        <span>Documento: <span>
                                        <input type="number" class="form-control p-4" name="documento" placeholder="Cedula" require>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">BUSCAR</button>
                                    </div>
                            </form>
                            </div>
                        </div>
                    </div> 
                    
                    
                        </div>
            </div>
    </div>   
</div>
