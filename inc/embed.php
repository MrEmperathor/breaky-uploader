<?php
// ini_set('error_reporting', E_ALL|E_STRICT);
// ini_set('display_errors', '1');
// header('Access-Control-Allow-Origin: *');
include '../controlador/app.php';
if (!isset($_SESSION['nombre'])) {
    header('location: /panel/login.php');
}
include_once 'header.php';

require_once('config.php');
$de = ($_SESSION["nombre"] == $CONFIG["EmbedUser2"]) ? true : false;

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";

$urlRedirect = 'https://www.cine24h.net/redirect-to/?redirect=';

if (!empty($u)) {
    $sql_leer = "SELECT * FROM pelis WHERE TMDB LIKE '%$u%' ORDER BY TMDB";
    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute();

    $resultado = $gsent->fetchAll();
}


//iframe
$very = str_replace('https://verystream.com/stream/', 'https://verystream.com/e/', $enlaces["verystream.com"]);
$verystreamE = explode('/', parse_url($enlaces["verystream.com"], PHP_URL_PATH));
$very = str_replace($verystreamE[3], "", $very);
// $verystreamE = str_replace('https://verystream.com/stream/', 'https://verystream.com/e/', $enlaces[1]);
$vereStreamD = str_replace('https://verystream.com/e/', $urlRedirect.'https://verystream.com/stream/', $very);
$GD_VIP = str_replace('https://drive.google.com/open?id=', 'https://drive.google.com/file/d/', $enlaces["drive.google.com.VIP"]."/preview");
$enlaces["gounlimited.to-embed"] = str_replace('https://gounlimited.to/', 'https://gounlimited.to/embed-', $enlaces["gounlimited.to"].'.html');
$embedUptobox = str_replace('https://uptobox.com/', 'https://uptostream.com/iframe/', $enlaces["uptobox.com"]);

$backdrop = (empty($result['backdrop_path'])) ? "<img src='https://image.tmdb.org/t/p/original/nRXO2SnOA75OsWhNhXstHB8ZmI3.jpg'>" : "<img src='". $config['images']['base_url'] . $config['images']['backdrop_sizes'][3] . $result['backdrop_path'] . "'/>";
$embed_fembed = str_replace('/f/', '/v/', $enlaces["fembed.com"]);
$embed_fembed = str_replace('//www.', '//', $embed_fembed);
$enlaces["fembed.com"] = str_replace('//www.', '//', $enlaces["fembed.com"]);


if ($_SESSION['nombre'] == $CONFIG["EmbedUser2"]) {
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
    // echo ROOT_PATH."de/file2"."</br>";
    $backup_url = $backup_url_up[1];

}


if($idioma == "LATINO" || $idioma == "LAT") $checket1 = "checked";
if($idioma == "SUB") $checket2 = "checked";
if($idioma == "CASTELLANO") $checket3 = "checked";

if($idioma == "LATINO" || $idioma == "LAT") $url_buscar = '';
if($idioma == "SUB") $url_buscar = '<a href=https://sub.cine24h.net/?s='.urlencode($name).' target="_blank" rel="noopener noreferrer">'.$name.'</a><br>';
if($idioma == "CASTELLANO") $url_buscar = '<a href=https://esp.cine24h.net/?s='.urlencode($name).' target="_blank" rel="noopener noreferrer">'.$name.'</a><br>';

$name_sin_year = substr($name, 0, -7);

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
                    <h1><?php echo $result['original_title'];?></h1>
                    <h2><?php echo $result['id']?></h2>
                    <br>
                    <dl class="row">
                        <dt class="col-sm-6"></dt>
                        <dt class="col-sm-6"></dt>
                        <dd class="col-sm-6">
                            <h6><?php echo $enlaces["hqq.to"]?></h6>
                        </dd>
                        <dd class="col-sm-6">
                            <a href=<?php echo $enlaces["fembed.com"]?> target="_blank" rel="noopener noreferrer"><?php echo $enlaces["fembed.com"]; ?></a>
                        </dd>
                    </dl>
                    <div class="col-12 text-center">
                        <button type="button" class="btn purp-t redon-t" id="estado_fembed" onclick="fembed_estado_720()" value=<?php echo $enlaces["fembed.com"]?> >720P</button>
                    </div>
                    <!-- <h6><?php echo $enlaces["fembed.com"]?></h6> -->
                    
                    <h6><?php echo $result['release_date']?></h6>
                    <p class="card-text text-white" id=codigo1><?php echo $name." ".$calidad." ".$idioma;?></p>
                    <a href="<?php echo "https://cine24h.net/?s=".urlencode($name_sin_year);?>" target="_blank"
                        rel="noopener noreferrer"><?php echo $name; ?></a><br>
                    <a href="<?php echo "https://www.themoviedb.org/search?query=".rawurlencode($name_sin_year)."&language=es";?>"
                        target="_blank" rel="noopener noreferrer"><?php echo "THEMOVIES ".$name_sin_year; ?></a><br>
                    <?php echo $url_buscar;?>
                    <p><?php echo $result['overview']; ?></>
                    <dl class="row">
                        <dt class="col-sm-6">Similares</dt>
                        <dt class="col-sm-6">Similares 2</dt>
                        <dd class="col-sm-6">
                            <ul>

                                <?php foreach ($resultado as $datos):?>

                                <?php if ($datos['id'] == $id): ?>
                                <li><?php echo $datos['nombre']." || ".$datos['calidad']." || ".$datos['idioma']." || ".$datos['temp'];?>
                                </li>
                                <?php else: ?>
                                <?php 

                                        $sql_unico_hover = 'SELECT * FROM pelis WHERE id=?';
                                        $gsent_unico_hover = $pdo->prepare($sql_unico_hover);
                                        $gsent_unico_hover->execute(array($datos['id']));
                                        $resultado_unico_hover = $gsent_unico_hover->fetch();
                                        $links_hover = unserialize($resultado_unico_hover['links']);

                                        require_once('comp/funtions.php');
		                                $enlaces_hover = array();
                                        $enlaces_hover["verystream.com"] = (buscarDato($links_hover,"verystream.com")) ? $links_hover[buscarDato($links_hover,"verystream.com")] : "";
                                        $enlaces_hover["hqq.to"] = (buscarDato($links_hover,"hqq.to")) ? $links_hover[buscarDato($links_hover,"hqq.to")] : "";
                                        $enlaces_hover["drive.google.com"] = (buscarDato($links_hover,"export=download")) ? $links_hover[buscarDato($links_hover,"export=download")] : "";
                                        $enlaces_hover["drive.google.com.VIP"] = (buscarDato($links_hover,"drive.google.com/open?id")) ? $links_hover[buscarDato($links_hover,"drive.google.com/open?id")] : "";
                                        $enlaces_hover["mega.nz"] = (buscarDato($links_hover,"mega.nz")) ? $links_hover[buscarDato($links_hover,"mega.nz")] : "";
                                        $enlaces_hover["short.pe"] = (buscarDato($links_hover,"short.pe")) ? $links_hover[buscarDato($links_hover,"short.pe")] : "";
                                        $enlaces_hover["ouo.io"] = (buscarDato($links_hover,"ouo.io")) ? $links_hover[buscarDato($links_hover,"ouo.io")] : "";
                                        $enlaces_hover["jetload.net"] = (buscarDato($links_hover,"jetload.net")) ? $links_hover[buscarDato($links_hover,"jetload.net")] : "";
                                        $enlaces_hover["fembed.com"] = (buscarDato($links_hover,"fembed.com")) ? $links_hover[buscarDato($links_hover,"fembed.com")] : "";
                                        $enlaces_hover["uptobox.com"] = (buscarDato($links_hover,"uptobox.com")) ? $links_hover[buscarDato($links_hover,"uptobox.com")] : "";
                                        $enlaces_hover["gounlimited.to"] = (buscarDato($links_hover,"gounlimited.to")) ? $links_hover[buscarDato($links_hover,"gounlimited.to")] : "";
                                        $enlaces_hover["clicknupload.org"] = (buscarDato($links_hover,"clicknupload.org")) ? $links_hover[buscarDato($links_hover,"clicknupload.org")] : "";
                                        $enlaces_hover["dropapk.to"] = (buscarDato($links_hover,"dropapk.to")) ? $links_hover[buscarDato($links_hover,"dropapk.to")] : "";
                                        $enlaces_hover["prostream.to"] = (buscarDato($links_hover,"prostream.to")) ? $links_hover[buscarDato($links_hover,"prostream.to")] : "";
                                        $enlaces_hover["upstream.to"] = (buscarDato($links_hover,"upstream.to")) ? $links_hover[buscarDato($links_hover,"upstream.to")] : "";
                                        $enlaces_hover["mystream.to"] = (buscarDato($links_hover,"mystream.to")) ? $links_hover[buscarDato($links_hover,"mystream.to")] : "";

                                        //iframes
                                        $GD_VIP_hover = str_replace('https://drive.google.com/open?id=', 'https://drive.google.com/file/d/', $enlaces_hover["drive.google.com.VIP"]."/preview");
                                        $enlaces_hover["gounlimited.to-embed"] = str_replace('https://gounlimited.to/', 'https://gounlimited.to/embed-', $enlaces_hover["gounlimited.to"].'.html');
                                        $enlaces_hover["uptobox.com-iframe"] = str_replace('https://uptobox.com/', 'https://uptostream.com/iframe/', $enlaces_hover["uptobox.com"]);
                                        $enlaces_hover["fembed-embed"] = str_replace('/f/', '/v/', $enlaces_hover["fembed.com"]);
                                        


                                        ?>
                                <?php if ($datos['TMDB'] == $u): ?>
                                <li id="primero"><a
                                        href="<?php echo $base.'embed.php?page='.$datos['id']; ?>"><?php echo $datos['nombre']." || ".$datos['calidad']." || ".$datos['idioma']." || ".$datos['temp']; ?></a>
                                    <?php endif ?>

                                    <div class="primero">
                                        <div class="col">
                                            <div class="card w-70 azul1-t redon-t ">
                                                <div class="card-body mr-3">
                                                    <p class="card-text text-white"
                                                        id="<?php echo "codigo".$datos['id']; ?>">
                                                        <?php 
                                                                // if ($datos['calidad'] == "(1080)" || $datos['calidad'] == "CAM") {
                                                                    // echo ($enlaces_hover["drive.google.com.VIP"] != "") ? $GD_VIP.'<br>' : ""; //gd vip
                                                                    // echo (!empty($enlaces_hover["drive.google.com.VIP"])) ? $GD_VIP_hover.'<br>' : ""; //gd vip
                                                                // }
                                                                // echo ($enlaces_hover["gounlimited.to"] != "") ? $enlaces_hover["gounlimited.to-embed"].'<br>' : ""; // gounlimited embed
                                                                echo ($enlaces_hover["fembed-embed"] != "") ? $enlaces_hover["fembed-embed"].'<br>' : ""; // fembed embed
                                                                // echo ($enlaces_hover["uptobox.com"] != "") ? $enlaces_hover["uptobox.com-iframe"].'<br>' : ""; // uptobox embed
                                                                echo ($enlaces_hover["mystream.to"] != "") ? $enlaces_hover["mystream.to"].'<br>' : ""; //jetload
                                                                echo ($enlaces_hover["hqq.to"] != "") ? $enlaces_hover["hqq.to"].'<br>' : ""; //netu
                                                                // echo ($enlaces_hover["gounlimited.to"] != "") ? $urlRedirect . $enlaces_hover["gounlimited.to"].'<br>' : ""; //gounlimited
                                                                // echo ($enlaces_hover["uptobox.com"] != "") ? $urlRedirect . $enlaces_hover["uptobox.com"].'<br>' : ""; //uptobox
                                                                echo ($enlaces_hover["short.pe"] != "") ? $enlaces_hover["short.pe"].'<br>' : ""; //short
                                                                echo ($enlaces_hover["ouo.io"] != "") ? $enlaces_hover["ouo.io"].'<br>' : ""; //ouo

                                                                if($idioma == $datos['idioma'] && $datos['calidad'] != $calidad){
                                                                    $enlaces_hover_2 = $enlaces_hover;
                                                                    $calid2 = $datos['calidad'];
                                                                }
                                                                ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3"
                                                data-clipboard-target=#<?php echo "codigo".$datos['id']; ?>>Copiar</button>
                                        </div>
                                    </div>
                                </li>
                                <?php endif ?>

                                <?php endforeach ?>
                            </ul>
                        </dd>
                        <dd class="col-sm-6">
                        
                            <?php
                            $igual_wp = json_decode(buscarDuplicadoWp($u), true);
                            if (!empty($igual_wp[0])) {
                                for ($itt=0; $itt < count($igual_wp); $itt++) { 
                                    // echo $igual_wp[$itt]["id"];
                                    // echo $igual_wp[$itt]["link"];

                                    echo '<a href='.$igual_wp[$itt]["link"].' target="_blank" rel="noopener noreferrer">'.$igual_wp[$itt]["link"].' | '.$igual_wp[$itt]["id"].'</a>';

                                }
                                // foreach ($igual_wp[0] as $key => $item) {
                                //     echo $item;
                                // }
                            }
                                // echo "arriaba del var_sum";
                                // var_dump($igual_wp); 
                            
                            ?>
                            
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="button" class="btn purp-t redon-t" data-toggle="modal" data-target="#mimodal">Mostrar
                        Enlaces</button>
                </div>
                <div class="col-12 text-white">
                    <div class="accordionn" id="accordionExample275">
                        <div class="card z-depth-0 bordered w-70 azul1-t redon-t">
                            <div class="text-center card-header" id="headingOne2">
                                <h5 class="mb-0 text-white">
                                    <button class="btn btn-link text-white" type="button" data-toggle="collapse"
                                        data-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                                        Generar Comandos
                                    </button>
                                </h5>
                                <pre class="text-white" style="margin-left: 25%;"><?php 
                                    function html_calidades($id_calidad,$name_calidad)
                                    {
                                        return '<div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="'.$id_calidad.'" name="defaultExampleRadioss" onclick="uncheckTwo()">
                                                    <label class="custom-control-label" for="'.$id_calidad.'">'.$name_calidad.'</label>
                                                </div>';
                                    }
                                    $html_calidad = '';
                                    if(!empty($averigurarCalidad->p1080p)) echo "1080 disponoble  ";
                                    if(!empty($averigurarCalidad->p720p)) echo "720 disponoble  ";
                                    if(!empty($averigurarCalidad->p480p)) echo "480 disponoble  ";
                                    if(!empty($averigurarCalidad->p360p)) echo "360 disponoble  ";

                                    if(!empty($averigurarCalidad->p1080p)) $html_calidad .= html_calidades('q1080','1080p');
                                    if(!empty($averigurarCalidad->p720p)) $html_calidad .= html_calidades('q720','720p');
                                    if(!empty($averigurarCalidad->p480p)) $html_calidad .= html_calidades('q480','480p');
                                    if(!empty($averigurarCalidad->p360p)) $html_calidad .= html_calidades('q360','360p');
                                    ?>
                                    </pre>
                            </div>
                            <div id="collapseOne2" class="collapse" aria-labelledby="headingOne2"
                                data-parent="#accordionExample275">
                                <div class="card-body">
                                    <div class="container borColor">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="enlace">Enlace</label>
                                                <input type="text" name="enlace" class="form-control" id="enlace"
                                                    aria-describedby="emailHelp" value="<?php echo $backup_url;?>">
                                                <label for="subti">Subtitulos</label>
                                                <input type="text" name="subtitulo" class="form-control" id="subti"
                                                    aria-describedby="emailHelp">
                                                <!-- Default unchecked -->
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <input type="checkbox" class="custom-control-input" id="c1080"
                                                        name="defaultExampleRadios" onclick="uncheck()">
                                                    <label class="custom-control-label" for="c1080">1080</label>
                                                </div>

                                                <!-- Default checked  -->
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="c720"
                                                        name="defaultExampleRadios" onclick="uncheck()" checked>
                                                    <label class="custom-control-label" for="c720">720</label>
                                                </div>
                                                <hr style="border-color:#fff;">
                                                <div class="col py-2">
                                                    <pre class="text-white" style="font-size: 11px;
                                                        margin: 0px !important;">CALIDAD A BAJAR</pre>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="bajar_1080"
                                                        name="defaultExampleRadiosss" onclick="uncheckNew()">
                                                    <label class="custom-control-label" for="bajar_1080">Bajar
                                                        1080p</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="bajar_720"
                                                        name="defaultExampleRadiosss" onclick="uncheckNew()">
                                                    <label class="custom-control-label" for="bajar_720">Bajar
                                                        720p</label>
                                                </div>
                                                <?php 
                                                    echo $html_calidad;
                                                    // foreach ($calidades as $key => $value) {
                                                    //     echo '<div class="custom-control custom-checkbox">
                                                    //             <input type="checkbox" class="custom-control-input" id="q'.$key.'" name="defaultExampleRadioss" onclick="uncheckTwo()">
                                                    //             <label class="custom-control-label" for="q'.$key.'">'.$value.'</label>
                                                    //         </div>';
                                                    // }
                                                    
                                                    ?>
                                            </div>
                                            <div class="col-6">
                                                <label for="nombre">Nombre Pelicula</label>
                                                <input type="text" name="name" class="form-control" id="nombre"
                                                    aria-describedby="emailHelp" value="<?php echo $name;?>">
                                                <label for="tmdb">TMDB</label>
                                                <input type="text" name="tmdb" class="form-control" id="tmdb"
                                                    aria-describedby="emailHelp" value="<?php echo $result['id'];?>">
                                                <!-- Default unchecked -->
                                                <div class="custom-control custom-radio mt-2">
                                                    <input type="radio" class="custom-control-input" id="ilatino"
                                                        name="idioma" <?php echo $checket1; ?>>
                                                    <label class="custom-control-label" for="ilatino">Latino</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="icastellano"
                                                        name="idioma" <?php echo $checket3; ?>>
                                                    <label class="custom-control-label"
                                                        for="icastellano">Castellano</label>
                                                </div>

                                                <!-- Default checked -->
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="isub"
                                                        name="idioma" <?php echo $checket2; ?>>
                                                    <label class="custom-control-label" for="isub">Subtitulado</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                            echo '<div class="text-center col py-2">
                                                        <pre class="text-white" style="font-size: 11px;
                                                        margin-bottom: -12px !important;">ID UNICO: '.$id.'</pre>
                                                    </div>';
                                            ?>
                                        <hr style="border-color:#fff;">
                                        <div class="row mb-3">

                                            <?php 
                                                $opciones_name = array('720' => 'Todo 720', '1080' => 'Todo 1080', '720p' => 'Todo 720 Completo', 'hqq.to' => 'Solo netu', 'jetload' => 'Solo jetload', 'uptobox' => 'Solo uptobox', 'gounlimited' => 'Solo gounlimited', "mega" => 'Solo Mega', 'gdfree' => 'Solo GDFree', 'gdvip' => 'Solo GDVip');

                                                foreach ($opciones_name as $key => $value) {
                                                    // echo '<div class="col">
                                                    //     <div class="custom-control custom-radio">
                                                    //         <input type="radio" class="custom-control-input" id="'.$key.'" name="opcion_unica">
                                                    //         <label class="custom-control-label" for="'.$key.'">'.$value.'</label>
                                                    //     </div>
                                                    // </div>';
                                                    if ($key == "720" || $key == "1080" || $key == "720p") {
                                                        $opcion_unica = "opcion_unica";
                                                        $type_check = "radio";
                                                        $onclick = 'onclick="uncheckTree()"';
                                                    }else {
                                                        $opcion_unica = "opcion_unica2";
                                                        $type_check = "checkbox";
                                                    }
                                                    // $opcion_unica = ($key === "720" || $key === "1080" || $key === "720p") ? "opcion_unica" : "opcion_unica2";
                                                    echo '<div class="col-2">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="'.$key.'" name="'.$opcion_unica.'" '.$onclick.'>
                                                                <label class="custom-control-label" for="'.$key.'">'.$value.'</label>
                                                            </div>
                                                        </div>';
                                                }
                                            ?>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group purple-border">
                                                    <label for="exampleFormControlTextarea4">Resultado: </label>
                                                    <textarea class="form-control" id="comandoText" rows="6"></textarea>
                                                </div>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="accion();">GENERAR</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 

            $enlacesI = implode('|', $enlaces); 
            $enlacesII = implode('|', $enlaces_hover_2); 
            $cant_enlaces_1080 = substr_count($enlacesI, 'https://') - 2;
            $cant_enlaces_7201 = substr_count($enlacesII, 'https://') -3;
            $can720 = $cant_enlaces_7201; 
            $cant_enlace = $cant_enlaces_1080 + $can720;

            
        
        ?>
</header>


<div class="modal fade" id="mimodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content azul-t text-white">
            <!-- HEADER MODAL -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Lista de enlaces rapidos <?php echo $cant_enlace;?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id=codigo0>
                <?php 
                    if (!empty($enlaces_hover_2)) {
                        // echo ($enlaces_hover_2["fembed-embed"] != "") ? $enlaces_hover_2["fembed-embed"].'<br>' : ""; // uptobox embed
                        // echo ($enlaces_hover_2["mystream.to"] != "") ? $enlaces_hover_2["mystream.to"].'<br>' : ""; //jetload
                        echo ($enlaces_hover_2["hqq.to"] != "") ? $enlaces_hover_2["hqq.to"].'<br>' : ""; //netu
                        echo ($enlaces_hover_2["mega.nz"] != "") ? $enlaces_hover_2["mega.nz"].'<br>' : ""; //mega
                        // echo ($enlaces_hover_2["fembed.com"] != "No hay enlaces") ? $enlaces_hover_2["fembed.com"].'<br>' : ""; //
                        // echo ($enlaces_hover_2["short.pe"] != "") ? $enlaces_hover_2["short.pe"].'<br>' : ""; //short
                        // echo ($enlaces_hover_2["ouo.io"] != "") ? $enlaces_hover_2["ouo.io"].'<br>' : ""; //ouo


                        
                    }else{
                        echo "";
                    }
                    if ($enlaces["fembed.com"] == "No hay enlaces") {
                        $enlaces["fembed.com"] = $enlaces_hover_2["fembed.com"];
                        $embed_fembed = $enlaces_hover_2["fembed-embed"];
                    }
                    echo ($enlaces["fembed.com"] != "No hay enlaces") ? $embed_fembed.'<br>' : $enlaces_hover_2["fembed-embed"]; // uptobox embed
                    // echo ($enlaces["mystream.to"] != "No hay enlaces") ? $enlaces["mystream.to"].'<br>' : ""; //jetload
                    echo ($enlaces["hqq.to"] != "No hay enlaces") ? $enlaces["hqq.to"].'<br>' : ""; //netu
                    echo ($enlaces["mega.nz"] != "No hay enlaces") ? $enlaces["mega.nz"].'<br>' : ""; //mega 720
                    echo ($enlaces["fembed.com"] != "No hay enlaces") ? $enlaces["fembed.com"].'<br>' : $enlaces_hover_2["fembed.com"]; // uptobox embed
                    // echo ($enlaces["gounlimited.to"] != "No hay enlaces") ? $urlRedirect . $enlaces["gounlimited.to"].'<br>' : ""; //gounlimited
                    // echo ($enlaces["fembed.com"] != "No hay enlaces") ? $urlRedirect . $enlaces["fembed.com"].'<br>' : ""; //gounlimited
                    // echo ($enlaces["short.pe"] != "No hay enlaces") ? $enlaces["short.pe"].'<br>' : ""; //short
                    // echo ($enlaces["ouo.io"] != "No hay enlaces") ? $enlaces["ouo.io"].'<br>' : ""; //ouo

                    // echo '<input type="hidden" id="fembedEmbed" name="bklinks[]" value="'.$enlaces_hover_2["fembed-embed"].'">';
                    echo '<input type="hidden" id="fembedEmbed" name="bklinks[]" value="'.$embed_fembed.'">';
                    echo '<input type="hidden" id="fembed" name="bklinks[]" value="'.$enlaces["fembed.com"].'">';
                    echo '<input type="hidden" id="mega720" name="bklinks[]" value="'.$enlaces_hover_2["mega.nz"].'">';
                    // echo '<input type="hidden" id="mystream" name="bklinks[]" value="'.$enlaces["mystream.to"].'">';
                    echo '<input type="hidden" id="hqq" name="bklinks[]" value="'.$enlaces["hqq.to"].'">';
                    echo '<input type="hidden" id="mega1080" name="bklinks[]" value="'.$enlaces["mega.nz"].'">';
                    // echo '<input type="hidden" id="fembedRedirect" name="bklinks[]" value="'.$enlaces["fembed.com"].'">';
                    echo '<input type="hidden" id="short" name="bklinks[]" value="'.$enlaces["short.pe"].'">';
                    echo '<input type="hidden" id="ouo" name="bklinks[]" value="'.$enlaces["ouo.io"].'">';
                    //idioma
                    echo '<input type="hidden" id="idioma" name="bklinks[]" value="'.$idioma.'">';
                    //calidad
                    echo '<input type="hidden" id="calidad" name="bklinks[]" value="'.$calidad.'">';
                    //tmdb
                    echo '<input type="hidden" id="tmdb" name="bklinks[]" value="'.$result['id'].'">';



                    ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn black-t text-white redon-t" data-dismiss="modal">Cerrar</button>
                <button type="button" id=bt1 class="btn purp-t text-white redon-t"
                    data-clipboard-target=#codigo0>Copiar</button>
            </div>
            <div class="modal-footer">
                <span id="resultadooVery"></span>
                <img src="img/45.svg" alt="Cargando..." style="max-width: 20px; display: none;" id="cargaEmpezada">
                <button type="button" id="createPost" class="btn purp-t text-white redon-t">Crear Post</button>
            </div>
        </div>
    </div>
</div>

<section class="py-5 text-white text-center">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h5 class="card-title">Acortador url</h5>
            <div class="card w-70 azul1-t redon-t-acortador">
                <select class="browser-default custom-select redon-t" id="servioresA" name="servioresA"
                    onchange="ShowSelected();">
                    <option selected>Seleccionar Acortador</option>
                    <option value="1ouo">Ouo.io</option>
                    <option value="2short">short.pe</option>
                </select>
                <div class="card-body mr-3">
                    <div class="md-form form-sm text-white" id="resultadoC"></div>
                    <div id="resBotom">
                        <button type="button" class="btn purp-t text-white redon-t mt-n3" id="mibtn">Acortar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</section>


<section class="py-5">
    <div class="container text-white text-center">
        <div class="row">
            <?php            
                $codigo = 20;
                foreach ($enlaces as $key => $value) {
                    // echo $value."<br>";
                    // $url = parse_url($value);

                    if ($value) {
                       
                        $value = ($key == "drive.google.com.VIP") ? $GD_VIP : $value;
                      
                      
                        // $value = ($key == "gounlimited.to") ? $embedGounliited : $value;
                        echo '<div class="col-md-4">
                                <h5 class="card-title">'.$key.'</h5>
                                <div class="card w-70 azul1-t redon-t ">
                                    <div class="card-body mr-3">
                                        <p class="card-text text-white" id=codigo'.$codigo.'>'.$value.'</p>
                                    </div>
                                </div>
                                <button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3" data-clipboard-target=#codigo'.$codigo.'>Copiar</button>
                            </div>';
                    }
                    $codigo++;
                }
                ?>

        </div>
    </div>
</section>


<script>
// creamos un buffer temporal
window.buffer = '';
// Creamos una variable global para nuestro ID de intervalo
window._$target = document.getElementById('peli720');
window.arrayK = <?php echo json_encode($opciones_name);?>;




function logAria() {
    // Obtenemos el componente URI de la ruta URL
    ruta = document.getElementById('ruta').value;

    // Generamos una URL valida
    let url2 = 'http://167.86.105.129/de/file2/' + ruta + '/.logAria';
    fetch(url2).then(res => res.text()).then(content => {
        // Separamos las respuestas por lineas
        linesAria = content.replace(/[\r\n]+/g, '\n').split(/[\r\n]+/g);

        // Iteramos las lineas resibidas
        for (let i in linesAria) {
            // Comenzamos a rellenar el buffer
            window.buffer += linesAria[i] + '</br>';

            // Si estamos en la linea de descarga completa
            if (linesAria[i].indexOf('download completed') > -1) {
                // Limpiamos el intervalo
                clearInterval(pararAria);
                // Creamos un nuevo intervalo para logSubida2
                window.parar = setInterval(logSubida2, 4000);
                console.log('Limpiando itervalo de logAria');
            }
        }
        // Al terminar enviamos el contenido del buffer al nodo preseleccioando
        window._$target.innerHTML = window.buffer + '</br>';
        // limpiamos la variabe para mejorar el rendimiendo.
        window.buffer = '';
    })
}


function logSubida2() {
    // document.getElementById('peli720').innerHTML = "";
    ruta = document.getElementById('ruta').value
    var url2 = `http://167.86.105.129/de/file2/${ruta}/.logSubida`;

    fetch(url2)
        .then(res => res.text())
        .then(content => {

            liness = content.replace(/[\r\n]+/g, '\n').split(/[\r\n]+/g);

            for (let i in liness) {
                // Comenzamos a rellenar el buffer
                window.buffer += liness[i] + '</br>';

                // Si estamos en la linea de descarga completa
                if (liness[i].indexOf('TERMINADOS') > -1) {
                    // Limpiamos el intervalo
                    clearInterval(parar);
                    console.log('LIMPIANDO ITERVALO PARAR');
                }
            }
            window._$target.innerHTML = window.buffer + '</br>';
            window.buffer = '';

        });
}



function logSubida() {
    window.pararAria = setInterval(logAria, 3000);
    console.log('CREANDO PARARARIA');

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
}

function mandar720() {

    document.getElementById('peli720').innerHTML = "Iniciando...";
    ruta = document.getElementById('ruta').value
    var tmdb = document.getElementById('tmdb').value
    var name = document.getElementById('nombre').value
    var idioma = document.getElementById('idioma').value
    var idDrive = document.getElementById('iddrive').value
    // document.getElementById('peli720').innerHTML = ruta +"|" + "|" +tmdb +"|"+"|" +name+ "|"+"|" +idioma+ "|"+"|" +idDrive;
    var url =
        `http://167.86.105.129/panel/inc/comp/720drive.php?ruta=${ruta}&tmdb=${tmdb}&nombre=${name}&idioma=${idioma}&iddrive=${idDrive}`;

    fetch(url)
        .then(function(response) {
            return response.text();
        })
        .then(function(myJson) {
            document.getElementById('peli720').innerHTML += myJson + "</br>"
            console.log(myJson);
        });
}


function accion() {

    let nombre = `-n "${document.getElementById('nombre').value}"`;
    let enlace = document.getElementById('enlace').value;
    let subb = document.getElementById('subti').value;
    let tmdb = `-t ${document.getElementById('tmdb').value}`;
    let c10800 = document.getElementById('c1080').checked;
    let c7200 = document.getElementById('c720').checked;
    let ilatino = document.getElementById('ilatino').checked;
    let icastellano = document.getElementById('icastellano').checked;
    let isub = document.getElementById('isub').checked;
    let bajar_calidad_1080 = document.getElementById("bajar_1080").checked
    let bajar_calidad_720 = document.getElementById("bajar_720").checked
    var dee = '<?php echo $de;?>';

    // $opciones_name = array('todo_720p' => 'Todo 720', 'todo_1080p' => 'Todo 1080', '720_convertido' => '720 Converido', 'hqq.to' => 'Solo netu', 'Solo jetload' => 'Solo jetload', 'uptobox' => 'Solo uptobox', 'gounlimited' => 'Solo gounlimited');


    var opcionUnica = '';
    for (var clave in window.arrayK) {
        // Controlando que json realmente tenga esa propiedad
        if (window.arrayK.hasOwnProperty(clave)) {
            if (document.getElementById(clave).checked) {
                opcionUnica += ` -K ${clave}`
                if (clave == 'hqq.to' || clave == 'jetload' || clave == 'uptobox' || clave == 'gounlimited' || clave ==
                    'mega' || clave == 'gdfree' || clave == 'gdvip') {
                    var id_unico = '-I <?php echo $id;?>'
                }
            }
            console.log("La clave es " + clave + " y el valor es " + window.arrayK[clave]);
        }
    }
    
    // url.match(/[-\w]{25,}/)
    
    var a = document.createElement('a');
    a.href = enlace;

    if (a.hostname == "drive.google.com"){
        id_drive = enlace.match(/[-\w]{25,}/);
        if(id_drive) enlace = "-e '"+id_drive+"'";
    }else{
        enlace = "-e '"+enlace+"'";
    }
    


    if (c10800) var calidad = "-c 1080";
    if (c7200) var calidad = "-c 720";
    if (ilatino) var idioma = '-i "LATINO"';
    if (icastellano) var idioma = '-i "CASTELLANO"';
    if (isub) var idioma = '-i "SUB"';


    var de = dee ? "de3" : "de";
    var sub = subb ? `-s "${subb}"` : "";
    var id_unico = id_unico ? id_unico : '';
    var B_C_1080 = bajar_calidad_1080 ? '-C 1080' : '';
    var B_C_720 = bajar_calidad_720 ? '-C 720' : '';


    document.getElementById('comandoText').innerHTML = de + ' ' + nombre + ' ' + idioma + ' ' + calidad + ' ' + tmdb +
        ' ' + enlace + ' ' + sub + B_C_1080 + B_C_720 + opcionUnica + ' ' + id_unico + '-B true; de2 ' + nombre + ' ' + idioma + ' ' + calidad + ' ' + tmdb + ' ' + sub + B_C_1080 + B_C_720 + opcionUnica + ' ' + id_unico;
    // document.getElementById('comandoText').innerHTML = `de -n ${nombre} -c ${caidad} -i ${idioma} -t ${tmdb} -`
}
</script>

<script src="js/checked.js"></script>
<script src="js/peticiones.js"></script>
<script src="js/peli720.js"></script>
<script src="js/api-breaky.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<script>
    function fembed_estado_720(){
        url_fembed = document.getElementById("estado_fembed").value;
        url_fembed_api = url_fembed.replace("/f/", "/api/source/");
        const url_api = "http://51.195.148.50/panel2/panel/inc/include/fembed_720.php?u="+url_fembed

        fetch(url_api)
        .then(function(response) {
            // document.getElementById('resultadooVery').innerHTML = response.text();
            return response.text();
        })
        .then(data => {
            // data_json = JSON.parse(data);
            if (data){
                alert('CALIDAD 720p LISTA!!');
                console.log(data);
                document.getElementById('enlace').value= data;
            }else{
                alert("AUN NO ESTA LISTA :(");
            }

        })
        .catch(function(err) {
            console.error(err);
            document.getElementById('resultadooVery').innerHTML = err;
            document.querySelector('#cargaEmpezada').style.display = "none";

        });
    }
    // $(document).ready(function(){
    //     $('#estado_fembed').on('click', function(){
    //         var $this = $(this);
    //         url_fembed = document.getElementById("estado_fembed").value;
    //         url_fembed_api = url_fembed.replace("https://fembed.com/f/", "/api/source/");
    //         $.post(url_fembed_api, function(res){
    //             if(res.success) {
    //                 data = res.data;
    //                 alert(data);
    //                 console.log(data);
    //                 // $.getScript(res.player.revenue);
    //             }
    //         });
    //     });
    // });
</script>
</body>
<?php include_once 'footer.php'; ?>

</html>