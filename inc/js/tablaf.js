$(document).ready(function() {

	var table = $('#tablaDinamicaLoad').DataTable({
	// $('#tablaDinamicaLoad').DataTable({
	
		columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
		dom: 'Bfrtip',
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
		// select: true,
		buttons: [
            {
                text: 'Select all',
                action: function () {
                    table.rows().select();
					// table.rows( ':eq(0)' ).select();
                }
            },
            {
                text: 'Select none',
                action: function () {
                    table.rows().deselect();
					ventanaModal();
                }
            },
			{
                text: 'Pedir',
				className: 'color-btn-tabla',
                action: function () {
					var datosTabla = table.rows( { selected: true } ).data();
					if(datosTabla[0]) validarDatostabla(datosTabla);
					// axios('https://uptobox.com/api/link/info?fileCodes=qz4j5650qwld,ixqzm4mwr3wo').then(function (res) {
					// 	console.log(res);
					// 	console.log(res.data.data.list[0].file_size);
					// })
                }
            },
			{
                text: 'C Enlaces',
				className: 'color-btn-tabla',
                action: function () {
					var datosTabla = table.rows( { selected: true } ).data();
					if(datosTabla[0]) comprobarEnlacesSubidos(datosTabla);
					// axios('https://uptobox.com/api/link/info?fileCodes=qz4j5650qwld,ixqzm4mwr3wo').then(function (res) {
					// 	console.log(res);
					// 	console.log(res.data.data.list[0].file_size);
					// })
                }
            },
            {
                text: 'Resubir',
				className: 'color-btn-tabla',
                action: function () {
					var datosTabla = table.rows( { selected: true } ).data();
					if(datosTabla[0]) seleccionarServidores(datosTabla);
					// if(datosTabla[0]) ResubirEnlaces(datosTabla);
                }
            }
        ],
		"pageLength": 50,
        "order": [[ 1, "desc" ]]
    });


    expresion = /_blank\"\>(.*)\</i;
    expresion2 = /da\"\>(.*)\</i;

    function seleccionarServidores(datosTabla) {

        document.querySelector("#select_servidores").innerHTML = '<div class="col-2"><input class="form-check-input" type="checkbox" value="hqq.to" id="netu"><label class="form-check-label" for="netu">Netu</label></div>';
        document.querySelector("#select_servidores").innerHTML += '<div class="col-2"><input class="form-check-input" type="checkbox" value="mega" id="mega"><label class="form-check-label" for="mega">mega</label></div>';
        document.querySelector("#select_servidores").innerHTML += '<div class="col-2"><input class="form-check-input" type="checkbox" value="fembed" id="fembed"><label class="form-check-label" for="fembed">fembed</label></div>';
        document.querySelector("#select_servidores").innerHTML += '<div class="col-2"><input class="form-check-input" type="checkbox" value="uptobox" id="uptobox"><label class="form-check-label" for="uptobox">uptobox</label></div>';
        document.querySelector("#select_servidores").innerHTML += '<div class="col-2"><input class="form-check-input" type="checkbox" value="backup" id="backup"><label class="form-check-label" for="backup">backup</label></div>';
        document.querySelector("#select_servidores").innerHTML += '<div class="col-2"><input class="form-check-input" type="checkbox" value="720" id="s720"><label class="form-check-label" for="s720">720</label></div>';
        document.querySelector("#select_servidores").innerHTML += '<div class="col-2"><input class="form-check-input" type="checkbox" value="1080" id="s1080"><label class="form-check-label" for="s1080">1080</label></div>';
        document.querySelector("#select_servidores").innerHTML += '<div class="col-2"><input class="form-check-input" type="checkbox" value="720" id="s720p"><label class="form-check-label" for="s720p">720p</label></div>';
        document.querySelector("#select_servidores").innerHTML += '<div class="col-2"><input class="form-check-input" type="checkbox" value="de2" id="de2"><label class="form-check-label" for="de2">de2</label></div>';

        document.querySelector("#select_servidores").innerHTML += '<div class="py-4 col-12"><div class="form-group purple-border"><label for="exampleFormControlTextarea4">Enlaces Netu</label><textarea class="form-control" name="enlace" id="enlace" rows="6" placeholder="Pegar enlaces"></textarea></div></div>';


        document.querySelector("#botonUniversal").innerHTML += `<div class="col-2"><button type="button" class="btn btn-primary" id="ser_obtener">Obtener</button></div>`; 

        document.querySelector("#ser_obtener").addEventListener("click", function(){ResubirEnlaces(datosTabla)});

    }

    // resubir enlaces indivisuales
    function ResubirEnlaces(datosTabla) {

        alert(datosTabla.length);

        var servidorValue = '';
        // document.querySelectorAll("#select_servidores .col-2 input").forEach(vall => vall.checked == true ? servidorValue += vall.value == "1080" || vall.id == "s720" ? '-c '+vall.value+' ' : '-K '+vall.value+' ' : enlacesNetu = vall.value);
        document.querySelectorAll("#select_servidores .col-2 input").forEach(function (vall) {
            // vall.checked == true ? servidorValue += vall.value == "1080" || vall.id == "s720" ? '-c '+vall.value+' ' : '-K '+vall.value+' ' : enlacesNetu = vall.value

            if (vall.checked == true) {

                servidorValue += vall.value == "1080" || vall.id == "720" ? '-c '+vall.value+' ' : '-K '+vall.value+' ';
                if(vall.value == "de2"){
                    de2Datos = true;
                    var re = /-K de2 /gi;
                    servidorValue = servidorValue.replace('-K de2 ', '');
                }else{
                    de2Datos = false;
                }
            }
        });


        function removeItemFromArr ( arr, item ) {
            var i = arr.indexOf( item );
         
            if ( i !== -1 ) {
                arr.splice( i, 1 );
            }
        }
        function buscarParametroArray(array, parametro) {

            for (let i = 0; i < array.length; i++) {
                // const element = array[i];
                if (array[i].includes(parametro)) {
                    var indice = array.indexOf(array[i]);
                    indice += 1;
                    break
                }
            }
            return array[indice];
        }

        var enlacesNetu = document.querySelector("#select_servidores .col-12 textarea").value;

        // console.log(enlaesNetu);

        exp = /\n/g;
        var enlacesJson = {};
        var words = enlacesNetu.split(exp);
        // removeItemFromArr(words, '');
        var modulo = 0
        var modulo2 = 0
        words.forEach(remov => {
            if(! remov) removeItemFromArr(words, remov)
            
        });
        // words.forEach(element => {
        //     if (modulo % 2) {
        //         if(element.length != 0) enlacesJson[words[modulo2]] = element;   
        //         if(element.length != 0) console.log('EL ENLACE ES---->: '+element);
        //         modulo2 += 2;
        //     }else{
        //         if(element.length != 0) console.log(element) 
                
        //     }
        //     modulo += 1;


        // });

        // console.log(enlacesJson);


        // if (urlVikiUnEnlace) {
        //     words.forEach(element => {
        //     if(element) enlaces += ` -V '${element}'`;
        //     });
        // } else {
        //     words.forEach(element => {
        //     if(element) enlaces += ` -e '${element}'`;
        //     });
        // }




        
        

        var cadena = [];
        cadenaa = '';
        for (let index = 0; index < datosTabla.length; index++) {

            var element = datosTabla[index];
            var arrayId = [];

            var idOriginal = element[1].match(expresion)[1];
            var name = element[2].match(expresion)[1];
            var calidad = element[3].match(expresion)[1];
            var idioma = element[4].match(expresion)[1];
            var tmdb = element[5];
            var link_backup = element[6].match(expresion2)[1];

            if(calidad == "(1080)") var calidad_dos = "1080";
            if(calidad == "(720)") var calidad_dos = "720";
            const idOriginall = servidorValue.includes('-K 720') ? '-c 720 ' : `-I '${idOriginal}'`

            if(words[0] !== undefined) var link_backup = buscarParametroArray(words, name);
            var de2 = de2Datos === true ? `-B true; de2 -n "${name}" ${idOriginall} -t '${tmdb}' -i '${idioma}' ${servidorValue};` : ";";



            arrayId.push(idOriginal);
            // cadena.push(`de3 -n "${name}" -i '${idioma}' -c ${calidad_dos} -t '${tmdb}' -e '${link_backup}' -K 'gdfree' -I '${idOriginal}'; `);
            // cadena.push(`de3 -n "${name}" -i '${idioma}' -c '720' -t '${tmdb}' -e '${link_backup}' -K 720 -B true; de2 -n "${name}" -i '${idioma}' -c 720 -t '${tmdb}' -K 720; `);
            cadena.push(`de3 -n "${name}" ${idOriginall} -i '${idioma}' -t '${tmdb}' -e '${link_backup}' ${servidorValue}${de2} `);
            
        }
        ventanaModal(cadena, arrayId)
    }
    
    function comprobarEnlacesSubidos(datosTabla) {

        var arrayId = [];
		var resData = []; 
		// var urlFiltroCalidad = '<?php echo $base;?>';
		var mainObject = {},
    		promises = [],
			restData = [];
		var	cadena = [];
        cadenaa = '';
        
        for (let i = 0; i < datosTabla.length; i++) {
            var d = datosTabla[i];
            var id = d[1].match(expresion)[1];
			
			myUrld = urlFiltroCalidad+'cesubidos.php?iddb='+id;
			promises.push(axios.get(myUrld));
        }
        
        const getName2 = async (promises) =>{
			const ax = await axios.all(promises);
			ax.forEach(res => {
				restData.push(res.data);
			});
			return restData;
		}
		getName2(promises)
				.then((a) => {
					escribirDats(a, datosTabla)
				})
    }

	function validarDatostabla(datosTabla){
		
		
		var resData = []; 
		// var urlFiltroCalidad = '<?php echo $base;?>';
		var mainObject = {},
    		promises = [],
			restData = [];
		cadenaa = '';


		for (let i = 0; i < datosTabla.length; i++) {

			var dt = datosTabla[i];
			var idioma = dt[4].match(expresion)[1];
			myUrl = urlFiltroCalidad+'filtrarcalidad.php?id='+dt[5]+'&idioma='+idioma;
			promises.push(axios.get(myUrl));
		}


		const getName = async (promises) =>{
			const ax = await axios.all(promises);
			ax.forEach(res => {
				restData.push(res.data);
			});
			return restData;
		}
		getName(promises)
				.then((a) => {
					escribirDats(a, datosTabla)
				})

    }
    
    function escribirDats(resData, datosTabla) {
        console.log('ejecunatdo a tiempo '+resData);
        console.log('ejecunatdo a tiempo '+datosTabla);
        var	cadena = [];
        var arrayId = [];
        // const keyEnlaces = ['hqq.to','drive.google.com','export=download','mega.nz','short.pe','ouo.io'];
        const objEnlaces = {
            'hqq.to': 'hqq.to',
            // 'drive.google.com/file/d': 'gdvip',
            'drive.google.com/open': 'gdvip',
            'drive.google.com/uc': 'gdfree',
            'mega.nz': 'mega'
        }
        
        for (let index = 0; index < datosTabla.length; index++) {

            var element = datosTabla[index];

            if (Array.isArray(resData[index])) {

                console.log(resData);
                console.log('resData: '+resData);
                console.log('resData: '+resData.length);
                console.log('::::::::::::');
                var numVueltas = resData.length;
                console.log(numVueltas);
                dataCalidad = '';

            // for (let xxx = 0; xxx < resData.length; xxx++) {

                // if(Object.keys(resData[xxx]).length !== 0){
                if(resData[index]){
                    var request = resData[index];

                    console.log(request[index]);
                    console.log('resData: '+resData);
                    console.log('request: '+request);
                    console.log(request.length);
                    console.log('==/==/==/');
                    
                    for (let i = 0; i < request.length; i++) {
                        const key = request[i];
                        for (const obj in objEnlaces) {
                            if (objEnlaces.hasOwnProperty(obj)) {
                                console.log('x: '+key);
                                // dataCalidad += (obj == x) ? objEnlaces[obj]
                                // console.log(objEnlaces[obj]);
                                if(obj == key) dataCalidad += `-K ${objEnlaces[obj]} `;
                                // console.log(x+ ' se agrego: '+dataCalidad);
                            }
                        }
                    }
                }
                // } 


                    console.log('esto es un array: '+ dataCalidad);

                    var idOriginal = element[1].match(expresion)[1];
                    var name = element[2].match(expresion)[1];
                    var calidad = element[3].match(expresion)[1] == "(720)" ? 720 : 1080;
                    var idioma = element[4].match(expresion)[1];
                    var tmdb = element[5];
                    var link_backup = element[6].match(expresion2)[1];

                    
                    

                    arrayId.push(idOriginal);
                    if(dataCalidad) cadena.push(`de2 -n '${name}' -i '${idioma}' -c ${calidad} -t '${tmdb}' -e '${link_backup}' ${dataCalidad} -I ${idOriginal}; `);
                    // dataCalidad = '';
                

            }else{

                var idOriginal = element[1].match(expresion)[1];
                var name = element[2].match(expresion)[1];
                var calidad = element[3].match(expresion)[1];
                var idioma = element[4].match(expresion)[1];
                var tmdb = element[5];
                var link_backup = element[6].match(expresion2)[1];

                // encriptar nommbre para hacer peticion a netu
                // var nameSinEspacio = `${name} ${calidad} ${idioma}.mp4`;
                // var nameEncriptado = encodeURI(nameSinEspacio);
                // var urinetu = `https://s6.netu.tv/download/K7xS9qoUJsbANsmx8A2J-g/1597792876/flv/api/files/videos/2019/05/28/1559063261qeh54.mp4?title=${nameEncriptado}`;

                arrayId.push(idOriginal);
                console.log(resData);
                // if(resData[index]) cadena.push(`de2 -n "${name}" -i '${idioma}' -c 720 -t '${tmdb}' -e '${link_backup}' -C 720 -K 720; `);
                if(resData[index]) cadena.push(`de2 -n "${name}" -i '${idioma}' -c 720 -t '${tmdb}' -e '${link_backup}' -K 720; `);
                // if(resData[index]) cadena.push(`de2 -n "${name}" -i '${idioma}' -c 720 -t '${tmdb}' -e '${urinetu}' -K 720; `);
            }
        }
        ventanaModal(cadena, arrayId)
    }

    

	function ventanaModal(cadena, arrayId){

        function btn(params, params2) {
			
            if (params == "Borrar Todo") {
                var botn = `<button type="button" class="btn btn-primary" onclick="preguntarSiNo(${params2});">${params}</button>`;
                return botn;
                
            }else{
                var botn = `<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">${params}</button>`;
                // var botn = `<button type="button" class="btn btn-primary" id="colorp">${params}</button>`;
                return botn;
            }
        }

		if (cadena) {

			cadena.forEach(comand => {
				cadenaa += comand;
			});

			document.getElementById('boton_modal').innerHTML = btn('Ver Enlaces');
			document.getElementById('boton_modal_1').innerHTML = btn('Borrar Todo', arrayId);
			document.getElementById('cadenaDatos').innerHTML = cadenaa;

		}else{
			document.getElementById('boton_modal').innerHTML = '';
			document.getElementById('boton_modal_1').innerHTML = '';
		}


	}
} );