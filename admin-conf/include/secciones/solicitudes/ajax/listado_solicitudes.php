<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// HACE FALTA ABRIR UNA CONEXIÓN A BBDD PARA PODER USAR mysqli
$con = $db->connectDB();

//obtenermos los parámetro pasados
$mostrar = "todos";
if(isset($_POST['mostrar']) && $_POST['mostrar'] != "")			$mostrar = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['mostrar'])));

$orderby = "fecha_solicitud";
//if(isset($_POST['orderby']) && $_POST['orderby'] != "")			$orderby = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['orderby'])));

$order = "DESC";
//if(isset($_POST['order']) && $_POST['order'] != "")				$order = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['order'])));

//formamos la consulta con los parametros pasados
$where = "";
switch($mostrar){
	case "pendientes":
		$where = " AND estado_alta=0";
		break;
	case "rechazados":
		$where = " AND estado_alta=1";
		break;
	case "aprobados":
		$where = " AND estado_alta=2";
		break;
	default:
		$where = " AND estado_alta>=0";
		break;
}

// CONSULTAMOS LOS DATOS DE EMPRESA SI ESTÁ ACTIVO
$solicitudes = $db->getResults('SELECT id, nombre, poblacion, provincia, email, estado_alta, fecha_solicitud FROM solicitudes_alta WHERE 1'.$where.' ORDER BY '.$orderby.' '.$order);

//Consultamos cuantos hay de cada tipo
$consulta = "SELECT COUNT(*) FROM solicitudes_alta WHERE estado_alta>=0";
$todos = $db->getVar($consulta);
$consulta = "SELECT COUNT(*) FROM solicitudes_alta WHERE estado_alta=0";
$pendientes = $db->getVar($consulta);
$consulta = "SELECT COUNT(*) FROM solicitudes_alta WHERE estado_alta=1";
$rechazados = $db->getVar($consulta);
$consulta = "SELECT COUNT(*) FROM solicitudes_alta WHERE estado_alta=2";
$aprobados = $db->getVar($consulta);
?>
<div class="filtro_mostrar">
	<a class="<?= ($mostrar == 'todos') ? 'activo':''; ?>" onClick="listado_solicitudes('todos')">Todos <span class="contador">(<span id="todos"><?=$todos?></span>)</span></a> | <a class="<?= ($mostrar == 'pendientes') ? 'activo':''; ?>" onClick="listado_solicitudes('pendientes')">Pendientes <span class="contador">(<span id="pendientes"><?=$pendientes?></span>)</span></a> | <a class="<?= ($mostrar == 'rechazados') ? 'activo':''; ?>" onClick="listado_solicitudes('rechazados')">Rechazados <span class="contador">(<span id="rechazados"><?=$rechazados?></span>)</span></a> | <a class="<?= ($mostrar == 'aprobados') ? 'activo':''; ?>" onClick="listado_solicitudes('aprobados')">Aprobados <span class="contador">(<span id="aprobados"><?=$aprobados?></span>)</span></a>
</div>
<div class="lista_solicitudes">
	<table id="tabla_solicitudes">
		<thead>
			<tr>
				<th class="">Nombre</th>
				<th class="">Población</th>
				<th class="">Provincia</th>
				<th class="">E-mail</th>
				<th class="centrado">Fecha</th>
				<th class="centrado">Estado</th>
				<th class="centrado acciones">Acción</th> 
			</tr>
		</thead>
		<tbody>
			<?php 
			if($solicitudes){
				foreach($solicitudes as $solicitud){ 
					$id = $solicitud['id'];
					$nombre = $solicitud['nombre'];
					$poblacion = $solicitud['poblacion'];
					$provincia = $solicitud['provincia'];
					$email = $solicitud['email'];
					$fecha = date('d/m/Y H:i:s', strtotime($solicitud['fecha_solicitud']));
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
				?>
				<tr id="solicitud-<?php echo $id; ?>">
					<td><a class="ajax-popup-link" href="index.php?seccion=ajax&sub=datos_solicitud&id=<?php echo $id; ?>" title="Ver datos completos"><i class="fa fa-id-card-o"></i> <?php echo $nombre; ?></a></td>
					<td><?php echo $poblacion; ?></td>
					<td><?php echo $provincia; ?></td>
					<td><?php echo $email; ?></td>
					<td class="centrado"><?php echo $fecha; ?></td>
					<td class="centrado"><span class="estado <?php echo $estado; ?>"><?php echo ucfirst($estado); ?></span></td>
					<td class="derecha"><?php if($estado == 'pendiente'){ ?><a class="acciones aprobar_rechazar" onClick="datos_aprobar_solicitud(<?php echo $id; ?>)" title="Aprobar solicitud"><i class="fa fa-check-circle"></i></a> <a class="acciones aprobar_rechazar" onClick="confirmar_rechazar_solicitud(<?php echo $id; ?>)" title="Rechazar solicitud"><i class="fa fa-times-circle"></i></a><?php } ?> <?php if($estado != 'aprobado'){ ?><a class="acciones" onClick="confirmar_borrar_solicitud(<?php echo $id; ?>);" title="Eliminar solicitud"><i class="fa fa-trash"></i></a><?php } ?></td>
				</tr>
				<?php
				}
			}
			else{
			?>
				<tr><td colspan="12"><center>No hay solicitudes</center></td></tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<script>
		$("#tabla_solicitudes").tablesorter( {  							// PARA PODER ORDENAR LA TABLA CON JQUERY
			dateFormat: "ddmmyyyy",										// FORMATO PARA ORDENAR FECHA
			headers: { 4: { sorter: "shortDate" }, 6: { sorter: false } },	// EN TODAS LAS COLUMNAS MENOS LA SEXTA(ACCIÓN), COLUMNA 4 FECHA
			sortList: [[4,1]]                  								// ORDEN AL ABRIR 4(FECHA) 1(DESC)
		}); 
	</script>
</div>