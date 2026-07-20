<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado']!="logged")
	die();

// HACE FALTA ABRIR UNA CONEXIÓN A BBDD PARA PODER USAR mysqli
$con = $db->connectDB();

// VEMOS TODOS LOS DATOS DEL FORMULARIO
$distribuidor = $_SESSION['id_usuario'];
$tarifa = 0;
if(isset($_POST['tarifa']) && $_POST['tarifa'] > 0)														$tarifa = (int)$_POST['tarifa']; 
$descuento = 0;
if(isset($_POST['descuento']) && $_POST['descuento'] > 0)												$descuento = (float)$_POST['descuento'];
$serie_marcada = 0;
if(isset($_POST['serie_marcada']) && $_POST['serie_marcada'] > 0)										$serie_marcada = (int)$_POST['serie_marcada'];
$acabado_marcado = 0;
if(isset($_POST['acabado_marcado']) && $_POST['acabado_marcado'] > 0)									$acabado_marcado = (int)$_POST['acabado_marcado'];
$perfileria_marcada = 0;
if(isset($_POST['perfileria_marcada']) && $_POST['perfileria_marcada'] > 0)								$perfileria_marcada = (int)$_POST['perfileria_marcada'];
$medidas_ancho = 0;
if(isset($_POST['medidas_ancho']) && $_POST['medidas_ancho'] > 0)										$medidas_ancho = (float)$_POST['medidas_ancho'];
$medidas_alto = 0;
if(isset($_POST['medidas_alto']) && $_POST['medidas_alto'] > 0)											$medidas_alto = (float)$_POST['medidas_alto'];
$medidas_fondo = 0;
if(isset($_POST['medidas_fondo']) && $_POST['medidas_fondo'] > 0)										$medidas_fondo = (float)$_POST['medidas_fondo'];
$puertas_marcado = 0;
if(isset($_POST['puertas_marcado']) && $_POST['puertas_marcado'] > 0)									$puertas_marcado = (int)$_POST['puertas_marcado'];
$diseno_puerta_1 = "";
if(isset($_POST['diseno_puerta_1']) && $_POST['diseno_puerta_1'] != "")									$diseno_puerta_1 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['diseno_puerta_1'])));
$diseno_puerta_2 = "";
if(isset($_POST['diseno_puerta_2']) && $_POST['diseno_puerta_2'] != "")									$diseno_puerta_2 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['diseno_puerta_2'])));
$diseno_puerta_3 = "";
if(isset($_POST['diseno_puerta_3']) && $_POST['diseno_puerta_3'] != "")									$diseno_puerta_3 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['diseno_puerta_3'])));
$diseno_puerta_4 = "";
if(isset($_POST['diseno_puerta_4']) && $_POST['diseno_puerta_4'] != "")									$diseno_puerta_4 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['diseno_puerta_4'])));
$diseno_puerta_5 = "";
if(isset($_POST['diseno_puerta_5']) && $_POST['diseno_puerta_5'] != "")									$diseno_puerta_5 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['diseno_puerta_5'])));
$diseno_puerta_6 = "";
if(isset($_POST['diseno_puerta_6']) && $_POST['diseno_puerta_6'] != "")									$diseno_puerta_6 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['diseno_puerta_6'])));
$diseno_puerta_7 = "";
if(isset($_POST['diseno_puerta_7']) && $_POST['diseno_puerta_7'] != "")									$diseno_puerta_7 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['diseno_puerta_7'])));
$diseno_puerta_8 = "";
if(isset($_POST['diseno_puerta_8']) && $_POST['diseno_puerta_8'] != "")									$diseno_puerta_8 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['diseno_puerta_8'])));
$ceramica_puerta_1 = 0;
if(isset($_POST['ceramica_puerta_1']) && $_POST['ceramica_puerta_1'] > 0)								$ceramica_puerta_1 = (int)$_POST['ceramica_puerta_1'];
$ceramica_puerta_2 = 0;
if(isset($_POST['ceramica_puerta_2']) && $_POST['ceramica_puerta_2'] > 0)								$ceramica_puerta_2 = (int)$_POST['ceramica_puerta_2'];
$ceramica_puerta_3 = 0;
if(isset($_POST['ceramica_puerta_3']) && $_POST['ceramica_puerta_3'] > 0)								$ceramica_puerta_3 = (int)$_POST['ceramica_puerta_3'];
$ceramica_puerta_4 = 0;
if(isset($_POST['ceramica_puerta_4']) && $_POST['ceramica_puerta_4'] > 0)								$ceramica_puerta_4 = (int)$_POST['ceramica_puerta_4'];
$ceramica_puerta_5 = 0;
if(isset($_POST['ceramica_puerta_5']) && $_POST['ceramica_puerta_5'] > 0)								$ceramica_puerta_5 = (int)$_POST['ceramica_puerta_5'];
$ceramica_puerta_6 = 0;
if(isset($_POST['ceramica_puerta_6']) && $_POST['ceramica_puerta_6'] > 0)								$ceramica_puerta_6 = (int)$_POST['ceramica_puerta_6'];
$ceramica_puerta_7 = 0;
if(isset($_POST['ceramica_puerta_7']) && $_POST['ceramica_puerta_7'] > 0)								$ceramica_puerta_7 = (int)$_POST['ceramica_puerta_7'];
$ceramica_puerta_8 = 0;
if(isset($_POST['ceramica_puerta_8']) && $_POST['ceramica_puerta_8'] > 0)								$ceramica_puerta_8 = (int)$_POST['ceramica_puerta_8'];
$colores_puerta_1 = "";
if(isset($_POST['colores_puerta_1']) && $_POST['colores_puerta_1'] != "")								$colores_puerta_1 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['colores_puerta_1'])));
$colores_puerta_2 = "";
if(isset($_POST['colores_puerta_2']) && $_POST['colores_puerta_2'] != "")								$colores_puerta_2 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['colores_puerta_2'])));
$colores_puerta_3 = "";
if(isset($_POST['colores_puerta_3']) && $_POST['colores_puerta_3'] != "")								$colores_puerta_3 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['colores_puerta_3'])));
$colores_puerta_4 = "";
if(isset($_POST['colores_puerta_4']) && $_POST['colores_puerta_4'] != "")								$colores_puerta_4 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['colores_puerta_4'])));
$colores_puerta_5 = "";
if(isset($_POST['colores_puerta_5']) && $_POST['colores_puerta_5'] != "")								$colores_puerta_5 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['colores_puerta_5'])));
$colores_puerta_6 = "";
if(isset($_POST['colores_puerta_6']) && $_POST['colores_puerta_6'] != "")								$colores_puerta_6 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['colores_puerta_6'])));
$colores_puerta_7 = "";
if(isset($_POST['colores_puerta_7']) && $_POST['colores_puerta_7'] != "")								$colores_puerta_7 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['colores_puerta_7'])));
$colores_puerta_8 = "";
if(isset($_POST['colores_puerta_8']) && $_POST['colores_puerta_8'] != "")								$colores_puerta_8 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['colores_puerta_8'])));
$modulos_interior = 0;
if(isset($_POST['modulos_interior']) && $_POST['modulos_interior'] > 0)									$modulos_interior = (int)$_POST['modulos_interior'];
$interior_puerta_1 = "";
if(isset($_POST['interior_puerta_1']) && $_POST['interior_puerta_1'] != "")								$interior_puerta_1 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['interior_puerta_1'])));
$interior_puerta_2 = "";
if(isset($_POST['interior_puerta_2']) && $_POST['interior_puerta_2'] != "")								$interior_puerta_2 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['interior_puerta_2'])));
$interior_puerta_3 = "";
if(isset($_POST['interior_puerta_3']) && $_POST['interior_puerta_3'] != "")								$interior_puerta_3 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['interior_puerta_3'])));
$interior_puerta_4 = "";
if(isset($_POST['interior_puerta_4']) && $_POST['interior_puerta_4'] != "")								$interior_puerta_4 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['interior_puerta_4'])));
$interior_puerta_5 = "";
if(isset($_POST['interior_puerta_5']) && $_POST['interior_puerta_5'] != "")								$interior_puerta_5 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['interior_puerta_5'])));
$interior_puerta_6 = "";
if(isset($_POST['interior_puerta_6']) && $_POST['interior_puerta_6'] != "")								$interior_puerta_6 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['interior_puerta_6'])));
$interior_puerta_7 = "";
if(isset($_POST['interior_puerta_7']) && $_POST['interior_puerta_7'] != "")								$interior_puerta_7 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['interior_puerta_7'])));
$interior_puerta_8 = "";
if(isset($_POST['interior_puerta_8']) && $_POST['interior_puerta_8'] != "")								$interior_puerta_8 = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['interior_puerta_8'])));
$laterales_seleccionado = 0;
if(isset($_POST['laterales_seleccionado']) && $_POST['laterales_seleccionado'] > 0)						$laterales_seleccionado = (int)$_POST['laterales_seleccionado'];
$tapetas_seleccionado = 0;
if(isset($_POST['tapetas_seleccionado']) && $_POST['tapetas_seleccionado'] > 0)							$tapetas_seleccionado = (int)$_POST['tapetas_seleccionado'];
$costados_seleccionado = 0;
if(isset($_POST['costados_seleccionado']) && $_POST['costados_seleccionado'] > 0)						$costados_seleccionado = (int)$_POST['costados_seleccionado'];
$fijos_seleccionado = 0;
if(isset($_POST['fijos_seleccionado']) && $_POST['fijos_seleccionado'] > 0)								$fijos_seleccionado = (int)$_POST['fijos_seleccionado'];
$montaje_frente_seleccionado = 0;
if(isset($_POST['montaje_frente_seleccionado']) && $_POST['montaje_frente_seleccionado'] > 0)			$montaje_frente_seleccionado = (int)$_POST['montaje_frente_seleccionado'];
$montaje_interior_seleccionado = 0;
if(isset($_POST['montaje_interior_seleccionado']) && $_POST['montaje_interior_seleccionado'] > 0)		$montaje_interior_seleccionado = (int)$_POST['montaje_interior_seleccionado'];
$desmontaje_frente_seleccionado = 0;
if(isset($_POST['desmontaje_frente_seleccionado']) && $_POST['desmontaje_frente_seleccionado'] > 0)		$desmontaje_frente_seleccionado = (int)$_POST['desmontaje_frente_seleccionado'];
$desmontaje_interior_seleccionado = 0;
if(isset($_POST['desmontaje_interior_seleccionado']) && $_POST['desmontaje_interior_seleccionado'] > 0)	$desmontaje_interior_seleccionado = (int)$_POST['desmontaje_interior_seleccionado'];
$juego_led_seleccionado = 0;
if(isset($_POST['juego_led_seleccionado']) && $_POST['juego_led_seleccionado'] > 0)						$juego_led_seleccionado = (int)$_POST['juego_led_seleccionado'];
$rematar_frente_seleccionado = 0;
if(isset($_POST['remate_frente_seleccionado']) && $_POST['remate_frente_seleccionado'] > 0)				$rematar_frente_seleccionado = (int)$_POST['remate_frente_seleccionado'];
$rematar_interior_seleccionado = 0;
if(isset($_POST['remate_interior_seleccionado']) && $_POST['remate_interior_seleccionado'] > 0)			$rematar_interior_seleccionado = (int)$_POST['remate_interior_seleccionado'];
$sistema_frenos_seleccionado = 0;
if(isset($_POST['sistema_frenos_seleccionado']) && $_POST['sistema_frenos_seleccionado'] > 0)			$sistema_frenos_seleccionado = (int)$_POST['sistema_frenos_seleccionado'];
$regleta_led_seleccionado = 0;
if(isset($_POST['regleta_led_seleccionado']) && $_POST['regleta_led_seleccionado'] > 0)					$regleta_led_seleccionado = (int)$_POST['regleta_led_seleccionado'];
$frente_abuardillado_seleccionado = 0;
if(isset($_POST['frente_abuardillado_seleccionado']) && $_POST['frente_abuardillado_seleccionado'] > 0)	$frente_abuardillado_seleccionado = (int)$_POST['frente_abuardillado_seleccionado'];
$albanileria_con_seleccionado = 0;
if(isset($_POST['albanileria_con_seleccionado']) && $_POST['albanileria_con_seleccionado'] > 0)			$albanileria_con_seleccionado = (int)$_POST['albanileria_con_seleccionado'];
$albanileria_sin_seleccionado = 0;
if(isset($_POST['albanileria_sin_seleccionado']) && $_POST['albanileria_sin_seleccionado'] > 0)			$albanileria_sin_seleccionado = (int)$_POST['albanileria_sin_seleccionado'];



$montaje_frente_arjomy_seleccionado = 0;
if(isset($_POST['montaje_frente_arjomy_seleccionado']) && $_POST['montaje_frente_arjomy_seleccionado'] > 0)				$montaje_frente_arjomy_seleccionado = (int)$_POST['montaje_frente_arjomy_seleccionado'];
$montaje_interior_arjomy_seleccionado = 0;
if(isset($_POST['montaje_interior_arjomy_seleccionado']) && $_POST['montaje_interior_arjomy_seleccionado'] > 0)			$montaje_interior_arjomy_seleccionado = (int)$_POST['montaje_interior_arjomy_seleccionado'];
$desmontaje_frente_arjomy_seleccionado = 0;
if(isset($_POST['desmontaje_frente_arjomy_seleccionado']) && $_POST['desmontaje_frente_arjomy_seleccionado'] > 0)		$desmontaje_frente_arjomy_seleccionado = (int)$_POST['desmontaje_frente_arjomy_seleccionado'];
$desmontaje_interior_arjomy_seleccionado = 0;
if(isset($_POST['desmontaje_interior_arjomy_seleccionado']) && $_POST['desmontaje_interior_arjomy_seleccionado'] > 0)	$desmontaje_interior_arjomy_seleccionado = (int)$_POST['desmontaje_interior_arjomy_seleccionado'];
$juego_led_arjomy_seleccionado = 0;
if(isset($_POST['juego_led_arjomy_seleccionado']) && $_POST['juego_led_arjomy_seleccionado'] > 0)						$juego_led_arjomy_seleccionado = (int)$_POST['juego_led_arjomy_seleccionado'];
$rematar_frente_arjomy_seleccionado = 0;
if(isset($_POST['remate_frente_arjomy_seleccionado']) && $_POST['remate_frente_arjomy_seleccionado'] > 0)				$rematar_frente_arjomy_seleccionado = (int)$_POST['remate_frente_arjomy_seleccionado'];


$precio_frente = 0;
if(isset($_POST['precio_frente']) && $_POST['precio_frente'] > 0)										$precio_frente = (float)$_POST['precio_frente'];
$inc_desc_frente = "";
if(isset($_POST['inc_desc_frente']) && $_POST['inc_desc_frente'] != "")									$inc_desc_frente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['inc_desc_frente'])));
$cant_inc_desc_frente = 0;
if(isset($_POST['cant_inc_desc_frente']) && $_POST['cant_inc_desc_frente'] != 0)						$cant_inc_desc_frente = (float)$_POST['cant_inc_desc_frente'];
$precio_ceramica = 0;
if(isset($_POST['precio_ceramica']) && $_POST['precio_ceramica'] > 0)									$precio_ceramica = (float)$_POST['precio_ceramica'];
$precio_modulos_interior = 0;
if(isset($_POST['precio_modulos_interior']) && $_POST['precio_modulos_interior'] > 0)					$precio_modulos_interior = (float)$_POST['precio_modulos_interior'];
$precio_accesorios_interior = 0;
if(isset($_POST['precio_accesorios_interior']) && $_POST['precio_accesorios_interior'] > 0)				$precio_accesorios_interior = (float)$_POST['precio_accesorios_interior'];
$inc_desc_interior = "";
if(isset($_POST['inc_desc_interior']) && $_POST['inc_desc_interior'] != "")								$inc_desc_interior = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['inc_desc_interior'])));
$cant_inc_desc_interior = 0;
if(isset($_POST['cant_inc_desc_interior']) && $_POST['cant_inc_desc_interior'] != 0)					$cant_inc_desc_interior = (float)$_POST['cant_inc_desc_interior'];
$precio_tapetas = 0;
if(isset($_POST['precio_tapetas']) && $_POST['precio_tapetas'] > 0)										$precio_tapetas = (float)$_POST['precio_tapetas'];
$precio_laterales = 0;
if(isset($_POST['precio_laterales']) && $_POST['precio_laterales'] > 0)									$precio_laterales = (float)$_POST['precio_laterales'];

$precio_costados = 0;
if(isset($_POST['precio_costados']) && $_POST['precio_costados'] > 0)									$precio_costados = (float)$_POST['precio_costados'];
$precio_fijos = 0;
if(isset($_POST['precio_fijos']) && $_POST['precio_fijos'] > 0)											$precio_fijos = (float)$_POST['precio_fijos'];
$precio_montaje_frente = 0;
if(isset($_POST['precio_montaje_frente']) && $_POST['precio_montaje_frente'] > 0)						$precio_montaje_frente = (float)$_POST['precio_montaje_frente'];
$precio_montaje_interior = 0;
if(isset($_POST['precio_montaje_interior']) && $_POST['precio_montaje_interior'] > 0)					$precio_montaje_interior = (float)$_POST['precio_montaje_interior'];
$precio_desmontaje_frente = 0;
if(isset($_POST['precio_desmontaje_frente']) && $_POST['precio_desmontaje_frente'] > 0)					$precio_desmontaje_frente = (float)$_POST['precio_desmontaje_frente'];
$precio_desmontaje_interior = 0;
if(isset($_POST['precio_desmontaje_interior']) && $_POST['precio_desmontaje_interior'] > 0)				$precio_desmontaje_interior = (float)$_POST['precio_desmontaje_interior'];
$precio_juego_led = 0;
if(isset($_POST['precio_juego_led']) && $_POST['precio_juego_led'] > 0)									$precio_juego_led = (float)$_POST['precio_juego_led'];
$precio_rematar_frente = 0;
if(isset($_POST['precio_rematar_frente']) && $_POST['precio_rematar_frente'] > 0)						$precio_rematar_frente = (float)$_POST['precio_rematar_frente'];
$precio_rematar_interior = 0;
if(isset($_POST['precio_rematar_interior']) && $_POST['precio_rematar_interior'] > 0)					$precio_rematar_interior = (float)$_POST['precio_rematar_interior'];
$precio_sistema_frenos = 0;
if(isset($_POST['precio_sistema_frenos']) && $_POST['precio_sistema_frenos'] > 0)						$precio_sistema_frenos = (float)$_POST['precio_sistema_frenos'];
$precio_regleta_led = 0;
if(isset($_POST['precio_regleta_led']) && $_POST['precio_regleta_led'] > 0)								$precio_regleta_led = (float)$_POST['precio_regleta_led'];
$precio_frente_abuardillado = 0;
if(isset($_POST['precio_frente_abuardillado']) && $_POST['precio_frente_abuardillado'] > 0)				$precio_frente_abuardillado = (float)$_POST['precio_frente_abuardillado'];
$precio_albanileria_con = 0;
if(isset($_POST['precio_albanileria_con']) && $_POST['precio_albanileria_con'] > 0)						$precio_albanileria_con = (float)$_POST['precio_albanileria_con'];
$precio_albanileria_sin = 0;
if(isset($_POST['precio_albanileria_sin']) && $_POST['precio_albanileria_sin'] > 0)						$precio_albanileria_sin = (float)$_POST['precio_albanileria_sin'];



$precio_costados_dist = 0;
if(isset($_POST['precio_costados_dist']) && $_POST['precio_costados_dist'] > 0)							$precio_costados_dist = (float)$_POST['precio_costados_dist'];
$precio_fijos_dist = 0;
if(isset($_POST['precio_fijos_dist']) && $_POST['precio_fijos_dist'] > 0)								$precio_fijos_dist = (float)$_POST['precio_fijos_dist'];
$precio_montaje_frente_dist = 0;
if(isset($_POST['precio_montaje_frente_dist']) && $_POST['precio_montaje_frente_dist'] > 0)				$precio_montaje_frente_dist = (float)$_POST['precio_montaje_frente_dist'];
$precio_montaje_interior_dist = 0;
if(isset($_POST['precio_montaje_interior_dist']) && $_POST['precio_montaje_interior_dist'] > 0)			$precio_montaje_interior_dist = (float)$_POST['precio_montaje_interior_dist'];
$precio_desmontaje_frente_dist = 0;
if(isset($_POST['precio_desmontaje_frente_dist']) && $_POST['precio_desmontaje_frente_dist'] > 0)		$precio_desmontaje_frente_dist = (float)$_POST['precio_desmontaje_frente_dist'];
$precio_desmontaje_interior_dist = 0;
if(isset($_POST['precio_desmontaje_interior_dist']) && $_POST['precio_desmontaje_interior_dist'] > 0)	$precio_desmontaje_interior_dist = (float)$_POST['precio_desmontaje_interior_dist'];
$precio_juego_led_dist = 0;
if(isset($_POST['precio_juego_led_dist']) && $_POST['precio_juego_led_dist'] > 0)						$precio_juego_led_dist = (float)$_POST['precio_juego_led_dist'];
$precio_rematar_frente_dist = 0;
if(isset($_POST['precio_rematar_frente_dist']) && $_POST['precio_rematar_frente_dist'] > 0)				$precio_rematar_frente_dist = (float)$_POST['precio_rematar_frente_dist'];
$precio_sistema_frenos_dist = 0;
if(isset($_POST['precio_sistema_frenos_dist']) && $_POST['precio_sistema_frenos_dist'] > 0)				$precio_sistema_frenos_dist = (float)$_POST['precio_sistema_frenos_dist'];


$aplicar_descuento = 0;
if(isset($_POST['aplicar_descuento']) && $_POST['aplicar_descuento'] > 0)								$aplicar_descuento = (float)$_POST['aplicar_descuento'];
$descuento_cliente = 0;
if(isset($_POST['descuento_cliente']) && $_POST['descuento_cliente'] > 0)								$descuento_cliente = (float)$_POST['descuento_cliente'];
$porcentaje_iva = $_SESSION['iva'];
$iva = 0;
if(isset($_POST['iva']) && $_POST['iva'] > 0)															$iva = (float)$_POST['iva'];
$precio_total = 0;
if(isset($_POST['precio_total']) && $_POST['precio_total'] > 0)											$precio_total = (float)$_POST['precio_total'];
$observaciones_proyecto = "";
if(isset($_POST['observaciones_proyecto']) && $_POST['observaciones_proyecto'] != "")					$observaciones_proyecto = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['observaciones_proyecto'])));
$nombre_cliente = "";
if(isset($_POST['nombre_cliente']) && $_POST['nombre_cliente'] != "")									$nombre_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['nombre_cliente'])));
$dni_cliente = "";
if(isset($_POST['dni_cliente']) && $_POST['dni_cliente'] != "")											$dni_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['dni_cliente'])));
$direccion_cliente = "";
if(isset($_POST['direccion_cliente']) && $_POST['direccion_cliente'] != "")								$direccion_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['direccion_cliente'])));
$poblacion_cliente = "";
if(isset($_POST['poblacion_cliente']) && $_POST['poblacion_cliente'] != "")								$poblacion_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['poblacion_cliente'])));
$cp_cliente = "";
if(isset($_POST['cp_cliente']) && $_POST['cp_cliente'] != "")											$cp_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['cp_cliente'])));
$provincia_cliente = "";
if(isset($_POST['provincia_cliente']) && $_POST['provincia_cliente'] != "")								$provincia_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['provincia_cliente'])));
$telefono_cliente = "";
if(isset($_POST['telefono_cliente']) && $_POST['telefono_cliente'] != "")								$telefono_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['telefono_cliente'])));
$email_cliente = "";
if(isset($_POST['email_cliente']) && $_POST['email_cliente'] != "")										$email_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['email_cliente'])));
$horario_cliente = "";
if(isset($_POST['horario_cliente']) && $_POST['horario_cliente'] != "")									$horario_cliente = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_POST['horario_cliente'])));

$id_proyecto = $_SESSION['id_proyecto'];

$db->disconnectDB($con); // DESCONECTAMOS BASE DE DATOS

$fecha_inicial_proyecto = $db->getVar('SELECT fecha_proyecto FROM proyectos WHERE id='.$id_proyecto.'');

$fecha_proyecto_actualizado = date('Y-m-d H:i:s');

$set = "id_usuario = '" . $distribuidor . "', id_tarifa = '" . $tarifa . "', descuento = '" . $descuento . "', id_serie = '" . $serie_marcada . "', id_acabado = '" . $acabado_marcado . "', id_color_perfileria = '" . $perfileria_marcada . "', ancho = '" . $medidas_ancho . "', alto = '" . $medidas_alto . "', fondo = '" . $medidas_fondo . "', num_puertas = '" . $puertas_marcado . "', diseno_puerta_1 = '" . $diseno_puerta_1 . "', diseno_puerta_2 = '" . $diseno_puerta_2 . "', diseno_puerta_3 = '" . $diseno_puerta_3 . "', diseno_puerta_4 = '" . $diseno_puerta_4 . "', diseno_puerta_5 = '" . $diseno_puerta_5 . "', diseno_puerta_6 = '" . $diseno_puerta_6 . "', diseno_puerta_7 = '" . $diseno_puerta_7 . "', diseno_puerta_8 = '" . $diseno_puerta_8 . "', ceramica_puerta_1 = '" . $ceramica_puerta_1 . "', ceramica_puerta_2 = '" . $ceramica_puerta_2 . "', ceramica_puerta_3 = '" . $ceramica_puerta_3 . "', ceramica_puerta_4 = '" . $ceramica_puerta_4 . "', ceramica_puerta_5 = '" . $ceramica_puerta_5 . "', ceramica_puerta_6 = '" . $ceramica_puerta_6 . "', ceramica_puerta_7 = '" . $ceramica_puerta_7 . "', ceramica_puerta_8 = '" . $ceramica_puerta_8 . "', colores_puerta_1 = '" . $colores_puerta_1 . "', colores_puerta_2 = '" . $colores_puerta_2 . "', colores_puerta_3 = '" . $colores_puerta_3 . "', colores_puerta_4 = '" . $colores_puerta_4 . "', colores_puerta_5 = '" . $colores_puerta_5 . "', colores_puerta_6 = '" . $colores_puerta_6 . "', colores_puerta_7 = '" . $colores_puerta_7 . "', colores_puerta_8 = '" . $colores_puerta_8 . "', num_modulos_interior = '" . $modulos_interior . "', interior_puerta_1 = '" . $interior_puerta_1 . "', interior_puerta_2 = '" . $interior_puerta_2 . "', interior_puerta_3 = '" . $interior_puerta_3 . "', interior_puerta_4 = '" . $interior_puerta_4 . "', interior_puerta_5 = '" . $interior_puerta_5 . "', interior_puerta_6 = '" . $interior_puerta_6 . "', interior_puerta_7 = '" . $interior_puerta_7 . "', interior_puerta_8 = '" . $interior_puerta_8 . "', laterales_seleccionado = '" . $laterales_seleccionado . "', tapetas_seleccionado = '" . $tapetas_seleccionado . "', costados_seleccionado = '" . $costados_seleccionado . "', fijos_seleccionado = '" . $fijos_seleccionado . "', montaje_frente_seleccionado = '" . $montaje_frente_seleccionado . "', montaje_frente_arjomy_seleccionado = '" . $montaje_frente_arjomy_seleccionado . "', montaje_interior_seleccionado = '" . $montaje_interior_seleccionado . "', montaje_interior_arjomy_seleccionado = '" . $montaje_interior_arjomy_seleccionado . "', desmontaje_frente_seleccionado = '" . $desmontaje_frente_seleccionado . "', desmontaje_frente_arjomy_seleccionado = '" . $desmontaje_frente_arjomy_seleccionado . "', desmontaje_interior_seleccionado = '" . $desmontaje_interior_seleccionado . "', desmontaje_interior_arjomy_seleccionado = '" . $desmontaje_interior_arjomy_seleccionado . "', juego_led_seleccionado = '" . $juego_led_seleccionado . "', juego_led_arjomy_seleccionado = '" . $juego_led_arjomy_seleccionado . "', rematar_frente_seleccionado = '" . $rematar_frente_seleccionado . "', rematar_frente_arjomy_seleccionado = '" . $rematar_frente_arjomy_seleccionado . "', rematar_interior_seleccionado = '" . $rematar_interior_seleccionado . "', sistema_frenos_seleccionado = '" . $sistema_frenos_seleccionado . "', regleta_led_seleccionado = '" . $regleta_led_seleccionado . "', frente_abuardillado_seleccionado = '" . $frente_abuardillado_seleccionado . "', albanileria_con_seleccionado = '" . $albanileria_con_seleccionado . "', albanileria_sin_seleccionado = '" . $albanileria_sin_seleccionado . "', precio_frente = '" . $precio_frente . "', inc_desc_frente = '" . $inc_desc_frente . "', cant_inc_desc_frente = '" . $cant_inc_desc_frente . "', precio_ceramica = '" . $precio_ceramica . "', precio_modulos_interior = '" . $precio_modulos_interior . "', precio_accesorios_interior = '" . $precio_accesorios_interior . "', inc_desc_interior = '" . $inc_desc_interior . "', cant_inc_desc_interior = '" . $cant_inc_desc_interior . "', precio_tapetas = '" . $precio_tapetas . "', precio_laterales = '" . $precio_laterales . "', precio_costados = '" . $precio_costados . "', precio_fijos = '" . $precio_fijos . "', precio_montaje_frente = '" . $precio_montaje_frente . "', precio_montaje_interior = '" . $precio_montaje_interior . "', precio_desmontaje_frente = '" . $precio_desmontaje_frente . "', precio_desmontaje_interior = '" . $precio_desmontaje_interior . "', precio_juego_led = '" . $precio_juego_led . "', precio_rematar_frente = '" . $precio_rematar_frente . "', precio_rematar_interior = '" . $precio_rematar_interior . "', precio_sistema_frenos = '" . $precio_sistema_frenos . "', precio_regleta_led = '" . $precio_regleta_led . "', precio_frente_abuardillado = '" . $precio_frente_abuardillado . "', precio_albanileria_con = '" . $precio_albanileria_con . "', precio_albanileria_sin = '" . $precio_albanileria_sin . "', precio_costados_dist = '" . $precio_costados_dist . "', precio_fijos_dist = '" . $precio_fijos_dist . "', precio_montaje_frente_dist = '" . $precio_montaje_frente_dist . "', precio_montaje_interior_dist = '" . $precio_montaje_interior_dist . "', precio_desmontaje_frente_dist = '" . $precio_desmontaje_frente_dist . "', precio_desmontaje_interior_dist = '" . $precio_desmontaje_interior_dist . "', precio_juego_led_dist = '" . $precio_juego_led_dist . "', precio_rematar_frente_dist = '" . $precio_rematar_frente_dist . "', precio_sistema_frenos_dist = '" . $precio_sistema_frenos_dist . "', aplicar_descuento = '" . $aplicar_descuento . "', descuento_cliente = '" . $descuento_cliente . "', porcentaje_iva = '" . $porcentaje_iva . "', iva = '" . $iva . "', precio_total = '" . $precio_total . "', observaciones = '" . $observaciones_proyecto . "', nombre_cliente = '" . $nombre_cliente . "', dni_cliente = '" . $dni_cliente . "', direccion_cliente = '" . $direccion_cliente . "', poblacion_cliente = '" . $poblacion_cliente . "', cp_cliente = '" . $cp_cliente . "', provincia_cliente = '" . $provincia_cliente . "', telefono_cliente = '" . $telefono_cliente . "', email_cliente = '" . $email_cliente . "', horario_cliente = '" . $horario_cliente. "', fecha_proyecto = '" . $fecha_proyecto_actualizado ."'";

$ok = $db->update('proyectos',$set,'id='.$id_proyecto.'');

$id_actualizado = $db->getVar('SELECT id FROM proyectos_actualizados WHERE id_proyecto='.$id_proyecto.'');

if(!($id_actualizado)){
	$campos = "id_proyecto, fecha_inicial_proyecto";
	$valores = "'".$id_proyecto."', '".$fecha_inicial_proyecto."'";
	$ok = $db->insert('proyectos_actualizados',$campos,$valores);
}


if($ok){ // SI TODO SE HA GUARDADO BIEN
	
	$respuesta['estado'] = 'ok';
	$respuesta['mensaje'] = $_SESSION['id_proyecto'];
		
}
else{
	
	// SE PORODUJO UN ERROR AL GUARDAR LOS DATOS
	$respuesta['estado'] = 'ko';
	$respuesta['mensaje'] = 'Error al guardar el proyecto. Inténtelo de nuevo.';
	
}

echo json_encode($respuesta);
?>