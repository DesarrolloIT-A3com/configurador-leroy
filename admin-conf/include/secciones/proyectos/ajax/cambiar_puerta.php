<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE Y EL ACABADO MARCADA PARA VER QUE DISEÑOS SE PERMITEN
$id_serie = 0;
if(isset($_GET['id_serie']) && $_GET['id_serie'] > 0)			$id_serie = (int)$_GET['id_serie']; 
$id_acabado = 0;
if(isset($_GET['id_acabado']) && $_GET['id_acabado'] > 0)		$id_acabado = (int)$_GET['id_acabado']; 
$num_puerta = 0;
if(isset($_GET['num_puerta']) && $_GET['num_puerta'] > 0)		$num_puerta = (int)$_GET['num_puerta']; 
?>
<div class="cambiar_puerta">
	<h1>
		Seleccionar puerta <?php echo $num_puerta; ?>
	</h1>
	<div class="cuerpo_cambiar_puerta">
		<center><i class="fa fa-spinner fa-spin"></i> Cargando</center>
	</div>
	<div class="copiar_puertas">
		<label><input type="checkbox" id="copiar_puertas" name="copiar_puertas" /> Copiar diseño a todas las puertas</label>
	</div>
	<script type="text/javascript">
		cambiar_puerta_diseno(<?php echo $num_puerta; ?>,<?php echo $id_serie; ?>,<?php echo $id_acabado; ?>);
	</script>
</div>