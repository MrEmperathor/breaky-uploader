
<div class="container borColor">
  <div id="tabla"></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').load('inc/tabla.php');
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