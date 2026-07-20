<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

$volver = 0;
if(isset($_POST['volver']) && $_POST['volver'] != 0)	$volver = 1;

// MIRAMOS SI ESTABA ENVIADO O NO PARA RESTARLO A LOS CONTADORES DE LA CABECERA DEL LISTADO
$enviado = $db->getVar('SELECT enviado FROM proyectos WHERE id_usuario='.$_SESSION['id_usuario'].' AND id='.$id);

// LO MARCAMOS COMO ELIMINADO PARA QUE NO LE APAREZCA AL DISTRIBUIDOR PERO NO LO BORRAMOS PARA QUE LE APAREZCA A LOS ADMINISTRADORES
$ok = $db->update('proyectos','eliminado=1, fecha_eliminado=NOW()','id_usuario='.$_SESSION['id_usuario'].' AND id='.$id);

	
if($ok){
	$respuesta['estado'] = 'ok';
	$respuesta['mensaje'] = $enviado;
	$respuesta['volver'] = $volver;
}
else{
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al borrar el proyecto. Inténtelo de nuevo.';
	$respuesta['volver'] = $volver;
}

echo json_encode($respuesta);
?>