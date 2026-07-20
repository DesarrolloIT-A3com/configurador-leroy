<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE, EL ACABADO Y EL DISEÑO MARCADA PARA VER QUE TERMINACIONES SE PERMITEN
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



// SI SE SELECCIONA PALILLERIA CON ABATIBLE SOLO SE CARGARAN LOS VERTICALES
if($id_diseno == 10 && $id_serie == 5)
{
	if($id_terminacion == 1)// CONSULTA SOLO EN TODO TABLERO
	{
		$puertas = $db->getResults('SELECT p.id, p.imagen FROM puertas as p, disenos_puertas as dp WHERE dp.id_acabados = '.$id_acabado.' AND dp.id_disenos = '.$id_diseno.' AND dp.id_terminaciones =  '.$id_terminacion.' AND dp.id_puertas = p.id AND p.id%2 = 0');
	}
	else // RESTO DE TERMINACIONES DE PALILLERIA
	{
		$puertas = $db->getResults('SELECT p.id, p.imagen FROM puertas as p, disenos_puertas as dp WHERE dp.id_acabados = '.$id_acabado.' AND dp.id_disenos = '.$id_diseno.' AND dp.id_terminaciones =  '.$id_terminacion.' AND dp.id_puertas = p.id AND p.id%2 = 1');
	}
}
else
{
	$puertas = $db->getResults('SELECT p.id, p.imagen FROM puertas as p, disenos_puertas as dp WHERE dp.id_acabados = '.$id_acabado.' AND dp.id_disenos = '.$id_diseno.' AND dp.id_terminaciones = '.$id_terminacion.' AND dp.id_puertas = p.id');
}


$nombre_serie = $db->getVar('SELECT nombre FROM series WHERE id='.$id_serie);
$nombre_acabado = $db->getVar('SELECT nombre FROM acabados WHERE id='.$id_acabado);
?>

<h2>Frentes</h2>
<p><?php echo $nombre_serie; ?> > <?php echo $nombre_acabado; ?> > <?php echo $nombre_diseno; ?> > <?php echo $nombre_terminacion; ?></p>
<p><a class="boton naranja" onClick="cambiar_puerta_terminacion(<?php echo $num_puerta; ?>,<?php echo $id_serie; ?>,<?php echo $id_acabado; ?>,<?php echo $id_diseno; ?>,'<?php echo $nombre_diseno; ?>')"><i class="fa fa-angle-left"></i> Volver</a> </p>
<div class="cambiar_puerta_final">
	<?php foreach($puertas as $puerta){ ?>
	<div class="item_cambiar_puerta">
		<img src="www/img/disenos/<?php echo $id_serie; ?>/<?php echo $id_acabado; ?>/<?php echo $id_diseno; ?>/<?php echo $id_terminacion; ?>/<?php echo $puerta['imagen']; ?>" id_puerta="<?php echo $puerta['id']; ?>" img_puerta="<?php echo $puerta['imagen']; ?>" />
		<?php /*<p><?php echo ucfirst(str_replace('_',' ',str_replace('.jpg','',$puerta['imagen']))); ?></p> */?>
	</div>
	<?php } ?>
</div>