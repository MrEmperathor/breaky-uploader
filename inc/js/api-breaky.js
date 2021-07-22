function doSomething_Click(post_type, post_id) {

    // var array_links = document.getElementsByName('bk_trtype[]');
    // var array_calidad = document.getElementsByName('bk_calidad[]');
    // alert(array_links);
    // alert(array_calidad);

    function bhd(cal) {
        var num_link = document.getElementById('num_link').value;
        var trTypee = document.getElementsByName('bk_trtype[]');

        for (let i = 0; i < num_link; i++) {
            calidad.push(cal)
            trType.push(trTypee[i].defaultValue)
            links.push(document.getElementById(i+'lin').value);
        }
    }

    var dominio = 'https://maxpeliculas.net';
    var calid = document.getElementById('calidad').value;
    calidad = [];
    trType = [];
    links = [];
    var idioma = [];
    var api_key = '4cd9cd25-fc28-4089-9977-70377dc6cd4f';
    var type = post_type;


    if (calid == "(HD)"){
        bhd(33);
    }else if (calid == "(CAM)"){
        bhd(34);
    }else if (calid == "(DVD)"){
        bhd(32070);
    }else{
        var calidad = [32,32,33,33,33,33,33];
        var trType = [2,2,2,1,1,2,2];
        var mi_uptobox = document.getElementById('miutp').value;
        var mi_uptobox_720 = document.getElementById('miutp720').value;
        var fembedEmbed = document.getElementById('fembedEmbed').value;
        var fembed = document.getElementById('fembedb').value;
        var mega720 = document.getElementById('mega720').value;
        // var mystream = document.getElementById('mystream').value;
        var hqq = document.getElementById('hqq').value;
        var mega1080 = document.getElementById('mega1080').value;

        if (mega1080 && mega1080 != "No hay enlaces") links.push(mega1080); 
        if (mi_uptobox && mi_uptobox != "") links.push(mi_uptobox);
        if (mi_uptobox_720 && mi_uptobox_720 != "") links.push(mi_uptobox_720);
        if (hqq && hqq != "No hay enlaces") links.push(hqq);
        if (fembedEmbed && fembedEmbed != "No hay enlaces") links.push(fembedEmbed);
        if (fembed && fembed != "No hay enlaces") links.push(fembed);
        if (mega720 && mega720 != "No hay enlaces") links.push(mega720);
    }
    
    //idioma
    var idio = document.getElementById('idioma').value;    
    var poster = document.getElementById('poster').value;





    //tmdb
    if (post_id) {
        var tmdb = post_id;
    }else{
        var tmdb = document.getElementById('tmdbb').value;
    }
    /*
    create: crear post nuevos
    update_links: actualizar post
    */


    
    // var trType = [2,2,2,1,1,2,2];
    
    // var urll = 'http://pelis24hd.test/wp-json/bk-dcms-seo-yoast-generate-post/v2';
    // postID/88/api/'.$api_key.'/blinks/'.$enlacess.'/blang/'.$idiomas.'/bcalidad/'.$calidades.'/type/'.$type';

    

    // if (mystream && mystream != "No hay enlaces") links.push(mystream);
    // if (fembedRedirect && fembedRedirect != "No hay enlaces") links.push(fembedRedirect);
    // if (short && short != "No hay enlaces") links.push(short);
    // if (ouo && ouo != "No hay enlaces") links.push(ouo);

    
    
    if (idio == "LAT" || idio == "LATINO") {

        var bkIdioma = "Latino";
        var addlinkIdioma = 29;

    } else if (idio == "CASTELLANO" || idio == "ESP") {

        var bkIdioma = "Castellano";
        var addlinkIdioma = 1559;


    } else if (idio == "SUB" || idio == "SUBTITULADO") {

        var bkIdioma = "Subtitulado";
        var addlinkIdioma = 31;

    }

    if (calid == "(1080)") {
        var bkCalidad = "708";
    }else if (calid == "(720)") {
        var bkCalidad = "795";
    }

    for (let i = 0; i < links.length; i++) {
        // const element = array[i];
        idioma.push(bkIdioma);
        // calidad.push(bkCalidad);
    }

    var linksFinal = btoa(JSON.stringify(links)); 
    var idiomaFinal = btoa(JSON.stringify(idioma)); 
    var calidadFinal = btoa(JSON.stringify(calidad));
    var trType = btoa(JSON.stringify(trType));
    var poster = btoa(JSON.stringify(poster));


    console.log(linksFinal);
    console.log(idiomaFinal);
    console.log(calidadFinal);

    /*
    codificar a base64 btoa()
    decoificr base64 atob()
    var varDecode = btoa(varEncode);
    // postID/88/api/{api_key}/blinks/'.$enlacess.'/blang/'.$idiomas.'/bcalidad/'.$calidades.'/type/'.$type';

    https://thingproxy.freeboard.io/fetch/http://my.api.com/get/stuff
    */

    // proxy= 'https://thingproxy.freeboard.io/fetch/'
//    const urll = `http://pelis24hd.test/wp-json/bk-dcms-seo-yoast-generate-post/v2/postID/${tmdb}/api/${api_key}/blinks/${linksFinal}/blang/${bcalidad}/bcalidad/${calidades}/type/${type}/`;

    const urll = dominio+'/wp-json/bk-dcms-seo-yoast-generate-post/v2/postID/'+tmdb+'/api/'+api_key+'/blinks/'+linksFinal+'/blang/'+idiomaFinal+'/bcalidad/'+calidadFinal+'/type/'+type+'/tr/'+trType+'/poster/'+poster+'/addlink/'+addlinkIdioma;

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
        console.log(data);
        data_json = JSON.parse(data);
        d = data_json.data ? data_json.data : data_json.url
        document.getElementById('resultadooVery').innerHTML += `${data_json.status}<br/>`;
        document.getElementById('resultadooVery').innerHTML += `${data_json.id}<br/>`;
        document.getElementById('resultadooVery').innerHTML += `${data_json.data}<br/>`;
        document.querySelector('#cargaEmpezada').style.display = "none";

        if (post_type == 'create') {
            alert('Post creado Exitosamente '+ d);
        }else{
            alert('Post Actualizado Exitosamente '+ d);
        }

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
var button_update = document.getElementById('updatePost');

// Registramos el evento
button.addEventListener('click', createPostWpApi);
button_update.addEventListener('click', updatePostWpApi);

function createPostWpApi() {
    var post_type = "create";
    doSomething_Click(post_type);
}

function updatePostWpApi(post_id, idioma) {
    var post_type = "update_links";
    // var post_id = document.getElementById('post_id_wp').value; 
    // alert(post_id);
    var confirmar = confirm('Actualizar enlaces?');
    if (confirmar == true) {
        doSomething_Click(post_type, post_id);
    }
}