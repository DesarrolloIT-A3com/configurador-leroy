<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// HACE FALTA ABRIR UNA CONEXIÓN A BBDD PARA PODER USAR mysqli
$con = $db->connectDB();

//obtenermos los parámetro pasados
$mostrar = "todos";
if(isset($_POST['mostrar']) && $_POST['mostrar'] != "")			$mostrar = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['mostrar'])));

$orderby = "fecha_proyecto";

$order = "DESC";

//formamos la consulta con los parametros pasados
$where = "";
switch($mostrar){
	case "enviados":
		$where = " AND enviado=1";
		break;
	case "no_enviados":
		$where = " AND enviado=0";
		break;
	default:
		$where = "";
		break;
}

// CONSULTAMOS LOS DATOS DE LOS PROYECTOS
$proyectos = $db->getResults('SELECT id, nombre_cliente, dni_cliente, poblacion_cliente, provincia_cliente, fecha_proyecto, enviado, fecha_enviado FROM proyectos WHERE id_usuario='.$_SESSION['id_usuario'].' AND eliminado = 0 '.$where.' ORDER BY '.$orderby.' '.$order);

//Consultamos cuantos hay de cada tipo
$consulta = "SELECT COUNT(*) FROM proyectos WHERE id_usuario=".$_SESSION['id_usuario']." AND eliminado = 0";
$todos = $db->getVar($consulta);
$consulta = "SELECT COUNT(*) FROM proyectos WHERE id_usuario=".$_SESSION['id_usuario']." AND eliminado = 0 AND enviado=0";
$no_enviados = $db->getVar($consulta);
$consulta = "SELECT COUNT(*) FROM proyectos WHERE id_usuario=".$_SESSION['id_usuario']." AND eliminado = 0 AND enviado=1";
$enviados = $db->getVar($consulta);

?>
<div class="filtro_mostrar">
	<a class="<?= ($mostrar == 'todos') ? 'activo':''; ?>" onClick="listado_proyectos('todos')">Todos <span class="contador">(<span id="todos"><?=$todos?></span>)</span></a> | <a class="<?= ($mostrar == 'enviados') ? 'activo':''; ?>" onClick="listado_proyectos('enviados')">Enviados <span class="contador">(<span id="enviados"><?=$enviados?></span>)</span></a> | <a class="<?= ($mostrar == 'no_enviados') ? 'activo':''; ?>" onClick="listado_proyectos('no_enviados')">No enviados <span class="contador">(<span id="no_enviados"><?=$no_enviados?></span>)</span></a>
</div>
<div class="lista_proyectos">
	<table id="tabla_proyectos">
		<thead>
			<tr>
				<th class="">Proyecto</th>
				<th class="">Cliente</th>
				<th class="">DNI</th>
				<th class="">Localización</th>
				<th class="centrado">Fecha</th>
				<th class="centrado">Enviado</th>
				<th class="centrado acciones">Acción</th> 
			</tr>
		</thead>
		<tbody>
			<?php 
			if($proyectos){
				foreach($proyectos as $proyecto){ 
					$id = $proyecto['id'];
					$cliente = $proyecto['nombre_cliente'];
					$dni = $proyecto['dni_cliente'];
					$localizacion = $proyecto['poblacion_cliente'].' ('.$proyecto['provincia_cliente'].')';
					$fecha = date('d/m/Y H:i:s', strtotime($proyecto['fecha_proyecto']));
					$enviado = $proyecto['enviado'];
					$fecha_enviado = date('d/m/Y', strtotime($proyecto['fecha_enviado']));
					
					
					switch($proyecto['enviado']){
						case 0:
							$enviado = "no_enviado";
							break;
						case 1:
							$enviado = "enviado";
							break;
						default:
							$enviado = "";
							break;
					}
				?>
				<tr id="proyecto-<?php echo $id; ?>">
					<td><a class="ver_proyecto" title="Ver proyecto" href="index.php?seccion=proyectos&sub=ver_proyecto&id=<?php echo $id; ?>">P<?php echo str_pad($id, 6, "0", STR_PAD_LEFT); ?></a></td>
					<td><?php echo $cliente; ?></td>
					<td><?php echo $dni; ?></td>
					<td><?php echo $localizacion; ?></td>
					<td class="centrado"><?php echo $fecha; ?></td>
					<td class="centrado"><span class="estado <?php echo $enviado; ?>"><?php echo ucfirst(str_replace('_', ' ', $enviado)); ?><?php if($enviado == 'enviado'){ echo " <br /> ".$fecha_enviado; } ?></span></td>
					<td class="centrado"><a class="acciones enviar <?php if($enviado == 'enviado'){ echo 'oculto'; } ?>" onClick="confirmar_enviar_proyecto(<?php echo $id; ?>)" title="Enviar proyecto"><i class="fa fa-share"></i></a> <a class="acciones" onClick="confirmar_borrar_proyecto(<?php echo $id; ?>);" title="Eliminar proyecto"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php
				}
			}
			else{
			?>
				<tr><td colspan="7"><center>No hay proyectos</center></td></tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<script type="text/javascript">
		$("#tabla_proyectos").tablesorter( {  // PARA PODER ORDENAR LA TABLA CON JQUERY
			dateFormat: "ddmmyyyy",										// FORMATO PARA ORDENAR FECHA
			headers: { 4: { sorter: "shortDate" }, 6: { sorter: false } },   // EN TODAS LAS COLUMNAS
			sortList: [[4,1]]                   // ORDEN AL ABRIR 4(FECHA) 1(DESC)
		}); 
	</script>
</div>