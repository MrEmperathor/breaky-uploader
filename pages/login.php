<?php 
echo "hola";
echo $_SESSION['usuario'];
if(empty($_SESSION['usuario'])){

?>

<html lang="es">
<head>
  <title>Bikes</title>
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
              <div id="main_background_box_form">
                <form  action="modelo/validar.php" method="post" >
                  <img src="vista/img/logo.png" width="70%" alt="">
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
        
          </div>


      <?php

}else{
  header('location: /index.php');
}
//muestra mensaje de no autentificacion
if (isset($_REQUEST["error"]))
{
	echo '<script class="color">alert("Error en la autentificación");</script>';
}
?>


  
    </body>

</html>