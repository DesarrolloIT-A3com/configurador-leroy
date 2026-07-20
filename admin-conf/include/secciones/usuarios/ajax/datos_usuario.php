<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// CONSULTAMOS LOS DATOS DE EMPRESA SI ESTÁ ACTIVO
$usuario = $db->getRow('SELECT u.usuario as usuario, u.descuento as descuento, u.activo as activo, um.nombre as nombre, um.cif as cif, um.direccion as direccion, um.poblacion as poblacion, um.cp as cp, um.provincia as provincia, um.email as email, um.telefono as telefono, t.nombre as tarifa, MAX(ua.fecha) as acceso FROM usuarios as u LEFT JOIN usuarios_accesos as ua ON u.id = ua.id_usuarios, usuarios_mod as um, tarifas as t WHERE u.id_usuarios_mod = um.id AND u.tarifa = t.id AND u.id='.$id);

$user = $usuario['usuario'];
$nombre = $usuario['nombre'];
$cif = $usuario['cif'];
$direccion = $usuario['direccion'];
$poblacion = $usuario['poblacion'];
$cp = $usuario['cp'];
$provincia = $usuario['provincia'];
$email = $usuario['email'];
$telefono = $usuario['telefono'];
$tarifa = $usuario['tarifa'];
$descuento = $usuario['descuento'];
$estado = $usuario['activo'];
switch($usuario['activo']){
	case 0:
		$estado = "inactivo";
		break;
	case 1:
		$estado = "activo";
		break;
	default:
		$estado = "";
		break;
}
$fecha = date('d/m/Y H:i:s', strtotime($usuario['acceso']));
$uso = strtotime($usuario['acceso']) < strtotime('-30 days') ? "sinuso" : "enuso";

?>

<div class="ventana_datos_usuario">
	<h2>Datos del usuario</h2>
	<div class="datos_usuario">
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Usuario:</div>
			<div class="texto_datos_usuario"><?php echo $user; ?></div>
		</div>
		<div class="item_datos_usuario">
			
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Empresa:</div>
			<div class="texto_datos_usuario"><?php echo $nombre; ?></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">CIF:</div>
			<div class="texto_datos_usuario"><?php echo $cif; ?></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Dirección:</div>
			<div class="texto_datos_usuario"><?php echo $direccion; ?></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">C. Postal:</div>
			<div class="texto_datos_usuario"><?php echo $cp; ?></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Provincia:</div>
			<div class="texto_datos_usuario"><?php echo $provincia; ?></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Población:</div>
			<div class="texto_datos_usuario"><?php echo $poblacion; ?></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Teléfono:</div>
			<div class="texto_datos_usuario"><?php echo $telefono; ?></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">E-mail:</div>
			<div class="texto_datos_usuario"><?php echo $email; ?></div>
		</div>
		<div class="item_datos_usuario">
			
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Tarifa:</div>
			<div class="texto_datos_usuario"><?php echo $tarifa; ?></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Descuento:</div>
			<div class="texto_datos_usuario"><?php echo $descuento; ?>%</div>
		</div>
		<div class="item_datos_usuario">
			
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Activo:</div>
			<div class="texto_datos_usuario"><span class="estado <?php echo $estado; ?>"><?php echo ucfirst($estado); ?></span></div>
		</div>
		<div class="item_datos_usuario">
			<div class="icono_datos_usuario">Último acceso:</div>
			<div class="texto_datos_usuario"><span class="acceso <?php echo $uso; ?>"><?php echo $fecha; ?></span></div>
		</div>
	</div>
</div>