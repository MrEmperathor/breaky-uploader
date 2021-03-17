<div class="container borColor">
  <div id="tabla"></div>
</div>

<!-- Modal para registros nuevos -->



<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').load('inc/tablaserie.php');
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