</head>
	<body>
		<div class="contenedor">
			<?php if($seccion != 'login' && (isset($_SESSION['logueado']) && $_SESSION['logueado']=="logged")){ ?>
			<div class="cabecera">
				<div class="logo">
					<img src="www/img/logo_arjomy.png"><img src="www/img/logo_leroy.png">
				</div>
				<div class="texto_cabecera">
					<?php echo $_SESSION['nombre_usuario']; ?>
				</div>
				<div class="menu">
					<a class="boton_menu ajax-popup-link" href="index.php?seccion=ajax&sub=soporte" title="Soporte"><i class="fa fa-life-ring"></i></a>
					<a id="boton_salir" class="boton_menu ajax-popup-link-modal" href="index.php?seccion=ajax&sub=salir" title="Cerrar sesión"><i class="fa fa-sign-out"></i></a>
				</div>
			</div>
			<?php } ?>