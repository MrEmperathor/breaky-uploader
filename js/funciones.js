

function agregardatos(nombre,apellido,email,telefono){

	cadena="nombre=" + nombre + 
			"&apellido=" + apellido +
			"&email=" + email +
			"&telefono=" + telefono;

	$.ajax({
		type:"POST",
		url:"php/agregarDatos.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('componentes/tabla.php');
				alertify.success("agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}

function agregaform(datos){

	d=datos.split('||');

	$('#idpersona').val(d[0]);
	$('#nombreu').val(d[1]);
	$('#apellidou').val(d[2]);
	$('#emailu').val(d[3]);
	$('#telefonou').val(d[4]);
	
}

function actualizaDatos(){


	id=$('#idpersona').val();
	nombre=$('#nombreu').val();
	apellido=$('#apellidou').val();
	email=$('#emailu').val();
	telefono=$('#telefonou').val();

	cadena= "id=" + id +
			"&nombre=" + nombre + 
			"&apellido=" + apellido +
			"&email=" + email +
			"&telefono=" + telefono;

	$.ajax({
		type:"POST",
		url:"php/actualizaDatos.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('componentes/tabla.php');
				alertify.success("Actualizado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}

function BorradoMultiple(array) {
	if (array.length !== 1) {
		array.forEach(element => {
			eliminarDatos(element);
		});
	}else{
		eliminarDatos(array);
	}
}

function preguntarSiNo(id){
	var result = [];
	for (let i = 0; i < arguments.length; i++) {
		 result.push(arguments[i]);
	}
	alertify.confirm('Eliminar Pelis', '¿Esta seguro de eliminar esta Pelicula?', 
					function(){ BorradoMultiple(result) }
                , function(){ alertify.error('Se cancelo')});
}

function preguntarSiNoSeri(id){
	alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar esta Temporada?', 
					function(){ eliminarDatosSeri(id) }
                , function(){ alertify.error('Se cancelo')});
}

function eliminarDatos(id){

	cadena="id=" + id;

		$.ajax({
			type:"POST",
			url:"php/eliminarDatos.php",
			data:cadena,
			success:function(r){
				if(r==1){
					$('#tabla').load('tabla.php');
					alertify.success("Eliminado con exito!!!!!!!");
				}else{
					alertify.error("Fallo el servidor :(");
				}
			}
		});
}

function eliminarDatosSeri(id){

	cadena="id=" + id;

		$.ajax({
			type:"POST",
			url:"php/eliminarDatosSeri.php",
			data:cadena,
			success:function(r){
				if(r==1){
					$('#tabla').load('tablaserie.php');
					alertify.success("Eliminado con exito!");
				}else{
					alertify.error("Fallo el servidorr :(");
				}
			}
		});
}
// .done( function() {

// 	alert( 'Success!!' );

// }).fail( function() {

// 	alert( 'Error!!' );

// }).always( function() {

// 	alert( 'Always' );

// });