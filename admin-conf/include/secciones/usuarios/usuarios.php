<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();
?>
<div id="usuarios" class="pantalla_completa">
	<div class="contenido">
		<div class="navegacion">
			<a class="boton gris grande" href="index.php"><i class="fa fa-chevron-left"></i> Inicio</a>
		</div>
		<div class="titulo_superior">
			USUARIOS
		</div>
		<div class="listado_usuarios">
			
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		
		listado_usuarios("todos");
		
	});
</script>