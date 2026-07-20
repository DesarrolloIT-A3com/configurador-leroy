<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

$ancho_puerta = 0;
if(isset($_POST['ancho_puerta']) && $_POST['ancho_puerta'] > 0)					$ancho_puerta = (int)$_POST['ancho_puerta']; 
$modulos_dobles = 0;
if(isset($_POST['modulos_dobles']) && $_POST['modulos_dobles'] > 0)				$modulos_dobles = (int)$_POST['modulos_dobles']; 
$modulos_simples = 0;
if(isset($_POST['modulos_simples']) && $_POST['modulos_simples'] > 0)			$modulos_simples = (int)$_POST['modulos_simples']; 

$total_modulos = $modulos_dobles + $modulos_simples;
?>

<div class="seleccion_interior puertas-<?php echo $total_modulos; ?>">
	<?php
	$num_modulo = 0;
	for($j=1; $j<=$modulos_dobles; $j++){
		$num_modulo++;
	?>
	<div class="item_seleccion_interior">
		<h3>M<?php echo $num_modulo; ?> (D<span>oble</span>)</h3>
		<a onClick="mostrar_interiores(<?php echo $num_modulo; ?>, 'doble',<?php echo $ancho_puerta; ?>);"><img id="img_modulo_<?php echo $num_modulo; ?>" src="www/img/interiores/interior_simple.jpg" /></a>
	</div>
	<?php
	}
	for($j=1; $j<=$modulos_simples; $j++){
		$num_modulo++;
	?>
	<div class="item_seleccion_interior">
		<h3>M<?php echo $num_modulo; ?> (S<span>imple</span>)</h3>
		<a onClick="mostrar_interiores(<?php echo $num_modulo; ?>, 'simple',<?php echo $ancho_puerta; ?>);"><img id="img_modulo_<?php echo $num_modulo; ?>" src="www/img/interiores/interior_simple.jpg" /></a>
	</div>
	<?php
	}
	?>
</div>
<div class="boton_reiniciar">
	<a class="boton grande naranja" onClick="$('.botones_navegacion .boton_continuar').removeClass('inactivo'); continuar_proyecto(8,7);">Reiniciar interior</a>
</div>