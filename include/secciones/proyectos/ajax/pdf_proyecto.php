<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] != "logged")
	die();

require_once "include/secciones/proyectos/functions/data_armarios.php";

$distribuidor = $db->getRow('SELECT um.nombre, um.cif, um.direccion, um.poblacion, um.cp, um.provincia, um.email, um.telefono FROM usuarios_mod as um, usuarios as u WHERE um.id=u.id_usuarios_mod AND u.id=' . $_SESSION['id_usuario']);

$proyecto = $db->getRow('SELECT id_usuario, id_tarifa, descuento, id_serie, id_acabado, id_color_perfileria, ancho, alto, fondo, num_puertas, diseno_puerta_1, diseno_puerta_2, diseno_puerta_3, diseno_puerta_4, diseno_puerta_5, diseno_puerta_6, diseno_puerta_7, diseno_puerta_8, ceramica_puerta_1, ceramica_puerta_2, ceramica_puerta_3, ceramica_puerta_4, ceramica_puerta_5, ceramica_puerta_6, ceramica_puerta_7, ceramica_puerta_8, colores_puerta_1, colores_puerta_2, colores_puerta_3, colores_puerta_4, colores_puerta_5, colores_puerta_6, colores_puerta_7, colores_puerta_8, num_modulos_interior, interior_puerta_1, interior_puerta_2, interior_puerta_3, interior_puerta_4, interior_puerta_5, interior_puerta_6, interior_puerta_7, interior_puerta_8, laterales_seleccionado, tapetas_seleccionado, costados_seleccionado, fijos_seleccionado, montaje_frente_seleccionado, montaje_interior_seleccionado, desmontaje_frente_seleccionado, desmontaje_interior_seleccionado, juego_led_seleccionado, rematar_frente_seleccionado, rematar_interior_seleccionado, montaje_frente_arjomy_seleccionado, montaje_interior_arjomy_seleccionado, desmontaje_frente_arjomy_seleccionado, desmontaje_interior_arjomy_seleccionado, juego_led_arjomy_seleccionado, rematar_frente_arjomy_seleccionado, sistema_frenos_seleccionado, regleta_led_seleccionado, frente_abuardillado_seleccionado, albanileria_con_seleccionado, albanileria_sin_seleccionado, precio_frente, inc_desc_frente, cant_inc_desc_frente, precio_ceramica, precio_modulos_interior, precio_accesorios_interior, inc_desc_interior, cant_inc_desc_interior, precio_tapetas, precio_laterales, precio_costados, precio_fijos, precio_montaje_frente, precio_montaje_interior, precio_desmontaje_frente, precio_desmontaje_interior, precio_juego_led, precio_rematar_frente, precio_rematar_interior, precio_sistema_frenos, precio_regleta_led, precio_frente_abuardillado, precio_albanileria_con, precio_albanileria_sin, precio_costados_dist, precio_fijos_dist, precio_montaje_frente_dist, precio_montaje_interior_dist, precio_desmontaje_frente_dist, precio_desmontaje_interior_dist, precio_juego_led_dist, precio_rematar_frente_dist, precio_sistema_frenos_dist, aplicar_descuento, descuento_cliente, porcentaje_iva, iva, precio_total, observaciones, nombre_cliente, dni_cliente, direccion_cliente, poblacion_cliente, cp_cliente, provincia_cliente, telefono_cliente, email_cliente, horario_cliente, fecha_proyecto, precio_km_medicion, precio_km_montaje, precio_extras_1, precio_extras_2, precio_extras_3, precio_extras_4, precio_extras_5, precio_extras_6, precio_extras_7, precio_extras_8, precio_extras_9, precio_extras_10, precio_extras_11, precio_extras_12, precio_extras_13, precio_desmontaje, precio_albanileria_sencilla, precio_albanileria_tirar_tabique, precio_albanileria_quitar_solera, precio_albanileria_mover_enchufe, precio_albanileria_costado_pladur,leds_incrustados,herrajes_negros,multitaladro,espejo_extraible,espejo_carril,baldas_inclinadas,kit_plegable,recrecer_frente FROM proyectos WHERE id_usuario=' . $_SESSION['id_usuario'] . ' AND id=' . $id . ' AND eliminado=0');

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
$tarifa = $db->getVar('SELECT porcentaje FROM tarifa WHERE id='.$proyecto['id_tarifa']);

$plus_cream_stone = 0;
$plus_grey_stone = 0;
$plus_dark_grey = 0;
$incremento_ral = 0;

$result_puertas = extractColorPuerta($db,$proyecto['num_puertas'],$proyecto);

$plus_cream_stone = $result_puertas['cream_stone'];
$plus_grey_stone = $result_puertas['grey_stone'];
$plus_dark_grey = $result_puertas['dark_grey'];
$incremento_ral = $result_puertas['incremento_ral'];

if($incremento_ral == 1)
{
	$valor_incremento = 20 / 100;
	$incremento_ral =  (intval($proyecto['precio_frente']) + intval($proyecto['cant_inc_desc_frente']))  * $valor_incremento; 
}

$plus_dark_grey = $plus_dark_grey + (($plus_dark_grey*$tarifa) / 100);

if($proyecto['num_modulos_interior'] > 0)
{
	$modulos_dobles = $proyecto['num_puertas'] - $proyecto['num_modulos_interior'];
	$modulos_simples = $proyecto['num_modulos_interior'] - $modulos_dobles;

	$res_dobles = extractColorInterior($modulos_dobles,$db);
	$plus_cream_stone+=$res_dobles['cream_stone'];
	$plus_grey_stone+=$res_dobles['grey_stone'];

	$res_simples = extractColorInterior($modulos_simples,$db);
	$plus_cream_stone+=$res_simples['cream_stone'];
	$plus_grey_stone+=$res_simples['grey_stone'];
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Generacion PDF</title>
	<link rel="icon" type="image/png" href="www/img/logo_arjomy.png">
	<link rel="stylesheet" type="text/css" href="www/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="include/secciones/proyectos/functions/pdf-style.css" />

	<script type="text/javascript" src="www/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="include/secciones/proyectos/functions/html2pdf.bundle.min.js"></script>
</head>

<body>
	<main id="generation-container">
		<div class="cabecera_impresion" style="float: left; width: 100%; font-size: 12px; margin-bottom: 10px;">
			<div class="logo_cabecera_impresion" style="float: left; width: 130px; margin-right: 20px;">
				<img src="www/img/logo_arjomy.png" style="width: 100%" ; />
			</div>
			<div class="datos_arjomy_impresion" style="float: left; width: 110px;">
				<img src="www/img/logo_leroy.png" style="width: 100%" ; />
			</div>
			<div class="datos_distribuidor_impresion" style="float: right; width: 300px; text-align: right;">
				<h3>Distribuidor</h3>
				<?php echo $distribuidor['nombre']; ?><br />
				<?php echo $distribuidor['cif']; ?><br />
				<?php echo $distribuidor['direccion']; ?><br />
				<?php echo $distribuidor['cp']; ?> - <?php echo $distribuidor['poblacion']; ?> (<?php echo $distribuidor['provincia']; ?>)<br />
				<?php echo $distribuidor['email']; ?><br />
				<?php echo $distribuidor['telefono']; ?>
			</div>
		</div>
		<div class="fila_proyecto" style="margin-top: 30px;">
			<div id="titulo_proyecto" class="titulo_proyecto" style="float: left; width: 60%; font-size: 20px; font-weight: bold; font-family: 'Roboto Condensed',Arial,sans-serif;">
				PROYECTO P<?php echo str_pad($id, 6, "0", STR_PAD_LEFT); ?>
			</div>
			<div class="fecha_proyecto" style="float: left; width: 40%; font-size: 20px; font-weight: bold; text-align: right; font-family: 'Roboto Condensed',Arial,sans-serif;">
				<i class="fa fa-calendar"></i> <?php echo date("d/m/Y", strtotime($proyecto['fecha_proyecto'])); ?>
			</div>
		</div>
		<div class="fila_proyecto cliente">
			<h2>Cliente</h2>
			<div class="item_fila_proyecto" style="float: left; width: 300px; margin-right: 20px;">
				<?php echo $proyecto['nombre_cliente']; ?><br />
				<?php echo $proyecto['dni_cliente']; ?><br />
				<?php echo $proyecto['direccion_cliente']; ?><br />
				<?php echo $proyecto['cp_cliente']; ?> - <?php echo $proyecto['poblacion_cliente']; ?><br />
				<?php echo $proyecto['provincia_cliente']; ?>
			</div>
			<div class="item_fila_proyecto" style="float: left; width: 300px;">
				<i class="fa fa-envelope-o"></i> <?php echo $proyecto['email_cliente']; ?><br />
				<i class="fa fa-phone"></i> <?php echo $proyecto['telefono_cliente']; ?><br />
				<i class="fa fa-clock-o"></i> <?php echo $proyecto['horario_cliente']; ?>
			</div>
		</div>
		<div class="fila_proyecto">
			<div class="item_fila_proyecto" style="float: left; width: 33.33%; box-sizing: border-box; padding-right: 10px; line-height: 24px;">
				<h2>Serie</h2>
				<?php if ($serie) {
					echo $serie;
				} else {
					echo "Solo interior";
				} ?>
			</div>
			<div class="item_fila_proyecto" style="float: left; width: 33.33%; box-sizing: border-box; padding: 0px 10px; line-height: 24px;">
				<h2>Acabado</h2>
				<?php if ($acabado) {
					echo $acabado;
				} else {
					echo "-";
				} ?>
			</div>
			<div class="item_fila_proyecto" style="float: left; width: 33.33%; box-sizing: border-box; padding-left: 10px; line-height: 24px;">
				<h2>Color perfilería</h2>
				<?php if ($perfileria) {
					echo $perfileria['nombre']; ?><br /><img src="www/img/colores/<?php echo $perfileria['imagen']; ?>" title="<?php echo $perfileria['nombre']; ?>" width="100px" /> <?php } else {
																																																																																						echo "-";
																																																																																					} ?>
			</div>
			<div class="item_fila_proyecto" style="float: left; width: 33.33%; box-sizing: border-box; padding-right: 10px; line-height: 24px;">
				<h2>Medidas totales</h2>
				Alto: <?php echo $proyecto['alto']; ?> cm.<br />Ancho: <?php echo $proyecto['ancho']; ?> cm.<br />Fondo: <?php echo $proyecto['fondo']; ?> cm.
			</div>
			<div class="item_fila_proyecto" style="float: left; width: 33.33%; box-sizing: border-box; padding: 0px 10px; line-height: 24px;">
				<h2>Nº Puertas</h2>
				<?php echo $proyecto['num_puertas']; ?>
			</div>
		</div>
		<?php
		if ($serie) { // Si no es solo interior
		?>
			<div class="fila_proyecto">
				<h2>Frente</h2>
				<div class="fila_proyecto_frente puertas-<?php echo $proyecto['num_puertas']; ?>">
					<?php for ($i = 1; $i <= $proyecto['num_puertas']; $i++) { ?>
						<?php $img_puerta = $db->getVar('SELECT imagen FROM puertas WHERE id=' . ${"diseno_puerta_" . $i}[2]); ?>
						<div class="item_fila_proyecto_frente" style="float: left; width: 80px;">
							<h3 style="text-align: center; margin-top: 20px;">P<?php echo $i; ?></h3>
							<img id="puerta-<?php echo $i; ?>" src="www/img/disenos/<?php echo $proyecto['id_serie']; ?>/<?php echo $proyecto['id_acabado']; ?>/<?php echo ${"diseno_puerta_" . $i}[0]; ?>/<?php echo ${"diseno_puerta_" . $i}[1]; ?>/<?php echo $img_puerta; ?>" width="100%" />
						</div>
					<?php } ?>
				</div>
			</div>

			<div style="display:block; page-break-after: always;"></div>

			<div style="display: inline-block; width: 100%;">
				<div class="cabecera_impresion" style="float: left; width: 100%; font-size: 12px; margin-bottom: 10px;">
					<div class="logo_cabecera_impresion" style="float: left; width: 130px; margin-right: 20px;">
						<img src="www/img/logo_arjomy.png" style="width: 100%" ; />
					</div>
					<div class="datos_arjomy_impresion" style="float: left; width: 110px;">
						<img src="www/img/logo_leroy.png" style="width: 100%" ; />
					</div>
					<div class="datos_distribuidor_impresion" style="float: right; width: 300px; text-align: right;">
						<h3>Distribuidor</h3>
						<?php echo $distribuidor['nombre']; ?><br />
						<?php echo $distribuidor['cif']; ?><br />
						<?php echo $distribuidor['direccion']; ?><br />
						<?php echo $distribuidor['cp']; ?> - <?php echo $distribuidor['poblacion']; ?> (<?php echo $distribuidor['provincia']; ?>)<br />
						<?php echo $distribuidor['email']; ?><br />
						<?php echo $distribuidor['telefono']; ?>
					</div>
				</div>


				<div class="fila_proyecto" style="margin-bottom: 0px;">
					<?php for ($i = 1; $i <= $proyecto['num_puertas']; $i++) { ?>

						<?php if ($i == 5) { ?>
				</div>
			</div>
			<div style="display:block; page-break-after: always;"></div>
			<div style="display: inline-block; width: 100%;">
				<div class="cabecera_impresion" style="float: left; width: 100%; font-size: 12px; margin-bottom: 10px;">
					<div class="logo_cabecera_impresion" style="float: left; width: 130px; margin-right: 20px;">
						<img src="www/img/logo_arjomy.png" style="width: 100%" ; />
					</div>
					<div class="datos_arjomy_impresion" style="float: left; width: 110px;">
						<img src="www/img/logo_leroy.png" style="width: 100%" ; />
					</div>
					<div class="datos_distribuidor_impresion" style="float: right; width: 300px; text-align: right;">
						<h3>Distribuidor</h3>
						<?php echo $distribuidor['nombre']; ?><br />
						<?php echo $distribuidor['cif']; ?><br />
						<?php echo $distribuidor['direccion']; ?><br />
						<?php echo $distribuidor['cp']; ?> - <?php echo $distribuidor['poblacion']; ?> (<?php echo $distribuidor['provincia']; ?>)<br />
						<?php echo $distribuidor['email']; ?><br />
						<?php echo $distribuidor['telefono']; ?>
					</div>
				</div>
				<div class="fila_proyecto" style="margin-bottom: 0px;">
				<?php } ?>



				<?php $diseno_puerta = $db->getRow('SELECT d.nombre as diseno, t.nombre as terminacion FROM disenos as d, terminaciones as t WHERE d.id=' . ${"diseno_puerta_" . $i}[0] . ' AND t.id=' . ${"diseno_puerta_" . $i}[1]); ?>
				<div class="item_diseno_puertas" style="display: inline-block; width: 47%; margin: 0 1%; height: 440px;">
					<h3>Puerta <?php echo $i; ?></h3>
					<div class="diseno_puerta" style="float: left; width: 50%;">
						<h4>Diseño</h4>
						<?php echo $diseno_puerta['diseno']; ?><br />
						<?php echo $diseno_puerta['terminacion']; ?><br />
						<?php if ($diseno_puerta['terminacion'] == 20 || $diseno_puerta['terminacion'] == 21) { ?>
							<?php $ceramica = $db->getVar('SELECT nombre FROM ceramicas WHERE id=' . $proyecto['ceramica_puerta_' . $i]); ?>
							<?php echo $ceramica; ?>
						<?php } ?>
						<?php //$img_puerta = $db->getVar('SELECT imagen FROM puertas WHERE id='.${"diseno_puerta_" . $i}[2]); 
						?>
						<img id="puerta-diseno-<?php echo $i; ?>" src="" style="width: 80px; margin-top: 20px;" />
						<script type="text/javascript">
							$('#puerta-diseno-<?php echo $i; ?>').attr('src', $('#puerta-<?php echo $i; ?>').attr('src'));
						</script>
					</div>
					<div class="colores_puerta" style="float: left; width: 50%;">
						<h4>Colores</h4>
						<?php $zonas_puerta = $db->getResults('SELECT pz.zona as zona, pz.id_colores_tipo as id_colores_tipo, ct.nombre as tipo FROM puertas_zonas as pz, disenos_puertas as dp, colores_tipo as ct WHERE pz.id_disenos_puertas = dp.id AND pz.id_colores_tipo = ct.id AND dp.id_acabados = ' . $proyecto['id_acabado'] . ' AND dp.id_disenos = ' . ${"diseno_puerta_" . $i}[0] . ' AND dp.id_terminaciones = ' . ${"diseno_puerta_" . $i}[1] . ' AND dp.id_puertas = ' . ${"diseno_puerta_" . $i}[2] . ' ORDER BY pz.zona'); ?>
						<?php
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
						?>
							<h5><?php echo $nombre_zona; ?></h5>
							<div class="color_zona_<?php echo $zona_puerta['zona']; ?>">
								<div class="imagen_zona">&nbsp;&nbsp;&nbsp;<span style="font-size: 12px;"><?php echo $nombre_color_zona; ?></span><br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/<?php echo $imagen_color_zona; ?>" style="width: 75px;" /></div>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			<?php } ?>
				</div>
			</div>
		<?php
		}
		?>

		<?php
		if ($proyecto['num_modulos_interior'] > 0) {
			$modulos_dobles = $proyecto['num_puertas'] - $proyecto['num_modulos_interior'];
			$modulos_simples = $proyecto['num_modulos_interior'] - $modulos_dobles;
		?>
			<div style="display:block; page-break-after: always;"></div>
			<div style="display:inline-block; width: 100%;">
				<div class="cabecera_impresion" style="float: left; width: 100%; font-size: 12px; margin-bottom: 10px;">
					<div class="logo_cabecera_impresion" style="float: left; width: 130px; margin-right: 20px;">
						<img src="www/img/logo_arjomy.png" style="width: 100%" ; />
					</div>
					<div class="datos_arjomy_impresion" style="float: left; width: 110px;">
						<img src="www/img/logo_leroy.png" style="width: 100%" ; />
					</div>
					<div class="datos_distribuidor_impresion" style="float: right; width: 300px; text-align: right;">
						<h3>Distribuidor</h3>
						<?php echo $distribuidor['nombre']; ?><br />
						<?php echo $distribuidor['cif']; ?><br />
						<?php echo $distribuidor['direccion']; ?><br />
						<?php echo $distribuidor['cp']; ?> - <?php echo $distribuidor['poblacion']; ?> (<?php echo $distribuidor['provincia']; ?>)<br />
						<?php echo $distribuidor['email']; ?><br />
						<?php echo $distribuidor['telefono']; ?>
					</div>
				</div>

				<div class="fila_proyecto">
					<h2>Interior</h2>
					<div class="fila_proyecto_interior" style="float:left; width:100%; margin-bottom: 0px;">
						<?php
						$num_modulo = 0;
						for ($j = 1; $j <= $modulos_dobles; $j++) {
							$num_modulo++;
						?>
							<div class="item_fila_proyecto_interior" style="float: left; width: 87px; margin: 20px 0px;">
								<h3 style="text-align: center;">M<?php echo $num_modulo; ?>
									<center>(Doble)</center>
									<img id="img_modulo_<?php echo $num_modulo; ?>" src="www/img/interiores/modulo-<?php echo ${'interior_puerta_' . $num_modulo}[1]; ?>.jpg" style="float: left; width: 100%;" />
							</div>
						<?php
						}
						for ($j = 1; $j <= $modulos_simples; $j++) {
							$num_modulo++;
						?>
							<div class="item_fila_proyecto_interior" style="float: left; width: 87px; margin: 20px 0px;">
								<h3 style="text-align: center;">M<?php echo $num_modulo; ?></h3>
								<center>(Simple)</center>
								<img id="img_modulo_<?php echo $num_modulo; ?>" src="www/img/interiores/modulo-<?php echo ${'interior_puerta_' . $num_modulo}[1]; ?>.jpg" style="float: left; width: 100%;" />
							</div>
						<?php
						}
						?>
					</div>
					<div class="fila_proyecto_datos_interior" style="float:left; width: 100%; display: flex; flex-flow: wrap;">
						<?php
						$num_modulo = 0;
						for ($j = 1; $j <= $modulos_dobles; $j++) {
							$num_modulo++;

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
						?>
							<div class="item_fila_proyecto_datos_interior" style="display: inline-block; width: 22.5%; margin: 12px 1%;">
								<h4>M<?php echo $num_modulo; ?></h4>
								Módulo <?php echo ${'interior_puerta_' . $num_modulo}[1]; ?><br />
								Doble<br />
								<?php if(${'interior_puerta_'.$num_modulo}[2] > 0){ ?><li>Zapatero/s con freno</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[3] > 0){ ?><li>Cajon/es con freno</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[4] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[4]; ?> x J. celdillas</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[5] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[5]; ?> x Frente cristal</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[6] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[6]; ?> x Cerradura</li><?php } ?>
								<?php if(count(${'interior_puerta_'.$num_modulo}) > 9) { ?>
									
								<?php if(${'interior_puerta_'.$num_modulo}[15] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[15] ?> x Cajoneras Lacadas</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[16] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[16] ?> x Pantalonero premium</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[17] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[17] ?> x Zapatero premium</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[18] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[18] ?> x Cesta premium</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[19] != "undefined" && ${'interior_puerta_'.$num_modulo}[19] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[19]; ?> x Cajones de 8</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[20] != "undefined" && ${'interior_puerta_'.$num_modulo}[20] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[20]; ?> x Cajones de 16</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[21] != "undefined" && ${'interior_puerta_'.$num_modulo}[21] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[21]; ?> x Cajones de 20</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[22] != "undefined" && ${'interior_puerta_'.$num_modulo}[22] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[22]; ?> x Cajones de 32</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[23] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[24]; ?> x <?php if(${'interior_puerta_'.$num_modulo}[23] == 1){echo "Cristal Transparente";} else if(${'interior_puerta_'.$num_modulo}[23] == 2){echo "Cristal Matel";}?></li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[25] != ""){ ?><li>Gama: <?php echo ${'interior_puerta_'.$num_modulo}[25]; ?></li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[26] != ""){ ?><li>Modelo: <?php echo ${'interior_puerta_'.$num_modulo}[26]; ?></li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[27] != ""){ ?><li>Color: <?php echo ${'interior_puerta_'.$num_modulo}[27]; ?></li><?php } ?>
								<?php } ?>
								Color<br />&nbsp;&nbsp;&nbsp;<?php echo $color_interior['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/<?php echo $color_interior['imagen']; ?>" title="<?php echo $color_interior['nombre']; ?>" height="50" /><br />
								Cantoneras<br />&nbsp;&nbsp;&nbsp;<?php echo $color_cantoneras['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/<?php echo $color_cantoneras['imagen']; ?>" title="<?php echo $color_cantoneras['nombre']; ?>" height="50" />
							</div>
						<?php
						
						}
						for ($j = 1; $j <= $modulos_simples; $j++) {
							$num_modulo++;

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
							?>
							<div class="item_fila_proyecto_datos_interior" style="display: inline-block; width: 22.5%; margin: 12px 1%;">
								<h4>M<?php echo $num_modulo; ?></h4>
								Módulo <?php echo ${'interior_puerta_' . $num_modulo}[1]; ?><br />
								Simple<br />
								<?php if(${'interior_puerta_'.$num_modulo}[2] > 0){ ?><li>Zapatero/s con freno</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[3] > 0){ ?><li>Cajon/es con freno</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[4] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[4]; ?> x J. celdillas</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[5] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[5]; ?> x Frente cristal</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[6] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[6]; ?> x Cerradura</li><?php } ?>
								<?php if(count(${'interior_puerta_'.$num_modulo}) > 9) { ?>
									
								<?php if(${'interior_puerta_'.$num_modulo}[15] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[15] ?> x Cajoneras Lacadas</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[16] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[16] ?> x Pantalonero premium</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[17] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[17] ?> x Zapatero premium</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[18] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[18] ?> x Cesta premium</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[19] != "undefined" && ${'interior_puerta_'.$num_modulo}[19] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[19]; ?> x Cajones de 8</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[20] != "undefined" && ${'interior_puerta_'.$num_modulo}[20] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[20]; ?> x Cajones de 16</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[21] != "undefined" && ${'interior_puerta_'.$num_modulo}[21] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[21]; ?> x Cajones de 20</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[22] != "undefined" && ${'interior_puerta_'.$num_modulo}[22] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[22]; ?> x Cajones de 32</li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[23] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[24]; ?> x <?php if(${'interior_puerta_'.$num_modulo}[23] == 1){echo "Cristal Transparente";} else if(${'interior_puerta_'.$num_modulo}[23] == 2){echo "Cristal Matel";}?></li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[25] != ""){ ?><li>Gama: <?php echo ${'interior_puerta_'.$num_modulo}[25]; ?></li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[26] != ""){ ?><li>Modelo: <?php echo ${'interior_puerta_'.$num_modulo}[26]; ?></li><?php } ?>
								<?php if(${'interior_puerta_'.$num_modulo}[27] != ""){ ?><li>Color: <?php echo ${'interior_puerta_'.$num_modulo}[27]; ?></li><?php } ?>
								<?php } ?>
								Color<br />&nbsp;&nbsp;&nbsp;<?php echo $color_interior['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/<?php echo $color_interior['imagen']; ?>" title="<?php echo $color_interior['nombre']; ?>" height="50" /><br />
								Cantoneras<br />&nbsp;&nbsp;&nbsp;<?php echo $color_cantoneras['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="www/img/colores/<?php echo $color_cantoneras['imagen']; ?>" title="<?php echo $color_cantoneras['nombre']; ?>" height="50" />
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		<?php
		}
		?>

		<div style="display:block; page-break-after: always;"></div>

		<div style="display: inline-block; width: 100%;">
			<div class="cabecera_impresion" style="float: left; width: 100%; font-size: 12px;  margin-bottom: 10px;">
				<div class="logo_cabecera_impresion" style="float: left; width: 130px; margin-right: 20px;">
					<img src="www/img/logo_arjomy.png" style="width: 100%" ; />
				</div>
				<div class="datos_arjomy_impresion" style="float: left; width: 110px;">
					<img src="www/img/logo_leroy.png" style="width: 100%" ; />
				</div>
				<div class="datos_distribuidor_impresion" style="float: right; width: 300px; text-align: right;">
					<h3>Distribuidor</h3>
					<?php echo $distribuidor['nombre']; ?><br />
					<?php echo $distribuidor['cif']; ?><br />
					<?php echo $distribuidor['direccion']; ?><br />
					<?php echo $distribuidor['cp']; ?> - <?php echo $distribuidor['poblacion']; ?> (<?php echo $distribuidor['provincia']; ?>)<br />
					<?php echo $distribuidor['email']; ?><br />
					<?php echo $distribuidor['telefono']; ?>
				</div>
			</div>

			<?php
				if (
					$proyecto['sistema_frenos_seleccionado'] > 0 || $proyecto['tapetas_seleccionado'] > 0 || $proyecto['laterales_seleccionado'] > 0 || $proyecto['costados_seleccionado'] > 0 || $proyecto['fijos_seleccionado'] > 0 || $proyecto['regleta_led_seleccionado'] > 0 || $proyecto['frente_abuardillado_seleccionado'] > 0 || $proyecto['montaje_frente_seleccionado'] > 0 || $proyecto['rematar_frente_seleccionado'] > 0 || $proyecto['rematar_interior_seleccionado'] > 0 || $proyecto['juego_led_seleccionado'] > 0 || $proyecto['montaje_interior_seleccionado'] > 0 || $proyecto['desmontaje_frente_seleccionado'] > 0 || $proyecto['desmontaje_interior_seleccionado'] > 0 || $proyecto['albanileria_con_seleccionado'] > 0 || $proyecto['albanileria_sin_seleccionado'] > 0 ||
					$proyecto['precio_extras_1'] > 0 || $proyecto['precio_extras_2'] > 0 || $proyecto['precio_extras_3'] > 0 || $proyecto['precio_extras_4'] > 0 || $proyecto['precio_extras_5'] > 0 || $proyecto['precio_extras_6'] > 0 || $proyecto['precio_extras_7'] > 0 || $proyecto['precio_extras_8'] > 0 || $proyecto['precio_extras_9'] > 0 || $proyecto['precio_extras_10'] > 0 || $proyecto['precio_extras_11'] > 0 || $proyecto['precio_extras_12'] > 0 || $proyecto['precio_extras_13'] > 0 || $proyecto['precio_albanileria_sencilla'] || $proyecto['precio_albanileria_tirar_tabique'] || $proyecto['precio_albanileria_quitar_solera'] || $proyecto['precio_albanileria_mover_enchufe'] || $proyecto['precio_albanileria_costado_pladur'] || 
					$proyecto['leds_incrustados'] > 0 || $proyecto['herrajes_negros'] > 0 || $proyecto['multitaladro'] > 0 || $proyecto['espejo_extraible'] > 0 || $proyecto['espejo_carril'] > 0 || $proyecto['baldas_inclinadas'] > 0 || $proyecto['kit_plegable'] > 0 || $proyecto['recrecer_frente'] > 0
				){
				?>
					<div class="fila_proyecto">
						<h2>Extras</h2>
						<?php
						if ($proyecto['sistema_frenos_seleccionado'] > 0 || $proyecto['tapetas_seleccionado'] > 0 || $proyecto['laterales_seleccionado'] > 0 || $proyecto['costados_seleccionado'] > 0 || $proyecto['fijos_seleccionado'] > 0 || $proyecto['regleta_led_seleccionado'] > 0 || $proyecto['frente_abuardillado_seleccionado'] > 0 || $proyecto['montaje_frente_seleccionado'] > 0 || $proyecto['rematar_frente_seleccionado'] > 0) {
						?>
							<div class="item_fila_proyecto_otros">
								<h3>Frente</h3>
							</div>
							<?php if ($proyecto['tapetas_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<?php $tapetas = $db->getVar('SELECT nombre FROM tapetas WHERE id=' . $proyecto['tapetas_seleccionado']); ?>
									<i class="fa fa-check"></i> Juego de <?php echo $tapetas; ?>
								</div>
							<?php } ?>
							<?php if ($proyecto['laterales_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<?php $laterales = $db->getVar('SELECT nombre FROM laterales WHERE id=' . $proyecto['laterales_seleccionado']); ?>
									<i class="fa fa-check"></i> Juego de <?php echo $laterales; ?>
								</div>
							<?php } ?>
							<?php if ($proyecto['sistema_frenos_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Sistema de frenos para puertas
								</div>
							<?php } ?>
							<?php if ($proyecto['costados_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<?php $costados = $db->getVar('SELECT nombre FROM costados WHERE id=' . $proyecto['costados_seleccionado']); ?>
									<i class="fa fa-check"></i> <?php echo $costados; ?>
								</div>
							<?php } ?>
							<?php if ($proyecto['fijos_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<?php $costados = $db->getVar('SELECT nombre FROM fijos WHERE id=' . $proyecto['fijos_seleccionado']); ?>
									<i class="fa fa-check"></i> Fijos en <?php echo $costados; ?>
								</div>
							<?php } ?>
							<?php if ($proyecto['regleta_led_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Regletas led para puertas
								</div>
							<?php } ?>
							<?php if ($proyecto['frente_abuardillado_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Frente abuardillado
								</div>
							<?php } ?>
							<?php if ($proyecto['montaje_frente_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Montaje de frente de <?php echo $proyecto['montaje_frente_seleccionado']; ?> hojas
								</div>
							<?php } ?>
							<?php if ($proyecto['rematar_frente_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Remate de frente
								</div>
							<?php } ?>
						<?php } ?>
						<?php
						if ($proyecto['juego_led_seleccionado'] > 0 || $proyecto['montaje_interior_seleccionado'] > 0 || $proyecto['rematar_interior_seleccionado'] > 0) {
						?>
							<div class="item_fila_proyecto_otros">
								<h3>Interior</h3>
							</div>
							<?php if ($proyecto['juego_led_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Juego de led interior
								</div>
							<?php } ?>
							<?php if ($proyecto['montaje_interior_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Montaje de interior de <?php echo $proyecto['montaje_interior_seleccionado']; ?> módulos
								</div>
							<?php } ?>
							<?php if ($proyecto['rematar_interior_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Remate de interior
								</div>
							<?php } ?>
						<?php } ?>
						<?php
						if ($proyecto['albanileria_con_seleccionado'] > 0 || $proyecto['albanileria_sin_seleccionado'] > 0 || $proyecto['precio_albanileria_sencilla'] || $proyecto['precio_albanileria_tirar_tabique'] || $proyecto['precio_albanileria_quitar_solera'] || $proyecto['precio_albanileria_mover_enchufe'] || $proyecto['precio_albanileria_costado_pladur']) {
						?>
							<div class="item_fila_proyecto_otros">
								<h3>Albañilería</h3>
							</div>
							<?php if ($proyecto['precio_albanileria_sencilla'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Albanileria sencilla
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_albanileria_tirar_tabique'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Tirar tabique o maletero
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_albanileria_quitar_solera'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Quitar solera
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_albanileria_mover_enchufe'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Mover enchufe o interruptor
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_albanileria_costado_pladur'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Hacer costado de pladur
								</div>
							<?php } ?>
							<?php if ($proyecto['albanileria_con_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Albañilería con solera
								</div>
							<?php } ?>
							<?php if ($proyecto['albanileria_sin_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Albañilería sin solera
								</div>
							<?php } ?>
						<?php } ?>
						<?php
						if ($proyecto['desmontaje_frente_seleccionado'] > 0 || $proyecto['desmontaje_interior_seleccionado'] > 0 || $proyecto['precio_extras_1'] > 0 || $proyecto['precio_extras_2'] > 0 || $proyecto['precio_extras_3'] > 0 || $proyecto['precio_extras_4'] > 0 || $proyecto['precio_extras_5'] > 0 || $proyecto['precio_extras_6'] > 0 || $proyecto['precio_extras_7'] > 0 || $proyecto['precio_extras_8'] > 0 || $proyecto['precio_extras_9'] > 0 || $proyecto['precio_extras_10'] > 0 || $proyecto['precio_extras_11'] > 0 || $proyecto['precio_extras_12'] > 0 || $proyecto['precio_extras_13'] > 0 || $proyecto['leds_incrustados'] > 0 || $proyecto['herrajes_negros'] > 0 || $proyecto['multitaladro'] > 0 || $proyecto['espejo_extraible'] > 0 || $proyecto['espejo_carril'] > 0 || $proyecto['baldas_inclinadas'] > 0 || $proyecto['kit_plegable'] > 0 || $proyecto['recrecer_frente'] > 0) {
						?>
							<div class="item_fila_proyecto_otros">
								<h3>Otros</h3>
							</div>
							<?php if ($proyecto['desmontaje_frente_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<?php $desm_frente = $db->getVar('SELECT nombre FROM desmontajes_frentes WHERE id=' . $proyecto['desmontaje_frente_seleccionado']); ?>
									<i class="fa fa-check"></i> Desmontaje de frente de <?php echo $desm_frente; ?>
								</div>
							<?php } ?>
							<?php if ($proyecto['desmontaje_interior_seleccionado'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<?php $desm_interior = $db->getVar('SELECT nombre FROM desmontajes_interiores WHERE id=' . $proyecto['desmontaje_interior_seleccionado']); ?>
									<i class="fa fa-check"></i> Desmontaje de interior de <?php echo $desm_interior; ?>
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_1'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Rematar por dentro
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_2'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Módulo con viga
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_3'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Interior con chaflán
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_4'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Registro
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_5'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Desplazar punto de luz a costado
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_6'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Módulo forrado
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_7'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Módulo diamante
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_8'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Incremento por balda extra
								</div>
							<?php } ?>
							<?php if ($proyecto['precio_extras_9'] > 0) { ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Incremento por módulo partido
								</div>
							<?php } ?>
							<?php if ($proyecto['leds_incrustados'] > 0){ ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Leds incrustados
								</div>
							<?php } ?>
							<?php if ($proyecto['herrajes_negros'] > 0){ ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Herrajes negros
							<?php } ?>
							<?php if ($proyecto['multitaladro'] > 0){ ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Multitaladro
							<?php } ?>
							<?php if ($proyecto['espejo_extraible'] > 0){ ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Espejo extraíble
								</div>
							<?php } ?>
							<?php if ($proyecto['espejo_carril'] > 0){ ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Espejo carril
								</div>
							<?php } ?>
							<?php if ($proyecto['baldas_inclinadas'] > 0){ ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Baldas inclinadas
								</div>
							<?php } ?>
							<?php if ($proyecto['kit_plegable'] > 0){ ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Kit plegable
								</div>
							<?php } ?>
							<?php if ($proyecto['recrecer_frente'] > 0){ ?>
								<div class="item_fila_proyecto_otros">
									<i class="fa fa-check"></i> Recrecer frente
								</div>
							<?php } ?>

				<?php }}?>
				<?php
				if ($proyecto['observaciones'] != "") {
				?>
					<div class="fila_proyecto">
						<h2>Observaciones</h2>
						<div class="item_fila_proyecto_otros">
							<?php echo nl2br($proyecto['observaciones']); ?>
						</div>
					</div>
				<?php
				}
				?>
				<div class="fila_proyecto_precio">
					<h2>Precio</h2>
					<div class="item_fila_proyecto_precio">
						Precio frente: <span><?php echo number_format($proyecto['precio_frente'], 2, ".", ""); ?>€</span><br />
						<?php if ($proyecto['inc_desc_frente'] != "") { ?>
							<?php echo $proyecto['inc_desc_frente']; ?>: <span><?php echo number_format($proyecto['cant_inc_desc_frente'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_modulos_interior'] > 0) { ?>
							Precio interior: <span><?php echo number_format($proyecto['precio_modulos_interior'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['inc_desc_interior'] != "") { ?>
							<?php echo $proyecto['inc_desc_interior']; ?>: <span><?php echo number_format($proyecto['cant_inc_desc_interior'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_tapetas'] > 0) { ?>
							Precio tapetas: <span><?php echo number_format($proyecto['precio_tapetas'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_laterales'] > 0) { ?>
							Precio laterales: <span><?php echo number_format($proyecto['precio_laterales'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_ceramica'] > 0) { ?>
							Precio cerámica: <span><?php echo number_format($proyecto['precio_ceramica'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_accesorios_interior'] > 0) { ?>
							Precio accesorios: <span><?php echo number_format($proyecto['precio_accesorios_interior'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_sistema_frenos'] > 0) { ?>
							Precio sistema frenos: <span><?php echo number_format($proyecto['precio_sistema_frenos'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_regleta_led'] > 0) { ?>
							Precio regletas led: <span><?php echo number_format($proyecto['precio_regleta_led'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_frente_abuardillado'] > 0) { ?>
							Precio frente abuardillado: <span><?php echo number_format($proyecto['precio_frente_abuardillado'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_costados'] > 0) { ?>
							Precio costados: <span><?php echo number_format($proyecto['precio_costados'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_fijos'] > 0) { ?>
							Precio fijos: <span><?php echo number_format($proyecto['precio_fijos'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['montaje_frente_seleccionado'] > 0) { ?>
							Precio montaje frente: <span><?php echo number_format($proyecto['precio_montaje_frente'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['rematar_frente_seleccionado'] > 0) { ?>
							Precio remate frente: <span><?php echo number_format($proyecto['precio_rematar_frente'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['juego_led_seleccionado'] > 0) { ?>
							Precio juego led: <span><?php echo number_format($proyecto['precio_juego_led'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['rematar_interior_seleccionado'] > 0) { ?>
							Precio remate interior: <span><?php echo number_format($proyecto['precio_rematar_interior'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						Precio montaje: <span><?php echo number_format($proyecto['precio_montaje_frente'], 2, ".", ""); ?>€</span><br />
						<?php if ($proyecto['montaje_interior_seleccionado'] > 0) { ?>
							Precio montaje interior: <span><?php echo number_format($proyecto['precio_montaje_interior'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_desmontaje'] > 0) { ?>
							Precio desmontaje: <span><?php echo number_format($proyecto['precio_desmontaje'], 2, ".", ""); ?>€</span><br />
						<?php } else {
						?>
							<?php if ($proyecto['desmontaje_frente_seleccionado'] > 0) { ?>
								Precio desmontaje frente: <span><?php echo number_format($proyecto['precio_desmontaje_frente'], 2, ".", ""); ?>€</span><br />
							<?php } ?>
							<?php if ($proyecto['desmontaje_interior_seleccionado'] > 0) { ?>
								Precio desmontaje interior: <span><?php echo number_format($proyecto['precio_desmontaje_interior'], 2, ".", ""); ?>€</span><br />
							<?php } ?>
						<?php } ?>
						<?php if ($plus_cream_stone>0){ ?>
							Plus Cream Stone <span><?php echo number_format($plus_cream_stone,2,".",""); ?>€</span> <br />
						<?php }?>
						<?php if ($plus_grey_stone>0){ ?>
							Plus Grey Stone <span><?php echo number_format($plus_grey_stone,2,".",""); ?>€</span> <br />
						<?php }?>
						<?php if ($plus_dark_grey>0){ ?>
							Plus Dark Grey <span><?php echo number_format($plus_dark_grey,2,".",""); ?>€</span> <br />
						<?php }?>
						<?php if ($incremento_ral>0){ ?>
						Incremento Blanco RAL 9010 (20%) <span><?php echo number_format($incremento_ral,2,".",""); ?>€</span> <br />
						<?php }?>
						<?php if ($proyecto['precio_albanileria_sencilla'] > 0) { ?>
							Albanileria sencilla: <span><?php echo number_format($proyecto['precio_albanileria_sencilla'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_albanileria_tirar_tabique'] > 0) { ?>
							Tirar tabique o maletero: <span><?php echo number_format($proyecto['precio_albanileria_tirar_tabique'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_albanileria_quitar_solera'] > 0) { ?>
							Quitar solera: <span><?php echo number_format($proyecto['precio_albanileria_quitar_solera'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_albanileria_mover_enchufe'] > 0) { ?>
							Mover enchufe o interruptor: <span><?php echo number_format($proyecto['precio_albanileria_mover_enchufe'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_albanileria_costado_pladur'] > 0) { ?>
							Hacer costado de pladur: <span><?php echo number_format($proyecto['precio_albanileria_costado_pladur'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['albanileria_con_seleccionado'] > 0) { ?>
							Albañilería con solera: <span><?php echo number_format($proyecto['precio_albanileria_con'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['albanileria_sin_seleccionado'] > 0) { ?>
							Albañilería sin solera: <span><?php echo number_format($proyecto['precio_albanileria_sin'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_km_medicion'] > 0) { ?>
							Precio km para medición : <span><?php echo number_format($proyecto['precio_km_medicion'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_km_montaje'] > 0) { ?>
							Precio km para montaje: <span><?php echo number_format($proyecto['precio_km_montaje'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_1'] > 0) { ?>
							Rematar por dentro: <span><?php echo number_format($proyecto['precio_extras_1'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_2'] > 0) { ?>
							Modulo con viga: <span><?php echo number_format($proyecto['precio_extras_2'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_3'] > 0) { ?>
							Interior con chaflán: <span><?php echo number_format($proyecto['precio_extras_3'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_4'] > 0) { ?>
							Registro: <span><?php echo number_format($proyecto['precio_extras_4'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_5'] > 0) { ?>
							Desplazar punto de luz a costado: <span><?php echo number_format($proyecto['precio_extras_5'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_6'] > 0) { ?>
							Módulo forrado: <span><?php echo number_format($proyecto['precio_extras_6'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_7'] > 0) { ?>
							Módulo diamante: <span><?php echo number_format($proyecto['precio_extras_7'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_8'] > 0) { ?>
							Incremento por balda extra: <span><?php echo number_format($proyecto['precio_extras_8'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['precio_extras_9'] > 0) { ?>
							Incremento por módulo partido: <span><?php echo number_format($proyecto['precio_extras_9'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['leds_incrustados'] > 0) { ?>
							Leds incrustados: <span><?php echo number_format($proyecto['leds_incrustados'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['herrajes_negros'] > 0) { ?>
							Herrajes negros: <span><?php echo number_format($proyecto['herrajes_negros'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['multitaladro'] > 0) { ?>
							Multitaladro: <span><?php echo number_format($proyecto['multitaladro'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['espejo_extraible'] > 0) { ?>
							Espejo extraíble: <span><?php echo number_format($proyecto['espejo_extraible'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['espejo_carril'] > 0) { ?>
							Espejo en carril: <span><?php echo number_format($proyecto['espejo_carril'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['baldas_inclinadas'] > 0) { ?>
							Baldas inclinadas: <span><?php echo number_format($proyecto['baldas_inclinadas'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['kit_plegable'] > 0) { ?>
							Kit plegable: <span><?php echo number_format($proyecto['kit_plegable'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['recrecer_frente'] > 0) { ?>
							Recrecer frente: <span><?php echo number_format($proyecto['recrecer_frente'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php if ($proyecto['aplicar_descuento'] > 0) { ?>
							Descuento del <?php echo $proyecto['aplicar_descuento']; ?>%: <span>-<?php echo number_format($proyecto['descuento_cliente'], 2, ".", ""); ?>€</span><br />
						<?php } ?>
						<?php echo $proyecto['porcentaje_iva']; ?>% I.V.A.: <span><?php echo number_format($proyecto['iva'], 2, ".", ""); ?>€</span><br />
						<b>PRECIO TOTAL: <span><?php echo number_format($proyecto['precio_total'], 2, ".", ""); ?>€</span></b>
					</div>
			</div>
		</div>
	</main>
	<script>
		setTimeout(function () {
			var main = document.getElementById('generation-container');
			var primerDiv = main.querySelector(':scope > div');
			var titulo_proyecto = document.getElementById("titulo_proyecto").textContent;
			var opt = {
				margin: 0,
				filename: titulo_proyecto+'.pdf',
				image: { type: 'jpeg', quality: 1 },
				html2canvas: {
					scale: 2,
					useCORS: true,
					onclone: function (clonedDoc) {
						var link = clonedDoc.createElement('link');
						link.rel = 'stylesheet';
						link.type = 'text/css';
						link.href = 'include/secciones/proyectos/functions/pdf-style.css';
						clonedDoc.head.appendChild(link);
					}
				},
				jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
			};

			html2pdf().set(opt).from(main).save().then(function () {
				var h2 = document.createElement('h2');
				h2.style.textAlign = 'center';
				h2.textContent = 'VISTA PREVIA DEL PDF';

				var h3 = document.createElement('h3');
				h3.style.textAlign = 'center';
				h3.textContent = 'Para volver a generar el pdf vuelve a pulsar el botón de la vista del proyecto';

				main.insertBefore(h2, primerDiv);
				main.insertBefore(h3, primerDiv);
			});
		}, 1000);
	</script>
</body>

</html>