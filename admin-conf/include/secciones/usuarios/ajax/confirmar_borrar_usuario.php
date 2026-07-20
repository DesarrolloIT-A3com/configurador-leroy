<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// CONSULTAMOS LOS DATOS DE EMPRESA 
$nombre = $db->getVar('SELECT um.nombre FROM usuarios_mod as um, usuarios as u WHERE u.id_usuarios_mod=um.id and u.id='.$id);


$volver = 0;
if(isset($_GET['volver']) && $_GET['volver'] != 0)	$volver = 1;

?>
<div class="confirm">
	<div class="cabecera_confirm">
		Confirmar borrado
	</div>
	<div class="cuerpo_confirm">
		<div class="contenedor_texto_confirm">	
			<div class="texto_confirm">
				¿Realmente deseas eliminar '<?php echo $nombre; ?>'?, se perderán todos sus datos, presupuestos, etc.
			</div>
		</div>
		<div class="botones_confirm">
			<a class="boton grande verde" onClick="borrar_usuario(<?php echo $id; ?>,<?php echo $volver; ?>); $.magnificPopup.close();">Aceptar</a> <a class="boton grande rojo" onClick="$.magnificPopup.close();">Cancelar</a>
		</div>
	</div>
</div>