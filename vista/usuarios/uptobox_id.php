<?php

$curl = curl_init();
$user = $_POST['emaill'];
$password = $_POST['passwordd'];
$login = "login=".$user."&password=".$password;

echo $login;

curl_setopt_array($curl, array(
CURLOPT_URL => "https://uptobox.com/login",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HEADER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_SSL_VERIFYHOST => 0,
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => $login,
));

$response = curl_exec($curl);
$err = curl_error($curl);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
$cookies = array();
foreach($matches[1] as $item) {
parse_str($item, $cookie);
$cookies = array_merge($cookies, $cookie);
}

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
// echo $cookies['xfss'];
}

if (empty($cookies['xfss'])) {
    echo 'la variable no existe!!';
}else{
    var_dump($cookies);
}

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