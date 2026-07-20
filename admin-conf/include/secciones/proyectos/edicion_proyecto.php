<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$proyecto = $db->getRow('SELECT id_usuario, id_tarifa, descuento, id_serie, id_acabado, id_color_perfileria, ancho, alto, fondo, num_puertas, diseno_puerta_1, diseno_puerta_2, diseno_puerta_3, diseno_puerta_4, diseno_puerta_5, diseno_puerta_6, diseno_puerta_7, diseno_puerta_8, ceramica_puerta_1, ceramica_puerta_2, ceramica_puerta_3, ceramica_puerta_4, ceramica_puerta_5, ceramica_puerta_6, ceramica_puerta_7, ceramica_puerta_8, colores_puerta_1, colores_puerta_2, colores_puerta_3, colores_puerta_4, colores_puerta_5, colores_puerta_6, colores_puerta_7, colores_puerta_8, num_modulos_interior, interior_puerta_1, interior_puerta_2, interior_puerta_3, interior_puerta_4, interior_puerta_5, interior_puerta_6, interior_puerta_7, interior_puerta_8, laterales_seleccionado, tapetas_seleccionado, costados_seleccionado, fijos_seleccionado, montaje_frente_seleccionado, montaje_interior_seleccionado, desmontaje_frente_seleccionado, desmontaje_interior_seleccionado, juego_led_seleccionado, rematar_frente_seleccionado, rematar_interior_seleccionado, montaje_frente_arjomy_seleccionado, montaje_interior_arjomy_seleccionado, desmontaje_frente_arjomy_seleccionado, desmontaje_interior_arjomy_seleccionado, juego_led_arjomy_seleccionado, rematar_frente_arjomy_seleccionado, sistema_frenos_seleccionado, regleta_led_seleccionado, frente_abuardillado_seleccionado, albanileria_con_seleccionado, albanileria_sin_seleccionado, precio_frente, inc_desc_frente, cant_inc_desc_frente, precio_ceramica, precio_modulos_interior, precio_accesorios_interior, inc_desc_interior, cant_inc_desc_interior, precio_tapetas, precio_laterales, precio_costados, precio_fijos, precio_montaje_frente, precio_montaje_interior, precio_desmontaje_frente, precio_desmontaje_interior, precio_juego_led, precio_rematar_frente, precio_rematar_interior, precio_sistema_frenos, precio_regleta_led, precio_frente_abuardillado, precio_albanileria_con, precio_albanileria_sin, precio_costados_dist, precio_fijos_dist, precio_montaje_frente_dist, precio_montaje_interior_dist, precio_desmontaje_frente_dist, precio_desmontaje_interior_dist, precio_juego_led_dist, precio_rematar_frente_dist, precio_sistema_frenos_dist, aplicar_descuento, descuento_cliente, porcentaje_iva, iva, precio_total, observaciones, nombre_cliente, dni_cliente, direccion_cliente, poblacion_cliente, cp_cliente, provincia_cliente, telefono_cliente, email_cliente, horario_cliente, fecha_proyecto, enviado, fecha_enviado, eliminado, fecha_eliminado FROM proyectos WHERE id='.$id);

$usuario = $db->getVar('SELECT um.nombre FROM usuarios as u, usuarios_mod as um WHERE u.id_usuarios_mod = um.id AND u.id='.$proyecto['id_usuario']);

$_SESSION['id_usuario'] = $proyecto['id_usuario'];
$_SESSION['nombre_usuario'] = $usuario;
$_SESSION['iva'] = 21;
$_SESSION['pvp'] = 35;
$_SESSION['incremento260'] = 10;
$_SESSION['incremento270'] = 20;
$_SESSION['descuento130'] = 25;
$_SESSION['descuento60'] = 45;
$_SESSION['id_proyecto'] = $id;

$diseno_puerta_1 = explode("-",$proyecto['diseno_puerta_1']); 
$diseno_puerta_2 = explode("-",$proyecto['diseno_puerta_2']); 
$diseno_puerta_3 = explode("-",$proyecto['diseno_puerta_3']); 
$diseno_puerta_4 = explode("-",$proyecto['diseno_puerta_4']); 
$diseno_puerta_5 = explode("-",$proyecto['diseno_puerta_5']); 
$diseno_puerta_6 = explode("-",$proyecto['diseno_puerta_6']); 
$diseno_puerta_7 = explode("-",$proyecto['diseno_puerta_7']); 
$diseno_puerta_8 = explode("-",$proyecto['diseno_puerta_8']);
$colores_puerta_1 = explode("-",$proyecto['colores_puerta_1']);
$colores_puerta_2 = explode("-",$proyecto['colores_puerta_2']);
$colores_puerta_3 = explode("-",$proyecto['colores_puerta_3']);
$colores_puerta_4 = explode("-",$proyecto['colores_puerta_4']);
$colores_puerta_5 = explode("-",$proyecto['colores_puerta_5']);
$colores_puerta_6 = explode("-",$proyecto['colores_puerta_6']);
$colores_puerta_7 = explode("-",$proyecto['colores_puerta_7']);
$colores_puerta_8 = explode("-",$proyecto['colores_puerta_8']); 
$interior_puerta_1 = explode("-",$proyecto['interior_puerta_1']);
$interior_puerta_2 = explode("-",$proyecto['interior_puerta_2']);
$interior_puerta_3 = explode("-",$proyecto['interior_puerta_3']);
$interior_puerta_4 = explode("-",$proyecto['interior_puerta_4']);
$interior_puerta_5 = explode("-",$proyecto['interior_puerta_5']);
$interior_puerta_6 = explode("-",$proyecto['interior_puerta_6']);
$interior_puerta_7 = explode("-",$proyecto['interior_puerta_7']);
$interior_puerta_8 = explode("-",$proyecto['interior_puerta_8']);

$serie = $db->getVar('SELECT nombre FROM series WHERE id='.$proyecto['id_serie']);
$acabado = $db->getVar('SELECT nombre FROM acabados WHERE id='.$proyecto['id_acabado']);
$perfileria = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.$proyecto['id_color_perfileria']);

?>

<?php
$tarifa_descuento = $db->getRow('SELECT tarifa, descuento FROM usuarios WHERE id='.$_SESSION['id_usuario']);
?>

<div id="proyecto" class="pantalla_completa">
	<div class="contenido">
		<div class="titulo_superior">
			EDITAR PROYECTO 'P<?php echo str_pad($id, 6, "0", STR_PAD_LEFT); ?>'
		</div>	
		
		<div class="progreso">
			<div class="item_progreso serie">
				<a onClick="volver_progreso('serie',1);">1<span class="item_proceso_texto">. Serie<span></a>
			</div>
			<div class="item_progreso acabado">
				<a onClick="volver_progreso('acabado',2);">2<span class="item_proceso_texto">. Acabado<span></a>
			</div>
			<div class="item_progreso perfileria">
				<a onClick="volver_progreso('perfileria',3);">3<span class="item_proceso_texto">. Perfilería<span></a>
			</div>
			<div class="item_progreso medidas">
				<a onClick="volver_progreso('medidas',4);">4<span class="item_proceso_texto">. Medidas<span></a>
			</div>
			<div class="item_progreso puertas">
				<a onClick="volver_progreso('puertas',5);">5<span class="item_proceso_texto">. Puertas<span></a>
			</div>
			<div class="item_progreso diseno">
				<a onClick="volver_progreso('diseno',6);">6<span class="item_proceso_texto">. Diseño<span></a>
			</div>
			<div class="item_progreso colores">
				<a onClick="volver_progreso('colores',7);">7<span class="item_proceso_texto">. Colores<span></a>
			</div>
			<div class="item_progreso interior">
				<a onClick="volver_progreso('interior',8);">8<span class="item_proceso_texto">. Interior<span></a>
			</div>
			<div class="item_progreso extras">
				<a onClick="volver_progreso('extras',9);">9<span class="item_proceso_texto">. Extras<span></a>
			</div>
			<div class="item_progreso finalizar">
				10<span class="item_proceso_texto">. Finalizar<span>
			</div>
		</div>
		<form id="form_proyecto" name="form_proyecto" enctype="multipart/form-data" method="POST" action="">
			<input type="hidden" id="seccion" name="seccion" value="ajax" />
			<input type="hidden" id="sub" name="sub" value="nuevo_proyecto" />
			<input type="hidden" id="ac" name="ac" value="actualizar_proyecto" />
			<input type="hidden" id="tarifa" name="tarifa" value="<?php echo $tarifa_descuento['tarifa']; ?>" />
			<input type="hidden" id="descuento" name="descuento" value="<?php echo $tarifa_descuento['descuento']; ?>" />
			<input type="hidden" id="serie_marcada" name="serie_marcada" value="<?php echo $proyecto['id_serie']; ?>" />
			<input type="hidden" id="acabado_marcado" name="acabado_marcado" value="<?php echo $proyecto['id_acabado'];?>" />
			<input type="hidden" id="perfileria_marcada" name="perfileria_marcada" value="<?php echo $proyecto['id_color_perfileria'];?>" />
			<input type="hidden" id="medidas_ancho" name="medidas_ancho" value="<?php echo $proyecto['ancho'];?>" />
			<input type="hidden" id="medidas_alto" name="medidas_alto" value="<?php echo $proyecto['alto'];?>" />
			<input type="hidden" id="medidas_fondo" name="medidas_fondo" value="<?php echo $proyecto['fondo'];?>" />
			<input type="hidden" id="puertas_marcado" name="puertas_marcado" value="<?php echo $proyecto['num_puertas'];?>" />
			<input type="hidden" id="diseno_puerta_1" name="diseno_puerta_1" value="<?php echo $proyecto['diseno_puerta_1'];?>" />
			<input type="hidden" id="diseno_puerta_2" name="diseno_puerta_2" value="<?php echo $proyecto['diseno_puerta_2'];?>" />
			<input type="hidden" id="diseno_puerta_3" name="diseno_puerta_3" value="<?php echo $proyecto['diseno_puerta_3'];?>" />
			<input type="hidden" id="diseno_puerta_4" name="diseno_puerta_4" value="<?php echo $proyecto['diseno_puerta_4'];?>" />
			<input type="hidden" id="diseno_puerta_5" name="diseno_puerta_5" value="<?php echo $proyecto['diseno_puerta_5'];?>" />
			<input type="hidden" id="diseno_puerta_6" name="diseno_puerta_6" value="<?php echo $proyecto['diseno_puerta_6'];?>" />
			<input type="hidden" id="diseno_puerta_7" name="diseno_puerta_7" value="<?php echo $proyecto['diseno_puerta_7'];?>" />
			<input type="hidden" id="diseno_puerta_8" name="diseno_puerta_8" value="<?php echo $proyecto['diseno_puerta_8'];?>" />
			<input type="hidden" id="ceramica_puerta_1" name="ceramica_puerta_1" value="<?php echo $proyecto['ceramica_puerta_1'];?>" />
			<input type="hidden" id="ceramica_puerta_2" name="ceramica_puerta_2" value="<?php echo $proyecto['ceramica_puerta_2'];?>" />
			<input type="hidden" id="ceramica_puerta_3" name="ceramica_puerta_3" value="<?php echo $proyecto['ceramica_puerta_3'];?>" />
			<input type="hidden" id="ceramica_puerta_4" name="ceramica_puerta_4" value="<?php echo $proyecto['ceramica_puerta_4'];?>" />
			<input type="hidden" id="ceramica_puerta_5" name="ceramica_puerta_5" value="<?php echo $proyecto['ceramica_puerta_5'];?>" />
			<input type="hidden" id="ceramica_puerta_6" name="ceramica_puerta_6" value="<?php echo $proyecto['ceramica_puerta_6'];?>" />
			<input type="hidden" id="ceramica_puerta_7" name="ceramica_puerta_7" value="<?php echo $proyecto['ceramica_puerta_7'];?>" />
			<input type="hidden" id="ceramica_puerta_8" name="ceramica_puerta_8" value="<?php echo $proyecto['ceramica_puerta_8'];?>" />
			<input type="hidden" id="colores_puerta_1" name="colores_puerta_1" value="<?php echo $proyecto['colores_puerta_1'];?>" />
			<input type="hidden" id="colores_puerta_2" name="colores_puerta_2" value="<?php echo $proyecto['colores_puerta_2'];?>" />
			<input type="hidden" id="colores_puerta_3" name="colores_puerta_3" value="<?php echo $proyecto['colores_puerta_3'];?>" />
			<input type="hidden" id="colores_puerta_4" name="colores_puerta_4" value="<?php echo $proyecto['colores_puerta_4'];?>" />
			<input type="hidden" id="colores_puerta_5" name="colores_puerta_5" value="<?php echo $proyecto['colores_puerta_5'];?>" />
			<input type="hidden" id="colores_puerta_6" name="colores_puerta_6" value="<?php echo $proyecto['colores_puerta_6'];?>" />
			<input type="hidden" id="colores_puerta_7" name="colores_puerta_7" value="<?php echo $proyecto['colores_puerta_7'];?>" />
			<input type="hidden" id="colores_puerta_8" name="colores_puerta_8" value="<?php echo $proyecto['colores_puerta_8'];?>" />
			<input type="hidden" id="modulos_interior" name="modulos_interior" value="<?php echo $proyecto['num_modulos_interior'];?>" />
			<input type="hidden" id="interior_puerta_1" name="interior_puerta_1" value="<?php echo $proyecto['interior_puerta_1'];?>" />
			<input type="hidden" id="interior_puerta_2" name="interior_puerta_2" value="<?php echo $proyecto['interior_puerta_2'];?>" />
			<input type="hidden" id="interior_puerta_3" name="interior_puerta_3" value="<?php echo $proyecto['interior_puerta_3'];?>" />
			<input type="hidden" id="interior_puerta_4" name="interior_puerta_4" value="<?php echo $proyecto['interior_puerta_4'];?>" />
			<input type="hidden" id="interior_puerta_5" name="interior_puerta_5" value="<?php echo $proyecto['interior_puerta_5'];?>" />
			<input type="hidden" id="interior_puerta_6" name="interior_puerta_6" value="<?php echo $proyecto['interior_puerta_6'];?>" />
			<input type="hidden" id="interior_puerta_7" name="interior_puerta_7" value="<?php echo $proyecto['interior_puerta_7'];?>" />
			<input type="hidden" id="interior_puerta_8" name="interior_puerta_8" value="<?php echo $proyecto['interior_puerta_8'];?>" />
			<input type="hidden" id="laterales_seleccionado" name="laterales_seleccionado" value="<?php echo $proyecto['laterales_seleccionado'];?>" />
			<input type="hidden" id="tapetas_seleccionado" name="tapetas_seleccionado" value="<?php echo $proyecto['tapetas_seleccionado'];?>" />
			<input type="hidden" id="costados_seleccionado" name="costados_seleccionado" value="<?php echo $proyecto['costados_seleccionado'];?>" />
			<input type="hidden" id="fijos_seleccionado" name="fijos_seleccionado" value="<?php echo $proyecto['fijos_seleccionado'];?>" />
			<input type="hidden" id="montaje_frente_seleccionado" name="montaje_frente_seleccionado" value="<?php echo $proyecto['montaje_frente_seleccionado'];?>" />
			<input type="hidden" id="montaje_frente_arjomy_seleccionado" name="montaje_frente_arjomy_seleccionado" value="<?php echo $proyecto['montaje_frente_arjomy_seleccionado'];?>" />
			<input type="hidden" id="montaje_interior_seleccionado" name="montaje_interior_seleccionado" value="<?php echo $proyecto['montaje_interior_seleccionado'];?>" />
			<input type="hidden" id="montaje_interior_arjomy_seleccionado" name="montaje_interior_arjomy_seleccionado" value="<?php echo $proyecto['montaje_interior_arjomy_seleccionado'];?>" />
			<input type="hidden" id="desmontaje_frente_seleccionado" name="desmontaje_frente_seleccionado" value="<?php echo $proyecto['desmontaje_frente_seleccionado'];?>" />
			<input type="hidden" id="desmontaje_frente_arjomy_seleccionado" name="desmontaje_frente_arjomy_seleccionado" value="<?php echo $proyecto['desmontaje_frente_arjomy_seleccionado'];?>" />
			<input type="hidden" id="desmontaje_interior_seleccionado" name="desmontaje_interior_seleccionado" value="<?php echo $proyecto['desmontaje_interior_seleccionado'];?>" />
			<input type="hidden" id="desmontaje_interior_arjomy_seleccionado" name="desmontaje_interior_arjomy_seleccionado" value="<?php echo $proyecto['desmontaje_interior_arjomy_seleccionado'];?>" />
			<input type="hidden" id="juego_led_seleccionado" name="juego_led_seleccionado" value="<?php echo $proyecto['juego_led_seleccionado'];?>" />
			<input type="hidden" id="juego_led_arjomy_seleccionado" name="juego_led_arjomy_seleccionado" value="<?php echo $proyecto['juego_led_arjomy_seleccionado'];?>" />
			<input type="hidden" id="rematar_frente_seleccionado" name="remate_frente_seleccionado" value="<?php echo $proyecto['rematar_frente_seleccionado'];?>" />
			<input type="hidden" id="rematar_frente_arjomy_seleccionado" name="remate_frente_arjomy_seleccionado" value="<?php echo $proyecto['rematar_frente_arjomy_seleccionado'];?>" />
			<input type="hidden" id="rematar_interior_seleccionado" name="remate_interior_seleccionado" value="<?php echo $proyecto['rematar_interior_seleccionado'];?>" />
			<input type="hidden" id="sistema_frenos_seleccionado" name="sistema_frenos_seleccionado" value="<?php echo $proyecto['sistema_frenos_seleccionado'];?>" />
			<input type="hidden" id="regleta_led_seleccionado" name="regleta_led_seleccionado" value="<?php echo $proyecto['regleta_led_seleccionado'];?>" />
			<input type="hidden" id="frente_abuardillado_seleccionado" name="frente_abuardillado_seleccionado" value="<?php echo $proyecto['frente_abuardillado_seleccionado'];?>" />
			<input type="hidden" id="albanileria_con_seleccionado" name="albanileria_con_seleccionado" value="<?php echo $proyecto['albanileria_con_seleccionado'];?>" />
			<input type="hidden" id="albanileria_sin_seleccionado" name="albanileria_sin_seleccionado" value="<?php echo $proyecto['albanileria_sin_seleccionado'];?>" />
			<input type="hidden" id="precio_frente" name="precio_frente" value="<?php echo $proyecto['precio_frente'];?>" />
			<input type="hidden" id="inc_desc_frente" name="inc_desc_frente" value="<?php echo $proyecto['inc_desc_frente'];?>" />
			<input type="hidden" id="cant_inc_desc_frente" name="cant_inc_desc_frente" value="<?php echo $proyecto['cant_inc_desc_frente'];?>" />
			<input type="hidden" id="precio_ceramica" name="precio_ceramica" value="<?php echo $proyecto['precio_ceramica'];?>" />
			<input type="hidden" id="precio_modulos_interior" name="precio_modulos_interior" value="<?php echo $proyecto['precio_modulos_interior'];?>" />
			<input type="hidden" id="precio_accesorios_interior" name="precio_accesorios_interior" value="<?php echo $proyecto['precio_accesorios_interior'];?>" />
			<input type="hidden" id="inc_desc_interior" name="inc_desc_interior" value="<?php echo $proyecto['inc_desc_interior'];?>" />
			<input type="hidden" id="cant_inc_desc_interior" name="cant_inc_desc_interior" value="<?php echo $proyecto['cant_inc_desc_interior'];?>" />
			<input type="hidden" id="precio_tapetas" name="precio_tapetas" value="<?php echo $proyecto['precio_tapetas'];?>" />
			<input type="hidden" id="precio_laterales" name="precio_laterales" value="<?php echo $proyecto['precio_laterales'];?>" />
			<input type="hidden" id="precio_costados" name="precio_costados" value="<?php echo $proyecto['precio_costados'];?>" />
			<input type="hidden" id="precio_costados_dist" name="precio_costados_dist" value="<?php echo $proyecto['precio_costados_dist'];?>" />
			<input type="hidden" id="precio_fijos" name="precio_fijos" value="<?php echo $proyecto['precio_fijos'];?>" />
			<input type="hidden" id="precio_fijos_dist" name="precio_fijos_dist" value="<?php echo $proyecto['precio_fijos_dist'];?>" />
			<input type="hidden" id="precio_montaje_frente" name="precio_montaje_frente" value="<?php echo $proyecto['precio_montaje_frente'];?>" />
			<input type="hidden" id="precio_montaje_frente_dist" name="precio_montaje_frente_dist" value="<?php echo $proyecto['precio_montaje_frente_dist'];?>" />
			<input type="hidden" id="precio_montaje_interior" name="precio_montaje_interior" value="<?php echo $proyecto['precio_montaje_interior'];?>" />
			<input type="hidden" id="precio_montaje_interior_dist" name="precio_montaje_interior_dist" value="<?php echo $proyecto['precio_montaje_interior_dist'];?>" />
			<input type="hidden" id="precio_desmontaje_frente" name="precio_desmontaje_frente" value="<?php echo $proyecto['precio_desmontaje_frente'];?>" />
			<input type="hidden" id="precio_desmontaje_frente_dist" name="precio_desmontaje_frente_dist" value="<?php echo $proyecto['precio_desmontaje_frente_dist'];?>" />
			<input type="hidden" id="precio_desmontaje_interior" name="precio_desmontaje_interior" value="<?php echo $proyecto['precio_desmontaje_interior'];?>" />
			<input type="hidden" id="precio_desmontaje_interior_dist" name="precio_desmontaje_interior_dist" value="<?php echo $proyecto['precio_desmontaje_interior_dist'];?>" />
			<input type="hidden" id="precio_juego_led" name="precio_juego_led" value="<?php echo $proyecto['precio_juego_led'];?>" />
			<input type="hidden" id="precio_juego_led_dist" name="precio_juego_led_dist" value="<?php echo $proyecto['precio_juego_led_dist'];?>" />
			<input type="hidden" id="precio_rematar_frente" name="precio_rematar_frente" value="<?php echo $proyecto['precio_rematar_frente'];?>" />
			<input type="hidden" id="precio_rematar_frente_dist" name="precio_rematar_frente_dist" value="<?php echo $proyecto['precio_rematar_frente_dist'];?>" />
			<input type="hidden" id="precio_rematar_interior" name="precio_rematar_interior" value="<?php echo $proyecto['precio_rematar_interior'];?>" />
			<input type="hidden" id="precio_sistema_frenos" name="precio_sistema_frenos" value="<?php echo $proyecto['precio_sistema_frenos'];?>" />
			<input type="hidden" id="precio_sistema_frenos_dist" name="precio_sistema_frenos_dist" value="<?php echo $proyecto['precio_sistema_frenos_dist'];?>" />
			<input type="hidden" id="precio_regleta_led" name="precio_regleta_led" value="<?php echo $proyecto['precio_regleta_led'];?>" />
			<input type="hidden" id="precio_frente_abuardillado" name="precio_frente_abuardillado" value="<?php echo $proyecto['precio_frente_abuardillado'];?>" />
			<input type="hidden" id="precio_albanileria_con" name="precio_albanileria_con" value="<?php echo $proyecto['precio_albanileria_con'];?>" />
			<input type="hidden" id="precio_albanileria_sin" name="precio_albanileria_sin" value="<?php echo $proyecto['precio_albanileria_sin'];?>" />
			<input type="hidden" id="aplicar_descuento" name="aplicar_descuento" value="<?php echo $proyecto['aplicar_descuento'];?>" />
			<input type="hidden" id="descuento_cliente" name="descuento_cliente" value="<?php echo $proyecto['descuento_cliente'];?>" />
			<input type="hidden" id="iva" name="iva" value="<?php echo $proyecto['iva'];?>" />
			<input type="hidden" id="precio_total" name="precio_total" value="<?php echo $proyecto['precio_total'];?>" />
			<input type="hidden" id="observaciones_proyecto" name="observaciones_proyecto" value="<?php echo $proyecto['observaciones'];?>" />
			<input type="hidden" id="nombre_cliente" name="nombre_cliente" value="<?php echo $proyecto['nombre_cliente']; ?>" />
			<input type="hidden" id="dni_cliente" name="dni_cliente" value="<?php echo $proyecto['dni_cliente']; ?>" />
			<input type="hidden" id="direccion_cliente" name="direccion_cliente" value="<?php echo $proyecto['direccion_cliente']; ?>" />
			<input type="hidden" id="poblacion_cliente" name="poblacion_cliente" value="<?php echo $proyecto['poblacion_cliente']; ?>" />
			<input type="hidden" id="cp_cliente" name="cp_cliente" value="<?php echo $proyecto['cp_cliente']; ?>" />
			<input type="hidden" id="provincia_cliente" name="provincia_cliente" value="<?php echo $proyecto['provincia_cliente']; ?>" />
			<input type="hidden" id="telefono_cliente" name="telefono_cliente" value="<?php echo $proyecto['telefono_cliente']; ?>" />
			<input type="hidden" id="email_cliente" name="email_cliente" value="<?php echo $proyecto['email_cliente']; ?>" />
			<input type="hidden" id="horario_cliente" name="horario_cliente" value="<?php echo $proyecto['horario_cliente']; ?>" />
		</form>
		<div class="contenedor_proyecto">
			<div class="seccion_proyecto">
				<div class="contenedor_seccion_serie"></div>
				<div class="contenedor_seccion_acabado"></div>
				<div class="contenedor_seccion_perfileria"></div>
				<div class="contenedor_seccion_medidas"></div>
				<div class="contenedor_seccion_puertas"></div>
				<div class="contenedor_seccion_diseno"></div>
				<div class="contenedor_seccion_colores"></div>
				<div class="contenedor_seccion_interior"></div>
				<div class="contenedor_seccion_extras"></div>
				<div class="contenedor_seccion_finalizar"></div>
				<div class="datos_cliente mfp-hide">
					<h1>
						Datos del cliente
					</h1>
					<div class="contenedor_datos_cliente">
						<form id="form_datos_cliente" name="form_datos_cliente" enctype="multipart/form-data" method="POST" onSubmit="return envio();">
							<div class="item_datos_cliente"><div class="label"><label>Nombre:</label></div><div class="input"><input type="text" id="nombre" name="nombre" value="<?php echo $proyecto['nombre_cliente'];?>" /></div></div>
							<div class="item_datos_cliente"><div class="label"><label>DNI:</label></div><div class="input"><input class="peq" type="text" id="dni" name="dni" value="<?php echo $proyecto['dni_cliente'];?>" /></div></div>
							<div class="item_datos_cliente"><div class="label"><label>Dirección:</label></div><div class="input"><input type="text" id="direccion" name="direccion" value="<?php echo $proyecto['direccion_cliente'];?>" /></div></div>
							<div class="item_datos_cliente"><div class="label"><label>Población:</label></div><div class="input"><input type="text" id="poblacion" name="poblacion" value="<?php echo $proyecto['poblacion_cliente'];?>" /></div></div>
							<div class="item_datos_cliente"><div class="label"><label>C. Postal:</label></div><div class="input"><input class="peq" type="text" id="cp" name="cp" value="<?php echo $proyecto['cp_cliente'];?>" /></div></div>
							<div class="item_datos_cliente"><div class="label"><label>Provincia:</label></div><div class="input"><input class="peq" type="text" id="provincia" name="provincia" value="<?php echo $proyecto['provincia_cliente'];?>" /></div></div>
							<div class="item_datos_cliente"><div class="label"><label>E-mail:</label></div><div class="input"><input type="text" id="email" name="email" value="<?php echo $proyecto['email_cliente'];?>" /></div></div>
							<div class="item_datos_cliente"><div class="label"><label>Teléfono:</label></div><div class="input"><input class="peq" type="text" id="telefono" name="telefono" value="<?php echo $proyecto['telefono_cliente'];?>" /></div></div>
							<div class="item_datos_cliente"><div class="label"><label>Horario de contacto:</label></div><div class="input"><input type="text" id="horario" name="horario" value="<?php echo $proyecto['horario_cliente'];?>" /></div></div>
							<div class="item_datos_cliente botones"><a class="boton verde grande" onClick="envio();"><i class="fa fa-floppy-o"></i> Guardar</a> <a class="boton rojo grande" onClick="$.magnificPopup.close();"><i class="fa fa-window-close-o"></i> Cancelar</a></div>
							<div class="respuesta"></div>
						</form>
					</div>
				</div>
				<div class="botones_navegacion">
					<a class="boton naranja grande boton_volver inactivo" onClick="volver_proyecto(1);"><i class="fa fa-chevron-left"></i> Volver</a> <a class="boton verde grande boton_continuar inactivo" onClick="continuar_proyecto(2);">Continuar <i class="fa fa-chevron-right"></i></a>
				</div>
			</div>
			
			<div class="resumen_proyecto">
			
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">Resumen Actualización</a></li>
						<li><a href="#tabs-2">Datos Iniciales</a></li>
					</ul>
					
					<div id="tabs-1">
						<h2><i class="fa fa-file-text-o"></i>Actualización del Proyecto 'P<?php echo str_pad($id, 6, "0", STR_PAD_LEFT); ?>'</h2>
						<h3>Serie</h3>
						<div class="txt_resumen serie"><?php if($serie){ echo $serie; ?> <a class="ajax-popup-link" href="index.php?seccion=ajax&sub=detalles_serie&id=<?php echo $proyecto['id_serie']; ?>" title="Detalles"><i class="fa fa-info-circle"></i></a><?php }else{ echo "Solo interior"; } ?></div>
						<h3>Acabado</h3>
						<div class="txt_resumen acabado"><?php if($acabado){ echo $acabado; }else{ echo "-"; } ?></div>
						<h3>Color perfilería</h3>
						<div class="txt_resumen perfileria"><?php if($perfileria){ echo $perfileria['nombre']; ?><br /><img src="../www/img/colores/<?php echo $perfileria['imagen']; ?>" title="<?php echo $perfileria['nombre']; ?>"> <?php }else{ echo "-"; } ?></div>
						<h3>Medidas totales</h3>
						<div class="txt_resumen medidas">Alto: <?php echo $proyecto['alto']; ?> cm.<br />Ancho: <?php echo $proyecto['ancho']; ?> cm.<br />Fondo: <?php echo $proyecto['fondo']; ?> cm.</div>
						<h3>Nº Puertas</h3>
						<div class="txt_resumen puertas"><?php echo $proyecto['num_puertas']; ?></div>
						<h3>Diseño puertas</h3>
						<div class="txt_resumen diseno">
						<?php if($serie){	?>
							<?php for($i = 1 ; $i <= $proyecto['num_puertas'] ; $i++){ ?>
								<?php $diseno_puerta = $db->getRow('SELECT d.nombre as diseno, t.nombre as terminacion FROM disenos as d, terminaciones as t WHERE d.id='.${"diseno_puerta_" . $i}[0].' AND t.id='.${"diseno_puerta_" . $i}[1]); ?>
								<div class="item_diseno_puertas">	
									<h5>P<?php echo $i; ?></h5>
									<ul>
										<li><?php echo $diseno_puerta['diseno']; ?></li>
										<li><?php echo $diseno_puerta['terminacion']; ?></li>
										<?php if($diseno_puerta['terminacion'] == 20 || $diseno_puerta['terminacion'] == 21){ ?>
										<?php $ceramica = $db->getVar('SELECT nombre FROM ceramicas WHERE id='.$proyecto['ceramica_puerta_'.$i]); ?>
										<li><?php echo $ceramica; ?></li>
										<?php } ?>
									</ul>
								</div>
							<?php } 
						}else{
						?>
						-
						<?php	
						}
						?>
						</div>
						<h3>Colores</h3>
						<div class="txt_resumen colores">
						<?php if($serie) { ?>
							<?php for($i = 1 ; $i <= $proyecto['num_puertas'] ; $i++){ ?>
								<?php $diseno_puerta = $db->getRow('SELECT d.nombre as diseno, t.nombre as terminacion FROM disenos as d, terminaciones as t WHERE d.id='.${"diseno_puerta_" . $i}[0].' AND t.id='.${"diseno_puerta_" . $i}[1]); ?>
								<div class="item_diseno_puertas">
										<?php $zonas_puerta = $db->getResults('SELECT pz.zona as zona, pz.id_colores_tipo as id_colores_tipo, ct.nombre as tipo FROM puertas_zonas as pz, disenos_puertas as dp, colores_tipo as ct WHERE pz.id_disenos_puertas = dp.id AND pz.id_colores_tipo = ct.id AND dp.id_acabados = '.$proyecto['id_acabado'].' AND dp.id_disenos = '.${"diseno_puerta_" . $i}[0].' AND dp.id_terminaciones = '.${"diseno_puerta_" . $i}[1].' AND dp.id_puertas = '.${"diseno_puerta_" . $i}[2].' ORDER BY pz.zona'); ?>
										<h5>P<?php echo $i; ?></h5>
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
										
										foreach($zonas_puerta as $index=>$zona_puerta){ 
											// Comprobamos si hay más del mismo tipo para ponerle el número detrás o no
											$hay_mas = false; 
											if(isset($zonas_puerta[$index+1]['id_colores_tipo']) && $zona_puerta['id_colores_tipo'] == $zonas_puerta[$index+1]['id_colores_tipo']){
												$hay_mas = true;
											}
											
											${'contador_'.$zona_puerta['id_colores_tipo']}++; // Aumentamos el contador de ese tipo
											
											$nombre_zona = (${'contador_'.$zona_puerta['id_colores_tipo']} > 1 || $hay_mas) ? $zona_puerta['tipo']." ".${'contador_'.$zona_puerta['id_colores_tipo']} : $zona_puerta['tipo'];
										
											// SE OBTIENEN LOS DATOS CORRESPONDIENTES
											$nombre_color_zona = "";
											$imagen_color_zona = "";
											if(isset(${"colores_puerta_" . $i}[$index]) && ${"colores_puerta_" . $i}[$index] > 0){
												$color_zona = $db->getRow('SELECT nombre, imagen FROM colores WHERE id = '.${"colores_puerta_" . $i}[$index]);
												$nombre_color_zona = $color_zona['nombre'];
												$imagen_color_zona = $color_zona['imagen'];
											}
										?>
										<ul>
											<li>
											<?php echo $nombre_zona; ?><br />
											<?php echo $nombre_color_zona; ?><br />
											<img src="../www/img/colores/<?php echo $imagen_color_zona; ?>" />
											</li>
										</ul>
										<?php
										}
										?>
								</div>
							<?php } 
						}else{
						?>
						-
						<?php	
						}
						?>
						</div>
						<h3>Interior</h3>
						<div class="txt_resumen interior">
						<?php
							if($proyecto['num_modulos_interior'] > 0){
								$modulos_dobles = $proyecto['num_puertas'] - $proyecto['num_modulos_interior'];
								$modulos_simples = $proyecto['num_modulos_interior'] - $modulos_dobles;
							?>	
															
								<?php
								$num_modulo = 0;
								for($j=1; $j<=$modulos_dobles; $j++){
									$num_modulo++;
									
									$color_interior = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[7]);
									$color_cantoneras = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[8]);
								?>
								<div class="item_fila_proyecto_datos_interior">
								
									<h5>M<?php echo $num_modulo; ?> (Doble)</h5>
									<ul>
										<li>Módulo <?php echo ${'interior_puerta_'.$num_modulo}[1]; ?></li>
										<?php if(${'interior_puerta_'.$num_modulo}[2] > 0){ ?><li>Zapatero/s con freno</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[3] > 0){ ?><li>Cajon/es con freno</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[4] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[4]; ?> x J. celdillas</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[5] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[5]; ?> x Frente cristal</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[6] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[6]; ?> x Cerradura</li><?php } ?>
										<li>Color<br /><?php echo $color_interior['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="../www/img/colores/<?php echo $color_interior['imagen']; ?>" title="<?php echo $color_interior['nombre']; ?>" /></li>
										<li>Cantoneras<br /><?php echo $color_cantoneras['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="../www/img/colores/<?php echo $color_cantoneras['imagen']; ?>" title="<?php echo $color_cantoneras['nombre']; ?>" /></li>
									</ul>
								</div>
								<?php
								}
								for($j=1; $j<=$modulos_simples; $j++){
									$num_modulo++;
									
									$color_interior = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[7]);
									$color_cantoneras = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[8]);
								?>
								<div class="item_fila_proyecto_datos_interior">
									<h5>M<?php echo $num_modulo; ?> (Simple)</h5>
									<ul>
										<li>Módulo <?php echo ${'interior_puerta_'.$num_modulo}[1]; ?></li>
										<?php if(${'interior_puerta_'.$num_modulo}[2] > 0){ ?><li>Zapatero/s con freno</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[3] > 0){ ?><li>Cajon/es con freno</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[4] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[4]; ?> x J. celdillas</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[5] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[5]; ?> x Frente cristal</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[6] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[6]; ?> x Cerradura</li><?php } ?>
										<li>Color<br /><?php echo $color_interior['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="../www/img/colores/<?php echo $color_interior['imagen']; ?>" title="<?php echo $color_interior['nombre']; ?>" /></li>
										<li>Cantoneras<br /><?php echo $color_cantoneras['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="../www/img/colores/<?php echo $color_cantoneras['imagen']; ?>" title="<?php echo $color_cantoneras['nombre']; ?>" /></li>
									</ul>
								</div>
								<?php
								}
								?>
							<?php
							}else{
							?>
							-
							<?php	
							}
							?>
						</div>
						<h3>Extras</h3>
						<div class="txt_resumen extras">
						<?php 
							if($proyecto['sistema_frenos_seleccionado'] > 0 || $proyecto['tapetas_seleccionado'] > 0 || $proyecto['laterales_seleccionado'] > 0 || $proyecto['costados_seleccionado'] > 0 || $proyecto['fijos_seleccionado'] > 0 || $proyecto['montaje_frente_seleccionado'] > 0 || $proyecto['rematar_frente_seleccionado'] > 0 || $proyecto['juego_led_seleccionado'] > 0 || $proyecto['montaje_interior_seleccionado'] > 0 || $proyecto['desmontaje_frente_seleccionado'] > 0 || $proyecto['desmontaje_interior_seleccionado'] > 0 || $proyecto['albanileria_con_seleccionado'] > 0 || $proyecto['albanileria_sin_seleccionado'] > 0){
							?>
								<?php 
								if($proyecto['sistema_frenos_seleccionado'] > 0 || $proyecto['tapetas_seleccionado'] > 0 || $proyecto['laterales_seleccionado'] > 0 || $proyecto['costados_seleccionado'] > 0 || $proyecto['fijos_seleccionado'] > 0 || $proyecto['regleta_led_seleccionado'] > 0 || $proyecto['frente_abuardillado_seleccionado'] > 0 || $proyecto['montaje_frente_seleccionado'] > 0 || $proyecto['rematar_frente_seleccionado'] > 0){
								?>

								<?php if($proyecto['tapetas_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $tapetas = $db->getVar('SELECT nombre FROM tapetas WHERE id='.$proyecto['tapetas_seleccionado']); ?>
									 Juego de <?php echo $tapetas; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['laterales_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $laterales = $db->getVar('SELECT nombre FROM laterales WHERE id='.$proyecto['laterales_seleccionado']); ?>
									 Juego de <?php echo $laterales; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['sistema_frenos_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Sistema de frenos para puertas
								</div>
								<?php } ?>
								<?php if($proyecto['costados_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $costados = $db->getVar('SELECT nombre FROM costados WHERE id='.$proyecto['costados_seleccionado']); ?>
									 <?php echo $costados; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['fijos_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $costados = $db->getVar('SELECT nombre FROM fijos WHERE id='.$proyecto['fijos_seleccionado']); ?>
									 Fijos en  <?php echo $costados; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['regleta_led_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Regletas led para puertas
								</div>
								<?php } ?>
								<?php if($proyecto['frente_abuardillado_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Frente abuardillado
								</div>
								<?php } ?>
								<?php if($proyecto['montaje_frente_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Montaje de frente de <?php echo $proyecto['montaje_frente_seleccionado']; ?> hojas
								</div>
								<?php } ?>
								<?php if($proyecto['rematar_frente_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Remate de frente
								</div>
								<?php } ?>
								<?php } ?>
								<?php
								if($proyecto['juego_led_seleccionado'] > 0 || $proyecto['montaje_interior_seleccionado'] > 0 || $proyecto['rematar_interior_seleccionado'] > 0){
								?>

								<?php if($proyecto['juego_led_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Juego de led interior
								</div>
								<?php } ?>
								<?php if($proyecto['montaje_interior_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Montaje de interior de <?php echo $proyecto['montaje_interior_seleccionado']; ?> módulos
								</div>
								<?php } ?>
								<?php if($proyecto['rematar_interior_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Remate de interior
								</div>
								<?php } ?>
								<?php } ?>
								<?php
								if($proyecto['desmontaje_frente_seleccionado'] > 0 || $proyecto['desmontaje_interior_seleccionado'] > 0 || $proyecto['albanileria_con_seleccionado'] > 0 || $proyecto['albanileria_sin_seleccionado'] > 0){
								?>

								<?php if($proyecto['desmontaje_frente_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $desm_frente = $db->getVar('SELECT nombre FROM desmontajes_frentes WHERE id='.$proyecto['desmontaje_frente_seleccionado']); ?>
									 Desmontaje de frente de <?php echo $desm_frente; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['desmontaje_interior_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $desm_interior = $db->getVar('SELECT nombre FROM desmontajes_interiores WHERE id='.$proyecto['desmontaje_interior_seleccionado']); ?>
									 Desmontaje de interior de <?php echo $desm_interior; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['albanileria_con_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Albañilería con solera
								</div>
								<?php } ?>
								<?php if($proyecto['albanileria_sin_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Albañilería sin solera
								</div>
								<?php } ?>
								<?php } ?>
							<?php } else { ?>
							-
							<?php
							} 
							?>
						</div>
						<h3>Precio</h3>
						<div class="txt_resumen precio">
							<div class="item_fila_proyecto_precio">
								Precio frente: <span><?php echo number_format($proyecto['precio_frente'],2,".",""); ?>€</span><br />
								<?php if($proyecto['inc_desc_frente'] != ""){ ?>
								<?php echo $proyecto['inc_desc_frente']; ?>: <span><?php echo number_format($proyecto['cant_inc_desc_frente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_modulos_interior'] > 0){ ?>
								Precio interior: <span><?php echo number_format($proyecto['precio_modulos_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['inc_desc_interior'] != ""){ ?>
								<?php echo $proyecto['inc_desc_interior']; ?>: <span><?php echo number_format($proyecto['cant_inc_desc_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_tapetas'] > 0){ ?>
								Precio tapetas: <span><?php echo number_format($proyecto['precio_tapetas'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_laterales'] > 0){ ?>
								Precio laterales: <span><?php echo number_format($proyecto['precio_laterales'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_ceramica'] > 0){ ?>
								Precio cerámica: <span><?php echo number_format($proyecto['precio_ceramica'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_accesorios_interior'] > 0){ ?>
								Precio accesorios: <span><?php echo number_format($proyecto['precio_accesorios_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_sistema_frenos'] > 0){ ?>
								Precio sistema frenos: <span><?php echo number_format($proyecto['precio_sistema_frenos'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_regleta_led'] > 0){ ?>
								Precio regletas led: <span><?php echo number_format($proyecto['precio_regleta_led'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_frente_abuardillado'] > 0){ ?>
								Precio frente abuardillado: <span><?php echo number_format($proyecto['precio_frente_abuardillado'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_costados'] > 0){ ?>
								Precio costados: <span><?php echo number_format($proyecto['precio_costados'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_fijos'] > 0){ ?>
								Precio fijos: <span><?php echo number_format($proyecto['precio_fijos'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['montaje_frente_seleccionado'] > 0){ ?>
								Precio montaje frente: <span><?php echo number_format($proyecto['precio_montaje_frente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['rematar_frente_seleccionado'] > 0){ ?>
								Precio remate frente: <span><?php echo number_format($proyecto['precio_rematar_frente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['juego_led_seleccionado'] > 0){ ?>
								Precio juego led: <span><?php echo number_format($proyecto['precio_juego_led'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['rematar_interior_seleccionado'] > 0){ ?>
								Precio remate interior: <span><?php echo number_format($proyecto['precio_rematar_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								Precio montaje: <span><?php echo number_format($proyecto['precio_montaje_frente'],2,".",""); ?>€</span><br />
								<?php if($proyecto['montaje_interior_seleccionado'] > 0){ ?>
								Precio montaje interior: <span><?php echo number_format($proyecto['precio_montaje_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['desmontaje_frente_seleccionado'] > 0){ ?>
								Precio desmontaje frente: <span><?php echo number_format($proyecto['precio_desmontaje_frente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['desmontaje_interior_seleccionado'] > 0){ ?>
								Precio desmontaje interior: <span><?php echo number_format($proyecto['precio_desmontaje_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['albanileria_con_seleccionado'] > 0){ ?>
								Albañilería con solera: <span><?php echo number_format($proyecto['precio_albanileria_con'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['albanileria_sin_seleccionado'] > 0){ ?>
								Albañilería sin solera: <span><?php echo number_format($proyecto['precio_albanileria_sin'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['aplicar_descuento'] > 0){ ?>
								Descuento del <?php echo $proyecto['aplicar_descuento']; ?>%: <span>-<?php echo number_format($proyecto['descuento_cliente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php echo $proyecto['porcentaje_iva']; ?>% I.V.A.: <span><?php echo number_format($proyecto['iva'],2,".",""); ?>€</span><br />
								<b>PRECIO TOTAL: <span><?php echo number_format($proyecto['precio_total'],2,".",""); ?>€</span></b>
							</div>
						</div>
						<div style="margin-top:20px;margin-bottom: 5px;" class="referencia_proyecto">
						<?php 
							$precio_distribuidor = ($proyecto['precio_frente'] + $proyecto['cant_inc_desc_frente'] + $proyecto['precio_modulos_interior'] + $proyecto['cant_inc_desc_interior'] + $proyecto['precio_accesorios_interior'] + $proyecto['precio_costados'] + $proyecto['precio_fijos'] + $proyecto['precio_juego_led'] + $proyecto['precio_rematar_frente'] + $proyecto['precio_rematar_interior'] + $proyecto['precio_sistema_frenos'] + $proyecto['precio_regleta_led'] + $proyecto['precio_frente_abuardillado'])/1.35;
							$precio_distribuidor_iva = round($precio_distribuidor + $precio_distribuidor * $proyecto['porcentaje_iva'] / 100, 2);
							echo str_pad($proyecto['id_tarifa'], 2, "0", STR_PAD_LEFT)."-".str_pad(number_format($precio_distribuidor_iva,2,".",""), 10, "0", STR_PAD_BOTH); 
							echo "<br />";
							// PRECIO DISTRIBUIDOR 2
							$precio_distribuidor_2 = $proyecto['precio_desmontaje_frente'] + $proyecto['precio_desmontaje_interior'] + $proyecto['precio_montaje_frente'] + $proyecto['precio_albanileria_con'] + $proyecto['precio_albanileria_sin'];
							echo str_pad("2", 2, "0", STR_PAD_LEFT)."-".str_pad(number_format($precio_distribuidor_2 + $precio_distribuidor_2 * $proyecto['porcentaje_iva'] / 100,2,".",""), 10, "0", STR_PAD_BOTH);
						?>
						</div>
					</div>
					
					<div id="tabs-2">
						<h2><i class="fa fa-file-text-o"></i>Datos Iniciales del Proyecto 'P<?php echo str_pad($id, 6, "0", STR_PAD_LEFT); ?>'</h2>
						<h3>Serie</h3>
						<div class="txt_resumen_inicial serie"><?php if($serie){ echo $serie; ?> <a class="ajax-popup-link" href="index.php?seccion=ajax&sub=detalles_serie&id=<?php echo $proyecto['id_serie']; ?>" title="Detalles"><i class="fa fa-info-circle"></i></a><?php }else{ echo "Solo interior"; } ?></div>
						<h3>Acabado</h3>
						<div class="txt_resumen_inicial acabado"><?php if($acabado){ echo $acabado; }else{ echo "-"; } ?></div>
						<h3>Color perfilería</h3>
						<div class="txt_resumen_inicial perfileria"><?php if($perfileria){ echo $perfileria['nombre']; ?><br /><img src="../www/img/colores/<?php echo $perfileria['imagen']; ?>" title="<?php echo $perfileria['nombre']; ?>"> <?php }else{ echo "-"; } ?></div>
						<h3>Medidas totales</h3>
						<div class="txt_resumen_inicial medidas">Alto: <?php echo $proyecto['alto']; ?> cm.<br />Ancho: <?php echo $proyecto['ancho']; ?> cm.<br />Fondo: <?php echo $proyecto['fondo']; ?> cm.</div>
						<h3>Nº Puertas</h3>
						<div class="txt_resumen_inicial puertas"><?php echo $proyecto['num_puertas']; ?></div>
						<h3>Diseño puertas</h3>
						<div class="txt_resumen_inicial diseno">
						<?php if($serie){	?>
							<?php for($i = 1 ; $i <= $proyecto['num_puertas'] ; $i++){ ?>
								<?php $diseno_puerta = $db->getRow('SELECT d.nombre as diseno, t.nombre as terminacion FROM disenos as d, terminaciones as t WHERE d.id='.${"diseno_puerta_" . $i}[0].' AND t.id='.${"diseno_puerta_" . $i}[1]); ?>
								<div class="item_diseno_puertas">	
									<h5>P<?php echo $i; ?></h5>
									<?php $img_puerta = $db->getVar('SELECT imagen FROM puertas WHERE id='.${"diseno_puerta_" . $i}[2]);?>
									<img id="frente_puerta-diseno-<?php echo $i; ?>" style="height: 160px;margin: 3px auto;text-align: center;" src="../www/img/disenos/<?php echo $proyecto['id_serie']; ?>/<?php echo $proyecto['id_acabado']; ?>/<?php echo ${"diseno_puerta_" . $i}[0]; ?>/<?php echo ${"diseno_puerta_" . $i}[1]; ?>/<?php echo $img_puerta; ?> " />
									<ul>
										<li><?php echo $diseno_puerta['diseno']; ?></li>
										<li><?php echo $diseno_puerta['terminacion']; ?></li>
										<?php if($diseno_puerta['terminacion'] == 20 || $diseno_puerta['terminacion'] == 21){ ?>
										<?php $ceramica = $db->getVar('SELECT nombre FROM ceramicas WHERE id='.$proyecto['ceramica_puerta_'.$i]); ?>
										<li><?php echo $ceramica; ?></li>
										<?php } ?>
									</ul>
								</div>
							<?php } 
						}else{
						?>
						-
						<?php	
						}
						?>
						</div>
						<h3>Colores</h3>
						<div class="txt_resumen_inicial colores">
						<?php if($serie) { ?>
							<?php for($i = 1 ; $i <= $proyecto['num_puertas'] ; $i++){ ?>
								<?php $diseno_puerta = $db->getRow('SELECT d.nombre as diseno, t.nombre as terminacion FROM disenos as d, terminaciones as t WHERE d.id='.${"diseno_puerta_" . $i}[0].' AND t.id='.${"diseno_puerta_" . $i}[1]); ?>
								<div class="item_diseno_puertas">
										<?php $zonas_puerta = $db->getResults('SELECT pz.zona as zona, pz.id_colores_tipo as id_colores_tipo, ct.nombre as tipo FROM puertas_zonas as pz, disenos_puertas as dp, colores_tipo as ct WHERE pz.id_disenos_puertas = dp.id AND pz.id_colores_tipo = ct.id AND dp.id_acabados = '.$proyecto['id_acabado'].' AND dp.id_disenos = '.${"diseno_puerta_" . $i}[0].' AND dp.id_terminaciones = '.${"diseno_puerta_" . $i}[1].' AND dp.id_puertas = '.${"diseno_puerta_" . $i}[2].' ORDER BY pz.zona'); ?>
										<h5>P<?php echo $i; ?></h5>
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
										
										foreach($zonas_puerta as $index=>$zona_puerta){ 
											// Comprobamos si hay más del mismo tipo para ponerle el número detrás o no
											$hay_mas = false; 
											if(isset($zonas_puerta[$index+1]['id_colores_tipo']) && $zona_puerta['id_colores_tipo'] == $zonas_puerta[$index+1]['id_colores_tipo']){
												$hay_mas = true;
											}
											
											${'contador_'.$zona_puerta['id_colores_tipo']}++; // Aumentamos el contador de ese tipo
											
											$nombre_zona = (${'contador_'.$zona_puerta['id_colores_tipo']} > 1 || $hay_mas) ? $zona_puerta['tipo']." ".${'contador_'.$zona_puerta['id_colores_tipo']} : $zona_puerta['tipo'];
										
											// SE OBTIENEN LOS DATOS CORRESPONDIENTES
											$nombre_color_zona = "";
											$imagen_color_zona = "";
											if(isset(${"colores_puerta_" . $i}[$index]) && ${"colores_puerta_" . $i}[$index] > 0){
												$color_zona = $db->getRow('SELECT nombre, imagen FROM colores WHERE id = '.${"colores_puerta_" . $i}[$index]);
												$nombre_color_zona = $color_zona['nombre'];
												$imagen_color_zona = $color_zona['imagen'];
											}
										?>
										<ul>
											<li>
											<?php echo $nombre_zona; ?><br />
											<?php echo $nombre_color_zona; ?><br />
											<img src="../www/img/colores/<?php echo $imagen_color_zona; ?>" />
											</li>
										</ul>
										<?php
										}
										?>
								</div>
							<?php } 
						}else{
						?>
						-
						<?php	
						}
						?>
						</div>
						<h3>Interior</h3>

						<div class="txt_resumen_inicial interior">
						<?php
							if($proyecto['num_modulos_interior'] > 0){
								$modulos_dobles = $proyecto['num_puertas'] - $proyecto['num_modulos_interior'];
								$modulos_simples = $proyecto['num_modulos_interior'] - $modulos_dobles;
							?>	
															
								<?php
								$num_modulo = 0;
								for($j=1; $j<=$modulos_dobles; $j++){
									$num_modulo++;
									
									$color_interior = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[7]);
									$color_cantoneras = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[8]);
								?>
								<div class="item_fila_proyecto_datos_interior">
								
									<h5>M<?php echo $num_modulo; ?> (Doble)</h5>
									<img id="interior_img_modulo_<?php echo $num_modulo; ?>" style="height: 160px;margin: 3px auto;text-align: center;" src="../www/img/interiores/modulo-<?php echo ${'interior_puerta_'.$num_modulo}[1]; ?>.jpg" />
									<ul>
										<li>Módulo <?php echo ${'interior_puerta_'.$num_modulo}[1]; ?></li>
										<?php if(${'interior_puerta_'.$num_modulo}[2] > 0){ ?><li>Zapatero/s con freno</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[3] > 0){ ?><li>Cajon/es con freno</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[4] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[4]; ?> x J. celdillas</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[5] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[5]; ?> x Frente cristal</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[6] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[6]; ?> x Cerradura</li><?php } ?>
										<li>Color<br /><?php echo $color_interior['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="../www/img/colores/<?php echo $color_interior['imagen']; ?>" title="<?php echo $color_interior['nombre']; ?>" /></li>
										<li>Cantoneras<br /><?php echo $color_cantoneras['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="../www/img/colores/<?php echo $color_cantoneras['imagen']; ?>" title="<?php echo $color_cantoneras['nombre']; ?>" /></li>
									</ul>
								</div>
								<?php
								}
								for($j=1; $j<=$modulos_simples; $j++){
									$num_modulo++;
									
									$color_interior = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[7]);
									$color_cantoneras = $db->getRow('SELECT nombre, imagen FROM colores WHERE id='.${'interior_puerta_'.$num_modulo}[8]);
								?>
								<div class="item_fila_proyecto_datos_interior">
									<h5>M<?php echo $num_modulo; ?> (Simple)</h5>
									<img id="img_modulo_<?php echo $num_modulo; ?>" style="height: 160px;margin: 3px auto;text-align: center;" src="../www/img/interiores/modulo-<?php echo ${'interior_puerta_'.$num_modulo}[1]; ?>.jpg" />
									<ul>
										<li>Módulo <?php echo ${'interior_puerta_'.$num_modulo}[1]; ?></li>
										<?php if(${'interior_puerta_'.$num_modulo}[2] > 0){ ?><li>Zapatero/s con freno</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[3] > 0){ ?><li>Cajon/es con freno</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[4] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[4]; ?> x J. celdillas</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[5] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[5]; ?> x Frente cristal</li><?php } ?>
										<?php if(${'interior_puerta_'.$num_modulo}[6] > 0){ ?><li><?php echo ${'interior_puerta_'.$num_modulo}[6]; ?> x Cerradura</li><?php } ?>
										<li>Color<br /><?php echo $color_interior['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="../www/img/colores/<?php echo $color_interior['imagen']; ?>" title="<?php echo $color_interior['nombre']; ?>" /></li>
										<li>Cantoneras<br /><?php echo $color_cantoneras['nombre']; ?><br />&nbsp;&nbsp;&nbsp;<img src="../www/img/colores/<?php echo $color_cantoneras['imagen']; ?>" title="<?php echo $color_cantoneras['nombre']; ?>" /></li>
									</ul>
								</div>
								<?php
								}
								?>
							<?php
							}else{
							?>
							-
							<?php	
							}
							?>
						</div>
						<h3>Extras</h3>
							<div class="txt_resumen_inicial extras">
							<?php 
							if($proyecto['sistema_frenos_seleccionado'] > 0 || $proyecto['tapetas_seleccionado'] > 0 || $proyecto['laterales_seleccionado'] > 0 || $proyecto['costados_seleccionado'] > 0 || $proyecto['fijos_seleccionado'] > 0 || $proyecto['montaje_frente_seleccionado'] > 0 || $proyecto['rematar_frente_seleccionado'] > 0 || $proyecto['juego_led_seleccionado'] > 0 || $proyecto['montaje_interior_seleccionado'] > 0 || $proyecto['desmontaje_frente_seleccionado'] > 0 || $proyecto['desmontaje_interior_seleccionado'] > 0 || $proyecto['albanileria_con_seleccionado'] > 0 || $proyecto['albanileria_sin_seleccionado'] > 0){
							?>
								<?php 
								if($proyecto['sistema_frenos_seleccionado'] > 0 || $proyecto['tapetas_seleccionado'] > 0 || $proyecto['laterales_seleccionado'] > 0 || $proyecto['costados_seleccionado'] > 0 || $proyecto['fijos_seleccionado'] > 0 || $proyecto['regleta_led_seleccionado'] > 0 || $proyecto['frente_abuardillado_seleccionado'] > 0 || $proyecto['montaje_frente_seleccionado'] > 0 || $proyecto['rematar_frente_seleccionado'] > 0){
								?>

								<?php if($proyecto['tapetas_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $tapetas = $db->getVar('SELECT nombre FROM tapetas WHERE id='.$proyecto['tapetas_seleccionado']); ?>
									 Juego de <?php echo $tapetas; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['laterales_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $laterales = $db->getVar('SELECT nombre FROM laterales WHERE id='.$proyecto['laterales_seleccionado']); ?>
									 Juego de <?php echo $laterales; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['sistema_frenos_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Sistema de frenos para puertas
								</div>
								<?php } ?>
								<?php if($proyecto['costados_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $costados = $db->getVar('SELECT nombre FROM costados WHERE id='.$proyecto['costados_seleccionado']); ?>
									 <?php echo $costados; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['fijos_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $costados = $db->getVar('SELECT nombre FROM fijos WHERE id='.$proyecto['fijos_seleccionado']); ?>
									 Fijos en  <?php echo $costados; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['regleta_led_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Regletas led para puertas
								</div>
								<?php } ?>
								<?php if($proyecto['frente_abuardillado_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Frente abuardillado
								</div>
								<?php } ?>
								<?php if($proyecto['montaje_frente_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Montaje de frente de <?php echo $proyecto['montaje_frente_seleccionado']; ?> hojas
								</div>
								<?php } ?>
								<?php if($proyecto['rematar_frente_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Remate de frente
								</div>
								<?php } ?>
								<?php } ?>
								<?php
								if($proyecto['juego_led_seleccionado'] > 0 || $proyecto['montaje_interior_seleccionado'] > 0 || $proyecto['rematar_interior_seleccionado'] > 0){
								?>

								<?php if($proyecto['juego_led_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Juego de led interior
								</div>
								<?php } ?>
								<?php if($proyecto['montaje_interior_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Montaje de interior de <?php echo $proyecto['montaje_interior_seleccionado']; ?> módulos
								</div>
								<?php } ?>
								<?php if($proyecto['rematar_interior_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Remate de interior
								</div>
								<?php } ?>
								<?php } ?>
								<?php
								if($proyecto['desmontaje_frente_seleccionado'] > 0 || $proyecto['desmontaje_interior_seleccionado'] > 0 || $proyecto['albanileria_con_seleccionado'] > 0 || $proyecto['albanileria_sin_seleccionado'] > 0){
								?>

								<?php if($proyecto['desmontaje_frente_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $desm_frente = $db->getVar('SELECT nombre FROM desmontajes_frentes WHERE id='.$proyecto['desmontaje_frente_seleccionado']); ?>
									 Desmontaje de frente de <?php echo $desm_frente; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['desmontaje_interior_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									<?php $desm_interior = $db->getVar('SELECT nombre FROM desmontajes_interiores WHERE id='.$proyecto['desmontaje_interior_seleccionado']); ?>
									 Desmontaje de interior de <?php echo $desm_interior; ?>
								</div>
								<?php } ?>
								<?php if($proyecto['albanileria_con_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Albañilería con solera
								</div>
								<?php } ?>
								<?php if($proyecto['albanileria_sin_seleccionado'] > 0){ ?>
								<div class="item_resumen_extras">
									 Albañilería sin solera
								</div>
								<?php } ?>
								<?php } ?>
							<?php } else { ?>
							-
							<?php
							} 
							?>
							</div>
						<h3>Precio</h3>
						<div class="txt_resumen_inicial precio">
							<div class="item_fila_proyecto_precio">
								Precio frente: <span><?php echo number_format($proyecto['precio_frente'],2,".",""); ?>€</span><br />
								<?php if($proyecto['inc_desc_frente'] != ""){ ?>
								<?php echo $proyecto['inc_desc_frente']; ?>: <span><?php echo number_format($proyecto['cant_inc_desc_frente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_modulos_interior'] > 0){ ?>
								Precio interior: <span><?php echo number_format($proyecto['precio_modulos_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['inc_desc_interior'] != ""){ ?>
								<?php echo $proyecto['inc_desc_interior']; ?>: <span><?php echo number_format($proyecto['cant_inc_desc_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_tapetas'] > 0){ ?>
								Precio tapetas: <span><?php echo number_format($proyecto['precio_tapetas'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_laterales'] > 0){ ?>
								Precio laterales: <span><?php echo number_format($proyecto['precio_laterales'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_ceramica'] > 0){ ?>
								Precio cerámica: <span><?php echo number_format($proyecto['precio_ceramica'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_accesorios_interior'] > 0){ ?>
								Precio accesorios: <span><?php echo number_format($proyecto['precio_accesorios_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_sistema_frenos'] > 0){ ?>
								Precio sistema frenos: <span><?php echo number_format($proyecto['precio_sistema_frenos'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_regleta_led'] > 0){ ?>
								Precio regletas led: <span><?php echo number_format($proyecto['precio_regleta_led'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_frente_abuardillado'] > 0){ ?>
								Precio frente abuardillado: <span><?php echo number_format($proyecto['precio_frente_abuardillado'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_costados'] > 0){ ?>
								Precio costados: <span><?php echo number_format($proyecto['precio_costados'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['precio_fijos'] > 0){ ?>
								Precio fijos: <span><?php echo number_format($proyecto['precio_fijos'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['montaje_frente_seleccionado'] > 0){ ?>
								Precio montaje frente: <span><?php echo number_format($proyecto['precio_montaje_frente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['rematar_frente_seleccionado'] > 0){ ?>
								Precio remate frente: <span><?php echo number_format($proyecto['precio_rematar_frente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['juego_led_seleccionado'] > 0){ ?>
								Precio juego led: <span><?php echo number_format($proyecto['precio_juego_led'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['rematar_interior_seleccionado'] > 0){ ?>
								Precio remate interior: <span><?php echo number_format($proyecto['precio_rematar_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								Precio montaje: <span><?php echo number_format($proyecto['precio_montaje_frente'],2,".",""); ?>€</span><br />
								<?php if($proyecto['montaje_interior_seleccionado'] > 0){ ?>
								Precio montaje interior: <span><?php echo number_format($proyecto['precio_montaje_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['desmontaje_frente_seleccionado'] > 0){ ?>
								Precio desmontaje frente: <span><?php echo number_format($proyecto['precio_desmontaje_frente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['desmontaje_interior_seleccionado'] > 0){ ?>
								Precio desmontaje interior: <span><?php echo number_format($proyecto['precio_desmontaje_interior'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['albanileria_con_seleccionado'] > 0){ ?>
								Albañilería con solera: <span><?php echo number_format($proyecto['precio_albanileria_con'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['albanileria_sin_seleccionado'] > 0){ ?>
								Albañilería sin solera: <span><?php echo number_format($proyecto['precio_albanileria_sin'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php if($proyecto['aplicar_descuento'] > 0){ ?>
								Descuento del <?php echo $proyecto['aplicar_descuento']; ?>%: <span>-<?php echo number_format($proyecto['descuento_cliente'],2,".",""); ?>€</span><br />
								<?php } ?>
								<?php echo $proyecto['porcentaje_iva']; ?>% I.V.A.: <span><?php echo number_format($proyecto['iva'],2,".",""); ?>€</span><br />
								<b>PRECIO TOTAL: <span><?php echo number_format($proyecto['precio_total'],2,".",""); ?>€</span></b>
							</div>
						</div>
						<div style="margin-top:20px;" class="referencia_inicial_proyecto">
							<?php 
							$precio_distribuidor = ($proyecto['precio_frente'] + $proyecto['cant_inc_desc_frente'] + $proyecto['precio_modulos_interior'] + $proyecto['cant_inc_desc_interior'] + $proyecto['precio_accesorios_interior'] + $proyecto['precio_costados'] + $proyecto['precio_fijos'] + $proyecto['precio_juego_led'] + $proyecto['precio_rematar_frente'] + $proyecto['precio_rematar_interior'] + $proyecto['precio_sistema_frenos'] + $proyecto['precio_regleta_led'] + $proyecto['precio_frente_abuardillado'])/1.35;
							$precio_distribuidor_iva = round($precio_distribuidor + $precio_distribuidor * $proyecto['porcentaje_iva'] / 100, 2);
							echo str_pad($proyecto['id_tarifa'], 2, "0", STR_PAD_LEFT)."-".str_pad(number_format($precio_distribuidor_iva,2,".",""), 10, "0", STR_PAD_BOTH); 
							echo "<br />";
							// PRECIO DISTRIBUIDOR 2
							$precio_distribuidor_2 = $proyecto['precio_desmontaje_frente'] + $proyecto['precio_desmontaje_interior'] + $proyecto['precio_montaje_frente'] + $proyecto['precio_albanileria_con'] + $proyecto['precio_albanileria_sin'];
							echo str_pad("2", 2, "0", STR_PAD_LEFT)."-".str_pad(number_format($precio_distribuidor_2 + $precio_distribuidor_2 * $proyecto['porcentaje_iva'] / 100,2,".",""), 10, "0", STR_PAD_BOTH);
							?>
						</div>
						
						<div class="fila_proyecto">
							<h3>Observaciones</h3>
							<?php
							if($proyecto['observaciones'] != ""){
							?>
								<div class="item_fila_proyecto_otros">
									<p><?php echo nl2br($proyecto['observaciones']); ?></p>
								</div>
							<?php
							}else{
								echo "-";
							}
							?>
						</div>
						<div id="ver_proyecto">
							<div class="vista_proyecto">
								<div style="margin-top: 20px;margin-bottom: 5px;" class="fila_proyecto cliente">
									<h3 style="text-align: center;margin: 5px 0px;"><?php echo $usuario; ?></h3>
									<h3>Cliente</h3>
									<div style="width:100%;" class="item_fila_proyecto">
										<?php echo $proyecto['nombre_cliente']; ?><br />
										<?php echo $proyecto['dni_cliente']; ?><br />
										<?php echo $proyecto['direccion_cliente']; ?><br />
										<?php echo $proyecto['cp_cliente']; ?> - <?php echo $proyecto['poblacion_cliente']; ?><br />
										<?php echo $proyecto['provincia_cliente']; ?><br />
										<i class="fa fa-envelope-o"></i> <?php echo $proyecto['email_cliente']; ?><br />
										<i class="fa fa-phone"></i> <?php echo $proyecto['telefono_cliente']; ?><br />
										<i class="fa fa-clock-o"></i> <?php echo $proyecto['horario_cliente']; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
				<div class="botones_resumen">
					<a class="boton verde grande boton_guardar" onClick=""><i class="fa fa-floppy-o"></i> Actualizar Proyecto</a>
				</div>	
				
				<div class="botones_resumen">
					<a class="boton rojo grande ajax-popup-link-modal" href="index.php?seccion=ajax&sub=confirmar_cancelar_proyecto&id=<?php echo $id;?>"><i class="fa fa-window-close-o"></i> Cancelar Actualizar</a>
				</div>	
			</div>

		</div>
	</div>
</div>
<script type="text/javascript">
	continuar_proyecto(11,11);
</script>
