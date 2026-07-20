<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE MARCADA PARA VER QUE TABLEROS SE LE PERMITEN
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)						$id_serie = (int)$_POST['id_serie']; 
$id_acabado = 0;
if(isset($_POST['id_acabado']) && $_POST['id_acabado'] > 0)					$id_acabado = (int)$_POST['id_acabado']; 
// VEMOS EL NÚMERO DE PUERTAS ELEGIDO
$num_puertas = 0;
if(isset($_POST['num_puertas']) && $_POST['num_puertas'] > 0)				$num_puertas = (int)$_POST['num_puertas']; 
// DISEÑO DE CADA PUERTA
$diseno_puerta_1 = "";
if(isset($_POST['diseno_puerta_1']) && $_POST['diseno_puerta_1'] != "")		$diseno_puerta_1 = explode("-",$_POST['diseno_puerta_1']); 
$diseno_puerta_2 = "";
if(isset($_POST['diseno_puerta_2']) && $_POST['diseno_puerta_2'] != "")		$diseno_puerta_2 = explode("-",$_POST['diseno_puerta_2']); 
$diseno_puerta_3 = "";
if(isset($_POST['diseno_puerta_3']) && $_POST['diseno_puerta_3'] != "")		$diseno_puerta_3 = explode("-",$_POST['diseno_puerta_3']); 
$diseno_puerta_4 = "";
if(isset($_POST['diseno_puerta_4']) && $_POST['diseno_puerta_4'] != "")		$diseno_puerta_4 = explode("-",$_POST['diseno_puerta_4']); 
$diseno_puerta_5 = "";
if(isset($_POST['diseno_puerta_5']) && $_POST['diseno_puerta_5'] != "")		$diseno_puerta_5 = explode("-",$_POST['diseno_puerta_5']); 
$diseno_puerta_6 = "";
if(isset($_POST['diseno_puerta_6']) && $_POST['diseno_puerta_6'] != "")		$diseno_puerta_6 = explode("-",$_POST['diseno_puerta_6']); 
$diseno_puerta_7 = "";
if(isset($_POST['diseno_puerta_7']) && $_POST['diseno_puerta_7'] != "")		$diseno_puerta_7 = explode("-",$_POST['diseno_puerta_7']); 
$diseno_puerta_8 = "";
if(isset($_POST['diseno_puerta_8']) && $_POST['diseno_puerta_8'] != "")		$diseno_puerta_8 = explode("-",$_POST['diseno_puerta_8']); 
// VEMOS EL NÚMERO DE MÓDULOS ELEGIDO
$num_modulos = 0;
if(isset($_POST['num_modulos']) && $_POST['num_modulos'] > 0)				$num_modulos = (int)$_POST['num_modulos']; 
// DISEÑO DE CADA MÓDULO
$interior_puerta_1 = "";
if(isset($_POST['interior_puerta_1']) && $_POST['interior_puerta_1'] != "")		$interior_puerta_1 = explode("-",$_POST['interior_puerta_1']); 
$interior_puerta_2 = "";
if(isset($_POST['interior_puerta_2']) && $_POST['interior_puerta_2'] != "")		$interior_puerta_2 = explode("-",$_POST['interior_puerta_2']); 
$interior_puerta_3 = "";
if(isset($_POST['interior_puerta_3']) && $_POST['interior_puerta_3'] != "")		$interior_puerta_3 = explode("-",$_POST['interior_puerta_3']); 
$interior_puerta_4 = "";
if(isset($_POST['interior_puerta_4']) && $_POST['interior_puerta_4'] != "")		$interior_puerta_4 = explode("-",$_POST['interior_puerta_4']); 
$interior_puerta_5 = "";
if(isset($_POST['interior_puerta_5']) && $_POST['interior_puerta_5'] != "")		$interior_puerta_5 = explode("-",$_POST['interior_puerta_5']); 
$interior_puerta_6 = "";
if(isset($_POST['interior_puerta_6']) && $_POST['interior_puerta_6'] != "")		$interior_puerta_6 = explode("-",$_POST['interior_puerta_6']); 
$interior_puerta_7 = "";
if(isset($_POST['interior_puerta_7']) && $_POST['interior_puerta_7'] != "")		$interior_puerta_7 = explode("-",$_POST['interior_puerta_7']); 
$interior_puerta_8 = "";
if(isset($_POST['interior_puerta_8']) && $_POST['interior_puerta_8'] != "")		$interior_puerta_8 = explode("-",$_POST['interior_puerta_8']); 

$modulos_dobles = $num_puertas - $num_modulos;
$modulos_simples = $num_modulos - $modulos_dobles;

//$tapetas = $db->getResults('SELECT id, nombre, precio FROM tapetas WHERE id_series='.$id_serie.' AND id_acabados='.$id_acabado);
//$laterales = $db->getResults('SELECT id, nombre, precio FROM laterales WHERE id_series='.$id_serie.' AND id_acabados='.$id_acabado);

//$costados = $db->getResults('SELECT id, nombre, precio FROM costados WHERE id_acabados='.$id_acabado);

//$montaje_frente = $db->getRow('SELECT id, nombre, precio FROM montajes_frentes WHERE hojas='.$num_puertas);
//$montaje_interior = $db->getRow('SELECT id, nombre, precio FROM montajes_interiores WHERE modulos='.$num_modulos);
?>
<pre style="color:red;">DEBUG: interior_puerta_1 <?php print_r($interior_puerta_1); ?></pre>
<h1>Finalizar</h1>
<div class="seccion_finalizar">
	<?php
	if($id_serie != 0){
	?>
	<h2>Frente</h2>
	<div class="finlizar_frente puertas-<?php echo $num_puertas; ?>">
		<?php for($i = 1 ; $i <= $num_puertas ; $i++){ ?>
		<?php $img_puerta = $db->getVar('SELECT imagen FROM puertas WHERE id='.${"diseno_puerta_" . $i}[2]); ?>
		<div class="item_finalizar_frente">
			<h3>P<?php echo $i; ?></h3>
			<img id="puerta-<?php echo $i; ?>" src="www/img/disenos/<?php echo $id_serie; ?>/<?php echo $id_acabado; ?>/<?php echo ${"diseno_puerta_" . $i}[0]; ?>/<?php echo ${"diseno_puerta_" . $i}[1]; ?>/<?php echo $img_puerta; ?>" title="Colores puerta <?php echo $i; ?>" num_puerta="<?php echo $i; ?>" />
		</div>
		<?php } ?>
	</div>
	<?php
	}
	?>
	<?php
	if($num_modulos > 0){
	?>
	<h2>Interior</h2>
	<div class="finlizar_interior puertas-<?php echo $num_modulos; ?>">
		<?php
		$num_modulo = 0;
		for($j=1; $j<=$modulos_dobles; $j++){
			$num_modulo++;
		?>
		<div class="item_finalizar_interior">
			<h3>M<?php echo $num_modulo; ?> (D<span>oble</span>)</h3>
			<img id="img_modulo_<?php echo $num_modulo; ?>" src="www/img/interiores/modulo-<?php echo ${'interior_puerta_'.$num_modulo}[1]; ?>.jpg" />
		</div>
		<?php
		}
		for($j=1; $j<=$modulos_simples; $j++){
			$num_modulo++;
		?>
		<div class="item_finalizar_interior">
			<h3>M<?php echo $num_modulo; ?> (S<span>imple</span>)</h3>
			<img id="img_modulo_<?php echo $num_modulo; ?>" src="www/img/interiores/modulo-<?php echo ${'interior_puerta_'.$num_modulo}[1]; ?>.jpg" />
		</div>
		<?php
		}
		?>
	</div>
	<?php
	}
	?>
	<?php /*
	<h2>Descuentos</h2>
	<div class="finlizar_anadir">
		<div class="contenido_finalizar_anadir">
			<center>Aplicar descuento del <input type="text" id="aplicar_descuento_cliente" name="aplicar_descuento_cliente" onkeypress="return valida(event)" value="0" /> %</center>
			<br /><br /><br />
			<center><a class="boton gris grande" onClick="aplicar_descuento();"><i class="fa fa-calculator"></i> Recalcular precio</a></center>
		</div>
	</div>*/ ?>
	<input type="hidden" id="aplicar_descuento_cliente" name="aplicar_descuento_cliente" value="0" />
	
	<h2>Observaciones</h2>
	<div class="finlizar_observaciones">
		<textarea id="observaciones" name="observaciones"></textarea>
	</div>
</div>



<div class="datos_cliente mfp-hide">
	<h1>
		Datos del cliente
	</h1>
	<div class="contenedor_datos_cliente">
		<form id="form_datos_cliente" name="form_datos_cliente" enctype="multipart/form-data" method="POST" onSubmit="return envio();">
			<div class="item_datos_cliente"><div class="label"><label>Nombre:</label></div><div class="input"><input type="text" id="nombre" name="nombre" value="" /></div></div>
			<div class="item_datos_cliente"><div class="label"><label>DNI:</label></div><div class="input"><input class="peq" type="text" id="dni" name="dni" value="" /></div></div>
			<div class="item_datos_cliente"><div class="label"><label>Dirección:</label></div><div class="input"><input type="text" id="direccion" name="direccion" value="" /></div></div>
			<div class="item_datos_cliente"><div class="label"><label>Población:</label></div><div class="input"><input type="text" id="poblacion" name="poblacion" value="" /></div></div>
			<div class="item_datos_cliente"><div class="label"><label>C. Postal:</label></div><div class="input"><input class="peq" type="text" id="cp" name="cp" value="" /></div></div>
			<div class="item_datos_cliente"><div class="label"><label>Provincia:</label></div><div class="input"><input class="peq" type="text" id="provincia" name="provincia" value="" /></div></div>
			<div class="item_datos_cliente"><div class="label"><label>E-mail:</label></div><div class="input"><input type="text" id="email" name="email" value="" /></div></div>
			<div class="item_datos_cliente"><div class="label"><label>Teléfono:</label></div><div class="input"><input class="peq" type="text" id="telefono" name="telefono" value="" /></div></div>
			<div class="item_datos_cliente"><div class="label"><label>Horario de contacto:</label></div><div class="input"><input type="text" id="horario" name="horario" value="" /></div></div>
			<div class="item_datos_cliente botones"><a class="boton verde grande" onClick="envio();"><i class="fa fa-floppy-o"></i> Guardar</a> <a class="boton rojo grande" onClick="$.magnificPopup.close();"><i class="fa fa-window-close-o"></i> Cancelar</a></div>
			<div class="respuesta"></div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_datos_cliente").validate({
			invalidHandler: function(form, validator){
				$(validator.invalidElements()[0]).focus();
			},
			rules: {
				nombre: { required: true },
				dni: { required: true, minlength: 2 },
				direccion: { required: true, minlength: 2 },
				poblacion: { required: true, minlength: 2 },
				cp: { required: true, minlength: 2 },
				provincia: { required: true, minlength: 2 },
				email: { email: true },
				telefono: { required: true, minlength: 2 }
			},
			messages: {
				nombre: "<span class='error_form'>Introduce el nombre de la empresa</span>",
				dni: "<span class='error_form'>Introduce el CIF de la empresa</span>",
				direccion: "<span class='error_form'>Introduce la dirección de la empresa</span>",
				poblacion: "<span class='error_form'>Introduce la población de la empresa</span>",
				cp: "<span class='error_form'>Introduce el código postal de la empresa</span>",
				provincia: "<span class='error_form'>Introduce la provincia de la empresa</span>",
				email: "<span class='error_form'>Introduce un email correcto</span>",
				telefono: "<span class='error_form'>Introduce el teléfono de la empresa</span>"
			}
		});
		
		$("#nombre").focus();
	});
	
	function envio()
	{
		if($("#form_datos_cliente").validate().form())
		{
			$(".respuesta").html("<i class='fa fa-spinner fa-spin'></i> Guardando ...");
			
			// SE GUARDAN LOS DATOS EN EL FORMULARIO GENERAL
			$('#nombre_cliente').val($('#nombre').val());
			$('#dni_cliente').val($('#dni').val());
			$('#direccion_cliente').val($('#direccion').val());
			$('#poblacion_cliente').val($('#poblacion').val());
			$('#cp_cliente').val($('#cp').val());
			$('#provincia_cliente').val($('#provincia').val());
			$('#telefono_cliente').val($('#telefono').val());
			$('#email_cliente').val($('#email').val());
			$('#horario_cliente').val($('#horario').val());
			
			// SE GUARDA EL PROYECTO COMPLETO
			guardar_proyecto();
			
		}
		else
		{
			return false;
		}
	}
</script>