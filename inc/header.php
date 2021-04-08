<?php 
require_once('comp/filevar.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $titleOriginal;?></title>

    <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">


<link rel="stylesheet" href="css/main.css">
<style>
    .fondo{
        height: 100vh;
        background: url('https://wallpaperplay.com/walls/full/0/2/3/57065.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    .top-nav-collapse{
        background: #0a3d62 !important;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12) !important;
    }
</style>
</head>
<body>
    

    <nav class="navbar navbar-expand-lg navbar-dark gris scrolling-navbar fixed-top text-white">
        <div class="container">
            <a class="navbar-brand" href="/panel/">
                <img src="img/logo.png" alt="Breackupload" style="width: 7%;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/panel/?id=pelis">Peliculas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/panel/?id=series">Series</a>
                </li>
            </ul>
            
            <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div> -->
        </div>
    </nav>

    <!-- HEADER -->
    