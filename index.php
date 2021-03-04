<?php 

include "controlador/app.php";
 
    if(isset($_SESSION['nombre'])){
        include "vista/header.php";
        include "partials/_navbar.php"; 
        include "partials/_sidebar.php"; 
        // var_dump($_COOKIE["usuario"]);
        echo '
        <div class="main-panel">
                 <div class="content-wrapper">';
        
                 $id = $_GET['id'];
                 if($id === 'pelis'){
                  include "inc/pelis.php";
                 }elseif($id === 'series'){
                  include "inc/seri.php";
                 }elseif($id === 'uptobox_sessid'){
                  include "vista/cms/uptobox_sessid.php";
                 }elseif($id === 'sc'){
                  include "vista/cms/sc.php";
                }elseif($id === 'generar-comando'){
                  include "vista/cms/generar-comandos.php";
                 }else{
                  include "vista/cms/index.php";
                 }
                  
                   
        echo '</div> </div></div>';
                 
        include "vista/footer.php";        
    }else{
        header('location: /panel/login.php');
      }
    




?>
       