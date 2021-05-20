
<?php 
// ini_set('error_reporting', E_ALL|E_STRICT);
// ini_set('display_errors', '1');

include 'comp/funtions.php';

function comprobarCalidad($url,$estado,$iid)
{
	$estado = json_decode(unserialize($estado));
	if(strlen($estado) < 2) $estado = false;
	$estado_url = (strlen($url) < 2) ? false : true;
	
	if (!empty($estado_url)) {
		if (!empty($estado)) {

			$api = "http://167.86.105.129/panel/inc/comp/apis/drive_estado_720.php?id=";
	
			preg_match('/(?:https?:\/\/)?(?:[\w\-]+\.)*(?:drive|docs)\.google\.com\/(?:(?:folderview|open|uc)\?(?:[\w\-\%]+=[\w\-\%]*&)*id=|(?:folder|file|document|presentation)\/d\/|spreadsheet\/ccc\?(?:[\w\-\%]+=[\w\-\%]*&)*key=)([\w\-]{28,})/i', $url[1] , $match);
			$ID = $match[1];
	
			
			$result = json_decode(file_get_contents($api.$ID));
			$discopinle720 = (!empty($result->p720p)) ? true : false;
			// if(!empty($result->p720p)) $discopinle720 = true;
					
			if (!empty($discopinle720)) {

				require "xion/conexion.php";

				$disponible = serialize(json_encode($discopinle720));
				$sql_editar = 'UPDATE pelis SET estado720=? WHERE id=?';
	
				$sentencia_editar = $pdo->prepare($sql_editar);
	
				$sentencia_editar->execute(array($disponible,$iid));
			
				//cerramos conexión base de datos y sentencia
				$pdo = null; 
				$sentencia_editar = null; 
			}
		}else {
			$discopinle720 = true;
		}
	}else {
		$discopinle720 = false;
	}
	
	return $discopinle720;
}

function extraNetu($arrayEnlaces, $datoBuscar)
{	

	$arrayLinks = unserialize($arrayEnlaces);
	if (is_array($arrayLinks)) {
		if (!empty($datoBuscar)) {
			$position = buscarDato($arrayLinks, $datoBuscar);
			$datoEncontrado = $arrayLinks[$position];
			return $datoEncontrado;
		}
	}
}


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
			.da{
				width: 100%;
				overflow: hidden;
				margin-right: -413px;
			}
		</style>
		<h2>Enlaces para Peliculas</h2>
		<div class="row mb-4 mt-3" id="select_servidores">
		</div>
		<div class="row mb-1" id="botonUniversal">
			<div class="col-2"><div id="boton_modal"></div></div>
			<div class="col-2"><div id="boton_modal_1"></div></div>
		</div>
		<table id="tablaDinamicaLoad" class="table table-striped table-bordered" style="width:100%;">
			<caption>
			</caption>
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Nombre</th>
					<th>Calidad</th>
					<th>Idioma</th>
					<th>TMDB</th>
					<!-- <td>Estado</td> -->
					<!-- <td>Editar</td> -->
					<th>Backup</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php 

				$sql="SELECT id,nombre,calidad,idioma,TMDB,links,Backup,7VIP,estado720
				FROM pelis ORDER BY id";
				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)){ 

					$datos=$ver[0]."||".
						   $ver[1]."||".
						   $ver[2]."||".
						   $ver[3]."||".
						   $ver[4]."||".
						   $ver[8];

					// echo('<pre>');
					//  var_dump($ver[6]);
					// echo('</pre>');
					// echo('<pre>');
					// var_dump($ver[2]);
					// echo('</pre>');

					// $enlaces_completos = unserialize($ver[5]);
					if($ver[2] == '(1080)') $linkParaExtra720 = extraNetu($ver[5], 'mega.nz');
					if($ver[2] == '(720)') $linkParaExtra720 = extraNetu($ver[5], 'mega.nz');

					


					$est = (strlen($ver[5]) == 1 or strlen($ver[5]) == 0)  ? "IMCOMPLETO" : "COMPLETO";
					$coll = (strlen($ver[5]) == 1 or strlen($ver[5]) == 0 or $ver[5] == "admin2")  ? 'style="color: #444;text-decoration: none !important;"' : NULL;
					$col = (strlen($ver[6]) == 1 or strlen($ver[6]) == 0)  ? NULL : 'style="color: #77b733;text-decoration: none !important;"';
					
					$backup_link = unserialize($ver[6]);
					$backup_link = $backup_link[1];
					// if (strlen($ver[6]) > 1) {
					// 	// $colr = comprobarCalidad($ver[6]);
					// 	$col = (!empty(comprobarCalidad($ver[6],$ver[8],$ver[0]))) ? 'style="color: #77b733;text-decoration: none !important;"' : 'style="color: #ffbc00e8;text-decoration: none !important;"';
					// 	// $col = "ESTA CPAIDNO TODOOOOOOO";
					// }else {
					// 	$col = 'style="color: #444;text-decoration: none !important;"';
					// }

					

					?>

					<tr>
						<!-- <td>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="<?php echo $ver[0] ?>" name="check_">
							</div>
						</td> -->
						<td></td>
						<td><a href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[0] ?></a></td>

						<td><a <?php echo $coll; ?> href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[1];?></a></td>

						<td><a <?php echo $col; ?> href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[2] ?></a></td>
						<td><a href="<?php echo $base.'embed.php?page='.$ver[0]; ?>" target="_blank"><?php echo $ver[3] ?></a></td>
						<td><?php echo $ver[4] ?></td>
						<!-- <td><?php echo $est; ?></td> -->
						<!-- <td>
							<button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')">

							</button>
						</td> -->
						
						<td>
							<div class="da"><?php echo $linkParaExtra720;?></div>
						</td>
						<td>
							<button class="btn btn-danger mdi mdi-delete menu-icon" 
							onclick="preguntarSiNo('<?php echo $ver[0] ?>')">
							</button>
						</td>
						
					</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
	<?php 
	// echo('<pre>');
	// var_dump($catidad);
	// echo('</pre>');
	?>
</>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<div class="md-form">
		<textarea id="cadenaDatos" class="md-textarea form-control" rows="30"></textarea>
		</div>
    </div>
  </div>
</div>
<script>
var urlFiltroCalidad = '<?php echo $base;?>';
</script>
<script src="inc/js/tablaf.js"></script>

