<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

$nombre_zona = "";
if(isset($_POST['nombre_zona']) && $_POST['nombre_zona'] != "")				$nombre_zona = $_POST['nombre_zona']; 
$id_colores_tipo = 0;
if(isset($_POST['id_colores_tipo']) && $_POST['id_colores_tipo'] > 0)		$id_colores_tipo = (int)$_POST['id_colores_tipo']; 

$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE es_tablero = 1 AND id_colores_tipo = '.$id_colores_tipo);

?>

<h2><?php echo $nombre_zona; ?></h2>
<div class="contenedor_colores_zona">
	<?php foreach($colores as $color){?>
	<div class="item_colores_zona">
		<h4><?php echo $color['nombre']; ?></h4>
		<img src="www/img/colores/<?php echo $color['imagen']; ?>" title="Seleccionar color <?php echo $color['nombre']; ?>" id_color="<?php echo $color['id']; ?>" nombre_color="<?php echo $color['nombre']; ?>" />
	</div>
	<?php } ?>
</div>