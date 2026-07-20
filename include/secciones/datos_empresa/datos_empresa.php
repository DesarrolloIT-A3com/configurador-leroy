<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

$nombre = "";
$cif = "";
$direccion = "";
$poblacion = "";
$cp = "";
$provincia = "";
$email = "";
$telefono = "";

// CONSULTAMOS LOS DATOS DE EMPRESA SI ESTÁ ACTIVO
$datos_empresa = $db->getRow('SELECT nombre, cif, direccion, poblacion, cp, provincia, email, telefono FROM usuarios_mod WHERE id = (SELECT id_usuarios_mod FROM usuarios WHERE id = '.$_SESSION['id_usuario'].')');
if($datos_empresa){
	$nombre = $datos_empresa['nombre'];
	$cif = $datos_empresa['cif'];
	$direccion = $datos_empresa['direccion'];
	$poblacion = $datos_empresa['poblacion'];
	$cp = $datos_empresa['cp'];
	$provincia = $datos_empresa['provincia'];
	$email = $datos_empresa['email'];
	$telefono = $datos_empresa['telefono'];
}
else{
	echo $_SESSION['id_usuario'];
}
?>
<div id="datos_empresa" class="pantalla_completa">
	<div class="contenido">
		<div class="titulo_superior">
			DATOS DE EMPRESA
		</div>
		<div class="datos_empresa">
			<p>Estos son los datos con los que se realizarán los presupuestos.</p>
			<p>Si no son correctos, por favor, modifícalos y pulsa en 'Guardar'.</p>
			<div class="contenedor_form">
				<form id="form_datos_empresa" name="form_datos_empresa" enctype="multipart/form-data" method="POST" onSubmit="return envio();">
					<input type="hidden" name="seccion" value="ajax" />
					<input type="hidden" name="sub" value="guardar_datos_empresa" />
					<div class="item_form_datos_empresa"><div class="label"><label>Empresa:</label></div><div class="input"><input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" /></div></div>
					<div class="item_form_datos_empresa"><div class="label"><label>CIF:</label></div><div class="input"><input class="peq" type="text" id="cif" name="cif" value="<?php echo $cif; ?>" /></div></div>
					<div class="item_form_datos_empresa"><div class="label"><label>Dirección:</label></div><div class="input"><input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" /></div></div>
					<div class="item_form_datos_empresa"><div class="label"><label>Población:</label></div><div class="input"><input type="text" id="poblacion" name="poblacion" value="<?php echo $poblacion; ?>" /></div></div>
					<div class="item_form_datos_empresa"><div class="label"><label>C. Postal:</label></div><div class="input"><input class="peq" type="text" id="cp" name="cp" value="<?php echo $cp; ?>" /></div></div>
					<div class="item_form_datos_empresa"><div class="label"><label>Provincia:</label></div><div class="input"><input class="peq" type="text" id="provincia" name="provincia" value="<?php echo $provincia; ?>" /></div></div>
					<div class="item_form_datos_empresa"><div class="label"><label>E-mail:</label></div><div class="input"><input type="text" id="email" name="email" value="<?php echo $email; ?>" /></div></div>
					<div class="item_form_datos_empresa"><div class="label"><label>Teléfono:</label></div><div class="input"><input class="peq" type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" /></div></div>
					
					<div class="item_form_datos_empresa"><div class="label"><a class="boton azul" onClick="mostrar_pass();">Cambiar Contraseña</a></div><div class="input_form"><input type="hidden" name="cambiar_pass" id="camibar_pass" value="0" /></div></div>
					
					<div class="item_form_datos_empresa item_pass"><div class="label">Nueva Contraseña</div><div class="input"><input class="peq" type="password" name="pass" id="input_pass" value="" /></div></div>
					<div class="item_form_datos_empresa item_pass"><div class="label">Repetir contraseña</div><div class="input"><input class="peq" type="password" name="pass2" id="input_pass2" value="" /></div></div>
					
					<script type="text/javascript">
						$(".item_pass").hide();
					</script>

					<div class="item_form_datos_empresa botones"><a class="boton verde grande" onClick="envio();"><i class="fa fa-floppy-o"></i> Guardar</a> <a class="boton gris grande" href="index.php"><i class="fa fa-chevron-left"></i> Volver</a></div>
				</form>
				<div class="respuesta"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form_datos_empresa").validate({
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
					required: "<span class='error_form'>Introduzca una contraseña</span>",
					minlength: $.format("<span class='error_form'>Mínimo {0} caracteres</span>")
				},
				pass2: "<span class='error_form'>Repita la contraseña</span>"
			}
		});
		
		$("#nombre").focus();
	});
	
	function envio()
	{
		if($("#form_datos_empresa").validate().form())
		{
			$(".respuesta").html("<i class='fa fa-spinner fa-spin'></i> Guardando ...");
			
			// SE GUARDAN LOS DATOS POR AJAX. LA RESPUESTA SE RECIBE EN JSON
			$.post( "index.php", $("#form_datos_empresa").serialize(), function(data){
				if(data.estado == "ok"){// SI SE GUARDA CORRECTAMENTE SE INDICA EN UN MENSAJE
					$(".respuesta").html("<i class='fa fa-check'></i> Guardado correctamente");
					$(".texto_cabecera").html(data.mensaje);
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