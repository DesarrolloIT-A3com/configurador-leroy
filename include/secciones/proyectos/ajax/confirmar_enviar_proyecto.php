<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

?>
<div class="confirm">
	<div class="cabecera_confirm">
		Confirmar envío
	</div>
	<div class="cuerpo_confirm">
		<div class="contenedor_texto_confirm">	
			<div class="texto_confirm">
				El proyecto 'P<?php echo str_pad($id, 6, "0", STR_PAD_LEFT); ?>' se enviará a fábrica.
			</div>
		</div>
		<div class="botones_confirm">
			<a class="boton grande verde" onClick="enviar_proyecto(<?php echo $id; ?>); $.magnificPopup.close();">Aceptar</a> <a class="boton grande rojo" onClick="$.magnificPopup.close();">Cancelar</a>
		</div>
	</div>
</div>