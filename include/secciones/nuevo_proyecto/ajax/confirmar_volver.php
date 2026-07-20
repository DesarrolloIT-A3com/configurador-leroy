<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();
?>
<div class="confirm">
	<div class="cabecera_confirm">
		Volver
	</div>
	<div class="cuerpo_confirm">
		<div class="contenedor_texto_confirm">	
			<div class="texto_confirm">
				Se perderán todos los datos hasta el paso <?php echo $id; ?>
			</div>
		</div>
		<div class="botones_confirm">
			<a class="boton grande verde" onClick="continuar_proyecto(<?php echo $id ?>,10); $.magnificPopup.close();">Si, volver</a> <a class="boton grande rojo" onClick="$.magnificPopup.close();">No, continuar proyecto</a>
		</div>
	</div>
</div>