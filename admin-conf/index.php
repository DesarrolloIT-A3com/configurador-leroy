<?php
session_start();

// CARGAMOS ARCHIVOS DE CONFIGURACIÓN Y LIBRERÍAS
require_once("etc/conf.php");
require_once("libs/database.php");


// COMPROBAMOS SI SE PASA ALGO POR GET O POST
$seccion = "";
if(isset($_GET['seccion']) && $_GET['seccion'] != "")		$seccion = $_GET['seccion'];
if(isset($_POST['seccion']) && $_POST['seccion'] != "")		$seccion = $_POST['seccion'];
$sub = "";
if(isset($_GET['sub']) && $_GET['sub'] != "")				$sub = $_GET['sub'];
if(isset($_POST['sub']) && $_POST['sub'] != "")				$sub = $_POST['sub'];
$accion = "";
if(isset($_GET['ac']) && $_GET['ac'] != "")					$accion = $_GET['ac'];
if(isset($_POST['ac']) && $_POST['ac'] != "")				$accion = $_POST['ac'];
$id = 0;
if(isset($_GET['id']) && $_GET['id'] != "")					$id = (int)$_GET['id'];
if(isset($_POST['id']) && $_POST['id'] != "")				$id = (int)$_POST['id'];


// CREAMOS UN OBJETO DATABASE PARA PODER REALIZAR CONSULTAS
$db = new Database();

// SI LA SECCIÓN ES logout BORRA LA SESIÓN
if($seccion == 'logout'){	
	unset($_SESSION['admin_logueado']);
}

// SI NO ESTÁ LOGUEADO SE VA A LA VENTANA DE LOGIN
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged") 
	$seccion = 'login';
	
// SI SE HA PASADO USUARIO Y CONTRASEÑA SECOMPRUEBA QUE SEA CORRECTO
$error = false;
if((isset($_POST['usuario']) || isset($_POST['pass'])) && $seccion != 'ajax'){
	
	$conexion = $db->connectDB();  // CONECTAMOS A BASE DE DATOS PARA PODER USAR real_escape_string
	
	$usuario = $conexion->real_escape_string($_POST['usuario']);
	$pass = $conexion->real_escape_string($_POST['pass']);
	
	$db->disconnectDB($conexion); // DESCONECTAMOS BASE DE DATOS
	
	// CONSULTAMOS LOS DATOS DE USUARIO SI ESTÁ ACTIVO
	$datos_usuario = $db->getRow('SELECT usuario, pass FROM administradores WHERE usuario = "'.$usuario.'"');
	
	// SE COMPRUEBA USUARIO Y CONTRASEÑA
	if($datos_usuario['usuario'] == $usuario && password_verify($pass, $datos_usuario['pass'])){ 
		// SE GUARDAN EN SESIÓN LOS DATOS DEL USUARIO LOGUEADO
		$_SESSION['admin_logueado']="logged";
		$seccion = 'inicio';
	}
	else{
		$error = true;
	}
}


// CONTENIDOS DE LLAMADAS POR AJAX
if($seccion == 'ajax'){
	switch($sub){
		
		// DETALLES SERIE
		case 'nuevo_proyecto':
			switch($accion){
				case 'serie':
					include("include/secciones/proyectos/ajax/serie.php");
					break;
				
				case 'acabado':
					include("include/secciones/proyectos/ajax/acabado.php");
					break;
				
				case 'perfileria':
					include("include/secciones/proyectos/ajax/perfileria.php");
					break;
				
				case 'medidas':
					include("include/secciones/proyectos/ajax/medidas.php");
					break;
				
				case 'puertas':
					include("include/secciones/proyectos/ajax/puertas.php");
					break;
				
				case 'diseno':
					include("include/secciones/proyectos/ajax/diseno.php");
					break;
				case 'cambiar_puerta':
					include("include/secciones/proyectos/ajax/cambiar_puerta.php");
					break;
				case 'cambiar_puerta_diseno':
					include("include/secciones/proyectos/ajax/cambiar_puerta_diseno.php");
					break;
				case 'cambiar_puerta_terminacion':
					include("include/secciones/proyectos/ajax/cambiar_puerta_terminacion.php");
					break;
				case 'cambiar_puerta_final':
					include("include/secciones/proyectos/ajax/cambiar_puerta_final.php");
					break;
				case 'elegir_ceramica':
					include("include/secciones/proyectos/ajax/elegir_ceramica.php");
					break;
				case 'calcular_precio_frente':
					include("include/secciones/proyectos/ajax/calcular_precio_frente.php");
					break;
					
				case 'colores':
					include("include/secciones/proyectos/ajax/colores.php");
					break;
				case 'cambiar_colores':
					include("include/secciones/proyectos/ajax/cambiar_colores.php");
					break;
				case 'mostrar_colores':
					include("include/secciones/proyectos/ajax/mostrar_colores.php");
					break;
					
				case 'interior':
					include("include/secciones/proyectos/ajax/interior.php");
					break;
				case 'modulos_interior':
					include("include/secciones/proyectos/ajax/modulos_interior.php");
					break;
				case 'seleccion_interior':
					include("include/secciones/proyectos/ajax/seleccion_interior.php");
					break;
				case 'mostrar_interiores':
					include("include/secciones/proyectos/ajax/mostrar_interiores.php");
					break;
				case 'preguntar_freno':
					include("include/secciones/proyectos/ajax/preguntar_freno.php");
					break;
				case 'preguntar_color_interior':
					include("include/secciones/proyectos/ajax/preguntar_color_interior.php");
					break;
				case 'preguntar_color_cantoneras':
					include("include/secciones/proyectos/ajax/preguntar_color_cantoneras.php");
					break;
				case 'calcular_precio_interior':
					include("include/secciones/proyectos/ajax/calcular_precio_interior.php");
					break;
					
				case 'extras':
					include("include/secciones/proyectos/ajax/extras.php");
					break;
					
				case 'finalizar':
					include("include/secciones/proyectos/ajax/finalizar.php");
					break;
				case 'actualizar':
					include("include/secciones/proyectos/ajax/actualizar.php");
					break;
				case 'recalcular_precio':
					include("include/secciones/proyectos/ajax/recalcular_precio.php");
					break;
				case 'aplicar_descuento':
					include("include/secciones/proyectos/ajax/aplicar_descuento.php");
					break;
					
				//case 'datos_cliente':
				//	include("include/secciones/proyectos/ajax/datos_cliente.php");
				//	break;
				
				case 'actualizar_proyecto':
					include("include/secciones/proyectos/ajax/actualizar_proyecto.php");
					break;
				
				case 'volver':
					include("include/secciones/proyectos/ajax/confirmar_volver.php");
					break;
				default:
					include("include/secciones/usuarios/usuarios.php");
					break;
			}
			break;
		
		// DETALLES SERIE
		case 'detalles_serie':
			include('include/secciones/proyectos/ajax/detalles_serie.php');
			break;
			
		// CONFIRMAR CANCELAR PROYECTO
		case 'confirmar_cancelar_proyecto':	
			include('include/secciones/proyectos/ajax/confirmar_cancelar_proyecto.php');			
			break;
		
		// SALIR DE LA WEB
		case 'salir':	
			include('include/ajax/salir.php');			
			break;
			
		// LISTADO DE SOLICITUDES
		case 'listado_solicitudes':
			include('include/secciones/solicitudes/ajax/listado_solicitudes.php');			
			break;
			
		// DATOS SOLICITUD
		case 'datos_solicitud':
			include('include/secciones/solicitudes/ajax/datos_solicitud.php');			
			break;

		// APROBAR SOLICITUD
		case 'datos_aprobar_solicitud':
			include('include/secciones/solicitudes/ajax/datos_aprobar_solicitud.php');			
			break;
		case 'aprobar_solicitud':
			include('include/secciones/solicitudes/ajax/aprobar_solicitud.php');			
			break;
		
		// RECHAZAR SOLICITUD
		case 'confirmar_rechazar_solicitud':
			include('include/secciones/solicitudes/ajax/confirmar_rechazar_solicitud.php');			
			break;
		case 'rechazar_solicitud':
			include('include/secciones/solicitudes/ajax/rechazar_solicitud.php');			
			break;
			
		// BORRAR SOLICITUD
		case 'confirmar_borrar_solicitud':
			include('include/secciones/solicitudes/ajax/confirmar_borrar_solicitud.php');			
			break;
		case 'borrar_solicitud':
			include('include/secciones/solicitudes/ajax/borrar_solicitud.php');			
			break;
			
			
			
		// LISTADO DE USUARIOS
		case 'listado_usuarios':
			include('include/secciones/usuarios/ajax/listado_usuarios.php');			
			break;
			
		// DATOS USUARIO
		case 'datos_usuario':
			include('include/secciones/usuarios/ajax/datos_usuario.php');			
			break;

		// RESUMEN PROYECTOS USUARIO
		case 'resumen_proyectos_usuario':
			include('include/secciones/usuarios/ajax/resumen_proyectos_usuario.php');			
			break;
		
		// LISTADO DE ACCESOS
		case 'listado_accesos':
			include('include/secciones/usuarios/ajax/listado_accesos.php');			
			break;
			
		// ACTIVAR USUARIO
		case 'activar_usuario':
			include('include/secciones/usuarios/ajax/activar_usuario.php');			
			break;
			
		// DESACTIVAR USUARIO
		case 'desactivar_usuario':
			include('include/secciones/usuarios/ajax/desactivar_usuario.php');			
			break;
			
		// BORRAR USUARIO
		case 'confirmar_borrar_usuario':
			include('include/secciones/usuarios/ajax/confirmar_borrar_usuario.php');			
			break;
		case 'borrar_usuario':
			include('include/secciones/usuarios/ajax/borrar_usuario.php');			
			break;
			
		// LISTADO DE PROYECTOS GUARDADOS POR EL USUARIO
		case 'listado_proyectos':
			include('include/secciones/usuarios/ajax/listado_proyectos.php');
			break;
			
		// GUARDAR DATOS DEL USUARIO
		case 'guardar_datos_usuario':
			include('include/secciones/usuarios/ajax/guardar_datos_usuario.php');
			break;
			
		// CONFIRMAR BORRAR PROYECTO
		case 'confirmar_borrar_proyecto':	
			include('include/secciones/usuarios/ajax/confirmar_borrar_proyecto.php');			
			break;
			
		// CONFIRMAR EDITAR PROYECTO
		case 'confirmar_editar_proyecto':	
			include('include/secciones/usuarios/ajax/confirmar_editar_proyecto.php');			
			break;
			
		// BORRAR PROYECTO
		case 'borrar_proyecto':	
			include('include/secciones/usuarios/ajax/borrar_proyecto.php');			
			break;
			
		// IMPRIMIR PROYECTO
		case 'imprimir_proyecto':	
			include('include/secciones/usuarios/ajax/imprimir_proyecto.php');			
			break;
			
		// PDF PROYECTO
		case 'pdf':	
			include('include/secciones/usuarios/ajax/pdf_proyecto.php');			
			break;
			
		// SI NO ES NINGUNO SE GENERA UN ERROR
		default:
			$respuesta['estado'] = 'ko';
			$respuesta['mensaje'] = 'Error de sección. Inténtelo de nuevo';
			echo json_encode($respuesta);
			break;
	}
//CONTENIDOS DE LAS PÁGINAS
}else{
	include("include/head.php"); // HEAD HTML
	include("include/subhead.php"); // SE CIERRA EL HEAD Y SE ABRE EL BODY, AQUÍ SE INCLUYE EL MENÚ
	
	// SEGÚN LA SECCIÓN SE CARGA UN CONTENIDO EN EL CUERPO DEL HTML
	switch($seccion){
		case 'login':			
			include("include/secciones/login/login.php");			
			break;
		case 'inicio':
			include("include/secciones/inicio/inicio.php");
			break;
		case 'solicitudes':
			include("include/secciones/solicitudes/solicitudes.php");
			break;
		case 'usuarios':
			switch($sub){
				case 'ver_usuario':	
					include('include/secciones/usuarios/ver_usuario.php');			
					break;
				case 'proyectos_usuario':
					include('include/secciones/usuarios/proyectos_usuario.php');			
					break;
				case 'ver_proyecto':	
					include('include/secciones/usuarios/ver_proyecto.php');			
					break;
				default:
					include("include/secciones/usuarios/usuarios.php");
					break;
			}
			break;
			
		case 'proyectos':
			switch($sub){
				case 'edicion_proyecto':	
					include('include/secciones/proyectos/edicion_proyecto.php');			
					break;
				default:
					include("include/secciones/usuarios/usuarios.php");
					break;
			}
			break;
			
		default:
			include("include/secciones/inicio/inicio.php");
			break;
	}
	include("include/foot.php"); // FOOTER HTML Y SE CIERRA EL BODY 
}

?>