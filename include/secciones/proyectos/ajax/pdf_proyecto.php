<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] != "logged")
	die();

$distribuidor = $db->getRow('SELECT um.nombre, um.cif, um.direccion, um.poblacion, um.cp, um.provincia, um.email, um.telefono FROM usuarios_mod as um, usuarios as u WHERE um.id=u.id_usuarios_mod AND u.id=' . $_SESSION['id_usuario']);

$proyecto = $db->getRow('SELECT id_usuario, id_tarifa, descuento, id_serie, id_acabado, id_color_perfileria, ancho, alto, fondo, num_puertas, diseno_puerta_1, diseno_puerta_2, diseno_puerta_3, diseno_puerta_4, diseno_puerta_5, diseno_puerta_6, diseno_puerta_7, diseno_puerta_8, ceramica_puerta_1, ceramica_puerta_2, ceramica_puerta_3, ceramica_puerta_4, ceramica_puerta_5, ceramica_puerta_6, ceramica_puerta_7, ceramica_puerta_8, colores_puerta_1, colores_puerta_2, colores_puerta_3, colores_puerta_4, colores_puerta_5, colores_puerta_6, colores_puerta_7, colores_puerta_8, num_modulos_interior, interior_puerta_1, interior_puerta_2, interior_puerta_3, interior_puerta_4, interior_puerta_5, interior_puerta_6, interior_puerta_7, interior_puerta_8, laterales_seleccionado, tapetas_seleccionado, costados_seleccionado, fijos_seleccionado, montaje_frente_seleccionado, montaje_interior_seleccionado, desmontaje_frente_seleccionado, desmontaje_interior_seleccionado, juego_led_seleccionado, rematar_frente_seleccionado, rematar_interior_seleccionado, montaje_frente_arjomy_seleccionado, montaje_interior_arjomy_seleccionado, desmontaje_frente_arjomy_seleccionado, desmontaje_interior_arjomy_seleccionado, juego_led_arjomy_seleccionado, rematar_frente_arjomy_seleccionado, sistema_frenos_seleccionado, regleta_led_seleccionado, frente_abuardillado_seleccionado, albanileria_con_seleccionado, albanileria_sin_seleccionado, precio_frente, inc_desc_frente, cant_inc_desc_frente, precio_ceramica, precio_modulos_interior, precio_accesorios_interior, inc_desc_interior, cant_inc_desc_interior, precio_tapetas, precio_laterales, precio_costados, precio_fijos, precio_montaje_frente, precio_montaje_interior, precio_desmontaje_frente, precio_desmontaje_interior, precio_juego_led, precio_rematar_frente, precio_rematar_interior, precio_sistema_frenos, precio_regleta_led, precio_frente_abuardillado, precio_albanileria_con, precio_albanileria_sin, precio_costados_dist, precio_fijos_dist, precio_montaje_frente_dist, precio_montaje_interior_dist, precio_desmontaje_frente_dist, precio_desmontaje_interior_dist, precio_juego_led_dist, precio_rematar_frente_dist, precio_sistema_frenos_dist, aplicar_descuento, descuento_cliente, porcentaje_iva, iva, precio_total, observaciones, nombre_cliente, dni_cliente, direccion_cliente, poblacion_cliente, cp_cliente, provincia_cliente, telefono_cliente, email_cliente, horario_cliente, fecha_proyecto, precio_km_medicion, precio_km_montaje, precio_extras_1, precio_extras_2, precio_extras_3, precio_extras_4, precio_extras_5, precio_extras_6, precio_extras_7, precio_extras_8, precio_extras_9, precio_extras_10, precio_extras_11, precio_extras_12, precio_extras_13, precio_desmontaje, precio_albanileria_sencilla, precio_albanileria_tirar_tabique, precio_albanileria_quitar_solera, precio_albanileria_mover_enchufe, precio_albanileria_costado_pladur FROM proyectos WHERE id_usuario=' . $_SESSION['id_usuario'] . ' AND id=' . $id . ' AND eliminado=0');

$diseno_puerta_1 = explode("-", $proyecto['diseno_puerta_1']);
$diseno_puerta_2 = explode("-", $proyecto['diseno_puerta_2']);
$diseno_puerta_3 = explode("-", $proyecto['diseno_puerta_3']);
$diseno_puerta_4 = explode("-", $proyecto['diseno_puerta_4']);
$diseno_puerta_5 = explode("-", $proyecto['diseno_puerta_5']);
$diseno_puerta_6 = explode("-", $proyecto['diseno_puerta_6']);
$diseno_puerta_7 = explode("-", $proyecto['diseno_puerta_7']);
$diseno_puerta_8 = explode("-", $proyecto['diseno_puerta_8']);
$colores_puerta_1 = explode("-", $proyecto['colores_puerta_1']);
$colores_puerta_2 = explode("-", $proyecto['colores_puerta_2']);
$colores_puerta_3 = explode("-", $proyecto['colores_puerta_3']);
$colores_puerta_4 = explode("-", $proyecto['colores_puerta_4']);
$colores_puerta_5 = explode("-", $proyecto['colores_puerta_5']);
$colores_puerta_6 = explode("-", $proyecto['colores_puerta_6']);
$colores_puerta_7 = explode("-", $proyecto['colores_puerta_7']);
$colores_puerta_8 = explode("-", $proyecto['colores_puerta_8']);
$interior_puerta_1 = explode("-", $proyecto['interior_puerta_1']);
$interior_puerta_2 = explode("-", $proyecto['interior_puerta_2']);
$interior_puerta_3 = explode("-", $proyecto['interior_puerta_3']);
$interior_puerta_4 = explode("-", $proyecto['interior_puerta_4']);
$interior_puerta_5 = explode("-", $proyecto['interior_puerta_5']);
$interior_puerta_6 = explode("-", $proyecto['interior_puerta_6']);
$interior_puerta_7 = explode("-", $proyecto['interior_puerta_7']);
$interior_puerta_8 = explode("-", $proyecto['interior_puerta_8']);

$serie = $db->getVar('SELECT nombre FROM series WHERE id=' . $proyecto['id_serie']);
$acabado = $db->getVar('SELECT nombre FROM acabados WHERE id=' . $proyecto['id_acabado']);
$perfileria = $db->getRow('SELECT nombre, imagen FROM colores WHERE id=' . $proyecto['id_color_perfileria']);

$html = '
<html>
	<head>
		<meta charset="utf-8" />
		<title>Imprimir</title>
		<link rel="icon" type="image/png" href="www/img/logo_arjomy.png">
		
		<link rel="stylesheet" type="text/css" href="www/css/font-awesome.min.css" />
		<style>
			@font-face {
				font-family: "Roboto";
				src: url("libs/dompdf/lib/fonts/Roboto-Regular.ttf") format("truetype");
				font-weight: normal;
				font-style: normal;
			}
			
			@font-face {
				font-family: "Roboto";
				src: url("libs/dompdf/lib/fonts/Roboto-Bold.ttf") format("truetype");
				font-weight: bold;
				font-style: normal;
			}
			
			@font-face {
				font-family: "RobotoCondensed";
				src: url("libs/dompdf/lib/fonts/RobotoCondensed-Regular.ttf") format("truetype");
				font-weight: normal;
				font-style: normal;
			}
			
			@font-face {
				font-family: "RobotoCondensed";
				src: url("libs/dompdf/lib/fonts/RobotoCondensed-Bold.ttf") format("truetype");
				font-weight: bold;
				font-style: normal;
			}
			
			*{
				margin:0;
				padding:0
			}
			
			@page {
				margin: 0mm;
				margin-top: 15mm;
			}
		
			body{
				background-color: #FFFFFF;
				color: #000000;
				font-family: Roboto, Arial, sans-serif;
				font-size: 12px;
				margin:0px;
			}
						
			.izquierda{
				text-align: left;
			}
			
			.derecha{
				text-align: right;
			}
			
			.centrado{
				text-align: center;
			}
			
			table{
				width:100%;
			}
			
			h2{
				font-family: RobotoCondensed, Arial, sans-serif;
				color: #444444;
				border-bottom: 1px solid #dddddd;
				margin-bottom: 6px;
				font-size: 18px;
			}
			
			.h3{
				font-family: RobotoCondensed, Arial, sans-serif;
				color: #444444;
				border-bottom: 1px solid #dddddd;
				margin-bottom: 6px;
				font-size: 16px;
			}
			
			.item_fila_proyecto_datos_interior h4{
				font-family: RobotoCondensed, Arial, sans-serif;
				color: #444444;
				border-bottom: 1px solid #dddddd;
				margin-bottom: 6px;
				font-size: 16px;
			}
		</style>
	</head>
	<body>
		<div style="float: left; width: 100%; margin: 10mm;">
			<table>
				<tr>
					<td class="izquierda" style="width:130px; padding-right:20px;">
						<img src="www/img/logo_arjomy.png" style="width:100%"; />
					</td>
					<td class="izquierda" style="width:130px;">
						<img src="www/img/logo_leroy.png" style="width:100%"; />
					</td>
					<td  style="text-align:right; font-size: 12px">
						<h3>Distribuidor</h3>
						<b>' . $distribuidor['nombre'] . '</b><br />
						' . $distribuidor['cif'] . '<br />
						' . $distribuidor['direccion'] . '<br />
						' . $distribuidor['cp'] . ' - ' . $distribuidor['poblacion'] . ' (' . $distribuidor['provincia'] . ')<br />
						' . $distribuidor['email'] . '<br />
						' . $distribuidor['telefono'] . '
					</td>
				</tr>
			</table>
			<table style="margin-top: 10mm">
				<tr>
					<td class="izquierda" style="width: 60%; font-size: 20px; font-weight: bold;">
						PROYECTO P' . str_pad($id, 6, "0", STR_PAD_LEFT) . '
					</td>
					<td class="derecha" style="width: 40%; font-size: 20px; font-weight: bold;">
						<img src="www/img/calendario.jpg" style="width: 18px; margin-top:2px" /> ' . date("d/m/Y", strtotime($proyecto['fecha_proyecto'])) . '
					</td>
				</tr>
			</table>
			
			<table style="margin-top: 10mm">
				<tr>
					<td>
						<h2>Cliente</h2>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td style="margin-right: 20px;">
						' . $proyecto['nombre_cliente'] . '<br />
						' . $proyecto['dni_cliente'] . '<br />
						' . $proyecto['direccion_cliente'] . '<br />
						' . $proyecto['cp_cliente'] . ' - ' . $proyecto['poblacion_cliente'] . '<br />
						' . $proyecto['provincia_cliente'] . '
					</td>
					<td>
						<img src="www/img/mail.jpg" style="margin-top: 1px; width: 12px;" /> ' . $proyecto['email_cliente'] . '<br />
						<img src="www/img/telefono.jpg" style="margin-top: 1px; width: 12px;" /> ' . $proyecto['telefono_cliente'] . '<br />
						<img src="www/img/horario.jpg" style="margin-top: 1px; width: 12px;" /> ' . $proyecto['horario_cliente'] . '
					</td>
				</tr>
			</table>

			<table style="margin-top: 10mm;">
				<tr>
					<td style="width: 33.33%; box-sizing: border-box; padding-right: 10px; vertical-align: top;">
						<h2>Serie</h2>';
if ($serie) {
	$html .= $serie;
} else {
	$html .= "Solo interior";
}
$html .= '
					</td>
					<td style="width: 33.33%; box-sizing: border-box; padding: 0px 10px; vertical-align: top;">
						<h2>Acabado</h2>';
if ($acabado) {
	$html .= $acabado;
} else {
	$html .= "-";
}
$html .= '
					</td>
					<td style="width: 33.33%; box-sizing: border-box; padding-left: 10px; vertical-align: top;">
						<h2>Color perfilería</h2>';
if ($perfileria) {
	$html .= $perfileria['nombre'] . '<br /><img src="www/img/colores/' . $perfileria['imagen'] . '" title="' . $perfileria['nombre'] . '" width="100px" />';
} else {
	$html .= "-";
}
$html .= '
					</td>
				</tr>
				<tr>
					<td style="width: 33.33%; box-sizing: border-box; padding-right: 10px; vertical-align: top;">
						<h2>Medidas totales</h2>
						Alto: ' . $proyecto['alto'] . 'cm.<br />Ancho: ' . $proyecto['ancho'] . 'cm.<br />Fondo: ' . $proyecto['fondo'] . '
					</td>
					<td style="width: 33.33%; box-sizing: border-box; padding: 0px 10px; vertical-align: top;">
						<h2>Nº Puertas</h2>
						' . $proyecto['num_puertas'] . '
					</td>
				</tr>
			</table>';

if ($serie) { // Si no es solo interior

	$html .= '			
			<table style="margin-top: 10mm;">
				<tr>
					<td>
						<h2>Frente</h2>
					</td>
				</tr>
				<tr>
					<td>
						<table style="width: auto" cellspacing="0">
							<tr>';
	for ($i = 1; $i <= $proyecto['num_puertas']; $i++) {
		$img_puerta = $db->getVar('SELECT imagen FROM puertas WHERE id=' . ${"diseno_puerta_" . $i}[2]);
		$html .= '
								<td style="width: 87px;">
									<h3 style="text-align: center; margin-top: 20px;">P' . $i . '</h3>
									<img id="puerta-' . $i . '" src="www/img/disenos/' . $proyecto['id_serie'] . '/' . $proyecto['id_acabado'] . '/' . ${"diseno_puerta_" . $i}[0] . '/' . ${"diseno_puerta_" . $i}[1] . '/' . $img_puerta . '" width="100%" />
								</td>';
	}
	$html .= '
							</tr>
						</table>
					</td>
				</tr>
			</table>
			
			<div style="display:block; page-break-after: always;"></div>
			
			<table style="margin-top: 10mm">
				<tr>
					<td class="izquierda" style="width:130px; padding-right:20px;">
						<img src="www/img/logo_arjomy.png" style="width:100%"; />
					</td>
					<td class="izquierda" style="width:130px;">
						<img src="www/img/logo_leroy.png" style="width:100%"; />
					</td>
					<td  style="text-align:right; font-size: 12px">
						<h3>Distribuidor</h3>
						<b>' . $distribuidor['nombre'] . '</b><br />
						' . $distribuidor['cif'] . '<br />
						' . $distribuidor['direccion'] . '<br />
						' . $distribuidor['cp'] . ' - ' . $distribuidor['poblacion'] . ' (' . $distribuidor['provincia'] . ')<br />
						' . $distribuidor['email'] . '<br />
						' . $distribuidor['telefono'] . '
					</td>
				</tr>
			</table>
			
			<table>
				<tr>';

	$contador = 0; // para ver si termina en par o impar para completar
	for ($i = 1; $i <= $proyecto['num_puertas']; $i++) {
		$contador = $i;

		if ($i == 5) {
			$html .= '
				</tr>
			</table>
			
			<div style="display:block; page-break-after: always;"></div>
			
			<table style="margin-top: 10mm">
				<tr>
					<td class="izquierda" style="width:130px; padding-right:20px;">
						<img src="www/img/logo_arjomy.png" style="width:100%"; />
					</td>
					<td class="izquierda" style="width:130px;">
						<img src="www/img/logo_leroy.png" style="width:100%"; />
					</td>
					<td  style="text-align:right; font-size: 12px">
						<h3>Distribuidor</h3>
						<b>' . $distribuidor['nombre'] . '</b><br />
						' . $distribuidor['cif'] . '<br />
						' . $distribuidor['direccion'] . '<br />
						' . $distribuidor['cp'] . ' - ' . $distribuidor['poblacion'] . ' (' . $distribuidor['provincia'] . ')<br />
						' . $distribuidor['email'] . '<br />
						' . $distribuidor['telefono'] . '
					</td>
				</tr>
			</table>
			
			<table>
				<tr>';
		}

		if ($i == 3 || $i == 7) {
			$html .= '
				</tr>
			</table>
			<table>
				<tr>';
		}

		$diseno_puerta = $db->getRow('SELECT d.nombre as diseno, t.nombre as terminacion FROM disenos as d, terminaciones as t WHERE d.id=' . ${"diseno_puerta_" . $i}[0] . ' AND t.id=' . ${"diseno_puerta_" . $i}[1]);
		$html .= '
					<td style="width: 48%; margin: 0 1%; height: 440px; vertical-align: top;">
						<h3 style="width: 95%; border-bottom: 1px solid #dddddd; margin-bottom: 6px;">Puerta ' . $i . '</h3>
						<table>
							<tr>
								<td style="vertical-align:top">
									<h4>Diseño</h4>
									' . $diseno_puerta['diseno'] . '<br />
									' . $diseno_puerta['terminacion'] . '<br />';
		if ($diseno_puerta['terminacion'] == 20 || $diseno_puerta['terminacion'] == 21) {
			$ceramica = $db->getVar('SELECT nombre FROM ceramicas WHERE id=' . $proyecto['ceramica_puerta_' . $i]);
			$html .= $ceramica;
		}
		$img_puerta = $db->getVar('SELECT imagen FROM puertas WHERE id=' . ${"diseno_puerta_" . $i}[2]);
		$html .= '
									<img id="puerta-diseno-' . $i . '" src="www/img/disenos/' . $proyecto['id_serie'] . '/' . $proyecto['id_acabado'] . '/' . ${"diseno_puerta_" . $i}[0] . '/' . ${"diseno_puerta_" . $i}[1] . '/' . $img_puerta . '" style="width: 80px; margin-top: 20px;" />
								</td>
								<td style="vertical-align:top">
									<h4>Colores</h4>';
		$zonas_puerta = $db->getResults('SELECT pz.zona as zona, pz.id_colores_tipo as id_colores_tipo, ct.nombre as tipo FROM puertas_zonas as pz, disenos_puertas as dp, colores_tipo as ct WHERE pz.id_disenos_puertas = dp.id AND pz.id_colores_tipo = ct.id AND dp.id_acabados = ' . $proyecto['id_acabado'] . ' AND dp.id_disenos = ' . ${"diseno_puerta_" . $i}[0] . ' AND dp.id_terminaciones = ' . ${"diseno_puerta_" . $i}[1] . ' AND dp.id_puertas = ' . ${"diseno_puerta_" . $i}[2] . ' ORDER BY pz.zona');

		// CONTADORES PARA COLORES TIPO
		$contador_1 = 0; // Melamina
		$contador_2 = 0; // Melamina especial
		$contador_3 = 0; // Cristal
		$contador_4 = 0; // Estuco
		$contador_5 = 0; // Barnizado
		$contador_6 = 0; // Lacado
		$contador_7 = 0; // Cerámica
		$contador_8 = 0; // Espejo
		$contador_9 = 0; // Serigrafía
		$contador_10 = 0; // Cinta
		$contador_12 = 0; // Pico gorrion
		$contador_13 = 0; // Pantografiado
		$contador_14 = 0; //Melamina palilleria
		foreach ($zonas_puerta as $index => $zona_puerta) {
			// Comprobamos si hay más del mismo tipo para ponerle el número detrás o no
			$hay_mas = false;
			if (isset($zonas_puerta[$index + 1]['id_colores_tipo']) && $zona_puerta['id_colores_tipo'] == $zonas_puerta[$index + 1]['id_colores_tipo']) {
				$hay_mas = true;
			}

			${'contador_' . $zona_puerta['id_colores_tipo']}++; // Aumentamos el contador de ese tipo

			$nombre_zona = (${'contador_' . $zona_puerta['id_colores_tipo']} > 1 || $hay_mas) ? $zona_puerta['tipo'] . " " . ${'contador_' . $zona_puerta['id_colores_tipo']} : $zona_puerta['tipo'];

			// SE OBTIENEN LOS DATOS CORRESPONDIENTES
			$nombre_color_zona = "";
			$imagen_color_zona = "";
			if (isset(${"colores_puerta_" . $i}[$index]) && ${"colores_puerta_" . $i}[$index] > 0) {
				$color_zona = $db->getRow('SELECT nombre, imagen FROM colores WHERE id = ' . ${"colores_puerta_" . $i}[$index]);
				$nombre_color_zona = $color_zona['nombre'];
				$imagen_color_zona = $color_zona['imagen'];
			}
			$html .= '
									<h5 style="margin-top: 5px; margin-bottom: 0px;">' . $nombre_zona . '</h5>
									<div>&nbsp;&nbsp;&nbsp;<span style="font-size: 11px;">' . $nombre_color_zona . '</span><br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/' . $imagen_color_zona . '" style="width: 75px; margin-bottom: 5px; margin-top:3px;" /></div>';
		}
		$html .= '
								</td>
							</tr>
						</table>
					</td>';
	}
	if ($contador % 2 != 0) {
		$html .= '
					<td style="width: 48%; margin: 0 1%; height: 440px;">
						&nbsp;
					</td>';
	}

	$html .= '
				</tr>
			</table>';
}

if ($proyecto['num_modulos_interior'] > 0) {  // SI HAY INTERIOR
	$modulos_dobles = $proyecto['num_puertas'] - $proyecto['num_modulos_interior'];
	$modulos_simples = $proyecto['num_modulos_interior'] - $modulos_dobles;
	$html .= '
			
			<div style="display:block; page-break-after: always;"></div>
			
			<table style="margin-top: 10mm">
				<tr>
					<td class="izquierda" style="width:130px; padding-right:20px;">
						<img src="www/img/logo_arjomy.png" style="width:100%"; />
					</td>
					<td class="izquierda" style="width:130px;">
						<img src="www/img/logo_leroy.png" style="width:100%"; />
					</td>
					<td  style="text-align:right; font-size: 12px">
						<h3>Distribuidor</h3>
						<b>' . $distribuidor['nombre'] . '</b><br />
						' . $distribuidor['cif'] . '<br />
						' . $distribuidor['direccion'] . '<br />
						' . $distribuidor['cp'] . ' - ' . $distribuidor['poblacion'] . ' (' . $distribuidor['provincia'] . ')<br />
						' . $distribuidor['email'] . '<br />
						' . $distribuidor['telefono'] . '
					</td>
				</tr>
			</table>
			
			<table>
				<tr>
					<td>
						<h2>Interior</h2>
						<table style="margin-top: 10mm;" cellspacing="0">
							<tr>';

	$num_modulo = 0;
	for ($j = 1; $j <= $modulos_dobles; $j++) {
		$num_modulo++;

		$html .= '
								<td style="width: 87px; text-align: center;">
									<h3 style="text-align: center;">M' . $num_modulo . '</h3>
									<center>(Doble)</center>';
		$html .= '
									<img id="img_modulo_' . $num_modulo . '" src="www/img/interiores/modulo-' . ${'interior_puerta_' . $num_modulo}[1] . '.jpg" style="width: 100%;" />
								</td>';
	}
	for ($j = 1; $j <= $modulos_simples; $j++) {
		$num_modulo++;

		$html .= '
								<td style="width: 87px; text-align: center;">
									<h3 style="text-align: center;">M' . $num_modulo . '</h3>
									<center>(Simple)</center>';
		$html .= '
									<img id="img_modulo_' . $num_modulo . '" src="www/img/interiores/modulo-' . ${'interior_puerta_' . $num_modulo}[1] . '.jpg" style="width: 100%;" />
								</td>';
	}
	if ($num_modulo < 8) {
		for ($j = 1; $j <= 8 - $num_modulo; $j++) {

			$html .= '
								<td style="width: 87px; text-align: center;">
								</td>';
		}
	}

	$html .= '
							</tr>
						</table>
						
						
						
						<table style="margin-top: 10mm;" cellspacing="0">
							<tr>';
	$num_modulo = 0;
	for ($j = 1; $j <= $modulos_dobles; $j++) {
		$num_modulo++;

		//Si es el módulo 5 hacemos otra fila
		if ($num_modulo == 5) {
			$html .= '
							</tr>
							<tr>';
		}

		if (count(${'interior_puerta_'.$num_modulo}) > 9) 
		{
			$color_interior = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[28]);
			$color_cantoneras = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[29]);
		}
		else 
		{
			$color_interior = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[7]);
			$color_cantoneras = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[8]);
		}
		$html .= '
								<td class="item_fila_proyecto_datos_interior" style="width: 25%; padding: 12px 1%; vertical-align:top;">
									<h4>M' . $num_modulo . '</h4>
									Módulo ' . ${'interior_puerta_' . $num_modulo}[1] . '<br />
									Doble<br />';
		if (${'interior_puerta_' . $num_modulo}[2] > 0) {
			$html .= 'Zapatero/s con freno<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[3] > 0) {
			$html .= 'Cajon/es con freno<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[4] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[4] . ' x J. celdillas<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[5] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[5] . ' x Frente cristal<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[6] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[6] . ' x Cerradura<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[15] > 0) {
    		$html .= ${'interior_puerta_' . $num_modulo}[15] . ' x Cajoneras Lacadas<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[16] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[16] . ' x Pantalonero premium<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[17] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[17] . ' x Zapatero premium<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[18] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[18] . ' x Cesta premium<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[19] != "undefined" && ${'interior_puerta_' . $num_modulo}[19] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[19] . ' x Cajones de 8<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[20] != "undefined" && ${'interior_puerta_' . $num_modulo}[20] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[20] . ' x Cajones de 16<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[21] != "undefined" && ${'interior_puerta_' . $num_modulo}[21] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[21] . ' x Cajones de 20<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[22] != "undefined" && ${'interior_puerta_' . $num_modulo}[22] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[22] . ' x Cajones de 32<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[23] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[24] . ' x ';
			if (${'interior_puerta_' . $num_modulo}[23] == 1) {
				$html .= 'Cristal Transparente<br />';
			} else if (${'interior_puerta_' . $num_modulo}[23] == 2) {
				$html .= 'Cristal Matel<br />';
			}
		}
		if (${'interior_puerta_' . $num_modulo}[25] != "") {
			$html .= 'Gama: ' . ${'interior_puerta_' . $num_modulo}[25] . '<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[26] != "") {
			$html .= 'Modelo: ' . ${'interior_puerta_' . $num_modulo}[26] . '<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[27] != "") {
			$html .= 'Color: ' . ${'interior_puerta_' . $num_modulo}[27] . '<br />';
		}

		$html .= 'Color<br />&nbsp;&nbsp;&nbsp;' . $color_interior['nombre'] . '<br /><br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/' . $color_interior['imagen'] . '" title="' . $color_interior['nombre'] . '" style="width: 75px; margin-bottom: 5px; margin-top:3px;" /><br />
									Cantoneras<br />&nbsp;&nbsp;&nbsp;' . $color_cantoneras['nombre'] . '<br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/' . $color_cantoneras['imagen'] . '" title="' . $color_cantoneras['nombre'] . '" style="width: 75px; margin-bottom: 5px; margin-top:3px;" />
								</td>';
	}
	for ($j = 1; $j <= $modulos_simples; $j++) {
		$num_modulo++;
		//Si es el módulo 5 hacemos otra fila
		if ($num_modulo == 5) {
			$html .= '
							</tr>
							<tr>';
		}

		if (count(${'interior_puerta_'.$num_modulo}) > 9) 
		{
			$color_interior = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[28]);
			$color_cantoneras = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[29]);
		}
		else 
		{
			$color_interior = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[7]);
			$color_cantoneras = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[8]);
		}

		$html .= '
								<td class="item_fila_proyecto_datos_interior" style="width: 25%; padding: 12px 1%; vertical-align:top;">
									<h4>M' . $num_modulo . '</h4>
									Módulo ' . ${'interior_puerta_' . $num_modulo}[1] . '<br />
									Simple<br />';
		if (${'interior_puerta_' . $num_modulo}[2] > 0) {
			$html .= 'Zapatero/s con freno<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[3] > 0) {
			$html .= 'Cajon/es con freno<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[4] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[4] . ' x J. celdillas<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[5] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[5] . ' x Frente cristal<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[6] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[6] . ' x Cerradura<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[15] > 0) {
    		$html .= ${'interior_puerta_' . $num_modulo}[15] . ' x Cajoneras Lacadas<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[16] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[16] . ' x Pantalonero premium<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[17] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[17] . ' x Zapatero premium<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[18] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[18] . ' x Cesta premium<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[19] != "undefined" && ${'interior_puerta_' . $num_modulo}[19] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[19] . ' x Cajones de 8<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[20] != "undefined" && ${'interior_puerta_' . $num_modulo}[20] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[20] . ' x Cajones de 16<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[21] != "undefined" && ${'interior_puerta_' . $num_modulo}[21] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[21] . ' x Cajones de 20<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[22] != "undefined" && ${'interior_puerta_' . $num_modulo}[22] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[22] . ' x Cajones de 32<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[23] > 0) {
			$html .= ${'interior_puerta_' . $num_modulo}[24] . ' x ';
			if (${'interior_puerta_' . $num_modulo}[23] == 1) {
				$html .= 'Cristal Transparente<br />';
			} else if (${'interior_puerta_' . $num_modulo}[23] == 2) {
				$html .= 'Cristal Matel<br />';
			}
		}
		if (${'interior_puerta_' . $num_modulo}[25] != "") {
			$html .= 'Gama: ' . ${'interior_puerta_' . $num_modulo}[25] . '<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[26] != "") {
			$html .= 'Modelo: ' . ${'interior_puerta_' . $num_modulo}[26] . '<br />';
		}
		if (${'interior_puerta_' . $num_modulo}[27] != "") {
			$html .= 'Color: ' . ${'interior_puerta_' . $num_modulo}[27] . '<br />';
		}

		$html .= 'Color<br />&nbsp;&nbsp;&nbsp;' . $color_interior['nombre'] . '<br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/' . $color_interior['imagen'] . '" title="' . $color_interior['nombre'] . '" style="width: 75px; margin-bottom: 5px; margin-top:3px;" /><br />
									Cantoneras<br />&nbsp;&nbsp;&nbsp;' . $color_cantoneras['nombre'] . '<br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/' . $color_cantoneras['imagen'] . '" title="' . $color_cantoneras['nombre'] . '" style="width: 75px; margin-bottom: 5px; margin-top:3px;" />
								</td>';
	}

	$html .= '
						</table>
						
						
						
					</td>
				</tr>
			</table>';
}

$html .= '
		
			<div style="display:block; page-break-after: always;"></div>
			
			<table style="margin-top: 10mm">
				<tr>
					<td class="izquierda" style="width:130px; padding-right:20px;">
						<img src="www/img/logo_arjomy.png" style="width:100%"; />
					</td>
					<td class="izquierda" style="width:130px;">
						<img src="www/img/logo_leroy.png" style="width:100%"; />
					</td>
					<td  style="text-align:right; font-size: 12px">
						<h3>Distribuidor</h3>
						<b>' . $distribuidor['nombre'] . '</b><br />
						' . $distribuidor['cif'] . '<br />
						' . $distribuidor['direccion'] . '<br />
						' . $distribuidor['cp'] . ' - ' . $distribuidor['poblacion'] . ' (' . $distribuidor['provincia'] . ')<br />
						' . $distribuidor['email'] . '<br />
						' . $distribuidor['telefono'] . '
					</td>
				</tr>
			</table>';


if ($proyecto['sistema_frenos_seleccionado'] > 0 || $proyecto['tapetas_seleccionado'] > 0 || $proyecto['laterales_seleccionado'] > 0 || $proyecto['costados_seleccionado'] > 0 || $proyecto['fijos_seleccionado'] > 0 || $proyecto['regleta_led_seleccionado'] > 0 || $proyecto['frente_abuardillado_seleccionado'] > 0 || $proyecto['montaje_frente_seleccionado'] > 0 || $proyecto['rematar_frente_seleccionado'] > 0 || $proyecto['rematar_interior_seleccionado'] > 0 || $proyecto['juego_led_seleccionado'] > 0 || $proyecto['montaje_interior_seleccionado'] > 0 || $proyecto['desmontaje_frente_seleccionado'] > 0 || $proyecto['desmontaje_interior_seleccionado'] > 0 || $proyecto['albanileria_con_seleccionado'] > 0 || $proyecto['albanileria_sin_seleccionado'] > 0 || $proyecto['precio_extras_1'] > 0 || $proyecto['precio_extras_2'] > 0 || $proyecto['precio_extras_3'] > 0 || $proyecto['precio_extras_4'] > 0 || $proyecto['precio_extras_5'] > 0 || $proyecto['precio_extras_6'] > 0 || $proyecto['precio_extras_7'] > 0 || $proyecto['precio_extras_8'] > 0 || $proyecto['precio_extras_9'] > 0 || $proyecto['precio_extras_10'] > 0 || $proyecto['precio_extras_11'] > 0 || $proyecto['precio_extras_12'] > 0 || $proyecto['precio_extras_13'] > 0 || $proyecto['precio_albanileria_sencilla'] || $proyecto['precio_albanileria_tirar_tabique'] || $proyecto['precio_albanileria_quitar_solera'] || $proyecto['precio_albanileria_mover_enchufe'] || $proyecto['precio_albanileria_costado_pladur']) {
	$html .= '
		
			<table style="margin-bottom: 20mm;">
				<tr>
					<td>
						<h2>Extras</h2>
					</td>
				</tr>';
	if ($proyecto['sistema_frenos_seleccionado'] > 0 || $proyecto['tapetas_seleccionado'] > 0 || $proyecto['laterales_seleccionado'] > 0 || $proyecto['costados_seleccionado'] > 0 || $proyecto['fijos_seleccionado'] > 0 || $proyecto['regleta_led_seleccionado'] > 0 || $proyecto['frente_abuardillado_seleccionado'] > 0 || $proyecto['montaje_frente_seleccionado'] > 0 || $proyecto['rematar_frente_seleccionado'] > 0) {

		$html .= '
				<tr>
					<td>
						<h3>Frente</h3>
					</td>
				</tr>';
		if ($proyecto['tapetas_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>';
			$tapetas = $db->getVar('SELECT nombre FROM tapetas WHERE id=' . $proyecto['tapetas_seleccionado']);
			$html .= '
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Juego de ' . $tapetas . '
					</td>
				</tr>';
		}
		if ($proyecto['laterales_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>';
			$laterales = $db->getVar('SELECT nombre FROM laterales WHERE id=' . $proyecto['laterales_seleccionado']);
			$html .= '
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Juego de ' . $laterales . '
					</td>
				</tr>';
		}
		if ($proyecto['sistema_frenos_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Sistema de frenos para puertas
					</td>
				</tr>';
		}
		if ($proyecto['costados_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>';
			$costados = $db->getVar('SELECT nombre FROM costados WHERE id=' . $proyecto['costados_seleccionado']);
			$html .= '
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> ' . $costados . '
					</td>
				</tr>';
		}

		if ($proyecto['fijos_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>';
			$fijos = $db->getVar('SELECT nombre FROM fijos WHERE id=' . $proyecto['fijos_seleccionado']);
			$html .= '
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Fijos en ' . $fijos . '
					</td>
				</tr>';
		}

		if ($proyecto['regleta_led_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Regletas led para puertas
					</td>
				</tr>';
		}

		if ($proyecto['frente_abuardillado_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Frente abuardillado
					</td>
				</tr>';
		}

		if ($proyecto['montaje_frente_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Montaje de frente de ' . $proyecto['montaje_frente_seleccionado'] . ' hojas
					</td>
				</tr>';
		}
		if ($proyecto['rematar_frente_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Remate de frente
					</td>
				</tr>';
		}
	}
	if ($proyecto['juego_led_seleccionado'] > 0 || $proyecto['montaje_interior_seleccionado'] > 0 || $proyecto['rematar_interior_seleccionado'] > 0) {

		$html .= '
				<tr>
					<td>
						<h3>Interior</h3>
					</td>
				</tr>';
		if ($proyecto['juego_led_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Juego de led interior
					</td>
				</tr>';
		}
		if ($proyecto['montaje_interior_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Montaje de interior de ' . $proyecto['montaje_interior_seleccionado'] . ' módulos
					</td>
				</tr>';
		}
		if ($proyecto['rematar_interior_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Remate de interior
					</td>
				</tr>';
		}
	}

	if ($proyecto['albanileria_con_seleccionado'] > 0 || $proyecto['albanileria_sin_seleccionado'] > 0 || $proyecto['precio_albanileria_sencilla'] || $proyecto['precio_albanileria_tirar_tabique'] || $proyecto['precio_albanileria_quitar_solera'] || $proyecto['precio_albanileria_mover_enchufe'] || $proyecto['precio_albanileria_costado_pladur']) {
		$html .= '
				<tr>
					<td>
						<h3>Albañilería</h3>
					</td>
				</tr>';
		

		if ($proyecto['precio_albanileria_sencilla'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Albanileria sencilla
					</td>
				</tr>';
		}
		if ($proyecto['precio_albanileria_tirar_tabique'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Tirar tabique o maletero
					</td>
				</tr>';
		}
		if ($proyecto['precio_albanileria_quitar_solera'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Quitar solera
					</td>
				</tr>';
		}
		if ($proyecto['precio_albanileria_mover_enchufe'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Mover enchufe o interruptor
					</td>
				</tr>';
		}
		if ($proyecto['precio_albanileria_costado_pladur'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Hacer costado de pladur
					</td>
				</tr>';
		}

		if ($proyecto['albanileria_con_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Albañilería con solera
					</td>
				</tr>';
		}
		if ($proyecto['albanileria_sin_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Albañilería sin solera
					</td>
				</tr>';
		}
	}

	if ($proyecto['desmontaje_frente_seleccionado'] > 0 || $proyecto['desmontaje_interior_seleccionado'] > 0 || $proyecto['precio_extras_1'] > 0 || $proyecto['precio_extras_2'] > 0 || $proyecto['precio_extras_3'] > 0 || $proyecto['precio_extras_4'] > 0 || $proyecto['precio_extras_5'] > 0 || $proyecto['precio_extras_6'] > 0 || $proyecto['precio_extras_7'] > 0 || $proyecto['precio_extras_8'] > 0 || $proyecto['precio_extras_9'] > 0 || $proyecto['precio_extras_10'] > 0 || $proyecto['precio_extras_11'] > 0 || $proyecto['precio_extras_12'] > 0 || $proyecto['precio_extras_13'] > 0) {
		$html .= '
				<tr>
					<td>
						<h3>Otros</h3>
					</td>
				</tr>';
		if ($proyecto['desmontaje_frente_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>';
			$desm_frente = $db->getVar('SELECT nombre FROM desmontajes_frentes WHERE id=' . $proyecto['desmontaje_frente_seleccionado']);
			$html .= '
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Desmontaje de frente de ' . $desm_frente . '
					</td>
				</tr>';
		}
		if ($proyecto['desmontaje_interior_seleccionado'] > 0) {
			$html .= '
				<tr>
					<td>';
			$desm_interior = $db->getVar('SELECT nombre FROM desmontajes_interiores WHERE id=' . $proyecto['desmontaje_interior_seleccionado']);
			$html .= '
						<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Desmontaje de interior de ' . $desm_interior . '
					</td>
				</tr>';
		}

		if ($proyecto['precio_extras_1'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Rematar por dentro
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_2'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Rematar interior sin frente
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_3'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Rematar por dentro
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_4'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Instalación fijo
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_5'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Instalación costado
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_6'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Módulo con viga
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_7'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Interior con chaflán
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_8'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Frente con chaflán
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_9'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Registro
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_10'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Desplazar punto de luz a costado
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_11'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Módulo forrado
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_12'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Incremento por balda extra
				</td>
			</tr>';
		}
		if ($proyecto['precio_extras_13'] > 0) {
			$html .= '
			<tr>
				<td>
					<img src="www/img/check.jpg" style="margin-top: 1px; width: 12px;" /> Incremento por módulo partido
				</td>
			</tr>';
		}
	}

	$html .= '
			</table>';
}

if ($proyecto['observaciones'] != "") {
	$html .= '
			<table style="margin-bottom: 20mm;">
				<tr>
					<td>
						<h2>Observaciones</h2>
					</td>
				</tr>
				<tr>
					<td>
						' . nl2br($proyecto['observaciones']) . '
					</td>
				</tr>
			</table>';
}

$html .= '
			<table>
				<tr>
					<td>
						<h2>Precio</h2>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td style="text-align: right;">
						Precio frente:
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_frente'], 2, ".", "") . '€
					</td>
				</tr>';

if ($proyecto['inc_desc_frente'] != "") {
	$html .= '
				<tr>
					<td style="text-align: right;">
						' . $proyecto['inc_desc_frente'] . ': 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['cant_inc_desc_frente'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_modulos_interior'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio interior: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_modulos_interior'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['inc_desc_interior'] != "") {
	$html .= '
				<tr>
					<td style="text-align: right;">
						' . $proyecto['inc_desc_interior'] . ': 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['cant_inc_desc_interior'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_tapetas'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio tapetas: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_tapetas'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_laterales'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio laterales: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_laterales'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_ceramica'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio cerámica: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_ceramica'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_accesorios_interior'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio accesorios: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_accesorios_interior'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_sistema_frenos'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio sistema frenos: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_sistema_frenos'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_regleta_led'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio regletas led: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_regleta_led'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_frente_abuardillado'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio frente abuardillado: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_frente_abuardillado'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_costados'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio costados: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_costados'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_fijos'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio fijos: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_fijos'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['montaje_frente_seleccionado'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio montaje frente: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_montaje_frente'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['rematar_frente_seleccionado'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio remate frente: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_rematar_frente'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['juego_led_seleccionado'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio juego led: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_juego_led'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['rematar_interior_seleccionado'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio remate interior: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_rematar_interior'], 2, ".", "") . '€
					</td>
				</tr>';
}



$html .= '
				<tr>
					<td style="text-align: right;">
						Precio montaje: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_montaje_frente'], 2, ".", "") . '€
					</td>
				</tr>';





if ($proyecto['montaje_interior_seleccionado'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio montaje interior: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_montaje_interior'], 2, ".", "") . '€
					</td>
				</tr>';
}

if ($proyecto['precio_desmontaje'] > 0) {
	$html .= '
					<tr>
						<td style="text-align: right;">
							Precio desmontaje: 
						</td>
						<td style="width: 80px; text-align: right;">
							' . number_format($proyecto['precio_desmontaje'], 2, ".", "") . '€
						</td>
					</tr>';
} else {
	if ($proyecto['desmontaje_frente_seleccionado'] > 0) {
		$html .= '
					<tr>
						<td style="text-align: right;">
							Precio desmontaje frente: 
						</td>
						<td style="width: 80px; text-align: right;">
							' . number_format($proyecto['precio_desmontaje_frente'], 2, ".", "") . '€
						</td>
					</tr>';
	}
	if ($proyecto['desmontaje_interior_seleccionado'] > 0) {
		$html .= '
					<tr>
						<td style="text-align: right;">
							Precio desmontaje interior: 
						</td>
						<td style="width: 80px; text-align: right;">
							' . number_format($proyecto['precio_desmontaje_interior'], 2, ".", "") . '€
						</td>
					</tr>';
	}
}




if ($proyecto['precio_albanileria_sencilla'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Albanileria sencilla: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_albanileria_sencilla'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_albanileria_tirar_tabique'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Tirar tabique o maletero: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_albanileria_tirar_tabique'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_albanileria_quitar_solera'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Quitar solera: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_albanileria_quitar_solera'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_albanileria_mover_enchufe'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Mover enchufe o interruptor: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_albanileria_mover_enchufe'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_albanileria_costado_pladur'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Hacer costado de pladur: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_albanileria_costado_pladur'], 2, ".", "") . '€
					</td>
				</tr>';
}

if ($proyecto['albanileria_con_seleccionado'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio albañilería con solera: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_albanileria_con'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['albanileria_sin_seleccionado'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio albañilería sin solera: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_albanileria_sin'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_km_medicion'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio km para medición: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_km_medicion'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_km_montaje'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Precio km para montaje: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_km_montaje'], 2, ".", "") . '€
					</td>
				</tr>';
}

if ($proyecto['precio_extras_1'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Rematar por dentro: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_1'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_2'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Rematar interior sin frente: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_2'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_3'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Rematar por dentro: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_3'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_4'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Instalación fijo: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_4'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_5'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Instalación costado: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_5'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_6'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Módulo con viga: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_6'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_7'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Interior con chaflán: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_7'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_8'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Frente con chaflán: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_8'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_9'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Registro: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_9'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_10'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Desplazar punto de luz a costado: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_10'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_11'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Módulo forrado: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_11'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_12'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Incremento por balda extra: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_12'], 2, ".", "") . '€
					</td>
				</tr>';
}
if ($proyecto['precio_extras_13'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Incremento por módulo partido: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['precio_extras_13'], 2, ".", "") . '€
					</td>
				</tr>';
}

if ($proyecto['aplicar_descuento'] > 0) {
	$html .= '
				<tr>
					<td style="text-align: right;">
						Descuento del ' . $proyecto['aplicar_descuento'] . '%: 
					</td>
					<td style="width: 80px; text-align: right;">
						-' . number_format($proyecto['descuento_cliente'], 2, ".", "") . '€
					</td>
				</tr>';
}

$html .= '
				<tr>
					<td style="text-align: right;">
						' . $proyecto['porcentaje_iva'] . '% I.V.A.: 
					</td>
					<td style="width: 80px; text-align: right;">
						' . number_format($proyecto['iva'], 2, ".", "") . '€
					</td>
				</tr>
				<tr>
					<td style="text-align: right;">
						<b>PRECIO TOTAL:</b> 
					</td>
					<td style="width: 80px; text-align: right;">
						<b>' . number_format($proyecto['precio_total'], 2, ".", "") . '€</b>
					</td>
				</tr>
			</table>';
/*
			<table style="position:absolute; bottom: 0;">
				<tr>
					<td>';
						$precio_distribuidor = ($proyecto['precio_frente'] + $proyecto['cant_inc_desc_frente'] + $proyecto['precio_interior'] + $proyecto['precio_tapetas'] + $proyecto['precio_laterales'] + $proyecto['precio_costados']) - (($proyecto['precio_frente'] + $proyecto['cant_inc_desc_frente'] + $proyecto['precio_interior'] + $proyecto['precio_tapetas'] + $proyecto['precio_laterales'] + $proyecto['precio_costados'])*$proyecto['descuento']/100) + $proyecto['precio_ceramica'] + $proyecto['precio_montaje_frente'] + $proyecto['precio_montaje_interior'];
						$precio_distribuidor_iva = round($precio_distribuidor + $precio_distribuidor * $proyecto['porcentaje_iva'] / 100, 2);
						$html .= str_pad($proyecto['id_tarifa'], 2, "0", STR_PAD_LEFT)."-".str_pad($proyecto['descuento'], 6, "0", STR_PAD_LEFT)."-".str_pad(number_format($precio_distribuidor_iva,2,".",""), 10, "0", STR_PAD_BOTH).' 
					</td>
				</tr>
			</table>';*/

$html .= '
		</div>
	</body>
</html>';

//echo $html;


require_once("libs/dompdf/autoload.inc.php");

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('proyecto_p' . str_pad($id, 6, "0", STR_PAD_LEFT) . '.pdf');
