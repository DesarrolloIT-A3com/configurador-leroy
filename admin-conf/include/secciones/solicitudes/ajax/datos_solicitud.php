<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// CONSULTAMOS LOS DATOS DE EMPRESA SI ESTÁ ACTIVO
$solicitud = $db->getRow('SELECT nombre, cif, direccion, poblacion, cp, provincia, email, telefono, estado_alta, fecha_solicitud, ip_solicitud FROM solicitudes_alta WHERE id='.$id);

$nombre = $solicitud['nombre'];
$cif = $solicitud['cif'];
$direccion = $solicitud['direccion'];
$poblacion = $solicitud['poblacion'];
$cp = $solicitud['cp'];
$provincia = $solicitud['provincia'];
$email = $solicitud['email'];
$telefono = $solicitud['telefono'];
$estado = $solicitud['estado_alta'];
switch($solicitud['estado_alta']){
	case 0:
		$estado = "pendiente";
		break;
	case 1:
		$estado = "rechazado";
		break;
	case 2:
		$estado = "aprobado";
		break;
	default:
		$estado = "";
		break;
}
$fecha = date('d/m/Y H:i:s', strtotime($solicitud['fecha_solicitud']));;
$ip = $solicitud['ip_solicitud'];

?>

<div class="ventana_datos_solicitud">
	<h2>Datos de la solicitud</h2>
	<div class="datos_solicitud">
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">Empresa:</div>
			<div class="texto_datos_solicitud"><?php echo $nombre; ?></div>
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">CIF:</div>
			<div class="texto_datos_solicitud"><?php echo $cif; ?></div>
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">Dirección:</div>
			<div class="texto_datos_solicitud"><?php echo $direccion; ?></div>
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">C. Postal:</div>
			<div class="texto_datos_solicitud"><?php echo $cp; ?></div>
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">Provincia:</div>
			<div class="texto_datos_solicitud"><?php echo $provincia; ?></div>
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">Población:</div>
			<div class="texto_datos_solicitud"><?php echo $poblacion; ?></div>
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">Teléfono:</div>
			<div class="texto_datos_solicitud"><?php echo $telefono; ?></div>
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">E-mail:</div>
			<div class="texto_datos_solicitud"><?php echo $email; ?></div>
		</div>
		<div class="item_datos_solicitud">
			
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">Fecha:</div>
			<div class="texto_datos_solicitud"><?php echo $fecha; ?></div>
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">IP:</div>
			<div class="texto_datos_solicitud"><?php echo $ip; ?></div>
		</div>
		<div class="item_datos_solicitud">
			
		</div>
		<div class="item_datos_solicitud">
			<div class="icono_datos_solicitud">Estado:</div>
			<div class="texto_datos_solicitud"><span class="estado <?php echo $estado; ?>"><?php echo ucfirst($estado); ?></span></div>
		</div>
		<div class="item_datos_solicitud botones">
			<?php if($estado == 'pendiente'){ ?>
			<a class="boton verde grande" onClick="datos_aprobar_solicitud_timeout(<?php echo $id; ?>); $.magnificPopup.close();"><i class="fa fa-check"></i> Aprobar solicitud</a> 
			<a class="boton rojo grande" onClick="confirmar_rechazar_solicitud_timeout(<?php echo $id; ?>); $.magnificPopup.close();"><i class="fa fa-times"></i> Rechazar solicitud</a>
			<?php } ?> 
			<?php if($estado != 'aprobado'){ ?>
			<a class="boton naranja grande" onClick="$.magnificPopup.close(); confirmar_borrar_solicitud_timeout(<?php echo $id; ?>);"><i class="fa fa-times"></i> Eliminar solicitud</a>
			<?php
			}
			?>
		</div>
	</div>
</div>