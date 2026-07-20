<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();
?>
<div class="confirm">
	<div class="cabecera_confirm">
		Cancelar proyecto
	</div>
	<div class="cuerpo_confirm">
		<div class="contenedor_texto_confirm">	
			<div class="texto_confirm">
				¿Realmente deseas cancelar el proyecto?<br />Se perderán todos los datos.
			</div>
		</div>
		<div class="botones_confirm">
			<a class="boton grande verde" href="index.php">Si, cancelar</a> <a class="boton grande rojo" onClick="$.magnificPopup.close();">No, continuar proyecto</a>
		</div>
	</div>
</div>