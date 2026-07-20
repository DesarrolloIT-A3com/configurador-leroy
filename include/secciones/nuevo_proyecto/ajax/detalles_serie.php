<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

$detalles_serie = $db->getRow('SELECT * FROM series WHERE id = '.$id);
?>
<div class="detalles_serie">
	<h1>
		Serie <?php echo $detalles_serie['nombre']; ?>
	</h1>
	<div class="cuerpo_detalles_serie">
		<div class="imagen_detalles_serie">
			<img class="imagen_full" src="www/img/series/<?php echo $detalles_serie['imagen']; ?>" title="Serie <?php echo $detalles_serie['nombre']; ?>" />
			<img class="imagen_detalle" src="www/img/series/<?php echo $detalles_serie['detalle']; ?>" title="Serie <?php echo $detalles_serie['nombre']; ?>" />
			<div class="image_orientativa">Imagen orientativa</div>
		</div>
		<div class="descripcion_detalles_serie">
			<h2><i class="fa fa-info-circle"></i> Detalles</h2>
			<h3>Puertas</h3>
			<div class="txt_detalles_serie"><?php echo $detalles_serie['tipo_puertas']; ?></div>
			<h3>Tirador</h3>
			<div class="txt_detalles_serie"><?php echo $detalles_serie['tipo_tirador']; ?> <a class="boton pequeno azul" onClick="mostrar_imagen_detalle();"><i class="fa fa-eye"></i> <small>Ver / Ocultar</small></a></div>
			<h3>Ancho</h3>
			<div class="txt_detalles_serie">Min. <?php echo $detalles_serie['ancho_total_min']; ?> cm. - Max. <?php echo $detalles_serie['ancho_total_max']; ?> cm.</div>
			<h3>Alto</h3>
			<div class="txt_detalles_serie">Min. <?php echo $detalles_serie['alto_total_min']; ?> cm. - Max. <?php echo $detalles_serie['alto_total_max']; ?> cm.</div>
			<h3>Nº Puertas</h3>
			<div class="txt_detalles_serie"><?php echo $detalles_serie['num_puertas_min']; ?> a <?php echo $detalles_serie['num_puertas_max']; ?></div>
			<h3>Nº Carriles</h3>
			<div class="txt_detalles_serie"><?php echo $detalles_serie['num_carriles_min']; ?> <?php echo $detalles_serie['num_carriles_max'] > $detalles_serie['num_carriles_min'] ? " - ".$detalles_serie['num_carriles_max'] : ""; ?></div>
		</div>
	</div>
</div>