<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();
?>
<div class="datos_cliente">
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
			<div class="item_datos_cliente"><div class="label"><label>Horario:</label></div><div class="input"><input type="text" id="horario" name="horario" value="" /></div></div>
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
				telefono: { required: true, minlength: 2 }
			},
			messages: {
				nombre: "<span class='error_form'>Introduce el nombre de la empresa</span>",
				dni: "<span class='error_form'>Introduce el CIF de la empresa</span>",
				direccion: "<span class='error_form'>Introduce la dirección de la empresa</span>",
				poblacion: "<span class='error_form'>Introduce la población de la empresa</span>",
				cp: "<span class='error_form'>Introduce el código postal de la empresa</span>",
				provincia: "<span class='error_form'>Introduce la provincia de la empresa</span>",
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
			
			// SE ENVÍA EL FORMULARIO GENERAL POR AJAX. LA RESPUESTA SE RECIBE EN JSON
			//$.post( "index.php", $("#form_datos_cliente").serialize(), function(data){
			//	if(data.estado == "ok"){// SI SE GUARDA CORRECTAMENTE SE INDICA EN UN MENSAJE
			//		$(".respuesta").html("<i class='fa fa-check'></i> Guardado correctamente");
			//		$(".texto_cabecera").html(data.mensaje);
			//	}
			//	else{ // SI HAY UN ERROR SE MUESTRA
			//		$(".respuesta").html("");
			//		alert(data.mensaje);
			//	}
			//}, "json");
		}
		else
		{
			return false;
		}
	}
</script>