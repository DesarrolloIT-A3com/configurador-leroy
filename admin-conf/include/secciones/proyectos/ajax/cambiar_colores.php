<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE Y EL ACABADO MARCADA PARA VER QUE DISEÑOS SE PERMITEN
$id_serie = 0;
if(isset($_GET['id_serie']) && $_GET['id_serie'] > 0)					$id_serie = (int)$_GET['id_serie']; 
$id_acabado = 0;
if(isset($_GET['id_acabado']) && $_GET['id_acabado'] > 0)				$id_acabado = (int)$_GET['id_acabado']; 
$diseno_puerta = "";
if(isset($_GET['diseno_puerta']) && $_GET['diseno_puerta'] != "")		$diseno_puerta = explode("-",$_GET['diseno_puerta']);
$colores_puerta = "";
if(isset($_GET['colores_puerta']) && $_GET['colores_puerta'] != "")		$colores_puerta = explode("-",$_GET['colores_puerta']);
$num_puerta = 0;
if(isset($_GET['num_puerta']) && $_GET['num_puerta'] > 0)				$num_puerta = (int)$_GET['num_puerta']; 

$img_puerta = $db->getVar('SELECT imagen FROM puertas WHERE id='.$diseno_puerta[2]);

$zonas_puerta = $db->getResults('SELECT pz.zona as zona, pz.id_colores_tipo as id_colores_tipo, ct.nombre as tipo FROM puertas_zonas as pz, disenos_puertas as dp, colores_tipo as ct WHERE pz.id_disenos_puertas = dp.id AND pz.id_colores_tipo = ct.id AND dp.id_acabados = '.$id_acabado.' AND dp.id_disenos = '.$diseno_puerta[0].' AND dp.id_terminaciones = '.$diseno_puerta[1].' AND dp.id_puertas = '.$diseno_puerta[2].' ORDER BY pz.zona');

?>
<div class="cambiar_colores">
	<h1>
		Seleccionar colores puerta <?php echo $num_puerta; ?>
	</h1>
	<div class="leyenda_colores">
		El orden de los colores siempre será de izquierda a derecha, de arriba a abajo y de exterior a interior.
	</div>
	<div class="cuerpo_cambiar_colores">
		<div class="diseno_puerta">
			<h2>Diseño</h2>
			<img src="www/img/disenos/<?php echo $id_serie; ?>/<?php echo $id_acabado; ?>/<?php echo $diseno_puerta[0]; ?>/<?php echo $diseno_puerta[1]; ?>/<?php echo $img_puerta; ?>" />
		</div>
		<div class="zonas_puerta">
			<h2>Zonas</h2>
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
			$contador_12 = 0; //Melamina para Pico gorrión
			$contador_13 = 0; //Melamina pantografiada
			$contador_14 = 0; //Melamina palilleria
			
			foreach($zonas_puerta as $index=>$zona_puerta){ 
				// Comprobamos si hay más del mismo tipo para ponerle el número detrás o no
				$hay_mas = false; 
				if(isset($zonas_puerta[$index+1]['id_colores_tipo']) && $zona_puerta['id_colores_tipo'] == $zonas_puerta[$index+1]['id_colores_tipo']){
					$hay_mas = true;
				}
				
				${'contador_'.$zona_puerta['id_colores_tipo']}++; // Aumentamos el contador de ese tipo
				
				$nombre_zona = (${'contador_'.$zona_puerta['id_colores_tipo']} > 1 || $hay_mas) ? $zona_puerta['tipo']." ".${'contador_'.$zona_puerta['id_colores_tipo']} : $zona_puerta['tipo'];
				
				// SI ES ALGUNA DE ESTAS TERMINACIONES EN MELAMINA SOLO PUEDEN USARSE TABLEROS EN DM
				if(($diseno_puerta[1] == 7 || $diseno_puerta[1] == 8 || $diseno_puerta[1] == 9 || $diseno_puerta[1] == 10 || $diseno_puerta[1] == 11 || $diseno_puerta[1] == 12 || $diseno_puerta[1] == 13 || $diseno_puerta[1] == 14 || $diseno_puerta[1] == 15 || $diseno_puerta[1] == 16 || $diseno_puerta[1] == 20 || $diseno_puerta[1] == 21 || $diseno_puerta[1] == 22 || $diseno_puerta[1] == 26 || $diseno_puerta[1] == 27 || $diseno_puerta[1] == 28 || $diseno_puerta[1] == 29) && $zona_puerta['id_colores_tipo'] == 1){
					if($id_serie == 1){
						$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND es_dm = 1 AND jomy = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
					}
					if($id_serie == 2){
						$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND es_dm = 1 AND valencia = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
					}
					if($id_serie == 3){
						$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND es_dm = 1 AND madrid = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
					}
					if($id_serie == 4){
						$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND es_dm = 1 AND toledo = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
					}
					if($id_serie == 5){
						$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND es_dm = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
					}
				}else{
					if(($zona_puerta['id_colores_tipo'] == 1)||($zona_puerta['id_colores_tipo'] == 2)){	
						if($id_serie == 1){
							$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND jomy = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
						}
						if($id_serie == 2){
							$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND valencia = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
						}
						if($id_serie == 3){
							$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND madrid = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
						}
						if($id_serie == 4){
							$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND toledo = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
						}
						if($id_serie == 5){
							$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
						}
					}else{
						$colores = $db->getResults('SELECT id, nombre, imagen FROM colores WHERE activo = 1 AND es_tablero = 1 AND id_colores_tipo = '.$zona_puerta['id_colores_tipo']);
					}
				}
			
				// SI YA SE HAN SELECCIONADO COLORES ANTERIORMENTE SE OBTIENEN LOS DATOS CORRESPONDIENTES
				$id_color_zona = "";
				$nombre_color_zona = "";
				$imagen_color_zona = "";
				if(isset($colores_puerta[$index]) && $colores_puerta[$index] > 0){
					$color_zona = $db->getRow('SELECT nombre, imagen FROM colores WHERE id = '.$colores_puerta[$index]);
					$id_color_zona = $colores_puerta[$index];
					$nombre_color_zona = $color_zona['nombre'];
					$imagen_color_zona = $color_zona['imagen'];
				}
				
			?>
			<div class="item_zonas_puerta">
				<input type="hidden" id="input_zona_<?php echo $zona_puerta['zona']; ?>" value="<?php echo $id_color_zona; ?>" />
				<input type="hidden" id="nombre_zona_<?php echo $zona_puerta['zona']; ?>" value="<?php echo $nombre_zona; ?>" />
				<h3><?php echo $nombre_zona; ?> <a class="boton gris" onClick="mostrar_colores(<?php echo $zona_puerta['zona']; ?>);"><i class="fa fa-eyedropper"></i> Seleccionar</a></h3>
				<div class="color_zona_<?php echo $zona_puerta['zona']; ?>">
					<div class="imagen_zona"><?php if($nombre_color_zona != ""){ echo '<h4>'.$nombre_color_zona.'</h4><img src="www/img/colores/'.$imagen_color_zona.'" />'; } ?></div>
					<div class="colores_zona">
						<div class="contenedor_colores_zona">
							<?php foreach($colores as $color){?>
							<div class="item_colores_zona">
								<h4><?php echo $color['nombre']; ?></h4>
								<img src="www/img/colores/<?php echo $color['imagen']; ?>" title="Seleccionar color <?php echo $color['nombre']; ?>" id_color="<?php echo $color['id']; ?>" nombre_color="<?php echo $color['nombre']; ?>" />
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</div>
	<?php
	// SI TODAS LAS PUERTAS SON IGUALES PERMITIRÁ COPIAR LOS COLORES A TODAS LAS PUERTAS
	if(isset($_GET['puertas_iguales']) && $_GET['puertas_iguales'] == 'true'){
	?>
	<div class="copiar_puertas">
		<label><input type="checkbox" id="copiar_puertas" name="copiar_puertas" /> Copiar colores a todas las puertas</label>
	</div>
	<?php
	}
	?>
	<div class="botones_confirm">
		<a class="boton grande verde inactivo"  onClick="aplicar_colores(<?php echo $num_puerta; ?>);">Aplicar</a>
	</div>
</div>