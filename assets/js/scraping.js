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


function validarEnlacesUpx(id_clase_enlace) {

    let enlace = document.getElementById(id_clase_enlace).value;

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
        pintarEnlacesComprobados(res.data.data.list, id_clase_enlace);
    })
    
}

function pintarEnlacesComprobados(enlaArray, id_clase_enlace) {
    var pintar = `pintar${id_clase_enlace}`
    document.getElementById(pintar).innerHTML = '';

    var a = enlaArray.map((obj) => {


        var aprobado = obj.file_name ? `<div class="alert alert-success" role="alert" style="text-transform: none;">${obj.file_name} - https://uptobox.com/${obj.file_code}</div>`: `<div class="alert alert-danger" role="alert" style="text-transform: none;"> Error! https://uptobox.com/${obj.file_code}</div>`;

        document.getElementById(pintar).innerHTML += aprobado;

        console.log(obj.file_name);
        console.log(obj.file_code);


    })
}

function get_tmdb(title) {
    const titleEncode   = encodeURIComponent(title);
    axios({
        method: 'GET',
        url: `https://api.themoviedb.org/3/search/tv?api_key=be58b29465062a3b093bc17dacef8bf3&query=${titleEncode}`,
    }).then(function (data) {
        print_html(data.result[0].id, data.result[0].poster_path, data.result[0].name);
    })  
}

function print_html(tmdb,img,title) {
    
    console.log(d);
    // data_rest_tmdb      = d;
    // tmdb_img            = data_rest_tmdb.result[0].poster_path;
    // tmdb_id             = data_rest_tmdb.result[0].id;
    // tmdb_title          = data_rest_tmdb.result[0].name;

    document.getElementById("resul-img2").innerHTML = `<img src="${img}" class="img-fluid" alt="">`;
    document.getElementById("tmdb_id").innerHTML = `<h3>${tmdb}</h3>`; 
    document.getElementById("tmdb_title").innerHTML = `<h4>${title}</h4>`; 
}

function ejecutar() {
    Cargando('preloader');
    var url = document.getElementById('inlineFormInput').value;
    var x = location.hostname;
    const a = "http://"+x+"/panel/inc/modelo/app.php?ur=" + url;





    fetch(a)
        .then(function(response) {
            return response.text();
        })
        .then(data => {
            if (data){
                Cargando('preloader');
                var obj = JSON.parse(data);
                get_tmdb(`${obj["message"]["info"]["titulo"]}`);
                // console.log(data_rest_tmdb);
                // var tmdb_img            = data_rest_tmdb["results"][0]["poster_path"];
                // var tmdb_id             = data_rest_tmdb["results"][0]["id"];
                // var tmdb_title          = data_rest_tmdb["results"][0]["name"];

                console.log(obj["message"]);
                document.getElementById("resul-img").innerHTML = `<img src="${obj["message"]["info"]["img"]}" class="img-fluid" alt="">`;
                document.getElementById("resul-title").innerHTML = `<h2 class="portfolio-title">${obj["message"]["info"]["titulo"]}</h2>`; 
                // document.getElementById("resul-img2").innerHTML = `<img src="${tmdb_img}" class="img-fluid" alt="">`;
                // document.getElementById("tmdb_id").innerHTML = `<h3>${tmdb_id}</h3>`; 
                // document.getElementById("tmdb_title").innerHTML = `<h4>${tmdb_title}</h4>`; 
                document.getElementById("info_s").innerHTML = `<h3>Información</h3><li><strong>Titulo</strong>: ${obj["message"]["info"]["titulo"]}</li>`; 
                document.getElementById("result-descripcion").innerHTML = `<p>${obj["message"]["info"]["descripcion"]}</p>`;

                

                titulo = `${obj["message"]["info"]["titulo"]}`;
                enlacesT = []
                etl = [];
                document.getElementById("myTab").innerHTML = '';
                num_temp = 1
                for (const property in obj["message"]["enlaces"]) {
                    
                    document.getElementById("myTab").innerHTML += `<li class="nav-item waves-effect waves-light"><a class="nav-link" id="${property}-tab" data-toggle="tab" href="#${property}" role="tab" aria-controls="${property}" aria-selected="false">${property}</a></li>`;
                    todo_enla_temp = [];
                    
                    if (etl[num_temp]) {
                        console.log("ya se creeo etl[num_temp]")
                    }else{
                        etl[num_temp] = [];
                    }
                    obj["message"]["enlaces"][property].forEach(element => {
                        num_enlaces = 1
                        // console.log(element);
                        

                        element.forEach(en => {

                            if (etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]] && etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]]["link"]) {
                                console.log("ya se creeo etl[num_temp][en[servidor]]")
                                console.log(etl);
                            }else{
                                etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]] = [];
                                etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]]["link"] = [];
                            }

                            if (etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]]["calidad"] == en["calidad"] && etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]]["idioma"] == en["idioma"]) {
                                // console,log("add link"+ en["link"])
                                etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]]["link"].push(en["link"]);
                            }else{
                                etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]]["link"].push(en["link"]);
                                etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]]["calidad"] = en["calidad"];
                                etl[num_temp][en["servidor"]+"-"+en["calidad"]+"-"+en["idioma"]]["idioma"] = en["idioma"];
                            }

                            // if (en["servidor"] == "Uptobox" && en["calidad"] == "HD" && en["idioma"] == "Subtitulado") {
                                todo_enla_temp.push({ 
                                    "calidad"    : en["calidad"],
                                    "idioma"  : en["idioma"],
                                    "link"    : en["link"],
                                    "servidor"    : en["servidor"]
                                });
                            // }

                            // for (const jenla in en) {
                            //     console.log(`${jenla} : ${en[jenla]}`);
                                    
                            //     }
                        });
                        num_enlaces += 1
                    });
                    console.log(todo_enla_temp);
                    enlacesT[num_temp] = todo_enla_temp;
                    console.log(enlacesT);
                    num_temp += 1
                }
                console.log(enlacesT);
                console.log(etl);

                document.getElementById("myTabContent").innerHTML = '';


            //     var testarear '
            //     <div class="form-group">
            //     <label for="exampleFormControlTextarea1">Large textarea</label>
            //     <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10"></textarea>
            //   </div>';

                var ntemp = 1
                var html = "";
                var textaere_id = 1;
                for (const enla in obj["message"]["enlaces"]) {
                    
                    // document.getElementById("myTabContent").innerHTML += `<div class="tab-pane fade" id="${enla}" role="tabpanel" aria-labelledby="${enla}">`;
                    html += `<div class="tab-pane fade" id="${enla}" role="tabpanel" aria-labelledby="${enla}-tab">`;
                    html += `<div class="row">`;
                    
                        console.log(enla);
                        console.log(etl[ntemp])
                        
                        for (const key in etl[ntemp]) {
                            // document.getElementById("myTabContent").innerHTML += `<div class="form-group">`;
                            // html += `<div class="row">`;
                            var class_textarea = `${key}${textaere_id}`;
                            var link_comandos = "";
                            var link_comandos2 = "";
                            var link1 = "";
                            var cant_enlaces = 0
                            if (key["link"]) {
                                etl[ntemp][key]["link"].forEach(link => {
                                    // document.getElementById("myTabContent").innerHTML += `${link}`; 
                                    link_replace = link.replace('#Synchronization+S', '');
                                    link1 += `${link_replace}\n`;
                                    link_comandos += `-e '${link_replace}' `;
                                    link_comandos2 += `-W '${link_replace}' `;
                                    cant_enlaces += 1;
                                });
                            }
                            let termino_array = ["Subtitulado", "Latino", "Español"];
                            termino_array.forEach(t => {
                            let posicion = key.toLowerCase().indexOf(t.toLowerCase());
                            // console.log("LA POCICION ES:::"+posicion)
                            // console.log("LA KEY ES:::"+key.toLowerCase())
                            // console.log("LA t ES:::"+t.toLowerCase())
                                if (posicion !== -1) {
                                    if (t == "Subtitulado") {
                                        coman_idio = "SUB"
                                    }else if(t == "Latino"){
                                        coman_idio = "LATINO"
                                    }else if(t == "Español"){
                                        coman_idio = "CASTELLANO"

                                    }
                                }
                            });
                            html += `<div class="col-6">`;
                            html += `<div class="form-group py-3">`;
                            // document.getElementById("myTabContent").innerHTML += `<label for="exampleFormControlTextarea1">`;
                            html += `<label for="${class_textarea} #${cant_enlaces}">`;
                            // document.getElementById("myTabContent").innerHTML += `${key}`;
                            html += `${key} #${cant_enlaces}`;
                            // document.getElementById("myTabContent").innerHTML += `</label>`;
                            html += `</label>`;
                            // document.getElementById("myTabContent").innerHTML += `<textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10">`;
                            html += `<textarea class="form-control rounded-0" id="${class_textarea}" rows="10" style="width: 450px;">`;
                            
                            html += link1;
                            // document.getElementById("myTabContent").innerHTML += `</textarea>`;margin-right: -98%;
                            html += `</textarea>`;
                            html += `</div>`;
                            html += `<div class="col-6">`;
                            html += `<button type="button" class="btn btn-primary" id="comprobar_enlace" onclick="validarEnlacesUpx('${class_textarea}');">COMPROBAR ENLACES</button>`;
                            html += `<div class="colll-6" id="pintar${class_textarea}" style="font-size: 13px;margin-right: -98%;"></div>`
                            html += `</div>`;
                            html += `</div>`;
                            html += `<textarea class="form-control rounded-0" id="${class_textarea}" rows="10" style="width: 450px;">`;
                            
                            html += `se3 -n '${titulo}' -i "${coman_idio}" -c 1080 -K 1080 -t "undefine" ${link_comandos} -R 1 -T ${ntemp} ${link_comandos2}; se4 -n '${titulo}' -i "${coman_idio}" -c 1080 -K 1080 -t "undefine" -R 1 -T ${ntemp}; `;
                            // document.getElementById("myTabContent").innerHTML += `</textarea>`;margin-right: -98%;
                            html += `</textarea>`;
                            // html += `</div>`;

                            textaere_id += 1;
                        }
                        html += `</div>`;
                        // console.log(`${enla}: ${obj["message"]["enlaces"][enla]}`); ${etl[ntemp]}</div>`;
                        

                        // document.getElementById("myTabContent").innerHTML += `${etl[ntemp]}`;
                        html += `${etl[ntemp]}`;
                    // document.getElementById("myTabContent").innerHTML += `</div>`;
                    html += `</div>`;

                    ntemp += 1
                }
                document.getElementById("myTabContent").innerHTML = html;
                // for (let i = 0; i < obj["message"]["enlaces"].length; i++) {
                //     const element = obj[i];
                //     console.log(obj["message"]["enlaces"][i])
                //     // document.getElementById("myTab").innerHTML += `<li class="nav-item waves-effect waves-light"><a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">${obj["message"]["enlaces"][i]}</a></li>`;
                // }
                
            }else{
                alert("AUN NO ESTA LISTA :(");
                Cargando('preloader');
            }
        })
        .catch(function(err) {
            console.error(err);
            document.getElementById('resultadooVery').innerHTML = err;
            document.querySelector('#cargaEmpezada').style.display = "none";
        });

        
        

}

// const button = document.getElementById('comprobar_enlace');
// button.addEventListener('click', () => {
//     validarEnlacesUpx();
// });