
<?php
// SI NO ESTÁ LOGUEADO NO CARGARÁ LA PÁGINA
if(!isset($_SESSION['logueado']) || $_SESSION['logueado']!="logged")
	die();

// VEMOS LOS DATOS ENVIADOS PARA CALCULAR EL PRECIO

// Para cada interior tendremos una cadena separada por '-' (0-0-0-0-0-0-0-0-0) que se corresponde con: ancho para el precio, id del interior, zapatero doble con/sin freno, cajoneras con/sin freno, número de juegos de celdillas para cajones, numero de frentes de cristal para cajones, número de cerraduras para cajones, id del color del interior y id del color de las cantoneras

$tarifa = 0;
if(isset($_POST['tarifa']) && $_POST['tarifa'] > 0)									$tarifa = (int)$_POST['tarifa'];
$descuento = 0;
if(isset($_POST['descuento']) && $_POST['descuento'] > 0)							$descuento = (float)$_POST['descuento'];
$serie = 1; // SE INICIALIZA A 1 POR SI ES SOLO INTERIOR QUE TARIFIQUE COMO JOMY
if(isset($_POST['serie']) && $_POST['serie'] > 0)									$serie = (float)$_POST['serie'];
$acabado = 0;
if(isset($_POST['acabado']) && $_POST['acabado'] > 0)								$acabado = (float)$_POST['acabado'];
$ancho = 0;
if(isset($_POST['ancho']) && $_POST['ancho'] > 0)									$ancho = (int)$_POST['ancho'];
$alto = 0;
if(isset($_POST['alto']) && $_POST['alto'] > 0)										$alto = (int)$_POST['alto'];
$fondo = 0;
if(isset($_POST['fondo']) && $_POST['fondo'] > 0)									$fondo = (int)$_POST['fondo'];
$puertas = 0;
if(isset($_POST['puertas']) && $_POST['puertas'] > 0)								$puertas = (int)$_POST['puertas'];
$modulos_interior = 0;
if(isset($_POST['modulos_interior']) && $_POST['modulos_interior'] > 0)				$modulos_interior = (int)$_POST['modulos_interior'];
$interior_1 = "";
if(isset($_POST['interior_1']) && $_POST['interior_1'] != "")						$interior_1 = explode("-",$_POST['interior_1']);
$interior_2 = "";
if(isset($_POST['interior_2']) && $_POST['interior_2'] != "")						$interior_2 = explode("-",$_POST['interior_2']);
$interior_3 = "";
if(isset($_POST['interior_3']) && $_POST['interior_3'] != "")						$interior_3 = explode("-",$_POST['interior_3']);
$interior_4 = "";
if(isset($_POST['interior_4']) && $_POST['interior_4'] != "")						$interior_4 = explode("-",$_POST['interior_4']);
$interior_5 = "";
if(isset($_POST['interior_5']) && $_POST['interior_5'] != "")						$interior_5 = explode("-",$_POST['interior_5']);
$interior_6 = "";
if(isset($_POST['interior_6']) && $_POST['interior_6'] != "")						$interior_6 = explode("-",$_POST['interior_6']);
$interior_7 = "";
if(isset($_POST['interior_7']) && $_POST['interior_7'] != "")						$interior_7 = explode("-",$_POST['interior_7']);
$interior_8 = "";
if(isset($_POST['interior_8']) && $_POST['interior_8'] != "")						$interior_8 = explode("-",$_POST['interior_8']);
$precio_frente = 0;
if(isset($_POST['precio_frente']) && $_POST['precio_frente'] > 0)					$precio_frente = (float)$_POST['precio_frente'];
$cant_inc_desc_frente = 0;
if(isset($_POST['cant_inc_desc_frente']) && $_POST['cant_inc_desc_frente'] != 0)	$cant_inc_desc_frente = (float)$_POST['cant_inc_desc_frente'];
$precio_ceramica = 0;
if(isset($_POST['precio_ceramica']) && $_POST['precio_ceramica'] > 0)				$precio_ceramica = (float)$_POST['precio_ceramica'];
$plus_cream_stone = 0;
if(isset($_POST['plus_cream_stone']) && $_POST['plus_cream_stone'] > 0)			$plus_cream_stone = (int)$_POST['plus_cream_stone'];
$plus_grey_stone = 0;
if(isset($_POST['plus_grey_stone']) && $_POST['plus_grey_stone'] > 0)				$plus_grey_stone = (int)$_POST['plus_grey_stone'];
$plus_dark_grey = 0;
if(isset($_POST['plus_dark_grey']) && $_POST['plus_dark_grey'] > 0)				$plus_dark_grey = (int)$_POST['plus_dark_grey'];
$plus_ral = 0;
if(isset($_POST['plus_ral']) && $_POST['plus_ral'] > 0)				$plus_ral = (int)$_POST['plus_ral'];

$precio_modulos = 0; // PRECIO SIN ACCESORIOS
if($interior_1 != ""){ // SI SE HA ELEGIDO AL MENOS UN INTERIOR
	$ancho_precio_interior = $db->getVar('SELECT MIN(ancho) as ancho FROM ancho_puertas WHERE id_series = '.$serie.' AND puertas = '.$puertas.' AND ancho >= '.$ancho.' GROUP BY(ancho)');
	$precio_modulos = $db->getVar('SELECT `'.$puertas.'-'.$ancho_precio_interior.'` FROM interiores_c1 WHERE id_series = '.$serie);
}

$precio_accesorios = 0; // PRECIO ACCESORIOS
for($i=1; $i<=$modulos_interior; $i++){
		
	$tipo_precio = ${'interior_'.$i}[0];
	
	$interior = $db->getRow('SELECT id_interiores_modulos, num_cajones, cajones_divididos, num_zap_extr, num_zap_doble, zap_doble_dividido, num_pant_simple, num_percha_extr, num_pant_doble, num_percha_abat FROM interiores WHERE id='.${'interior_'.$i}[1]);
	
	
	// PRECIO DE LOS ACCESORIOS / COMPLEMENTOS
	$cajones = $db->getVar('SELECT num_cajones FROM interiores WHERE id='.${'interior_'.$i}[1]);
	// Cajoneras
	if($interior['num_cajones'] > 0){
		if( $interior['cajones_divididos'] == 1){ // Si los cajones ocupan solo la mitad del armario
			$tipo_precio_cajones = ceil($tipo_precio/2/10)*10; // Vemos que medida de precio le corresponde a los cajones divididos
			if($tipo_precio_cajones < 40) // La medida mínima para precio es de 50
				$tipo_precio_cajones = 40;
		}
		else{
			$tipo_precio_cajones = $tipo_precio; // Si no son divididos el tipo de precio es el mismo que el del módulo
		}
		

		$cajones_menores = ${"interior_".$i}[19] + ${"interior_".$i}[20]; // Cajones de 8 y 16
		$cajones_mayores = ${"interior_".$i}[21] + ${"interior_".$i}[22]; // Cajones de 20 y 32

		// Si la suma de cajones no es igual al número de cajones del interior aumentamos los cajones menores hasta el número de cajones actual
		if($cajones_mayores + $cajones_menores != $cajones) 
		{
			while($cajones_mayores + $cajones_menores < $cajones) 
			{
				$cajones_menores++; // Añadimos un cajón de 16
			}
		}
		$cajonera_basic = 0;
		$cajonera_premium = 0;
		// Si la gama escogida es basic cogemos las cajoneras de interiores_cajoneras si no de interiores_gamas
		if(${"interior_".$i}[25] == "basic")
		{
			// Precio de un cajon para basic de 16 y 20
			$interior_basic_16 = $db->getVar('SELECT interiores_cajoneras.'.$tipo_precio_cajones.' FROM interiores_cajoneras WHERE num_cajones='.$interior['num_cajones'].' AND con_freno='.${'interior_'.$i}[3].' AND cajones_20=0') / $cajones; // Precio de un cajon de 16
			$interior_basic_20 = $db->getVar('SELECT interiores_cajoneras.'.$tipo_precio_cajones.' FROM interiores_cajoneras WHERE num_cajones='.$interior['num_cajones'].' AND con_freno='.${'interior_'.$i}[3].' AND cajones_20=1') / $cajones; // Precio de un cajon de 20
			
			$precio_accesorios += $cajones_menores * $interior_basic_16; // Precio de cajones de 8 y 16
			$precio_accesorios += $cajones_mayores * $interior_basic_20; // Precio de cajones de 20 y 32
			
		}
		else
		{
			//Precio de un cajon para premium de 16 y 20
			$interior_premium_16 = $db->getVar('SELECT `'.${"interior_".$i}[0].'` FROM interiores_gamas WHERE gama = "'.${"interior_".$i}[25] .'" AND num_cajones = '.$cajones.' AND cajones_20 =  0') / $cajones; // Precio de un cajon de 16
			$interior_premium_20 = $db->getVar('SELECT `'.${"interior_".$i}[0].'` FROM interiores_gamas WHERE gama = "'.${"interior_".$i}[25] .'" AND num_cajones = '.$cajones.' AND cajones_20 =  1') / $cajones; // Precio de un cajon de 20
			
			$precio_accesorios += $cajones_menores * $interior_premium_16; // Precio de cajones de 8 y 16
			$precio_accesorios += $cajones_mayores * $interior_premium_20; // Precio de cajones de 20 y 32
		}

	
	}
	
	// Zapatero extraible y premium
	if(${'interior_'.$i}[17] > 0)
	{
		$precio_accesorios += $db->getVar('SELECT precio FROM interiores_complementos WHERE id=13'); //Precio de zapatero premium
	}
	else
	{
		$precio_accesorios += $interior['num_zap_extr'] * $db->getVar('SELECT interiores_zapatero_extraible.'.$tipo_precio.' FROM interiores_zapatero_extraible WHERE id=1'); //Precio de zapatero extraible
	}
	
	// Zapatero doble
	$precio_zapatero_doble = 0;
	if($interior['num_zap_doble'] > 0){
		if($interior['zap_doble_dividido'] == 1){ // Si el zapatero ocupa solo la mitad del armario
			$tipo_precio_zapatero = ceil($tipo_precio/2/10)*10; // Vemos que medida de precio le corresponde a los zapateros divididos
			if($tipo_precio_zapatero < 40) // La medida mínima para precio es de 40
				$tipo_precio_zapatero = 40;
		}
		else{
			$tipo_precio_zapatero = $tipo_precio; // Si no son divididos el tipo de precio es el mismo que el del módulo
		}
		$precio_accesorios += $interior['num_zap_doble'] * $db->getVar('SELECT interiores_zapatero_doble.'.$tipo_precio_zapatero.' FROM interiores_zapatero_doble WHERE con_freno='.${'interior_'.$i}[2]); // Precio de cajoneras
	}
	
	// Pantalonero simple y premium
	if(${'interior_'.$i}[16]>0 && $interior['num_pant_simple'] > 0)
	{
		$precio_accesorios += $db->getVar('SELECT precio FROM interiores_complementos WHERE id=12'); //Precio de Pantalonero premium
	}
	else if($interior['num_pant_simple'] > 0)
	{
		$precio_accesorios += $interior['num_pant_simple'] * $db->getVar('SELECT interiores_pantalonero_simple.'.$tipo_precio.' FROM interiores_pantalonero_simple WHERE id=1'); //Precio de pantalonero simple
	}
	
	// Percha extraible
	$precio_accesorios += $interior['num_percha_extr'] * $db->getVar('SELECT interiores_percha_extraible.'.$tipo_precio.' FROM interiores_percha_extraible WHERE id=1'); //Precio de percha extraible
	
	// Pantalonero doble y premium
	if(${'interior_'.$i}[16]>0 && $interior['num_pant_doble'] > 0)
	{
		$precio_accesorios += $db->getVar('SELECT precio FROM interiores_complementos WHERE id=12'); //Precio de Pantalonero premium
	}
	else if($interior['num_pant_doble'] > 0)
	{
		$precio_accesorios += $interior['num_pant_doble'] * $db->getVar('SELECT interiores_pantalonero_doble.'.$tipo_precio.' FROM interiores_pantalonero_doble WHERE id=1'); //Precio de pantalonero doble
	}
	
	// Percha abatible
	$precio_accesorios += $interior['num_percha_abat'] * $db->getVar('SELECT interiores_percha_abatible.'.$tipo_precio.' FROM interiores_percha_abatible WHERE id=1'); //Precio de percha abatible

	// Juego de celdillas
	$precio_accesorios += ${'interior_'.$i}[4] * $db->getVar('SELECT precio FROM interiores_complementos WHERE id=1'); //Precio de Juegos de celdillas

	// Frente de cristal
	$precio_accesorios += ${'interior_'.$i}[5] * $db->getVar('SELECT precio FROM interiores_complementos WHERE id=2'); //Precio de Frente de cristal

	// Cerradura
	$precio_accesorios += ${'interior_'.$i}[6] * $db->getVar('SELECT precio FROM interiores_complementos WHERE id=3'); //Precio de Cerradura

	// Tapa de cristal
	$precio_accesorios += ${'interior_'.$i}[10] * $db->getVar('SELECT precio FROM interiores_complementos WHERE id=6'); //Precio de Tapa de cristal

	// Tapas de registro
	$precio_accesorios += ${'interior_'.$i}[13] * $db->getVar('SELECT precio FROM interiores_complementos WHERE id=9'); //Precio de Tapas de registro

	// Cajoneras lacadas
	$precio_accesorios += ${'interior_'.$i}[15] * $db->getVar('SELECT precio FROM interiores_complementos WHERE id=11'); //Precio de Cajoneras lacadas

	// Cesta premium
	if(${'interior_'.$i}[18] > 0) 
	{	
		$precio_accesorios += ${'interior_'.$i}[18] * $db->getVar('SELECT precio FROM interiores_complementos WHERE id=16'); //Precio de Cesta premium
	}

	// Pestaña de cristal
	if(${'interior_'.$i}[23] > 0)
	{
		// Pestaña de cristal si se ha escogido atenas cristal
		$precio_accesorios += ${'interior_'.$i}[24] * $db->getVar('SELECT precio FROM interiores_complementos WHERE id=14'); //Precio de Pestaña de cristal
	}

	
	// // Gama escogida
	// if($cajones > 0)
	// {
	// 	if(${"interior_".$i}[21] == "Cream Stone")
	// 	{
	// 		$plus_cream_stone += 20;
	// 	}
	// 	if(${"interior_".$i}[21] == "Grey Stone")
	// 	{
	// 		$plus_grey_stone += 20;
	// 	}
	// }
}


// INCREMENTOS O DESCUENTOS POR ALTURA
$incremento_alto = 0;
if($alto > 290){
	$incremento_alto = 40;
}
elseif($alto > 280){
	$incremento_alto = 30;
}
elseif($alto > 270){
	$incremento_alto = 20;
}
elseif($alto > 260){
	$incremento_alto = 10;
}
elseif($alto < 60){
	$incremento_alto = -45;
}
elseif($alto < 130){
	$incremento_alto = -25;
}

// INCREMENTOS POR FONDO
$incremento_fondo = 0;
if($fondo > 90){
	$incremento_fondo = 40;
}
elseif($fondo > 80){
	$incremento_fondo = 30;
}
elseif($fondo > 70){
	$incremento_fondo = 20;
}
elseif($fondo > 60){
	$incremento_fondo = 10;
}

$incremento_descuento_interior = "";
$cant_incremento_descuento_interior = 0;
if($incremento_alto+$incremento_fondo > 0){
	$incremento_descuento_interior = "Incremento interior ".($incremento_alto+$incremento_fondo)."%";
}
else{
	$incremento_descuento_interior = "Descuento interior ".($incremento_alto+$incremento_fondo)."%";
}
$cant_incremento_descuento_interior = round($precio_modulos * ($incremento_alto+$incremento_fondo) / 100, 2);

// SI SE HA ESCOGIDO UN FRENTE SELECCIONAMOS EL MONTAJE SEGÚN LAS PUERTAS
$montaje = 0;
if($precio_frente!=0)
{
	$montaje = $db->getVar('SELECT precio FROM montajes_frentes WHERE id_series = '.$serie.' AND hojas = '.$puertas);
	if($modulos_interior!=0)
	{
		$montaje = $db->getVar('SELECT precio FROM montajes_completo WHERE modulos = '.$modulos_interior);
	}
}
// SI SE HA ESCOGIDO UN INTERIOR Y NO HAY MONTAJE SOLO SELECCIONAMOS EL MONTAJE DE INTERIOR
if($modulos_interior!=0 && $montaje==0)
{
	$montaje = $db->getVar('SELECT precio FROM montajes_interiores WHERE modulos = '.$modulos_interior);
}

$incremento_ral = 0;

if($plus_ral == 1)
{
	$valor_incremento = 20 / 100;
	$incremento_ral = ($precio_frente + $cant_inc_desc_frente) * $valor_incremento;	
}

$pvp = $db->getVar('SELECT porcentaje FROM tarifa WHERE id = '.$tarifa);

$respuesta = array();
// PRECIO DEL FRENTE
$respuesta['precio_frente'] = number_format($precio_frente,2,".","");
// PLUS POR CREAM STONE
$respuesta['plus_cream_stone'] = number_format($plus_cream_stone,2,".","");
// PLUS POR GREY STONE
$respuesta['plus_grey_stone'] = number_format($plus_grey_stone,2,".","");
// PLUS POR DARK GREY
$respuesta['plus_dark_grey'] = number_format($plus_dark_grey + $plus_dark_grey * $pvp / 100,2,".","");
// INCREMENTO BLANCO RAL 9010
$respuesta['plus_ral'] = number_format($incremento_ral,2,".","");
// MONTAJE
$respuesta['montaje'] = number_format($montaje,2,".","");
// PRECIO DEL INCREMENTO O DESCUENTO POR ALTURA
$respuesta['cant_incremento_descuento'] = number_format(round($cant_inc_desc_frente, 2),2,".","");
// PRECIO DE LAS CERÁMICAS SI TIENE
$respuesta['ceramicas'] = number_format($precio_ceramica,2,".","");
// PRECIO DE LOS MÓDULOS DEL INTERIOR
$respuesta['precio_modulos_interior'] = number_format(round($precio_modulos + $precio_modulos * $pvp / 100, 2),2,".","");

// PRECIO DE LOS ACCESORIOS DEL INTERIOR
$respuesta['precio_accesorios_interior'] = number_format(round($precio_accesorios + $precio_accesorios * $pvp / 100, 2),2,".","");

// TEXTO DEL INCREMENTO O DESCUENTO POR ALTURA SI TIENE
$respuesta['incremento_descuento_interior'] = $incremento_descuento_interior;
// PRECIO DEL INCREMENTO O DESCUENTO POR ALTURA SI TIENE
$respuesta['cant_incremento_descuento_interior'] = number_format(round($cant_incremento_descuento_interior  + $cant_incremento_descuento_interior * $pvp / 100, 2),2,".","");
// PRECIO TOTAL SIN IVA
$respuesta['total'] = number_format($respuesta['precio_frente']+ $plus_cream_stone + $plus_grey_stone + $plus_dark_grey + $plus_ral + $respuesta['montaje'] + $respuesta['cant_incremento_descuento'] + $respuesta['precio_modulos_interior'] + $respuesta['precio_accesorios_interior'] + $respuesta['cant_incremento_descuento_interior'],2,".","");
// IVA CORRESPONDIENTE AL PRECIO TOTAL
$respuesta['iva'] = number_format(round($respuesta['total'] * $_SESSION['iva'] / 100, 2),2,".","");;
// PRECIO PARA EL DISTRIBUIDOR CON SU DESCUENTO, SOLO SE APLICA DESCUENTO A FRENTE Y A MODULOS DE INTERIOR
$precio_distribuidor = $respuesta['precio_frente'] / 1.35  + $cant_inc_desc_frente / 1.35 +  $precio_modulos + $precio_accesorios + $cant_incremento_descuento_interior;
// PRECIO PARA EL DISTRIBUIDOR CON IVA
$precio_distribuidor_iva = round($precio_distribuidor + $precio_distribuidor * $_SESSION['iva'] / 100, 2);
// REFERENCIA DE PRECIO PARA EL DISTRIBUIDOR, ESTARÁ COMPUESTA POR LA TARIFA, EL PORCENTAJE DE DESCUENTO QUE TIENE EL DISTRIBUIDOR Y EL PRECIO FINAL PARA EL DISTRIBUIDOR
$respuesta['referencia'] = str_pad($tarifa, 2, "0", STR_PAD_LEFT)."-".str_pad(number_format($precio_distribuidor_iva,2,".",""), 10, "0", STR_PAD_BOTH);

echo json_encode($respuesta);

?>