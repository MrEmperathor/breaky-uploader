<?php 
session_start();
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base = "http://" . $host . $uri . "/";
if (!$_SESSION['admin']) {
  header('location:http://'.$host.'/panel');
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <base href="<?php echo $base; ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>UploaDL</title>
  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="librerias/datatable/dataTables.bootstrap.min.css">

  <script src="librerias/jquery-3.2.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.js"></script>
  <script src="librerias/alertifyjs/alertify.js"></script>
  <script src="librerias/datatable/jquery.dataTables.min.js"></script>
  <script src="librerias/datatable/dataTables.bootstrap.min.js"></script>
</head>
<body>
<!--   <style>
  a:visited {text-decoration:none;color:#d35400;}
  a:hover {text-decoration:underline;color:#999999;}
  a:active {text-decoration:none;color:#290c1f;}
</style> -->
<div class="container">
  <div id="tabla"></div>
</div>

<!-- Modal para registros nuevos -->


<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agrega nueva persona</h4>
      </div>
      <div class="modal-body">
       <label>Nombre</label>
       <input type="text" name="" id="nombre" class="form-control input-sm">
       <label>Apellido</label>
       <input type="text" name="" id="apellido" class="form-control input-sm">
       <label>Email</label>
       <input type="text" name="" id="email" class="form-control input-sm">
       <label>telefono</label>
       <input type="text" name="" id="telefono" class="form-control input-sm">
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
        Agregar
      </button>
      
    </div>
  </div>
</div>
</div>

<!-- Modal para edicion de datos -->

<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
      </div>
      <div class="modal-body">
        <input type="text" hidden="" id="idpersona" name="">
        <label>Nombre</label>
        <input type="text" name="" id="nombreu" class="form-control input-sm">
        <label>Apellido</label>
        <input type="text" name="" id="apellidou" class="form-control input-sm">
        <label>Email</label>
        <input type="text" name="" id="emailu" class="form-control input-sm">
        <label>telefono</label>
        <input type="text" name="" id="telefonou" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>
        
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').load('tabla.php');
	});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#guardarnuevo').click(function(){
      nombre=$('#nombre').val();
      apellido=$('#apellido').val();
      email=$('#email').val();
      telefono=$('#telefono').val();
      agregardatos(nombre,apellido,email,telefono);
    });



    $('#actualizadatos').click(function(){
      actualizaDatos();
    });

  });
</script>