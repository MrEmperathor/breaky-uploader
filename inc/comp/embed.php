<!-- #!/usr/bin/php -->
<?php
session_start();
include '../filevar.php';
include 'header.php';
include 'footer.php';

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";

if (!$_SESSION['admin']) {
  header('location:http://'.$host);
}



$sql_leer = "SELECT * FROM pelis WHERE TMDB LIKE '%$u%' ORDER BY TMDB";
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado = $gsent->fetchAll();

?>
<style>
.bienvenidos a{color:#e4e4e4;}
a:visited {text-decoration:none;color:#d35400;}
a:hover {text-decoration:underline;color:#999999;}
a:active {text-decoration:none;color:#bfbfbf00;}
</style>
<div class="ancho-letras">
    <div class="letras-slider">
        <h1 class="animated bounce"><?php echo $result['original_title'];?></h1>
        <h2><?php echo $name." ".$calidad." ".$idioma; ?></h2>

    </div>
    <section class="wap">
        <section class="conten-boton">
            <div class="poster">
                <?php echo("<img src='". $config['images']['base_url'] . $config['images']['poster_sizes'][4] . $result['poster_path'] . "'/>"); ?>
            </div>
            <section class="bienvenidos">
                <p><?php echo $result['overview']; ?></p>
                <h3 class="animated rubberBand">Enlaces</h3>
                <p>ID: <?php echo $u;?></p>
                <p><?php echo $MiPeli; ?></p><br>

                <?php foreach ($resultado as $datos):?>
                    <?php if ($datos['id'] == $id): ?>
                        <a href="#"><?php echo $datos['nombre']." ".$datos['calidad']." ".$datos['idioma']; ?></a><br>
                        <?php else: ?>
                            <a href="<?php echo $base.'embed.php?page='.$datos['id']; ?>"><?php echo $datos['nombre']." ".$datos['calidad']." ".$datos['idioma']; ?></a><br>
                    <?php endif ?>
                            

                    
                <?php endforeach ?>

                <h4>TODOS LOS ENLACES</h4>
                <div class="TextAli">
                    <span id="Tenlaces1">
                        <?php 
                        for ($i=0; $i<count($enlaces); $i++) { 
                         echo $enlaces[$i];
                         echo "<br>";
                        }
                        ?>
                     <a href=""></a>
                 </span> <br>
             </div>
             <button type=button id=bt9 data-clipboard-target=#Tenlaces1>Copiar</button>
         </section>
     </section>
 </section>



 <section class="wap">
    <section class="conten-boton">

        <div class="columnasx3">
            <h3>VERYSTREAM</h3>
            <span id=codigo2><?php echo $dlinks['verystream']; ?></span>
            <button type=button id=bt1 data-clipboard-target=#codigo2>Copiar</button>
        </div>
<!-- <div class="columnasx3">
    <h3>DRIVE</h3>
        <span id=codigo3><?php echo $$dlinks; ?></span>
        <button type=button id=bt2 data-clipboard-target=#codigo3>Copiar</button>
</div>
<div class="columnasx3">
    <h3>GD-VIP</h3>
        <span id=codigo4><?php echo $linkd2; ?></span>
        <button type=button id=bt3 data-clipboard-target=#codigo4>Copiar</button>
    </div> -->
<!-- <div class="columnasx3">
    <h3>STRAMANGO</h3>
        <span id=codigo5><?php echo $UrlMango; ?></span>
        <button type=button id=bt4 data-clipboard-target=#codigo5>Copiar</button>
    </div> -->
<!-- <div class="columnasx3">
    <h3>STREAMCHERRY</h3>
        <span id=codigo6><?php echo $UrlCherry; ?></span>
        <button type=button id=bt5 data-clipboard-target=#codigo6>Copiar</button>
    </div> -->
    <div class="columnasx3">
        <h3>DRIVE-DOWNLOAD</h3>
        <span id=codigo7><?php echo $dlinks['drive']; ?></span>
        <button type=button id=bt6 data-clipboard-target=#codigo7>Copiar</button>
    </div>
    <div class="columnasx3">
        <h3>MEGA</h3>
        <span id=codigo8><?php echo $dlinks['mega']; ?></span>
        <button type=button id=bt7 data-clipboard-target=#codigo8>Copiar</button>
    </div>
    <div class="columnasx3">
        <h3>DRIVE-OUO</h3>
        <span id=codigo9><?php echo $dlinks['dacortado']; ?></span>
        <button type="button" id=bt8 data-clipboard-target=#codigo9>Copiar</button>
    </div>
    <div class="columnasx3">
        <h3>MEGA-OUO</h3>
        <span id=codigo6><?php echo $dlinks['macortado']; ?></span>
        <button type=button id=bt5 data-clipboard-target=#codigo6>Copiar</button>
    </div>
</section>
</section>
<!-- BOTONES DE C
    OPIADO -->
</div>


</body>
</html>