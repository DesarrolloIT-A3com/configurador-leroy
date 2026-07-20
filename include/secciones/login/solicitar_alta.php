<div class="ventana_alta">
	<div class="logo">
		<img src="www/img/logo_arjomy.png"><br />CONFIGURADOR DE ARMARIOS
	</div>
	<h1>Solicitar acceso</h1>
	<p>Rellena el siguiente formulario para solicitar el acceso al configurador.</p>
	<p>Estos datos serán revisados por Arjomy y recibirás un correo electrónico con la aceptación o denegación de acceso.</p>
	<div class="contenedor_form">
		<form id="form_datos_alta" name="form_datos_alta" enctype="multipart/form-data" method="POST" onSubmit="return solicitar();">
			<input type="hidden" name="seccion" value="ajax" />
			<input type="hidden" name="sub" value="guardar_datos_alta" />
			<div class="item_form_datos_alta"><div class="label"><label>Empresa:</label></div><div class="input"><input type="text" id="nombre" name="nombre" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>CIF:</label></div><div class="input"><input class="peq" type="text" id="cif" name="cif" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>Dirección:</label></div><div class="input"><input type="text" id="direccion" name="direccion" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>Población:</label></div><div class="input"><input type="text" id="poblacion" name="poblacion" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>C. Postal:</label></div><div class="input"><input class="peq" type="text" id="cp" name="cp" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>Provincia:</label></div><div class="input"><input class="peq" type="text" id="provincia" name="provincia" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>Teléfono:</label></div><div class="input"><input class="peq" type="text" id="telefono" name="telefono" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>E-mail:</label></div><div class="input"><input type="text" id="email" name="email" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>Contraseña:</label></div><div class="input"><input class="peq" type="password" name="pass" id="input_pass" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><label>Repetir contraseña:</label></div><div class="input"><input class="peq" type="password" name="pass2" id="input_pass2" value="" /></div></div>
			<div class="item_form_datos_alta"><div class="label"><input class="peq" type="checkbox" name="aceptar" id="acepta" value="Acepto la política de privacidad" /></div><div class="input"><label style="margin-top:3px; display: block;">   He leído y acepto la <a href="https://arjomy.es/politica-de-privacidad/" target="_blank">política de privacidad</a>.</label></div></div>
			<div class="item_form_datos_alta botones"><a class="boton verde grande" onClick="solicitar();"><i class="fa fa-send-o"></i> Enviar</a> <a class="boton gris grande" href="index.php"><i class="fa fa-chevron-left"></i> Volver</a></div>
		</form>
		<div class="respuesta"></div>
	</div>
	<script>
		$("#nombre").focus();
	</script>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		
		$("#form_datos_alta").validate({
			invalidHandler: function(form, validator){
				$(validator.invalidElements()[0]).focus();
			},
			rules: {
				nombre: { required: true },
				cif: { required: true, minlength: 2 },
				direccion: { required: true, minlength: 2 },
				poblacion: { required: true, minlength: 2 },
				cp: { required: true, minlength: 2 },
				provincia: { required: true, minlength: 2 },
				email: { required: true, email: true },
				telefono: { required: true, minlength: 2 },
				pass: { required: true, minlength: 6 },
				pass2: { required: true, equalTo: '#input_pass' },
				aceptar: { required: true }
			},
			messages: {
				nombre: "<span class='error_form'>Introduce el nombre de la empresa</span>",
				cif: "<span class='error_form'>Introduce el CIF de la empresa</span>",
				direccion: "<span class='error_form'>Introduce la dirección de la empresa</span>",
				poblacion: "<span class='error_form'>Introduce la población de la empresa</span>",
				cp: "<span class='error_form'>Introduce el código postal de la empresa</span>",
				provincia: "<span class='error_form'>Introduce la provincia de la empresa</span>",
				email: "<span class='error_form'>Introduce el email de contacto de la empresa</span>",
				telefono: "<span class='error_form'>Introduce el teléfono de la empresa</span>",
				pass: {
					required: "<span class='error_form'>Introduce una contraseña</span>",
					minlength: $.format("<span class='error_form'>Mínimo {0} caracteres</span>")
				},
				pass2: {
					required: "<span class='error_form'>Repite la contraseña</span>",
					equalTo: "<span class='error_form'>Las contraseñas han de ser iguales</span>"
				},
				aceptar: "<span class='error_form'>Debes aceptar la Política de Privacidad</span>"
			}
		});
		
		$("#nombre").focus();
	});
	
	function solicitar()
	{
		if($("#form_datos_alta").validate().form())
		{
			$(".respuesta").html("<i class='fa fa-spinner fa-spin'></i> Enviando ...");
			
			// SE GUARDAN LOS DATOS POR AJAX. LA RESPUESTA SE RECIBE EN JSON
			$.post( "index.php", $("#form_datos_alta").serialize(), function(data){
				if(data.estado == "ok"){// SI SE GUARDA CORRECTAMENTE SE INDICA EN UN MENSAJE
					$(".respuesta").html("<i class='fa fa-check'></i> Enviado correctamente. En breve recibirás contestación a la solicitud.");
				}
				else{ // SI HAY UN ERROR SE MUESTRA
					$(".respuesta").html("");
					alert(data.mensaje);
				}
			}, "json");
		}
		else
		{
			return false;
		}
	}
</script>