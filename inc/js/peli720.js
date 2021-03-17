function iniciar720(p1) {
    var parametros = {
        "ruta" : p1,
        "nombre" : p2,
        "tmdb" : p3,
        "idioma" : p4,
        "idDrive" : p5
    };
    document.getElementById('peli720').innerHTML = `El valor capturado es ${parametros.ruta}`

    // $.ajax({
    //     data:  parametros, //datos que se envian a traves de ajax
    //     // data: {'parametros': JSON.stringify(parametros)},
    //     url:   'comp/720drive.php.php', //archivo que recibe la peticion
    //     type:  'post', //método de envio
    //     beforeSend: function () {
    //             $("#peli720").html("Procesando, espere por favor...");
    //     },
    //     success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
    //             $("#peli720").html(response);
    //     }
    // });
}

