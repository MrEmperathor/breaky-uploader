<?php 
include '/.enlaces2/.test.php';
include 'filevar.php';

// $Inicio = "http://".$IP."/de/.enlaces2";
$ruta = str_replace(basename(__FILE__), "", __FILE__).'<br>';
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$uri  = rtrim(dirname($uri), '/\\');
$Inicio = "http://" . $host . $uri . "/";



 ?>
<!DOCTYPE html>
<html>
<head>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $result['original_title'];?></title>
    <link rel="stylesheet" href="../admin/estilos.css">
    <link rel="stylesheet" href="../admin/animate.css">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
    

</head>
<body>
    <header>
        <div class="ancho">
            <div class="logo">
                <p><a href="<?php echo $Inicio; ?>">UploadDl</a></p>
            </div>
            <nav>
                <ul id=menu>
                    <li><a href="<?php echo $Inicio."lvip.php?i=".$id; ?>" target=_blank>VIP</a></li>
                    <li><a href="<?php echo $Inicio."lfree.php?i=".$id; ?>" target=_blank>FREE</a></li>
                    <li><a href="<?php echo $VIP720; ?>" target=_blank>VIP720</a></li>
                    <li><a href="<?php echo $uu720; ?>" target=_blank>FREE720</a></li>
                    <li class=active><a href="<?php echo $Inicio; ?>">INICIO</a></li>
                </ul> 
            </nav>
        </div>
    </header>