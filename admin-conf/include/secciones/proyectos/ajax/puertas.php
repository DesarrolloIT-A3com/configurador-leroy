<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE MARCADA PARA VER QUE TABLEROS SE LE PERMITEN
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)			$id_serie = (int)$_POST['id_serie']; 
// VEMOS EL ANCHO INTRODUCIDO PARA VER CUANTAS PUERTAS SE LE PERMITEN
$ancho = 0;
if(isset($_POST['ancho']) && $_POST['ancho'] > 0)				$ancho = (int)$_POST['ancho']; 

// CONSULTAMOS LAS MEDIDAS MÁXIMAS Y MÍNIMAS DE LA SERIE
//$serie = $db->getRow('SELECT num_puertas_min, num_puertas_max, ancho_puerta_min, ancho_puerta_max FROM series WHERE id = '.$id_serie);

if($id_serie == 0){  // SI ES SOLO INTERIOR TOMAREMOS COMO REFERENCIA LA SERIE JOMY
	$id_serie = 1;
}

$num_puertas_min = $db->getRow('SELECT MIN(puertas) as puertas, MIN(ancho) as ancho FROM ancho_puertas WHERE id_series = '.$id_serie.' AND ancho >= '.$ancho.' GROUP BY puertas');
$num_puertas_max = $db->getVar('SELECT puertas FROM ancho_puertas WHERE id_series = '.$id_serie.' AND puertas >= '.$num_puertas_min['puertas'].' AND ancho <= '.$num_puertas_min['ancho'].' GROUP BY puertas');

if (!$num_puertas_max) {
    $num_puertas_max = $num_puertas_min['puertas'];
}

?>

<h1>Nº Puertas</h1>
<div class="seccion_puertas">	
	<?php for($i = $num_puertas_min['puertas'] ; $i <= $num_puertas_max ; $i++){?>
	<div class="item_seccion_puertas">
		<h3><?php echo $i; ?></h3>
		<img src="www/img/num_puertas/puertas-<?php echo $i; ?>.png" title="Seleccionar <?php echo $i; ?> puertas" num_puertas="<?php echo $i; ?>" />
	</div>
	<?php } ?>
</div>