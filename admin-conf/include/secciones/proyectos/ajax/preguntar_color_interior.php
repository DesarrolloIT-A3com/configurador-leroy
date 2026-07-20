<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die(); 

$colores = $db->getResults('SELECT id, nombre, imagen, activo FROM colores WHERE id_colores_tipo = 11');
?>
<div class="preguntar_color_interior">
	<h2>Color módulo</h2><br />
	<?php foreach($colores as $color){?>
		<?php if($color['activo'] == 1){?>
			<div class="item_colores_interior">
				<h4><?php echo $color['nombre']; ?></h4>
				<img src="www/img/colores/<?php echo $color['imagen']; ?>" title="Seleccionar color <?php echo $color['nombre']; ?>" id_color="<?php echo $color['id']; ?>" nombre_color="<?php echo $color['nombre']; ?>" />
			</div>
		<?php } ?>
	<?php } ?>
</div>