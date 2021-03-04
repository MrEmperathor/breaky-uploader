// (function () {
//     if (window.addEventListener) {
//         window.addEventListener('DOMContentLoaded', uncheckTwo, false);
//     } else {
//         window.attachEvent('onload', uncheckTwo);
//     }
// } ());

function uncheckTwo(){

    var checkbox11 = document.getElementById("q1080");
    var checkbox22 = document.getElementById("q720");
    var checkbox33 = document.getElementById("q480");
    var checkbox44 = document.getElementById("q360");

    if (checkbox11) {
        checkbox11.onclick = function(){
        if(checkbox11.checked != false){
            if (checkbox22) checkbox22.checked=null;
            if (checkbox33) checkbox33.checked=null;
            if (checkbox44) checkbox44.checked=null;
        }}
    }
    if (checkbox22) {
        checkbox22.onclick = function(){
        if(checkbox22.checked != false){
            if (checkbox11) checkbox11.checked=null;
            if (checkbox33) checkbox33.checked=null;
            if (checkbox44) checkbox44.checked=null;
        }}
    }
    if (checkbox33) {
        checkbox33.onclick = function(){
        if(checkbox33.checked != false){
            if (checkbox11) checkbox11.checked=null;
            if (checkbox22) checkbox22.checked=null;
            if (checkbox44) checkbox44.checked=null;
        }}
    }
    if (checkbox44) {
        checkbox44.onclick = function(){
        if(checkbox44.checked != false){
            if (checkbox11) checkbox11.checked=null;
            if (checkbox22) checkbox22.checked=null;
            if (checkbox33) checkbox33.checked=null;
        }}
    }   
}

function uncheck(){
    var checkbox1 = document.getElementById("c1080");
    var checkbox2 = document.getElementById("c720");
    checkbox1.onclick = function(){
    if(checkbox1.checked != false){
        checkbox2.checked =null;
    }}

    checkbox2.onclick = function(){
        if(checkbox2.checked != false){
            checkbox1.checked=null;
        }
    }
}
function uncheckNew(){
    var _checkbox1 = document.getElementById("bajar_1080");
    var _checkbox2 = document.getElementById("bajar_720");
    _checkbox1.onclick = function(){
    if(_checkbox1.checked != false){
        _checkbox2.checked =null;
    }}

    _checkbox2.onclick = function(){
        if(_checkbox2.checked != false){
            _checkbox1.checked=null;
        }
    }
}

function uncheckTree(){ 

    function quitar_check_todos() {
        for (var clave in window.arrayK){
            if (window.arrayK.hasOwnProperty(clave)) {
                if (clave == 'hqq.tv' || clave == 'jetload' || clave == 'uptobox' || clave == 'gounlimited' || clave == 'gdfree' ||clave == 'gdvip' || clave == 'mega') {
                    document.getElementById(clave).checked = null;
                }
            }
        }
    }

    var checkbox111 = document.getElementById("720");
    var checkbox222 = document.getElementById("720p");
    var checkbox333 = document.getElementById("1080");

    for (var clave in window.arrayK){
    // Controlando que json realmente tenga esa propiedad
        if (window.arrayK.hasOwnProperty(clave)) {
            if (document.getElementById(clave).checked) {
                if (clave == 'hqq.tv' || clave == 'jetload' || clave == 'uptobox' || clave == 'gounlimited' || clave == 'gdfree' ||clave == 'gdvip' || clave == 'mega') {
                    var exist_check = true;
                }
            }
        }
    }

    if (exist_check && checkbox111.checked || checkbox222.checked || checkbox333.checked) {
        checkbox111.checked=null;
        checkbox222.checked=null;
        checkbox333.checked=null;
    }else {
        checkbox111.onclick = function(){
        if(checkbox111.checked != false){
            checkbox222.checked =null;
            checkbox333.checked =null;
            quitar_check_todos()
        }}
        checkbox222.onclick = function(){
            if(checkbox222.checked != false){
                checkbox111.checked=null;
                checkbox333.checked=null;
                quitar_check_todos()
            }
        }
        checkbox333.onclick = function(){
            if(checkbox333.checked != false){
                checkbox111.checked=null;
                checkbox222.checked=null;
                quitar_check_todos()
            }
        }
    }
}

// function name(p1,p2) {
//     console.log(arguments.length)
//     for (let i = 0; i < arguments.length; i++) {
//         const element = arguments[i];
//         console.log('argumento #'+i)
//     }
// }