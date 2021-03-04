var inp = '<i></i><input type="text" id="materialFormNameModalEx1" class="text-white form-control form-control-sm"><label for="materialFormNameModalEx1">Your link l</label>';

document.getElementById("resultadoC").innerHTML = inp;
document.querySelector('#mibtn').addEventListener('click', acortar);
function isValidUrl(url,obligatory,ftp)
{
    // Si no se especifica el paramatro "obligatory", interpretamos
    // que no es obligatorio
    if(obligatory==undefined)
        obligatory=0;
    // Si no se especifica el parametro "ftp", interpretamos que la
    // direccion no puede ser una direccion a un servidor ftp
    if(ftp==undefined)
        ftp=0;
 
    if(url=="" && obligatory==0)
        return true;
 
    if(ftp)
        var pattern = /^(http|https|ftp)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
    else
        var pattern = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
 
    if(String(url).match(pattern))
        return true;
    else
        return false;
}

function ShowSelected()
{
/* Para obtener el valor */
    var cod = document.getElementById("servioresA").value;
    // alert(cod);

    
    /* Para obtener el texto */
    var combo = document.getElementById("servioresA");
    var selected = combo.options[combo.selectedIndex].text;
    // alert(selected);
}

function _datosAcortador(params,enlace) {
    api1 = "25l4m9Mn"
    api2 = "f6236d9aa7aeb0a3cb29cb1d85eb08a2d17a0928"
    if (isValidUrl(enlace)) {
        enlace = encodeURI(enlace);
        console.log("el enlace es " + enlace)

        switch (params) {
            case "1ouo":
                var api_key = api1
                capi = encodeURI(api_key);
                url = `http://ouo.io/api/${capi}?s=${enlace}`;
                break;
            case "2short":
                var api_key = api2
                // enlace = encodeURI(enlace);
                url = `https://short.pe/api?api=${api_key}&url=${enlace}`;
                break;
            default:
                break;
        }
        return url;
    }else{
        return false;
    }
}

function acortar(){

    function traerDatos(a,acortador){
        const xhttp = new XMLHttpRequest();
        xhttp.open('GET', a, true);
        xhttp.send();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                if (acortador == "1ouo") {
                    document.getElementById("resultadoC").innerHTML = `<input type="text" id="materialFormNameModalEx1" value="${this.responseText}" class="form-control form-control-sm text-white text-center">`;
                    console.log(this.responseText)
                }else if(acortador == "2short"){
                    var jsp = JSON.parse(this.responseText)
                    document.getElementById("resultadoC").innerHTML = `<input type="text" id="materialFormNameModalEx1" value="${jsp.shortenedUrl}" class="form-control form-control-sm text-white text-center">`;
                    console.log(jsp.shortenedUrl)
                }
                
                

                // document.getElementById("resBotom").innerHTML = `<button type="button" id=bt1 class="btn purp-t text-white redon-t mt-n3" data-clipboard-target=#materialFormNameModalEx1 >Copiar</button><button type="button" class="btn purp-t text-white redon-t mt-n3" id="mibtn">Acortar</button>`;
                
            }
        }
    }
    var x = document.getElementById("materialFormNameModalEx1").value;
    var acortador = document.getElementById("servioresA").value;

    if (_datosAcortador(acortador,x)) {
        const proxyurl = "https://cors-anywhere.herokuapp.com/";
        var a = proxyurl + url;
        console.log("estamos listos: " + a)
        traerDatos(a,acortador);
    }else{
        return false;
    }
    
    // a = parseInt(a);
    // var b = a => a + a;
    // var capi = encodeURI("25l4m9Mn");
    // var a = `http://ouo.io/api/${capi}?s=${enlace}`;
    // var url = `http://ouo.io/api/${capi}?s=${enlace}`;
    


    
    



    // const proxyurl = "https://cors-anywhere.herokuapp.com/";
    // // const url = "https://example.com"; // site that doesn’t send Access-Control-*
    // fetch(proxyurl + url) // https://cors-anywhere.herokuapp.com/https://example.com
    // .then(response => response.text())
    // .then(contents => console.log(contents))
    // .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))


    // ------GENERAR COMANDOS----

    
}
