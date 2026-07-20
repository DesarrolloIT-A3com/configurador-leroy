<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LOS DATOS ENVIADOS PARA CALCULAR EL DESCUENTO
$cantidad_descuento_aplicado = 0;
if(isset($_POST['cantidad_descuento_aplicado']) && $_POST['cantidad_descuento_aplicado'] > 0)			$cantidad_descuento_aplicado = (float)$_POST['cantidad_descuento_aplicado'];
$aplicar_descuento = 0;
if(isset($_POST['aplicar_descuento']) && $_POST['aplicar_descuento'] > 0)								$aplicar_descuento = (float)$_POST['aplicar_descuento'];
$precio_total = 0;
if(isset($_POST['precio_total']) && $_POST['precio_total'] > 0)											$precio_total = (float)$_POST['precio_total'];
$iva = 0;
if(isset($_POST['iva']) && $_POST['iva'] > 0)															$iva = (float)$_POST['iva'];

/*
$precio_frente = 0;
if(isset($_POST['precio_frente']) && $_POST['precio_frente'] > 0)										$precio_frente = (float)$_POST['precio_frente'];
$cant_inc_desc_frente = 0;
if(isset($_POST['cant_inc_desc_frente']) && $_POST['cant_inc_desc_frente'] > 0)							$cant_inc_desc_frente = (float)$_POST['cant_inc_desc_frente'];
$precio_ceramica = 0;
if(isset($_POST['precio_ceramica']) && $_POST['precio_ceramica'] > 0)									$precio_ceramica = (float)$_POST['precio_ceramica'];
$precio_modulos_interior = 0;
if(isset($_POST['precio_modulos_interior']) && $_POST['precio_modulos_interior'] > 0)					$precio_modulos_interior = (float)$_POST['precio_modulos_interior'];
$precio_accesorios_interior = 0;
if(isset($_POST['precio_accesorios_interior']) && $_POST['precio_accesorios_interior'] > 0)				$precio_accesorios_interior = (float)$_POST['precio_accesorios_interior'];
$cant_inc_desc_interior = 0;
if(isset($_POST['cant_inc_desc_interior']) && $_POST['cant_inc_desc_interior'] > 0)						$cant_inc_desc_interior = (float)$_POST['cant_inc_desc_interior'];
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


$suma_aplicables = $precio_frente + $cant_inc_desc_frente + $precio_modulos_interior + $cant_inc_desc_interior + $precio_tapetas + $precio_laterales;

$cantidad_descuento = $suma_aplicables * $aplicar_descuento / 100;

$precio_con_descuento = $suma_aplicables - $cantidad_descuento + $precio_ceramica + $precio_accesorios_interior + $precio_costados + $precio_fijos + $precio_montaje_frente + $precio_montaje_interior + $precio_desmontaje_frente + $precio_desmontaje_interior + $precio_juego_led + $precio_rematar_frente + $precio_sistema_frenos;

$cantidad_iva = $precio_con_descuento * $_SESSION['iva'] / 100;
*/

$precio_base = $precio_total - $iva;
$precio_base_sin_descuento = $precio_base + $cantidad_descuento_aplicado;

$cantidad_descuento = $precio_base_sin_descuento * $aplicar_descuento / 100;
$precio_con_descuento = $precio_base_sin_descuento - $cantidad_descuento;

$cantidad_iva = $precio_con_descuento * $_SESSION['iva'] / 100;


$respuesta['cantidad_descuento'] = number_format(round($cantidad_descuento, 2),2,".","");

$respuesta['precio_con_descuento'] = number_format(round($precio_con_descuento, 2),2,".","");

$respuesta['cantidad_iva'] = number_format(round($cantidad_iva, 2),2,".","");

echo json_encode($respuesta);

?>