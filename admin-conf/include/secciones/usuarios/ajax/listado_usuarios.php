<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// HACE FALTA ABRIR UNA CONEXIÓN A BBDD PARA PODER USAR mysqli
$con = $db->connectDB();

//obtenermos los parámetro pasados
$mostrar = "todos";
if(isset($_POST['mostrar']) && $_POST['mostrar'] != "")			$mostrar = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['mostrar'])));

$orderby = "nombre";
//if(isset($_POST['orderby']) && $_POST['orderby'] != "")			$orderby = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['orderby'])));

$order = "ASC";
//if(isset($_POST['order']) && $_POST['order'] != "")				$order = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['order'])));

//formamos la consulta con los parametros pasados
$where = "";
switch($mostrar){
	case "inactivos":
		$where = " AND activo=0";
		break;
	case "activos":
		$where = " AND activo=1";
		break;
	default:
		$where = " AND activo>=0";
		break;
}

// CONSULTAMOS LOS DATOS DE EMPRESA SI ESTÁ ACTIVO
$usuarios = $db->getResults('SELECT u.id as id, u.usuario as usuario, u.activo as activo, um.nombre as nombre, t.nombre as tarifa, MAX(ua.fecha) as acceso FROM usuarios as u LEFT JOIN usuarios_accesos as ua ON u.id = ua.id_usuarios, usuarios_mod as um, tarifas as t WHERE u.id_usuarios_mod = um.id AND u.tarifa = t.id '.$where.' GROUP BY u.id ORDER BY '.$orderby.' '.$order);

//Consultamos cuantos hay de cada tipo
$consulta = "SELECT COUNT(*) FROM usuarios WHERE activo>=0";
$todos = $db->getVar($consulta);
$consulta = "SELECT COUNT(*) FROM usuarios WHERE activo=0";
$inactivos = $db->getVar($consulta);
$consulta = "SELECT COUNT(*) FROM usuarios WHERE activo=1";
$activos = $db->getVar($consulta);

?>
<div class="filtro_mostrar">
	<a class="<?= ($mostrar == 'todos') ? 'activo':''; ?>" onClick="listado_usuarios('todos')">Todos <span class="contador">(<span id="todos"><?=$todos?></span>)</span></a> | <a class="<?= ($mostrar == 'activos') ? 'activo':''; ?>" onClick="listado_usuarios('activos')">Activos <span class="contador">(<span id="activos"><?=$activos?></span>)</span></a> | <a class="<?= ($mostrar == 'inactivos') ? 'activo':''; ?>" onClick="listado_usuarios('inactivos')">Inactivos <span class="contador">(<span id="inactivos"><?=$inactivos?></span>)</span></a>
</div>
<div class="lista_usuarios">
	<table id="tabla_usuarios">
		<thead>
			<tr>
				<th class="">Nombre</th>
				<th class="">Usuario</th>
				<th class="">Tarifa</th>
				<th class="centrado">Datos</th>
				<th class="centrado">Proyectos</th>
				<th class="centrado">Accesos</th>
				<th class="centrado">Activo</th>
				<th class="centrado acciones">Acción</th> 
			</tr>
		</thead>
		<tbody>
			<?php 
			if($usuarios){
				foreach($usuarios as $usuario){ 
					$id = $usuario['id'];
					$nombre = $usuario['nombre'];
					$user = $usuario['usuario'];
					$tarifa = $usuario['tarifa'];
					$acceso = $usuario['acceso'] ? date('d/m/Y H:i:s', strtotime($usuario['acceso'])) : 'Sin acceso';
					$uso = $usuario['acceso'] && strtotime($usuario['acceso']) < strtotime('-30 days') ? "sinuso" : "enuso";
					$activo = $usuario['activo'];
					
					
					switch($usuario['activo']){
						case 0:
							$activo = "inactivo";
							break;
						case 1:
							$activo = "activo";
							break;
						default:
							$estado = "";
							break;
					}
				?>
				<tr id="usuario-<?php echo $id; ?>">
					<td><a class="editar_usuario" href="index.php?seccion=usuarios&sub=ver_usuario&id=<?php echo $id; ?>" title="Ver datos completos"><?php echo $nombre; ?></a></td>
					<td><?php echo $user; ?></td>
					<td><?php echo $tarifa; ?></td>
					<td class="centrado"><a class="ajax-popup-link" href="index.php?seccion=ajax&sub=datos_usuario&id=<?php echo $id; ?>" title="Ver datos de usuario"><i class="fa fa-id-card-o"></i></a></td>
					<td class="centrado"><a class="ajax-popup-link" href="index.php?seccion=ajax&sub=resumen_proyectos_usuario&id=<?php echo $id; ?>" title="Ver proyectos"><i class="fa fa-file-powerpoint-o"></i></a></td>
					<td class="centrado"><span class="acceso <?php echo $uso; ?>"><?php echo $acceso; ?></span> <a class="ajax-popup-link" href="index.php?seccion=ajax&sub=listado_accesos&id=<?php echo $id; ?> title="Ver accesos"><i class="fa fa-history"></i></a></td>
					<td class="centrado"><span class="estado <?php echo $activo; ?>"><?php echo ucfirst($activo); ?></span></td>
					<td class="centrado"><a class="acciones activar <?php if($activo == 'activo'){ echo 'oculto'; } ?>" onClick="activar_usuario(<?php echo $id; ?>)" title="Activar usuario"><i class="fa fa-check-circle"></i></a> <a class="acciones desactivar <?php if($activo == 'inactivo'){ echo 'oculto'; } ?>" onClick="desactivar_usuario(<?php echo $id; ?>)" title="Desactivar usuario"><i class="fa fa-times-circle"></i></a> <a class="acciones" onClick="confirmar_borrar_usuario(<?php echo $id; ?>);" title="Eliminar usuario"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php
				}
			}
			else{
			?>
				<tr><td colspan="12"><center>No hay usuarios</center></td></tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<script>
		$("#tabla_usuarios").tablesorter( {  // PARA PODER ORDENAR LA TABLA CON JQUERY
			dateFormat: "ddmmyyyy",										// FORMATO PARA ORDENAR FECHA
			headers: { 5: { sorter: "shortDate" }, 3: { sorter: false}, 4: { sorter: false}, 7: { sorter: false} },   // EN TODAS LAS COLUMNAS MENOS LA 3(DATOS), 4(PRESUPUESTOS) Y 5(ACCIÓN)
			sortList: [[0,0]]                   // ORDEN AL ABRIR 0(NOMBRE) 0(ASC)
		}); 
	</script>
</div>