
<?php 

require_once "php/conexion.php";

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";

$conexion=conexion();

?>
<div class="row">
	<div class="col mt-3 mr-5 ml-5">
		  	<style>
			  a:visited {text-decoration:none;color:#d35400;}
			  a:hover {text-decoration:underline;color:#999999;}
			  a:active {text-decoration:none;color:#290c1f;}
			</style>
		<h2>Enlaces para Series </h2>

		<table id="tablaDinamicaLoad" class="table table-striped table-bordered" style="width:100%">
			<caption>
			</caption>
			<thead>
				<tr>
					<td>ID</td>
					<td>Nombre</td>
					<td>Temporada</td>
					<td>Calidad</td>
					<td>Idioma</td>
					<td>TMDB</td>
					<!-- <td>Estado</td> -->
					<!-- <td>Editar</td> -->
					<td>Eliminar</td>
				</tr>
			</thead>
			<tbody>
				<?php 

				
				$sql="SELECT id,nombre,temp,calidad,idioma,TMDB,links
				FROM seriess ORDER BY id";
				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)){ 

					$datos=$ver[0]."||".
						   $ver[1]."||".
						   $ver[2]."||".
						   $ver[3]."||".
						   $ver[4]."||".
						   $ver[5];
					?>

					<?php  
					$est = (strlen($ver[5]) == 1 or strlen($ver[5]) == 0)  ? "IMCOMPLETO" : "COMPLETO";
					$coll = (strlen($ver[5]) == 1 or strlen($ver[5]) == 0)  ? 'style="color: #444;text-decoration: none !important;"' : NULL;
					$col = (strlen($ver[6]) == 1 or strlen($ver[6]) == 0)  ? NULL : 'style="color: #77b733;text-decoration: none !important;"';

					?>

					<tr>
						<td><a href="<?php echo $base.'serie.php?s='.$ver[0]; ?>" target="_blank"><?php echo $ver[0] ?></a></td>

						<td><a <?php echo $coll; ?> href="<?php echo $base.'serie.php?s='.$ver[0]; ?>" target="_blank"><?php echo $ver[1] ?></a></td>

						<td><a <?php echo $col; ?> href="<?php echo $base.'serie.php?s='.$ver[0]; ?>" target="_blank"><?php echo $ver[2] ?></a></td>
						<td><a href="<?php echo $base.'serie.php?s='.$ver[0]; ?>" target="_blank"><?php echo $ver[3] ?></a></td>
						<td><?php echo $ver[4] ?></td>
						<td><?php echo $ver[5] ?></td>
						<!-- <td><?php echo $est; ?></td> -->
						<!-- <td>
							<button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">

							</button>
						</td> -->
						<td>
							<button class="btn btn-danger mdi mdi-delete menu-icon" 
							onclick="preguntarSiNoSeri('<?php echo $ver[0] ?>')">

						</button>
					</td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
    $('#tablaDinamicaLoad').DataTable({
        "order": [[ 0, "desc" ]]
    });
} );
</script>