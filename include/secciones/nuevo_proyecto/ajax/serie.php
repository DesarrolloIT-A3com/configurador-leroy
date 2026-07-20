<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// CONSULTAMOS LOS DATOS DE LAS SERIES
$series = $db->getResults('SELECT id, nombre, imagen FROM series');

$accesoDenegado = [
		'profesionales.madridnuevosministerios@leroymerlin.es',
		'profesionales.alcorcon@leroymerlin.es',
		'profesionales.getafe@leroymerlin.es',
		'profesionales.leganes@leroymerlin.es',
		'profesionales.sansebastian@leroymerlin.es',
		'profesionales.lasrozas@leroymerlin.es',
		'profesionales.rivas2@leroymerlin.es',
		'profesionales.majadahonda2@leroymerlin.es',
		'profesionales.madrida2@leroymerlin.es',
		'profesionales.toledo@leroymerlin.es',
		'profesionales.alcala@leroymerlin.es',
		'profesionales.talavera@leroymerlin.es',
		'profesionales.guadalajara@leroymerlin.es',
		'profesionales.valdepenas@leroymerlin.es',
		'profesionales.cuenca@leroymerlin.es',
		'profesionales.comenar@leroymerlin.es',
		'profesionales.aranjuez@leroymerlin.es',
		'profesionales.avila@leroymerlin.es',
		'profesionales.lopezdehoyos@leroymerlin.es',
		'profesionales.torrejon@leroymerlin.es',
		'profesionales.alcobendas@leroymerlin.es'
	];
?>

<h1>Serie</h1>
<div class="seccion_serie">
	<?php foreach($series as $serie){?>
	<div class="item_seccion_serie">
		<h3><?php echo $serie['nombre']; ?></h3>
		<img src="www/img/series/<?php echo $serie['imagen']; ?>" title="Seleccionar serie <?php echo $serie['nombre']; ?>" id_serie="<?php echo $serie['id']; ?>" nombre_serie="<?php echo $serie['nombre']; ?>" />
		<div><a class="image-popup-link" href="www/img/series/<?php echo $serie['imagen']; ?>" title="Ver imagen"><i class="fa fa-search-plus"></i></a> <a class="ajax-popup-link" href="index.php?seccion=ajax&sub=detalles_serie&id=<?php echo $serie['id']; ?>" title="Detalles"><i class="fa fa-info-circle"></i></a></div>
	</div>
	<?php } ?>
	<?php if (in_array($_SESSION['email'], $accesoDenegado)===false) { ?>
	
		<div class="item_seccion_serie">
			<h3>Solo interior</h3>
			<img src="www/img/series/solo_interior.jpg" title="Configurar solo interior" id_serie="0" nombre_serie="Solo interior" />
			<div><a class="image-popup-link" href="www/img/series/solo_interior.jpg" title="Ver imagen"><i class="fa fa-search-plus"></i></a></div>
		</div>
	<?php } ?>
</div>