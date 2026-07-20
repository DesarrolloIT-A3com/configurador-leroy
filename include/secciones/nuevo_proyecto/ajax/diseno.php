<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE MARCADA PARA VER QUE TABLEROS SE LE PERMITEN
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)			$id_serie = (int)$_POST['id_serie']; 
// VEMOS EL NÚMERO DE PUERTAS ELEGIDO
$num_puertas = 0;
if(isset($_POST['num_puertas']) && $_POST['num_puertas'] > 0)	$num_puertas = (int)$_POST['num_puertas']; 

?>

<h1>Diseño puertas</h1>
<div class="seccion_diseno puertas-<?php echo $num_puertas; ?>">	
	<?php for($i = 1 ; $i <= $num_puertas ; $i++){ ?>
	<div class="item_seccion_diseno">
		<h3>P<?php echo $i; ?></h3>
		<img id="puerta-<?php echo $i; ?>" src="www/img/disenos/<?php echo $id_serie; ?>/liso.png" title="Cambiar puerta <?php echo $i; ?>" num_puerta="<?php echo $i; ?>" />
	</div>
	<?php } ?>
</div>