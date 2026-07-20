<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();
?>

<h1>Interior</h1>
<div class="seccion_interior">
	<div class="deseas_interior">
		<h2>¿Deseas añadir un interior?</h2><br />
		<a class="boton grande verde" onClick="modulos_interior();">Si, añadir un interior</a><br /><br />
		<a class="boton grande naranja" onClick="continuar_extras();">No, continuar en Extras</a>
	</div>
</div>

<script type="text/javascript">
	var accesoDenegado = [
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
	var email = '<?php echo $_SESSION['email']; ?>';
	if (accesoDenegado.includes(email)) {
		continuar_extras();
		$('.deseas_interior').hide();
	}
</script>