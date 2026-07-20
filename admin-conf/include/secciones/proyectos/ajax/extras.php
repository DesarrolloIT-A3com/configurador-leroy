<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] != "logged")
	die();

// VEMOS LA SERIE MARCADA PARA VER QUE TABLEROS SE LE PERMITEN
$id_serie = 0;
if (isset($_POST['id_serie']) && $_POST['id_serie'] > 0)						$id_serie = (int)$_POST['id_serie'];
$id_acabado = 0;
if (isset($_POST['id_acabado']) && $_POST['id_acabado'] > 0)					$id_acabado = (int)$_POST['id_acabado'];
// VEMOS EL NÚMERO DE PUERTAS ELEGIDO
$num_puertas = 0;
if (isset($_POST['num_puertas']) && $_POST['num_puertas'] > 0)				$num_puertas = (int)$_POST['num_puertas'];
// DISEÑO DE CADA PUERTA
$diseno_puerta_1 = "";
if (isset($_POST['diseno_puerta_1']) && $_POST['diseno_puerta_1'] != "")		$diseno_puerta_1 = explode("-", $_POST['diseno_puerta_1']);
$diseno_puerta_2 = "";
if (isset($_POST['diseno_puerta_2']) && $_POST['diseno_puerta_2'] != "")		$diseno_puerta_2 = explode("-", $_POST['diseno_puerta_2']);
$diseno_puerta_3 = "";
if (isset($_POST['diseno_puerta_3']) && $_POST['diseno_puerta_3'] != "")		$diseno_puerta_3 = explode("-", $_POST['diseno_puerta_3']);
$diseno_puerta_4 = "";
if (isset($_POST['diseno_puerta_4']) && $_POST['diseno_puerta_4'] != "")		$diseno_puerta_4 = explode("-", $_POST['diseno_puerta_4']);
$diseno_puerta_5 = "";
if (isset($_POST['diseno_puerta_5']) && $_POST['diseno_puerta_5'] != "")		$diseno_puerta_5 = explode("-", $_POST['diseno_puerta_5']);
$diseno_puerta_6 = "";
if (isset($_POST['diseno_puerta_6']) && $_POST['diseno_puerta_6'] != "")		$diseno_puerta_6 = explode("-", $_POST['diseno_puerta_6']);
$diseno_puerta_7 = "";
if (isset($_POST['diseno_puerta_7']) && $_POST['diseno_puerta_7'] != "")		$diseno_puerta_7 = explode("-", $_POST['diseno_puerta_7']);
$diseno_puerta_8 = "";
if (isset($_POST['diseno_puerta_8']) && $_POST['diseno_puerta_8'] != "")		$diseno_puerta_8 = explode("-", $_POST['diseno_puerta_8']);
// VEMOS EL NÚMERO DE MÓDULOS ELEGIDO
$num_modulos = 0;
if (isset($_POST['num_modulos']) && $_POST['num_modulos'] > 0)				$num_modulos = (int)$_POST['num_modulos'];
// DISEÑO DE CADA MÓDULO
$interior_puerta_1 = "";
if (isset($_POST['interior_puerta_1']) && $_POST['interior_puerta_1'] != "")		$interior_puerta_1 = explode("-", $_POST['interior_puerta_1']);
$interior_puerta_2 = "";
if (isset($_POST['interior_puerta_2']) && $_POST['interior_puerta_2'] != "")		$interior_puerta_2 = explode("-", $_POST['interior_puerta_2']);
$interior_puerta_3 = "";
if (isset($_POST['interior_puerta_3']) && $_POST['interior_puerta_3'] != "")		$interior_puerta_3 = explode("-", $_POST['interior_puerta_3']);
$interior_puerta_4 = "";
if (isset($_POST['interior_puerta_4']) && $_POST['interior_puerta_4'] != "")		$interior_puerta_4 = explode("-", $_POST['interior_puerta_4']);
$interior_puerta_5 = "";
if (isset($_POST['interior_puerta_5']) && $_POST['interior_puerta_5'] != "")		$interior_puerta_5 = explode("-", $_POST['interior_puerta_5']);
$interior_puerta_6 = "";
if (isset($_POST['interior_puerta_6']) && $_POST['interior_puerta_6'] != "")		$interior_puerta_6 = explode("-", $_POST['interior_puerta_6']);
$interior_puerta_7 = "";
if (isset($_POST['interior_puerta_7']) && $_POST['interior_puerta_7'] != "")		$interior_puerta_7 = explode("-", $_POST['interior_puerta_7']);
$interior_puerta_8 = "";
if (isset($_POST['interior_puerta_8']) && $_POST['interior_puerta_8'] != "")		$interior_puerta_8 = explode("-", $_POST['interior_puerta_8']);

$modulos_dobles = $num_puertas - $num_modulos;
$modulos_simples = $num_modulos - $modulos_dobles;

$costados = $db->getResults('SELECT id, nombre, precio FROM costados WHERE id_acabados=' . $id_acabado);
$fijos = $db->getRow('SELECT id, nombre FROM fijos WHERE id_acabados=' . $id_acabado);

// $montaje_frente = $db->getRow('SELECT id, nombre, precio FROM montajes_frentes WHERE hojas=' . $num_puertas);
// $montaje_interior = $db->getRow('SELECT id, nombre, precio FROM montajes_interiores WHERE modulos=' . $num_modulos);

$desmontajes_frentes = $db->getResults('SELECT id, nombre, precio FROM desmontajes_frentes WHERE 1');
$desmontajes_interiores = $db->getResults('SELECT id, nombre, precio FROM desmontajes_interiores WHERE 1');

$rematar_frente = $db->getRow('SELECT id, precio FROM rematar_frente WHERE 1');

$rematar_interior = $db->getRow('SELECT id, precio FROM rematar_interior WHERE 1');

// $juegos_led = $db->getVar('SELECT id FROM juegos_led WHERE id_series = ' . $id_serie);

if($id_serie != 5 && $id_serie > 0)
{
	$sistema_frenos = $db->getVar('SELECT id FROM sistema_frenos WHERE id_series = ' . $id_serie);
}
else
{
	$sistema_frenos = false;
}




$tiradores = $db->getResults('SELECT id,tirador FROM tiradores WHERE id_series = ' . $id_serie);

$uneros = $db->getResults('SELECT id,unero,format_id FROM uneros WHERE id_acabados = ' . $id_acabado);

if($num_modulos != 0){
	$extras = $db->getResults('SELECT id, nombre, precio FROM extras WHERE id BETWEEN 1 AND 13 AND id NOT IN (7)');
}

?>
<style>
	.unero-color {
		margin: 0px 20px;
		position: relative;
		top: 8px;
		margin-bottom: 80px;
		display: none;
	}
	#info-unero{
		display: none;
		text-align: center;
		margin-top: 10px;
		font-size: 0.9em; 
		color: #666;
	}
</style>
<h1>Extras</h1>
<div class="seccion_extras">
	<?php
	if ($id_serie > 0) {
	?>
		<h2>Frente</h2>
		<div class="extras_frente">
			<div class="contenido_extras_anadir">
				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="recrecer_frente" name="recrecer_frente" value="1" /> Recrecer frente</label></div>
				</div>

				<?php
				if ($sistema_frenos) {
				?>
					<div class="bloque_extras_frente">
						<div class="item_extras_frente"><label><input type="checkbox" id="sistema_frenos" name="sistema_frenos" value="<?php echo $sistema_frenos; ?>" /> Sistema de frenos para puertas</label></div>
					</div>
				<?php
				}
				?>

				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="frente_abuardillado" name="frente_abuardillado" value="25" /> Frente abuardillado</label></div>
				</div>

				<?php
				$contador = 0;
				if ($costados) {
				?>
					<div class="bloque_extras_frente">
						<?php
						foreach ($costados as $costado) {
							$contador++;
						?>
							<div class="item_extras_frente"><label><input type="checkbox" id="costados_<?php echo $contador; ?>" name="costados_<?php echo $contador; ?>" value="<?php echo $costado['id']; ?>" /> <?php echo $costado['nombre'] ?></label></div>
						<?php
						}
						?>
					</div>
				<?php
				}
				?>

				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="fijos" name="fijos" value="<?php echo $fijos['id']; ?>" /> Fijos en <?php echo $fijos['nombre']; ?></label></div>
				</div>
				
				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="kit_plegable" name="kit_plegable" value="1" /> Kit plegable</label></div>
				</div>

				<?php
				if ($num_modulos == 0) {
				?>
					<div class="bloque_extras_frente">
						<div class="item_extras_frente"><label><input type="checkbox" id="rematar_frente" name="rematar_frente" value="<?php echo $rematar_frente['id']; ?>" /> Remate de frente</label></div>
					</div>
				<?php
				}
				?>


			</div>
		</div>
	<?php
	}
	?>
	<?php if (is_array($tiradores) && count($tiradores) > 0) { ?>
    <h2>Tiradores</h2>
    <div class="extras_frente">
        <div class="bloque_extras_frente">
            <?php foreach ($tiradores as $tirador) { ?>
				<div class="item_extras_frente">
					<label>
						<input type="checkbox" id="tirador_<?php echo strtolower($tirador["tirador"]); ?>" name="tirador" value="<?php echo $tirador["id"]; ?>" onChange="soloUnCheckbox('tirador')" />
						Tirador <?php echo htmlspecialchars($tirador["tirador"]); ?>
					</label>
				</div>
			<?php } ?>
			<p style="font-size: 0.9em; color: #666;">Si no se selecciona tirador el tirador por defecto será el básico</p>
        </div>
    </div>
	<?php } ?>
	<?php if (is_array($uneros) && count($uneros) > 0) { ?>
	<h2>Uñeros</h2>
	<div class="extras_frente">
		<div class="bloque_extras_frente">
			<?php foreach ($uneros as $unero) { ?>
				<div class="item_extras_frente">
					<label>
						<input type="checkbox" id="unero_<?php echo $unero["format_id"]; ?>" name="unero" value="<?php echo $unero["id"]; ?>" onChange="manejarUneros()" />
						Uñero <?php echo htmlspecialchars($unero["unero"]); ?>
					</label>
				</div>
			<?php } ?>
			<label class="unero-color"><input type="checkbox" id="color_unero_r" name="color_unero" value="1" onChange="soloUnCheckbox('color_unero')" /> Color roble</label>
			<label class="unero-color"><input type="checkbox" id="color_unero_n" name="color_unero" value="1" onChange="soloUnCheckbox('color_unero')" /> Color nogal</label>
			<p id="info-unero">Si no se selecciona el color de uñero se cogerá el color roble por defecto</p>

		</div>		
	</div>
	<?php } ?>
	<?php
	if ($num_modulos > 0) {
	?>
		<h2>Interior</h2>
		<div class="extras_interior">
			<div class="contenido_extras_anadir">

				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="herrajes_negros" name="herrajes_negros" value="1" /> Herrajes en negro</label></div>
				</div>

				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="multitaladro" name="multitaladro" value="1" /> Multitaladro</label></div>
				</div>

				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="espejo_extraible" name="espejo_extraible" value="1" /> Espejo extraíble</label></div>
				</div>

				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="espejo_con_carril" name="espejo_con_carril" value="1" /> Espejo con carril</label></div>
				</div>

				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="baldas_inclinadas" name="baldas_inclinadas" value="1" /> Baldas inclinadas</label></div>
				</div>

				<div class="bloque_extras_frente">
					<div class="item_extras_frente"><label><input type="checkbox" id="leds_incrustados" name="leds_incrustados" value="1" /> Leds incrustados</label></div>
				</div>
				<?php
				$contador = 0;
				if ($extras) {
				?>
					<div class="bloque_extras_frente">
						<?php
						foreach ($extras as $extra) {
							$contador++;
						?>
							<div class="item_extras_frente"><label><input type="checkbox" id="extras_<?php echo $contador; ?>" name="extras_<?php echo $contador; ?>" value="<?php echo $extra['id']; ?>" /> <?php echo $extra['nombre'] ?></label></div>
						<?php
						}
						?>
					</div>
				<?php
				}
				?>
			</div>
			


				
	<?php
	}
	?>
	<h2>Desplazamiento</h2>
	<div class="extras_km">
		<div class="contenido_extras_anadir">
			<div class="bloque_extras_km">
				<div class="precio_extras">Km para medición: <input type="text" id="km_medicion" name="km_medicion" value="0"> km</div>
				<div class="precio_extras">Km para montaje: <input type="text" id="km_montaje" name="km_montaje" value="0"> km</div>
			</div>
		</div>
	</div>
	<h2>Albañilería</h2>
	<div class="albanileria">
		<div class="contenido_extras_anadir">
			<div class="bloque_extras_albanileria">
				<div class="item_extras_frente" style="margin-bottom: 10px;"><label><input type="checkbox" id="albanileria_sencilla" name="albanileria_sencilla" value="1" onchange="mostrar_albanileria()" /> Albañilería sencilla</label></div>
				<div class="bloque_albanileria_oculto" style="display: none;">
					<div class="item_extras_frente" style="margin-bottom: 10px;"><label><input type="checkbox" id="albanileria_tirar_tabique" name="albanileria_tirar_tabique" value="2" /> Tirar tabique o maletero</label></div>
					<div class="item_extras_frente" style="margin-bottom: 10px;"><label><input type="checkbox" id="albanileria_quitar_solera" name="albanileria_quitar_solera" value="3" /> Quitar solera</label></div>
					<div class="item_extras_frente" style="margin-bottom: 10px;"><label><input type="checkbox" id="albanileria_mover_enchufe" name="albanileria_mover_enchufe" value="4" /> Mover enchuve o interruptor</label></div>
					<div class="item_extras_frente" style="margin-bottom: 10px;"><label><input type="checkbox" id="albanileria_costado_pladur" name="albanileria_costado_pladur" value="5" /> Hacer costado de pladur</label></div>
				</div>
			</div>
		</div>
	</div>
	<h2>Otros</h2>
	<div class="extras_otros">
		<div class="contenido_extras_anadir">
			<?php
			$contador = 0;
			if ($desmontajes_frentes && $num_puertas > 0) {
			?>
				<div class="bloque_extras_frente">
					<?php
					foreach ($desmontajes_frentes as $desmontaje_frente) {
						$contador++;
					?>
						<div class="item_extras_frente"><label><input type="checkbox" id="desmontajes_frentes_<?php echo $contador; ?>" name="desmontajes_frentes_<?php echo $contador; ?>" value="<?php echo $desmontaje_frente['id']; ?>" /> Desmontaje de frente <?php echo $desmontaje_frente['nombre'] ?></label></div>
					<?php
					}
					?>
				</div>
			<?php
			}
			?>


			<?php
			$contador = 0;
			if ($desmontajes_interiores && $num_modulos > 0) {
			?>
				<div class="bloque_extras_frente">
					<?php
					foreach ($desmontajes_interiores as $desmontaje_interior) {
						$contador++;
					?>
						<div class="item_extras_frente"><label><input type="checkbox" id="desmontajes_interiores_<?php echo $contador; ?>" name="desmontajes_interiores_<?php echo $contador; ?>" value="<?php echo $desmontaje_interior['id']; ?>" /> Desmontaje de interior <?php echo $desmontaje_interior['nombre'] ?></label></div>
					<?php
					}
					?>
				</div>
			<?php
			}
			?>

			<!-- <div class="bloque_extras_frente">
				<div class="item_extras_frente"><label><input type="checkbox" id="albanileria_con" name="albanileria_con" value="1" /> Albañilería con solera</label></div>
				<div class="item_extras_frente"><label><input type="checkbox" id="albanileria_sin" name="albanileria_sin" value="1" /> Albañilería sin solera</label></div>
			</div> -->

		</div>
	</div>
	<br /><br />
	<center><a class="boton gris grande" onClick="recalcular_precio();"><i class="fa fa-calculator"></i> Recalcular precio</a></center>
	<br /><br />
</div>
<script>
	function soloUnCheckbox(name) {
		// Obtén todos los checkboxes con el mismo atributo "name"
		const checkboxes = document.querySelectorAll(`input[name="${name}"]`);

		// Agrega un evento "change" a cada checkbox
		checkboxes.forEach((checkbox) => {
			checkbox.addEventListener("change", function () {
				if (this.checked) {
					// Deselecciona todos los demás checkboxes
					checkboxes.forEach((cb) => {
						if (cb !== this) {
							cb.checked = false;
						}
					});
				}
				actualizar_extras();
			});
			
		});		
	}

	function manejarUneros() {
		// Obtén los checkboxes de los uñeros
		const uneroRebajado = document.getElementById("unero_rebajado");
		const uneroColorMadera = document.getElementById("unero_color_madera");
		const coloresUnero = document.querySelectorAll(".unero-color");

		// Función para desmarcar y ocultar los colores
		function ocultarColores() {
			document.getElementById("info-unero").style.display = "none";
			coloresUnero.forEach((color) => {
				color.style.display = "none"; // Oculta los colores
				color.querySelector("input").checked = false; // Desmarca los checkboxes
			});
		}

		// Verifica el estado inicial de los checkboxes al cargar la página
		function verificarEstadoInicial() {
			if (uneroColorMadera.checked) {
				document.getElementById("info-unero").style.display = "inline";
				coloresUnero.forEach((color) => {
					color.style.display = "inline"; // Muestra los colores
				});
			} else {
				ocultarColores(); // Oculta los colores si no está marcado
			}
		}

		// Agrega eventos "change" a los uñeros
		uneroRebajado.addEventListener("change", function () {
			if (this.checked) {
				uneroColorMadera.checked = false; // Deselecciona el otro uñero
				ocultarColores(); // Oculta y desmarca los colores
			}
			actualizar_extras(); // Actualiza los extras
		});

		uneroColorMadera.addEventListener("change", function () {
			if (this.checked) {
				uneroRebajado.checked = false; // Deselecciona el otro uñero
				coloresUnero.forEach((color) => {
					color.style.display = "inline"; // Muestra los colores
				});
			} else {
				ocultarColores(); // Oculta y desmarca los colores si se deselecciona
			}
			actualizar_extras(); // Actualiza los extras
		});

		// Llama a la función para verificar el estado inicial
		verificarEstadoInicial();
	}
</script>