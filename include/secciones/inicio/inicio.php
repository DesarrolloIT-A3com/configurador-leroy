<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();
?>
<div id="inicio" class="pantalla_completa">
	<div class="contenido">
		<div class="titulo_superior">
			CONFIGURADOR DE ARMARIOS
		</div>
		<div class="contenedor_botones_inicio">
			<div class="botones_inicio">
				<a class="boton_inicio" href="index.php?seccion=nuevo_proyecto">
					<i class="fa fa-file-text-o"></i>
					<span class="texto_boton">Nuevo proyecto</span>
				</a>
				<a class="boton_inicio" href="index.php?seccion=proyectos">
					<i class="fa fa-folder-open-o"></i>
					<span class="texto_boton">Proyectos guardados</span>
				</a>
				<a class="boton_inicio" href="https://arjomy.es/configurador-leroy-antiguo">
					<i class="fa fa-folder-open-o"></i>
					<span class="texto_boton">Proyectos antiguos</span>
				</a>
				<a class="boton_inicio" href="index.php?seccion=datos_empresa">
					<i class="fa fa-id-card-o"></i>
					<span class="texto_boton">Datos de empresa</span>
				</a>
				<a class="boton_inicio ajax-popup-link" href="index.php?seccion=ajax&sub=soporte">
					<i class="fa fa-life-ring"></i>
					<span class="texto_boton">Soporte</span>
				</a>
				<a class="boton_inicio ajax-popup-link-modal" href="index.php?seccion=ajax&sub=salir">
					<i class="fa fa-sign-out"></i>
					<span class="texto_boton">Cerrar sesión</span>
				</a>
			</div>
		</div>
	</div>
</div>