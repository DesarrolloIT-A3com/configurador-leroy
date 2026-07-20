<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();
?>
<div class="confirm">
	<div class="cabecera_confirm">
		Salir
	</div>
	<div class="cuerpo_confirm">
		<div class="contenedor_texto_confirm">	
			<div class="texto_confirm">
				¿Realmente deseas salir de la administración?
			</div>
		</div>
		<div class="botones_confirm">
			<a class="boton grande verde" href="index.php?seccion=logout">Aceptar</a> <a class="boton grande rojo" onClick="$.magnificPopup.close();">Cancelar</a>
		</div>
	</div>
</div>