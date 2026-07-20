<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// NOMBRE DEL USUARIO
$usuario = $db->getVar('SELECT um.nombre FROM usuarios as u, usuarios_mod as um WHERE u.id_usuarios_mod = um.id AND u.id='.$id);

// CONSULTAMOS LOS DATOS DE LOS PROYECTOS
$proyectos = $db->getResults('SELECT id, fecha_proyecto, enviado, fecha_enviado, eliminado, fecha_eliminado FROM proyectos WHERE id_usuario='.$id.' ORDER BY fecha_proyecto DESC LIMIT 10');
?>

<div class="ventana_proyectos_usuario">
	<h2>Últimos 10 proyectos de <?php echo $usuario; ?></h2>
	<div class="resumen_proyectos_usuario">
		<table id="tabla_proyectos">
			<thead>
				<tr>
					<th class="">Proyecto</th>
					<th class="centrado">Fecha</th>
					<th class="centrado">Enviado</th>
					<th class="centrado">Eliminado</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if($proyectos){
					foreach($proyectos as $proyecto){ 
						$id_proyecto = $proyecto['id'];
						$fecha = date('d/m/Y H:i:s', strtotime($proyecto['fecha_proyecto']));
						$fecha_enviado = date('d/m/Y', strtotime($proyecto['fecha_enviado']));
						$fecha_eliminado = date('d/m/Y', strtotime($proyecto['fecha_eliminado']));
						
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
						
						switch($proyecto['eliminado']){
							case 0:
								$eliminado = "no_eliminado";
								break;
							case 1:
								$eliminado = "eliminado";
								break;
							default:
								$eliminado = "";
								break;
						}
					?>
					<tr id="proyecto-<?php echo $id_proyecto; ?>">
						<td><a class="ver_proyecto" title="Ver proyecto" href="index.php?seccion=usuarios&sub=ver_proyecto&id=<?php echo $id_proyecto; ?>">P<?php echo str_pad($id_proyecto, 6, "0", STR_PAD_LEFT); ?></a></td>
						<td class="centrado"><?php echo $fecha; ?></td>
						<td class="centrado"><span class="estado <?php echo $enviado; ?>"><?php echo ucfirst(str_replace('_', ' ', $enviado)); ?><?php if($enviado == 'enviado'){ echo " <br /> ".$fecha_enviado; } ?></span></td>
						<td class="centrado"><span class="borrado <?php echo $eliminado; ?>"><?php echo ucfirst(str_replace('_', ' ', $eliminado)); ?><?php if($eliminado == 'eliminado'){ echo " <br /> ".$fecha_eliminado; } ?></span></td>
					</tr>
					<?php
					}
				}
				else{
				?>
					<tr><td colspan="3"><center>No hay proyectos</center></td></tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<script type="text/javascript">
			$("#tabla_proyectos").tablesorter( {  // PARA PODER ORDENAR LA TABLA CON JQUERY
				dateFormat: "ddmmyyyy",										// FORMATO PARA ORDENAR FECHA
				headers: { 1: { sorter: "shortDate" } },   // EN TODAS LAS COLUMNAS
				sortList: [[1,1]]                   // ORDEN AL ABRIR 1(FECHA) 1(DESC)
			}); 
		</script>
	</div>
</div>