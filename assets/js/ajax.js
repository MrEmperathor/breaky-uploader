// $(document).ready(function () {
    
//     $("input[type=submi]").click(function(event){
//         event.preventDefault();
//         var nombre = $("#nombre").val();
//         var apellido = $("#apellido").val();

//         $.post("servidor.php", {
//             nombre: nombre,
//             apellido: apellido
//         }, function (respuesta) {
//             $("#info").text(respuesta);
//         });
//     });
// });

function realizaProceso(valorCaja1, valorCaja2){

        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                // data: {'parametros': JSON.stringify(parametros)},
                url:   'vista/config/uptobox_id.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultadoo").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultadoo").html(response);
                }
        });
}