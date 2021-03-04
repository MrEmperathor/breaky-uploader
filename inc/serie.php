<?php
// ini_set('error_reporting', E_ALL|E_STRICT);
// ini_set('display_errors', '1');
include '../controlador/app.php';
if (!isset($_SESSION['nombre'])) {
    header('location: /panel/login.php');
}
include_once 'header.php';
include 'comp/filevar.php';

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";

// if (!$_SESSION['admin']) {
//   header('location:http://'.$host.'/panel');
// }


$sql_leer = "SELECT * FROM seriess WHERE TMDB LIKE '%$TMDBid%' ORDER BY TMDB";
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado = $gsent->fetchAll();

$urlRedir = "https://www.cine24h.net/redirect-to/?redirect=";

$backdrop = (empty($result['backdrop_path'])) ? "<img src='https://image.tmdb.org/t/p/original/nRXO2SnOA75OsWhNhXstHB8ZmI3.jpg'>" : "<img src='". $config['images']['base_url'] . $config['images']['backdrop_sizes'][3] . $result['backdrop_path'] . "'/>";

$UpStream = array();
foreach ($varlink[5] as $key => $value) {
    $UpStream[$key] = str_replace('https://uptobox.com/', 'https://uptostream.com/iframe/', $value);
}

foreach ($varlink[1] as $key => $value) {
    $varlink[1][$key] = (!empty($varlink[1][$key])) ? str_replace('https://drive.google.com/open?id=', 'https://drive.google.com/file/d/', $value . "/preview") : "";
}
$embedGou = array();
foreach ($varlink[9] as $key => $value) {
    $embedGou[$key] = str_replace('https://gounlimited.to/', 'https://gounlimited.to/embed-', $value . ".html");
}
$fembedEmbed = array();
foreach ($varlink[11] as $key => $value) {
    $fembedEmbed[$key] = str_replace('/f/', '/v/', $value);
}

?>
<header class="main-header">
        <div class="background-overlay py-5 textColor">
            <div class="row backdrop">
                <div class="col Image">
                <?php echo $backdrop ?>
                </div>
            </div>
            <div class="container">
                <div class="row bajar">
                    <div class="col text-center">
                        <h1 class="display-3" ><?php echo $result['original_name'];?></h1>
                        <h3><?php echo $name; ?></h3>
                        <h3><?php echo $TMDBid; ?></h3>
                        <!-- <p class="card-text text-white" id=codigo1><?php echo $name." ".$calidad." ".$idioma;?></p> -->
                        <p><?php echo $result['overview']; ?></p>
                    </div>
                </div>
                <dl class="row">
                    <dt class="col-sm-6 text-right">Nombre</dt>
                    <dd class="col-sm-6"><?php echo $name;?></dd>

                    <dt class="col-sm-6 text-right">Temporada</dt>
                    <dd class="col-sm-6"><?php echo $temporada;?></dd>
                    <!-- <dd class="col-sm-9 offset-sm-3">Donec id elit non mi porta gravida at eget metus.</dd> -->

                    <dt class="col-sm-6 text-right">Calidad</dt>
                    <dd class="col-sm-6"><?php echo $calidad;?></dd>

                    <dt class="col-sm-6 text-right">Idioma</dt>
                    <dd class="col-sm-6"><?php echo $idioma;?></dd>

                    <dt class="col-sm-6 text-right">Similares</dt>
                    <dd class="col-sm-6">
                        <?php foreach ($resultado as $datos):?>
                        
                        <?php if ($datos['id'] == $id): ?>
                            <?php echo $datos['nombre']." || ".$datos['calidad']." || ".$datos['idioma']." || ".$datos['temp'];?><br>
                        <?php else: ?>
                                <a href="<?php echo $base.'serie/'.$datos['id']; ?>"><?php echo $datos['nombre']." || ".$datos['calidad']." || ".$datos['idioma']." || ".$datos['temp']; ?></a><br>
                        <?php endif ?>

                        <?php endforeach ?>
                    </dd>
                </dl>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container text-white text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title">Google Drive Vip</h5>
                    <!--Material textarea-->
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo1" rows="3"><?php
                        // var_dump($varlink);
                            $VIP_DRIVE = array_reverse($varlink[1]);
                            foreach ($VIP_DRIVE as $key => $valuev) {
                                    print $valuev;
                                    print "\n";
                                    print "\n";
                            }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo1>Copiar</button>
                    <span class="counter">
                    <?php echo count($varlink[1]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Gd Dowload</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo2" rows="3"><?php
                            $varl = array_reverse($varlink[2]);
                            foreach ($varl as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                print $value;
                                print "\n";
                                print "\n";
                            }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo2>Copiar</button>
                    <span class="counter">
                    <?php echo count($varlink[2]); ?>
                    </span>
                </div>
                
                <div class="col-md-4">
                    <h5 class="card-title">Gd-Ouo</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo7" rows="3"><?php
                            $revers = array_reverse($varlink[7]);
                            foreach ($revers as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                print $value;
                                print "\n";
                                print "\n";
                            }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo7>Copiar</button>
                    <span class="counter">
                    <?php echo count($varlink[7]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Mega</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo6" rows="3"><?php
                            foreach ($varlink[6] as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                    print $value;
                                    print "\n";
                                    print "\n";
                                }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo6>Copiar</button>
                    <span class="counter">
                        <?php echo count($varlink[6]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Mega-Short</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo8" rows="3"><?php
                            foreach ($varlink[8] as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $value;
                                        print "\n";
                                        print "\n";
                                }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo8>Copiar</button>
                    <span class="counter">
                        <?php echo count($varlink[8]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Gounlimited</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo9" rows="3"><?php
                            foreach ($varlink[9] as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $urlRedir . $value;
                                        print "\n";
                                        print "\n";
                                    }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo9>Copiar</button>
                    <span class="counter">
                        <?php echo count($varlink[9]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Fembed</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo11" rows="3"><?php
                            foreach ($varlink[11] as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $urlRedir . $value;
                                        print "\n";
                                        print "\n";
                                    }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo11>Copiar</button>
                    <span class="counter">
                        <?php echo count($varlink[11]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Mystream</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo10" rows="3"><?php
                            foreach ($varlink[10] as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $value;
                                        print "\n";
                                        print "\n";
                                    }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo10>Copiar</button>
                    <span class="counter">
                        <?php echo count($varlink[11]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Fembed-Embed</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo011" rows="3"><?php
                            foreach ($fembedEmbed as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $value;
                                        print "\n";
                                        print "\n";
                                    }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo011>Copiar</button>
                    <span class="counter">
                        <?php echo count($varlink[11]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Gounlimited-Embed</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo99" rows="3"><?php
                            foreach ($embedGou as $key => $valuev) {
                                    print $valuev;
                                    print "\n";
                                    print "\n";
                                }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo99>Copiar</button>
                    <span class="counter">
                        <?php echo count($varlink[9]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Uptobox</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo5" rows="3"><?php
                            foreach ($varlink[5] as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $urlRedir . $value;
                                        print "\n";
                                        print "\n";
                                }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo5>Copiar</button>
                    <span class="counter">
                    <?php echo count($varlink[5]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Uptobox-Embed</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo55" rows="3"><?php
                            foreach ($UpStream as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $value;
                                        print "\n";
                                        print "\n";
                                }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mt-n3 mb-4" data-clipboard-target=.codigo55>Copiar</button>
                    <span class="counter">
                        <?php echo count($varlink[5]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Jetload</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo4" rows="3"><?php
                            foreach ($varlink[4] as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $value;
                                        print "\n";
                                }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo4>Copiar</button>
                    <span class="counter">
                    <?php echo count($varlink[4]); ?>
                    </span>
                </div>
                <div class="col-md-4">
                    <h5 class="card-title">Netu</h5>
                    <div class="md-form mb-4 pink-textarea active-pink-textarea mt-n1">
                        <textarea id="form18" class="md-textarea form-control textColor t-area codigo3" rows="3"><?php
                            foreach ($varlink[3] as $key => $value) {
                                        // echo str_replace("\n", "\r\n\r\n", $value);
                                        print $value;
                                        print "\n";
                                        print "\n";
                                }
                        ?></textarea>
                    </div>
                    <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3 mb-4" data-clipboard-target=.codigo3>Copiar</button>
                    <span class="counter">
                    <?php echo count($varlink[3]); ?>
                    </span>
                </div>
            </div>
        </div>
    </section>
<!-- <section class="fondo"></section> -->



<!-- <div class="Image">
        <figure class="Objf"><img src="https://image.tmdb.org/t/p/w1280/2lFF4qTFFn4lDN9ZTyk5vhiFIex.jpg" class="lazy" data-src="https://image.tmdb.org/t/p/w1280/2lFF4qTFFn4lDN9ZTyk5vhiFIex.jpg" alt="img"></figure>
    </div> -->



<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


    <!-- JQuery -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- Bootstrap tooltips -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script> -->
<!-- Bootstrap core JavaScript -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
<!-- MDB core JavaScript -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script> -->

</body>
<?php include_once 'footer.php'; ?>
</html>
