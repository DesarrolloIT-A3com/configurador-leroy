<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();
?>

<div id="proyectos" class="pantalla_completa">
	<div class="contenido">
		<div class="navegacion">
			<a class="boton gris grande" href="index.php"><i class="fa fa-chevron-left"></i> Inicio</a>
		</div>
		<div class="titulo_superior">
			PROYECTOS GUARDADOS
		</div>
		<div class="listado_proyectos">
		
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		
		listado_proyectos("todos");
		
	});
</script>