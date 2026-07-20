<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die(); 

$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE id_colores_tipo = 11 AND activo = 1');
?>
<div class="preguntar_color_cantoneras">
	<h2>Color cantoneras</h2><br />
	<?php foreach($colores as $color){?>
	<div class="item_colores_cantoneras">
		<h4><?php echo $color['nombre']; ?></h4>
		<img src="www/img/colores/<?php echo $color['imagen']; ?>" title="Seleccionar color <?php echo $color['nombre']; ?>" id_color="<?php echo $color['id']; ?>" nombre_color="<?php echo $color['nombre']; ?>" />
	</div>
	<?php } ?>
</div>