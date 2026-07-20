<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERI MARCADA PARA VER QUE acabadoS SE LE PERMITEN
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)		$id_serie = (int)$_POST['id_serie']; 

// CONSULTAMOS LOS DATOS DE LAS acabadoS
$acabados = $db->getResults('SELECT id, nombre, imagen FROM acabados WHERE id_colores_tipo IN ( SELECT DISTINCT(c.id_colores_tipo) FROM colores as c, series_colores as sc WHERE c.id = sc.id_colores AND sc.id_series = '.$id_serie.')');
?>

<h1>Acabado</h1>
<div class="seccion_acabado">
	<?php foreach($acabados as $acabado){?>
	<div class="item_seccion_acabado">
		<h3><?php echo $acabado['nombre']; ?></h3>
		<img src="www/img/acabados/<?php echo $acabado['imagen']; ?>" title="Seleccionar acabado <?php echo $acabado['nombre']; ?>" id_acabado="<?php echo $acabado['id']; ?>" nombre_acabado="<?php echo $acabado['nombre']; ?>" />
	</div>
	<?php } ?>
</div>