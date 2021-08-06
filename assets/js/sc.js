// var formulario = '<form><div class="form-row align-items-center"><div class="col-6"><label class="sr-only" for="inlineFormInput">Name</label><input type="text" class="form-control mb-2" id="inlineFormInput" name="url" placeholder="Jane Doe"></div><div class="col-auto"><button type="submit" class="btn btn-primary mb-2" onclick="enviar();">Submit</button></div></div></form>';

// function formu(){
//     document.getElementById('resultado').innerHTML = formulario;
// }
// formu();
window.buffer = [];
window.bufferResultado = '';
window._$targetResultado = document.getElementById('resultado');

// Creamos una variable global para nuestro ID de intervalo
window._$target = document.getElementById('MostrarComando');
function Cargando(clase) {
    var x = document.getElementsByClassName(clase);
    console.log(x[0])
    console.log('salida1: '+x[1])
    console.log('salida2: '+x[0].style.display)
    if (x[0].style.display === "none") {
        x[0].style.display = "block";
    } else {
        x[0].style.display = "none";
    }
}
function enviar(){

    var url = document.getElementById('inlineFormInput').value;
    // document.getElementById('resultado').innerHTML = link += '<d><button type="submit" class="btn btn-primary mb-2" onclick="formu();">Submit</button>';
    var x = location.hostname;
    const a = "http://"+x+"/panel/vista/cms/pedir.php?url=" + url;

    function traerDatos(a){

        const xhttp = new XMLHttpRequest();
        xhttp.open('GET', a, true);
        xhttp.send();
        if(xhttp.readyState == 1) {
            // document.getElementById('resultado').innerHTML = "";
            Cargando('preloader');
        }
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                Cargando('preloader');

                var obj = JSON.parse(this.responseText);

                for (let i = 0; i < obj.imagen.length; i++) {
                    const img = obj.imagen[i];
                    var btnIdioma = "";
                    

                    for (let key in obj.player[i]) {
                        if (obj.player[i].hasOwnProperty(key)) {
                                if (key == "latino") {

                                    btnIdioma += `<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="traerEnlaces('${obj.player[i][key]}','${obj.player[i]['name_original']}','${key}','${obj.title[i]}');">${key}</button><hr>`;

                                }else if (key == "ingles"){

                                    btnIdioma += `<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="traerEnlaces('${obj.player[i][key]}','${obj.player[i]['name_original']}','${key}','${obj.title[i]}');">${key}</button><hr>`;

                                }else if (key == "castellano"){

                                    btnIdioma += `<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="traerEnlaces('${obj.player[i][key]}','${obj.player[i]['name_original']}','${key}','${obj.title[i]}');">${key}</button><hr>`;

                                }
                            
                            // let playerIdioma = obj.player[i][key];
                        }
                    }
                    // document.getElementById("resultado").innerHTML += `<div class="col"><div class="card" style="width: 13rem;"><img src="${obj.imagen[i]}" class="card-img-top" alt="${obj.title[i]}"><div class="card-body" style="padding: 10px; margin-bottom: -20px;"><h6 class="card-title" style="max-height: 40px; overflow: hidden; font-size: 0.877em; text-align: center; margin-bottom: 0;">${obj.title[i]}</h6><div style="text-align: center; padding: 8%;"><span style="padding: 10px;">${obj.calidad[i]}</span><span>${obj.ano[i]}</span><div></div><div class="card-body" style="padding: 15px; text-align: center;">${btnIdioma}</div></div></div>`;
                    window.bufferResultado += `<div class="col"><div class="card" style="width: 13rem;"><img src="${obj.imagen[i]}" class="card-img-top" alt="${obj.title[i]}"><div class="card-body" style="padding: 10px; margin-bottom: -20px;"><h6 class="card-title" style="max-height: 40px; overflow: hidden; font-size: 0.877em; text-align: center; margin-bottom: 0;">${obj.title[i]}</h6><div style="text-align: center; padding: 8%;"><span style="padding: 10px;">${obj.calidad[i]}</span><span>${obj.ano[i]}</span><div></div><div class="card-body" style="padding: 15px; text-align: center;">${btnIdioma}</div></div></div></div></div>`;
                    
                    // document.getElementById("resultado").innerHTML += `<div class="col"><div class="card"><img src="${obj.imagen[i]}" class="card-img-top" alt="${obj.title[i]}"><div class="card-body"><h6 class="card-title">${obj.title[i]}</h6><div><span style="padding: 10px;">${obj.calidad[i]}</span><span>${obj.ano[i]}</span><div></div><div class="card-body" style="padding: 15px; text-align: center;">${btnIdioma}</div></div></div>`;
                }
                // document.getElementById("resultado").innerHTML = obj.imagen;
                window._$targetResultado.innerHTML = window.bufferResultado;
                console.log(window.bufferResultado);
                window.bufferResultado = '';
    
                
            }
        }
    }
    traerDatos(a);

}

function traerEnlaces(pl,name,idioma,name_two) {

    // limpirar ventana modal
    document.getElementById("modalEnlaces").innerHTML = "";
    document.getElementById("modalPeso").innerHTML = "";
    document.getElementById("tmdbContenedor").innerHTML = "";
    document.getElementById("cargap").innerHTML = "";
    window.buffer[0] = name_two;
    window.buffer[1] = idioma;


    var ple = btoa(pl);
    // var ple = encodeURI(pl);
    var x = location.hostname;
    const b = "http://"+x+"/panel/vista/cms/pedir.php?pl=" + ple;
    console.log('se enviara' + b);

    const phttp = new XMLHttpRequest();

    function transferComplete(evt) {
        // alert("The transfer is complete.");
        document.getElementById("cargap").innerHTML = `<div class="alert alert-success" role="alert">The transfer is complete || ${name} || ${idioma}</div>`;
    }
    function updateProgress(evt) {
    if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        document.getElementById("cargap").innerHTML += percentComplete;
        console.log(percentComplete);
        // alert(percentComplete);
    }
    }

    phttp.addEventListener("load", transferComplete, false);
    phttp.addEventListener("progress", updateProgress, false);
    phttp.open('GET', b, true);
    phttp.send();
    if(phttp.readyState == 1) Cargando('preloader1');
    phttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {

            Cargando('preloader1');
            console.log('obteiendo'+this.responseText); 

            var objp = JSON.parse(this.responseText);
            document.getElementById("modalEnlaces").innerHTML = "";

            for (let i = 0; i < objp.links.length; i++) {

                var element = objp.links[i];
                // pintar subtitulos
                if (objp.links[objp.links.length - 1] == objp.links[i]) {
                    var subt = `<div class="alert alert-primary" role="alert" style="white-space: nowrap; overflow: hidden;">${objp.sub}</div>`;
                    document.getElementById("modalEnlaces").innerHTML += `${subt}`;
                    window.buffer[4] = objp.sub;
                }

                document.getElementById("modalEnlaces").innerHTML += `<div class="alert alert-primary" role="alert" style="white-space: nowrap; overflow: hidden;">${element}</div>`;

                var parser = new URL(element);
                if (parser.host == "drive.google.com") {
                    var urlDrive = element;
                    window.buffer[2] = urlDrive; 
                }
                
                // document.getElementById("modalEnlaces").innerHTML += `<button type="button" id="bt1" class="btn btn-primary" data-clipboard-target=#codi${i}>Copiar</button>`;

            }

            var botonId = `<button type="button" id="bt1" class="btn btn-primary" onclick="BuscarIdTMDB('${name}','${urlDrive}','${idioma}');">BUSCAR ID</button>`; 
            document.getElementById('modalEnlaces').innerHTML += botonId;

            var botonPeso = `<button type="button" id="bt1" class="btn btn-primary" onclick="BuscarPeso('${urlDrive}');">TAMAÑO</button>`; 
            document.getElementById('modalEnlaces').innerHTML += botonPeso;

            var GenerarComa = `<button type="button" id="bt1" class="btn btn-primary" onclick="generarComandos();">COMANDO</button>`; 
            document.getElementById('modalEnlaces').innerHTML += GenerarComa;
            
        }
    }
}

function BuscarIdTMDB(name,url,idioma) {
    
    var x = location.hostname;
    const uritmdb = "http://"+x+"/panel/vista/cms/pedir.php?id=" + name;
    const ihttp = new XMLHttpRequest();
    ihttp.open('GET', uritmdb, true);
    ihttp.send();
    ihttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            var TMDB = JSON.parse(this.responseText);
            
            for (let key in TMDB.results) {
                if (TMDB.results.hasOwnProperty(key)) {
                    var idTm = TMDB.results[key]["id"];
                    window.buffer[3] = TMDB.results[0]["id"];
                    console.log(idTm);
                    document.getElementById('tmdbContenedor').innerHTML += `<div class="col"><div class="card"><img class="card-img-top" src="https://image.tmdb.org/t/p/w600_and_h900_bestv2${TMDB.results[key]["poster_path"]}" alt="Card image cap"><div class="card-body"><h5 class="card-title">${TMDB.results[key]["id"]}</h5><p class="card-text">${TMDB.results[key]["original_title"]}</p><p class="card-text"><small class="text-muted">${TMDB.results[key]["release_date"]}</small></p></div></></div>`;
                }
            }
        }
        
    }
    
}

function BuscarPeso(urlDrive){

    const regex = /[-\w]{25,}/;
    const idGd = urlDrive.match(regex);

    // document.getElementById('modalPeso').innerHTML += `<div class="alert alert-primary" role="alert" style="white-space: nowrap; overflow: hidden;">url drive ${urlDrive}</div>`;

    var x = location.hostname;
    const gdPeso = "http://"+x+"/panel/vista/cms/pedir.php?peso=" + idGd[0];
    const ghttp = new XMLHttpRequest();
    ghttp.open('GET', gdPeso, true);
    ghttp.send();
    if(ghttp.readyState == 1) Cargando('preloader2');

    ghttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            Cargando('preloader2');

            var pesoRecivido = JSON.parse(this.responseText);

            document.getElementById('modalPeso').innerHTML += `<div class="alert alert-primary" role="alert" style="white-space: nowrap; overflow: hidden;">${pesoRecivido}</div><div class="alert alert-primary" role="alert" style="white-space: nowrap; overflow: hidden;">${pesoRecivido.slice(-6)}</div>`;
        }
        
    }
}

function generarComandos() {

    nombre = `-n "${window.buffer[0]}"`;
    idioma = `-i "${window.buffer[1]}"`;
    enlace = `-e "${window.buffer[2]}"`;
    tmdb = `-t "${window.buffer[3]}"`;

    sub = window.buffer[4] && window.buffer[1] == "ingles" ? `-s "${window.buffer[4]}"` : "";
    // sub = `-s "${window.buffer[4]}"`;
    calidad = '-c 1080';
    de = 'de2';

    var comando = de + ' ' + nombre +' ' + idioma +' ' + calidad +' '+ tmdb +' '+ enlace +' '+ sub;

    document.getElementById('MostrarComando').innerHTML = `<textarea class="form-control" id="comandoText" rows="6">${comando}</textarea>`;
}