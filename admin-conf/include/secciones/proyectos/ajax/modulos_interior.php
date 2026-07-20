<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

$ancho = 0;
if(isset($_POST['ancho']) && $_POST['ancho'] > 0)						$ancho = (int)$_POST['ancho']; 
$num_puertas = 0;
if(isset($_POST['num_puertas']) && $_POST['num_puertas'] > 0)			$num_puertas = (int)$_POST['num_puertas']; 
$paso_anterior = 7;
if(isset($_POST['paso_anterior']) && $_POST['paso_anterior'] > 0)		$paso_anterior = (int)$_POST['paso_anterior']; 

if($num_puertas == 0){ // SI SE TRATA SOLO DE INTERIOR
	if($ancho < 80){ // HASTA 80 TENDRÁ QUE LLEVAR 1 YA QUE EL MÍNIMO ES DE 40 DE ANCHO
		$num_puertas = 1;
	}
	else{
		$num_puertas = ceil($ancho / 40); // ANCHO 240 TENDRÁ QUE LLEVAR MÁXIMO 6
	}
}

$ancho_puerta = $ancho / $num_puertas;

if($ancho_puerta <= 55){ // SI EL ANCHO DE PUERTA ES MENOR DE 55 PODREMOS PONER MÓDULOS QUE OCUPEN DOS PUERTAS
	$num_modulos_min = ceil($num_puertas / 2);
}
else{
	$num_modulos_min = $num_puertas;
}
$num_modulos_max = $num_puertas;
?>

<div class="modulos_interior">
	<?php
	$num_opcion = 0;
	for($i=$num_modulos_min; $i<=$num_modulos_max; $i++){
		$modulos_dobles = $num_puertas - $i;
		$modulos_simples = $num_puertas - ($num_puertas - $i) * 2;
		$num_opcion++;
	?>
	<div class="item_modulos_interior">
		<h3>Opción <?php echo $num_opcion; ?></h3>
		<a onClick="seleccion_interior(<?php echo $ancho_puerta; ?>,<?php echo $modulos_dobles; ?>,<?php echo $modulos_simples; ?>);">
		<?php
		for($j=1; $j<=$modulos_dobles; $j++){
		?>
			<img class="interior_doble" src="www/img/interiores/interior_doble.jpg" />
		<?php
		}
		for($j=1; $j<=$modulos_simples; $j++){
		?>
			<img class="interior_simple" src="www/img/interiores/interior_simple.jpg" />
		<?php
		}
		?>
		</a>
	</div>
	<?php
	}
	?>
</div>
<div class="boton_reiniciar">
	<a class="boton grande naranja" onClick="$('.botones_navegacion .boton_continuar').removeClass('inactivo'); continuar_proyecto(8,<?php echo $paso_anterior; ?>);"><i class="fa fa-refresh"></i> Reiniciar interior</a>
</div>