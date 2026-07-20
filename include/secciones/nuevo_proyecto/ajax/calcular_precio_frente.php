<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LOS DATOS ENVIADOS PARA CALCULAR EL PRECIO
$tarifa = 0;
if(isset($_POST['tarifa']) && $_POST['tarifa'] > 0)							$tarifa = (int)$_POST['tarifa'];
$descuento = 0;
if(isset($_POST['descuento']) && $_POST['descuento'] > 0)					$descuento = (float)$_POST['descuento'];
$serie = 0;
if(isset($_POST['serie']) && $_POST['serie'] > 0)							$serie = (int)$_POST['serie'];
$acabado = 0;
if(isset($_POST['acabado']) && $_POST['acabado'] > 0)						$acabado = (int)$_POST['acabado'];
$ancho = 0;
if(isset($_POST['ancho']) && $_POST['ancho'] > 0)							$ancho = (int)$_POST['ancho'];
$alto = 0;
if(isset($_POST['alto']) && $_POST['alto'] > 0)								$alto = (int)$_POST['alto'];
$puertas = 0;
if(isset($_POST['puertas']) && $_POST['puertas'] > 0)						$puertas = (int)$_POST['puertas'];
$diseno_1 = "";
if(isset($_POST['diseno_1']) && $_POST['diseno_1'] != "")					$diseno_1 = explode("-",$_POST['diseno_1']);
$diseno_2 = "";
if(isset($_POST['diseno_2']) && $_POST['diseno_2'] != "")					$diseno_2 = explode("-",$_POST['diseno_2']);
$diseno_3 = "";
if(isset($_POST['diseno_3']) && $_POST['diseno_3'] != "")					$diseno_3 = explode("-",$_POST['diseno_3']);
$diseno_4 = "";
if(isset($_POST['diseno_4']) && $_POST['diseno_4'] != "")					$diseno_4 = explode("-",$_POST['diseno_4']);
$diseno_5 = "";
if(isset($_POST['diseno_5']) && $_POST['diseno_5'] != "")					$diseno_5 = explode("-",$_POST['diseno_5']);
$diseno_6 = "";
if(isset($_POST['diseno_6']) && $_POST['diseno_6'] != "")					$diseno_6 = explode("-",$_POST['diseno_6']);
$diseno_7 = "";
if(isset($_POST['diseno_7']) && $_POST['diseno_7'] != "")					$diseno_7 = explode("-",$_POST['diseno_7']);
$diseno_8 = "";
if(isset($_POST['diseno_8']) && $_POST['diseno_8'] != "")					$diseno_8 = explode("-",$_POST['diseno_8']);
$ceramica_1 = 0;
if(isset($_POST['ceramica_1']) && $_POST['ceramica_1'] != "")				$ceramica_1 = (int)$_POST['ceramica_1'];
$ceramica_2 = 0;
if(isset($_POST['ceramica_2']) && $_POST['ceramica_2'] != "")				$ceramica_2 = (int)$_POST['ceramica_2'];
$ceramica_3 = 0;
if(isset($_POST['ceramica_3']) && $_POST['ceramica_3'] != "")				$ceramica_3 = (int)$_POST['ceramica_3'];
$ceramica_4 = 0;
if(isset($_POST['ceramica_4']) && $_POST['ceramica_4'] != "")				$ceramica_4 = (int)$_POST['ceramica_4'];
$ceramica_5 = 0;
if(isset($_POST['ceramica_5']) && $_POST['ceramica_5'] != "")				$ceramica_5 = (int)$_POST['ceramica_5'];
$ceramica_6 = 0;
if(isset($_POST['ceramica_6']) && $_POST['ceramica_6'] != "")				$ceramica_6 = (int)$_POST['ceramica_6'];
$ceramica_7 = 0;
if(isset($_POST['ceramica_7']) && $_POST['ceramica_7'] != "")				$ceramica_7 = (int)$_POST['ceramica_7'];
$ceramica_8 = 0;
if(isset($_POST['ceramica_8']) && $_POST['ceramica_8'] != "")				$ceramica_8 = (int)$_POST['ceramica_8'];
$plus_cream_stone = 0;
if(isset($_POST['plus_cream_stone']) && $_POST['plus_cream_stone'] > 0)	$plus_cream_stone = (int)$_POST['plus_cream_stone'];
$plus_grey_stone = 0;
if(isset($_POST['plus_grey_stone']) && $_POST['plus_grey_stone'] > 0)		$plus_grey_stone = (int)$_POST['plus_grey_stone'];
$plus_dark_grey = 0;
if(isset($_POST['plus_dark_grey']) && $_POST['plus_dark_grey'] > 0)		$plus_dark_grey = (int)$_POST['plus_dark_grey'];

$ancho_precio_armario = $db->getVar('SELECT MIN(ancho) FROM ancho_puertas WHERE id_series = '.$serie.' AND puertas = '.$puertas.' AND ancho >= '.$ancho.' GROUP BY(ancho)');
$montaje = $db->getVar('SELECT precio FROM montajes_frentes WHERE id_series = '.$serie.' AND hojas = '.$puertas);

$precio = 0;
$ceramicas = 0;
$incremento_descuento = "";
$cant_incremento_descuento = 0;
for($i=1; $i<=$puertas; $i++){
	$diseno = ${"diseno_" . $i}[0];
	$terminacion = ${"diseno_" . $i}[1];
	
	// PRECIO SEGÚN CADA PUERTA, NOS QUEDAREMOS CON EL MAYOR
	$precio_segun_puerta = $db->getVar('SELECT p.`'.$puertas.'-'.$ancho_precio_armario.'` FROM precios_c1 as p, series_acabados_disenos_terminaciones as sadt WHERE sadt.id_series = '.$serie.' AND sadt.id_acabados = '.$acabado.' AND sadt.id_disenos = '.$diseno.' AND sadt.id_terminaciones = '.$terminacion.' AND sadt.id = p.id_s_a_d_t');
	
	if($precio < $precio_segun_puerta){  // SIEMPRE SE APLICARÁ EL PRECIO MÁS GRANDE
		$precio = $precio_segun_puerta;
	
		// INCREMENTOS O DESCUENTOS POR ALTURA SEGÚN TARIFA
		if($alto > 270){
			$incremento_descuento = "Incremento frente ".$_SESSION['incremento270']."%";
			$cant_incremento_descuento = round($precio * $_SESSION['incremento270'] / 100, 2);
		}
		elseif($alto > 260){
			$incremento_descuento = "Incremento frente ".$_SESSION['incremento260']."%";
			$cant_incremento_descuento = round($precio * $_SESSION['incremento260'] / 100, 2);
		}
		elseif($alto > 250 && ($diseno == 5 || $diseno == 6 || $diseno == 8 || $diseno == 9)){  // SOLO PARA PANTOGRAFIADO, PLAFONADO, CERÁMICA Y PANTOGRAFIADO
			$incremento_descuento = "Incremento frente ".$_SESSION['incremento260']."%";
			$cant_incremento_descuento = round($precio * $_SESSION['incremento260'] / 100, 2);
		}
		elseif($alto < 60){
			$incremento_descuento = "Descuento frente ".$_SESSION['descuento60']."%";
			$cant_incremento_descuento = round(-$precio * $_SESSION['descuento60'] / 100, 2);
		}
		elseif($alto < 130){
			$incremento_descuento = "Descuento frente ".$_SESSION['descuento130']."%";
			$cant_incremento_descuento = round(-$precio * $_SESSION['descuento130'] / 100, 2);
		}
	}
}

$pvp = $db->getVar('SELECT porcentaje FROM tarifa WHERE id = 1');

$respuesta = array();
// PRECIO DEL FRENTE
$respuesta['precio'] = number_format(round($precio + $precio * $pvp / 100, 2),2,".","");
// PRECIO DEL MONTAJE
$respuesta['montaje'] = number_format($montaje,2,".","");
// TEXTO DEL INCREMENTO O DESCUENTO POR ALTURA SI TIENE
$respuesta['incremento_descuento'] = $incremento_descuento;
// PRECIO DEL INCREMENTO O DESCUENTO POR ALTURA SI TIENE
$respuesta['cant_incremento_descuento'] = number_format(round($cant_incremento_descuento + $cant_incremento_descuento * $pvp / 100, 2),2,".","");
// PRECIO DE LAS CERÁMICAS SI TIENE
$respuesta['ceramicas'] = number_format($ceramicas,2,".","");
// PLUS POR CREAM STONE
$respuesta['plus_cream_stone'] = number_format($plus_cream_stone,2,".","");
// PLUS POR GREY STONE
$respuesta['plus_grey_stone'] = number_format($plus_grey_stone,2,".","");
// PLUS POR DARK GREY
$respuesta['plus_dark_grey'] = number_format($plus_dark_grey + $plus_dark_grey * $pvp / 100,2,".","");
// PRECIO TOTAL SIN IVA
$respuesta['total'] = number_format($respuesta['precio'] + $respuesta['montaje'] + $respuesta['cant_incremento_descuento'] + $plus_cream_stone + $plus_grey_stone + $respuesta['plus_dark_grey'],2,".","");
// IVA CORRESPONDIENTE AL PRECIO TOTAL
$respuesta['iva'] = number_format(round($respuesta['total'] * $_SESSION['iva'] / 100, 2),2,".","");;
// PRECIO PARA EL DISTRIBUIDOR CON SU DESCUENTO, PARA LAS CERÁMICAS NO SE APLICA DESCUENTO
$precio_distribuidor = ($precio + $cant_incremento_descuento);
// PRECIO PARA EL DISTRIBUIDOR CON IVA
$precio_distribuidor_iva = round($precio_distribuidor + $precio_distribuidor * $_SESSION['iva'] / 100, 2);
// REFERENCIA DE PRECIO PARA EL DISTRIBUIDOR, ESTARÁ COMPUESTA POR LA TARIFA, EL PORCENTAJE DE DESCUENTO QUE TIENE EL DISTRIBUIDOR Y EL PRECIO FINAL PARA EL DISTRIBUIDOR
$respuesta['referencia'] = str_pad($tarifa, 2, "0", STR_PAD_LEFT)."-".str_pad(number_format($precio_distribuidor_iva,2,".",""), 10, "0", STR_PAD_BOTH);

echo json_encode($respuesta);

?>