<?php 

include "controlador/app.php";
require('modelo/conexion.php');
	
$desde1	 = "11/18/2019";
$hasta1  = "11/18/2019";
$datos = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
            $desde1 =  str_replace ( '/' , '-' , $_POST["desde"] );
            $hasta1 =  str_replace ( '/' , '-' , $_POST["hasta"] );
            $desde = explode("-", $desde1);
            $hasta = explode("-", $hasta1);
            $desdesql =   $desde[2].'-'.$desde[1].'-'.$desde[0];
            $hastasql =   $hasta[2].'-'.$hasta[1].'-'.$hasta[0];

   $sql = 'SELECT * FROM parqueos LEFT JOIN usuarios ON parqueos.usuario_id = usuarios.id WHERE horaingreso BETWEEN "'.$desdesql.' 00:00:00" AND "'.$hastasql.' 23:59:59" AND duracion <> ""';
	$result = $conexion->query($sql);

	if ($result->num_rows > 0) {
            $datos = $result->fetch_all(MYSQLI_ASSOC);
	} else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>NO SE REGISTRO USUARIOS PARA ESTAS FECHAS!</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>';
         $datos = null;
	}

	function convertirTiempo($data){
		$minutes = $data;
		$zero    = new DateTime('@0');
		$offset  = new DateTime('@' . $minutes * 60);
		$diff    = $zero->diff($offset);
		return $diff->format('%a Días, %h Horas, %i Minutos');
	}
    }
	
?>


<div class="container">
        <h3>Usuarios Que han utilizado el parqueadero hasta (<?php echo date("Y-m-d"); ?>)</h3>
        <form class="form-inline" method="post">
            <h5>Desde: </h5>
        <input id="datepicker" name="desde" width="276" value="<?php echo $desde1 ?>"  readonly/>
            <script>
                $('#datepicker').datepicker({
                    uiLibrary: 'bootstrap4'
                });
            </script>

        <h5>Hasta: </h5>
        <input  id="datepicker2" name="hasta" width="276" value="<?php echo $hasta1 ?>" readonly/>
            <script>
                $('#datepicker2').datepicker({
                    uiLibrary: 'bootstrap4'
                });
            </script>
        <button type="submit" id="boton-cargar" class="ml -3 btn btn-primary btn-sm" style="margin-left: 10px;">GENERAR REPORTE</button>
        </form>

				<div class="form-group mt-4"> 
				<h5>Usuarios por página</h5>
			 		<select class  ="form-control" name="state" id="maxRows">
						 <option value="5000">Mostrar todos</option>
						 <option value="5">5</option>
						 <option value="10">10</option>
						 <option value="15">15</option>
						 <option value="20">20</option>
						 <option value="50">50</option>
						 <option value="70">70</option>
						 <option value="100">100</option>
						</select>			
			  	</div>
			<table class="table table-striped table-class" id= "table-id">
				<tr>
					<th>Documento</th>
					<th>Nombre</th>
					<th>Genero</th>
					<th>Fecha de Ingreso</th>
					<th>Fecha de Salida</th>
					<th>Duración</th>
				</tr>
                <?php
                if($datos!=NULL){
                
					foreach($datos as $key => $item){					
						echo '
							<tr>
								<td>'.$item['documento'].'</td>
								<td>'.$item['nombre'].' '.$item['apellido'].'</td>
								<td>'.$item['genero'].'</td>
								<td>'.$item['horaingreso'].'</td>
								<td>'.$item['horasalida'].'</td>
								<td>'.convertirTiempo($item['duracion']).'</td>
							</tr>';
                    }
                }
				?>
			</table>
			<div class='pagination-container' >
				<nav>
				  <ul class="pagination">
						<li data-page="prev" ><span> < <span class="sr-only">(current)</span></span></li>
       					<li data-page="next" id="prev"><span>><span class="sr-only">(current)</span></span></li>
				  </ul>
				</nav>
			</div>

</div>


<style>
	body{
		background-color: #eee; 
	}

	table th , table td{
		text-align: center;
	}

	table tr:nth-child(even){
		background-color: #ffffff
	}

	.pagination li:hover{
		cursor: pointer;
	}


	.pagination>li>a, .pagination>li>span {
		position: relative;
		float: left;
		padding: 6px 12px;
		margin-left: -1px;
		line-height: 1.42857143;
		color: #337ab7;
		text-decoration: none;
		background-color: #fff;
		border: 1px solid #ddd;
		font-size: 16px;
	}

</style>

<!--  Developed By Yasser Mas -->
<script>
          getPagination('#table-id');
					//getPagination('.table-class');
					//getPagination('table');

		 
		 
	function getPagination (table){

        		var lastPage = 1 ; 

		  $('#maxRows').on('change',function(evt){
		  	//$('.paginationprev').html('');						// reset pagination 


		lastPage = 1 ; 
         $('.pagination').find("li").slice(1, -1).remove();
		  	var trnum = 0 ;									// reset tr counter 
		  	var maxRows = parseInt($(this).val());			// get Max Rows from select option

		  	if(maxRows == 5000 ){

		  		$('.pagination').hide();
		  	}else {
		  		
		  		$('.pagination').show();
		  	}

		  	var totalRows = $(table+' tbody tr').length;		// numbers of rows 
			 $(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
			 	trnum++;									// Start Counter 
			 	if (trnum > maxRows ){						// if tr number gt maxRows
			 		
			 		$(this).hide();							// fade it out 
			 	}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
			 });											//  was fade out to fade it in 
			 if (totalRows > maxRows){						// if tr total rows gt max rows option
			 	var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
			 												//	numbers of pages 
			 	for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
			 	$('.pagination #prev').before('<li data-page="'+i+'">\
								      <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
								    </li>').show();
			 	}											// end for i 
			} 												// end if row count > max rows
			$('.pagination [data-page="1"]').addClass('active'); // add active class to the first li 
			$('.pagination li').on('click',function(evt){		// on click each page
				evt.stopImmediatePropagation();
				evt.preventDefault();
				var pageNum = $(this).attr('data-page');	// get it's number

				var maxRows = parseInt($('#maxRows').val());			// get Max Rows from select option

				if(pageNum == "prev" ){
					if(lastPage == 1 ){return;}
					pageNum  = --lastPage ; 
				}
				if(pageNum == "next" ){
					if(lastPage == ($('.pagination li').length -2) ){return;}
					pageNum  = ++lastPage ; 
				}

				lastPage = pageNum ;
				var trIndex = 0 ;							// reset tr counter
				$('.pagination li').removeClass('active');	// remove active class from all li 
				$('.pagination [data-page="'+lastPage+'"]').addClass('active');// add active class to the clicked 
				// $(this).addClass('active');					// add active class to the clicked 
				 $(table+' tr:gt(0)').each(function(){		// each tr in table not the header
				 	trIndex++;								// tr index counter 
				 	// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
				 	if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
				 		$(this).hide();		
				 	}else {$(this).show();} 				//else fade in 
				 }); 										// end of for each tr in table
					});										// end of on click pagination list

		}).val(5).change();

												// end of on select change 
		 
    
  
								// END OF PAGINATION 
	}	







$(function(){
	// Just to append id number for each row  
					$('table tr:eq(0)').prepend('<th> ID </th>')

					var id = 0;

					$('table tr:gt(0)').each(function(){	
						id++
						$(this).prepend('<td>'+id+'</td>');
					});
})

//  Developed By Yasser Mas 
// yasser.mas2@gmail.com



$(document).ready(function(){    
    $('#boton-guardar').click(function(){        
        /*Captura de datos escrito en los inputs*/        
        var nom = document.getElementById("datepicker2").value;
        var apel = document.getElementById("datepicker").value;
        /*Guardando los datos en el LocalStorage*/
        localStorage.setItem("Nombre", nom);
        localStorage.setItem("Apellido", apel);
        /*Limpiando los campos o inputs*/
        document.getElementById("datepicker2").value = "";
        document.getElementById("datepicker").value = "";
    });   
});
</script>