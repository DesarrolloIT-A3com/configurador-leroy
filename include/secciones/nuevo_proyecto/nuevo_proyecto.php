<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] != "logged")
	die();

$tarifa_descuento = $db->getRow('SELECT tarifa, descuento FROM usuarios WHERE id=' . $_SESSION['id_usuario']);
?>

<div id="proyecto" class="pantalla_completa">
	<div class="contenido">
		<div class="titulo_superior">
			NUEVO PROYECTO
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
			<input type="hidden" id="ac" name="ac" value="guardar_proyecto" />
			<input type="hidden" id="tarifa" name="tarifa" value="<?php echo $tarifa_descuento['tarifa']; ?>" />
			<input type="hidden" id="descuento" name="descuento" value="<?php echo $tarifa_descuento['descuento']; ?>" />
			<input type="hidden" id="serie_marcada" name="serie_marcada" value="" />
			<input type="hidden" id="acabado_marcado" name="acabado_marcado" value="" />
			<input type="hidden" id="perfileria_marcada" name="perfileria_marcada" value="" />
			<input type="hidden" id="medidas_ancho" name="medidas_ancho" value="" />
			<input type="hidden" id="medidas_alto" name="medidas_alto" value="" />
			<input type="hidden" id="medidas_fondo" name="medidas_fondo" value="" />
			<input type="hidden" id="puertas_marcado" name="puertas_marcado" value="" />
			<input type="hidden" id="diseno_puerta_1" name="diseno_puerta_1" value="" />
			<input type="hidden" id="diseno_puerta_2" name="diseno_puerta_2" value="" />
			<input type="hidden" id="diseno_puerta_3" name="diseno_puerta_3" value="" />
			<input type="hidden" id="diseno_puerta_4" name="diseno_puerta_4" value="" />
			<input type="hidden" id="diseno_puerta_5" name="diseno_puerta_5" value="" />
			<input type="hidden" id="diseno_puerta_6" name="diseno_puerta_6" value="" />
			<input type="hidden" id="diseno_puerta_7" name="diseno_puerta_7" value="" />
			<input type="hidden" id="diseno_puerta_8" name="diseno_puerta_8" value="" />
			<input type="hidden" id="ceramica_puerta_1" name="ceramica_puerta_1" value="" />
			<input type="hidden" id="ceramica_puerta_2" name="ceramica_puerta_2" value="" />
			<input type="hidden" id="ceramica_puerta_3" name="ceramica_puerta_3" value="" />
			<input type="hidden" id="ceramica_puerta_4" name="ceramica_puerta_4" value="" />
			<input type="hidden" id="ceramica_puerta_5" name="ceramica_puerta_5" value="" />
			<input type="hidden" id="ceramica_puerta_6" name="ceramica_puerta_6" value="" />
			<input type="hidden" id="ceramica_puerta_7" name="ceramica_puerta_7" value="" />
			<input type="hidden" id="ceramica_puerta_8" name="ceramica_puerta_8" value="" />
			<input type="hidden" id="colores_puerta_1" name="colores_puerta_1" value="" />
			<input type="hidden" id="colores_puerta_2" name="colores_puerta_2" value="" />
			<input type="hidden" id="colores_puerta_3" name="colores_puerta_3" value="" />
			<input type="hidden" id="colores_puerta_4" name="colores_puerta_4" value="" />
			<input type="hidden" id="colores_puerta_5" name="colores_puerta_5" value="" />
			<input type="hidden" id="colores_puerta_6" name="colores_puerta_6" value="" />
			<input type="hidden" id="colores_puerta_7" name="colores_puerta_7" value="" />
			<input type="hidden" id="colores_puerta_8" name="colores_puerta_8" value="" />
			<input type="hidden" id="modulos_interior" name="modulos_interior" value="" />
			<input type="hidden" id="interior_puerta_1" name="interior_puerta_1" value="" />
			<input type="hidden" id="interior_puerta_2" name="interior_puerta_2" value="" />
			<input type="hidden" id="interior_puerta_3" name="interior_puerta_3" value="" />
			<input type="hidden" id="interior_puerta_4" name="interior_puerta_4" value="" />
			<input type="hidden" id="interior_puerta_5" name="interior_puerta_5" value="" />
			<input type="hidden" id="interior_puerta_6" name="interior_puerta_6" value="" />
			<input type="hidden" id="interior_puerta_7" name="interior_puerta_7" value="" />
			<input type="hidden" id="interior_puerta_8" name="interior_puerta_8" value="" />
			<input type="hidden" id="laterales_seleccionado" name="laterales_seleccionado" value="" />
			<input type="hidden" id="tapetas_seleccionado" name="tapetas_seleccionado" value="" />
			<input type="hidden" id="costados_seleccionado" name="costados_seleccionado" value="" />
			<input type="hidden" id="fijos_seleccionado" name="fijos_seleccionado" value="" />
			<input type="hidden" id="montaje_frente_seleccionado" name="montaje_frente_seleccionado" value="" />
			<input type="hidden" id="montaje_frente_arjomy_seleccionado" name="montaje_frente_arjomy_seleccionado" value="" />
			<input type="hidden" id="montaje_interior_seleccionado" name="montaje_interior_seleccionado" value="" />
			<input type="hidden" id="montaje_interior_arjomy_seleccionado" name="montaje_interior_arjomy_seleccionado" value="" />
			<input type="hidden" id="desmontaje_frente_seleccionado" name="desmontaje_frente_seleccionado" value="" />
			<input type="hidden" id="desmontaje_frente_arjomy_seleccionado" name="desmontaje_frente_arjomy_seleccionado" value="" />
			<input type="hidden" id="desmontaje_interior_seleccionado" name="desmontaje_interior_seleccionado" value="" />
			<input type="hidden" id="desmontaje_interior_arjomy_seleccionado" name="desmontaje_interior_arjomy_seleccionado" value="" />
			<input type="hidden" id="juego_led_seleccionado" name="juego_led_seleccionado" value="" />
			<input type="hidden" id="juego_led_arjomy_seleccionado" name="juego_led_arjomy_seleccionado" value="" />
			<input type="hidden" id="rematar_frente_seleccionado" name="remate_frente_seleccionado" value="" />
			<input type="hidden" id="rematar_frente_arjomy_seleccionado" name="remate_frente_arjomy_seleccionado" value="" />
			<input type="hidden" id="rematar_interior_seleccionado" name="remate_interior_seleccionado" value="" />
			<input type="hidden" id="sistema_frenos_seleccionado" name="sistema_frenos_seleccionado" value="" />
			<input type="hidden" id="regleta_led_seleccionado" name="regleta_led_seleccionado" value="" />
			<input type="hidden" id="frente_abuardillado_seleccionado" name="frente_abuardillado_seleccionado" value="" />
			<input type="hidden" id="albanileria_con_seleccionado" name="albanileria_con_seleccionado" value="" />
			<input type="hidden" id="albanileria_sin_seleccionado" name="albanileria_sin_seleccionado" value="" />
			<input type="hidden" id="precio_frente" name="precio_frente" value="" />
			<input type="hidden" id="inc_desc_frente" name="inc_desc_frente" value="" />
			<input type="hidden" id="cant_inc_desc_frente" name="cant_inc_desc_frente" value="" />
			<input type="hidden" id="precio_ceramica" name="precio_ceramica" value="" />
			<input type="hidden" id="precio_modulos_interior" name="precio_modulos_interior" value="" />
			<input type="hidden" id="precio_accesorios_interior" name="precio_accesorios_interior" value="" />
			<input type="hidden" id="inc_desc_interior" name="inc_desc_interior" value="" />
			<input type="hidden" id="cant_inc_desc_interior" name="cant_inc_desc_interior" value="" />
			<input type="hidden" id="precio_tapetas" name="precio_tapetas" value="" />
			<input type="hidden" id="precio_laterales" name="precio_laterales" value="" />
			<input type="hidden" id="precio_costados" name="precio_costados" value="" />
			<input type="hidden" id="precio_costados_dist" name="precio_costados_dist" value="" />
			<input type="hidden" id="precio_fijos" name="precio_fijos" value="" />
			<input type="hidden" id="precio_fijos_dist" name="precio_fijos_dist" value="" />
			<input type="hidden" id="precio_montaje_frente" name="precio_montaje_frente" value="" />
			<input type="hidden" id="precio_montaje_frente_dist" name="precio_montaje_frente_dist" value="" />
			<input type="hidden" id="precio_montaje_interior" name="precio_montaje_interior" value="" />
			<input type="hidden" id="precio_montaje_interior_dist" name="precio_montaje_interior_dist" value="" />
			<input type="hidden" id="precio_desmontaje_frente" name="precio_desmontaje_frente" value="" />
			<input type="hidden" id="precio_desmontaje_frente_dist" name="precio_desmontaje_frente_dist" value="" />
			<input type="hidden" id="precio_desmontaje" name="precio_desmontaje" value="" />
			<input type="hidden" id="precio_desmontaje_interior" name="precio_desmontaje_interior" value="" />
			<input type="hidden" id="precio_desmontaje_interior_dist" name="precio_desmontaje_interior_dist" value="" />
			<input type="hidden" id="precio_juego_led" name="precio_juego_led" value="" />
			<input type="hidden" id="precio_juego_led_dist" name="precio_juego_led_dist" value="" />
			<input type="hidden" id="precio_rematar_frente" name="precio_rematar_frente" value="" />
			<input type="hidden" id="precio_rematar_frente_dist" name="precio_rematar_frente_dist" value="" />
			<input type="hidden" id="precio_rematar_interior" name="precio_rematar_interior" value="" />
			<input type="hidden" id="precio_sistema_frenos" name="precio_sistema_frenos" value="" />
			<input type="hidden" id="precio_sistema_frenos_dist" name="precio_sistema_frenos_dist" value="" />
			<input type="hidden" id="precio_regleta_led" name="precio_regleta_led" value="" />
			<input type="hidden" id="precio_frente_abuardillado" name="precio_frente_abuardillado" value="" />
			<input type="hidden" id="precio_albanileria_con" name="precio_albanileria_con" value="" />
			<input type="hidden" id="precio_albanileria_sin" name="precio_albanileria_sin" value="" />
			<input type="hidden" id="precio_km_medicion" name="precio_km_medicion" value="" />
			<input type="hidden" id="precio_km_montaje" name="precio_km_montaje" value="" />
			<input type="hidden" id="aplicar_descuento" name="aplicar_descuento" value="" />
			<input type="hidden" id="descuento_cliente" name="descuento_cliente" value="" />
			<input type="hidden" id="iva" name="iva" value="" />
			<input type="hidden" id="precio_total" name="precio_total" value="" />
			<input type="hidden" id="observaciones_proyecto" name="observaciones_proyecto" value="" />
			<input type="hidden" id="nombre_cliente" name="nombre_cliente" value="" />
			<input type="hidden" id="dni_cliente" name="dni_cliente" value="" />
			<input type="hidden" id="direccion_cliente" name="direccion_cliente" value="" />
			<input type="hidden" id="poblacion_cliente" name="poblacion_cliente" value="" />
			<input type="hidden" id="cp_cliente" name="cp_cliente" value="" />
			<input type="hidden" id="provincia_cliente" name="provincia_cliente" value="" />
			<input type="hidden" id="telefono_cliente" name="telefono_cliente" value="" />
			<input type="hidden" id="email_cliente" name="email_cliente" value="" />
			<input type="hidden" id="horario_cliente" name="horario_cliente" value="" />
			<input type="hidden" id="extras_1_seleccionado" name="extras_1_seleccionado" value="" />
			<input type="hidden" id="precio_extras_1" name="precio_extras_1" value="" />
			<input type="hidden" id="extras_2_seleccionado" name="extras_2_seleccionado" value="" />
			<input type="hidden" id="precio_extras_2" name="precio_extras_2" value="" />
			<input type="hidden" id="extras_3_seleccionado" name="extras_3_seleccionado" value="" />
			<input type="hidden" id="precio_extras_3" name="precio_extras_3" value="" />
			<input type="hidden" id="extras_4_seleccionado" name="extras_4_seleccionado" value="" />
			<input type="hidden" id="precio_extras_4" name="precio_extras_4" value="" />
			<input type="hidden" id="extras_5_seleccionado" name="extras_5_seleccionado" value="" />
			<input type="hidden" id="precio_extras_5" name="precio_extras_5" value="" />
			<input type="hidden" id="extras_6_seleccionado" name="extras_6_seleccionado" value="" />
			<input type="hidden" id="precio_extras_6" name="precio_extras_6" value="" />
			<input type="hidden" id="extras_7_seleccionado" name="extras_7_seleccionado" value="" />
			<input type="hidden" id="precio_extras_7" name="precio_extras_7" value="" />
			<input type="hidden" id="extras_8_seleccionado" name="extras_8_seleccionado" value="" />
			<input type="hidden" id="precio_extras_8" name="precio_extras_8" value="" />
			<input type="hidden" id="extras_9_seleccionado" name="extras_9_seleccionado" value="" />
			<input type="hidden" id="precio_extras_9" name="precio_extras_9" value="" />
			<input type="hidden" id="extras_10_seleccionado" name="extras_10_seleccionado" value="" />
			<input type="hidden" id="precio_extras_10" name="precio_extras_10" value="" />
			<input type="hidden" id="extras_11_seleccionado" name="extras_11_seleccionado" value="" />
			<input type="hidden" id="precio_extras_11" name="precio_extras_11" value="" />
			<input type="hidden" id="extras_12_seleccionado" name="extras_12_seleccionado" value="" />
			<input type="hidden" id="precio_extras_12" name="precio_extras_12" value="" />
			<input type="hidden" id="extras_13_seleccionado" name="extras_13_seleccionado" value="" />
			<input type="hidden" id="precio_extras_13" name="precio_extras_13" value="" />
			<input type="hidden" id="albanileria_sencilla_seleccionado" name="albanileria_sencilla_seleccionado" value="" />
			<input type="hidden" id="precio_albanileria_sencilla" name="precio_albanileria_sencilla" value="" />
			<input type="hidden" id="albanileria_tirar_tabique_seleccionado" name="albanileria_tirar_tabique_seleccionado" value="" />
			<input type="hidden" id="precio_albanileria_tirar_tabique" name="precio_albanileria_tirar_tabique" value="" />
			<input type="hidden" id="albanileria_quitar_solera_seleccionado" name="albanileria_quitar_solera_seleccionado" value="" />
			<input type="hidden" id="precio_albanileria_quitar_solera" name="precio_albanileria_quitar_solera" value="" />
			<input type="hidden" id="albanileria_mover_enchufe_seleccionado" name="albanileria_mover_enchufe_seleccionado" value="" />
			<input type="hidden" id="precio_albanileria_mover_enchufe" name="precio_albanileria_mover_enchufe" value="" />
			<input type="hidden" id="albanileria_costado_pladur_seleccionado" name="albanileria_costado_pladur_seleccionado" value="" />
			<input type="hidden" id="precio_albanileria_costado_pladur" name="precio_albanileria_costado_pladur" value="" />
			<input type="hidden" id="precio_leds_incrustados" name="precio_leds_incrustados" value="" />
			<input type="hidden" id="precio_herrajes_negros" name="precio_herrajes_negros" value="" />
			<input type="hidden" id="precio_multitaladro" name="precio_multitaladro" value="" />
			<input type="hidden" id="precio_espejo_extraible" name="precio_espejo_extraible" value="" />
			<input type="hidden" id="precio_espejo_con_carril" name="precio_espejo_con_carril" value="" />
			<input type="hidden" id="precio_baldas_inclinadas" name="precio_baldas_inclinadas" value="" />
			<input type="hidden" id="precio_kit_plegable" name="precio_kit_plegable" value="" />
			<input type="hidden" id="precio_recrecer_frente" name="precio_recrecer_frente" value="" />			 


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
				<div class="botones_navegacion">
					<a class="boton naranja grande boton_volver inactivo" onClick="volver_proyecto(1);"><i class="fa fa-chevron-left"></i> Volver</a> <a class="boton verde grande boton_continuar inactivo" onClick="continuar_proyecto(2);">Continuar <i class="fa fa-chevron-right"></i></a> <a class="boton verde grande boton_guardar" onClick="datos_cliente();"><i class="fa fa-floppy-o"></i> Guardar</a>
				</div>
			</div>
			<div class="resumen_proyecto">
				<h2><i class="fa fa-file-text-o"></i>Resumen del proyecto</h2>
				<h3>Serie</h3>
				<div class="txt_resumen serie">-</div>
				<h3>Acabado</h3>
				<div class="txt_resumen acabado">-</div>
				<h3>Color perfilería</h3>
				<div class="txt_resumen perfileria">-</div>
				<h3>Medidas totales</h3>
				<div class="txt_resumen medidas">-</div>
				<h3>Nº Puertas</h3>
				<div class="txt_resumen puertas">-</div>
				<h3>Diseño puertas</h3>
				<div class="txt_resumen diseno">-</div>
				<h3>Colores</h3>
				<div class="txt_resumen colores">-</div>
				<h3>Interior</h3>
				<div class="txt_resumen interior">-</div>
				<h3>Extras</h3>
				<div class="txt_resumen extras">-</div>
				<h3>Precio</h3>
				<div class="txt_resumen precio">-</div>
				<div class="botones_resumen">
					<a class="boton rojo grande ajax-popup-link-modal" href="index.php?seccion=ajax&sub=confirmar_cancelar_proyecto"><i class="fa fa-window-close-o"></i> Cancelar proyecto</a>
				</div>
			</div>
			<div class="referencia_proyecto"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	continuar_proyecto(1, 1);
</script>