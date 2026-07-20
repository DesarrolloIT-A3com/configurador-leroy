<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// CONSULTAMOS LOS DATOS DE EMPRESA
$datos = $db->getRow('SELECT um.nombre, um.cif, um.direccion, um.poblacion, um.cp, um.provincia, um.email, um.telefono, u.tarifa, u.descuento FROM usuarios_mod as um, usuarios as u WHERE u.id='.$id.' AND u.id_usuarios_mod = um.id');

// CONSULTAMOS LOS DATOS DE LA SOLICITUD DE ACCESO
$solicitud = $db->getRow('SELECT sa.nombre, sa.cif, sa.direccion, sa.poblacion, sa.cp, sa.provincia, sa.email, sa.telefono, sa.fecha_solicitud, sa.ip_solicitud FROM solicitudes_alta as sa, usuarios_mod as um, usuarios as u WHERE u.id='.$id.' AND u.id_usuarios_mod = um.id AND um.id_solicitudes_alta = sa.id');

// CONSULTAMOS LOS ACCESOS DEL USUSARIO
$accesos = $db->getResults('SELECT id, fecha, ip FROM usuarios_accesos WHERE id_usuarios='.$id.' ORDER BY fecha DESC LIMIT 10');
$num_accesos = $db->getVar('SELECT COUNT(*) FROM usuarios_accesos WHERE id_usuarios='.$id);

// CONSULTAMOS LOS DATOS DE LOS PROYECTOS
$proyectos = $db->getResults('SELECT id, fecha_proyecto, enviado, fecha_enviado, eliminado, fecha_eliminado FROM proyectos WHERE id_usuario='.$id.' ORDER BY fecha_proyecto DESC LIMIT 10');

$tarifas = $db->getResults('SELECT id, nombre FROM tarifas WHERE activa=1');
// GENERAMOS LOS OPTIONS PARA LAS TARIFAS
$options_tarifas = "";
foreach($tarifas as $tarifa){
	$options_tarifas .= "<option value='".$tarifa['id']."'";
	if($tarifa['id'] == $datos['tarifa']){
		$options_tarifas .= " selected='selected'";
	}
	$options_tarifas .= ">".$tarifa['nombre']."</option>";
}

?>

<div id="ver_usuario" class="pantalla_completa">
	<div class="contenido">
		<div class="navegacion">
			<a class="boton gris grande" href="index.php?seccion=usuarios"><i class="fa fa-chevron-left"></i> Listado usuarios</a>
		</div>
		<div class="titulo_superior">
			USUARIO
		</div>
		<div class="datos_usuario">
			<h2>Datos de usuario</h2>
			<div class="datos_usuario_mod">
				<h3>Datos actuales</h3>
				<div class="contenedor_form">
					<form id="form_datos_empresa" name="form_datos_empresa" enctype="multipart/form-data" method="POST" onSubmit="return envio();">
						<input type="hidden" name="seccion" value="ajax" />
						<input type="hidden" name="sub" value="guardar_datos_usuario" />
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<div class="item_form_datos_empresa"><div class="label"><label>Empresa:</label></div><div class="input"><input type="text" id="nombre" name="nombre" value="<?php echo $datos['nombre']; ?>" /></div></div>
						<div class="item_form_datos_empresa"><div class="label"><label>CIF:</label></div><div class="input"><input class="peq" type="text" id="cif" name="cif" value="<?php echo $datos['cif']; ?>" /></div></div>
						<div class="item_form_datos_empresa"><div class="label"><label>Dirección:</label></div><div class="input"><input type="text" id="direccion" name="direccion" value="<?php echo $datos['direccion']; ?>" /></div></div>
						<div class="item_form_datos_empresa"><div class="label"><label>Población:</label></div><div class="input"><input type="text" id="poblacion" name="poblacion" value="<?php echo $datos['poblacion']; ?>" /></div></div>
						<div class="item_form_datos_empresa"><div class="label"><label>C. Postal:</label></div><div class="input"><input class="peq" type="text" id="cp" name="cp" value="<?php echo $datos['cp']; ?>" /></div></div>
						<div class="item_form_datos_empresa"><div class="label"><label>Provincia:</label></div><div class="input"><input class="peq" type="text" id="provincia" name="provincia" value="<?php echo $datos['provincia']; ?>" /></div></div>
						<div class="item_form_datos_empresa"><div class="label"><label>E-mail:</label></div><div class="input"><input type="text" id="email" name="email" value="<?php echo $datos['email']; ?>" /></div></div>
						<div class="item_form_datos_empresa"><div class="label"><label>Teléfono:</label></div><div class="input"><input class="peq" type="text" id="telefono" name="telefono" value="<?php echo $datos['telefono']; ?>" /></div></div>
						
						<div class="item_form_datos_empresa"><div class="label"><a class="boton azul" onClick="mostrar_pass();">Cambiar Contraseña</a></div><div class="input_form"><input type="hidden" name="cambiar_pass" id="camibar_pass" value="0" /></div></div>
						
						<div class="item_form_datos_empresa item_pass"><div class="label">Nueva Contraseña</div><div class="input"><input class="peq" type="password" name="pass" id="input_pass" value="" /></div></div>
						<div class="item_form_datos_empresa item_pass"><div class="label">Repetir contraseña</div><div class="input"><input class="peq" type="password" name="pass2" id="input_pass2" value="" /></div></div>
						
						<script type="text/javascript">
							$(".item_pass").hide();
						</script>

						<div class="item_form_datos_empresa" style="margin-top: 30px"><div class="label"><label>Tarifa:</label></div><div class="input"><select id="tarifa" name="tarifa"><?php echo $options_tarifas; ?></select></div></div>
						<div class="item_form_datos_empresa"><div class="label"><label>Descuento:</label></div><div class="input"><input class="peq" type="text" id="descuento" name="descuento" value="<?php echo $datos['descuento']; ?>" onkeypress="return valida(event)" /></div></div>
						
						<div class="item_form_datos_empresa botones"><a class="boton rojo grande" onClick="confirmar_borrar_usuario(<?php echo $id; ?>, 1);"><i class="fa fa-trash"></i> Eliminar</a> <a class="boton verde grande" onClick="envio();"><i class="fa fa-floppy-o"></i> Guardar</a></div>
					</form>
					<div class="respuesta"></div>
				</div>
			</div>
			<div class="datos_usuario_registro">
				<h3>Datos de registro</h3>
				<div class="datos_solicitud">
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">Empresa:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['nombre']; ?></div>
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">CIF:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['cif']; ?></div>
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">Dirección:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['direccion']; ?></div>
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">C. Postal:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['cp']; ?></div>
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">Provincia:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['provincia']; ?></div>
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">Población:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['poblacion']; ?></div>
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">Teléfono:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['telefono']; ?></div>
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">E-mail:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['email']; ?></div>
					</div>
					<div class="item_datos_solicitud">
						
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">Fecha:</div>
						<div class="texto_datos_solicitud"><?php echo date('d/m/Y H:i:s', strtotime($solicitud['fecha_solicitud'])); ?></div>
					</div>
					<div class="item_datos_solicitud">
						<div class="icono_datos_solicitud">IP:</div>
						<div class="texto_datos_solicitud"><?php echo $solicitud['ip_solicitud']; ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="accesos_usuario">
			<h2>Últimos 10 accesos</h2>
			<div class="lista_accesos">
				<table id="tabla_accesos">
					<thead>
						<tr>
							<th class="centrado">Nº</th>
							<th class="centrado">Fecha</th>
							<th class="centrado">IP</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($accesos){
							foreach($accesos as $acceso){ 
								$fecha = date('d/m/Y H:i:s', strtotime($acceso['fecha']));
								$ip = $acceso['ip'];
							?>
							<tr>
								<td class="centrado"><?php echo $num_accesos; ?></td>
								<td class="centrado"><?php echo $fecha; ?></td>
								<td class="centrado"><?php echo $ip; ?></td>
							</tr>
							<?php
								$num_accesos--;
							}
						}
						else{
						?>
							<tr><td colspan="12"><center>No hay accesos</center></td></tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<script>
					$("#tabla_accesos").tablesorter( {  // PARA PODER ORDENAR LA TABLA CON JQUERY
						dateFormat: "ddmmyyyy",										// FORMATO PARA ORDENAR FECHA
						headers: { 1: { sorter: "shortDate" } },
						sortList: [[1,1]]                   // ORDEN AL ABRIR 1(FECHA) 1(DESC)
					}); 
				</script>
			</div>
		</div>
		<div class="proyectos_usuario">
			<h2>Proyectos</h2>
			<div class="listado_proyectos">
		
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
					
					listado_proyectos(<?php echo $id; ?>, "todos");
					
				});
			</script>
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