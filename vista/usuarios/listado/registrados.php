<?php 

include "controlador/app.php";
require('modelo/conexion.php');
 
$sql = 'SELECT * FROM usuarios WHERE rol = "usuario" ';
$result = $conexion->query($sql);

	if ($result->num_rows > 0) {
		$datos = $result->fetch_all(MYSQLI_ASSOC);

	} else {
		$datos = null;
	}

?>

<div class="container">
	<h2>Usuarios Registrados hasta (<?php echo date("Y-m-d H"); ?>)</h2>

	<div class="form-group mt-4">
		<h5>Usuarios por pagina</h5>
		<select class="form-control" name="state" id="maxRows">
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
	<table class="table table-striped table-class" id="table-id">
		<tr>
			<th>Documento</th>
			<th>Nombre</th>
			<th>Genero</th>
			<th>Fecha de registro</th>
		</tr>
	<?php
			foreach($datos as $key => $item){
				echo '
					<tr>
						<td>'.$item['documento'].'</td>
						<td>'.$item['nombre'].' '.$item['apellido'].'</td>
						<td>'.$item['genero'].'</td>
						<td>'.$item['fecha_registro'].'</td>
					</tr>';
			}
    ?>
	</table>

	<div class='pagination-container'>
		<nav>
			<ul class="pagination">
				<li data-page="prev"> <span>
						< <span class="sr-only">(current)
					</span></span></li>
				<li data-page="next" id="prev"><span> > <span class="sr-only">(current)</span></span></li>
			</ul>
		</nav>
	</div>

</div>


<style>
	body {

		background-color: #eee;
	}

	table th,
	table td {
		text-align: center;
	}

	table tr:nth-child(even) {
		background-color: #ffffff
	}

	.pagination li:hover {
		cursor: pointer;
	}


	.pagination>li>a,
	.pagination>li>span {
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



	function getPagination(table) {

		var lastPage = 1;

		$('#maxRows').on('change', function (evt) {
			//$('.paginationprev').html('');						// reset pagination 


			lastPage = 1;
			$('.pagination').find("li").slice(1, -1).remove();
			var trnum = 0;									// reset tr counter 
			var maxRows = parseInt($(this).val());			// get Max Rows from select option

			if (maxRows == 5000) {

				$('.pagination').hide();
			} else {

				$('.pagination').show();
			}

			var totalRows = $(table + ' tbody tr').length;		// numbers of rows 
			$(table + ' tr:gt(0)').each(function () {			// each TR in  table and not the header
				trnum++;									// Start Counter 
				if (trnum > maxRows) {						// if tr number gt maxRows

					$(this).hide();							// fade it out 
				} if (trnum <= maxRows) { $(this).show(); }// else fade in Important in case if it ..
			});											//  was fade out to fade it in 
			if (totalRows > maxRows) {						// if tr total rows gt max rows option
				var pagenum = Math.ceil(totalRows / maxRows);	// ceil total(rows/maxrows) to get ..  
				//	numbers of pages 
				for (var i = 1; i <= pagenum;) {			// for each page append pagination li 
					$('.pagination #prev').before('<li data-page="' + i + '">\
								      <span>'+ i++ + '<span class="sr-only">(current)</span></span>\
								    </li>').show();
				}											// end for i 
			} 												// end if row count > max rows
			$('.pagination [data-page="1"]').addClass('active'); // add active class to the first li 
			$('.pagination li').on('click', function (evt) {		// on click each page
				evt.stopImmediatePropagation();
				evt.preventDefault();
				var pageNum = $(this).attr('data-page');	// get it's number

				var maxRows = parseInt($('#maxRows').val());			// get Max Rows from select option

				if (pageNum == "prev") {
					if (lastPage == 1) { return; }
					pageNum = --lastPage;
				}
				if (pageNum == "next") {
					if (lastPage == ($('.pagination li').length - 2)) { return; }
					pageNum = ++lastPage;
				}

				lastPage = pageNum;
				var trIndex = 0;							// reset tr counter
				$('.pagination li').removeClass('active');	// remove active class from all li 
				$('.pagination [data-page="' + lastPage + '"]').addClass('active');// add active class to the clicked 
				// $(this).addClass('active');					// add active class to the clicked 
				$(table + ' tr:gt(0)').each(function () {		// each tr in table not the header
					trIndex++;								// tr index counter 
					// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
					if (trIndex > (maxRows * pageNum) || trIndex <= ((maxRows * pageNum) - maxRows)) {
						$(this).hide();
					} else { $(this).show(); } 				//else fade in 
				}); 										// end of for each tr in table
			});										// end of on click pagination list

		}).val(5).change();

		// end of on select change 



		// END OF PAGINATION 
	}







	$(function () {
		// Just to append id number for each row  
		$('table tr:eq(0)').prepend('<th> ID </th>')

		var id = 0;

		$('table tr:gt(0)').each(function () {
			id++
			$(this).prepend('<td>' + id + '</td>');
		});
	})

//  Developed By Yasser Mas 
// yasser.mas2@gmail.com
</script>