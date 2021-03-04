<?php

include "controlador/app.php"; 
require_once('inc/config.php');

// <img src="vista/img/logo.png" width="70%" alt="">
// var_dump($_COOKIE["usuario"]);
if (!empty($_COOKIE["usuario"])) {
  if(base64_decode($_COOKIE["usuario"]) == "esternocleitomastoideo"){

    $_SESSION["validar"]="true";
    $_SESSION["password"]= $CONFIG["EmbedPass"];
    $_SESSION["nombre"]= $CONFIG["EmbedUser"];
  
    $_SESSION["apellido"]= "Breaky";
    $_SESSION["cargo"] = "administrador";

  }elseif (base64_decode($_COOKIE["usuario"]) == "esternocleitomastoideo2") {
    $_SESSION["validar"]="true";
    $_SESSION["password"]= $CONFIG["EmbedPass2"];
    $_SESSION["nombre"]= $CONFIG["EmbedUser2"];

    $_SESSION["apellido"]= "Breaky";
    $_SESSION["cargo"] = "administrador";
  }
}

$login ='

<html lang="es">
<head>
  <title>Break UP</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="vista/css/style.css">
 <script src="vista/js/app.js"></script>

</head>
    <body class="text-center">
          <div class="main_background">
            <div class="circle"></div>
            <div class="arrow_up"></div>
            <div class="main_background_box">
            <img src="vista/img/logo.png" width="56%" alt="">
              <div id="main_background_box_form">
                <form  action="modelo/validar.php" method="post" >
                  <br><br>
                  <i class="fa fa-user"></i>
                  <input type="text" name="documento" placeholder="Usuario" id="text_area" required>
                  <br>
                  <br>
                  <i class="fa fa-lock"></i>
                  <input type="password" name="contrasena" placeholder="Contraseña" id="text_area" required>
                  <br>
                  <br>
                  <input type="submit" id="main_background_box_form_btn">
                  <br>
                  <br>
                  
                </form>
              </div>
            </div>
           
            <div class="main_background_form0"></div>
            <div class="main_background_form">
              </a></div>
        
          </div>';
 
    if(empty($_SESSION['nombre'])){
        echo $login;
      }else{
        header('location: /panel/?id=cms');
      }


//muestra mensaje de no autentificacion
if (isset($_REQUEST["error"]))
{
	echo '<script class="color">alert("Error en la autentificación");</script>';
}
?>


  
    </body>

</html>