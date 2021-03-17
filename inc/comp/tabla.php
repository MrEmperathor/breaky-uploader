
<?php 

require_once "../php/conexion.php";

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";

$conexion=conexion();

?>
<div class="row">
	<div class="col-sm-12">
		<h2>Todos los enlaces </h2>
		<table id="tablaDinamicaLoad" class="table table-striped table-bordered" style="width:100%">
		<!-- <table class="table table-hover table-condensed table-bordered" id="tablaDinamicaLoad"> -->
			<caption>
				<!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
					Agregar nuevo 
					<span class="glyphicon glyphicon-plus"></span>
				</button> -->
			</caption>
			<thead>
				<tr>
					<td>ID</td>
					<td>Nombre</td>
					<td>Calidad</td>
					<td>Idioma</td>
					<td>TMDB</td>
					<!-- <td>Editar</td>
					<td>Eliminar</td> -->
				</tr>
			</thead>
			<tbody>
				<?php 

				$sql="SELECT id,nombre,calidad,idioma,TMDB 
				from pelis ORDER BY id DESC";
				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)){ 

					$datos=$ver[0]."||".
					$ver[1]."||".
					$ver[2]."||".
					$ver[3]."||".
					$ver[4];
					?>

					<tr>
						<td><a href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[0] ?></a></td>
						<td><a href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[1] ?></a></td>
						<td><a href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[2] ?></a></td>
						<td><a href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[3] ?></a></td>
						<td><a href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[4] ?></a></td>
						<!-- <td>
							<button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">

							</button>
						</td>
						<td>
							<button class="btn btn-danger glyphicon glyphicon-remove" 
							onclick="preguntarSiNo('<?php echo $ver[0] ?>')">

						</button>
					</td> -->
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
    $('#tablaDinamicaLoad').DataTable();
} );
</script>