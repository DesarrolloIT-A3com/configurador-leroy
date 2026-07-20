<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// CONSULTAMOS LOS DATOS DE EMPRESA 
$nombre = $db->getVar('SELECT nombre FROM solicitudes_alta WHERE id='.$id);

?>
<div class="confirm">
	<div class="cabecera_confirm">
		Confirmar rechazo
	</div>
	<div class="cuerpo_confirm">
		<div class="contenedor_texto_confirm">	
			<div class="texto_confirm">
				¿Realmente deseas rechazar la solicitud de '<?php echo $nombre; ?>'?
			</div>
		</div>
		<div class="botones_confirm">
			<a class="boton grande verde" onClick="rechazar_solicitud(<?php echo $id; ?>); $.magnificPopup.close();">Aceptar</a> <a class="boton grande rojo" onClick="$.magnificPopup.close();">Cancelar</a>
		</div>
	</div>
</div>