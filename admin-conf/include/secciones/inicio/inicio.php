<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();
?>
<div id="inicio" class="pantalla_completa">
	<div class="contenido">
		<div class="titulo_superior">
			MENÚ PRINCIPAL
		</div>
		<div class="contenedor_botones_inicio">
			<div class="botones_inicio">
				<a class="boton_inicio" href="index.php?seccion=solicitudes">
					<i class="fa fa-file-text-o"></i>
					<span class="texto_boton">Solicitudes de acceso</span>
				</a>
				<a class="boton_inicio" href="index.php?seccion=usuarios">
					<i class="fa fa-folder-open-o"></i>
					<span class="texto_boton">Usuarios configurador</span>
				</a>
				<a class="boton_inicio" href="https://arjomy.es/configurador-leroy-antiguo/admin-conf">
					<i class="fa fa-folder-open-o"></i>
					<span class="texto_boton">Ir a gestión configurador antiguo</span>
				</a>
				<a class="boton_inicio ajax-popup-link-modal" href="index.php?seccion=ajax&sub=salir">
					<i class="fa fa-sign-out"></i>
					<span class="texto_boton">Cerrar sesión</span>
				</a>
			</div>
		</div>
	</div>
</div>