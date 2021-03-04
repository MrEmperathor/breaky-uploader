<?php

if (isset($_POST['nombre']) && isset($_POST['apellido'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    echo "Usuario" . $nombre . " " . $apellido . " fue creado felixente"; 
}





// echo $_POST['apellidos'];
// echo $_POST['direccion'];
// echo $_POST['genero'];
// echo $_POST['mayor'];

// $curl = curl_init();
// $user = $_POST['emaill'];
// $password = $_POST['passwordd'];
// $login = "login=".$user."&password=".$password;

// echo $login;

// curl_setopt_array($curl, array(
// CURLOPT_URL => "https://uptobox.com/login",
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_HEADER => true,
// CURLOPT_ENCODING => "",
// CURLOPT_MAXREDIRS => 10,
// CURLOPT_TIMEOUT => 30,
// CURLOPT_SSL_VERIFYHOST => 0,
// CURLOPT_SSL_VERIFYPEER => 0,
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => "POST",
// CURLOPT_POSTFIELDS => $login,
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);
// preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
// $cookies = array();
// foreach($matches[1] as $item) {
// parse_str($item, $cookie);
// $cookies = array_merge($cookies, $cookie);
// }

// curl_close($curl);

// if ($err) {
// echo "cURL Error #:" . $err;
// } else {
// // echo $cookies['xfss'];
// }

// if (empty($cookies['xfss'])) {
//     echo 'la variable no existe!!';
// }else{
//     var_dump($cookies);
// }

// echo '
// <div class="alert alert-success" role="alert">
//   A simple success alert—check it out!
// </div>'



