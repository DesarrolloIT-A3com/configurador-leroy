<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

$num_modulo = 0;
if(isset($_POST['num_modulo']) && $_POST['num_modulo'] > 0)						$num_modulo = (int)$_POST['num_modulo']; 
$tipo = "";
if(isset($_POST['tipo']) && $_POST['tipo'] != "")								$tipo = $_POST['tipo']; 
$ancho_interior = 0;
if(isset($_POST['ancho_interior']) && $_POST['ancho_interior'] > 0)				$ancho_interior = (int)$_POST['ancho_interior'];
$id_interior = 0;
if(isset($_POST['id_interior']) && $_POST['id_interior'] > 0)					$id_interior = (int)$_POST['id_interior']; 
$nombre_interior = "";
if(isset($_POST['nombre_interior']) && $_POST['nombre_interior'] != "")			$nombre_interior = $_POST['nombre_interior'];
$num_cajones = "";
if(isset($_POST['num_cajones']) && $_POST['num_cajones'] != "")					$num_cajones = $_POST['num_cajones'];

$interior_zapatero_doble = $db->getVar('SELECT num_zap_doble FROM interiores WHERE id = '.$id_interior);
$interior_zapatero = $db->getVar('SELECT num_zap_extr FROM interiores WHERE id = '.$id_interior);
$pantalonero = $db->getVar('SELECT num_pant_simple FROM interiores WHERE id = '.$id_interior);
$pantalonero_doble = $db->getVar('SELECT num_pant_doble FROM interiores WHERE id = '.$id_interior);
$colores_postformado = $db->getResults('SELECT DISTINCT(nombre) FROM colores WHERE nombre IN ("Blanco","Taiga","Cancún","Coral");');
$colores_melamina = $db->getResults('SELECT nombre FROM colores WHERE es_perfileria = 1 AND es_tablero = 1 AND id_colores_tipo = 1 AND activo = 1 ORDER BY nombre');

?>
<style>
	.gama_selector{
		text-align: left;
        width: 450px; /* Fija el ancho, ajusta el valor según tu diseño */
        box-sizing: border-box; /* Opcional: para incluir el padding en el ancho */
	}

	#gama-basic,#gama-premium{
		margin-top: 15px;
		margin-left: 32px;
	}

	#gama-basic input{
		margin-left: 40px;
	}

	#gama-premium input{
		margin-left: 40px;
	}

	.gama_options{
		text-align: left;
		margin-left: 35px;
		width: 90%;
	}

	.gama_options label{
		display: block;
	}

	.gama_options p{
		text-align: center;
		margin: 0px 0px;
		margin-left: 25px;
		margin-bottom: 10px;
		border-bottom: 1px solid black;
	}

	
	#contenido_cerrado, #contenido_jomy_n, #contenido_jomy_p,#contenido_inox_p, #contenido_inox_n, #contenido_inox_b, #contenido_atenas_t, #contenido_atenas_c, #contenido_liso, #contenido_inox_t, #contenido_box{
		width: 145%;
	}

	#contenido_cerrado, #contenido_jomy_n, #contenido_jomy_p, #cajones_cerrado, #cajones_jomy_n, #cajones_jomy_p{
		display: none;
	}

	#contenido_inox_p, #contenido_inox_n, #contenido_inox_b, #contenido_atenas_t, #contenido_atenas_c, #contenido_liso, #contenido_inox_t, #contenido_box, #cajones_box, #cajones_inoxp, #cajones_inoxn, #cajones_inoxb, #cajones_atent, #cajones_atenc, #atenas-t-opciones, #atenas-c-opciones{
		display: none;
	}

	#gama-error{
		color: darkred;
		display: none;
		margin-bottom: 10px;
	}

	#cajones_postformado{
		text-align: center;
	}
	#cajones_cerrado, #cajones_jomy_n, #cajones_jomy_p, #cajones_box, #cajones_inoxp, #cajones_inoxn, #cajones_inoxb, #cajones_atent, #cajones_atenc, #atenas-c-opciones{
		margin-left: 185px;
	}

	.cajon_opt {
		width: 320px;
		display: block;
		margin: 0 auto;
	}

	.cajon_opt * {
		display: inline;
	}

	.cajon_opt label {
		width: fit-content;
		display: inline;
		text-align: left;
	}

	.gama_options .default_warn {
		font-size: 0.8em;
		color: gray;
		margin-top: 5px;
		border: none !important;		
		margin-left: 12px !important;
		margin-bottom: 10px !important;
	}

	.gama_options .select-info{
		border: none !important;
		font-weight: bold;
		margin-top: 10px !important;	
	}

	#form_accesorios{
		padding: 20px 0px;
		margin: 0px auto;
		margin-bottom: 5px;
		text-align: left;
	}

	#form_accesorios .item_form_premium{
		width: 100%;
		margin: 30px 0px;
	}

	#form_accesorios .item_form_premium label{
    	width: 220px;
	}

	#form_accesorios .item_form_premium input{
		width: 30px;
    	float: right;
	}

</style>
<div class="preguntar_freno">
	<?php if($num_cajones > 0) { ?>
		<div id="gama-section">
			<h2 onClick="toggleGama()" id="gama-toggle" style="cursor:pointer;">Complementos cajoneras &#11167;</h2>
			<form id="gama-form">
				<div class="gama_selector">
					<h3 id="gama-basic">Gama basic <input type="radio" name="gama" value="basic" onChange="selectGama('basic')" id="basic-radio" checked/></h3><br>
					<div class="gama_options">
						<label><input id="postformado" type="radio" name="gama-opt" value="Postformado" onChange="selectGamaBasic('Postformado')" checked /> Postformado</label><br>
							
							<p id="contenido_postformado">
								<?php
								if ($colores_postformado && is_array($colores_postformado)) {
									foreach ($colores_postformado as $color) {
										echo  "<input type='radio' name='postformado-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
									}
								}
								?>
							</p>
							<div id="cajones_postformado" class="item_form_cajones">
								<div class="cajon_opt">
									<label>Cajones de 8cm de alto</label> 
									<input type="checkbox" id="check_cajones_8_post" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_post', 'cajones_8_post')" />
									<input type="number" id="cajones_8_post" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_postformado')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 16cm de alto</label> 
									<input type="checkbox" id="check_cajones_16_post" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_post', 'cajones_16_post')" />
									<input type="number" id="cajones_16_post" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_postformado')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 20cm de alto</label> 
									<input type="checkbox" id="check_cajones_20_post" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_post', 'cajones_20_post')" />
									<input type="number" id="cajones_20_post" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_postformado')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 32cm de alto</label> 
									<input type="checkbox" id="check_cajones_32_post" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_post', 'cajones_32_post')" />
									<input type="number" id="cajones_32_post" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_postformado')" disabled />
								</div>
								<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>
							</div>


						<label><input id="cerrado" type="radio" name="gama-opt" value="Cerrado" onChange="selectGamaBasic('Cerrado')" /> Cerrado</label><br>

							<p id="contenido_cerrado">
								<?php
								if ($colores_melamina && is_array($colores_melamina)) {
									foreach ($colores_melamina as $color) {
										echo  "<input type='radio' name='cerrado-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
									}
								}
								?>
							</p>
							<div id="cajones_cerrado" class="item_form_cajones">
								<div class="cajon_opt">
									<label>Cajones de 8cm de alto</label> 
									<input type="checkbox" id="check_cajones_8_cerr" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_cerr', 'cajones_8_cerr')" />
									<input type="number" id="cajones_8_cerr" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_cerrado')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 16cm de alto</label> 
									<input type="checkbox" id="check_cajones_16_cerr" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_cerr', 'cajones_16_cerr')" />
									<input type="number" id="cajones_16_cerr" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_cerrado')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 20cm de alto</label> 
									<input type="checkbox" id="check_cajones_20_cerr" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_cerr', 'cajones_20_cerr')" />
									<input type="number" id="cajones_20_cerr" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_cerrado')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 32cm de alto</label> 
									<input type="checkbox" id="check_cajones_32_cerr" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_cerr', 'cajones_32_cerr')" />
									<input type="number" id="cajones_32_cerr" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_cerrado')" disabled />
								</div>
								<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>
							</div>

						<label><input id="jomy-n" type="radio" name="gama-opt" value="Jomy-n" onChange="selectGamaBasic('Jomy-n')" /> Jomy tirador plata</label><br>

							<p id="contenido_jomy_n">
								<?php
								if ($colores_melamina && is_array($colores_melamina)) {
									foreach ($colores_melamina as $color) {
										echo  "<input type='radio' name='jomy-n-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
									}
								}
								?>
							</p>
							<div id="cajones_jomy_n" class="item_form_cajones">
								<div class="cajon_opt">
									<label>Cajones de 8cm de alto</label> 
									<input type="checkbox" id="check_cajones_8_jomn" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_jomn', 'cajones_8_jomn')" />
									<input type="number" id="cajones_8_jomn" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_jomy_n')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 16cm de alto</label> 
									<input type="checkbox" id="check_cajones_16_jomn" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_jomn', 'cajones_16_jomn')" />
									<input type="number" id="cajones_16_jomn" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_jomy_n')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 20cm de alto</label> 
									<input type="checkbox" id="check_cajones_20_jomn" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_jomn', 'cajones_20_jomn')" />
									<input type="number" id="cajones_20_jomn" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_jomy_n')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 32cm de alto</label> 
									<input type="checkbox" id="check_cajones_32_jomn" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_jomn', 'cajones_32_jomn')" />
									<input type="number" id="cajones_32_jomn" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_jomy_n')" disabled />
								</div>
								<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>
							</div>

						<label><input id="jomy-p" type="radio" name="gama-opt" value="Jomy-p" onChange="selectGamaBasic('Jomy-p')" /> Jomy tirador negro</label><br>

							<p id="contenido_jomy_p">
								<?php
								if ($colores_melamina && is_array($colores_melamina)) {
									foreach ($colores_melamina as $color) {
										echo  "<input type='radio' name='jomy-p-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
									}
								}
								?>
							</p>
							<div id="cajones_jomy_p" class="item_form_cajones">
								<div class="cajon_opt">
									<label>Cajones de 8cm de alto</label> 
									<input type="checkbox" id="check_cajones_8_jomp" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_jomp', 'cajones_8_jomp')" />
									<input type="number" id="cajones_8_jomp" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_jomy_p')" />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 16cm de alto</label> 
									<input type="checkbox" id="check_cajones_16_jomp" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_jomp', 'cajones_16_jomp')" />
									<input type="number" id="cajones_16_jomp" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_jomy_p')" />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 20cm de alto</label> 
									<input type="checkbox" id="check_cajones_20_jomp" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_jomp', 'cajones_20_jomp')" />
									<input type="number" id="cajones_20_jomp" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_jomy_p')" />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 32cm de alto</label> 
									<input type="checkbox" id="check_cajones_32_jomp" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_jomp', 'cajones_32_jomp')" />
									<input type="number" id="cajones_32_jomp" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_jomy_p')" />
								</div>
								<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>
							</div>
					</div>
				</div>
				<div class="gama_selector">
					<h3 id="gama-premium">Gama premium <input type="radio" name="gama" value="premium" id="premium-radio" onChange="selectGama('premium')" /></h3><br>
					<div class="gama_options" style="display:none;">
						<label><input id="box" type="radio" name="gama-opt" value="Box" onChange="selectGamaPremium('Box')" /> Box</label><br><br>
						<p id="contenido_box">
							<?php
							if ($colores_melamina && is_array($colores_melamina)) {
								foreach ($colores_melamina as $color) {
									echo  "<input type='radio' name='box-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
								}
							}
			
			?>
						</p>
						<div id="cajones_box" class="item_form_cajones">
							<div class="cajon_opt">
								<label>Cajones de 8cm de alto</label> 
								<input type="checkbox" id="check_cajones_8_box" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_box', 'cajones_8_box')" />
								<input type="number" id="cajones_8_box" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_box')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 16cm de alto</label> 
								<input type="checkbox" id="check_cajones_16_box" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_box', 'cajones_16_box')" />
								<input type="number" id="cajones_16_box" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_box')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 20cm de alto</label> 
								<input type="checkbox" id="check_cajones_20_box" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_box', 'cajones_20_box')" />
								<input type="number" id="cajones_20_box" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_box')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 32cm de alto</label> 
								<input type="checkbox" id="check_cajones_32_box" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_box', 'cajones_32_box')" />
								<input type="number" id="cajones_32_box" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_box')" disabled />
							</div>
							<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>

						</div>
						<label><input id="inox-p" type="radio" name="gama-opt" value="Inox-p" onChange="selectGamaPremium('Inox-p')" /> Inox tirador plata</label><br><br>
						<p id="contenido_inox_p">
							<?php
							if ($colores_melamina && is_array($colores_melamina)) {
								foreach ($colores_melamina as $color) {
									echo  "<input type='radio' name='inox-p-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
								}
							}
							?>
						</p>
						<div id="cajones_inoxp" class="item_form_cajones">
								<div class="cajon_opt">
									<label>Cajones de 8cm de alto</label> 
									<input type="checkbox" id="check_cajones_8_inoxp" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_inoxp', 'cajones_8_inoxp')" />
									<input type="number" id="cajones_8_inoxp" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxp')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 16cm de alto</label> 
									<input type="checkbox" id="check_cajones_16_inoxp" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_inoxp', 'cajones_16_inoxp')" />
									<input type="number" id="cajones_16_inoxp" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxp')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 20cm de alto</label> 
									<input type="checkbox" id="check_cajones_20_inoxp" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_inoxp', 'cajones_20_inoxp')" />
									<input type="number" id="cajones_20_inoxp" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxp')" disabled />
								</div>
								<div class="cajon_opt">
									<label>Cajones de 32cm de alto</label> 
									<input type="checkbox" id="check_cajones_32_inoxp" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_inoxp', 'cajones_32_inoxp')" />
									<input type="number" id="cajones_32_inoxp" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxp')" disabled />
								</div>
								<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>

							</div>
						<label><input id="inox-n" type="radio" name="gama-opt" value="Inox-n" onChange="selectGamaPremium('Inox-n')" /> Inox tirador negro</label><br><br>
						<p id="contenido_inox_n">
							<?php
							if ($colores_melamina && is_array($colores_melamina)) {
								foreach ($colores_melamina as $color) {
									echo  "<input type='radio' name='inox-n-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
								}
							}
							?>
						</p>
						<div id="cajones_inoxn" class="item_form_cajones">
							<div class="cajon_opt">
								<label>Cajones de 8cm de alto</label> 
								<input type="checkbox" id="check_cajones_8_inoxn" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_inoxn', 'cajones_8_inoxn')" />
								<input type="number" id="cajones_8_inoxn" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxn')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 16cm de alto</label> 
								<input type="checkbox" id="check_cajones_16_inoxn" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_inoxn', 'cajones_16_inoxn')" />
								<input type="number" id="cajones_16_inoxn" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxn')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 20cm de alto</label> 
								<input type="checkbox" id="check_cajones_20_inoxn" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_inoxn', 'cajones_20_inoxn')" />
								<input type="number" id="cajones_20_inoxn" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxn')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 32cm de alto</label> 
								<input type="checkbox" id="check_cajones_32_inoxn" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_inoxn', 'cajones_32_inoxn')" />
								<input type="number" id="cajones_32_inoxn" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxn')" disabled />
							</div>
							<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>

						</div>
						<label><input id="inox-b" type="radio" name="gama-opt" value="Inox-b" onChange="selectGamaPremium('Inox-b')" /> Inox tirador blanco</label><br><br>
						<p id="contenido_inox_b">
							<?php
							if ($colores_melamina && is_array($colores_melamina)) {
								foreach ($colores_melamina as $color) {
									echo  "<input type='radio' name='inox-b-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
								}
							}
							?>
						</p>
						<div id="cajones_inoxb" class="item_form_cajones">
							<div class="cajon_opt">
								<label>Cajones de 8cm de alto</label> 
								<input type="checkbox" id="check_cajones_8_inoxb" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_inoxb', 'cajones_8_inoxb')" />
								<input type="number" id="cajones_8_inoxb" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxb')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 16cm de alto</label> 
								<input type="checkbox" id="check_cajones_16_inoxb" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_inoxb', 'cajones_16_inoxb')" />
								<input type="number" id="cajones_16_inoxb" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxb')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 20cm de alto</label> 
								<input type="checkbox" id="check_cajones_20_inoxb" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_inoxb', 'cajones_20_inoxb')" />
								<input type="number" id="cajones_20_inoxb" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxb')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 32cm de alto</label> 
								<input type="checkbox" id="check_cajones_32_inoxb" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_inoxb', 'cajones_32_inoxb')" />
								<input type="number" id="cajones_32_inoxb" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_inoxb')" disabled />
							</div>
							<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>

						</div>
						<label><input id="atenas-t" type="radio" name="gama-opt" value="Atenas-t" onChange="selectGamaPremium('Atenas-t')" /> Atenas Tablex</label><br><br>
						<p id="contenido_atenas_t">
							<?php
							if ($colores_melamina && is_array($colores_melamina)) {
								foreach ($colores_melamina as $color) {
									echo  "<input type='radio' name='atenas-t-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
								}
							}
							?>
						</p>
						<div id="cajones_atent" class="item_form_cajones">
							<div class="cajon_opt">
								<label>Cajones de 8cm de alto</label> 
								<input type="checkbox" id="check_cajones_8_atent" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_atent', 'cajones_8_atent')" />
								<input type="number" id="cajones_8_atent" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_atent')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 16cm de alto</label> 
								<input type="checkbox" id="check_cajones_16_atent" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_atent', 'cajones_16_atent')" />
								<input type="number" id="cajones_16_atent" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_atent')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 20cm de alto</label> 
								<input type="checkbox" id="check_cajones_20_atent" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_atent', 'cajones_20_atent')" />
								<input type="number" id="cajones_20_atent" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_atent')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 32cm de alto</label> 
								<input type="checkbox" id="check_cajones_32_atent" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_atent', 'cajones_32_atent')" />
								<input type="number" id="cajones_32_atent" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_atent')" disabled />
							</div>
							<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>

						</div>
						<label><input id="atenas-c" type="radio" name="gama-opt" value="Atenas-c" onChange="selectGamaPremium('Atenas-c')" /> Atenas Cristal</label><br><br>
						<p id="contenido_atenas_c">
							<?php
							if ($colores_melamina && is_array($colores_melamina)) {
								foreach ($colores_melamina as $color) {
									echo  "<input type='radio' name='atenas-c-opt' value='" . htmlspecialchars($color["nombre"]) . "' /> " . htmlspecialchars($color["nombre"]) . "&nbsp;&nbsp;&nbsp;";
								}
							}
							?>
						</p>
						<div id="cajones_atenc" class="item_form_cajones">
							<div class="cajon_opt">
								<label>Cajones de 8cm de alto</label> 
								<input type="checkbox" id="check_cajones_8_atenc" name="cajones_8" value="1" onChange="toggleInput('check_cajones_8_atenc', 'cajones_8_atenc')" />
								<input type="number" id="cajones_8_atenc" name="cajones_8" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_atenc')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 16cm de alto</label> 
								<input type="checkbox" id="check_cajones_16_atenc" name="cajones_16" value="1" onChange="toggleInput('check_cajones_16_atenc', 'cajones_16_atenc')" />
								<input type="number" id="cajones_16_atenc" name="cajones_16" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_atenc')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 20cm de alto</label> 
								<input type="checkbox" id="check_cajones_20_atenc" name="cajones_20" value="1" onChange="toggleInput('check_cajones_20_atenc', 'cajones_20_atenc')" />
								<input type="number" id="cajones_20_atenc" name="cajones_20" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_atenc')" disabled />
							</div>
							<div class="cajon_opt">
								<label>Cajones de 32cm de alto</label> 
								<input type="checkbox" id="check_cajones_32_atenc" name="cajones_32" value="1" onChange="toggleInput('check_cajones_32_atenc', 'cajones_32_atenc')" />
								<input type="number" id="cajones_32_atenc" name="cajones_32" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCajones(<?php echo $_POST['num_cajones']; ?>,'#cajones_atenc')" disabled />
							</div>
							<p class="default_warn">Si no se selecciona nada se pondrá por defecto todos los cajones de 16<br>En caso de que falten cajones por enumerar se completarán con cajones de 16</p>
						</div>
						<div id="atenas-c-opciones" >
							<p class="select-info">Pestaña con cristal:</p>
							<label><input id="atenas-c-cristal-t" type="radio" name="atenas-cristal-opt" value="1" checked> Cristal transparente</label><br><br>
							<label><input id="atenas-c-cristal-m" type="radio" name="atenas-cristal-opt" value="2"> Cristal mate</label><br><br>
							<label>Cristal por cajon <input id="num_cristal" type="number" name="num_cristal" value="0" min="0" max="<?php echo $_POST['num_cajones']; ?>" onChange="validarCristales(<?php echo $_POST['num_cajones']; ?>,'num_cristal')" /></label>
							<p class="default_warn">Si no se selecciona nada se pondrán cristales en todos los cajones</p>
						</div>	
						
					</div>
				</div>
			</form>
		</div>

	<?php } ?>
	<?php if($ancho_interior>=60 && $ancho_interior<=90){ ?>
		<h2 onClick="toggleAccesoriosPremium()">Accesorios premium &#11167;</h2>
		<form id="form_accesorios">
			<?php if($interior_zapatero > 0){ ?>
			<div class="item_form_premium"><label>Zapatero premium</label> <input type="checkbox" id="zapatero_premium" name="zapatero_premium" value="1" /></div>
			<?php } ?>
			<?php if($pantalonero > 0  || $pantalonero_doble > 0){ ?>
			<div class="item_form_premium"><label>Pantalonero premium</label> <input type="checkbox" id="pantalonero" name="pantalonero" value="1" /></div>
			<?php } ?>
			<div class="item_form_premium"><label>Cesta premium</label> <input type="checkbox" id="cesta_premium" name="cesta_premium" value="1" /></div>
		</form>
	<?php } ?>
	<?php if($num_cajones > 0) { ?>
		<h2 onClick="toggleAccesorios()">Otros complementos &#11167;</h2>
	<?php } ?>
	<br />
	<form id="form_cajones" name="form_cajones" enctype="multipart/form-data" method="POST" onSubmit="return envio();">
		<!-- <div class="item_form_cajones"><label>Herrajes en negro</label> <input type="checkbox" id="herrajes_negros" name="herrajes_negros" value="1" /></div> Situado en extras -->
		<!-- <div class="item_form_cajones"><label>Multitaladro</label> <input type="checkbox" id="multitaladro" name="multitaladro" value="1" /></div>  Situado en extras --> 
		<?php if($interior_zapatero_doble > 0){ ?>
		<div class="item_form_cajones"><label>Freno para zapatero doble (todos)</label> <input type="checkbox" id="freno_zd" name="freno_zd" value="1" /></div>
		<?php } ?>
		<?php if($num_cajones > 0){ ?>
		<div class="item_form_cajones"><label>Cajoneras lacadas</label> <input type="checkbox" id="cajoneras_lacadas" name="cajoneras_lacadas" value="1" /></div>
		<div class="item_form_cajones"><label>Tapa de cristal</label> <input type="checkbox" id="tapa_cristal" name="tapa_cristal" value="1" /></div>
		<div class="item_form_cajones"><label>Juego/s de celdillas para cajones</label> <input type="text" id="celdillas" name="celdillas" value="0" onkeypress="return valida(event)" /></div>
		<div class="item_form_cajones"><label>Cerradura/s para cajones</label> <input type="text" id="cerraduras" name="cerraduras" value="0" onkeypress="return valida(event)" /></div>
		<?php } ?>
	</form>
	<h4 id="gama-error">Debes de seleccionar gama, modelo y color para continuar</h4>
	<a class="boton grande verde" onClick="envio(<?php echo $num_cajones; ?>,<?php echo $ancho_interior; ?>);">Continuar <i class="fa fa-chevron-right"></i></a><br /><br />
</div>
<script type="text/javascript">

	$("#form_cajones").validate({
		invalidHandler: function(form, validator){
			$(validator.invalidElements()[0]).focus();
		},
		rules: {
			celdillas: { required: true, range: [0,<?php echo $num_cajones; ?>] },
			cristales: { required: true, range: [0,<?php echo $num_cajones; ?>] },
			cerraduras: { required: true, range: [0,<?php echo $num_cajones; ?>] }
		},
		messages: {
			celdillas: "<span class='error_form'>Introduce un valor entre 0 y <?php echo $num_cajones; ?></span>",
			cristales: "<span class='error_form'>Introduce un valor entre 0 y <?php echo $num_cajones; ?></span>",
			cerraduras: "<span class='error_form'>Introduce un valor entre 0 y <?php echo $num_cajones; ?></span>"
		}
	});



	
	function envio(num_cajones,ancho)
	{
		$("#gama-error").hide();
		var cristal_atenas = 0;
		var num_cristal = 0;
		if($("#form_cajones").validate().form())
		{

			if($('#herrajes_negros').is(':checked')){
				var herrajes_negros = 1;
			}
			else{
				var herrajes_negros = 0;
			}

			if($('#multitaladro').is(':checked')){
				var multitaladro = 1;
			}
			else{
				var multitaladro = 0;
			}

			if($('#tapa_cristal').is(':checked')){
				var tapa_cristal = 1;
			}
			else{
				var tapa_cristal = 0;
			}

			if($('#forrado_caja_fuerte').is(':checked')){
				var forrado_caja_fuerte = 1;
			}
			else{
				var forrado_caja_fuerte = 0;
			}

			if($('#forrado_columnas').is(':checked')){
				var forrado_columnas = 1;
			}
			else{
				var forrado_columnas = 0;
			}

			if($('#tapas_registro').is(':checked')){
				var tapas_registro = 1;
			}
			else{
				var tapas_registro = 0;
			}

			if($('#recrecer_armario').is(':checked')){
				var recrecer_armario = 1;
			}
			else{
				var recrecer_armario = 0;
			}

			if($('#cajoneras_lacadas').is(':checked')){
				var cajoneras_lacadas = 1;
			}
			else{
				var cajoneras_lacadas = 0;
			}

			if($('#freno_zd').is(':checked')){
				var freno_zd = 1;
			}
			else{
				var freno_zd = 0;
			}

			//cajones 20 alto
			if($('#cajones_20').is(':checked')){
				var cajones_20_old = 1;	
			}
			else{
				var cajones_20_old = 0;
			}

	
			if($('#freno_c').is(':checked')){
				var freno_c = 1;
			}
			else{
				var freno_c = 0;
			}
			
			if ( $("#celdillas").length ) {
				var celdillas = $('#celdillas').val();
			}
			else{
				var celdillas = 0;
			}
			
			if ( $("#cristales").length ) {
				var cristales = $('#cristales').val();
			}
			else{
				var cristales = 0;
			}
			
			if ( $("#cerraduras").length ) {
				var cerraduras = $('#cerraduras').val();
			}
			else{
				var cerraduras = 0;
			}

			if($('#pantalonero').is(':checked')){
				var pantalonero = 1;
			}
			else{
				var pantalonero = 0;
			}

			if($('#zapatero_premium').is(':checked')){
				var zapatero_premium = 1;
			}
			else{
				var zapatero_premium = 0;
			}

			if($('#cesta_premium').is(':checked')){
				var cesta_premium = 1;
			}
			else{
				var cesta_premium = 0;
			}

			if(num_cajones > 0)
			{
				if($("#basic-radio").is(':checked') && $("#postformado").is(':checked')){
					var gama = "basic";
					var modelo = "Postformado";
					var color_interior = $('input[name="postformado-opt"]:checked').val();
					if($("#check_cajones_8_post").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_post').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_post").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_post').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_post").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_post').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_post").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_post').val();
					}
					else
					{
						var cajones_32 = 0;
					}

				}
				else if($("#basic-radio").is(':checked') && $("#cerrado").is(':checked')){
					var gama = "basic";
					var modelo = "Cerrado";
					var color_interior = $('input[name="cerrado-opt"]:checked').val();
					if($("#check_cajones_8_cerr").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_cerr').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_cerr").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_cerr').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_cerr").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_cerr').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_cerr").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_cerr').val();
					}
					else
					{
						var cajones_32 = 0;
					}
				}
				else if($("#basic-radio").is(':checked') && $("#jomy-n").is(':checked')){
					var gama = "basic";
					var modelo = "Jomy Tirador negro";
					var color_interior = $('input[name="jomy-n-opt"]:checked').val();
					if($("#check_cajones_8_jomn").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_jomn').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_jomn").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_jomn').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_jomn").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_jomn').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_jomn").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_jomn').val();
					}
					else
					{
						var cajones_32 = 0;
					}

				}
				else if($("#basic-radio").is(':checked') && $("#jomy-p").is(':checked')){
					var gama = "basic";
					var modelo = "Jomy Tirador plata";
					var color_interior = $('input[name="jomy-p-opt"]:checked').val();
					if($("#check_cajones_8_jomp").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_jomp').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_jomp").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_jomp').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_jomp").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_jomp').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_jomp").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_jomp').val();
					}
					else
					{
						var cajones_32 = 0;
					}
				}
				else if($("#premium-radio").is(':checked') && $("#box").is(':checked')){
					var gama = "premium";
					var modelo = "Box";
					var color_interior = $('input[name="box-opt"]:checked').val();
					if($("#check_cajones_8_box").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_box').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_box").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_box').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_box").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_box').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_box").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_box').val();
					}
					else
					{
						var cajones_32 = 0;
					}
				}
				else if($("#premium-radio").is(':checked') && $("#inox-p").is(':checked')){
					var gama = "premium";
					var modelo = "Inox tirador plata";
					var color_interior = $('input[name="inox-p-opt"]:checked').val();
					if($("#check_cajones_8_inoxp").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_inoxp').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_inoxp").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_inoxp').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_inoxp").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_inoxp').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_inoxp").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_inoxp').val();
					}
					else
					{
						var cajones_32 = 0;
					}
				}
				else if($("#premium-radio").is(':checked') && $("#inox-n").is(':checked')){
					var gama = "premium";
					var modelo = "Inox tirador negro";
					var color_interior = $('input[name="inox-n-opt"]:checked').val();
					if($("#check_cajones_8_inoxn").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_inoxn').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_inoxn").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_inoxn').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_inoxn").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_inoxn').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_inoxn").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_inoxn').val();
					}
					else
					{
						var cajones_32 = 0;
					}
				}
				else if($("#premium-radio").is(':checked') && $("#inox-b").is(':checked')){
					var gama = "premium";
					var modelo = "Inox tirador blanco";
					var color_interior = $('input[name="inox-b-opt"]:checked').val();
					if($("#check_cajones_8_inoxb").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_inoxb').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_inoxb").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_inoxb').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_inoxb").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_inoxb').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_inoxb").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_inoxb').val();
					}
					else
					{
						var cajones_32 = 0;
					}
				}
				else if($("#premium-radio").is(':checked') && $("#atenas-t").is(':checked')){
					var gama = "premium";
					var modelo = "Atenas Tablex";
					var color_interior = $('input[name="atenas-t-opt"]:checked').val();
					if($("#check_cajones_8_atent").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_atent').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_atent").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_atent').val();
					}
					else
					{
						var cajones_16 = 0;
					}
					if($("#check_cajones_20_atent").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_atent').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_atent").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_atent').val();
					}
					else
					{
						var cajones_32 = 0;
					}
				}
				else if($("#premium-radio").is(':checked') && $("#atenas-c").is(':checked')){
					var gama = "premium";
					var modelo = "Atenas Cristal";
					var color_interior = $('input[name="atenas-c-opt"]:checked').val();
					if($("#check_cajones_8_atenc").is(':checked'))
					{
						var cajones_8 = $('#cajones_8_atenc').val();
					}
					else
					{
						var cajones_8 = 0;
					}
					if($("#check_cajones_16_atenc").is(':checked'))
					{
						var cajones_16 = $('#cajones_16_atenc').val();
					}
					else
					{
						var cajones_16 = 0;
					}

					if($("#check_cajones_20_atenc").is(':checked'))
					{
						var cajones_20 = $('#cajones_20_atenc').val();
					}
					else
					{
						var cajones_20 = 0;
					}
					if($("#check_cajones_32_atenc").is(':checked'))
					{
						var cajones_32 = $('#cajones_32_atenc').val();
					}
					else
					{
						var cajones_32 = 0;
					}
					if($('#atenas-c-cristal-t').is(':checked'))
					{
						cristal_atenas = 1;
						num_cristal = $('#num_cristal').val();
						if(num_cristal == 0 || typeof num_cristal == "undefined")
						{
							num_cristal = num_cajones;
						}
					}
					else
					{
						cristal_atenas = 2;
						num_cristal = $('#num_cristal').val();
						if(num_cristal == 0 || typeof num_cristal == "undefined")
						{
							num_cristal = num_cajones;
						}
					}
				}
				else{
					var gama = "";
					var modelo = "";
					var color_interior = "";
					var cajones_8 = 0;
					var cajones_16 = 0;
					var cajones_20 = 0;
					var cajones_32 = 0;
					var cristal_atenas = 0;
				}

				if(gama == "" || typeof gama == "undefined" || modelo == "" || typeof modelo == "undefined" || color_interior == "" || typeof color_interior == "undefined"){
					$("#gama-error").show();
					return false;
				}
			}
			else
			{
				var gama = "";
				var modelo = "";
				var color_interior = "";
			}


			var ffccc = freno_zd+"-"+freno_c+"-"+celdillas+"-"+cristales+"-"+cerraduras+"-"+cajones_20_old+"-"+herrajes_negros+"-"+multitaladro+"-"+tapa_cristal+"-"+forrado_caja_fuerte+"-"+forrado_columnas+"-"+tapas_registro+"-"+recrecer_armario+"-"+cajoneras_lacadas+"-"+pantalonero+"-"+zapatero_premium+"-"+cesta_premium+"-"+cajones_8+"-"+cajones_16+"-"+cajones_20+"-"+cajones_32+"-"+cristal_atenas+"-"+num_cristal+"-"+gama+"-"+modelo+"-"+color_interior;
			//var ffccc = freno_zd+"-"+freno_c+"-"+celdillas+"-"+cristales+"-"+cerraduras;
			preguntar_color_interior(<?php echo $num_modulo; ?>, '<?php echo $tipo; ?>', <?php echo $ancho_interior; ?>, <?php echo $id_interior; ?>, '<?php echo $nombre_interior; ?>', ffccc);
		}
		else
		{
			return false;
		}
	}

	function toggleGama() {
		// Elementos del DOM
		const toggleElement = document.getElementById('gama-toggle');
		const formElement = document.getElementById('gama-form');

		if (formElement.style.display == "none") 
		{
			// TRUE: Mostrar contenido
			formElement.style.display = 'block';
			toggleElement.innerHTML = 'Complementos cajoneras &#11167;';
		} 
		else 
		{
			// FALSE: Ocultar contenido
			formElement.style.display = 'none';
			toggleElement.innerHTML = 'Complementos cajoneras &#11164;';
		}
	}

	function toggleAccesorios() {
		// Elementos del DOM
		const toggleElement = event.currentTarget;
		const formElement = document.getElementById('form_cajones');

		if (formElement.style.display == "none") 
		{
			// TRUE: Mostrar contenido
			formElement.style.display = 'block';
			toggleElement.innerHTML = 'Otros complementos &#11167;';
		} 
		else 
		{
			// FALSE: Ocultar contenido
			formElement.style.display = 'none';
			toggleElement.innerHTML = 'Otros complementos &#11164;';
		}
	}

	function toggleAccesoriosPremium(){
		// Elementos del DOM
		const toggleElement = event.currentTarget;
		const formElement = document.getElementById('form_accesorios');

		if (formElement.style.display == "none") 
		{
			// TRUE: Mostrar contenido
			formElement.style.display = 'block';
			toggleElement.innerHTML = 'Accesorios premium &#11167;';
		} 
		else 
		{
			// FALSE: Ocultar contenido
			formElement.style.display = 'none';
			toggleElement.innerHTML = 'Accesorios premium &#11164;';
		}
	}

	function selectGamaBasic(option){
		// Oculta todos los contenidos primero
		$('#contenido_postformado').hide();
		$('#contenido_cerrado').hide();
		$('#contenido_jomy_n').hide();
		$('#contenido_jomy_p').hide();
		$('#cajones_postformado').hide();
		$('#cajones_cerrado').hide();
		$('#cajones_jomy_n').hide();
		$('#cajones_jomy_p').hide();

		// Muestra solo el contenido correspondiente
		if(option == 'Postformado'){
			$('#contenido_postformado').show();
			$('#cajones_postformado').show();
		}
		else if(option == 'Cerrado'){
			$('#contenido_cerrado').show();
			$('#cajones_cerrado').show();
		}
		else if(option == 'Jomy-n'){
			$('#contenido_jomy_n').show();
			$('#cajones_jomy_n').show();
		}
		else if(option == 'Jomy-p'){
			$('#contenido_jomy_p').show();
			$('#cajones_jomy_p').show();
		}
	}

	function selectGamaPremium(option){
		// Oculta todos los contenidos primero
		$('#contenido_box').hide();
		$('#contenido_inox_p').hide();
		$('#contenido_inox_n').hide();
		$('#contenido_inox_b').hide();
		$('#contenido_atenas_t').hide();
		$('#contenido_atenas_c').hide();
		$('#cajones_box').hide();
		$('#cajones_inoxp').hide();
		$('#cajones_inoxn').hide();
		$('#cajones_inoxb').hide();
		$('#cajones_atent').hide();
		$('#cajones_atenc').hide();
		$('#atenas-c-opciones').hide();

		// Muestra solo el contenido correspondiente
		if(option === 'Box'){
			$('#contenido_box').show();
			$('#cajones_box').show();
		} else if(option === 'Inox-p'){
			$('#contenido_inox_p').show();
			$('#cajones_inoxp').show();
		} else if(option === 'Inox-n'){
			$('#contenido_inox_n').show();
			$('#cajones_inoxn').show();
		} else if(option === 'Inox-b'){
			$('#contenido_inox_b').show();
			$('#cajones_inoxb').show();
		} else if(option === 'Atenas-t'){
			$('#contenido_atenas_t').show();
			$('#cajones_atent').show();
		} else if(option === 'Atenas-c'){
			$('#contenido_atenas_c').show();
			$('#cajones_atenc').show();
			$('#atenas-c-opciones').show();
		}
	}

	function selectGama(gama){
		const options = document.getElementsByClassName('gama_options');

		if(gama == 'basic'){
			options[0].style.display = 'block';
			options[1].style.display = 'none';
		}
		else if(gama == 'premium'){
			options[0].style.display = 'none';
			options[1].style.display = 'block';
		}
	}

	function validarCajones(maxCajones, cajon) {
		// Obtén todos los checkboxes y inputs de tipo number dentro del contenedor
		const checkboxes = document.querySelectorAll(cajon + ' input[type="checkbox"]');
		const inputs = document.querySelectorAll(cajon + ' input[type="number"]');
		let suma = 0;

		// Calcula la suma de los valores actuales de los inputs habilitados (checkbox marcado)
		inputs.forEach((input, index) => {
			const checkbox = checkboxes[index];
			if (checkbox.checked) {
				let valor = parseInt(input.value) || 0; // Convierte a número o usa 0 si está vacío
				if (valor < 0) {
					// Si el valor es negativo, ajustarlo a 0
					alert("No se permiten valores negativos en los cajones.");
					input.value = 0;
					valor = 0;
				}
				suma += valor;
			}
		});

		// Si la suma supera el máximo, muestra un error y ajusta el valor
		if (suma > maxCajones) {
			
			alert(`La suma total de cajones no puede superar ${maxCajones}.`);
			// Ajusta el último input modificado para que no supere el límite
			const excedente = suma - maxCajones;
			const lastInput = event.target;
			lastInput.value = parseInt(lastInput.value) - excedente;
			suma = maxCajones; // Ajusta la suma
		}

		// Habilita o deshabilita inputs según el límite y el estado del checkbox
		inputs.forEach((input, index) => {
			const checkbox = checkboxes[index];
			if (checkbox.checked) {
				if (suma >= maxCajones) {
					// Deshabilita los inputs que no tienen valor
					if (parseInt(input.value) === 0) {
						input.disabled = true;
					}
				} else {
					// Habilita el input si el checkbox está marcado
					input.disabled = false;
				}
			} else {
				// Si el checkbox no está marcado, el input permanece deshabilitado
				input.disabled = true;
				input.value = 0; // Resetea el valor del input
			}
		});
	}

	function validarCristales(maxCajones, cristalInputId) {
		// Obtén el input del número de cristales
		const cristalInput = document.getElementById(cristalInputId);
		let valorCristales = parseInt(cristalInput.value) || 0; // Convierte a número o usa 0 si está vacío

		// Verifica si el valor es negativo
		if (valorCristales < 0) {
			alert("No se permiten valores negativos en el número de cristales.");
			cristalInput.value = 0; // Ajusta el valor a 0
			valorCristales = 0;
		}

		// Verifica si el valor supera el número máximo de cajones
		if (valorCristales > maxCajones) {
			alert(`El número de cristales no puede superar el máximo de ${maxCajones}.`);
			cristalInput.value = maxCajones; // Ajusta el valor al máximo permitido
			valorCristales = maxCajones;
		}
	}

	function toggleInput(checkboxId, inputId) {
		const checkbox = document.getElementById(checkboxId);
		const input = document.getElementById(inputId);

		if (checkbox.checked) {
			input.disabled = false; // Habilita el input si el checkbox está seleccionado
		} else {
			input.disabled = true;  // Deshabilita el input si el checkbox no está seleccionado
			input.value = 0;        // Resetea el valor del input a 0
		}
	}
</script>