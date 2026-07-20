<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$estado = $db->getVar('SELECT estado_alta FROM solicitudes_alta WHERE id='.$id);

if($estado < 2){ // SI ESTÁ PENDIENTE O RECHAZADO
	$ok = $db->delete('solicitudes_alta','id='.$id);

	if($ok){
		$respuesta['estado'] = 'ok';
		$respuesta['mensaje'] = $estado;
	}
	else{
		$respuesta['estado'] = 'ko';
		$respuesta['mensaje'] = 'Error al borrar la solicitud. Inténtalo de nuevo.';
	}
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al borrar la solicitud. No se pueden borrar solicitudes aprobadas.';
}

echo json_encode($respuesta);
?>