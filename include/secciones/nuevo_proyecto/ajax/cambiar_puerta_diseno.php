<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE Y EL ACABADO MARCADA PARA VER QUE DISEÑOS SE PERMITEN
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)			$id_serie = (int)$_POST['id_serie']; 
$id_acabado = 0;
if(isset($_POST['id_acabado']) && $_POST['id_acabado'] > 0)		$id_acabado = (int)$_POST['id_acabado']; 
$altura = 0;
if(isset($_POST['altura']) && $_POST['altura'] > 0)				$altura = (int)$_POST['altura']; 
$puertas = 0;
if(isset($_POST['puertas_marcado']) && $_POST['puertas_marcado'] > 0)		$puertas = (int)$_POST['puertas_marcado'];

$nombre_serie = $db->getVar('SELECT nombre FROM series WHERE id='.$id_serie);
$nombre_acabado = $db->getVar('SELECT nombre FROM acabados WHERE id='.$id_acabado);

$excluir = "";
if($altura > 250){
	$excluir = "AND id_disenos <> 5 AND id_disenos <> 6 AND id_disenos <> 8 AND id_disenos <> 9";
}
if($puertas > 3)
{
	$excluir .= " AND id_disenos <> 10";
}

$disenos = $db->getResults('SELECT id, nombre, imagen FROM disenos WHERE id IN (SELECT id_disenos FROM series_acabados_disenos_terminaciones WHERE id_series = '.$id_serie.' AND id_acabados = '.$id_acabado.' '.$excluir.')');
?>

<h2>Diseño</h2>
<p><?php echo $nombre_serie; ?> > <?php echo $nombre_acabado; ?></p>
<div class="cambiar_puerta_diseno">
	<?php foreach($disenos as $diseno){ ?>
	<div class="item_cambiar_puerta">
		<img src="www/img/disenos/<?php echo $id_serie; ?>/<?php echo $id_acabado; ?>/<?php echo $diseno['id']; ?>/<?php echo $diseno['imagen']; ?>" id_diseno="<?php echo $diseno['id']; ?>" nombre_diseno="<?php echo $diseno['nombre']; ?>" />
		<h4><?php echo $diseno['nombre']; ?></h4>
	</div>
	<?php } ?>
</div>