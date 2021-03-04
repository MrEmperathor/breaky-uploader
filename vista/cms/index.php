<?php
// require('modelo/conexion.php');
require('inc/xion/conexion.php');
// $sql= 'SELECT count(*) AS conteo FROM pelis';


$sql_leer = "SELECT count(*) FROM pelis";
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$result = $gsent->fetchAll();
$pelis = ($result[0][0]) ? $result[0][0] : null;


$sql_leer = "SELECT count(*) FROM seriess";
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultS = $gsent->fetchAll();
$series = ($resultS[0][0]) ? $resultS[0][0] : null;

$total = ($pelis || $series) ? $series + $pelis : null;


?>
    <div class="container col-md-12">
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                 <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body my-2 ">
                        <img src="http://www.bootstrapdash.com/demo/purple/jquery/template/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                        <h4 class="font-weight-normal mb-3">Peliculas Subidas <i class="mdi mdi-chart-line mdi-24px float-right"></i></h4>
                        <h2 class="mb-5"><?php echo $pelis; ?></h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="http://www.bootstrapdash.com/demo/purple/jquery/template/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                            <h4 class="font-weight-normal mb-3">Series Subidas <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                            <h2 class="mb-5"><?php echo $series; ?></h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="http://www.bootstrapdash.com/demo/purple/jquery/template/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Total <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $total; ?></h2>
                    
                  </div>
                </div>
              </div>           
         </div>
    </div>