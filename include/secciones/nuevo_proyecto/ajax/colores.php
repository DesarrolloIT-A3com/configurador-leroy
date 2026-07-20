<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE MARCADA PARA VER QUE TABLEROS SE LE PERMITEN
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)						$id_serie = (int)$_POST['id_serie']; 
$id_acabado = 0;
if(isset($_POST['id_acabado']) && $_POST['id_acabado'] > 0)					$id_acabado = (int)$_POST['id_acabado']; 
// VEMOS EL NÚMERO DE PUERTAS ELEGIDO
$num_puertas = 0;
if(isset($_POST['num_puertas']) && $_POST['num_puertas'] > 0)				$num_puertas = (int)$_POST['num_puertas']; 
// DISEÑO DE CADA PUERTA
$diseno_puerta_1 = "";
if(isset($_POST['diseno_puerta_1']) && $_POST['diseno_puerta_1'] != "")		$diseno_puerta_1 = explode("-",$_POST['diseno_puerta_1']); 
$diseno_puerta_2 = "";
if(isset($_POST['diseno_puerta_2']) && $_POST['diseno_puerta_2'] != "")		$diseno_puerta_2 = explode("-",$_POST['diseno_puerta_2']); 
$diseno_puerta_3 = "";
if(isset($_POST['diseno_puerta_3']) && $_POST['diseno_puerta_3'] != "")		$diseno_puerta_3 = explode("-",$_POST['diseno_puerta_3']); 
$diseno_puerta_4 = "";
if(isset($_POST['diseno_puerta_4']) && $_POST['diseno_puerta_4'] != "")		$diseno_puerta_4 = explode("-",$_POST['diseno_puerta_4']); 
$diseno_puerta_5 = "";
if(isset($_POST['diseno_puerta_5']) && $_POST['diseno_puerta_5'] != "")		$diseno_puerta_5 = explode("-",$_POST['diseno_puerta_5']); 
$diseno_puerta_6 = "";
if(isset($_POST['diseno_puerta_6']) && $_POST['diseno_puerta_6'] != "")		$diseno_puerta_6 = explode("-",$_POST['diseno_puerta_6']); 
$diseno_puerta_7 = "";
if(isset($_POST['diseno_puerta_7']) && $_POST['diseno_puerta_7'] != "")		$diseno_puerta_7 = explode("-",$_POST['diseno_puerta_7']); 
$diseno_puerta_8 = "";
if(isset($_POST['diseno_puerta_8']) && $_POST['diseno_puerta_8'] != "")		$diseno_puerta_8 = explode("-",$_POST['diseno_puerta_8']); 
?>

<h1>Colores</h1>
<div class="seccion_colores puertas-<?php echo $num_puertas; ?>">	
	<?php for($i = 1 ; $i <= $num_puertas ; $i++){ ?>
	<?php $img_puerta = $db->getVar('SELECT imagen FROM puertas WHERE id='.${"diseno_puerta_" . $i}[2]); ?>
	<div class="item_seccion_colores">
		<h3>P<?php echo $i; ?></h3>
		<img id="puerta-<?php echo $i; ?>" src="www/img/disenos/<?php echo $id_serie; ?>/<?php echo $id_acabado; ?>/<?php echo ${"diseno_puerta_" . $i}[0]; ?>/<?php echo ${"diseno_puerta_" . $i}[1]; ?>/<?php echo $img_puerta; ?>" title="Colores puerta <?php echo $i; ?>" num_puerta="<?php echo $i; ?>" />
	</div>
	<?php } ?>
</div>