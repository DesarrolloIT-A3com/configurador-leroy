<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LOS DATOS ENVIADOS 
$num_puerta = 0;
if(isset($_POST['num_puerta']) && $_POST['num_puerta'] > 0)							$num_puerta = (int)$_POST['num_puerta'];
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)								$id_serie = (int)$_POST['id_serie']; 
$id_acabado = 0;
if(isset($_POST['id_acabado']) && $_POST['id_acabado'] > 0)							$id_acabado = (int)$_POST['id_acabado']; 
$id_diseno = 0;
if(isset($_POST['id_diseno']) && $_POST['id_diseno'] > 0)							$id_diseno = (int)$_POST['id_diseno']; 
$nombre_diseno = "";
if(isset($_POST['nombre_diseno']) && $_POST['nombre_diseno'] != "")					$nombre_diseno = $_POST['nombre_diseno'];
$id_terminacion = 0;
if(isset($_POST['id_terminacion']) && $_POST['id_terminacion'] > 0)					$id_terminacion = (int)$_POST['id_terminacion'];
$nombre_terminacion = "";
if(isset($_POST['nombre_terminacion']) && $_POST['nombre_terminacion'] != "")		$nombre_terminacion = $_POST['nombre_terminacion'];
$ancho_puerta = 0;
if(isset($_POST['ancho_puerta']) && $_POST['ancho_puerta'] > 0)						$ancho_puerta = (float)$_POST['ancho_puerta'];

$nombre_serie = $db->getVar('SELECT nombre FROM series WHERE id='.$id_serie);
$nombre_acabado = $db->getVar('SELECT nombre FROM acabados WHERE id='.$id_acabado);

$ceramicas = $db->getResults('SELECT id, nombre, medida FROM ceramicas WHERE id_terminaciones = '.$id_terminacion.' AND medida <= '.($ancho_puerta-20));
?>

<h2>Medida cerámica</h2>
<p><?php echo $nombre_serie; ?> > <?php echo $nombre_acabado; ?> > <?php echo $nombre_diseno; ?> > <?php echo $nombre_terminacion; ?> > Medida cerámica</p>
<p><a class="boton naranja" onClick="cambiar_puerta_final(<?php echo $num_puerta; ?>,<?php echo $id_serie; ?>,<?php echo $id_acabado; ?>,<?php echo $id_diseno; ?>,'<?php echo $nombre_diseno; ?>',<?php echo $id_terminacion; ?>, '<?php echo $nombre_terminacion; ?>')"><i class="fa fa-angle-left"></i> Volver</a> </p>
<h3><center>Ancho de puerta: <?php echo number_format($ancho_puerta,2,".",""); ?> cm.</h3> 
<div class="elegir_ceramica">
	<?php foreach($ceramicas as $ceramica){ ?>
	<div class="item_elegir_ceramica">
		<img src="www/img/disenos/<?php echo $id_terminacion; ?>_ceramica.jpg" width="<?php echo $ceramica['medida']*2; ?>"  id_ceramica="<?php echo $ceramica['id']; ?>" nombre_ceramica="<?php echo $ceramica['nombre']; ?>" />
		<h4><?php echo $ceramica['nombre']; ?></h4>
	</div>
	<?php } ?>
</div>