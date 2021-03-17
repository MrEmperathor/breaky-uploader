
<div class="container borColor">
    <div class="row">
        <div class="col-6 mt-3 mr-5 ml-5">
        <!-- <form action="servidor.php" method="POST"> -->
            <h2>Obtener sess_id para Uptobox<h2><br>
            <form>
            <div class="form-group">
                <label for="emaill">Email address</label>
                <input type="email" name="emaill" class="form-control" id="nombre" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted" style="font-size: 0.5em;">El sess_id se pierde cada vez que se inicia una nueva sesion.</small>
            </div>
            <div class="form-group">
                <label for="passwordd">Password</label>
                <input type="password" name="passwordd" class="form-control" id="apellido">
            </div>
            <input type="button" class="btn btn-primary" id=BotomEmbed href="javascript:;" onclick="realizaProceso($('#nombre').val(), $('#apellido').val());return false;" value="Enviar"/>
            </form><br>
        </div>
        <div class="col-6 mt-3 mr-5 ml-5">
        <span id="resultadoo"></span>
        </div>
    </div>
</div>
<script src="assets/js/ajax.js"></script>




<!-- <script>
function realizaProceso(valorCaja1, valorCaja2){

        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                // data: {'parametros': JSON.stringify(parametros)},
                url:   'servidor.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultadoo").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultadoo").html(response);
                }
        });
}
</script> -->













<!-- <div id="formulario">
            <form method="post" id="formdata">
                <label for="nombre">Nombre: </label><input type="text" name="nombre" id="nombre" required="required"></br>
                <label for="apellidos">Apellidos: </label><input type="text" name="apellidos" id="apellidos" required="required"></br>
                <label for="direccion">Dirección: </label><input type="text" name="direccion" id="direccion" required="required"></br>
                Género: <input type="radio" name="genero" id="hombre" checked="checked"><label for="hombre"> Hombre - </label><input type="radio" name="genero" id="mujer"><label for="mujer"> Mujer</label>
                <label for="mayor">Es mayor de 18 años: </label><input type="checkbox" name="mayor" id="mayor" required="required">
                <input type="button" id="botonenviar" value="Enviar">
            </form>
        </div>
        <div id="exito" style="display:none">
            Sus datos han sido recibidos con éxito.
        </div>
        <div id="fracaso" style="display:none">
            Se ha producido un error durante el envío de datos.
        </div>






<script type="text/javascript">
    function validaForm(){
    // Campos de texto
    if($("#nombre").val() == ""){
        alert("El campo Nombre no puede estar vacío.");
        $("#nombre").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    if($("#apellidos").val() == ""){
        alert("El campo Apellidos no puede estar vacío.");
        $("#apellidos").focus();
        return false;
    }
    if($("#direccion").val() == ""){
        alert("El campo Dirección no puede estar vacío.");
        $("#direccion").focus();
        return false;
    }

    // Checkbox
    if(!$("#mayor").is(":checked")){
        alert("Debe confirmar que es mayor de 18 años.");
        return false;
    }

    return true; // Si todo está correcto
}

$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#botonenviar").click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validaForm()){                               // Primero validará el formulario.
            $.post("inc/comp/uptobox_id.php",$("#formdata").serialize(),function(res){
                $("#formulario").fadeOut("slow");   // Hacemos desaparecer el div "formulario" con un efecto fadeOut lento.
                if(res == 1){
                    $("#exito").delay(500).fadeIn("slow");      // Si hemos tenido éxito, hacemos aparecer el div "exito" con un efecto fadeIn lento tras un delay de 0,5 segundos.
                } else {
                    $("#fracaso").delay(500).fadeIn("slow");    // Si no, lo mismo, pero haremos aparecer el div "fracaso"
                }
            });
        }
    });    
});
</script> -->