<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] != "logged")
	die();

// VEMOS LOS DATOS ENVIADOS PARA CALCULAR EL PRECIO
$acabado = 0;
if (isset($_POST['acabado']) && $_POST['acabado'] > 0)									$acabado = (int)$_POST['acabado'];
$tarifa = 0;
if (isset($_POST['tarifa']) && $_POST['tarifa'] > 0)											$tarifa = (int)$_POST['tarifa'];
$descuento = 0;
if (isset($_POST['descuento']) && $_POST['descuento'] > 0)									$descuento = (float)$_POST['descuento'];
$serie = 1; // SE INICIALIZA A 1 POR SI ES SOLO INTERIOR QUE TARIFIQUE COMO JOMY
if (isset($_POST['serie']) && $_POST['serie'] > 0)											$serie = (int)$_POST['serie'];
$num_puertas = 0;
if (isset($_POST['num_puertas']) && $_POST['num_puertas'] > 0)								$num_puertas = (int)$_POST['num_puertas'];
$precio_frente = 0;
if (isset($_POST['precio_frente']) && $_POST['precio_frente'] > 0)							$precio_frente = (float)$_POST['precio_frente'];
$cant_inc_desc_frente = 0;
if (isset($_POST['cant_inc_desc_frente']) && $_POST['cant_inc_desc_frente'] != 0)			$cant_inc_desc_frente = (float)$_POST['cant_inc_desc_frente'];
$precio_ceramica = 0;
if (isset($_POST['precio_ceramica']) && $_POST['precio_ceramica'] > 0)						$precio_ceramica = (float)$_POST['precio_ceramica'];
$precio_modulos_interior = 0;
if (isset($_POST['precio_modulos_interior']) && $_POST['precio_modulos_interior'] > 0)		$precio_modulos_interior = (float)$_POST['precio_modulos_interior'];
$precio_accesorios_interior = 0;
if (isset($_POST['precio_accesorios_interior']) && $_POST['precio_accesorios_interior'] > 0)	$precio_accesorios_interior = (float)$_POST['precio_accesorios_interior'];
$cant_inc_desc_interior = 0;
if (isset($_POST['cant_inc_desc_interior']) && $_POST['cant_inc_desc_interior'] != 0)		$cant_inc_desc_interior = (float)$_POST['cant_inc_desc_interior'];
$tapetas = 0;
if (isset($_POST['tapetas']) && $_POST['tapetas'] > 0)										$tapetas = (int)$_POST['tapetas'];
$laterales = 0;
if (isset($_POST['laterales']) && $_POST['laterales'] > 0)									$laterales = (int)$_POST['laterales'];
$costados = 0;
if (isset($_POST['costados']) && $_POST['costados'] > 0)										$costados = (int)$_POST['costados'];
$fijos = 0;
if (isset($_POST['fijos']) && $_POST['fijos'] > 0)											$fijos = (int)$_POST['fijos'];
$montaje_frente = 0;
if (isset($_POST['montaje_frente']) && $_POST['montaje_frente'] > 0)							$montaje_frente = (int)$_POST['montaje_frente'];
$montaje_frente_arjomy = 0;
if (isset($_POST['montaje_frente_arjomy']) && $_POST['montaje_frente_arjomy'] > 0)			$montaje_frente_arjomy = (int)$_POST['montaje_frente_arjomy'];
$montaje_interior = 0;
if (isset($_POST['montaje_interior']) && $_POST['montaje_interior'] > 0)						$montaje_interior = (int)$_POST['montaje_interior'];
$montaje_interior_arjomy = 0;
if (isset($_POST['montaje_interior_arjomy']) && $_POST['montaje_interior_arjomy'] > 0)		$montaje_interior_arjomy = (int)$_POST['montaje_interior_arjomy'];
$desmontaje_frente = 0;
if (isset($_POST['desmontaje_frente']) && $_POST['desmontaje_frente'] > 0)					$desmontaje_frente = (int)$_POST['desmontaje_frente'];
$desmontaje_frente_arjomy = 0;
if (isset($_POST['desmontaje_frente_arjomy']) && $_POST['desmontaje_frente_arjomy'] > 0)		$desmontaje_frente_arjomy = (int)$_POST['desmontaje_frente_arjomy'];
$desmontaje_interior = 0;
if (isset($_POST['desmontaje_interior']) && $_POST['desmontaje_interior'] > 0)				$desmontaje_interior = (int)$_POST['desmontaje_interior'];
$desmontaje_interior_arjomy = 0;
if (isset($_POST['desmontaje_interior_arjomy']) && $_POST['desmontaje_interior_arjomy'] > 0)	$desmontaje_interior_arjomy = (int)$_POST['desmontaje_interior_arjomy'];
$medidas_ancho = 0;
if (isset($_POST['medidas_ancho']) && $_POST['medidas_ancho'] > 0)							$medidas_ancho = (int)$_POST['medidas_ancho'];
$juego_led = 0;
if (isset($_POST['juego_led']) && $_POST['juego_led'] > 0)									$juego_led = (int)$_POST['juego_led'];
$juego_led_arjomy = 0;
if (isset($_POST['juego_led_arjomy']) && $_POST['juego_led_arjomy'] > 0)						$juego_led_arjomy = (int)$_POST['juego_led_arjomy'];
$rematar_frente = 0;
if (isset($_POST['rematar_frente']) && $_POST['rematar_frente'] > 0)							$rematar_frente = (int)$_POST['rematar_frente'];
$rematar_frente_arjomy = 0;
if (isset($_POST['rematar_frente_arjomy']) && $_POST['rematar_frente_arjomy'] > 0)			$rematar_frente_arjomy = (int)$_POST['rematar_frente_arjomy'];
$rematar_interior = 0;
if (isset($_POST['rematar_interior']) && $_POST['rematar_interior'] > 0)						$rematar_interior = (int)$_POST['rematar_interior'];
$sistema_frenos = 0;
if (isset($_POST['sistema_frenos']) && $_POST['sistema_frenos'] > 0)							$sistema_frenos = (int)$_POST['sistema_frenos'];
$herrajes_negros = 0;
if (isset($_POST['herrajes_negros']) && $_POST['herrajes_negros'] > 0)						$herrajes_negros = (int)$_POST['herrajes_negros'];
$multitaladro = 0;
if (isset($_POST['multitaladro']) && $_POST['multitaladro'] > 0)							$multitaladro = (int)$_POST['multitaladro'];
$espejo_extraible = 0;
if (isset($_POST['espejo_extraible']) && $_POST['espejo_extraible'] > 0)					$espejo_extraible = (int)$_POST['espejo_extraible'];
$espejo_con_carril = 0;
if (isset($_POST['espejo_con_carril']) && $_POST['espejo_con_carril'] > 0)					$espejo_con_carril = (int)$_POST['espejo_con_carril'];
$baldas_inclinadas = 0;
if (isset($_POST['baldas_inclinadas']) && $_POST['baldas_inclinadas'] > 0)					$baldas_inclinadas = (int)$_POST['baldas_inclinadas'];
$remate_interior = 0;
if (isset($_POST['remate_interior']) && $_POST['remate_interior'] > 0)						$remate_interior = (int)$_POST['remate_interior'];
$regleta_led = 0;
if (isset($_POST['regleta_led']) && $_POST['regleta_led'] > 0)								$regleta_led = (int)$_POST['regleta_led'];
$leds_incrustados = 0;
if (isset($_POST['leds_incrustados']) && $_POST['leds_incrustados'] > 0)						$leds_incrustados = (int)$_POST['leds_incrustados'];
$frente_abuardillado = 0;
if (isset($_POST['frente_abuardillado']) && $_POST['frente_abuardillado'] > 0)				$frente_abuardillado = (int)$_POST['frente_abuardillado'];
$frente_chaflan = 0;
if (isset($_POST['frente_chaflan']) && $_POST['frente_chaflan'] > 0)							$frente_chaflan = (int)$_POST['frente_chaflan'];
$recrecer_frente = 0;
if (isset($_POST['recrecer_frente']) && $_POST['recrecer_frente'] > 0)						$recrecer_frente = (int)$_POST['recrecer_frente'];
$kit_plegable = 0;
if (isset($_POST['kit_plegable']) && $_POST['kit_plegable'] > 0)								$kit_plegable = (int)$_POST['kit_plegable'];
$tirador_cubo = 0;
if (isset($_POST['tirador_cubo']) && $_POST['tirador_cubo'] > 0)								$tirador_cubo = (int)$_POST['tirador_cubo'];
$tirador_disc = 0;
if (isset($_POST['tirador_disc']) && $_POST['tirador_disc'] > 0)								$tirador_disc = (int)$_POST['tirador_disc'];
$tirador_conic = 0;
if (isset($_POST['tirador_conic']) && $_POST['tirador_conic'] > 0)							$tirador_conic = (int)$_POST['tirador_conic'];
$tirador_line = 0;
if (isset($_POST['tirador_line']) && $_POST['tirador_line'] > 0)							$tirador_line = (int)$_POST['tirador_line'];
$unero_rebajado = 0;
if (isset($_POST['unero_rebajado']) && $_POST['unero_rebajado'] > 0)							$unero_rebajado = (int)$_POST['unero_rebajado'];
$unero_color_madera = 0;
if (isset($_POST['unero_color_madera']) && $_POST['unero_color_madera'] > 0)					$unero_color_madera = (int)$_POST['unero_color_madera'];
$albanileria_con = 0;
if (isset($_POST['albanileria_con']) && $_POST['albanileria_con'] > 0)						$albanileria_con = (int)$_POST['albanileria_con'];
$albanileria_sin = 0;
if (isset($_POST['albanileria_sin']) && $_POST['albanileria_sin'] > 0)						$albanileria_sin = (int)$_POST['albanileria_sin'];
$km_medicion = 0;
if (isset($_POST['km_medicion']) && $_POST['km_medicion'] > 0)								$km_medicion = (int)$_POST['km_medicion']; // RECOGEMOS 30 KM DE BASE
$km_montaje = 0;
if (isset($_POST['km_montaje']) && $_POST['km_montaje'] > 0)									$km_montaje = (int)$_POST['km_montaje']; // RECOGEMOS 30 KM DE BASE
$extras_1 = 0;
if (isset($_POST['extras_1']) && $_POST['extras_1'] > 0)										$extras_1 = (int)$_POST['extras_1'];
$extras_2 = 0;
if (isset($_POST['extras_2']) && $_POST['extras_2'] > 0)										$extras_2 = (int)$_POST['extras_2'];
$extras_3 = 0;
if (isset($_POST['extras_3']) && $_POST['extras_3'] > 0)										$extras_3 = (int)$_POST['extras_3'];
$extras_4 = 0;
if (isset($_POST['extras_4']) && $_POST['extras_4'] > 0)										$extras_4 = (int)$_POST['extras_4'];
$extras_5 = 0;
if (isset($_POST['extras_5']) && $_POST['extras_5'] > 0)										$extras_5 = (int)$_POST['extras_5'];
$extras_6 = 0;
if (isset($_POST['extras_6']) && $_POST['extras_6'] > 0)										$extras_6 = (int)$_POST['extras_6'];
$extras_7 = 0;
if (isset($_POST['extras_7']) && $_POST['extras_7'] > 0)										$extras_7 = (int)$_POST['extras_7'];
$extras_8 = 0;
if (isset($_POST['extras_8']) && $_POST['extras_8'] > 0)										$extras_8 = (int)$_POST['extras_8'];
$extras_9 = 0;
if (isset($_POST['extras_9']) && $_POST['extras_9'] > 0)										$extras_9 = (int)$_POST['extras_9'];
$extras_10 = 0;
if (isset($_POST['extras_10']) && $_POST['extras_10'] > 0)									$extras_10 = (int)$_POST['extras_10'];
$extras_11 = 0;
if (isset($_POST['extras_11']) && $_POST['extras_11'] > 0)									$extras_11 = (int)$_POST['extras_11'];
$extras_12 = 0;
if (isset($_POST['extras_12']) && $_POST['extras_12'] > 0)									$extras_12 = (int)$_POST['extras_12'];
$extras_13 = 0;
if (isset($_POST['extras_13']) && $_POST['extras_13'] > 0)									$extras_13 = (int)$_POST['extras_13'];

$albanileria_sencilla = 0;
if (isset($_POST['albanileria_sencilla']) && $_POST['albanileria_sencilla'] > 0)									$albanileria_sencilla = (int)$_POST['albanileria_sencilla'];
$albanileria_tirar_tabique = 0;
if (isset($_POST['albanileria_tirar_tabique']) && $_POST['albanileria_tirar_tabique'] > 0)									$albanileria_tirar_tabique = (int)$_POST['albanileria_tirar_tabique'];
$albanileria_quitar_solera = 0;
if (isset($_POST['albanileria_quitar_solera']) && $_POST['albanileria_quitar_solera'] > 0)									$albanileria_quitar_solera = (int)$_POST['albanileria_quitar_solera'];
$albanileria_mover_enchufe = 0;
if (isset($_POST['albanileria_mover_enchufe']) && $_POST['albanileria_mover_enchufe'] > 0)									$albanileria_mover_enchufe = (int)$_POST['albanileria_mover_enchufe'];
$albanileria_costado_pladur = 0;
if (isset($_POST['albanileria_costado_pladur']) && $_POST['albanileria_costado_pladur'] > 0)									$albanileria_costado_pladur = (int)$_POST['albanileria_costado_pladur'];
$plus_grey_stone = 0;
if (isset($_POST['plus_grey_stone']) && $_POST['plus_grey_stone'] > 0)									$plus_grey_stone = (int)$_POST['plus_grey_stone'];
$plus_cream_stone = 0;
if (isset($_POST['plus_cream_stone']) && $_POST['plus_cream_stone'] > 0)									$plus_cream_stone = (int)$_POST['plus_cream_stone'];
$plus_dark_grey = 0;
if (isset($_POST['plus_dark_grey']) && $_POST['plus_dark_grey'] > 0)									$plus_dark_grey = (int)$_POST['plus_dark_grey'];


$pvp = $db->getVar('SELECT porcentaje FROM tarifa WHERE id = '.$tarifa);


$precio_tapetas = 0; //  $db->getVar('SELECT precio FROM tapetas WHERE id='.$tapetas);
$precio_laterales = 0; //  $db->getVar('SELECT precio FROM laterales WHERE id='.$laterales);

$precio_costados = 0;
if($costados > 0)
{
	$precio_costados = $db->getVar('SELECT precio FROM costados WHERE id=' . $costados);
}
$precio_fijos = 0;
if($fijos > 0)
{
	if ($medidas_ancho <= 190) {
		$precio_fijos = $db->getVar('SELECT fijos.190 FROM fijos WHERE id=' . $fijos);
	} else if ($medidas_ancho <= 260) {
		$precio_fijos = $db->getVar('SELECT fijos.260 FROM fijos WHERE id=' . $fijos);
	} else if ($medidas_ancho <= 380) {
		$precio_fijos = $db->getVar('SELECT fijos.380 FROM fijos WHERE id=' . $fijos);
	} else if ($medidas_ancho <= 600) {
		$precio_fijos = $db->getVar('SELECT fijos.550 FROM fijos WHERE id=' . $fijos);
	}
}

if ($desmontaje_frente > 0) {
	$precio_desmontaje_frente = $db->getVar('SELECT precio FROM desmontajes_frentes WHERE id=' . $desmontaje_frente);
	$precio_desmontaje_frente += $precio_desmontaje_frente * $pvp / 100;
} else {
	$precio_desmontaje_frente = 0;
}
if ($desmontaje_interior > 0) {
	$precio_desmontaje_interior = $db->getVar('SELECT precio FROM desmontajes_interiores WHERE id=' . $desmontaje_interior);
	$precio_desmontaje_interior += $precio_desmontaje_interior * $pvp / 100;
} else {
	$precio_desmontaje_interior = 0;
}
$precio_desmontaje = 0;
if ($desmontaje_frente > 0 && $desmontaje_interior > 0) {
	$precio_desmontaje = $db->getVar('SELECT precio FROM desmontajes_completo WHERE modulos=' . $desmontaje_interior);
	$precio_desmontaje += $precio_desmontaje * $pvp / 100;
	$precio_desmontaje_frente = 0;
	$precio_desmontaje_interior = 0;
}

if ($juego_led > 0) {
	$ancho_led = ceil($medidas_ancho / 100) * 100;
	if ($ancho_led == 600) {
		$ancho_led = 500;
	}
	$precio_juego_led = $db->getVar('SELECT juegos_led.' . $ancho_led . ' FROM juegos_led WHERE id=' . $juego_led);
} else {
	$precio_juego_led = 0;
}

if ($rematar_frente > 0) {
	$precio_rematar_frente = $db->getVar('SELECT precio FROM rematar_frente WHERE id=' . $rematar_frente);
} else {
	$precio_rematar_frente = 0;
}

if ($rematar_interior > 0) {
	$precio_rematar_interior = $db->getVar('SELECT precio FROM rematar_interior WHERE id=1');
} else {
	$precio_rematar_interior = 0;
}

if ($sistema_frenos > 0) {
	$precio_sistema_frenos = $db->getVar('SELECT precio FROM sistema_frenos WHERE id=' . $sistema_frenos);
} else {
	$precio_sistema_frenos = 0;
}

if($herrajes_negros > 0){
	$precio_herrajes_negros = $num_puertas * $db->getVar('SELECT precio FROM extras WHERE id = 17');
}
else{
	$precio_herrajes_negros = 0;
}

if ($multitaladro > 0) {
	$precio_multitaladro =  $db->getVar('SELECT precio FROM extras WHERE id = 18');
} else {
	$precio_multitaladro = 0;
}

if ($espejo_extraible > 0) {
	$precio_espejo_extraible = $db->getVar('SELECT precio FROM extras WHERE id = 19');
} else {
	$precio_espejo_extraible = 0;
}

if ($espejo_con_carril > 0) {
    $precio_espejo_con_carril = $db->getVar('SELECT precio FROM extras WHERE id = 20');
} else {
	$precio_espejo_con_carril = 0;
}

if ($baldas_inclinadas > 0) {
	$precio_baldas_inclinadas = $db->getVar('SELECT precio FROM extras WHERE id = 21');
} else {
	$precio_baldas_inclinadas = 0;
}

if ($remate_interior > 0) {
	$precio_remate_interior = $db->getVar('SELECT precio FROM extras WHERE id = 22');
} else {
	$precio_remate_interior = 0;
}

if ($regleta_led > 0) {
	$precio_regleta_led = $num_puertas * $db->getVar('SELECT precio FROM regletas_led WHERE id=' . $regleta_led);
} else {
	$precio_regleta_led = 0;
}

if($leds_incrustados > 0){
	$precio_leds_incrustados = $num_puertas * $db->getVar('SELECT precio FROM extras WHERE id=16'); // Precio de sensores
	$precio_leds_incrustados +=  $db->getVar('SELECT precio FROM extras WHERE id=15'); // Precio de transformadores

	$metro_led = $medidas_ancho / 100;
	$precio_leds_incrustados += $metro_led * $db->getVar('SELECT precio FROM extras WHERE id=14'); // Precio por metro de tira led

} else {
	$precio_leds_incrustados = 0;
}

if ($frente_abuardillado > 0) {
	$precio_frente_abuardillado = $db->getVar('SELECT precio FROM extras WHERE id=27');
} else {
	$precio_frente_abuardillado = 0;
}

if ($frente_chaflan > 0) {
	$precio_frente_chaflan = $db->getVar('SELECT precio FROM extras WHERE id=7');
} else {
	$precio_frente_chaflan = 0;
}


if ($recrecer_frente > 0) {
	if($acabado == 4)
	{
		$precio_recrecer_frente = $db->getVar('SELECT precio FROM extras WHERE id=23');
	}
	else
	{
		$precio_recrecer_frente = $db->getVar('SELECT precio FROM extras WHERE id=26');
	}
} else {
	$precio_recrecer_frente = 0;
}

if ($kit_plegable > 0) {
	$precio_kit_plegable = $db->getVar('SELECT precio FROM extras WHERE id=24');
} else {
	$precio_kit_plegable = 0;
}


if ($tirador_cubo > 0) {
	$precio_tirador_cubo = $num_puertas * $db->getVar('SELECT precio FROM tiradores WHERE id=1');
} else {
	$precio_tirador_cubo = 0;
}

if ($tirador_disc > 0) {
	$precio_tirador_disc = $num_puertas * $db->getVar('SELECT precio FROM tiradores WHERE id=2');
} else {
	$precio_tirador_disc = 0;
}

if ($tirador_conic > 0) {
	$precio_tirador_conic = $num_puertas * $db->getVar('SELECT precio FROM tiradores WHERE id=3');
} else {
	$precio_tirador_conic = 0;
}

if ($tirador_line > 0) {
	$precio_tirador_line = $num_puertas * $db->getVar('SELECT precio FROM tiradores WHERE id=4');
} else {
	$precio_tirador_line = 0;
}

if ($unero_rebajado > 0) {
	$precio_unero_rebajado = $db->getVar('SELECT precio FROM uneros WHERE id=1');
} else {
	$precio_unero_rebajado = 0;
}

if ($unero_color_madera > 0) {
	$precio_unero_color_madera = $db->getVar('SELECT precio FROM uneros WHERE id=2');
} else {
	$precio_unero_color_madera = 0;
}

if ($albanileria_con > 0) {
	$precio_albanileria_con = $db->getVar('SELECT precio FROM albanileria_con_solera WHERE id=' . $albanileria_con);
	$precio_albanileria_con += $precio_albanileria_con * $pvp / 100;
} else {
	$precio_albanileria_con = 0;
}

if ($albanileria_sin > 0) {
	$precio_albanileria_sin = $db->getVar('SELECT precio FROM albanileria_sin_solera WHERE id=' . $albanileria_sin);
	$precio_albanileria_sin += $precio_albanileria_sin * $pvp / 100;
} else {
	$precio_albanileria_sin = 0;
}

if ($km_medicion > 30) {
	$precio_km_medicion = 2 * ($km_medicion-30);
} else {
	$precio_km_medicion = 0;
}

if ($km_montaje > 30) {
	$precio_km_montaje = 4 * ($km_montaje-30);
} else {
	$precio_km_montaje = 0;
}

if ($extras_1 > 0) {
	$precio_extras_1 = $db->getVar('SELECT precio FROM extras WHERE id=2');
	if($acabado == 4)
	{
		$precio_extras_1 = $db->getVar('SELECT precio FROM extras WHERE id=25');
		$precio_extras_1 += $precio_extras_1 * $pvp / 100;
	}
} else {
	$precio_extras_1 = 0;
}

if ($extras_2 > 0) {
	$precio_extras_2 = $db->getVar('SELECT precio FROM extras WHERE id=5');
	$precio_extras_2 += $precio_extras_2 * $pvp / 100;
} else {
	$precio_extras_2 = 0;
}

if ($extras_3 > 0) {
	$precio_extras_3 = $db->getVar('SELECT precio FROM extras WHERE id=6');
	$precio_extras_3 += $precio_extras_3 * $pvp / 100;
} else {
	$precio_extras_3 = 0;
}

if ($extras_4 > 0) {
	$precio_extras_4 = $db->getVar('SELECT precio FROM extras WHERE id=8');
	$precio_extras_4 += $precio_extras_4 * $pvp / 100;
} else {
	$precio_extras_4 = 0;
}

if ($extras_5 > 0) {
	$precio_extras_5 = $db->getVar('SELECT precio FROM extras WHERE id=9');
	$precio_extras_5 += $precio_extras_5 * $pvp / 100;
} else {
	$precio_extras_5 = 0;
}

if ($extras_6 > 0) {
	$precio_extras_6 = $db->getVar('SELECT precio FROM extras WHERE id=10');
	$precio_extras_6 += $precio_extras_6 * $pvp / 100;
} else {
	$precio_extras_6 = 0;
}

if ($extras_7 > 0) {
	$precio_extras_7 = $db->getVar('SELECT precio FROM extras WHERE id=11');
	$precio_extras_7 += $precio_extras_7 * $pvp / 100;
} else {
	$precio_extras_7 = 0;
}

if ($extras_8 > 0) {
	$precio_extras_8 = $db->getVar('SELECT precio FROM extras WHERE id=12');
	$precio_extras_8 += $precio_extras_8 * $pvp / 100;
} else {
	$precio_extras_8 = 0;
}

if ($extras_9 > 0) {
	$precio_extras_9 = $db->getVar('SELECT precio FROM extras WHERE id=13');
	$precio_extras_9 += $precio_extras_9 * $pvp / 100;
} else {
	$precio_extras_9 = 0;
}


if ($albanileria_sencilla > 0) {
	$precio_albanileria_sencilla = $db->getVar('SELECT precio FROM albanileria WHERE id=' . $albanileria_sencilla);
	$precio_albanileria_sencilla += $precio_albanileria_sencilla * $pvp / 100;
} else {
	$precio_albanileria_sencilla = 0;
}

if ($albanileria_tirar_tabique > 0) {
	$precio_albanileria_tirar_tabique = $db->getVar('SELECT precio FROM albanileria WHERE id=' . $albanileria_tirar_tabique);
	$precio_albanileria_tirar_tabique += $precio_albanileria_tirar_tabique * $pvp / 100;
} else {
	$precio_albanileria_tirar_tabique = 0;
}

if ($albanileria_quitar_solera > 0) {
	$precio_albanileria_quitar_solera = $db->getVar('SELECT precio FROM albanileria WHERE id=' . $albanileria_quitar_solera);
	$precio_albanileria_quitar_solera += $precio_albanileria_quitar_solera * $pvp / 100;
} else {
	$precio_albanileria_quitar_solera = 0;
}

if ($albanileria_mover_enchufe > 0) {
	$precio_albanileria_mover_enchufe = $db->getVar('SELECT precio FROM albanileria WHERE id=' . $albanileria_mover_enchufe);
	$precio_albanileria_mover_enchufe += $precio_albanileria_mover_enchufe * $pvp / 100;
} else {
	$precio_albanileria_mover_enchufe = 0;
}

if ($albanileria_costado_pladur > 0) {
	$precio_albanileria_costado_pladur = $db->getVar('SELECT precio FROM albanileria WHERE id=' . $albanileria_costado_pladur);
	$precio_albanileria_costado_pladur += $precio_albanileria_costado_pladur * $pvp / 100;
} else {
	$precio_albanileria_costado_pladur = 0;
}

$respuesta = array();
$respuesta['ancho_led'] = $medidas_ancho;
// PRECIO DEL FRENTE
$respuesta['precio_frente'] = number_format($precio_frente, 2, ".", "");
// PRECIO DEL INCREMENTO O DESCUENTO POR ALTURA
$respuesta['cant_incremento_descuento'] = number_format(round($cant_inc_desc_frente, 2), 2, ".", "");
// PLUS GREY STONE
$respuesta['plus_grey_stone'] = number_format($plus_grey_stone, 2, ".", "");
// PLUS CREAM STONE
$respuesta['plus_cream_stone'] = number_format($plus_cream_stone, 2, ".", "");
// PLUS DARK GREY
$respuesta['plus_dark_grey'] = number_format($plus_dark_grey + $plus_dark_grey * $pvp / 100, 2, ".", "");
// PRECIO DE LAS CERÁMICAS SI TIENE
$respuesta['ceramicas'] = number_format($precio_ceramica, 2, ".", "");
// PRECIO DEL INTERIOR
$respuesta['precio_modulos_interior'] = number_format(round($precio_modulos_interior, 2), 2, ".", "");
$respuesta['precio_accesorios_interior'] = number_format(round($precio_accesorios_interior, 2), 2, ".", "");
// PRECIO DEL INCREMENTO O DESCUENTO POR ALTURA
$respuesta['cant_incremento_descuento_interior'] = number_format(round($cant_inc_desc_interior, 2), 2, ".", "");

// SE MULTIPLICA TODO POR 1.35 PARA AÑADIR UN 35% QUE SERÁ EL PRECIO DEL CLIENTE
// PRECIO DE LOS COSTADOS
$respuesta['precio_costados'] = number_format($precio_costados * 1.35, 2, ".", "");
// PRECIO DE LOS FIJOS
$respuesta['precio_fijos'] = number_format($precio_fijos * 1.35, 2, ".", "");

// PRECIO DEL JUEGO LED
$respuesta['precio_juego_led'] = number_format($precio_juego_led * 1.35, 2, ".", "");
// PRECIO REMATAR FRENTE
$respuesta['precio_rematar_frente'] = number_format($precio_rematar_frente * 1.35, 2, ".", "");
// PRECIO REMATAR INTERIOR
$respuesta['precio_rematar_interior'] = number_format($precio_rematar_interior * 1.35, 2, ".", "");
// PRECIO SISTEMA FRENOS
$respuesta['precio_sistema_frenos'] = number_format($precio_sistema_frenos * 1.35, 2, ".", "");
// PRECIO HERRAJES NEGROS
$respuesta['precio_herrajes_negros'] = number_format($precio_herrajes_negros * 1.35, 2, ".", "");
// PRECIO MULTITALADRO
$respuesta['precio_multitaladro'] = number_format($precio_multitaladro * 1.35, 2, ".", "");
// PRECIO ESPEJO EXTRAIBLE
$respuesta['precio_espejo_extraible'] = number_format($precio_espejo_extraible * 1.35, 2, ".", "");
// PRECIO ESPEJO CON CARRIL
$respuesta['precio_espejo_con_carril'] = number_format($precio_espejo_con_carril * 1.35, 2, ".", "");
// PRECIO BALDAS INCLINADAS
$respuesta['precio_baldas_inclinadas'] = number_format($precio_baldas_inclinadas * 1.35, 2, ".", "");
// PRECIO REMATE INTERIOR
$respuesta['precio_remate_interior'] = number_format($precio_remate_interior * 1.35, 2, ".", "");
// PRECIO REGLETA LED
$respuesta['precio_regleta_led'] = number_format($precio_regleta_led * 1.35, 2, ".", "");
// PRECIO SENSORES LED
$respuesta['precio_leds_incrustados'] = number_format($precio_leds_incrustados * 1.35, 2, ".", "");
// PRECIO FRENTE ABUARDILLADO
$respuesta['precio_frente_abuardillado'] = number_format($precio_frente_abuardillado * 1.35, 2, ".", "");
// PRECIO FRENTE CHAFLAN
$respuesta['precio_frente_chaflan'] = number_format($precio_frente_chaflan * 1.35, 2, ".", "");
// PRECIO RECRECER FRENTE
$respuesta['precio_recrecer_frente'] = number_format($precio_recrecer_frente * 1.35, 2, ".", "");
// PRECIO KIT PLEGABLE
$respuesta['precio_kit_plegable'] = number_format($precio_kit_plegable * 1.35, 2, ".", "");
// PRECIO TIRADOR CUBO
$respuesta['precio_tirador_cubo'] = number_format($precio_tirador_cubo * 1.35, 2, ".", "");
// PRECIO TIRADOR DISC
$respuesta['precio_tirador_disc'] = number_format($precio_tirador_disc * 1.35, 2, ".", "");
// PRECIO TIRADOR CONIC
$respuesta['precio_tirador_conic'] = number_format($precio_tirador_conic * 1.35, 2, ".", "");
// PRECIO TIRADOR LINE
$respuesta['precio_tirador_line'] = number_format($precio_tirador_line * 1.35, 2, ".", "");
// PRECIO UNERO REBAJADO
$respuesta['precio_unero_rebajado'] = number_format($precio_unero_rebajado * 1.35, 2, ".", "");
// PRECIO UNERO COLOR MADERA
$respuesta['precio_unero_color_madera'] = number_format($precio_unero_color_madera * 1.35, 2, ".", "");
// PRECIO KM MEDICION
$respuesta['precio_km_medicion'] = number_format($precio_km_medicion * 1.35, 2, ".", "");
// PRECIO KM MONTAJE
$respuesta['precio_km_montaje'] = number_format($precio_km_montaje * 1.35, 2, ".", "");


// ESTO NO LLEVA 35% INCREMENTO
// PRECIO DEL DESMONTAJE DEL FRENTE
$respuesta['precio_desmontaje_frente'] = number_format($precio_desmontaje_frente, 2, ".", "");
// PRECIO DEL DESMONTAJE DEL INTERIOR
$respuesta['precio_desmontaje_interior'] = number_format($precio_desmontaje_interior, 2, ".", "");
// PRECIO DEL DESMONTAJE
$respuesta['precio_desmontaje'] = number_format($precio_desmontaje, 2, ".", "");
// PRECIO DEL MONTAJE
// $respuesta['precio_montaje'] = number_format($precio_montaje, 2, ".", "");
// PRECIO ALBAÑILERIA CON SOLERA
$respuesta['precio_albanileria_con'] = number_format($precio_albanileria_con, 2, ".", "");
// PRECIO ALBAÑILERIA SIN SOLERA
$respuesta['precio_albanileria_sin'] = number_format($precio_albanileria_sin, 2, ".", "");

// PRECIO DE LOS EXTRAS
$respuesta['precio_extras_1'] = number_format($precio_extras_1, 2, ".", "");
$respuesta['precio_extras_2'] = number_format($precio_extras_2, 2, ".", "");
$respuesta['precio_extras_3'] = number_format($precio_extras_3, 2, ".", "");
$respuesta['precio_extras_4'] = number_format($precio_extras_4, 2, ".", "");
$respuesta['precio_extras_5'] = number_format($precio_extras_5, 2, ".", "");
$respuesta['precio_extras_6'] = number_format($precio_extras_6, 2, ".", "");
$respuesta['precio_extras_7'] = number_format($precio_extras_7, 2, ".", "");
$respuesta['precio_extras_8'] = number_format($precio_extras_8, 2, ".", "");
$respuesta['precio_extras_9'] = number_format($precio_extras_9, 2, ".", "");

// PRECIO DE LA ALBAÑILERIA
$respuesta['precio_albanileria_sencilla'] = number_format($precio_albanileria_sencilla, 2, ".", "");
$respuesta['precio_albanileria_tirar_tabique'] = number_format($precio_albanileria_tirar_tabique, 2, ".", "");
$respuesta['precio_albanileria_quitar_solera'] = number_format($precio_albanileria_quitar_solera, 2, ".", "");
$respuesta['precio_albanileria_mover_enchufe'] = number_format($precio_albanileria_mover_enchufe, 2, ".", "");
$respuesta['precio_albanileria_costado_pladur'] = number_format($precio_albanileria_costado_pladur, 2, ".", "");

// PRECIO DEL MOONTAJE (YA INCLUIDO)
$montaje = 0;
if($precio_frente > 0 && $precio_modulos_interior > 0)
{
	$montaje = $db->getVar('SELECT precio FROM montajes_completo WHERE modulos=' . $num_puertas);
}
else if($precio_frente > 0 && $precio_modulos_interior == 0)
{
	$montaje = $db->getVar('SELECT precio FROM montajes_frentes WHERE id_series=' . $serie . ' AND hojas=' . $num_puertas);
}
else if($precio_frente == 0 && $precio_modulos_interior > 0)
{
	$montaje = $db->getVar('SELECT precio FROM montajes_interiores WHERE modulos=' . $num_puertas);
}
$respuesta['precio_montaje'] = number_format($montaje, 2, ".", "");



// PRECIO TOTAL SIN IVA Y SIN DESCUENTO
$respuesta['total'] = number_format($respuesta['precio_frente'] + $respuesta['cant_incremento_descuento'] + $plus_cream_stone + $plus_grey_stone + $respuesta['precio_modulos_interior'] + $respuesta["precio_montaje"] +  $respuesta['precio_accesorios_interior'] + $respuesta['cant_incremento_descuento_interior'] + $respuesta['precio_costados'] + $respuesta['precio_fijos'] + $respuesta['precio_desmontaje_frente'] + $respuesta['precio_desmontaje_interior'] + $respuesta['precio_desmontaje'] + $respuesta['precio_juego_led'] + $respuesta['precio_rematar_frente'] + $respuesta['precio_rematar_interior'] + $respuesta['precio_sistema_frenos'] + $respuesta['precio_herrajes_negros'] + $respuesta["precio_multitaladro"] + $respuesta['precio_espejo_extraible'] + $respuesta['precio_espejo_con_carril'] + $respuesta['precio_baldas_inclinadas'] + $respuesta['precio_remate_interior'] + $respuesta['precio_regleta_led'] + $respuesta['precio_leds_incrustados'] + $respuesta['precio_frente_abuardillado'] + $respuesta['precio_frente_chaflan'] + $respuesta["precio_recrecer_frente"] + $respuesta["precio_kit_plegable"] + $respuesta["precio_tirador_cubo"] + $respuesta["precio_tirador_disc"] + $respuesta["precio_tirador_conic"] + $respuesta["precio_tirador_line"] + $respuesta["precio_unero_rebajado"] + $respuesta["precio_unero_color_madera"] + $respuesta['precio_albanileria_con'] + $respuesta['precio_albanileria_sin'] + $respuesta['precio_km_medicion'] + $respuesta['precio_km_montaje'] + $respuesta['precio_extras_1'] + $respuesta['precio_extras_2'] + $respuesta['precio_extras_3'] + $respuesta['precio_extras_4'] + $respuesta['precio_extras_5'] + $respuesta['precio_extras_6'] + $respuesta['precio_extras_7'] + $respuesta['precio_extras_8'] + $respuesta['precio_extras_9'] + $respuesta['precio_albanileria_sencilla'] + $respuesta['precio_albanileria_tirar_tabique'] + $respuesta['precio_albanileria_quitar_solera'] + $respuesta['precio_albanileria_mover_enchufe'] + $respuesta['precio_albanileria_costado_pladur'], 2, ".", "");
// IVA CORRESPONDIENTE AL PRECIO TOTAL
$respuesta['iva'] = number_format(round($respuesta['total'] * $_SESSION['iva'] / 100, 2), 2, ".", "");
// PRECIO PARA EL DISTRIBUIDOR CON SU DESCUENTO PARA FRENTE, INTERIOR, TAPETAS Y LATERALES
$precio_distribuidor = ($precio_frente + $cant_inc_desc_frente + $precio_modulos_interior + $cant_inc_desc_interior + $precio_accesorios_interior) / 1.35 + $precio_costados + $precio_fijos + $precio_juego_led + $precio_rematar_frente + $precio_rematar_interior + $precio_sistema_frenos + $precio_herrajes_negros + $precio_multitaladro + $precio_espejo_extraible + $precio_espejo_con_carril + $precio_baldas_inclinadas + $precio_remate_interior +$precio_regleta_led + $precio_leds_incrustados + $precio_frente_abuardillado + $precio_frente_chaflan + $precio_recrecer_frente + $precio_kit_plegable + $precio_tirador_cubo + $precio_tirador_disc + $precio_tirador_conic + $precio_tirador_line + $precio_unero_rebajado + $precio_unero_color_madera;
// PRECIO PARA EL DISTRIBUIDOR CON IVA
$precio_distribuidor_iva = round($precio_distribuidor + $precio_distribuidor * $_SESSION['iva'] / 100, 2);
// REFERENCIA DE PRECIO PARA EL DISTRIBUIDOR, ESTARÁ COMPUESTA POR LA TARIFA, EL PORCENTAJE DE DESCUENTO QUE TIENE EL DISTRIBUIDOR Y EL PRECIO FINAL PARA EL DISTRIBUIDOR
$respuesta['referencia'] = str_pad($tarifa, 2, "0", STR_PAD_LEFT) . "-" . str_pad(number_format($precio_distribuidor_iva, 2, ".", ""), 10, "0", STR_PAD_BOTH);

// PRECIO DISTRIBUIDOR 2
$precio_distribuidor_2 = $precio_desmontaje_frente + $precio_desmontaje_interior + $precio_desmontaje + $precio_albanileria_con + $precio_albanileria_sin + $montaje;
$respuesta['referencia_2'] = str_pad("2", 2, "0", STR_PAD_LEFT) . "-" . str_pad(number_format($precio_distribuidor_2 + $precio_distribuidor_2 * $_SESSION['iva'] / 100, 2, ".", ""), 10, "0", STR_PAD_BOTH);

echo json_encode($respuesta);
