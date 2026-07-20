<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// CONSULTAMOS EL NOMBRE DEL USUARIO
$nombre = $db->getVar('SELECT um.nombre as nombre FROM usuarios_mod as um, usuarios as u WHERE u.id='.$id.' AND u.id_usuarios_mod = um.id');

// CONSULTAMOS LOS ACCESOS DEL USUSARIO
$accesos = $db->getResults('SELECT id, fecha, ip FROM usuarios_accesos WHERE id_usuarios='.$id.' ORDER BY fecha ASC LIMIT 10');
$num_accesos = $db->getVar('SELECT COUNT(*) FROM usuarios_accesos WHERE id_usuarios='.$id);
?>
<div class="ventana_accesos">
	<h2>Últimos 10 accesos de <?php echo $nombre; ?></h2>
	<div class="lista_accesos">
		<table id="tabla_accesos">
			<thead>
				<tr>
					<th class="centrado">Nº</th>
					<th class="centrado">Fecha</th>
					<th class="centrado">IP</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if($accesos){
					foreach($accesos as $acceso){ 
						$fecha = date('d/m/Y H:i:s', strtotime($acceso['fecha']));
						$ip = $acceso['ip'];
					?>
					<tr>
						<td class="centrado"><?php echo $num_accesos; ?></td>
						<td class="centrado"><?php echo $fecha; ?></td>
						<td class="centrado"><?php echo $ip; ?></td>
					</tr>
					<?php
						$num_accesos--;
					}
				}
				else{
				?>
					<tr><td colspan="12"><center>No hay accesos</center></td></tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<script>
			$("#tabla_accesos").tablesorter( {  // PARA PODER ORDENAR LA TABLA CON JQUERY
				dateFormat: "ddmmyyyy",										// FORMATO PARA ORDENAR FECHA
				headers: { 1: { sorter: "shortDate" } },
				sortList: [[1,1]]                   // ORDEN AL ABRIR 1(FECHA) 1(DESC)
			}); 
		</script>
	</div>
</div>