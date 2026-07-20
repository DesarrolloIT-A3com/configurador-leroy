<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$estado = $db->getVar('SELECT activo FROM usuarios WHERE id='.$id);

if($estado == 1){ // SOLO SI ESTÁ ACTIVO
	$ok = $db->update('usuarios','activo=0','id='.$id);

	if($ok){
		$respuesta['estado'] = 'ok';
		$respuesta['mensaje'] = '';
	}
	else{
		$respuesta['estado'] = 'ko';
		$respuesta['mensaje'] = 'Error al desactivar el usuario. Inténtalo de nuevo.';
	}
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al desactivar el usuario. Ya está inactivo.';
}

echo json_encode($respuesta);
?>