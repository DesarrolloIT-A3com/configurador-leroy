<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE, EL ACABADO Y EL DISEÑO MARCADA PARA VER QUE TERMINACIONES SE PERMITEN
$num_puerta = 0;
if(isset($_POST['num_puerta']) && $_POST['num_puerta'] > 0)				$num_puerta = (int)$_POST['num_puerta'];
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)					$id_serie = (int)$_POST['id_serie']; 
$id_acabado = 0;
if(isset($_POST['id_acabado']) && $_POST['id_acabado'] > 0)				$id_acabado = (int)$_POST['id_acabado']; 
$id_diseno = 0;
if(isset($_POST['id_diseno']) && $_POST['id_diseno'] > 0)				$id_diseno = (int)$_POST['id_diseno']; 
$nombre_diseno = "";
if(isset($_POST['nombre_diseno']) && $_POST['nombre_diseno'] != "")		$nombre_diseno = $_POST['nombre_diseno'];
$ancho_puerta = 0;
if(isset($_POST['ancho_puerta']) && $_POST['ancho_puerta'] != "")		$ancho_puerta = $_POST['ancho_puerta'];


$terminaciones = $db->getResults('	SELECT 
										t.id as id, 
										t.nombre as nombre, 
										p.imagen as imagen 
									FROM 
										terminaciones as t, 
										puertas as p
									WHERE 
										t.id IN 
											(SELECT 
												id_terminaciones
											FROM 
												series_acabados_disenos_terminaciones
											WHERE
												id_series = '.$id_serie.' AND
												id_acabados = '.$id_acabado.' AND
												id_disenos = '.$id_diseno.') 		
										AND
										p.id = (SELECT 
													id_puertas
												FROM
													disenos_puertas
												WHERE
													id_acabados = '.$id_acabado.' AND
													id_disenos = '.$id_diseno.' AND
													id_terminaciones = t.id
												LIMIT 1)
										AND
										t.id <> 7 
										AND
										t.id <> 8 
										AND
										t.id <> 9 ');  // EN LEROY NO EXISTEN ESTA TERMINACIONES 7, 8 Y 9
												
$nombre_serie = $db->getVar('SELECT nombre FROM series WHERE id='.$id_serie);
$nombre_acabado = $db->getVar('SELECT nombre FROM acabados WHERE id='.$id_acabado);
?>
<h2>Terminación</h2>
<p><?php echo $nombre_serie; ?> > <?php echo $nombre_acabado; ?> > <?php echo $nombre_diseno; ?></p>
<p><a class="boton naranja" onClick="cambiar_puerta_diseno(<?php echo $num_puerta; ?>,<?php echo $id_serie; ?>,<?php echo $id_acabado; ?>)"><i class="fa fa-angle-left"></i> Volver</a> </p>
<div class="cambiar_puerta_terminacion">
	<?php foreach($terminaciones as $terminacion){ ?>
		<?php if(($terminacion['id'] != 20 && $terminacion['id'] != 21) || $ancho_puerta > 50){ // COMPROBAMOS QUE SI ES CERÁMICA CIRCULO O CUADRADO NO MIDA MENOS DE 50 ?>
	<div class="item_cambiar_puerta">
		<img src="www/img/disenos/<?php echo $id_serie; ?>/<?php echo $id_acabado; ?>/<?php echo $id_diseno; ?>/<?php echo $terminacion['id']; ?>/<?php echo $terminacion['imagen']; ?>" id_terminacion="<?php echo $terminacion['id']; ?>" nombre_terminacion="<?php echo $terminacion['nombre']; ?>" />
		<h4><?php echo $terminacion['nombre']; ?></h4>
	</div>
		<?php } ?>
	<?php } ?>
</div>