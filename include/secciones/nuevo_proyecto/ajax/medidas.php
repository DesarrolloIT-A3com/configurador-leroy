<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LA SERIE MARCADA PARA VER QUE MEDIDAS SE LE PERMITEN
$id_serie = 0;
if(isset($_POST['id_serie']) && $_POST['id_serie'] > 0)			$id_serie = (int)$_POST['id_serie']; 
// VEMOS EL ACABADO MARCADO YA QUE PARA BARNIZADO LA ALTURA MÁXIMA SERÁ 260
$id_acabado = 0;
if(isset($_POST['id_acabado']) && $_POST['id_acabado'] > 0)		$id_acabado = (int)$_POST['id_acabado']; 

// CONSULTAMOS LAS MEDIDAS QUE PUEDE TENER
$medidas = $db->getRow('SELECT ancho_total_min, ancho_total_max, alto_total_min, alto_total_max FROM series WHERE id = '.$id_serie);

if($medidas){
	$ancho_total_min = $medidas['ancho_total_min'];
	$ancho_total_max = $medidas['ancho_total_max'];
	$alto_total_min = $medidas['alto_total_min'];
	$alto_total_max = $medidas['alto_total_max'];
}
else{ // SI NO HAY MEDIDAS ES QUE SE TRATA DE UN INTERIOR SIN FRENTE
	$ancho_total_min = 40;
	$ancho_total_max = 600;
	$alto_total_min = 40;
	$alto_total_max = 300;
}

if($id_acabado == 6){ // SI ES BARNIZADO LA ALTURA MÁXIMA SERÁ DE 260
	$alto_total_max = 260;
}

$fondo_min = 60;
$fondo_max = 100;
?>

<h1>Medidas totales</h1>
<div class="seccion_medidas">
	<div class="contenedor_form">
		<form id="form_medidas" name="form_medidas" enctype="multipart/form-data" method="POST" onSubmit="return envio();">
			<div class="item_seccion_medidas alto">
				<div class="input_seccion_medidas">
					<div class="label"><label>Alto*</label></div><div class="input"><input id="input_alto" name="input_alto" type="text" value="" onkeypress="return valida(event)" /></div><div class="postlabel">cm.</div>
				</div>
				<div class="leyenda_seccion_medidas">
					Min. <?php echo $alto_total_min; ?> - Max. <?php echo $alto_total_max; ?><br />
					<small>* Altura máxima para frente modelo Liso, Lama, Mayorquina, Japonés, Hong Kong y Serigrafía 260 cm. Hasta 270 cm. 10% incremento y hasta 275 cm. 20% incremento.<br />
					* Altura máxima para frente modelo Pico gorrión, Cenefas, Inserciones cerámicas y Pantografía 250 cm.<br />
					* Altura máxima para frentes barnizados 260 cm.<br />
					* Menos de 130 cm. descuenta precio 25%.<br />
					* Menos de 60 cm. descuenta precio 45%.<br />
					* Interiores de 260 cm. a 300 cm. se incrementará un 10% por cada 10 cm.</small>
				</div>
			</div>
			<div class="item_seccion_medidas ancho">
				<div class="input_seccion_medidas">
					<div class="label"><label>Ancho</label></div><div class="input"><input id="input_ancho" name="input_ancho" type="text" value="" onkeypress="return valida(event)" /></div><div class="postlabel">cm.</div>
				</div>
				<div class="leyenda_seccion_medidas">
					Min. <?php echo $ancho_total_min; ?> - Max. <?php echo $ancho_total_max; ?>
				</div>
			</div>
			<div class="item_seccion_medidas fondo">
				<div class="input_seccion_medidas">
					<div class="label"><label>Fondo**</label></div><div class="input"><input id="input_fondo" name="input_fondo" type="text" value="60" onkeypress="return valida(event)" /></div><div class="postlabel">cm.</div>
				</div>
				<div class="leyenda_seccion_medidas">
					Min. <?php echo $fondo_min; ?> - Max. <?php echo $fondo_max; ?><br />
					<small>** Hay que indicar una medida de fondo aunque no se quiera interior.<br />
					** De 60cm. a 100 cm. un 10% de incremento por cada 10 cm.</small>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">

	$("#form_medidas").validate({
		invalidHandler: function(form, validator){
			$(validator.invalidElements()[0]).focus();
		},
		rules: {
			input_ancho: { required: true, range: [<?php echo $ancho_total_min; ?>,<?php echo $ancho_total_max; ?>] },
			input_alto: { required: true, range: [<?php echo $alto_total_min; ?>,<?php echo $alto_total_max; ?>] },
			input_fondo: { required: true, range: [<?php echo $fondo_min; ?>,<?php echo $fondo_max; ?>] }
		},
		messages: {
			input_ancho: "<span class='error_form'>Introduce un valor correcto</span>",
			input_alto: "<span class='error_form'>Introduce un valor correcto</span>",
			input_fondo: "<span class='error_form'>Introduce un valor correcto</span>"
		}
	});
	
	$("#input_alto").focus();
	
	function envio()
	{	
		if($("#form_medidas").validate().form())
		{
			continuar_proyecto(5,4);
		}
		else
		{
			return false;
		}
	}
</script>