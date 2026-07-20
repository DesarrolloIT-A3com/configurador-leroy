</head>
	<body>
		<div class="contenedor">
			<?php if($seccion != 'login' && (isset($_SESSION['admin_logueado']) && $_SESSION['admin_logueado']=="logged")){ ?>
			<div class="cabecera">
				<div class="logo">
					<img src="www/img/logo_arjomy.png"><img src="../www/img/logo_leroy.png">
				</div>
				<div class="texto_cabecera">
					ADMINISTRACIÓN CONFIGURADOR DE ARMARIOS
				</div>
				<div class="menu">
					<a class="boton_menu" href="index.php" title="Inicio"><i class="fa fa-home"></i></a> <a id="boton_salir" class="boton_menu ajax-popup-link-modal" href="index.php?seccion=ajax&sub=salir" title="Cerrar sesión"><i class="fa fa-sign-out"></i></a>
				</div>
			</div>
			<?php } ?>