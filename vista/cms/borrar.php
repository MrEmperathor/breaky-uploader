<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
session_start();
include 'comp/filevar.php';
include 'header.php';
include 'footer.php';

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";

if (!$_SESSION['admin']) {
  header('location:http://'.$host.'/panel');
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
.accordion {
            background-color: #2980b94a;
            color: #FFF;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            text-align: left;
            border: 1px solid white;
            outline: none;
            transition: 0.4s;
            font: 20px Lato, sans-serif;
        }

        /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
        .active, .accordion:hover {
            background-color: #2c3e50;
        }

        /* Style the accordion panel. Note: hidden by default */
        .panel {
            width: 100%;
            padding: 0 18px;
            /*background-color: white;*/
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
        }

        p{
            font: 16px Lato, sans-serif; 
        }

        .accordion:after {
            content: '\02795'; /* Unicode character for "plus" sign (+) */
            font-size: 13px;
            float: right;
            margin-left: 5px;
        }

        .active:after {
            content: "\2796"; /* Unicode character for "minus" sign (-) */
        }
        #tEnlaces {
            color: #000;
        }
        #IdBackupp {
            color: #000;
        }
        #titulo {
            color: #000;
        }
        #idpeli {
            color: #000;
        }
        #idBackup {
            color: #000;
        }

        .parpadea {
  
          animation-name: parpadeo;
          animation-duration: 1s;
          animation-timing-function: linear;
          animation-iteration-count: infinite;

          -webkit-animation-name:parpadeo;
          -webkit-animation-duration: 1s;
          -webkit-animation-timing-function: linear;
          -webkit-animation-iteration-count: infinite;
        }

        @-moz-keyframes parpadeo{  
          0% { opacity: 1.0; }
          50% { opacity: 0.0; }
          100% { opacity: 1.0; }
        }

        @-webkit-keyframes parpadeo {  
          0% { opacity: 1.0; }
          50% { opacity: 0.0; }
           100% { opacity: 1.0; }
        }

        @keyframes parpadeo {  
          0% { opacity: 1.0; }
           50% { opacity: 0.0; }
          100% { opacity: 1.0; }
        }
</style>


<script type="text/javascript" src="librerias/jquery-3.4.1.min.js"></script>
<script>
function realizaProceso(valorCaja1, valorCaja2, valorCaja3){

        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2,
                "valorCaja3" : valorCaja3
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                // data: {'parametros': JSON.stringify(parametros)},
                url:   'comp/postEmbed.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultadoo").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultadoo").html(response);
                }
        });
}
</script>
<script>
function realizaProcesoPaste(tEnlaces, idBackup, titulo, idpeli){

        var parametros = {
                "tEnlaces" : tEnlaces,
                "idBackup" : idBackup,
                "titulo" : titulo,
                "idpeli" : idpeli
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                // data: {'parametros': JSON.stringify(parametros)},
                url:   'comp/postPaste.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#Tenlaces2").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#Tenlaces2").html(response);
                }
        });
}
</script>

<script>
function eliminarEmbed(valorCaja1, valorCaja2, valorCaja3, valorCaja4){

        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2,
                "valorCaja3" : valorCaja3,
                "valorCaja4" : valorCaja4
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                // data: {'parametros': JSON.stringify(parametros)},
                url:   'xion/eliminar.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#eliminado").html("Eliminando...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#eliminado").html(response);
                }
        });
}
</script>

<script>
function respaldoLinks(valorCaja1, valorCaja2, valorCaja3, valorCaja4, valorCaja5, idEmbed, pastel){


        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2,
                "valorCaja3" : valorCaja3,
                "valorCaja4" : valorCaja4,
                "valorCaja5" : valorCaja5,
                "idEmbed" : idEmbed,
                "pastel" : pastel
        };


        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                // data: {'parametros': JSON.stringify(parametros)},
                url:   'comp/resvery.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultadooVery").html("Actualizando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
    
                        $("#resultadooVery").html(response);
                }
        });
}
</script>
<body>



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
                <h4>TODOS LOS ENLACES</h4>
                <div class="TextAli">
                    <span id="Tenlaces1">
                        <?php 
                            foreach ($enlaces as $key => $value) {
                                echo $value.'<br>';
                            }
                            echo $resultado_unico['Embed'];
                            

                            // echo $enlaces[0].'<br>';
                            // echo $enlaces[1].'<br>';
                            // echo $enlaces[2].'<br>';
                            // echo $enlaces[3].'<br>';
                            // echo $enlaces[4].'<br>';
                        ?>
                 </span><br>
             </div>
             <button type=button id=bt9 data-clipboard-target=#Tenlaces1>Copiar</button>
         </section>


            <input type="hidden" name="caja_texto" id="valor1" value="<?php 
                            $veryEmbed = str_replace('/stream/', '/e/', $enlaces[0]);

                            echo $veryEmbed.'|';
                            echo $enlaces[1].'|';
                            echo $enlaces[2].'|';
                            // echo $enlaces[3].'|';
                            echo $enlaces[4];
                        ?>"/> 

            <input type="hidden" name="caja_texto" id="valor2" value="<?php echo $name." ".$calidad." ".$idioma; ?>"/>
            <input type="hidden" name="caja_texto" id="valor3" value="<?php echo $id; ?>"/>
            <!-- <span id="resultado"></span> -->

    <!-- ELIMINAR EMBED -->
    <input type="hidden" name="caja_texto" id="elimi1" value="<?php echo $id; ?>"/>
    <input type="hidden" name="caja_texto" id="elimi2" value="<?php echo " "; ?>"/>
    <!-- datos para el paste -->
    <?php 
        $tEn = base64_encode(serialize($dlinks));
        $IdBackup2 = str_replace('&export=download', '', str_replace('https://drive.google.com/uc?id=', '', $dlinks['drive']));
        $respaldo = ($IdBackup) ? $IdBackup : $IdBackup2;
        $title =  $name." ".$calidad." ".$idioma;
     ?>
    <input type="text" name="caja_texto" id="tEnlaces" value="<?php echo $tEn; ?>"/>
    <input type="text" name="caja_texto" id="idBackup" value="<?php echo $respaldo; ?>"/>
    <input type="text" name="caja_texto" id="titulo" value="<?php echo $title; ?>"/>
    <input type="text" name="caja_texto" id="idpeli" value="<?php echo $id; ?>"/>
<!-- 
<?php 

    $emb = ($datos['Embed']) ? $datos['Embed'] : '<span id="resultadoo"></span>';
    // $emb = ($datos['Embed']) ? "<span id="resultadoo">".echo $datos['Embed'];."</span>" : '<span id="resultadoo"></span>';
?> -->


    <section class="bienvenidos">
        <?php foreach ($resultado as $datos):?>
            <?php if ($datos['id'] == $id): ?>
                <!-- <a href="#" onclick="funcion();return false;"><?php echo $datos['nombre']." ".$datos['calidad']." ".$datos['idioma']; ?></a><br> -->
                <span class="parpadea" "><?php echo $datos['nombre']." ".$datos['calidad']." ".$datos['idioma']; ?></span><br>
            <?php else: ?>
                <a href="<?php echo $base.'embed/'.$datos['id']; ?>"><?php echo $datos['nombre']." ".$datos['calidad']." ".$datos['idioma']; ?></a><br>
            <?php endif ?>
        <?php endforeach ?><br><hr><br>
                <div class="TextAli">
                    <span id="Tenlaces2">
                        <?php
                        echo $enlaces[6].'<br>';
                        echo $enlaces[5].'<br>';
                        // echo $datos['Embed'];
                        // echo $emb;
                        ?>
                        <span id="resultadoo"><?php echo $resultado_unico['Embed'];?></span>
                        <!-- <span id="eliminado"></span> -->
                 </span>
             </div>
             <button type=button id=bt9 data-clipboard-target=#Tenlaces2>Copiar</button>
             <input type="button" id=BotomEmbed href="javascript:;" onclick="realizaProceso($('#valor1').val(), $('#valor2').val(), $('#valor3').val());return false;" value="Embed"/>
             <input type="button" id=BotomPaste href="javascript:;" onclick="realizaProcesoPaste($('#tEnlaces').val(), $('#idBackup').val(), $('#titulo').val(), $('#idpeli').val());return false;" value="PASTE"/>

            <!-- eliminar embed -->
             <!-- <input type="button" id=BotomEmbed href="javascript:;" onclick="eliminarEmbed($('#elimi1').val(), $('#elimi2').val(), $('#elimi3').val(), $('#elimi4').val());return false;" value="Eliminar"/> -->

         </section> 

         <!-- <form action="xion/eliminar.php" method="post">
<input type="hidden" name="dato" value="<?php echo ""; ?>"><br>
<input type="submit" id=BotomEmbed>
</form>
 -->

<!-- <form id="form1" action="xion/eliminar.php" method="POST"> 
<input type="hidden" name="dato" value="<?php echo "otroenlace"; ?>"/>
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
</form> 
<a href="embed/<?php echo $id; ?>" id=BotomEmbed onclick="javascript:document.form1.submit()" title="Abre el enlace">Borrar</a> -->









 <input type="hidden" name="caja_texto" id="veryy" value="<?php 
    $ser = base64_encode(serialize($enlaces));
    echo $ser;
?>"/>

 <?php 
    $idsucio = str_replace('https://drive.google.com/uc?id=', '', $dlinks['drive']);
    $IdLimpio = str_replace('&export=download', '', $idsucio);
    $IDDRIVE = (!empty($tituloGD)) ? $IdBackup : $IdLimpio;
    // $IdBackup
    // $IdLimpio

    $pasteArray = base64_encode(serialize(array($enlaces[6], $enlaces[5], $dlinks['dacortado'], $dlinks['macortado'])));
 ?>
	<!-- <input type="hidden" name="caja_texto" id="valorVeryId" value="<?php echo $id; ?>"/>
    <input type="text" name="caja_texto" id="IdBackupp" value="<?php echo $IDDRIVE; ?>"/> -->
    <input type="hidden" name="caja_texto" id="valorVeryId" value="<?php echo $id; ?>"/>
    <input type="text" name="caja_texto" id="IdBackupp" value="<?php echo $IDDRIVE; ?>"/>
    <input type="hidden" name="caja_texto" id="idEmbedid" value="<?php echo $resultado_unico['Embed']; ?>"/>
    <input type="hidden" name="caja_texto" id="pastell" value="<?php echo $pasteArray; ?>"/>
        <section class="bienvenidos">
                <div class="TextAli">
                    <span id="Tenlaces3">

                        <span id="resultadooVery"></span>

                 </span>
             </div>
             <button type=button id=bt9 data-clipboard-target=#Tenlaces3>Copiar</button><br>
             <input type="checkbox" name="caja_texto" id="siparavery" value="<?php echo $IDDRIVE; ?>"/>Verystream <br>
             <input type="checkbox" name="caja_texto" id="siparanetu" value="<?php echo $IDDRIVE; ?>"/>Netu <br>

             <script>
                    $(function(){

                        $("#siparanetu").on('change', function() {
                    
                            if( $(this).is(':checked') ){
                                /*LOQUE SEA QUE CUIQREAS*/
                                // alert("Veryficado");
                                $('#siparanetu').val("0");

                            }else{
                                /*OTRO LO QUE SEA*/
                                alert("no veryfycado");
                                $('#siparanetu').val('');
                            }
                        });
                    })
                   $(function(){

                        $("#siparavery").on('change', function() {
                    
                            if( $(this).is(':checked') ){
                                /*LOQUE SEA QUE CUIQREAS*/
                                // alert("Veryficado");
                                $('#siparavery').val("0");

                            }else{
                                /*OTRO LO QUE SEA*/
                                alert("no veryfycado");
                                $('#siparavery').val('');
                            }
                        });
                    }) 
             </script>
             <input type="button" id=BotomVery href="javascript:;" onclick="respaldoLinks($('#veryy').val(), $('#valorVeryId').val(), $('#IdBackupp').val(), $('#siparavery').val(), $('#siparanetu').val(), $('#idEmbedid').val(), $('#pastell').val());return false;" value="EmbedVery"/>
         </section>






     </section>
 </section>


 <section class="wap">
    <section class="conten-boton">
        <div class="columnasx3-1">
                <button class="accordion">Servidores</button>
                    <div class="panel">
                        <div class="columnasx3">
                            <h3>VERYSTREAM</h3>
                            <span id=codigo2><?php echo $dlinks['verystream']; ?></span>
                            <button type=button id=bt1 data-clipboard-target=#codigo2>Copiar</button>
                        </div>
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
                    </div> 
        </div>
    </section>
</section>
<!-- BOTONES DE C
    OPIADO -->


    <script type="text/javascript">
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight){
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            } 
          });
        }
</script>
</body>
</html>