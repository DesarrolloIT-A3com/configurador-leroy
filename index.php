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
	unset($_SESSION['logueado']);
	unset($_SESSION['id_usuario']);
	unset($_SESSION['nombre_usuario']);
	unset($_SESSION['email']);

	unset($_SESSION['iva']);
	unset($_SESSION['pvp']);
	unset($_SESSION['incremento260']);
	unset($_SESSION['incremento270']);
	unset($_SESSION['descuento130']);
	unset($_SESSION['descuento60']);
}

// SI NO ESTÁ LOGUEADO NI VA A SLICITAR EL ALTA SE VA A LA VENTANA DE LOGIN
if(!($seccion == 'solicitar_acceso') && !($seccion == 'ajax' && $sub == 'guardar_datos_alta')){	
	if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged") 
		$seccion = 'login';
}
	
// SI SE HA PASADO USUARIO Y CONTRASEÑA SECOMPRUEBA QUE SEA CORRECTO
$error = false;
if((isset($_POST['usuario']) || isset($_POST['pass'])) && $seccion != 'ajax'){
	
	$conexion = $db->connectDB();  // CONECTAMOS A BASE DE DATOS PARA PODER USAR real_escape_string
	
	$usuario = $conexion->real_escape_string($_POST['usuario']);
	$pass = $conexion->real_escape_string($_POST['pass']);
	
	$db->disconnectDB($conexion); // DESCONECTAMOS BASE DE DATOS
	
	// CONSULTAMOS LOS DATOS DE USUARIO SI ESTÁ ACTIVO
	$datos_usuario = $db->getRow('SELECT u.id, u.usuario, um.pass, um.nombre, um.email FROM usuarios as u, usuarios_mod as um WHERE u.id_usuarios_mod=um.id AND u.usuario = "'.$usuario.'" AND u.activo = 1');
	
	// SE COMPRUEBA USUARIO Y CONTRASEÑA
	if($datos_usuario['usuario'] == $usuario && password_verify($pass, $datos_usuario['pass'])){ 
		// SE GUARDAN EN SESIÓN LOS DATOS DEL USUARIO LOGUEADO
		$_SESSION['logueado']="logged";
		$_SESSION['id_usuario']=$datos_usuario['id'];
		$_SESSION['nombre_usuario']=$datos_usuario['nombre'];
		$_SESSION['email']=$datos_usuario['email'];
		// IVA, INCREMENTOS Y DESCUENTOS SOBRE TARIFA
		$_SESSION['iva'] = 21;
		$_SESSION['pvp'] = 35;
		$_SESSION['incremento260'] = 10;
		$_SESSION['incremento270'] = 20;
		$_SESSION['descuento130'] = 25;
		$_SESSION['descuento60'] = 45;
		
		$seccion = 'inicio';
		
		$ip = "";
		if (isset($_SERVER["HTTP_CLIENT_IP"]))
		{
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
		{
			$ip = $_SERVER["HTTP_X_FORWARDED"];
		}
		elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
		{
			$ip = $_SERVER["HTTP_FORWARDED_FOR"];
		}
		elseif (isset($_SERVER["HTTP_FORWARDED"]))
		{
			$ip = $_SERVER["HTTP_FORWARDED"];
		}
		else
		{
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		
		// REGISTRA EL ACCESO EN BASE DE DATOS
		$ok = $db->insert('usuarios_accesos','id_usuarios, fecha, ip',$_SESSION['id_usuario'].', "'. date('Y-m-d H:i:s').'", "'.$ip.'"');
	}
	else{
		$error = true;
	}
}


// CONTENIDOS DE LLAMADAS POR AJAX
if($seccion == 'ajax'){
	switch($sub){
		
		//  GUARDAR SOLICITUD ACCESO
		case 'guardar_datos_alta':
			include('include/secciones/login/ajax/guardar_datos_alta.php');			
			break;
			
		// DETALLES SERIE
		case 'nuevo_proyecto':
			switch($accion){
				case 'serie':
					include("include/secciones/nuevo_proyecto/ajax/serie.php");
					break;
				
				case 'acabado':
					include("include/secciones/nuevo_proyecto/ajax/acabado.php");
					break;
				
				case 'perfileria':
					include("include/secciones/nuevo_proyecto/ajax/perfileria.php");
					break;
				
				case 'medidas':
					include("include/secciones/nuevo_proyecto/ajax/medidas.php");
					break;
				
				case 'puertas':
					include("include/secciones/nuevo_proyecto/ajax/puertas.php");
					break;
				
				case 'diseno':
					include("include/secciones/nuevo_proyecto/ajax/diseno.php");
					break;
				case 'cambiar_puerta':
					include("include/secciones/nuevo_proyecto/ajax/cambiar_puerta.php");
					break;
				case 'cambiar_puerta_diseno':
					include("include/secciones/nuevo_proyecto/ajax/cambiar_puerta_diseno.php");
					break;
				case 'cambiar_puerta_terminacion':
					include("include/secciones/nuevo_proyecto/ajax/cambiar_puerta_terminacion.php");
					break;
				case 'cambiar_puerta_final':
					include("include/secciones/nuevo_proyecto/ajax/cambiar_puerta_final.php");
					break;
				case 'elegir_ceramica':
					include("include/secciones/nuevo_proyecto/ajax/elegir_ceramica.php");
					break;
				case 'calcular_precio_frente':
					include("include/secciones/nuevo_proyecto/ajax/calcular_precio_frente.php");
					break;
					
				case 'colores':
					include("include/secciones/nuevo_proyecto/ajax/colores.php");
					break;
				case 'cambiar_colores':
					include("include/secciones/nuevo_proyecto/ajax/cambiar_colores.php");
					break;
				case 'mostrar_colores':
					include("include/secciones/nuevo_proyecto/ajax/mostrar_colores.php");
					break;
					
				case 'interior':
					include("include/secciones/nuevo_proyecto/ajax/interior.php");
					break;
				case 'modulos_interior':
					include("include/secciones/nuevo_proyecto/ajax/modulos_interior.php");
					break;
				case 'seleccion_interior':
					include("include/secciones/nuevo_proyecto/ajax/seleccion_interior.php");
					break;
				case 'mostrar_interiores':
					include("include/secciones/nuevo_proyecto/ajax/mostrar_interiores.php");
					break;
				case 'preguntar_freno':
					include("include/secciones/nuevo_proyecto/ajax/preguntar_freno.php");
					break;
				case 'preguntar_color_interior':
					include("include/secciones/nuevo_proyecto/ajax/preguntar_color_interior.php");
					break;
				case 'preguntar_color_cantoneras':
					include("include/secciones/nuevo_proyecto/ajax/preguntar_color_cantoneras.php");
					break;
				case 'calcular_precio_interior':
					include("include/secciones/nuevo_proyecto/ajax/calcular_precio_interior.php");
					break;
					
				case 'extras':
					include("include/secciones/nuevo_proyecto/ajax/extras.php");
					break;
					
				case 'finalizar':
					include("include/secciones/nuevo_proyecto/ajax/finalizar.php");
					break;
				case 'recalcular_precio':
					include("include/secciones/nuevo_proyecto/ajax/recalcular_precio.php");
					break;
				case 'aplicar_descuento':
					include("include/secciones/nuevo_proyecto/ajax/aplicar_descuento.php");
					break;
				//case 'datos_cliente':
				//	include("include/secciones/nuevo_proyecto/ajax/datos_cliente.php");
				//	break;
				case 'guardar_proyecto':
					include("include/secciones/nuevo_proyecto/ajax/guardar_proyecto.php");
					break;
				
				case 'volver':
					include("include/secciones/nuevo_proyecto/ajax/confirmar_volver.php");
					break;
				default:
					include("include/secciones/nuevo_proyecto/ajax/serie.php");
					break;
			}
			break;
		
		// DETALLES SERIE
		case 'detalles_serie':
			include('include/secciones/nuevo_proyecto/ajax/detalles_serie.php');
			break;
			
		// CONFIRMAR CANCELAR PROYECTO
		case 'confirmar_cancelar_proyecto':	
			include('include/secciones/nuevo_proyecto/ajax/confirmar_cancelar_proyecto.php');			
			break;
		
		// LISTADO DE PROYECTOS GUARDADOS
		case 'listado_proyectos':
			include('include/secciones/proyectos/ajax/listado_proyectos.php');
			break;
			
		// CONFIRMAR BORRAR PROYECTO
		case 'confirmar_borrar_proyecto':	
			include('include/secciones/proyectos/ajax/confirmar_borrar_proyecto.php');			
			break;
			
		// BORRAR PROYECTO
		case 'borrar_proyecto':	
			include('include/secciones/proyectos/ajax/borrar_proyecto.php');			
			break;
			
		// CONFIRMAR ENVIAR PROYECTO
		case 'confirmar_enviar_proyecto':	
			include('include/secciones/proyectos/ajax/confirmar_enviar_proyecto.php');			
			break;
			
		// ENVIAR PROYECTO
		case 'enviar_proyecto':	
			include('include/secciones/proyectos/ajax/enviar_proyecto.php');			
			break;
			
		// IMPRIMIR PROYECTO
		case 'imprimir_proyecto':	
			include('include/secciones/proyectos/ajax/imprimir_proyecto.php');			
			break;
			
		// PDF PROYECTO
		case 'pdf':	
			include('include/secciones/proyectos/ajax/pdf_proyecto.php');			
			break;
		
		// SALIR DE LA WEB
		case 'salir':	
			include('include/ajax/salir.php');			
			break;
			
		// VENTANA DE AYUDA
		case 'soporte':	
			include('include/ajax/ayuda.php');			
			break;
				
		// GUARDA LOS DATOS DE LA EMPRESA
		case 'guardar_datos_empresa':	
			include('include/secciones/datos_empresa/ajax/guardar_datos_empresa.php');			
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
		// ACCESO AL CONFIGURADOR
		case 'solicitar_acceso':
			include('include/secciones/login/solicitar_alta.php');
			break;
		case 'login':			
			include("include/secciones/login/login.php");			
			break;
		case 'inicio':
			include("include/secciones/inicio/inicio.php");
			break;
		case 'nuevo_proyecto':
			include("include/secciones/nuevo_proyecto/nuevo_proyecto.php");
			break;
		case 'proyectos':
			switch($sub){
				case 'ver_proyecto':	
					include('include/secciones/proyectos/ver_proyecto.php');			
					break;	
				default:
					include("include/secciones/proyectos/proyectos.php");
					break;
			}
			break;			
		case 'datos_empresa':
			include("include/secciones/datos_empresa/datos_empresa.php");
			break;
		default:
			include("include/secciones/inicio/inicio.php");
			break;
	}
	include("include/foot.php"); // FOOTER HTML Y SE CIERRA EL BODY 
}

?>