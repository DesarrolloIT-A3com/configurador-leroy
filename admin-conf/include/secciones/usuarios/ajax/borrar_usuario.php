<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$volver = 0;
if(isset($_POST['volver']) && $_POST['volver'] != 0)	$volver = 1;

$ok = $db->delete('accesos_usuario','id='.$id);

$ok = $db->delete('solicitudes_alta','id=(SELECT um.id_solicitudes_alta FROM usuarios_mod as um, usuarios as u WHERE um.id = u.id_usuarios_mod AND u.id='.$id.')');

if($ok){
		
	$ok = $db->delete('usuarios_mod','id=(SELECT id_usuarios_mod FROM usuarios WHERE id='.$id.')');

	if($ok){
		
		// MIRAMOS SI ESTABA ACTIVO O NO PARA RESTARLO A LOS CONTADORES DE LA CABECERA DEL LISTADO
		$activo = $db->getRow('SELECT activo FROM usuarios WHERE id='.$id);
		
		$ok = $db->delete('usuarios','id='.$id);
			
		if($ok){
			$respuesta['estado'] = 'ok';
			$respuesta['mensaje'] = $activo;
			$respuesta['volver'] = $volver;
		}
		else{
			$respuesta['estado'] = 'ko';
			$respuesta['mensaje'] = 'Error al borrar el usuario. Inténtelo de nuevo.';
		}
	}
	else{
		$respuesta['estado'] = 'ko';
		$respuesta['mensaje'] = 'Error al borrar el usuario. No se pudieron borrar sus datos.';
	}
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al borrar el usuario. No se pudo borrar la solicitud.';
}

echo json_encode($respuesta);
?>