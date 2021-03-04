function doSomething_Click() {

    var fembed = document.getElementById('fembed').value;
    var mystream = document.getElementById('mystream').value;
    var hqq = document.getElementById('hqq').value;
    var fembedRedirect = document.getElementById('fembedRedirect').value;
    var short = document.getElementById('short').value;
    var ouo = document.getElementById('ouo').value;
    //idioma
    var idio = document.getElementById('idioma').value;
    // calidad
    var calid = document.getElementById('calidad').value;
    //tmdb
    var tmdb = document.getElementById('tmdb').value;

    /*
    create: crear post nuevos
    update_links: actualizar post
    */

    var links = [];
    var idioma = [];
    var calidad = [];
    var api_key = '4cd9cd25-fc28-4089-9977-70377dc6cd4f';
    var type = 'create';
    // var urll = 'http://pelis24hd.test/wp-json/bk-dcms-seo-yoast-generate-post/v2';
    // postID/88/api/'.$api_key.'/blinks/'.$enlacess.'/blang/'.$idiomas.'/bcalidad/'.$calidades.'/type/'.$type';
    
    if (fembed && fembed != "No hay enlaces") links.push(fembed);
    if (mystream && mystream != "No hay enlaces") links.push(mystream);
    if (hqq && hqq != "No hay enlaces") links.push(hqq);
    if (fembedRedirect && fembedRedirect != "No hay enlaces") links.push(fembedRedirect);
    if (short && short != "No hay enlaces") links.push(short);
    if (ouo && ouo != "No hay enlaces") links.push(ouo);

    
    if (idio == "LAT" || idio == "LATINO") {

        var bkIdioma = "Latino";

    } else if (idio == "CASTELLANO") {

        var bkIdioma = "Castellano";

    } else if (idio == "SUB" || idio == "SUBTITULADO") {

        var bkIdioma = "Subtitulado";

    }

    if (calid == "(1080)") {
        var bkCalidad = "708";
    }else if (calid == "(720)") {
        var bkCalidad = "795";
    }

    for (let i = 0; i < links.length; i++) {
        // const element = array[i];
        idioma.push(bkIdioma);
        calidad.push(bkCalidad);
    }

    var linksFinal = btoa(JSON.stringify(links)); 
    var idiomaFinal = btoa(JSON.stringify(idioma)); 
    var calidadFinal = btoa(JSON.stringify(calidad));

    console.log(linksFinal);
    console.log(idiomaFinal);
    console.log(calidadFinal);

    /*
    codificar a base64 btoa()
    decoificr base64 atob()
    var varDecode = btoa(varEncode);
    // postID/88/api/{api_key}/blinks/'.$enlacess.'/blang/'.$idiomas.'/bcalidad/'.$calidades.'/type/'.$type';

    */
//    const urll = `http://pelis24hd.test/wp-json/bk-dcms-seo-yoast-generate-post/v2/postID/${tmdb}/api/${api_key}/blinks/${linksFinal}/blang/${bcalidad}/bcalidad/${calidades}/type/${type}/`;
   const urll = 'http://pelis24hd.test/wp-json/bk-dcms-seo-yoast-generate-post/v2/postID/'+tmdb+'/api/'+api_key+'/blinks/'+linksFinal+'/blang/'+idiomaFinal+'/bcalidad/'+calidadFinal+'/type/'+type+'/';
   console.log(urll);

    // var parametros = {
    //     "postID": tmdb,
    //     "api": api_key,
    //     "blinks": linksFinal,
    //     "blang" : idiomaFinal,
    //     "bcalidad" : calidadFinal,
    //     "type" : type
    // };

    // fetch(urll)
    // .then(function(response) { return response.json() })
    // .then(function(data) {
    //     console.log(data)
    // })
    document.querySelector('#cargaEmpezada').style.display = "block";
    fetch(urll)
    .then(function(response) {
        // document.getElementById('resultadooVery').innerHTML = response.text();
        return response.json();
    })
    .then(data => {
        data_json = JSON.parse(data);
        document.getElementById('resultadooVery').innerHTML += `${data_json.status}<br/>`;
        document.getElementById('resultadooVery').innerHTML += `${data_json.id}<br/>`;
        document.getElementById('resultadooVery').innerHTML += `${data_json.url}<br/>`;
        document.querySelector('#cargaEmpezada').style.display = "none";

    })
    .catch(function(err) {
        console.error(err);
        document.getElementById('resultadooVery').innerHTML = err;
        document.querySelector('#cargaEmpezada').style.display = "none";

    });

    // $.ajax({
    //         data:  parametros, //datos que se envian a traves de ajax
    //         // data: {'parametros': JSON.stringify(parametros)},
    //         url:   urll, //archivo que recibe la peticion
    //         type:  'GET', //método de envio
    //         beforeSend: function () {
    //                 $("#resultadooVery").html("Procesando, espere por favor...");
    //         },
    //         success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
    //                 $("#resultadooVery").html(response);
    //         }
    // });
}

// Obtenemos el botón a partir de su id. En este caso lo llamaremos testButton
var button = document.getElementById('createPost');

// Registramos el evento
button.addEventListener('click', doSomething_Click);