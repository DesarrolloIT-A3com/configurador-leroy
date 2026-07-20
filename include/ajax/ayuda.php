<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();
?>
<div class="ventana_ayuda">
	<div class="logo">
		<img src="www/img/logo_arjomy.png">
	</div>
	<div class="version">
		Configurador de Armarios<br />
		© <?php echo date('Y'); ?>
	</div>
	<div class="contacto">
		<p>Si tienes cualquier tipo de duda puedes contactar con nosotros en:</p>
		<p><i class="fa fa-phone"></i> <a href="tel:+34918188148">+34 918 188 148</a></p>
		<p><i class="fa fa-envelope"></i> <a href="mailto:info@arjomy.es">info@arjomy.es</a></p>
		<p><i class="fa fa-link"></i> <a href="http://www.arjomy.es" target="_blank">www.arjomy.es</a></p>
	</div>
</div>