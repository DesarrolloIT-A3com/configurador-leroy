<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

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
				¿Realmente deseas eliminar el proyecto 'P<?php echo str_pad($id, 6, "0", STR_PAD_LEFT); ?>'?<br />Los datos se perderán definitivamente
			</div>
		</div>
		<div class="botones_confirm">
			<a class="boton grande verde" onClick="borrar_proyecto(<?php echo $id; ?>,<?php echo $volver; ?>); $.magnificPopup.close();">Aceptar</a> <a class="boton grande rojo" onClick="$.magnificPopup.close();">Cancelar</a>
		</div>
	</div>
</div>