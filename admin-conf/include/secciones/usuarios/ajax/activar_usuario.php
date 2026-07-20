<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$estado = $db->getVar('SELECT activo FROM usuarios WHERE id='.$id);

if($estado < 1){ // SOLO SI ESTÁ INACTIVO
	$ok = $db->update('usuarios','activo=1','id='.$id);

	if($ok){
		$respuesta['estado'] = 'ok';
		$respuesta['mensaje'] = '';
	}
	else{
		$respuesta['estado'] = 'ko';
		$respuesta['mensaje'] = 'Error al activar el usuario. Inténtalo de nuevo.';
	}
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al activar el usuario. Ya está activo.';
}

echo json_encode($respuesta);
?>