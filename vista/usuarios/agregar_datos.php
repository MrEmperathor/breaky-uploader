<?php

require('modelo/conexion.php');


$sql = "SELECT * FROM `usuarios` WHERE `documento` = ".$_GET['usuario'];
$result = $conexion->query($sql);

if ($result->num_rows>0) {
    $cliente = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $cliente = null;
}

$sql = "SELECT * FROM `usuario_datos` WHERE `usuario_id` = " . $cliente[0]["id"] . " AND `tipo` = 1";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $emails = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $emails = null;
}

$sql = "SELECT * FROM `usuario_datos` WHERE `usuario_id` = " . $cliente[0]["id"]  . " AND `tipo` = 2";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $telefonos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $telefonos = null;
}

$sql = "SELECT * FROM `usuario_datos` WHERE `usuario_id` = " . $cliente[0]["id"] . " AND `tipo` = 3";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $direcciones = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $direcciones = null;
}

$sql = "SELECT * FROM `usuario_datos` WHERE `usuario_id` = " . $cliente[0]["id"] . " AND `tipo` = 4";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $bicicletas = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $bicicletas = null;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
   
    $sql= 'UPDATE usuarios SET nombre = "'.$_POST["nombre"].'", nombre2 = "'.$_POST["nombre2"].'", apellido = "'.$_POST["apellido"].'", apellido2= "'.$_POST["apellido2"].'" WHERE documento = "'.$cliente[0]['documento'].'"';
    if ($conexion->query($sql) === TRUE) {

        if($_POST["tipo"]==4){
            $color=TRUE;
        }

        echo $sql = "INSERT INTO `usuario_datos` (`id`, `tipo`, `usuario_id`, `dato`,  `color`) VALUES (NULL, '" . $_POST["tipo"] . "', '" . $_POST["usuario_id"] . "', '" . $_POST["dato"] . "','" . $_POST["color"] . "');";
        if ($conexion->query($sql) === TRUE) {
            echo '<script>
                alert("Usuario Registrado Complete Datos Adicionales");
                window.location = "?id=agregar_datos&usuario='.$cliente[0]['documento'] .'";
            </script>';
                    die();
        } else {
            echo "Ocurrio un error, por favor vuelve a intentarlo 1";
        }

    }else {
            echo "Ocurrio un error, por favor vuelve a intentarlo 2";
    }
}

$conexion->close();

$hide = false;


?>

<style>
    li {
        padding-bottom: 5px !important;
        padding-top: 5px !important;
    }
</style>

<!-- Ruta-->

<div class="container col-md-12 ">
    <div class="card">

        <div class="content-wrapper">
            <div class="col-md-12 text-center p-4">
                <a class="btn btn-danger" href="?id=actualizar">Volver</a>
            </div>

            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body   ">
                        <form class="form-inline" method="post">
                            <div class="form-group ">
                            <span>
                                <p> Documento:
                                    <input class="form-control " name="documento" placeholder="Documento"
                                        value="<?php echo $cliente[0]['documento']?> "
                                        style="width: 160px; display: inline !important;" required readonly>    
                                </p><br>
                                

                                <p>Prim Nombre:
                                    <input class="form-control " name="nombre" placeholder="Primer Nombre"
                                        value="<?php echo $cliente[0]['nombre']?> "
                                        style="width: 160px; display: inline !important;" required><br>
                                </p>

                                <p>Seg Nombre : </h4>
                                    <input class="form-control " name="nombre2" placeholder="Segundo Nombre"
                                        value="<?php echo $cliente[0]['nombre2']?> "
                                        style="width: 160px; display: inline !important;" required><br>
                                </p>
                                <p> Prim Apellido: </h4>
                                    <input class="form-control " name="apellido" placeholder="Primer apellido"
                                        value="<?php echo $cliente[0]['apellido']?> "
                                        style="width: 160px; display: inline !important;" required><br>
                                </p>
                                <p> Seg Apellido:
                                    <input class="form-control " name="apellido2" placeholder="Segundo Apellido"
                                        value="<?php echo $cliente[0]['apellido2']?> "
                                        style="width: 160px; display: inline !important;" required><br></h4>
                                </span> 
                            </div>
                           

                            <p>Agregar un dato: </p>
                           
                            <input type="hidden" name="usuario_id" value="<?php echo $cliente[0]["id"] ?>">
                                <div class="form-group mb-2 col-md-12">
                                    <select class="form-control" required name="tipo">
                                        <option value="">Seleccionar...</option>
                                        <option value="4">Bicicletas</option>
                                        <option value="3">Direccion</option>
                                        <option value="2">Telefono</option>
                                        <option value="1">Email</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <div class="input-group p-2" id="dato">
                                        <input class="form-control " name="dato" placeholder="Dato"
                                            style="width: 160px;" required><br>
                                    </div><br>

                                    <div class="row input-group p-2" id="color">
                                        <input class="form-control " name="color" placeholder="Color Bicicleta"
                                            style="width: 130px;">
                                    </div>

                                </div>
                            <button type="submit"  class="btn btn-primary mb-2 p-3">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
               
                <div class="col-lg-6 grid-margin my-auto    stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Direciones</h4>
                            <table class="table">
                                <tbody>
                                    <?php for ($i = 0; $i < @count($direcciones); $i++){
                        echo '<tr><td>'.$direcciones[$i]['dato'].'</td>';
                        echo '<td><a class="btn btn-danger btn-sm float-right" href="?id=borrar_dato&usuario='.$_GET['usuario'].'&item='.$direcciones[$i]['id'].'" onclick="return confirm("¿Estas seguro?")">Eliminar</a></td></tr>';
                        } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Telefonos</h4>
                            <table class="table">
                                <tbody>
                                    <?php for ($i = 0; $i < @count($telefonos); $i++){
                        echo '<tr><td>'.$telefonos[$i]['dato'].'</td>';
                        echo '<td><a class="btn btn-danger btn-sm float-right" href="?id=borrar_dato&usuario='.$_GET['usuario'].'&item='.$telefonos[$i]['id'].'" onclick="return confirm("¿Estas seguro?")">Eliminar</a></td></tr>';
                        } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Emails</h4>
                            <table class="table">
                                <tbody>
                                    <?php for ($i = 0; $i < @count($emails); $i++){
                        echo '<tr><td>'.$emails[$i]['dato'].'</td>';
                        echo '<td><a class="btn btn-danger btn-sm float-right" href="?id=borrar_dato&usuario='.$_GET['usuario'].'&item='.$emails[$i]['id'].'" onclick="return confirm("¿Estas seguro?")">Eliminar</a></td></tr>';
                        } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bicicletas</h4>
                            <table class="table">
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th>Identificador Bicicleta</th>
                                            <th>Color</th>
                                        </tr>
                                    </thead>
                                    <?php for ($i = 0; $i < @count($bicicletas); $i++){
                        echo '<tr><td>'.$bicicletas[$i]['dato'].'</td></td><td>'.$bicicletas[$i]['color'].'</td>';
                        echo '<td><a class="btn btn-danger btn-sm float-right" href="?id=borrar_dato&usuario='.$_GET['usuario'].'&item='.$bicicletas[$i]['id'].'" onclick="return confirm("¿Estas seguro?")">Eliminar</a></tr>';
                        } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center p-4">
                    <a class="btn btn-danger" href="?id=actualizar">Volver</a>
                </div>

            </div>








        </div>
    </div>



</div>

<script>

    $('#color').hide();

    $('select').change(function () {
        if ($(this).val() == '4') {
            $('#dato').show();
            $('#color').show();
        } else {
            $('#dato').show();
            $('#color').hide();
        }
    });

</script>