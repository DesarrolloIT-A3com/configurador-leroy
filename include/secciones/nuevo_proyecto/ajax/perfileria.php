<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE MARCADA PARA VER QUE acabadoS SE LE PERMITEN
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)			$id_serie = (int)$_POST['id_serie']; 
// VEMOS EL acabado MARCADO PARA VER QUE COLORES SE LE PERMITEN
$id_acabado = 0;
if(isset($_POST['id_acabado']) && $_POST['id_acabado'] > 0)		$id_acabado = (int)$_POST['id_acabado']; 

// CONSULTAMOS LOS DATOS DE LAS acabadoS
$colores = $db->getResults('SELECT c.id, c.nombre, c.imagen FROM colores AS c, series_colores AS sc, acabados as a WHERE c.id=sc.id_colores AND c.id_colores_tipo = a.id_colores_tipo AND c.es_perfileria = 1 AND a.id = '.$id_acabado.' AND sc.id_series = '.$id_serie.' AND activo = 1');
?>

<h1>Color perfilería</h1>
<div class="seccion_perfileria">
	<?php foreach($colores as $color){?>
	<div class="item_seccion_perfileria">
		<h3><?php echo $color['nombre']; ?></h3>
		<img src="www/img/colores/<?php echo $color['imagen']; ?>" title="Seleccionar color <?php echo $color['nombre']; ?>" id_perfileria="<?php echo $color['id']; ?>" nombre_perfileria="<?php echo $color['nombre']; ?>" />
	</div>
	<?php } ?>
</div>