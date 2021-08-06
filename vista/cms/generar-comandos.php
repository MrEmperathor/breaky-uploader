<?php 
session_start();
require_once('inc/config.php');
// $_SESSION["nombre"] == $CONFIG["EmbedUser2"];
$de = ($_SESSION["nombre"] == $CONFIG["EmbedUser2"]) ? true : false;
?>

<div class="container borColor">
    <div class="row">
        <div class="col-6">
            <label for="name">Nombre Pelicula</label>
            <input type="text" name="name" class="form-control" id="nombre" aria-describedby="emailHelp">
            <!-- <label for="enlace">Enlace</label>
            <input type="text" name="enlace" class="form-control" id="enlace" aria-describedby="emailHelp"> -->

            <!-- <label for="subtitulo">Subtitulos</label>
            <input type="text" name="subtitulo" class="form-control" id="subti" aria-describedby="emailHelp"> -->
            <label for="name-epi">Renombrar desde el episodio</label>
            <input type="number" name="name-epi" class="form-control" id="name-epi" aria-describedby="emailHelp">
            <label for="name-urlviki">URL Viki 1 enlace</label>
            <input type="text" name="name-urlviki" class="form-control" id="name-urlviki" aria-describedby="emailHelp">

            <label for="subti">Pegar Subtitulos desde:</label>
            <div class="card w-70 azul1-t redon-t-acortador">
                <select class="rowser-default custom-select redon-t" id="subti" name="subti">
                    <option selected>Pegar Subtitulos desde:</option>
                    <option value="sub_rar">Archivo .rar (Beta)</option>
                    <option value="sub_mkv">Archivo .mkv (Beta)</option>
                    <option value="sub_enlace">Enlace</option>
                </select>
                <div id="mostar_imput_sub"></div>
                <!-- onchange="ShowSelected(); -->
                <!-- <div class="card-body mr-3">
                    <div class="md-form form-sm text-white" id="resultadoC"></div>
                    <div id="resBotom">
                        <button type="button" class="btn purp-t text-white redon-t mt-n3" id="mibtn">Acortar</button>
                    </div>
                </div> -->
            </div>
            <!-- Default unchecked -->
            <div class="custom-control custom-radio mt-2">
                <input type="radio" class="custom-control-input" id="c1080" name="defaultExampleRadios" checked>
                <label class="custom-control-label" for="c1080">1080</label>
            </div>

                <!-- Default checked -->
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="c720" name="defaultExampleRadios">
                <label class="custom-control-label" for="c720">720</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="ccam" name="defaultExampleRadios">
                <label class="custom-control-label" for="ccam">CAM</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="chd" name="defaultExampleRadios">
                <label class="custom-control-label" for="chd">HD</label>
            </div>
        </div>
        <div class="col-6">
            <label for="tmdb">TMDB</label>
            <input type="text" name="tmdb" class="form-control" id="tmdb" aria-describedby="emailHelp">
            <label for="name-temporada">Numero de temporada</label>
            <input type="number" name="name-temporada" class="form-control" id="name-temporada" aria-describedby="emailHelp">
            <label for="name-epiviki">Cantidad de episodios a buscar</label>
            <input type="number" name="name-epiviki" class="form-control" id="name-epiviki" aria-describedby="emailHelp">
            <label for="contra">Contraseña</label>
            <input type="text" name="contra" class="form-control" id="contra" aria-describedby="emailHelp">
            <!-- Default unchecked -->
            <div class="custom-control custom-radio mt-2">
                <input type="radio" class="custom-control-input" id="ilatino" name="idioma" checked>
                <label class="custom-control-label" for="ilatino">Latino</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="icastellano" name="idioma">
                <label class="custom-control-label" for="icastellano">Castellano</label>
            </div>

                <!-- Default checked -->
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="isub" name="idioma">
                <label class="custom-control-label" for="isub">Subtitulado</label>
            </div>
        </div>
            <div class="col">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="eliminar_audio" name="eliminar_audio">
                    <label class="custom-control-label" for="eliminar_audio">Eliminar audios segundarios</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="eliminar_sub" name="eliminar_sub">
                    <label class="custom-control-label" for="eliminar_sub">Eliminar subtitulos</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="marca_agua" name="marca_agua">
                    <label class="custom-control-label" for="marca_agua">Marca de Agua</label>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col">
                <div class="form-group purple-border">
                    <label for="exampleFormControlTextarea4">Enlaces</label>
                    <textarea class="form-control" name="enlace" id="enlace" rows="6" placeholder="Pegar enlaces"></textarea>
                </div>
            <button type="button" class="btn btn-primary" id="comprobar_enlace">COMPROBAR ENLACES</button>
            </div>
        </div>
        <div class="col-6" id="enlaces_comprobados" style="font-size: 13px;"></div>
    <div class="row">
        <div class="col">
            <div class="form-group purple-border">
                <label for="exampleFormControlTextarea4">Resultado: </label>
                <textarea class="form-control" id="comandoText" rows="6"></textarea>
            </div>
            <button type="button" class="btn btn-primary" onclick="accion();">++ADD</button>
            <button type="button" class="btn btn-primary" onclick="accion_clear();">CLEAR</button>
        </div>
    </div>
</div>



<script type="text/javascript">
// Se ejecuta al iniciar la pagina
$(function() {
    let contra = localStorage.getItem("contra");
    if (contra) document.getElementById('contra').value = contra;
});

function accion_clear(){
    document.getElementById('comandoText').value = '';
}

function limpiarImputs(){
    document.getElementById('nombre').value = '';
    // let nombre = ` -n "${document.getElementById('nombre').value.replace(/[^a-zA-Z ]/g, "")}"`;
    // let nombre = nombre.replace(/[^a-zA-Z ]/g, "")
    document.getElementById('enlace').value = '';
    document.getElementById('subti').value = '';
    document.getElementById('tmdb').value = '';
    document.getElementById('contra').value = '';
}
const button = document.getElementById('comprobar_enlace');
button.addEventListener('click', () => {
    validarEnlacesUpx();
});


const sub_button = document.querySelector('#subti');
sub_button.addEventListener('change', (event) => {

    if (event.target.value == 'sub_enlace') {
         var result = `<label for="subtitulo">Pegar Enlace Sub</label>
        <input type="text" name="subtitulo" class="form-control" id="subti_enlace" aria-describedby="emailHelp">`;
    }else if(event.target.value == 'sub_rar'){
        var result = '';
        window.sub_extra = ' -s sub-rar';
        
    }else if(event.target.value == 'sub_mkv'){
        var result = '';
        window.sub_extra = ' -s sub-mkv';
    }else{
        var result = '';
    }
    document.getElementById('mostar_imput_sub').innerHTML = result;
});

function pintarEnlacesComprobados(enlaArray) {

    document.getElementById('enlaces_comprobados').innerHTML = '';

    var a = enlaArray.map((obj) => {


        var aprobado = obj.file_name ? `<div class="alert alert-success" role="alert" style="text-transform: none;">${obj.file_name} - https://uptobox.com/${obj.file_code}</div>`: `<div class="alert alert-danger" role="alert" style="text-transform: none;"> Error! https://uptobox.com/${obj.file_code}</div>`;

        document.getElementById('enlaces_comprobados').innerHTML += aprobado;

        console.log(obj.file_name);
        console.log(obj.file_code);


    })
}

function validarEnlacesUpx() {

    let enlace = document.getElementById('enlace').value;

    const exp = /\n/g;
    const regex = /^(\w+):\/\/([^\/]+)\/([^]+)$/;
    var idUpx = '';
    var words = enlace.split(exp);
    words.forEach(element => {
        if(element) idUpx += element.match(regex)[3]+',';
    });
    idUpx = idUpx.slice(-1) ? idUpx.slice(0, -1) : idUpx;

    axios({
        method: 'GET',
        url: `https://uptobox.com/api/link/info?fileCodes=${idUpx}`,
    }).then(function (res) {
        pintarEnlacesComprobados(res.data.data.list);
    })
    
}

var normalize = (function() {
  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑÇç", 
      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuuncc",
      mapping = {};
 
  for(var i = 0, j = from.length; i < j; i++ )
      mapping[ from.charAt( i ) ] = to.charAt( i );
 
  return function( str ) {
      var ret = [];
      for( var i = 0, j = str.length; i < j; i++ ) {
          var c = str.charAt( i );
          if( mapping.hasOwnProperty( str.charAt( i ) ) )
              ret.push( mapping[ c ] );
          else
              ret.push( c );
      }      
      return ret.join( '' );
  }
 
})();

function saveValueLocalStorage(name,value) {

    if (name && value) localStorage.setItem(name,value);
}
function accion(){
    let nombre = ` -n "${normalize(document.getElementById('nombre').value)}"`;
    // let nombre = ` -n "${document.getElementById('nombre').value.replace(/[^a-zA-Z ]/g, "")}"`;
    // let nombre = nombre.replace(/[^a-zA-Z ]/g, "")
    let enlace = document.getElementById('enlace').value;
    let subb_enlace = document.getElementById('subti_enlace') ? document.getElementById('subti_enlace').value : document.getElementById('subti').value;
    let tmdb = ` -t ${document.getElementById('tmdb').value}`;
    let c10800 = document.getElementById('c1080').checked;
    let c7200 = document.getElementById('c720').checked;
    let ccam = document.getElementById('ccam').checked;
    let chd = document.getElementById('chd').checked;
    let ilatino = document.getElementById('ilatino').checked;
    let icastellano = document.getElementById('icastellano').checked;
    let isub = document.getElementById('isub').checked;
    let eliminar_audio = document.getElementById('eliminar_audio').checked;
    let eliminar_sub = document.getElementById('eliminar_sub').checked;
    let marca_agua = document.getElementById('marca_agua').checked;
    let contra = document.getElementById('contra').value;
    let renomDesdeEpisodio = document.getElementById('name-epi').value;
    let urlVikiUnEnlace = document.getElementById('name-urlviki').value;
    let numeroTemporada = document.getElementById('name-temporada').value;
    let cantidadEpisodioBuscar = document.getElementById('name-epiviki').value;
    var dee = '<?php echo $de;?>';

    // GUARDAR EN LOCALSTORAGE
    saveValueLocalStorage("contra", contra);



    exp = /\n/g;
    var enlaces = '';
    var words = enlace.split(exp);
    if (urlVikiUnEnlace) {
        words.forEach(element => {
        if(element) enlaces += ` -V '${element}'`;
        });
    } else {
        words.forEach(element => {
        if(element) enlaces += ` -e '${element}'`;
        });
    }
    // words.forEach(element => {
    //     if(element) enlaces += ` -e '${element}'`;
    // });

    // if(c10800){
    //     var c1080 = 1080;
    // }
    
    if(c10800) var calidad = " -c 1080 -K 1080";
    if(c7200) var calidad = " -c 720 -K 720";
    if(ccam) var calidad = " -c CAM -K CAM";
    if(chd) var calidad = " -c HD -K HD";
    if(ilatino) var idioma = ' -i "LATINO"';
    if(icastellano) var idioma = ' -i "CASTELLANO"';
    if(isub) var idioma = ' -i "SUB"';
    
    if (subb_enlace == 'sub_rar') {
        subb_enlace = ' -s "sub-rar"';
    }else if(subb_enlace == 'sub_mkv'){
        subb_enlace = ' -s "sub-mkv"';
    }else if(subb_enlace == 'sub_enlace'){
        subb_enlace = ` -s "${subb_enlace}"`
    }else{
        subb_enlace = '';
    }
    if (renomDesdeEpisodio) {
        var de = 'se3';
        var de_ = 'se4 ';
    } else {
        var de = dee ? "de3" : "de";
        var de_ = dee ? "de2" : "de";
    }
    // var de = dee ? "de2" : "de";
    // var sub1 = window.sub_extra ? window.sub_extra : '';
    var sub = subb_enlace ? subb_enlace : '';
    var cont = contra ? ` -p '${contra}'` : "";
    var eliminar_audioo = eliminar_audio ? ' -L "true"' : "";
    var eliminar_subb = eliminar_sub ? ' -F "true"' : "";
    var marca_aguaa = marca_agua ? ' -m "true"' : "";
    var enla = enlaces ? enlaces : '';
    var renomEpi = renomDesdeEpisodio ? ` -R ${renomDesdeEpisodio}` : ''; 
    // var urlViki = urlVikiUnEnlace ? `-V "${urlVikiUnEnlace}"` : '';
    var numTemp = numeroTemporada ? ` -T ${numeroTemporada}` : '';
    var cantTemp = cantidadEpisodioBuscar ? ` -E ${cantidadEpisodioBuscar}` : '';

    
    document.getElementById('comandoText').innerHTML += de+' -B true'+nombre+idioma+calidad+tmdb+enla+sub+eliminar_audioo+eliminar_subb+marca_aguaa+cont+renomEpi+numTemp+cantTemp+"; "+de_+nombre+idioma+calidad+tmdb+eliminar_audioo+eliminar_subb+marca_aguaa+cont+renomEpi+numTemp+cantTemp+"; ";
    // limpiarImputs();
    // document.getElementById('comandoText').innerHTML = `de -n ${nombre} -c ${caidad} -i ${idioma} -t ${tmdb} -`
}
    
</script>