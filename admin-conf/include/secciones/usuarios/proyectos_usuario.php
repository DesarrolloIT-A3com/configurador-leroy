<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$usuario = $db->getVar('SELECT um.nombre FROM usuarios as u, usuarios_mod as um WHERE u.id_usuarios_mod = um.id AND u.id='.$id);
?>

<div id="proyectos" class="pantalla_completa">
	<div class="contenido">
		<div class="navegacion">
			<a class="boton gris grande" href="index.php?seccion=usuarios&sub=ver_usuario&id=<?php echo $id; ?>"><i class="fa fa-chevron-left"></i> Usuario</a>
		</div>
		<div class="titulo_superior">
			PROYECTOS DE <?php echo $usuario; ?>
		</div>
		<div class="listado_proyectos">
		
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		
		listado_proyectos(<?php echo $id; ?>, "todos");
		
	});
</script>