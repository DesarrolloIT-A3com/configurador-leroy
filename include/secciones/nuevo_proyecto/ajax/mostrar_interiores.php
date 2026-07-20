<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();


$num_modulo = 0;
if(isset($_GET['num_modulo']) && $_GET['num_modulo'] > 0)				$num_modulo = (int)$_GET['num_modulo']; 
$tipo = ""; // Simple o doble
if(isset($_GET['tipo']) && $_GET['tipo'] != "")							$tipo = $_GET['tipo']; 
$ancho_interior = 0;
if(isset($_GET['ancho_interior']) && $_GET['ancho_interior'] > 0)		$ancho_interior = (float)$_GET['ancho_interior']; 


$tipo_precio = ceil($ancho_interior/10)*10; // Vemos que medida de precio le corresponde
if($tipo_precio < 40) // La medida mínima para precio es de 50
	$tipo_precio = 40;

$interiores = $db->getResults('SELECT id, nombre, num_cajones, num_zap_doble FROM interiores WHERE ancho_min <= '.$tipo_precio.' AND ancho_max >= '.$tipo_precio);

?>

<div class="mostrar_interiores">
	<h1>M<?php echo $num_modulo; ?></h1>
	<div class="contenedor_mostrar_interiores">
		<?php foreach($interiores as $interior){?>
		<div class="item_mostrar_interiores">
			<h3><?php echo $interior['nombre']; ?></h3>
			<?php
			if($interior['num_cajones'] > 0 || $interior['num_zap_doble'] > 0){
			?>
			<a onClick="preguntar_freno(<?php echo $num_modulo; ?>, '<?php echo $tipo; ?>', <?php echo $tipo_precio; ?>, <?php echo $interior['id']; ?>, '<?php echo $interior['nombre']; ?>', <?php echo $interior['num_cajones']; ?>);"><img src="www/img/interiores/modulo-<?php echo $interior['id']; ?>.jpg" title="Seleccionar <?php echo $interior['nombre']; ?>" /></a>
			<?php
			}
			else if($ancho_interior >=60 && $ancho_interior<=90 && $interior['num_cajones'] <=0){
			?>
			<a onClick="preguntar_freno(<?php echo $num_modulo; ?>, '<?php echo $tipo; ?>', <?php echo $tipo_precio; ?>, <?php echo $interior['id']; ?>, '<?php echo $interior['nombre']; ?>', <?php echo 0; ?>);"><img src="www/img/interiores/modulo-<?php echo $interior['id']; ?>.jpg" title="Seleccionar <?php echo $interior['nombre']; ?>" /></a>
			<?php	
			}
			else{
				// El último parámetro de preguntar_color_interior se refiere a que no lleva freno, cerraduras, ...
			?>
			<a onClick="preguntar_color_interior(<?php echo $num_modulo; ?>, '<?php echo $tipo; ?>', <?php echo $tipo_precio; ?>, <?php echo $interior['id']; ?>, '<?php echo $interior['nombre']; ?>','0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0---');"><img src="www/img/interiores/modulo-<?php echo $interior['id']; ?>.jpg" title="Seleccionar <?php echo $interior['nombre']; ?>" /></a>
			<?php	
			}
			?>
		</div>
		<?php } ?>
	</div>
</div>
