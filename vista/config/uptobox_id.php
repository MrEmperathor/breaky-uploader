<?php
if (isset($_POST['valorCaja1']) && isset($_POST['valorCaja2'])) {
    // $nombre = $_POST['valorCaja1'];
    // $apellido = $_POST['valorCaja2'];

    // echo "Usuario" . $nombre . " " . $apellido . " fue creado felixente"; 


    $curl = curl_init();
    $user = $_POST['valorCaja1'];
    $password = $_POST['valorCaja2'];
    $login = "login=".$user."&password=".$password;
    // var_dump($login);


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
        if (empty($cookies['xfss'])) {

            echo '<div class="alert alert-danger" role="alert">
                    No se encontro Su ID, Verifique los datos e intente nuevamente denotro de 15 min!
                </div>';
        }else{
            echo '<div class="alert alert-success" role="alert">
                    Exito!! Su id es: '.$cookies['xfss'].'
                </div>';
        }

    }
}