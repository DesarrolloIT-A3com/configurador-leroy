// CUANDO SE CARGA EL DOCUMENTO
$( document ).ready( function() {
	
	inicializar();
	
});

function inicializar(){
	
	$('#tabs').tabs();
	
	// INICIALIZA LOS LINKS CON MAGNIFIC POPUP
	$('.ajax-popup-link').magnificPopup({
		type: 'ajax',
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)'
	});
	
	// INICIALIZA LOS LINKS CON MAGNIFIC POPUP EN MODAL
	$('.ajax-popup-link-modal').magnificPopup({
		type: 'ajax',
		modal: true,
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)'
	});
	
	// INICIALIZA LOS LINKS CON MAGNIFIC POPUP PARA IMÁGENES
	$('.image-popup-link').magnificPopup({
		type:'image',
		image: {
			// Para que no aparezca el contenido del atributo title como título
			titleSrc: ''
		},
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)'
	});
	
}

// CARGA LISTADO DE SOLICITUDES CON LOS PARÁMETROS ADECUADOS
function listado_solicitudes(mostrar){
	
	$(".listado_solicitudes").html('<br /><br /><br /><center><i class="fa fa-spinner fa-spin"></i> Cargando</center>');	
	
	$.post('index.php', { seccion:'ajax', sub:'listado_solicitudes', mostrar:mostrar }, function(data){
				
		$(".listado_solicitudes").html(data);	
		inicializar();
					
	});
	
}

// APRUEBA UNA SOLICITUD DE ACCESO
function datos_aprobar_solicitud_timeout(id_solicitud){ // SI VIENE DEL POPUP TIENE QUE ESPERAR A QUE SE CIERRE PARA ABRIR EL OTRO
	setTimeout(function(){
			datos_aprobar_solicitud(id_solicitud);
	},300);
}
function datos_aprobar_solicitud(id_solicitud){
	
	$.magnificPopup.open({
		type: 'ajax',
		items: {
			src: 'index.php?seccion=ajax&sub=datos_aprobar_solicitud&id='+id_solicitud
		},
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)',
		modal: true
    });
	
}
function aprobar_solicitud(id_solicitud, tarifa, descuento){
	
	$.post('index.php', { seccion:'ajax', sub:'aprobar_solicitud', id:id_solicitud, tarifa:tarifa, descuento:descuento }, function(data){
				
		if(data.estado == 'ok'){
			$("#solicitud-"+id_solicitud+" .estado").removeClass("pendiente").addClass('aprobado').html('Aprobado');
			$("#aprobados").html(parseInt($("#aprobados").html()) + 1);
			$("#pendientes").html(parseInt($("#pendientes").html()) - 1);
			$("#solicitud-"+id_solicitud+" .acciones").remove();
		}
		else{
			alert(data.mensaje);
		}
					
	}, "json");
	
}
	
// RECHAZA UNA SOLICITUD DE ACCESO
function confirmar_rechazar_solicitud_timeout(id_solicitud){ // SI VIENE DEL POPUP TIENE QUE ESPERAR A QUE SE CIERRE PARA ABRIR EL OTRO
	setTimeout(function(){
			confirmar_rechazar_solicitud(id_solicitud);
	},300);
}
function confirmar_rechazar_solicitud(id_solicitud){ // MUESTRA UN MENSAJE DE CONFIRMACIÓN ANTES DE RECHAZAR
	$.magnificPopup.open({
		type: 'ajax',
		items: {
			src: 'index.php?seccion=ajax&sub=confirmar_rechazar_solicitud&id='+id_solicitud
		},
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)',
		modal: true
    });
}
function rechazar_solicitud(id_solicitud){
	
	$.post('index.php', { seccion:'ajax', sub:'rechazar_solicitud', id:id_solicitud }, function(data){
				
		if(data.estado == 'ok'){
			$("#solicitud-"+id_solicitud+" .estado").removeClass("pendiente").addClass('rechazado').html('Rechazado');
			$("#rechazados").html(parseInt($("#rechazados").html()) + 1);
			$("#pendientes").html(parseInt($("#pendientes").html()) - 1);
			$("#solicitud-"+id_solicitud+" .acciones.aprobar_rechazar").remove();
		}
		else{
			alert(data.mensaje);
		}
					
	}, "json");
	
}

// BORRA UNA SOLICITUD DE ACCESO
function confirmar_borrar_solicitud_timeout(id_solicitud){ // SI VIENE DEL POPUP TIENE QUE ESPERAR A QUE SE CIERRE PARA ABRIR EL OTRO
	setTimeout(function(){
			confirmar_borrar_solicitud(id_solicitud);
	},300);
}
function confirmar_borrar_solicitud(id_solicitud){ // MUESTRA UN MENSAJE DE CONFIRMACIÓN ANTES DE BORRAR
	$.magnificPopup.open({
		type: 'ajax',
		items: {
			src: 'index.php?seccion=ajax&sub=confirmar_borrar_solicitud&id='+id_solicitud
		},
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)',
		modal: true
    });
}
function borrar_solicitud(id_solicitud){ // BORRA LA SOLICITUD POR AJAX Y LA ELIMINA DE LA TABLA
	$.post('index.php', { seccion:'ajax', sub:'borrar_solicitud', id:id_solicitud }, function(data){
				
		if(data.estado == 'ok'){
			$("#solicitud-"+id_solicitud).remove();
			$("#todos").html(parseInt($("#todos").html()) - 1);
			if(data.mensaje == 0){
				$("#pendientes").html(parseInt($("#pendientes").html()) - 1);
			}
			if(data.mensaje == 1){
				$("#rechazados").html(parseInt($("#rechazados").html()) - 1);
			}
		}
		else{
			alert(data.mensaje);
		}
					
	}, "json");
}


// EDITAR PROYECTO
function confirmar_editar_proyecto(id_proyecto, volver){ // MUESTRA UN MENSAJE DE CONFIRMACIÓN ANTES DE EDITAR
	$.magnificPopup.open({
		type: 'ajax',
		items: {
			src: 'index.php?seccion=ajax&sub=confirmar_editar_proyecto&id='+id_proyecto+'&volver='+volver
		},
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)',
		modal: true
    });
}

function editar_proyecto(id_proyecto){ // EDITAR EL PROYECTO
	location.href ="index.php?seccion=proyectos&sub=edicion_proyecto&id="+id_proyecto;	
}


// CARGA LISTADO DE USUARIOS CON LOS PARÁMETROS ADECUADOS
function listado_usuarios(mostrar){
	
	$(".listado_usuarios").html('<br /><br /><br /><center><i class="fa fa-spinner fa-spin"></i> Cargando</center>');	
	
	$.post('index.php', { seccion:'ajax', sub:'listado_usuarios', mostrar:mostrar }, function(data){
				
		$(".listado_usuarios").html(data);	
		inicializar();
					
	});
	
}

// ACTIVA UN USUARIO
function activar_usuario(id_usuario){
	
	$.post('index.php', { seccion:'ajax', sub:'activar_usuario', id:id_usuario }, function(data){
				
		if(data.estado == 'ok'){
			$("#usuario-"+id_usuario+" .estado").removeClass("inactivo").addClass('activo').html('Activo');
			$("#activos").html(parseInt($("#activos").html()) + 1);
			$("#inactivos").html(parseInt($("#inactivos").html()) - 1);
			$("#usuario-"+id_usuario+" .activar").addClass('oculto');
			$("#usuario-"+id_usuario+" .desactivar").removeClass('oculto');
		}
		else{
			alert(data.mensaje);
		}
					
	}, "json");
	
}

// DESACTIVA UN USUARIO
function desactivar_usuario(id_usuario){
	
	$.post('index.php', { seccion:'ajax', sub:'desactivar_usuario', id:id_usuario }, function(data){
				
		if(data.estado == 'ok'){
			$("#usuario-"+id_usuario+" .estado").removeClass("activo").addClass('inactivo').html('Inactivo');
			$("#activos").html(parseInt($("#activos").html()) - 1);
			$("#inactivos").html(parseInt($("#inactivos").html()) + 1);
			$("#usuario-"+id_usuario+" .desactivar").addClass('oculto');
			$("#usuario-"+id_usuario+" .activar").removeClass('oculto');
		}
		else{
			alert(data.mensaje);
		}
					
	}, "json");
	
}

// BORRA UN USUARIO
function confirmar_borrar_usuario_timeout(id_usuario){ // SI VIENE DEL POPUP TIENE QUE ESPERAR A QUE SE CIERRE PARA ABRIR EL OTRO
	setTimeout(function(){
			confirmar_borrar_usuario(id_usuario);
	},300);
}
function confirmar_borrar_usuario(id_usuario, volver){ // MUESTRA UN MENSAJE DE CONFIRMACIÓN ANTES DE BORRAR
	$.magnificPopup.open({
		type: 'ajax',
		items: {
			src: 'index.php?seccion=ajax&sub=confirmar_borrar_usuario&id='+id_usuario+'&volver='+volver
		},
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)',
		modal: true
    });
}
function borrar_usuario(id_usuario, volver){ // BORRA EL USUARIO POR AJAX Y LA ELIMINA DE LA TABLA
	$.post('index.php', { seccion:'ajax', sub:'borrar_usuario', id:id_usuario, volver:volver }, function(data){
				
		if(data.estado == 'ok'){
			if(data.volver == 1){
				location.href ="index.php?seccion=usuarios";
			}
			else{
				$("#usuario-"+id_usuario).remove();
				$("#todos").html(parseInt($("#todos").html()) - 1);
				if(data.mensaje == 0){
					$("#activos").html(parseInt($("#activos").html()) - 1);
				}
				if(data.mensaje == 1){
					$("#inactivos").html(parseInt($("#inactivos").html()) - 1);
				}
			}
		}
		else{
			alert(data.mensaje);
		}
					
	}, "json");
}

// CARGA LISTADO DE PROYECTOS CON LOS PARÁMETROS ADECUADOS
function listado_proyectos(id_usuario, mostrar){
	
	$(".listado_proyectos").html('<br /><br /><br /><center><i class="fa fa-spinner fa-spin"></i> Cargando</center>');	
	
	$.post('index.php', { seccion:'ajax', sub:'listado_proyectos', id:id_usuario, mostrar:mostrar }, function(data){
				
		$(".listado_proyectos").html(data);	
		inicializar();
					
	});
	
}

// BORRA EL PROYECTO DE LA BASE DE DATOS.
function confirmar_borrar_proyecto(id_proyecto, volver){ // MUESTRA UN MENSAJE DE CONFIRMACIÓN ANTES DE BORRAR
	$.magnificPopup.open({
		type: 'ajax',
		items: {
			src: 'index.php?seccion=ajax&sub=confirmar_borrar_proyecto&id='+id_proyecto+'&volver='+volver
		},
		tLoading: 'Cargando...',
		tClose: 'Cerrar (Esc)',
		modal: true
    });
}
function borrar_proyecto(id_proyecto, volver){ // BORRA LA SOLICITUD POR AJAX Y LA ELIMINA DE LA TABLA
	$.post('index.php', { seccion:'ajax', sub:'borrar_proyecto', id:id_proyecto, volver:volver }, function(data){
				
		if(data.estado == 'ok'){
			if(data.volver == 1){
				location.href ="index.php?seccion=usuarios&sub=proyectos_usuario&id="+data.usuario;
			}
			else{
				$("#proyecto-"+id_proyecto).remove();
				$("#todos").html(parseInt($("#todos").html()) - 1);
				if(data.mensaje == 0){
					$("#no_enviados").html(parseInt($("#no_enviados").html()) - 1);
				}
				if(data.mensaje == 1){
					$("#enviados").html(parseInt($("#enviados").html()) - 1);
				}
			}
		}
		else{
			alert(data.mensaje);
		}
					
	}, "json");
}

// MUESTRA POPUP PARA SELECCIONAR LA PUERTA
function cambiar_puerta(num_puerta){
	
	serie = $('#serie_marcada').val();
	acabado = $('#acabado_marcado').val();
	
	$.magnificPopup.open({
		items: {
			src: 'index.php?seccion=ajax&sub=nuevo_proyecto&ac=cambiar_puerta&id_serie='+serie+'&id_acabado='+acabado+'&num_puerta='+num_puerta
		},
		type: 'ajax'
	});
			
}

function cambiar_puerta_diseno(num_puerta,id_serie, id_acabado){
	
	var altura = $('#medidas_alto').val(); // PARA VER LOS DISEÑOS QUE PERMITE
	
	$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'cambiar_puerta_diseno', num_puerta:num_puerta, id_serie:id_serie, id_acabado:id_acabado, altura:altura }, function(data){
		
		$('.cuerpo_cambiar_puerta').html(data);
		
		// CUANDO SE PULSE EN UNA PUERTA
		$('.cambiar_puerta .cuerpo_cambiar_puerta .cambiar_puerta_diseno .item_cambiar_puerta').on('click', 'img', function (){
			var id_diseno = $(this).attr("id_diseno");
			var nombre_diseno = $(this).attr("nombre_diseno");
			
			cambiar_puerta_terminacion(num_puerta,id_serie, id_acabado, id_diseno, nombre_diseno);
			
		});
	});
}

function cambiar_puerta_terminacion(num_puerta,id_serie, id_acabado, id_diseno, nombre_diseno){
	
	var ancho_puerta = $('#medidas_ancho').val() / $('#puertas_marcado').val();
	
	$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'cambiar_puerta_terminacion', num_puerta:num_puerta, id_serie:id_serie, id_acabado:id_acabado, id_diseno:id_diseno, nombre_diseno:nombre_diseno, ancho_puerta:ancho_puerta }, function(data){
		
		$('.cuerpo_cambiar_puerta').html(data);
		
		// CUANDO SE PULSE EN UNA PUERTA
		$('.cambiar_puerta .cuerpo_cambiar_puerta .cambiar_puerta_terminacion .item_cambiar_puerta').on('click', 'img', function (){
			var id_terminacion = $(this).attr("id_terminacion");
			var nombre_terminacion = $(this).attr("nombre_terminacion");
			
			cambiar_puerta_final(num_puerta,id_serie, id_acabado, id_diseno, nombre_diseno, id_terminacion, nombre_terminacion);
			
		});
	});
}

function cambiar_puerta_final(num_puerta,id_serie, id_acabado, id_diseno, nombre_diseno, id_terminacion, nombre_terminacion){
	$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'cambiar_puerta_final', num_puerta:num_puerta, id_serie:id_serie, id_acabado:id_acabado, id_diseno:id_diseno, nombre_diseno:nombre_diseno, id_terminacion:id_terminacion, nombre_terminacion:nombre_terminacion }, function(data){
		
		$('.cuerpo_cambiar_puerta').html(data);
		
		// CUANDO SE PULSE EN UNA PUERTA
		$('.cambiar_puerta .cuerpo_cambiar_puerta .cambiar_puerta_final .item_cambiar_puerta').on('click', 'img', function (){
			var id_puerta = $(this).attr("id_puerta");
			var img_puerta = $(this).attr("img_puerta");
			
			if(id_terminacion == 20 || id_terminacion == 21){ // SI LA TERMINACIÓN ES CERÁMICA CÍRCULO O CUADRADO PEDIMOS QUE ELIJA LA MEDIDA DE LA CERÁMICA.
				var ancho_puerta = $('#medidas_ancho').val() / $('#puertas_marcado').val();
				
				$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'elegir_ceramica',  num_puerta:num_puerta, id_serie:id_serie, id_acabado:id_acabado, id_diseno:id_diseno, nombre_diseno:nombre_diseno, id_terminacion:id_terminacion, nombre_terminacion:nombre_terminacion, ancho_puerta:ancho_puerta }, function(data){
					
					$('.cuerpo_cambiar_puerta').html(data);
					
					// CUANDO SE PULSE EN UNA MEDIDA
					$('.cambiar_puerta .cuerpo_cambiar_puerta .elegir_ceramica .item_elegir_ceramica').on('click', 'img', function (){
						
						var id_ceramica = $(this).attr("id_ceramica");
						var nombre_ceramica = $(this).attr("nombre_ceramica");
						
						if($('#copiar_puertas').is(':checked')){ // SI ESTA MARCADO QUE SE COPIE EL DISEÑO A TODAS LAS PUERTAS
							var num_puertas = $('#puertas_marcado').val();
							for(i=1; i<=num_puertas; i++){
								mostrar_puerta(i,id_serie, id_acabado, id_diseno, nombre_diseno, id_terminacion, nombre_terminacion, id_puerta, img_puerta, id_ceramica, nombre_ceramica);
							}
						}
						else{
							mostrar_puerta(num_puerta,id_serie, id_acabado, id_diseno, nombre_diseno, id_terminacion, nombre_terminacion, id_puerta, img_puerta, id_ceramica, nombre_ceramica);
						}
						calcular_precio_frente();
						$.magnificPopup.close();
					});
					
				});
			}
			else if(id_terminacion == 22){ // SI LA TERMINACIÓN ES CERÁMICA FRANJA
				var ancho_puerta = $('#medidas_ancho').val() / $('#puertas_marcado').val();
				
				var id_ceramica = 0;
				
				// ID DE LA FRANJA CORRESPONDIENTE SEGÚN EL ANCHO
				if(ancho_puerta <= 60){
					id_ceramica = 9;
				}
				else if(ancho_puerta <= 80){
					id_ceramica = 10;
				}
				else if(ancho_puerta <= 100){
					id_ceramica = 11;
				}
				else if(ancho_puerta <= 120){
					id_ceramica = 12;
				}
				
				if($('#copiar_puertas').is(':checked')){ // SI ESTA MARCADO QUE SE COPIE EL DISEÑO A TODAS LAS PUERTAS
					var num_puertas = $('#puertas_marcado').val();
					for(i=1; i<=num_puertas; i++){
						mostrar_puerta(i, id_serie, id_acabado, id_diseno, nombre_diseno, id_terminacion, nombre_terminacion, id_puerta, img_puerta, id_ceramica);
					}
				}
				else{
					mostrar_puerta(num_puerta, id_serie, id_acabado, id_diseno, nombre_diseno, id_terminacion, nombre_terminacion, id_puerta, img_puerta, id_ceramica);
				}
				
				calcular_precio_frente();
				$.magnificPopup.close();
				
			}
			else{
				
				if($('#copiar_puertas').is(':checked')){ // SI ESTA MARCADO QUE SE COPIE EL DISEÑO A TODAS LAS PUERTAS
					var num_puertas = $('#puertas_marcado').val();
					for(i=1; i<=num_puertas; i++){
						mostrar_puerta(i, id_serie, id_acabado, id_diseno, nombre_diseno, id_terminacion, nombre_terminacion, id_puerta, img_puerta);
					}
				}
				else{
					mostrar_puerta(num_puerta, id_serie, id_acabado, id_diseno, nombre_diseno, id_terminacion, nombre_terminacion, id_puerta, img_puerta);
				}
				
				calcular_precio_frente();
				$.magnificPopup.close();
				
			}
			
		});
		
	});
}

// PINTA LA PUERTA SELECCIONADA Y PONE LOS DATOS EN RESUMEN
function mostrar_puerta(num_puerta, serie, acabado, diseno, nombre_diseno, terminacion, nombre_terminacion, puerta, img_puerta, ceramica, nombre_ceramica){
	
	// MOSTRAMOS LA IMAGEN DE LA PUERTA
	$('#puerta-'+num_puerta).attr('src','../www/img/disenos/'+serie+'/'+acabado+'/'+diseno+'/'+terminacion+'/'+img_puerta);
	
	// MODIFICAMOS LOS DATOS DEL RESUMEN
	if($('.txt_resumen.diseno').html() == '-'){ // SI TODAVÍA NO HAY NINGUNA PUERTA
		$('.txt_resumen.diseno').html('<div id="diseno-puerta-'+num_puerta+'"><h5>P'+num_puerta+'</h5><ul><li>'+nombre_diseno+'</li><li>'+nombre_terminacion+'</li></ul></div>');
	}
	else{ // SI YA HAY ALGUNA PUERTA
		if($('#diseno-puerta-'+num_puerta).length){ // SI ES UNA PUERTA EXISTENTE
			// CONSTRUIMOS LA CADENA SEGÚN LLEVE O NO CERÁMICA
			var html_diseno_puerta = '<h5>P'+num_puerta+'</h5><ul><li>'+nombre_diseno+'</li><li>'+nombre_terminacion+'</li>';
			if(terminacion == 20 || terminacion == 21){ // SI LLEVA CÍRCULO O CUADRADO DE CERÁMICA
				html_diseno_puerta = html_diseno_puerta + '<li>'+nombre_ceramica+'</li>'; // LO PONEMOS EN EL TEXTO
			}
			html_diseno_puerta = html_diseno_puerta + '</ul>'; // TERMINAMOS EL TEXTO
			
			$('#diseno-puerta-'+num_puerta).html(html_diseno_puerta);

		}
		else{ // SI ES UNA PUERTA NUEVA
			$('.txt_resumen.diseno').append('<div id="diseno-puerta-'+num_puerta+'"><h5>P'+num_puerta+'</h5><ul><li>'+nombre_diseno+'</li><li>'+nombre_terminacion+'</li></ul></div>');
		}
	}
	
	$('#diseno_puerta_'+num_puerta).val(diseno+'-'+terminacion+'-'+puerta);
	if(terminacion == 20 || terminacion == 21 || terminacion == 22){ // SI LLEVA CERÁMICA
		$("#ceramica_puerta_"+num_puerta).val(ceramica); // GUARDAMOS EL VALOR
	}
	else{
		$("#ceramica_puerta_"+num_puerta).val(0);
	}
}

// CALCULA EL PRECIO DEL FRENTE
function calcular_precio_frente(){
	var tarifa = $('#tarifa').val();
	var descuento = $('#descuento').val();
	var serie = $('#serie_marcada').val();
	var acabado = $('#acabado_marcado').val();
	var ancho = $('#medidas_ancho').val();
	var alto = $('#medidas_alto').val();
	var puertas = $('#puertas_marcado').val();
	var diseno_1 = $('#diseno_puerta_1').val();
	var diseno_2 = $('#diseno_puerta_2').val();
	var diseno_3 = $('#diseno_puerta_3').val();
	var diseno_4 = $('#diseno_puerta_4').val();
	var diseno_5 = $('#diseno_puerta_5').val();
	var diseno_6 = $('#diseno_puerta_6').val();
	var diseno_7 = $('#diseno_puerta_7').val();
	var diseno_8 = $('#diseno_puerta_8').val();
	var ceramica_1 = $('#ceramica_puerta_1').val();
	var ceramica_2 = $('#ceramica_puerta_2').val();
	var ceramica_3 = $('#ceramica_puerta_3').val();
	var ceramica_4 = $('#ceramica_puerta_4').val();
	var ceramica_5 = $('#ceramica_puerta_5').val();
	var ceramica_6 = $('#ceramica_puerta_6').val();
	var ceramica_7 = $('#ceramica_puerta_7').val();
	var ceramica_8 = $('#ceramica_puerta_8').val();
		
	$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'calcular_precio_frente', tarifa:tarifa, descuento:descuento, serie:serie, acabado:acabado, ancho:ancho, alto:alto, puertas:puertas, diseno_1:diseno_1, diseno_2:diseno_2, diseno_3:diseno_3, diseno_4:diseno_4, diseno_5:diseno_5, diseno_6:diseno_6, diseno_7:diseno_7, diseno_8:diseno_8, ceramica_1:ceramica_1, ceramica_2:ceramica_2, ceramica_3:ceramica_3, ceramica_4:ceramica_4, ceramica_5:ceramica_5, ceramica_6:ceramica_6, ceramica_7:ceramica_7, ceramica_8:ceramica_8 }, function(data){
		$('.txt_resumen.precio').html('<div class="precio_frente">Precio frente: <span>' + data.precio + '€</span></div>');
		$('#precio_frente').val(data.precio);
		
		if(data.cant_incremento_descuento != 0){
			$('.txt_resumen.precio .precio_frente').after('<div class="inc_desc_frente">' + data.incremento_descuento + ": <span>" + data.cant_incremento_descuento + "€</span></div>");
		}
		else{
			$('.txt_resumen.precio .precio_frente').after('<div class="inc_desc_frente"></div>');
		}
		$('#inc_desc_frente').val(data.incremento_descuento);
		$('#cant_inc_desc_frente').val(data.cant_incremento_descuento);
		
		if(data.ceramicas > 0){
			$('.txt_resumen.precio .inc_desc_frente').after('<div class="ceramicas">Precio cerámica: <span>' + data.ceramicas + "€</span></div>");
		}
		else{
			$('.txt_resumen.precio .inc_desc_frente').after('<div class="ceramicas"></div>');
		}
		$('#precio_ceramica').val(data.ceramicas);
		
		$('.txt_resumen.precio .ceramicas').after('<div class="iva">I.V.A.: <span>' + data.iva + "€</span></div>");
		$('#iva').val(data.iva);
		
		$('.txt_resumen.precio .iva').after('<div class="precio_total"><b>PRECIO TOTAL: <span>' + (parseFloat(data.total)+parseFloat(data.iva)).toFixed(2) + "€</span></b></div>");
		$('#precio_total').val((parseFloat(data.total)+parseFloat(data.iva)).toFixed(2));
		
		$('.referencia_proyecto').html(data.referencia);
		
	}, "json");
	
}




// MUESTRA POPUP PARA SELECCIONAR LOS COLORES DE LA PUERTA
function cambiar_colores(num_puerta){
	
	serie = $('#serie_marcada').val();
	acabado = $('#acabado_marcado').val();
	diseno_puerta = $('#diseno_puerta_'+num_puerta).val() == "4-1-110" ? "4-29-110" : $('#diseno_puerta_'+num_puerta).val();
	colores_puerta = $('#colores_puerta_'+num_puerta).val();
	puertas_marcado = $('#puertas_marcado').val();
	
	// PREPARAMOS EL RESUMEN PARA PONER LOS COLORES
	if($('.txt_resumen.colores').html() == '-'){ // SI TODAVÍA NO HAY NINGUNA PUERTA
		var html = "";
		
		for(i=1; i<=puertas_marcado; i++){
			html += '<div id="colores-puerta-'+i+'"><h5>P'+i+'</h5></div>';
		}
		$('.txt_resumen.colores').html(html);
	}
	
	var puertas_iguales = true;
	for(i=1; i<=puertas_marcado; i++){
		if($('#diseno_puerta_1').val() != $('#diseno_puerta_'+i).val() ){
			puertas_iguales = false;
		}
	}
	
	$.magnificPopup.open({
		items: {
			src: 'index.php?seccion=ajax&sub=nuevo_proyecto&ac=cambiar_colores&id_serie='+serie+'&id_acabado='+acabado+'&diseno_puerta='+diseno_puerta+'&colores_puerta='+colores_puerta+'&num_puerta='+num_puerta+'&puertas_iguales='+puertas_iguales
		},
		type: 'ajax'
	});
			
}

// MUESTRA LOS COLORES DISPONIBLES PARA ESA ZONA
function mostrar_colores(zona){
	$(".color_zona_"+zona+" .imagen_zona").slideUp("slow");
	$(".color_zona_"+zona+" .imagen_zona").html("");
	$('.colores_zona').slideUp('slow');
	$(".color_zona_"+zona+" .colores_zona").slideDown("slow");
	
	$('.cambiar_colores .botones_confirm .boton').addClass('inactivo');
	
	// PARA NO SE ACUMELE 
	$('.colores_zona .item_colores_zona').off('click', 'img');
	// CUANDO SE PULSE EN UN COLOR
	$('.colores_zona .item_colores_zona').on('click', 'img', function (){
		id_color = $(this).attr('id_color');
		nombre_color = $(this).attr('nombre_color');
		src = $(this).attr('src');
		
		$('.color_zona_'+zona+' .imagen_zona').html('<h4>'+nombre_color+'</h4><img src="'+src+'" />');
		$('.colores_zona').slideUp('slow');
		$('.color_zona_'+zona+' .imagen_zona').slideDown("slow");
		$('#input_zona_'+zona).val(id_color);
		
		if($('#input_zona_1').val() != "" && ($('#input_zona_2').length == 0 || $('#input_zona_2').val() != "") && ($('#input_zona_3').length == 0 || $('#input_zona_3').val() != "") && ($('#input_zona_4').length == 0 || $('#input_zona_4').val() != "") && ($('#input_zona_5').length == 0 || $('#input_zona_5').val() != "") && ($('#input_zona_6').length == 0 || $('#input_zona_6').val() != "") && ($('#input_zona_7').length == 0 || $('#input_zona_7').val() != "") && ($('#input_zona_8').length == 0 || $('#input_zona_8').val() != "") && ($('#input_zona_9').length == 0 || $('#input_zona_9').val() != "") && ($('#input_zona_10').length == 0 || $('#input_zona_10').val() != "") ){
			$('.cambiar_colores .botones_confirm .boton').removeClass('inactivo');
		}
		else{
			$('.cambiar_colores .botones_confirm .boton').addClass('inactivo');
		}
	});
}

// APLICAMOS LOS COLORES SELECCIONADOS PARA LA PUERTA
function aplicar_colores(puerta){
	
	// SOLO SI EL BOTÓN ESTÁ ACTIVO
	if(!$('.cambiar_colores .botones_confirm .boton').hasClass('inactivo')){
		
		// CONSTRUIMOS EL VALOR QUE GUARDARÁ EN EL INPUT GENERAL Y EL HTML PARA EL RESUMEN
		colores = $('#input_zona_1').val();
		resumen_titulo = "<h5>P"+puerta+"</h5>"
		resumen_cuerpo = "<ul><li>"+$('#nombre_zona_1').val()+"<br />"+$('.color_zona_1 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_1 .imagen_zona img').attr('src')+"' /></li>";
		
		if($('#input_zona_2').length && $('#input_zona_2').val() != ""){
			colores += "-"+$('#input_zona_2').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_2').val()+"<br />"+$('.color_zona_2 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_2 .imagen_zona img').attr('src')+"' /></li>";
		}
		if($('#input_zona_3').length && $('#input_zona_3').val() != ""){
			colores += "-"+$('#input_zona_3').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_3').val()+"<br />"+$('.color_zona_3 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_3 .imagen_zona img').attr('src')+"' /></li>";
		}
		if($('#input_zona_4').length && $('#input_zona_4').val() != ""){
			colores += "-"+$('#input_zona_4').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_4').val()+"<br />"+$('.color_zona_4 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_4 .imagen_zona img').attr('src')+"' /></li>";
		}
		if($('#input_zona_5').length && $('#input_zona_5').val() != ""){
			colores += "-"+$('#input_zona_5').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_5').val()+"<br />"+$('.color_zona_5 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_5 .imagen_zona img').attr('src')+"' /></li>";
		}
		if($('#input_zona_6').length && $('#input_zona_6').val() != ""){
			colores += "-"+$('#input_zona_6').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_6').val()+"<br />"+$('.color_zona_6 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_6 .imagen_zona img').attr('src')+"' /></li>";
		}
		if($('#input_zona_7').length && $('#input_zona_7').val() != ""){
			colores += "-"+$('#input_zona_7').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_7').val()+"<br />"+$('.color_zona_7 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_7 .imagen_zona img').attr('src')+"' /></li>";
		}
		if($('#input_zona_8').length && $('#input_zona_8').val() != ""){
			colores += "-"+$('#input_zona_8').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_8').val()+"<br />"+$('.color_zona_8 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_8 .imagen_zona img').attr('src')+"' /></li>";
		}
		if($('#input_zona_9').length && $('#input_zona_9').val() != ""){
			colores += "-"+$('#input_zona_9').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_9').val()+"<br />"+$('.color_zona_9 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_9 .imagen_zona img').attr('src')+"' /></li>";
		}
		if($('#input_zona_10').length && $('#input_zona_10').val() != ""){
			colores += "-"+$('#input_zona_10').val();
			resumen_cuerpo += "<li>"+$('#nombre_zona_10').val()+"<br />"+$('.color_zona_10 .imagen_zona h4').html()+"<br /><img src='"+$('.color_zona_10 .imagen_zona img').attr('src')+"' /></li>";
		}
		
		resumen_cuerpo += "</ul>";
		
		if($('#copiar_puertas').is(':checked')){ // SI ESTA MARCADO QUE SE COPIEN LOS COLORES A TODAS LAS PUERTAS
			for(i=1; i<=puertas_marcado; i++){
				$("#colores_puerta_"+i).val(colores); // LO PONE EN EL FORM
				$("#colores-puerta-"+i).html('<h5>P'+i+'</h5>'+resumen_cuerpo); // LO PONE EN EL RESUMEN
			}
		}
		else{
			$("#colores_puerta_"+puerta).val(colores); // LO PONE EN EL FORM
			$("#colores-puerta-"+puerta).html(resumen_titulo+resumen_cuerpo); // LO PONE EN EL RESUMEN
		}
		
		// COMPROBAMOS SI SE HAN COMPLETADO TODAS LAS PUERTAS PARA ACTIVAR EL BOTÓN CONTINUAR
		puertas_marcado = $('#puertas_marcado').val();
		continuar = true;
		for(i=1; i<=puertas_marcado; i++){
			if($("#colores_puerta_"+i).val() == ""){
				continuar = false;
			}
		}
		if(continuar){
			$('.botones_navegacion .boton_continuar').removeClass('inactivo');
		}
		else{
			$('.botones_navegacion .boton_continuar').addClass('inactivo');
		}
		
		
		$.magnificPopup.close();
	}
}

/*
// no se usa
function mostrar_colores(zona, nombre_zona, id_colores_tipo){
	$('.colores_zona').slideUp('slow', function() {
		
		$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'mostrar_colores', nombre_zona:nombre_zona, id_colores_tipo:id_colores_tipo }, function(data){
	
			$('.colores_zona').html(data).slideDown('slow');
			
		});
		
	});
	
}*/



// SI NO QUIERE INTERIOR Y PASA A FINALIZAR
function continuar_extras(){
	$('.botones_navegacion .boton_continuar').removeClass('inactivo');
	continuar_proyecto(9,8);
}

// SI DESEA AÑADIR INTERIOR MUESTRA LAS DIFERENTES COMBINACIONES DE MÓDULOS
function modulos_interior(paso_anterior){
	$('.seccion_interior').slideUp('slow', function() {
		$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'modulos_interior', ancho:$('#medidas_ancho').val(), num_puertas:$('#puertas_marcado').val(), paso_anterior:paso_anterior }, function(data){
			
			$('.seccion_interior').html(data);
			
			$('.seccion_interior').slideDown('slow');
			
		});
	});
}

function seleccion_interior(ancho_puerta, modulos_dobles, modulos_simples){
	$('.seccion_interior').slideUp('slow', function() {
		$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'seleccion_interior', ancho_puerta:ancho_puerta, modulos_dobles:modulos_dobles, modulos_simples:modulos_simples }, function(data){
			
			$('.seccion_interior').html(data);
			
			$('.seccion_interior').slideDown('slow');
			
		});
	});
	
	// PREPARAMOS EL RESUMEN PARA PONER LOS INTERIORES
	if($('.txt_resumen.interior').html() == '-'){ // SI TODAVÍA NO HAY NINGUN INTERIOR
		var html = "";
		
		var contador_modulos = 0;
		for(i=1; i<=modulos_dobles; i++){
			contador_modulos++;
			html += '<div id="diseno-interior-'+contador_modulos+'"><h5>M'+contador_modulos+'</h5></div>';
		}
		for(i=1; i<=modulos_simples; i++){
			contador_modulos++;
			html += '<div id="diseno-interior-'+contador_modulos+'"><h5>M'+contador_modulos+'</h5></div>';
		}
		$('.txt_resumen.interior').html(html);
		
		$('#modulos_interior').val(contador_modulos);
	}
}

function mostrar_interiores(num_modulo, tipo, ancho_puerta){
	if(tipo == 'doble'){
		ancho_puerta = ancho_puerta*2;
	}
	
	$.magnificPopup.open({
		items: {
			src: 'index.php?seccion=ajax&sub=nuevo_proyecto&ac=mostrar_interiores&num_modulo='+num_modulo+'&tipo='+tipo+'&ancho_interior='+ancho_puerta
		},
		type: 'ajax'
	});	
}

function preguntar_freno(num_modulo, tipo, ancho_interior, id_interior, nombre_interior, num_cajones){
	$('.contenedor_mostrar_interiores').slideUp('slow', function() {
		$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'preguntar_freno', num_modulo:num_modulo, tipo:tipo, ancho_interior:ancho_interior, id_interior:id_interior, nombre_interior:nombre_interior, num_cajones:num_cajones }, function(data){
			
			$('.contenedor_mostrar_interiores').html(data);
			
			$('.contenedor_mostrar_interiores').slideDown('slow');
			
		});
	});
}

function preguntar_color_interior(num_modulo, tipo, ancho_interior, id_interior, nombre_interior, ffccc){
	$('.contenedor_mostrar_interiores').slideUp('slow', function() {
		$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'preguntar_color_interior' }, function(data){
			
			$('.contenedor_mostrar_interiores').html(data);
			
			$('.contenedor_mostrar_interiores').slideDown('slow');
			
			// PARA QUE NO SE ACUMULEN
			$('.preguntar_color_interior .item_colores_interior').off('click', 'img');
			// CUANDO SE PULSE EN UN COLOR
			$('.preguntar_color_interior .item_colores_interior').on('click', 'img', function (){
				id_color_interior = $(this).attr('id_color');
				nombre_color_interior = $(this).attr('nombre_color');
				src_interior = $(this).attr('src');
				
				preguntar_color_cantoneras(num_modulo, tipo, ancho_interior, id_interior, nombre_interior, ffccc, id_color_interior, nombre_color_interior, src_interior);
			});
			
		});
	});
}

function preguntar_color_cantoneras(num_modulo, tipo, ancho_interior, id_interior, nombre_interior, ffccc, id_color_interior, nombre_color_interior, src_interior){
	$('.contenedor_mostrar_interiores').slideUp('slow', function() {
		$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'preguntar_color_cantoneras' }, function(data){
			
			$('.contenedor_mostrar_interiores').html(data);
			
			$('.contenedor_mostrar_interiores').slideDown('slow');
			
			// PARA QUE NO SE ACUMULEN
			$('.preguntar_color_cantoneras .item_colores_cantoneras').off('click', 'img');
			// CUANDO SE PULSE EN UN COLOR
			$('.preguntar_color_cantoneras .item_colores_cantoneras').on('click', 'img', function (){
				id_color_cantoneras = $(this).attr('id_color');
				nombre_color_cantoneras = $(this).attr('nombre_color');
				src_cantoneras = $(this).attr('src');
				
				cambiar_interior(num_modulo, tipo, ancho_interior, id_interior, nombre_interior, ffccc, id_color_interior, nombre_color_interior, src_interior, id_color_cantoneras, nombre_color_cantoneras, src_cantoneras);
			});
			
		});
	});
}

function cambiar_interior(
  num_modulo,
  tipo,
  ancho_interior,
  id_interior,
  nombre_interior,
  ffccc,
  id_color_interior,
  nombre_color_interior,
  src_interior,
  id_color_cantoneras,
  nombre_color_cantoneras,
  src_cantoneras
) {
  // MOSTRAMOS EL INTERIOR ELEGIDO
  $("#img_modulo_" + num_modulo).attr(
    "src",
    "www/img/interiores/modulo-" + id_interior + ".jpg"
  );

  // MODIFICAMOS LOS DATOS DEL RESUMEN
  var html = "<h5>M" + num_modulo + " ";
  if (tipo == "simple") {
    html += "(Simple)";
  } else {
    html += "(Doble)";
  }
  html += "</h5><ul><li>" + nombre_interior + "</li>";

  if (ffccc.substring(0, 1) == 0) {
    //html += '<li>Zapatero/s sin freno</li>';
  } else {
    html += "<li>Zapatero/s con freno</li>";
  }
  if (ffccc.substring(2, 3) == 0) {
    //html += '<li>Cajon/es sin freno</li>';
  } else {
    html += "<li>Cajon/es con freno</li>";
  }

  if (ffccc.substring(4, 5) > 0) {
    html += "<li>" + ffccc.substring(4, 5) + " x J. celdillas</li>";
  }
  if (ffccc.substring(6, 7) > 0) {
    html += "<li>" + ffccc.substring(6, 7) + " x Frente cristal</li>";
  }
  if (ffccc.substring(8, 9) > 0) {
    html += "<li>" + ffccc.substring(8, 9) + " x Cerradura</li>";
  }
  if (ffccc.substring(12, 13) > 0) {
    html += "<li>" + ffccc.substring(12, 13) + " x Herrajes en negro</li>";
  }
  if (ffccc.substring(14, 15) > 0) {
    html += "<li>" + ffccc.substring(14, 15) + " x Multitaladro</li>";
  }
  if (ffccc.substring(16, 17) > 0) {
    html += "<li>" + ffccc.substring(16, 17) + " x Tapa de cristal</li>";
  }
  if (ffccc.substring(18, 19) > 0) {
    html += "<li>" + ffccc.substring(18, 19) + " x Forrado de caja fuerte</li>";
  }
  if (ffccc.substring(20, 21) > 0) {
    html += "<li>" + ffccc.substring(20, 21) + " x Forrado de columnas</li>";
  }
  if (ffccc.substring(22, 23) > 0) {
    html += "<li>" + ffccc.substring(22, 23) + " x Tapas de registro</li>";
  }
  if (ffccc.substring(24, 25) > 0) {
    html += "<li>" + ffccc.substring(24, 25) + " x Recrecer armario</li>";
  }
  if (ffccc.substring(26, 27) > 0) {
    html += "<li>" + ffccc.substring(26, 27) + " x Cajoneras lacadas</li>";
  }
  if(ffccc.substring(28, 29) > 0) {
    html += "<li>" + ffccc.substring(28, 29) + " x Pantalonero premium</li>";
  }
  if(ffccc.substring(30, 31) > 0) {
    html += "<li>" + ffccc.substring(30, 31) + " x Zapatero premium</li>";
  }
  if(ffccc.substring(32, 33) > 0) {
    html += "<li>" + ffccc.substring(32, 33) + " x Cesta premium</li>";
  }
  if(ffccc.substring(34, 35) > 0) {
    html += "<li>" + ffccc.substring(34, 35) + " x Cajones de 8cm</li>";
  }
  if(ffccc.substring(36, 37) > 0) {
    html += "<li>" + ffccc.substring(36, 37) + " x Cajones de 16cm</li>";
  }
  if(ffccc.substring(38, 39) > 0) {
    html += "<li>" + ffccc.substring(38, 39) + " x Cajones de 20cm</li>";
  }
  if(ffccc.substring(40, 41) > 0) {
    html += "<li>" + ffccc.substring(40, 41) + " x Cajones de 32cm</li>";
  }
  if(ffccc.substring(34, 35) == 0 && ffccc.substring(36, 37) == 0 && ffccc.substring(38, 39) == 0 && ffccc.substring(40, 41) == 0 && ffccc.split("-")[23] != "") {
    html += "<li>Cajones de 16cm</li>";
  }
  if(ffccc.substring(42, 43) > 0 && ffccc.substring(42, 43) == 1) {
    html += "<li> "+ffccc.substring(44, 45)+" x Cristal Transparente</li>";
  }
  if(ffccc.substring(42, 43) > 0 && ffccc.substring(42, 43) == 2) {
    html += "<li> "+ffccc.substring(44, 45)+" x Cristal Mate </li>";
  }
  if(ffccc.split("-")[23] != "") {
    html += "<li> Gama:" + ffccc.split("-")[23] + "</li>";
  }
  if(ffccc.split("-")[24] != "") {
    html += "<li> Modelo:" + ffccc.split("-")[24] + "</li>";
  }
  if(ffccc.split("-")[25] != "") {
    html += "<li> Color:" + ffccc.split("-")[25] + "</li>";
  }

  html +=
    "<li>Color<br />" +
    nombre_color_interior +
    '<br /><img src="' +
    src_interior +
    '" /></li>';
  html +=
    "<li>Cantoneras<br />" +
    nombre_color_cantoneras +
    '<br /><img src="' +
    src_cantoneras +
    '" /></li>';
  html += "</ul>";

  $("#diseno-interior-" + num_modulo).html(html);

  // ALMACENAMOS EL VALOR
  $("#interior_puerta_" + num_modulo).val(
    ancho_interior +
      "-" +
      id_interior +
      "-" +
      ffccc +
      "-" +
      id_color_interior +
      "-" +
      id_color_cantoneras
  );

  // VEMOS SI ACTIVA EL BOTÓN CONTINUAR
  num_modulos = $("#modulos_interior").val();
  continuar = true;
  for (i = 1; i <= num_modulos; i++) {
    if ($("#interior_puerta_" + i).val() == "") {
      continuar = false;
    }
  }
  if (continuar) {
    $(".botones_navegacion .boton_continuar").removeClass("inactivo");
    calcular_precio_interior();
  } else {
    $(".botones_navegacion .boton_continuar").addClass("inactivo");
  }

  $.magnificPopup.close();
}


// CALCULA EL PRECIO DEL INTERIOR
function calcular_precio_interior(){
	var tarifa = $('#tarifa').val();
	var descuento = $('#descuento').val();
	var serie = $('#serie_marcada').val();
	var ancho = $('#medidas_ancho').val();
	var alto = $('#medidas_alto').val();
	var fondo = $('#medidas_fondo').val();
	var puertas = $('#puertas_marcado').val();
	var modulos_interior = $('#modulos_interior').val();
	var interior_1 = $('#interior_puerta_1').val();
	var interior_2 = $('#interior_puerta_2').val();
	var interior_3 = $('#interior_puerta_3').val();
	var interior_4 = $('#interior_puerta_4').val();
	var interior_5 = $('#interior_puerta_5').val();
	var interior_6 = $('#interior_puerta_6').val();
	var interior_7 = $('#interior_puerta_7').val();
	var interior_8 = $('#interior_puerta_8').val();
	var precio_frente = $('#precio_frente').val();
	var cant_inc_desc_frente = $('#cant_inc_desc_frente').val();
	var precio_ceramica = $('#precio_ceramica').val();
	
		
	$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'calcular_precio_interior', tarifa:tarifa, descuento:descuento, serie:serie, ancho:ancho, alto:alto, fondo:fondo, puertas:puertas, modulos_interior:modulos_interior, interior_1:interior_1, interior_2:interior_2, interior_3:interior_3, interior_4:interior_4, interior_5:interior_5, interior_6:interior_6, interior_7:interior_7, interior_8:interior_8, precio_frente:precio_frente, cant_inc_desc_frente:cant_inc_desc_frente, precio_ceramica:precio_ceramica }, function(data){
		
		$('.txt_resumen.precio').html('<div class="precio_frente">Precio frente: <span>' + data.precio_frente + '€</span></div>');
				
		if(data.cant_incremento_descuento != 0){
			$('.txt_resumen.precio .precio_frente').after('<div class="inc_desc_frente">' + $('#inc_desc_frente').val() + ": <span>" + data.cant_incremento_descuento + "€</span></div>");
		}
		else{
			$('.txt_resumen.precio .precio_frente').after('<div class="inc_desc_frente"></div>');
		}
		
		if(data.precio_modulos_interior > 0){
			$('.txt_resumen.precio .inc_desc_frente').after('<div class="precio_modulos_interior">Precio interior: <span>' + data.precio_modulos_interior + '€</span></div>');
			$('#precio_modulos_interior').val(data.precio_modulos_interior);
		}
		else{
			$('.txt_resumen.precio .inc_desc_frente').after('<div class="precio_modulos_interior"></div>');
		}
		
		if(data.cant_incremento_descuento_interior != 0){
			$('.txt_resumen.precio .precio_modulos_interior').after('<div class="inc_desc_interior">' + data.incremento_descuento_interior + ": <span>" + data.cant_incremento_descuento_interior + "€</span></div>");
			$('#inc_desc_interior').val(data.incremento_descuento_interior);
			$('#cant_inc_desc_interior').val(data.cant_incremento_descuento_interior);
		}
		else{
			$('.txt_resumen.precio .precio_modulos_interior').after('<div class="inc_desc_interior"></div>');
		}
		
		if(data.ceramicas > 0){
			$('.txt_resumen.precio .inc_desc_interior').after('<div class="ceramicas">Precio cerámica: <span>' + data.ceramicas + "€</span></div>");
		}
		else{
			$('.txt_resumen.precio .inc_desc_interior').after('<div class="ceramicas"></div>');
		}
		
		if(data.precio_accesorios_interior > 0){
			$('.txt_resumen.precio .ceramicas').after('<div class="precio_accesorios_interior">Precio accesorios: <span>' + data.precio_accesorios_interior + '€</span></div>');
			$('#precio_accesorios_interior').val(data.precio_accesorios_interior);
		}
		else{
			$('.txt_resumen.precio .ceramicas').after('<div class="precio_accesorios_interior"></div>');
		}
		
		$('.txt_resumen.precio .precio_accesorios_interior').after('<div class="iva">I.V.A.: <span>' + data.iva + "€</span></div>");
		$('#iva').val(data.iva);
		
		$('.txt_resumen.precio .iva').after('<div class="precio_total"><b>PRECIO TOTAL: <span>' + (parseFloat(data.total)+parseFloat(data.iva)).toFixed(2) + "€</span></b></div>");
		$('#precio_total').val((parseFloat(data.total)+parseFloat(data.iva)).toFixed(2));
		
		$('.referencia_proyecto').html(data.referencia);
		
	}, "json");
	
}

// ACTUALIZA LOS EXTRAS EN EL RESUMEN
function actualizar_extras(){
	var txt_extras = "";
	
	if($('#tapetas_1').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#tapetas_1').parent('label').html()+'</div>';
	}
	if($('#tapetas_2').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#tapetas_2').parent('label').html()+'</div>';
	}
	if($('#laterales_1').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#laterales_1').parent('label').html()+'</div>';
	}
	if($('#laterales_2').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#laterales_2').parent('label').html()+'</div>';
	}
	if($('#sistema_frenos').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#sistema_frenos').parent('label').html()+'</div>';
	}
	if($('#regleta_led').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#regleta_led').parent('label').html()+'</div>';
	}
	if($('#frente_abuardillado').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#frente_abuardillado').parent('label').html()+'</div>';
	}
	if($('#costados_1').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#costados_1').parent('label').html()+'</div>';
	}
	if($('#costados_2').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#costados_2').parent('label').html()+'</div>';
	}
	if($('#costados_3').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#costados_3').parent('label').html()+'</div>';
	}
	if($('#fijos').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#fijos').parent('label').html()+'</div>';
	}
	if($('#montaje_frente').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#montaje_frente').parent('label').html()+'</div>';
	}
	if($('#rematar_frente').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#rematar_frente').parent('label').html()+'</div>';
	}
	if($('#juego_led').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#juego_led').parent('label').html()+'</div>';
	}
	if($('#montaje_interior').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#montaje_interior').parent('label').html()+'</div>';
	}
	if($('#rematar_interior').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#rematar_interior').parent('label').html()+'</div>';
	}
	if($('#desmontajes_frentes_1').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#desmontajes_frentes_1').parent('label').html()+'</div>';
	}
	if($('#desmontajes_frentes_2').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#desmontajes_frentes_2').parent('label').html()+'</div>';
	}
	if($('#desmontajes_frentes_3').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#desmontajes_frentes_3').parent('label').html()+'</div>';
	}
	if($('#desmontajes_interiores_1').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#desmontajes_interiores_1').parent('label').html()+'</div>';
	}
	if($('#desmontajes_interiores_2').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#desmontajes_interiores_2').parent('label').html()+'</div>';
	}
	if($('#desmontajes_interiores_3').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#desmontajes_interiores_3').parent('label').html()+'</div>';
	}
	if($('#albanileria_con').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#albanileria_con').parent('label').html()+'</div>';
	}
	if($('#albanileria_sin').is(':checked')){
		txt_extras += '<div class="item_resumen_extras">'+$('#albanileria_sin').parent('label').html()+'</div>';
	}
	
	$('.txt_resumen.extras').html(txt_extras);
	$('.txt_resumen.extras input').remove();
}


// RECALCULAMOS EL PRECIO CON LOS EXTRAS
function recalcular_precio(){
	var tarifa = $('#tarifa').val();
	var descuento = $('#descuento').val();
	var serie = $('#serie_marcada').val();
	var num_puertas = $('#puertas_marcado').val();
	var precio_frente = $('#precio_frente').val();
	var cant_inc_desc_frente = $('#cant_inc_desc_frente').val();
	var precio_ceramica = $('#precio_ceramica').val();
	var precio_modulos_interior = $('#precio_modulos_interior').val();
	var precio_accesorios_interior = $('#precio_accesorios_interior').val();
	var cant_inc_desc_interior = $('#cant_inc_desc_interior').val();
	var tapetas = $('#tapetas_seleccionado').val();
	var laterales = $('#laterales_seleccionado').val();
	var costados = $('#costados_seleccionado').val();
	var costados_dist = $('#costados_dist').val();
	var fijos = $('#fijos_seleccionado').val();
	var fijos_dist = $('#fijos_dist').val();
	var montaje_frente = $('#montaje_frente_seleccionado').val();
	var montaje_frente_dist = $('#montaje_frente_dist').val();
	var montaje_frente_arjomy = $('#montaje_frente_arjomy_seleccionado').val();
	var montaje_interior = $('#montaje_interior_seleccionado').val(); 
	var montaje_interior_dist = $('#montaje_interior_dist').val();
	var montaje_interior_arjomy = $('#montaje_interior_arjomy_seleccionado').val(); 
	var desmontaje_frente = $('#desmontaje_frente_seleccionado').val();
	var desmontaje_frente_dist = $('#desmontajes_frentes_dist').val();
	var desmontaje_frente_arjomy = $('#desmontaje_frente_arjomy_seleccionado').val();
	var desmontaje_interior = $('#desmontaje_interior_seleccionado').val();
	var desmontaje_interior_dist = $('#desmontajes_interiores_dist').val();
	var desmontaje_interior_arjomy = $('#desmontaje_interior_arjomy_seleccionado').val();
	var medidas_ancho = $('#medidas_ancho').val();
	var juego_led = $('#juego_led_seleccionado').val();
	var juego_led_dist = $('#juego_led_dist').val();
	var juego_led_arjomy = $('#juego_led_arjomy_seleccionado').val();
	var rematar_frente = $('#rematar_frente_seleccionado').val();
	var rematar_frente_dist = $('#rematar_frente_dist').val();
	var rematar_frente_arjomy = $('#rematar_frente_arjomy_seleccionado').val();
	var rematar_interior = $('#rematar_interior_seleccionado').val();
	var sistema_frenos = $('#sistema_frenos_seleccionado').val();
	var sistema_frenos_dist = $('#sistema_frenos_dist').val();
	var regleta_led = $('#regleta_led_seleccionado').val();
	var frente_abuardillado = $('#frente_abuardillado_seleccionado').val();
	var albanileria_con = $('#albanileria_con_seleccionado').val();
	var albanileria_sin = $('#albanileria_sin_seleccionado').val();
		
	$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'recalcular_precio', medidas_ancho:medidas_ancho, tarifa:tarifa, descuento:descuento, serie:serie, num_puertas:num_puertas, precio_frente:precio_frente, cant_inc_desc_frente:cant_inc_desc_frente, precio_ceramica:precio_ceramica, precio_modulos_interior:precio_modulos_interior, precio_accesorios_interior:precio_accesorios_interior, cant_inc_desc_interior:cant_inc_desc_interior, tapetas:tapetas, laterales:laterales, costados:costados, fijos:fijos, montaje_frente:montaje_frente, montaje_interior:montaje_interior, desmontaje_frente:desmontaje_frente, desmontaje_interior:desmontaje_interior, desmontaje_interior_arjomy:desmontaje_interior_arjomy, juego_led:juego_led, rematar_frente:rematar_frente, rematar_interior:rematar_interior, sistema_frenos:sistema_frenos, costados_dist:costados_dist, fijos_dist:fijos_dist, montaje_frente_dist:montaje_frente_dist, montaje_frente_arjomy:montaje_frente_arjomy, montaje_interior_dist:montaje_interior_dist, montaje_interior_arjomy:montaje_interior_arjomy, desmontaje_frente_dist:desmontaje_frente_dist, desmontaje_frente_arjomy:desmontaje_frente_arjomy, desmontaje_interior_dist:desmontaje_interior_dist, juego_led_dist:juego_led_dist, juego_led_arjomy:juego_led_arjomy, rematar_frente_dist:rematar_frente_dist, rematar_frente_arjomy:rematar_frente_arjomy, sistema_frenos_dist:sistema_frenos_dist, regleta_led:regleta_led, frente_abuardillado:frente_abuardillado, albanileria_con:albanileria_con, albanileria_sin:albanileria_sin }, function(data){
		
		$('.txt_resumen.precio').html('<div class="precio_frente">Precio frente: <span>' + data.precio_frente + '€</span></div>');
				
		if(data.cant_incremento_descuento != 0){
			$('.txt_resumen.precio .precio_frente').after('<div class="inc_desc_frente">' + $('#inc_desc_frente').val() + ": <span>" + data.cant_incremento_descuento + "€</span></div>");
		}
		else{
			$('.txt_resumen.precio .precio_frente').after('<div class="inc_desc_frente"></div>');
		}
		
		if(data.precio_modulos_interior > 0){
			$('.txt_resumen.precio .inc_desc_frente').after('<div class="precio_modulos_interior">Precio interior: <span>' + data.precio_modulos_interior + '€</span></div>');
			$('#precio_modulos_interior').val(data.precio_modulos_interior);
		}
		else{
			$('.txt_resumen.precio .inc_desc_frente').after('<div class="precio_modulos_interior"></div>');
		}
		
		if(data.cant_incremento_descuento_interior != 0){
			$('.txt_resumen.precio .precio_modulos_interior').after('<div class="inc_desc_interior">' + $('#inc_desc_interior').val() + ": <span>" + data.cant_incremento_descuento_interior + "€</span></div>");
		}
		else{
			$('.txt_resumen.precio .precio_modulos_interior').after('<div class="inc_desc_interior"></div>');
		}
		
		if(data.precio_accesorios_interior > 0){
			$('.txt_resumen.precio .inc_desc_interior').after('<div class="precio_accesorios_interior">Precio accesorios: <span>' + data.precio_accesorios_interior + '€</span></div>');
			$('#precio_accesorios_interior').val(data.precio_accesorios_interior);
		}
		else{
			$('.txt_resumen.precio .inc_desc_interior').after('<div class="precio_accesorios_interior"></div>');
		}
		
		if(data.precio_sistema_frenos > 0){
			$('.txt_resumen.precio .precio_accesorios_interior').after('<div class="precio_sistema_frenos">Precio sistema frenos: <span>' + data.precio_sistema_frenos + '€</span></div>');
			$('#precio_sistema_frenos').val(data.precio_sistema_frenos);
		}
		else{
			$('.txt_resumen.precio .precio_accesorios_interior').after('<div class="precio_sistema_frenos"></div>');
			$('#precio_sistema_frenos').val(0);
			$('#precio_sistema_frenos_dist').val(0);
		}
		
		if(data.precio_regleta_led > 0){
			$('.txt_resumen.precio .precio_sistema_frenos').after('<div class="precio_regleta_led">Precio regletas led: <span>' + data.precio_regleta_led + '€</span></div>');
			$('#precio_regleta_led').val(data.precio_regleta_led);
		}
		else{
			$('.txt_resumen.precio .precio_sistema_frenos').after('<div class="precio_regleta_led"></div>');
			$('#precio_regleta_led').val(0);
		}
		
		if(data.precio_frente_abuardillado > 0){
			$('.txt_resumen.precio .precio_regleta_led').after('<div class="precio_frente_abuardillado">Precio frente abuardillado: <span>' + data.precio_frente_abuardillado + '€</span></div>');
			$('#precio_frente_abuardillado').val(data.precio_frente_abuardillado);
		}
		else{
			$('.txt_resumen.precio .precio_regleta_led').after('<div class="precio_frente_abuardillado"></div>');
			$('#precio_frente_abuardillado').val(0);
		}
		
		if(data.precio_costados > 0){
			$('.txt_resumen.precio .precio_frente_abuardillado').after('<div class="precio_costados">Precio costados: <span>' + data.precio_costados + '€</span></div>');
			$('#precio_costados').val(data.precio_costados);
		}
		else{
			$('.txt_resumen.precio .precio_frente_abuardillado').after('<div class="precio_costados"></div>');
			$('#precio_costados').val(0);
			$('#precio_costados_dist').val(0);
		}
		
		if(data.precio_fijos > 0){
			$('.txt_resumen.precio .precio_costados').after('<div class="precio_fijos">Precio fijos: <span>' + data.precio_fijos + '€</span></div>');
			$('#precio_fijos').val(data.precio_fijos);
		}
		else{
			$('.txt_resumen.precio .precio_costados').after('<div class="precio_fijos"></div>');
			$('#precio_fijos').val(0);
			$('#precio_fijos_dist').val(0);
		}
		
		if($('#rematar_frente').is(':checked')){
			$('.txt_resumen.precio .precio_fijos').after('<div class="precio_rematar_frente">Precio rematar frente: <span>' + data.precio_rematar_frente + '€</span></div>');
			$('#precio_rematar_frente').val(data.precio_rematar_frente);
		}
		else{
			$('.txt_resumen.precio .precio_fijos').after('<div class="precio_rematar_frente"></div>');
			$('#precio_rematar_frente').val(0);
			$('#precio_rematar_frente_dist').val(0);
		}
		
		if($('#juego_led').is(':checked')){
			$('.txt_resumen.precio .precio_rematar_frente').after('<div class="precio_juego_led">Precio juego led: <span>' + data.precio_juego_led + '€</span></div>');
			$('#precio_juego_led').val(data.precio_juego_led);
		}
		else{
			$('.txt_resumen.precio .precio_rematar_frente').after('<div class="precio_juego_led"></div>');
			$('#precio_juego_led').val(0);
			$('#precio_juego_led_dist').val(0);
		}
		
		if($('#rematar_interior').is(':checked')){
			$('.txt_resumen.precio .precio_juego_led').after('<div class="precio_rematar_interior">Precio rematar interior: <span>' + data.precio_rematar_interior + '€</span></div>');
			$('#precio_rematar_interior').val(data.precio_rematar_interior);
		}
		else{
			$('.txt_resumen.precio .precio_juego_led').after('<div class="precio_rematar_interior"></div>');
			$('#precio_rematar_interior').val(0);
		}
		
		$('.txt_resumen.precio .precio_rematar_interior').after('<div class="precio_montaje">Precio montaje: <span>' + data.precio_montaje + '€</span></div>');
		$('#precio_montaje_frente').val(data.precio_montaje);
		
		if($('#desmontajes_frentes_1').is(':checked') || $('#desmontajes_frentes_2').is(':checked') || $('#desmontajes_frentes_3').is(':checked')){
			$('.txt_resumen.precio .precio_montaje').after('<div class="precio_desmontaje_frente">Precio desmontaje frente: <span>' + data.precio_desmontaje_frente + '€</span></div>');
			$('#precio_desmontaje_frente').val(data.precio_desmontaje_frente);
		}
		else{
			$('.txt_resumen.precio .precio_montaje').after('<div class="precio_desmontaje_frente"></div>');
			$('#precio_desmontaje_frente').val(0);
			$('#precio_desmontaje_frente_dist').val(0);
		}
		
		if($('#desmontajes_interiores_1').is(':checked') || $('#desmontajes_interiores_2').is(':checked') || $('#desmontajes_interiores_3').is(':checked')){
			$('.txt_resumen.precio .precio_desmontaje_frente').after('<div class="precio_desmontaje_interior">Precio desmontaje interior: <span>' + data.precio_desmontaje_interior + '€</span></div>');
			$('#precio_desmontaje_interior').val(data.precio_desmontaje_interior);
			$('#precio_desmontaje_interior_dist').val(data.precio_desmontaje_interior_dist);
		}
		else{
			$('.txt_resumen.precio .precio_desmontaje_frente').after('<div class="precio_desmontaje_interior"></div>');
			$('#precio_desmontaje_interior').val(0);
			$('#precio_desmontaje_interior_dist').val(0);
		}
		
		if(data.precio_albanileria_con > 0){
			$('.txt_resumen.precio .precio_desmontaje_interior').after('<div class="precio_albanileria_con">Precio albañilería con solera: <span>' + data.precio_albanileria_con + '€</span></div>');
			$('#precio_albanileria_con').val(data.precio_albanileria_con);
		}
		else{
			$('.txt_resumen.precio .precio_desmontaje_interior').after('<div class="precio_albanileria_con"></div>');
			$('#precio_albanileria_con').val(0);
		}
		
		if(data.precio_albanileria_sin > 0){
			$('.txt_resumen.precio .precio_albanileria_con').after('<div class="precio_albanileria_sin">Precio albañilería sin solera: <span>' + data.precio_albanileria_sin + '€</span></div>');
			$('#precio_albanileria_sin').val(data.precio_albanileria_sin);
		}
		else{
			$('.txt_resumen.precio .precio_albanileria_con').after('<div class="precio_albanileria_sin"></div>');
			$('#precio_albanileria_sin').val(0);
		}
		
		
		$('.txt_resumen.precio .precio_albanileria_sin').after('<div class="iva">I.V.A.: <span>' + data.iva + "€</span></div>");
		$('#iva').val(data.iva);
		
		$('.txt_resumen.precio .iva').after('<div class="precio_total"><b>PRECIO TOTAL: <span>' + (parseFloat(data.total)+parseFloat(data.iva)).toFixed(2) + "€</span></b></div>");
		$('#precio_total').val((parseFloat(data.total)+parseFloat(data.iva)).toFixed(2));
		
		$('.referencia_proyecto').html(data.referencia+"<br />"+data.referencia_2);
		
	}, "json");
}

// APLICAMOS DESCUENTO AL CLIENTE
function aplicar_descuento(){
	var cantidad_descuento_aplicado = $('#descuento_cliente').val();
	var aplicar_descuento = $('#aplicar_descuento_cliente').val();
	var precio_total = $('#precio_total').val();                             
	var iva = $('#iva').val();
	var precio_frente = $('#precio_frente').val();
	var cant_inc_desc_frente = $('#cant_inc_desc_frente').val();
	var precio_ceramica = $('#precio_ceramica').val();
	var precio_modulos_interior = $('#precio_modulos_interior').val();
	var precio_accesorios_interior = $('#precio_accesorios_interior').val();
	var cant_inc_desc_interior = $('#cant_inc_desc_interior').val();
	var precio_tapetas = $('#precio_tapetas').val();
	var precio_laterales = $('#precio_laterales').val();
	var precio_costados_dist = $('#precio_costados_dist').val();
	var precio_fijos_dist = $('#precio_fijos_dist').val();
	var precio_montaje_frente_dist = $('#precio_montaje_frente_dist').val(); 
	var precio_montaje_interior_dist = $('#precio_montaje_interior_dist').val();
	var precio_desmontaje_frente_dist = $('#precio_desmontaje_frente_dist').val();
	var precio_desmontaje_interior_dist = $('#precio_desmontaje_interior_dist').val();
	var precio_juego_led_dist = $('#precio_juego_led_dist').val();
	var precio_rematar_frente_dist = $('#precio_rematar_frente_dist').val();
	var precio_sistema_frenos_dist = $('#precio_sistema_frenos_dist').val();	
			
	$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'aplicar_descuento', cantidad_descuento_aplicado:cantidad_descuento_aplicado, aplicar_descuento:aplicar_descuento, precio_total:precio_total, iva:iva,  precio_frente:precio_frente, cant_inc_desc_frente:cant_inc_desc_frente, precio_ceramica:precio_ceramica, precio_modulos_interior:precio_modulos_interior, precio_accesorios_interior:precio_accesorios_interior, cant_inc_desc_interior:cant_inc_desc_interior, precio_tapetas:precio_tapetas, precio_laterales:precio_laterales, precio_costados_dist:precio_costados_dist, precio_fijos_dist:precio_fijos_dist, precio_montaje_frente_dist:precio_montaje_frente_dist, precio_montaje_interior_dist:precio_montaje_interior_dist, precio_desmontaje_frente_dist:precio_desmontaje_frente_dist, precio_desmontaje_interior_dist:precio_desmontaje_interior_dist, precio_juego_led_dist:precio_juego_led_dist, precio_rematar_frente_dist:precio_rematar_frente_dist, precio_sistema_frenos_dist:precio_sistema_frenos_dist }, function(data){
				
		if(data.cantidad_descuento > 0){
			if($('.txt_resumen.precio .descuento_cliente').length){
				$('.txt_resumen.precio .descuento_cliente').html('Descuento del ' + aplicar_descuento + '%: <span>-' + data.cantidad_descuento + '€</span>');
			}	
			else{
				$('.txt_resumen.precio .iva').before('<div class="descuento_cliente">Descuento del ' + aplicar_descuento + '%: <span>-' + data.cantidad_descuento + '€</span></div>');
			}
			$('#aplicar_descuento').val(aplicar_descuento);
			$('#descuento_cliente').val(data.cantidad_descuento);
		}
		else{
			if($('.txt_resumen.precio .descuento_cliente').length){
				$('.txt_resumen.precio .descuento_cliente').html('');
			}
			else{
				$('.txt_resumen.precio .iva').before('<div class="descuento_cliente"></div>');
			}
			$('#aplicar_descuento').val(0);
			$('#descuento_cliente').val(0);
		}
		
		$('.txt_resumen.precio .iva span').html(data.cantidad_iva + "€");
		$('#iva').val(data.cantidad_iva);
		
		$('.txt_resumen.precio .precio_total span').html((parseFloat(data.precio_con_descuento)+parseFloat(data.cantidad_iva)).toFixed(2) + "€");
		$('#precio_total').val((parseFloat(data.precio_con_descuento)+parseFloat(data.cantidad_iva)).toFixed(2));
		
	}, "json");
}

// PREGUNTAMOS POR LOS DATOS DEL CLIENTE AL QUE SE LE HACE EL PRESUPUESTO
function datos_cliente(){

	// PRIMERO APLICAMOS EL DESCUENTO MARCADO
	//aplicar_descuento();

	$.magnificPopup.open({
		items: {
			src: '.datos_cliente',
			type: 'inline'
		},
		focus: '#nombre'
	});

}

// GUARDAMOS TODO EL PROYECTO
function actualizar_proyecto(){
	
	// SE ENVÍA EL FORMULARIO GENERAL POR AJAX. LA RESPUESTA SE RECIBE EN JSON
	$.post( "index.php", $("#form_proyecto").serialize(), function(data){
		if(data.estado == "ok"){// SI SE GUARDA CORRECTAMENTE SE INDICA EN UN MENSAJE Y SE CARGA EL PROYECTO
			$(".respuesta").html("<i class='fa fa-check'></i> Guardado correctamente");
			// CARGAMOS EL NUEVO PROYECTO
			location.href ="index.php?seccion=usuarios&sub=ver_proyecto&id="+data.mensaje;
		}
		else{ // SI HAY UN ERROR SE MUESTRA
			$(".respuesta").html("");
			alert(data.mensaje);
		}
	}, "json");
	
}



// CONFIRMACIÓN PARA CUANDO SE PULSA EN VOLVER O EN LA BARRA DE PROGRESO
function volver_proyecto(paso){
	
	// SOLO SI EL BOTÓN ATRAS ESTÁ ACTIVO
	if(!$('.botones_navegacion .boton_volver').hasClass('inactivo')){
			
			$.magnificPopup.open({
				items: {
					src: 'index.php?seccion=ajax&sub=nuevo_proyecto&ac=volver&id='+paso
				},
				type: 'ajax'
			});
			
	}
	
}

// CUANDO SE PULSA EN LA BARRA DE PROGRESO
function volver_progreso(nombre,paso){

	if($('.item_progreso.'+nombre).hasClass('pasado')){
		
		volver_proyecto(paso);
		
	}

}

// MUESTRA LA IMAGEN DE DETALLE DE LA SERIE EN EL POPUP
function mostrar_imagen_detalle(){
	
	$('.imagen_full').slideToggle();
	$('.imagen_detalle').slideToggle();
	
}

// VALIDA QUE SOLO SE ESCRIBAN NÚMEROS
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, flechas, tab, ... , siempre la permite
    if (tecla == 8 || tecla==0 || tecla==9)
		return true;
        
    // Patron de entrada, en este caso solo acepta numeros y punto
    patron =/[0-9.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}


// MUESTRA U OCULTA LOS CAMPOS DE CONTRASEÑA AL EDITAR LOS DATOS DE UNA EMPRESA
function mostrar_pass(){
	if($(".item_pass").is(":visible")){
		$(".item_pass").hide();
		$("#camibar_pass").val(0);
	}
	else{
		$(".item_pass").show();
		$("#camibar_pass").val(1);
	}
}

// CUANDO SE PULSA EL BOTÓN DE CONTINUAR EN UN NUEVO PROYECTO
function continuar_proyecto(paso,paso_actual){
	
	if(!$('.botones_navegacion a').hasClass('inactivo') || paso <= paso_actual){
		switch(paso){
			case 1: //(SERIE)
				$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'serie' }, function(data){
				
					// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
					$('.contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_extras, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP
					
						// SE CARGA EL CONTENIDO DE PASO 1 
						$('.contenedor_seccion_serie').html(data);
						
						// SE MARCA EL PASO 1 COMO ACTUAL
						$('.item_progreso.serie').addClass('actual');
						// SE DESMARCAN EL RESTO DE PASOS
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.extras, .item_progreso.interior, .item_progreso.finalizar').removeClass('pasado');
						$('.item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('actual');
						
						// Mostramos el botón continuar y ocultamos el guardar
						$('.botones_navegacion .boton_continuar').show();
						$('.botones_resumen .boton_guardar').addClass('inactivo');
						$('.botones_resumen .boton_guardar').attr('onClick','');
						// SE DESACTIVAN LOS BOTONES DE NAVEGACIÓN
						$('.botones_navegacion a').addClass('inactivo');
						
						// EL BOTÓN CONTINUAR LLEVARÁ AL PASO 2
						$('.botones_navegacion .boton_continuar').attr('onClick','continuar_proyecto(2,1);');
						
						// SE RECARGA EL DOCUMENT READY
						inicializar();
						
						// CUANDO SE HAGA CLICK EN LA IMAGEN DE UNA SERIE
						$('#proyecto .seccion_serie .item_seccion_serie').on('click', 'img', function (){
							var id_serie = $(this).attr("id_serie");
							var nombre_serie = $(this).attr("nombre_serie");
							
							// La ponemos como marcada
							$('#proyecto .seccion_serie .item_seccion_serie img').removeClass('marcada');
							$(this).addClass('marcada');
							
							// Ponemos la serie en el resumen
							if(id_serie != 0){ // Si no es solo interior
								$('.txt_resumen.serie').html(nombre_serie+' <a class="ajax-popup-link" href="index.php?seccion=ajax&sub=detalles_serie&id='+id_serie+'"><i class="fa fa-info-circle"></i></a>');
								inicializar();
							}
							else{
								$('.txt_resumen.serie').html(nombre_serie);
							}
							
							// Ponemos el id en el formulario que se pasará al siguiente paso
							$('#serie_marcada').val(id_serie);
							
							// Activamos los botones de navegación
							$('.botones_navegacion a').removeClass('inactivo');
						});
						
						// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO
						$('.txt_resumen.serie, .txt_resumen.acabado, .txt_resumen.perfileria, .txt_resumen.medidas, .txt_resumen.puertas, .txt_resumen.diseno, .txt_resumen.colores, .txt_resumen.interior, .txt_resumen.extras, .txt_resumen.precio').html('-');
						$('.referencia_proyecto').html('');
						// Y DEL FORMULARIO GENERAL
						$('#serie_marcada, #acabado_marcado, #perfileria_marcada, #medidas_ancho, #medidas_alto, #medidas_fondo, #puertas_marcado, #diseno_puerta_1, #diseno_puerta_2, #diseno_puerta_3, #diseno_puerta_4, #diseno_puerta_5, #diseno_puerta_6, #diseno_puerta_7, #diseno_puerta_8, #ceramica_puerta_1, #ceramica_puerta_2, #ceramica_puerta_3, #ceramica_puerta_4, #ceramica_puerta_5, #ceramica_puerta_6, #ceramica_puerta_7, #ceramica_puerta_8, #colores_puerta_1, #colores_puerta_2, #colores_puerta_3, #colores_puerta_4, #colores_puerta_5, #colores_puerta_6, #colores_puerta_7, #colores_puerta_8, #modulos_interior, #interior_puerta_1, #interior_puerta_2, #interior_puerta_3, #interior_puerta_4, #interior_puerta_5, #interior_puerta_6, #interior_puerta_7, #interior_puerta_8, #laterales_seleccionado, #tapetas_seleccionado, #costados_seleccionado, #fijos_seleccionado, #montaje_frente_seleccionado, #montaje_frente_arjomy_seleccionado, #montaje_interior_seleccionado, #montaje_interior_arjomy_seleccionado, #desmontaje_frente_seleccionado, #desmontaje_frente_arjomy_seleccionado, #desmontaje_interior_seleccionado, #desmontaje_interior_arjomy_seleccionado, #juego_led_seleccionado, #juego_led_arjomy_seleccionado, #rematar_frente_seleccionado, #rematar_frente_arjomy_seleccionado, #rematar_interior_seleccionado, #sistema_frenos_seleccionado, #albanileria_con_seleccionado, #albanileria_sin_seleccionado, #frente_abuardillado_seleccionado, #regleta_led_seleccionado, #precio_frente, #inc_desc_frente, #cant_inc_desc_frente, #precio_ceramica, #precio_modulos_interior, #precio_accesorios_interior, #inc_desc_interior, #cant_inc_desc_interior, #precio_tapetas, #precio_laterales, #precio_costados, #precio_costados_dist, #precio_fijos, #precio_fijos_dist, #precio_montaje_frente, #precio_montaje_frente_dist, #precio_montaje_interior, #precio_montaje_interior_dist, #precio_desmontaje_frente, #precio_desmontaje_frente_dist, #precio_desmontaje_interior, #precio_desmontaje_interior_dist, #precio_juego_led, #precio_juego_led_dist, #precio_rematar_frente, #precio_rematar_frente_dist, #precio_rematar_interior, #precio_sistema_frenos, #precio_sistema_frenos_dist, #precio_regleta_led, #precio_frente_abuardillado, #precio_albanileria_con, #precio_albanileria_sin, #aplicar_descuento, #descuento_cliente, #iva, #precio_total').val('');
						
						// SE MUESTRA EL CONTENIDO DEL PASO 1
						$('.contenedor_seccion_serie').slideDown('slow');
				
					});
					
				});
				break;
			case 2: //(acabado)
				if($('#serie_marcada').val() == 0){ // Si ha marcado solo interior salta al paso 4. Medidas
					continuar_proyecto(4,1);
				}
				else{
					$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'acabado', id_serie:$('#serie_marcada').val() }, function(data){
						
						// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
						$('.contenedor_seccion_serie, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_extras, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

							// SE CARGA EL CONTENIDO DE PASO 2
							$('.contenedor_seccion_acabado').html(data);
							// SE MARCA EL PASO 1 COMO PASADO
							$('.item_progreso.serie').removeClass('actual');
							$('.item_progreso.serie').addClass('pasado');
							// SE MARCA EL PASO 2 COMO ACTUAL
							$('.item_progreso.acabado').addClass('actual');
							// SE DESMARCAN EL RESTO DE PASOS
							$('.item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('pasado');
							$('.item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('actual');
							
							
							// Mostramos el botón continuar y ocultamos el guardar
							$('.botones_navegacion .boton_continuar').show();
							$('.botones_resumen .boton_guardar').addClass('inactivo');
							$('.botones_resumen .boton_guardar').attr('onClick','');
							// Desactivamos el botón Continuar y le cambiamos el onClick para que vaya al paso 3
							$('.botones_navegacion .boton_continuar').addClass('inactivo');
							$('.botones_navegacion .boton_continuar').attr('onClick','continuar_proyecto(3,2);');
							// Botón volver llevará al paso uno
							$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(1);');
							
							// CUANDO SE HAGA CLICK EN LA IMAGEN DE UN acabado
							$('#proyecto .seccion_acabado .item_seccion_acabado').on('click', 'img', function (){
								var id_acabado = $(this).attr("id_acabado");
								var nombre_acabado = $(this).attr("nombre_acabado");
								
								// La ponemos como marcada
								$('#proyecto .seccion_acabado .item_seccion_acabado img').removeClass('marcada');
								$(this).addClass('marcada');
								
								// Ponemos el acabado en el resumen
								$('.txt_resumen.acabado').html(nombre_acabado);
								
								// Ponemos el id en el formulario que se pasará al siguiente paso
								$('#acabado_marcado').val(id_acabado);
								
								// Activamos el botón Continuar
								$('.botones_navegacion .boton_continuar').removeClass('inactivo');
							});
							
							// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO A PARTIR DEL PASO 1
							$('.referencia_proyecto').html('');
							$('.txt_resumen.acabado, .txt_resumen.perfileria, .txt_resumen.medidas, .txt_resumen.puertas, .txt_resumen.diseno, .txt_resumen.colores, .txt_resumen.interior, .txt_resumen.extras, .txt_resumen.precio').html('-');
							// Y DEL FORMULARIO GENERAL
							$('#acabado_marcado').val('');
							
							// SE MUESTRA EL CONTENIDO DEL PASO 2
							$('.contenedor_seccion_acabado').slideDown('slow');
						});
						
					});
				}
				break;
				
			case 3: //(PERFILERÍA)
				if($('#serie_marcada').val() == 0){ // Si ha marcado solo interior salta al paso 4. Medidas
					continuar_proyecto(4,1);
				}
				else{
					$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'perfileria', id_serie:$('#serie_marcada').val(), id_acabado:$('#acabado_marcado').val() }, function(data){
						
						// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
						$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_extras, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

							// SE CARGA EL CONTENIDO DE PASO 3
							$('.contenedor_seccion_perfileria').html(data);
							// SE MARCAN LOS PASOS PASADOS
							$('.item_progreso.serie, .item_progreso.acabado').removeClass('actual');
							$('.item_progreso.serie, .item_progreso.acabado').addClass('pasado');
							// SE MARCA EL PASO 3 COMO ACTUAL
							$('.item_progreso.perfileria').addClass('actual');
							// SE DESMARCAN EL RESTO DE PASOS
							$('.item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('pasado');
							$('.item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('actual');
							
							// Mostramos el botón continuar y ocultamos el guardar
							$('.botones_navegacion .boton_continuar').show();
							$('.botones_resumen .boton_guardar').addClass('inactivo');
							$('.botones_resumen .boton_guardar').attr('onClick','');
							// Desactivamos el botón Continuar y le cambiamos el onClick para que vaya al paso 4
							$('.botones_navegacion .boton_continuar').addClass('inactivo');
							$('.botones_navegacion .boton_continuar').attr('onClick','continuar_proyecto(4,3);');
							// Botón volver llevará al paso 2
							$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(2);');
							
							// CUANDO SE HAGA CLICK EN LA IMAGEN DE UN COLOR
							$('#proyecto .seccion_perfileria .item_seccion_perfileria').on('click', 'img', function (){
								var id_perfileria = $(this).attr("id_perfileria");
								var nombre_perfileria = $(this).attr("nombre_perfileria");
								var imagen_perfileria = $(this).attr("src");
								
								// La ponemos como marcada
								$('#proyecto .seccion_perfileria .item_seccion_perfileria img').removeClass('marcada');
								$(this).addClass('marcada');
								
								// Ponemos el color en el resumen
								$('.txt_resumen.perfileria').html(nombre_perfileria+'<br /><img src="'+imagen_perfileria+'" title="'+nombre_perfileria+'" />');
								
								// Ponemos el id en el formulario que se pasará al siguiente paso
								$('#perfileria_marcada').val(id_perfileria);
								
								// Activamos el botón Continuar
								$('.botones_navegacion .boton_continuar').removeClass('inactivo');
							});
							
							// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO A PARTIR DEL PASO 2
							$('.referencia_proyecto').html('');
							$('.txt_resumen.perfileria, .txt_resumen.medidas, .txt_resumen.puertas, .txt_resumen.diseno, .txt_resumen.colores, .txt_resumen.interior, .txt_resumen.extras, .txt_resumen.precio').html('-');
							// Y DEL FORMULARIO GENERAL
							$('#perfileria_marcada').val('');
							
							// SE MUESTRA EL CONTENIDO DEL PASO 3
							$('.contenedor_seccion_perfileria').slideDown('slow');
						});
						
					});
				}
				break;
			
			case 4: //(MEDIDAS)
				$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'medidas', id_serie:$('#serie_marcada').val(), id_acabado:$('#acabado_marcado').val() }, function(data){
					
					// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
					$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_extras, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

						// SE CARGA EL CONTENIDO DE PASO 4
						$('.contenedor_seccion_medidas').html(data);
						// SE MARCAN LOS PASOS PASADOS
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria').removeClass('actual');
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria').addClass('pasado');
						// SE MARCA EL PASO 4 COMO ACTUAL
						$('.item_progreso.medidas').addClass('actual');
						// SE DESMARCAN EL RESTO DE PASOS
						$('.item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('pasado');
						$('.item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('actual');
						
						// Mostramos el botón continuar y ocultamos el guardar
						$('.botones_navegacion .boton_continuar').show();
						$('.botones_resumen .boton_guardar').addClass('inactivo');
						$('.botones_resumen .boton_guardar').attr('onClick','');
						// Desactivamos el botón Continuar y le cambiamos el onClick para que vaya al paso 5
						$('.botones_navegacion .boton_continuar').addClass('inactivo');
						$('.botones_navegacion .boton_continuar').attr('onClick','envio();'); // SE LE PASA EL PASO ACTUAL PARA VER SI VIENE DEL 1 O DEL 3.
						// Botón volver llevará al paso 3
						if($('#serie_marcada').val() == 0){ // SI ES SOLO INTERIOR VOLVER LLEVARÁ AL PUNTO 1
							$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(1);');
						}
						else{ // SI ES UN FRENTE VOLVER LLEVARÁ AL PUNTO 3
							$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(3);');
						}
						
						// CUANDO SE CAMBIEN LAS MEDIDAS
						$('#proyecto .seccion_medidas .item_seccion_medidas.ancho, #proyecto .seccion_medidas .item_seccion_medidas.alto, #proyecto .seccion_medidas .item_seccion_medidas.fondo').on('input', 'input', function (e){
														
							var ancho = $('#proyecto .seccion_medidas .item_seccion_medidas.ancho input').val();
							var alto = $('#proyecto .seccion_medidas .item_seccion_medidas.alto input').val();
							var fondo = $('#proyecto .seccion_medidas .item_seccion_medidas.fondo input').val();

							// Ponemos las medidas en el resumen
							$('.txt_resumen.medidas').html('Alto: ' + alto + ' cm.<br />Ancho: ' + ancho + ' cm.<br />Fondo: ' + fondo + ' cm.');
							
							// Ponemos las medidas en el formulario que se pasará al siguiente paso
							$('#medidas_ancho').val(ancho);
							$('#medidas_alto').val(alto);
							$('#medidas_fondo').val(fondo);
							
							if($('#proyecto .seccion_medidas .item_seccion_medidas.ancho input').val() > 0 && $('#proyecto .seccion_medidas .item_seccion_medidas.alto input').val() > 0){
								// Activamos el botón Continuar
								$('.botones_navegacion .boton_continuar').removeClass('inactivo');
							}else{
								// Desactivamos el botón Continuar
								$('.botones_navegacion .boton_continuar').addClass('inactivo');
							}
										
						});
						
						// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO A PARTIR DEL PASO 3
						$('.referencia_proyecto').html('');
						$('.txt_resumen.medidas, .txt_resumen.puertas, .txt_resumen.diseno, .txt_resumen.colores, .txt_resumen.interior, .txt_resumen.extras, .txt_resumen.precio').html('-');
						// Y DEL FORMULARIO GENERAL
						$('#medidas_ancho').val('');
						$('#medidas_alto').val('');
						$('#medidas_fondo').val('');
						$('#puertas_marcado').val('');
						
						// SE MUESTRA EL CONTENIDO DEL PASO 4
						$('.contenedor_seccion_medidas').slideDown('slow');
					});
					
				});
				break;
			case 5: //(PUERTAS)
				$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'puertas', id_serie:$('#serie_marcada').val(), ancho:$('#medidas_ancho').val() }, function(data){
					
					// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
					$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_extras, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

						// SE CARGA EL CONTENIDO DE PASO 5
						$('.contenedor_seccion_puertas').html(data);
						// SE MARCAN LOS PASOS PASADOS
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas').removeClass('actual');
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas').addClass('pasado');
						// SE MARCA EL PASO 5 COMO ACTUAL
						$('.item_progreso.puertas').addClass('actual');
						// SE DESMARCAN EL RESTO DE PASOS
						$('.item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('pasado');
						$('.item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('actual');
						
						// Mostramos el botón continuar y ocultamos el guardar
						$('.botones_navegacion .boton_continuar').show();
						$('.botones_resumen .boton_guardar').addClass('inactivo');
						$('.botones_resumen .boton_guardar').attr('onClick','');
						// Desactivamos el botón Continuar y le cambiamos el onClick para que vaya al paso 6
						$('.botones_navegacion .boton_continuar').addClass('inactivo');
						$('.botones_navegacion .boton_continuar').attr('onClick','continuar_proyecto(6,5);');
						// Botón volver llevará al paso 4
						$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(4);');
						
						// CUANDO SE SELECCIONES EL NÚMERO DE PUERTAS
						$('#proyecto .seccion_puertas .item_seccion_puertas').on('click', 'img', function (){
							var num_puertas = $(this).attr("num_puertas");
							var imagen_puertas = $(this).attr("src");
							
							// La ponemos como marcada
							$('#proyecto .seccion_puertas .item_seccion_puertas img').removeClass('marcada');
							$(this).addClass('marcada');
							
							// Ponemos el número en el resumen
							$('.txt_resumen.puertas').html(num_puertas);
							
							// Ponemos el id en el formulario que se pasará al siguiente paso
							$('#puertas_marcado').val(num_puertas);
							
							// Activamos el botón Continuar
							$('.botones_navegacion .boton_continuar').removeClass('inactivo');
						});
						
						
						// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO A PARTIR DEL PASO 4
						$('.referencia_proyecto').html('');
						$('.txt_resumen.puertas, .txt_resumen.diseno, .txt_resumen.colores, .txt_resumen.interior, .txt_resumen.extras, .txt_resumen.precio').html('-');
						// Y DEL FORMULARIO GENERAL
						$('#puertas_marcado').val('');
						
						// SE MUESTRA EL CONTENIDO DEL PASO 5
						$('.contenedor_seccion_puertas').slideDown('slow');
					});
					
				});
				break;
			case 6: //(DISENO)
				if($('#serie_marcada').val() == 0){ // Si ha marcado solo interior salta al paso 8. Interior
					continuar_proyecto(8,5);
				}
				else{
					$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'diseno', id_serie:$('#serie_marcada').val(), num_puertas:$('#puertas_marcado').val() }, function(data){
						
						// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
						$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_extras, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

							// SE CARGA EL CONTENIDO DE PASO 6
							$('.contenedor_seccion_diseno').html(data);
							
							
							// CUANDO SE PULSE EN UNA PUERTA
							$('#proyecto .seccion_diseno .item_seccion_diseno').on('click', 'img', function (){
								var num_puerta = $(this).attr("num_puerta");
								
								cambiar_puerta(num_puerta);
								
							});
							
							
							// SE MUESTRA EL CONTENIDO DEL PASO 6
							$('.contenedor_seccion_diseno').slideDown('slow');
						});
						
						// SE MARCAN LOS PASOS PASADOS
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas').removeClass('actual');
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas').addClass('pasado');
						// SE MARCA EL PASO 6 COMO ACTUAL
						$('.item_progreso.diseno').addClass('actual');
						// SE DESMARCAN EL RESTO DE PASOS
						$('.item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('pasado');
						$('.item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('actual');
						
						// Mostramos el botón continuar y ocultamos el guardar
						$('.botones_navegacion .boton_continuar').show();
						$('.botones_resumen .boton_guardar').addClass('inactivo');
						$('.botones_resumen .boton_guardar').attr('onClick','');
						// NO Desactivamos el botón Continuar y SI le cambiamos el onClick para que vaya al paso 7
						//$('.botones_navegacion .boton_continuar').addClass('inactivo');
						$('.botones_navegacion .boton_continuar').attr('onClick','continuar_proyecto(7,6);');
						// Botón volver llevará al paso 5
						$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(5);');
						
						// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO A PARTIR DEL PASO 5
						$('.txt_resumen.diseno, .txt_resumen.colores, .txt_resumen.interior, .txt_resumen.extras, .txt_resumen.precio').html('-');
						// Y DEL FORMULARIO GENERAL
						$('#diseno_puerta_1, #diseno_puerta_2, #diseno_puerta_3, #diseno_puerta_4, #diseno_puerta_5, #diseno_puerta_6, #diseno_puerta_7, #diseno_puerta_8').val('');
						$('#ceramica_puerta_1, #ceramica_puerta_2, #ceramica_puerta_3, #ceramica_puerta_4, #ceramica_puerta_5, #ceramica_puerta_6, #ceramica_puerta_7, #ceramica_puerta_8').val('');
						
						// MOSTRAMOS EL FRENTE LISO POR DEFECTO
						serie = $('#serie_marcada').val();
						acabado = $('#acabado_marcado').val();
						diseno = 4;
						nombre_diseno = 'Liso';
						if(acabado != 3 && acabado != 5){ // SI NO ES ESTUCO
							terminacion = 1;
							nombre_terminacion = 'Todo tablero';
						}
						else{ // SI ES ESTUCO
							terminacion = 25;
							nombre_terminacion = 'Todo estuco';
						}
						puerta = 110;
						img_puerta = 'modelo_liso.jpg';
						num_puertas = $('#puertas_marcado').val();
						for(i=1; i<=num_puertas; i++){
							mostrar_puerta(i,serie, acabado, diseno, nombre_diseno, terminacion, nombre_terminacion, puerta, img_puerta);
						}
						
						// Activamos el botón Continuar
						// En esta sección está activo desde el principio porque sale un frente configurado por defecto con todo tablero liso
						$('.botones_navegacion .boton_continuar').removeClass('inactivo');
						
						calcular_precio_frente();
						
					});
				}
				break;
				
			case 7: // (COLORES)
				if($('#serie_marcada').val() == 0){ // Si ha marcado solo interior salta al paso 8. Interior
					continuar_proyecto(8,5);
				}
				else{
					$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'colores', id_serie:$('#serie_marcada').val(), id_acabado:$('#acabado_marcado').val(), num_puertas:$('#puertas_marcado').val(), diseno_puerta_1:$('#diseno_puerta_1').val(), diseno_puerta_2:$('#diseno_puerta_2').val(), diseno_puerta_3:$('#diseno_puerta_3').val(), diseno_puerta_4:$('#diseno_puerta_4').val(), diseno_puerta_5:$('#diseno_puerta_5').val(), diseno_puerta_6:$('#diseno_puerta_6').val(), diseno_puerta_7:$('#diseno_puerta_7').val(), diseno_puerta_8:$('#diseno_puerta_8').val() }, function(data){
						// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
						$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_interior, .contenedor_seccion_extras, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

							// SE CARGA EL CONTENIDO DE PASO 7
							$('.contenedor_seccion_colores').html(data);
							
							
							// CUANDO SE PULSE EN UNA PUERTA
							$('#proyecto .seccion_colores .item_seccion_colores').on('click', 'img', function (){
								
								var num_puerta = $(this).attr("num_puerta");
								
								cambiar_colores(num_puerta);
								
							});
							
								
							// SE MUESTRA EL CONTENIDO DEL PASO 7
							$('.contenedor_seccion_colores').slideDown('slow');
						});
						
						// SE MARCAN LOS PASOS PASADOS
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno').removeClass('actual');
						$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno').addClass('pasado');
						// SE MARCA EL PASO 7 COMO ACTUAL
						$('.item_progreso.colores').addClass('actual');
						// SE DESMARCAN EL RESTO DE PASOS
						$('.item_progreso.colores, .item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('pasado');
						$('.item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('actual');
						
						// Mostramos el botón continuar y ocultamos el guardar
						$('.botones_navegacion .boton_continuar').show();
						$('.botones_resumen .boton_guardar').addClass('inactivo');
						$('.botones_resumen .boton_guardar').attr('onClick','');
						// Desactivamos el botón Continuar y SI le cambiamos el onClick para que vaya al paso 8
						$('.botones_navegacion .boton_continuar').addClass('inactivo');
						$('.botones_navegacion .boton_continuar').attr('onClick','continuar_proyecto(8,7);');
						// Botón volver llevará al paso 6
						$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(6);');
						
						// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO A PARTIR DEL PASO 6 MENOS EL PRECIO
						$('.txt_resumen.colores, .txt_resumen.interior, .txt_resumen.extras').html('-');
						// Y DEL FORMULARIO GENERAL
						$('#colores_puerta_1, #colores_puerta_2, #colores_puerta_3, #colores_puerta_4, #colores_puerta_5, #colores_puerta_6, #colores_puerta_7, #colores_puerta_8').val('');
						// Y DEL PRECIO (LO HACEMOS CALCULANDO EL PRECIO SOLO DEL FRENTE
						calcular_precio_frente();
					});
				}
				break;
				
			case 8: // (INTERIOR)
				$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'interior' }, function(data){
					// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
					$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_extras, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

						// SE CARGA EL CONTENIDO DE PASO 8
						$('.contenedor_seccion_interior').html(data);
						
						if($('#serie_marcada').val() == 0){ // SI NO TIENE SERIE ES QUE SE TRATA DE SOLO INTERIOR, SE SALTA AL PASO DE PREGUNTAR SI QUIERE O NO INTERIOR Y SE MUESTRA DIRECTAMENTE CUANTOS MÓDULOS QUIERE
							modulos_interior(); 
						};	
						// SE MUESTRA EL CONTENIDO DEL PASO 8
						$('.contenedor_seccion_interior').slideDown('slow');
					});
					
					// SE MARCAN LOS PASOS PASADOS
					$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores').removeClass('actual');
					$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores').addClass('pasado');
					// SE MARCA EL PASO 8 COMO ACTUAL
					$('.item_progreso.interior').addClass('actual');
					// SE DESMARCAN EL RESTO DE PASOS
					$('.item_progreso.interior, .item_progreso.extras, .item_progreso.finalizar').removeClass('pasado');
					$('.item_progreso.extras, .item_progreso.finalizar').removeClass('actual');
					
					// Mostramos el botón continuar y ocultamos el guardar
					$('.botones_navegacion .boton_continuar').show();
					$('.botones_resumen .boton_guardar').addClass('inactivo');
					$('.botones_resumen .boton_guardar').attr('onClick','');
					
					// Desactivamos el botón Continuar y SI le cambiamos el onClick para que vaya al paso 9
					$('.botones_navegacion .boton_continuar').addClass('inactivo');
					$('.botones_navegacion .boton_continuar').attr('onClick','continuar_proyecto(9,8);');
					// Botón volver llevará al paso anteior, que podrá ser el 5 o el 7
					if($('#serie_marcada').val() == 0){ // SI ES SOLO INTERIOR VOLVER LLEVARÁ AL PUNTO 5
						$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(5);');
					}else{ // SI ES UN FRENTE VOLVER LLEVARÁ AL PUNTO 7
						$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(7);');
					};
					// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO A PARTIR DEL PASO 7 MENOS EL PRECIO
					$('.txt_resumen.interior, .txt_resumen.extras').html('-');
					// Y DEL FORMULARIO GENERAL
					$('#modulos_interior, #interior_puerta_1, #interior_puerta_2, #interior_puerta_3, #interior_puerta_4, #interior_puerta_5, #interior_puerta_6, #interior_puerta_7, #interior_puerta_8, #precio_modulos_interior, #precio_accesorios_interior, #inc_desc_interior, #cant_inc_desc_interior').val('');
					// Y DEL PRECIO (LO HACEMOS CALCULANDO EL PRECIO SOLO DEL FRENTE
					calcular_precio_frente();
					
				});
				break;
				
			case 9: // (EXTRAS)
				$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'extras', id_serie:$('#serie_marcada').val(), id_acabado:$('#acabado_marcado').val(), num_puertas:$('#puertas_marcado').val(), diseno_puerta_1:$('#diseno_puerta_1').val(), diseno_puerta_2:$('#diseno_puerta_2').val(), diseno_puerta_3:$('#diseno_puerta_3').val(), diseno_puerta_4:$('#diseno_puerta_4').val(), diseno_puerta_5:$('#diseno_puerta_5').val(), diseno_puerta_6:$('#diseno_puerta_6').val(), diseno_puerta_7:$('#diseno_puerta_7').val(), diseno_puerta_8:$('#diseno_puerta_8').val(), num_modulos:$('#modulos_interior').val(), interior_puerta_1:$('#interior_puerta_1').val(), interior_puerta_2:$('#interior_puerta_2').val(), interior_puerta_3:$('#interior_puerta_3').val(), interior_puerta_4:$('#interior_puerta_4').val(), interior_puerta_5:$('#interior_puerta_5').val(), interior_puerta_6:$('#interior_puerta_6').val(), interior_puerta_7:$('#interior_puerta_7').val(), interior_puerta_8:$('#interior_puerta_8').val() }, function(data){
					// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
					$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_finalizar').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

						// SE CARGA EL CONTENIDO DE PASO 9
						$('.contenedor_seccion_extras').html(data);
						
						
						// PARA QUE SOLO SE PUEDAN SELECCIONAR UNAS TAPETAS
						$("#tapetas_1").change(function() {
							if(this.checked) {
								$("#tapetas_2").prop('checked', false);
								$('#tapetas_seleccionado').val($("#tapetas_1").val());
							}
							else{
								$('#tapetas_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#tapetas_2").change(function() {
							if(this.checked) {
								$("#tapetas_1").prop('checked', false);
								$('#tapetas_seleccionado').val($("#tapetas_2").val());
							}
							else{
								$('#tapetas_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// PARA QUE SOLO SE PUEDAN SELECCIONAR UNOS LATERALES
						$("#laterales_1").change(function() {
							if(this.checked) {
								$("#laterales_2").prop('checked', false);
								$('#laterales_seleccionado').val($("#laterales_1").val());
							}
							else{
								$('#laterales_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#laterales_2").change(function() {
							if(this.checked) {
								$("#laterales_1").prop('checked', false);
								$('#laterales_seleccionado').val($("#laterales_2").val());
							}
							else{
								$('#laterales_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// PARA QUE SOLO SE PUEDAN SELECCIONAR UNOS COSTADOS
						$("#costados_1").change(function() {
							if(this.checked) {
								$("#costados_2").prop('checked', false);
								$("#costados_3").prop('checked', false);
								$('#costados_seleccionado').val($("#costados_1").val());
							}
							else{
								$('#costados_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#costados_2").change(function() {
							if(this.checked) {
								$("#costados_1").prop('checked', false);
								$("#costados_3").prop('checked', false);
								$('#costados_seleccionado').val($("#costados_2").val());
							}
							else{
								$('#costados_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#costados_3").change(function() {
							if(this.checked) {
								$("#costados_1").prop('checked', false);
								$("#costados_2").prop('checked', false);
								$('#costados_seleccionado').val($("#costados_3").val());
							}
							else{
								$('#costados_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SI SELECCIONAN QUE QUIEREN FIJOS
						$("#fijos").change(function() {
							if(this.checked) {
								$('#fijos_seleccionado').val($("#fijos").val());
							}
							else{
								$('#fijos_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SI SELECCIONAN QUE QUIEREN MONTAJE DEL FRENTE
						$("#montaje_frente").change(function() {
							if(this.checked) {
								$('#montaje_frente_seleccionado').val($("#montaje_frente").val());
							}
							else{
								$('#montaje_frente_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#montaje_frente_arjomy").change(function() {
							if(this.checked) {
								$('#montaje_frente_arjomy_seleccionado').val($("#montaje_frente_arjomy").val());
							}
							else{
								$('#montaje_frente_arjomy_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						
						// SI SELECCIONAN QUE QUIEREN SISTEMA DE FRENOS
						$("#sistema_frenos").change(function() {
							if(this.checked) {
								$('#sistema_frenos_seleccionado').val($("#sistema_frenos").val());
							}
							else{
								$('#sistema_frenos_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SI SELECCIONAN QUE QUIEREN REGLETAS LED PARA PUERTAS
						$("#regleta_led").change(function() {
							if(this.checked) {
								$('#regleta_led_seleccionado').val($("#regleta_led").val());
							}
							else{
								$('#regleta_led_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SI SELECCIONAN QUE QUIEREN SISTEMA DE FRENOS
						$("#frente_abuardillado").change(function() {
							if(this.checked) {
								$('#frente_abuardillado_seleccionado').val($("#frente_abuardillado").val());
							}
							else{
								$('#frente_abuardillado_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SI SELECCIONAN QUE QUIEREN REMATAR EL FRENTE
						$("#rematar_frente").change(function() {
							if(this.checked) {
								$('#rematar_frente_seleccionado').val($("#rematar_frente").val());
							}
							else{
								$('#rematar_frente_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#rematar_frente_arjomy").change(function() {
							if(this.checked) {
								$('#rematar_frente_arjomy_seleccionado').val($("#rematar_frente_arjomy").val());
							}
							else{
								$('#rematar_frente_arjomy_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SI SELECCIONAN QUE QUIEREN JUEGO DE LED
						$("#juego_led").change(function() {
							if(this.checked) {
								$('#juego_led_seleccionado').val($("#juego_led").val());
							}
							else{
								$('#juego_led_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#juego_led_arjomy").change(function() {
							if(this.checked) {
								$('#juego_led_arjomy_seleccionado').val($("#juego_led_arjomy").val());
							}
							else{
								$('#juego_led_arjomy_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SI SELECCIONAN QUE QUIEREN REMATAR EL INTERIOR
						$("#rematar_interior").change(function() {
							if(this.checked) {
								$('#rematar_interior_seleccionado').val($("#rematar_interior").val());
							}
							else{
								$('#rematar_interior_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SI SELECCIONAN QUE QUIEREN MONTAJE DEL INTERIOR
						$("#montaje_interior").change(function() {
							if(this.checked) {
								$('#montaje_interior_seleccionado').val($("#montaje_interior").val());
							}
							else{
								$('#montaje_interior_seleccionado').val("");
							}
							actualizar_extras();
						});	
						$("#montaje_interior_arjomy").change(function() {
							if(this.checked) {
								$('#montaje_interior_arjomy_seleccionado').val($("#montaje_interior_arjomy").val());
							}
							else{
								$('#montaje_interior_arjomy_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// PARA QUE SOLO SE PUEDAN SELECCIONAR UN DESMONTAJE DE FRENTE
						$("#desmontajes_frentes_1").change(function() {
							if(this.checked) {
								$("#desmontajes_frentes_2").prop('checked', false);
								$("#desmontajes_frentes_3").prop('checked', false);
								$('#desmontaje_frente_seleccionado').val($("#desmontajes_frentes_1").val());
							}
							else{
								$('#desmontaje_frente_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#desmontajes_frentes_2").change(function() {
							if(this.checked) {
								$("#desmontajes_frentes_1").prop('checked', false);
								$("#desmontajes_frentes_3").prop('checked', false);
								$('#desmontaje_frente_seleccionado').val($("#desmontajes_frentes_2").val());
							}
							else{
								$('#desmontaje_frente_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#desmontajes_frentes_3").change(function() {
							if(this.checked) {
								$("#desmontajes_frentes_2").prop('checked', false);
								$("#desmontajes_frentes_1").prop('checked', false);
								$('#desmontaje_frente_seleccionado').val($("#desmontajes_frentes_3").val());
							}
							else{
								$('#desmontaje_frente_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#desmontajes_frentes_arjomy").change(function() {
							if(this.checked) {
								$('#desmontaje_frente_arjomy_seleccionado').val($("#desmontajes_frentes_arjomy").val());
							}
							else{
								$('#desmontaje_frente_arjomy_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// PARA QUE SOLO SE PUEDAN SELECCIONAR UN DESMONTAJE DE INTERIOR
						$("#desmontajes_interiores_1").change(function() {
							if(this.checked) {
								$("#desmontajes_interiores_2").prop('checked', false);
								$("#desmontajes_interiores_3").prop('checked', false);
								$('#desmontaje_interior_seleccionado').val($("#desmontajes_interiores_1").val());
							}
							else{
								$('#desmontaje_interior_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#desmontajes_interiores_2").change(function() {
							if(this.checked) {
								$("#desmontajes_interiores_1").prop('checked', false);
								$("#desmontajes_interiores_3").prop('checked', false);
								$('#desmontaje_interior_seleccionado').val($("#desmontajes_interiores_2").val());
							}
							else{
								$('#desmontaje_interior_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#desmontajes_interiores_3").change(function() {
							if(this.checked) {
								$("#desmontajes_interiores_2").prop('checked', false);
								$("#desmontajes_interiores_1").prop('checked', false);
								$('#desmontaje_interior_seleccionado').val($("#desmontajes_interiores_3").val());
							}
							else{
								$('#desmontaje_interior_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#desmontajes_interiores_arjomy").change(function() {
							if(this.checked) {
								$('#desmontaje_interior_arjomy_seleccionado').val($("#desmontajes_interiores_arjomy").val());
							}
							else{
								$('#desmontaje_interior_arjomy_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// PARA QUE SOLO PUEDAN SELECCIONAR UNA ALBAÑILERÍA
						$("#albanileria_con").change(function() {
							if(this.checked) {
								$("#albanileria_sin").prop('checked', false);
								$('#albanileria_sin_seleccionado').val("");
								$('#albanileria_con_seleccionado').val($("#albanileria_con").val());
							}
							else{
								$('#albanileria_con_seleccionado').val("");
							}
							actualizar_extras();
						});
						$("#albanileria_sin").change(function() {
							if(this.checked) {
								$("#albanileria_con").prop('checked', false);
								$('#albanileria_con_seleccionado').val("");
								$('#albanileria_sin_seleccionado').val($("#albanileria_sin").val());
							}
							else{
								$('#albanileria_sin_seleccionado').val("");
							}
							actualizar_extras();
						});
						
						// SE MUESTRA EL CONTENIDO DEL PASO 9
						$('.contenedor_seccion_extras').slideDown('slow');
					});
					
					// SE MARCAN LOS PASOS PASADOS
					$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior').removeClass('actual');
					$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior').addClass('pasado');
					// SE MARCA EL PASO 9 COMO ACTUAL
					$('.item_progreso.extras').addClass('actual');
					// SE DESMARCAN EL RESTO DE PASOS
					$('.item_progreso.extras, .item_progreso.finalizar').removeClass('pasado');
					$('.item_progreso.finalizar').removeClass('actual');
					
					// Mostramos el botón continuar y ocultamos el guardar
					$('.botones_navegacion .boton_continuar').show();
					$('.botones_resumen .boton_guardar').addClass('inactivo');
					$('.botones_resumen .boton_guardar').attr('onClick','');
					
					// Desactivamos el botón Continuar y SI le cambiamos el onClick para que vaya al paso 10
					$('.botones_navegacion .boton_continuar').removeClass('inactivo');
					$('.botones_navegacion .boton_continuar').addClass('activo');
					$('.botones_navegacion .boton_continuar').attr('onClick','recalcular_precio(); continuar_proyecto(10,9);');
					// Botón volver llevará al paso 8
					$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(8);');
					
					// BORRAMOS LOS DATOS DE RESUMEN DEL PROYECTO A PARTIR DEL PASO 8 MENOS EL PRECIO
					$('.txt_resumen.extras').html('-');
					// BORRAMOS LOS DATOS DEL FORMULARIO GENERAL
					$("#laterales_seleccionado, #tapetas_seleccionado, #costados_seleccionado, #fijos_seleccionado, #montaje_frente_seleccionado, #montaje_frente_arjomy_seleccionado, #montaje_interior_seleccionado, #montaje_interior_arjomy_seleccionado, #desmontaje_frente_seleccionado, #desmontaje_frente_arjomy_seleccionado, #desmontaje_interior_seleccionado, #desmontaje_interior_arjomy_seleccionado, #juego_led_seleccionado, #juego_led_arjomy_seleccionado, #rematar_frente_seleccionado, #rematar_frente_arjomy_seleccionado, #sistema_frenos_seleccionado, #albanileria_con_seleccionado, #albanileria_sin_seleccionado, #frente_abuardillado_seleccionado, #regleta_led_seleccionado").val("");
					// Y DEL PRECIO (LO HACEMOS CALCULANDO EL PRECIO DEL INTERIOR)
					calcular_precio_interior();
					
				});
				break;
				
			case 10: // (FINALIZAR)
				$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'finalizar', id_serie:$('#serie_marcada').val(), id_acabado:$('#acabado_marcado').val(), num_puertas:$('#puertas_marcado').val(), diseno_puerta_1:$('#diseno_puerta_1').val(), diseno_puerta_2:$('#diseno_puerta_2').val(), diseno_puerta_3:$('#diseno_puerta_3').val(), diseno_puerta_4:$('#diseno_puerta_4').val(), diseno_puerta_5:$('#diseno_puerta_5').val(), diseno_puerta_6:$('#diseno_puerta_6').val(), diseno_puerta_7:$('#diseno_puerta_7').val(), diseno_puerta_8:$('#diseno_puerta_8').val(), num_modulos:$('#modulos_interior').val(), interior_puerta_1:$('#interior_puerta_1').val(), interior_puerta_2:$('#interior_puerta_2').val(), interior_puerta_3:$('#interior_puerta_3').val(), interior_puerta_4:$('#interior_puerta_4').val(), interior_puerta_5:$('#interior_puerta_5').val(), interior_puerta_6:$('#interior_puerta_6').val(), interior_puerta_7:$('#interior_puerta_7').val(), interior_puerta_8:$('#interior_puerta_8').val(), observaciones_proyecto:$('#observaciones_proyecto').val() }, function(data){
					// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
					$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_extras').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP

						// SE CARGA EL CONTENIDO DE PASO 10
						$('.contenedor_seccion_finalizar').html(data);	
						
						// SI ESCRIBEN EN OBSERVACIONES
						$("#observaciones").change(function() {
							$('#observaciones_proyecto').val($("#observaciones").val());
						});	
						
						// SE MUESTRA EL CONTENIDO DEL PASO 10
						$('.contenedor_seccion_finalizar').slideDown('slow');
					});
					
					// SE MARCAN LOS PASOS PASADOS
					$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras').removeClass('actual');
					$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras').addClass('pasado');
					// SE MARCA EL PASO 10 COMO ACTUAL
					$('.item_progreso.finalizar').addClass('actual');
					// SE DESMARCAN EL RESTO DE PASOS
					$('.item_progreso.finalizar').removeClass('pasado');
					
					
					// Ocultamos el botón Continuar y mostramos el de Guardar
					$('.botones_navegacion .boton_continuar').hide();
					$('.botones_resumen .boton_guardar').removeClass('inactivo');
					$('.botones_resumen .boton_guardar').attr('onClick','datos_cliente();');
					// Botón volver llevará al paso 9
					$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(9);');
					$('.botones_navegacion .boton_volver').show();
					
					// BORRAMOS EL DESCUENTO Y LAS OBSERVACIONES DEL FORMULARIO GENERAL
					$('#aplicar_descuento, #descuento_cliente').val("");
				});
				break;
				
			case 11: //(SERIE)
			$.post('index.php', { seccion: 'ajax', sub:'nuevo_proyecto', ac:'actualizar', id_serie:$('#serie_marcada').val(), id_acabado:$('#acabado_marcado').val(), num_puertas:$('#puertas_marcado').val(), diseno_puerta_1:$('#diseno_puerta_1').val(), diseno_puerta_2:$('#diseno_puerta_2').val(), diseno_puerta_3:$('#diseno_puerta_3').val(), diseno_puerta_4:$('#diseno_puerta_4').val(), diseno_puerta_5:$('#diseno_puerta_5').val(), diseno_puerta_6:$('#diseno_puerta_6').val(), diseno_puerta_7:$('#diseno_puerta_7').val(), diseno_puerta_8:$('#diseno_puerta_8').val(), num_modulos:$('#modulos_interior').val(), interior_puerta_1:$('#interior_puerta_1').val(), interior_puerta_2:$('#interior_puerta_2').val(), interior_puerta_3:$('#interior_puerta_3').val(), interior_puerta_4:$('#interior_puerta_4').val(), interior_puerta_5:$('#interior_puerta_5').val(), interior_puerta_6:$('#interior_puerta_6').val(), interior_puerta_7:$('#interior_puerta_7').val(), interior_puerta_8:$('#interior_puerta_8').val(), observaciones_proyecto:$('#observaciones_proyecto').val() }, function(data){
			
				// SE OCULTA EL CONTENIDO DEL RESTO DE PASOS SI HAY ALGUNO MOSTRÁNDOSE
				$('.contenedor_seccion_serie, .contenedor_seccion_acabado, .contenedor_seccion_perfileria, .contenedor_seccion_medidas, .contenedor_seccion_puertas, .contenedor_seccion_diseno, .contenedor_seccion_colores, .contenedor_seccion_interior, .contenedor_seccion_extras').slideUp('slow', function(){ // CUANDO TERMINA EL SLIDE UP
				
					// SE CARGA EL CONTENIDO EDICION 
					$('.contenedor_seccion_finalizar').html(data);
					
					// SI ESCRIBEN EN OBSERVACIONES
						$("#observaciones").change(function() {
							$('#observaciones_proyecto').val($("#observaciones").val());
						});	
					
					// SE MARCA EL PASO 1 COMO ACTUAL
					$('.item_progreso.finalizar').addClass('actual');
					// SE DESMARCAN EL RESTO DE PASOS
					$('.item_progreso.serie, .item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.extras, .item_progreso.interior').addClass('pasado');
					$('.item_progreso.acabado, .item_progreso.perfileria, .item_progreso.medidas, .item_progreso.puertas, .item_progreso.diseno, .item_progreso.colores, .item_progreso.interior, .item_progreso.extras').removeClass('actual');
					
					// Mostramos el botón continuar y ocultamos el guardar
					$('.botones_navegacion .boton_continuar').show();
					$('.botones_resumen .boton_guardar').addClass('inactivo');
					$('.botones_resumen .boton_guardar').attr('onClick','');
					// SE DESACTIVAN LOS BOTONES DE NAVEGACIÓN
					$('.botones_navegacion a').addClass('inactivo');
					
					// EL BOTÓN CONTINUAR LLEVARÁ AL PASO 2
					$('.botones_navegacion .boton_continuar').attr('onClick','');
					
					// Ocultamos el botón Continuar y mostramos el de Guardar
					$('.botones_navegacion .boton_continuar').hide();
					$('.botones_resumen .boton_guardar').removeClass('inactivo');
					$('.botones_resumen .boton_guardar').attr('onClick','datos_cliente();');
					// Botón volver llevará al paso 9
					$('.botones_navegacion .boton_volver').attr('onClick','volver_proyecto(9);');
					$('.botones_navegacion .boton_volver').removeClass('inactivo');
					$('.botones_navegacion .boton_volver').addClass('activo');
					
					// SE RECARGA EL DOCUMENT READY
					inicializar();
					
					// SE MUESTRA EL CONTENIDO DEL PASO 1
					$('.contenedor_seccion_finalizar').slideDown('slow');
			
				});
				
			});
			break;
		}
	}
}
