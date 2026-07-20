<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$nombre = $db->getVar('SELECT nombre FROM solicitudes_alta WHERE id='.$id);

$tarifas = $db->getResults('SELECT id, nombre FROM tarifas WHERE activa=1');
// GENERAMOS LOS OPTIONS PARA LAS TARIFAS
$options_tarifas = "";
foreach($tarifas as $tarifa){
	$options_tarifas .= "<option value='".$tarifa['id']."'>".$tarifa['nombre']."</option>";
}
?>
<div class="confirm">
	<div class="cabecera_confirm">
		Aprobar solicitud
	</div>
	<div class="cuerpo_confirm">
		<div class="contenedor_texto_confirm">	
			<div class="texto_confirm">
				Indica los siguientes datos para aprobar la solicitud de '<?php echo $nombre; ?>':
				<form id="form_datos_aprobar_solicitud" name="form_datos_aprobar_solicitud" enctype="multipart/form-data" method="POST" onSubmit="return envio();">
					<div class="item_form_datos_aprobar_solicitud">
						<label>Tarifa: </label>
						<select id="tarifa" name="tarifa">
							<?php echo $options_tarifas; ?>
						</select>
					</div>
					<div class="item_form_datos_aprobar_solicitud">
						<label>Descuento: </label>
						<input type="input" id="descuento" name="descuento" value="50" onkeypress="return valida(event)" />
					</div>
				</form>
			</div>
		</div>
		<div class="botones_confirm">
			<a class="boton grande verde" onClick="envio();">Aceptar</a> <a class="boton grande rojo" onClick="$.magnificPopup.close();">Cancelar</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#form_datos_aprobar_solicitud").validate({
			invalidHandler: function(form, validator){
				$(validator.invalidElements()[0]).focus();
			},
			rules: {
				descuento: { required: true, number: true }
			},
			messages: {
				descuento: {
					required: "<span class='error_form'>Introduce un descuento</span>",
					number: "<span class='error_form'>Introduce un número.<br />Decimales separados por punto.</span>"
				}
			}
		});
		
		$("#tarifa").focus();
	});
	
	function envio()
	{
		if($("#form_datos_aprobar_solicitud").validate().form())
		{
			aprobar_solicitud(<?php echo $id; ?>, $("#tarifa").val(), $("#descuento").val());
			$.magnificPopup.close();
		}
		else
		{
			return false;
		}
	}
</script>