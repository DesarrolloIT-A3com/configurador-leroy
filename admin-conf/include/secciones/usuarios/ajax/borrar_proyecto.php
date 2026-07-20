<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

$volver = 0;
if(isset($_POST['volver']) && $_POST['volver'] != 0)	$volver = 1;

// MIRAMOS SI ESTABA ENVIADO O NO PARA RESTARLO A LOS CONTADORES DE LA CABECERA DEL LISTADO
$proyecto = $db->getRow('SELECT id_usuario, enviado FROM proyectos WHERE id='.$id);

// LO MARCAMOS COMO ELIMINADO PARA QUE NO LE APAREZCA AL DISTRIBUIDOR PERO NO LO BORRAMOS PARA QUE LE APAREZCA A LOS ADMINISTRADORES
$ok = $db->delete('proyectos','id='.$id);

	
if($ok){
	$respuesta['estado'] = 'ok';
	$respuesta['mensaje'] = $proyecto['enviado'];
	$respuesta['volver'] = $volver;
	$respuesta['usuario'] = $proyecto['id_usuario'];
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al borrar el proyecto. Inténtelo de nuevo.';
	$respuesta['volver'] = $volver;
}

echo json_encode($respuesta);
?>