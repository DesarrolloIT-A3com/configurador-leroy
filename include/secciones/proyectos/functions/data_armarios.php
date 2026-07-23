<?php


function extractColorPuerta($db,$puertas,$proyecto)
{
    $plus_cream_stone = 0;
    $plus_grey_stone = 0;
    $plus_dark_grey = 0;
    $incremento_ral = 0;

    for($i = 1; $i <= $puertas; $i++)
    {

        global ${"diseno_puerta_" . $i};
        $id_diseno_puerta = ${"diseno_puerta_" . $i}[0];
        $id_diseno_terminacion = ${"diseno_puerta_" . $i}[1];
        $id_diseno_puerta_zonas = ${"diseno_puerta_" . $i}[2];

        $diseno_puerta = $db->getRow('SELECT d.nombre as diseno, t.id as terminacion FROM disenos as d, terminaciones as t WHERE d.id=' . $id_diseno_puerta . ' AND t.id=' . $id_diseno_terminacion);
        $zonas_puerta = $db->getResults('SELECT pz.zona as zona, pz.id_colores_tipo as id_colores_tipo, ct.nombre as tipo FROM puertas_zonas as pz, disenos_puertas as dp, colores_tipo as ct WHERE pz.id_disenos_puertas = dp.id AND pz.id_colores_tipo = ct.id AND dp.id_acabados = ' . $proyecto['id_acabado'] . ' AND dp.id_disenos = ' . $id_diseno_puerta . ' AND dp.id_terminaciones = ' . $id_diseno_terminacion . ' AND dp.id_puertas = ' . $id_diseno_puerta_zonas . ' ORDER BY pz.zona');
        $found_cream_stone = false;
        $found_grey_stone = false;
        $count_dark_grey = 0;
        $zona_cristal = 0;
        foreach ($zonas_puerta as $index => $zona_puerta) 
        {
            
            // Comprobamos si hay más del mismo tipo para ponerle el número detrás o no
            $hay_mas = false;
            if (isset($zonas_puerta[$index + 1]['id_colores_tipo']) && $zona_puerta['id_colores_tipo'] == $zonas_puerta[$index + 1]['id_colores_tipo']) 
            {
                $hay_mas = true;
            }

            // SE OBTIENEN LOS DATOS CORRESPONDIENTES
            $nombre_color_zona = "";
            global ${"colores_puerta_" . $i};
            $color_puerta = ${"colores_puerta_" . $i}[$index];
            if (isset($color_puerta) && $color_puerta > 0) 
            {
                $color_zona = $db->getRow('SELECT nombre, imagen FROM colores WHERE id = ' . $color_puerta);
                $nombre_color_zona = $color_zona['nombre'];
            }

            if($nombre_color_zona=="Cream Stone")
            {
                $found_cream_stone = true;
            }

            if($nombre_color_zona=="Grey Stone")
            {
                $found_grey_stone = true;
            }

            if($nombre_color_zona=="Dark Grey" && ($diseno_puerta['terminacion'] == 2 || $diseno_puerta['terminacion'] == 3 || $diseno_puerta['terminacion'] == 4 || $diseno_puerta['terminacion'] == 7 || $diseno_puerta['terminacion'] == 8 || $diseno_puerta['terminacion'] == 17 || $diseno_puerta['terminacion'] == 18 || $diseno_puerta['terminacion'] == 19 || $diseno_puerta['terminacion'] == 28))
            {
                
                $count_dark_grey+=1;
            }
            
            if(preg_match('/^Cristal\d*$/', $zona_puerta[2]))
            {
                $zona_cristal++;
            }

        }

        if($found_cream_stone)
        {
            $plus_cream_stone += 20;
        }

        if($found_grey_stone)
        {
            $plus_grey_stone += 20;
        }
        
        if($count_dark_grey>0)
        {
            $porcentaje_cristal = ($count_dark_grey * 1) / $zona_cristal;
            $porcentaje = 0;
            if($diseno_puerta['terminacion'] == 2 || $diseno_puerta['terminacion'] == 7 || $diseno_puerta['terminacion'] == 18){ $porcentaje = (0.33 * $porcentaje_cristal); }
            if($diseno_puerta['terminacion'] == 3 || $diseno_puerta['terminacion'] == 8 || $diseno_puerta['terminacion'] == 19 || $diseno_puerta['terminacion'] == 28){ $porcentaje = (0.50 * $porcentaje_cristal); }
            if($diseno_puerta['terminacion'] == 4 || $diseno_puerta['terminacion'] == 17){ $porcentaje = (1 * $porcentaje_cristal); }

            $puerta = intval($proyecto['ancho']) / $proyecto['num_puertas']; // Ancho de una puerta
            $plus_dark_grey += (35 * ($puerta * intval($proyecto['alto']) * $porcentaje / 10000));
        }
    }

    return [
        'cream_stone' => $plus_cream_stone,
        'grey_stone' => $plus_grey_stone,
        'dark_grey' => $plus_dark_grey
    ];
}

function extractColorInterior($num_modulos,$db)
{
	$plus_cream_stone = 0;
	$plus_grey_stone = 0;

	$num_modulo = 0;
	for ($j = 1; $j <= $num_modulos; $j++) 
	{
		$num_modulo++;
		global ${'interior_puerta_'.$num_modulo};
		$nodo_puerta = ${'interior_puerta_'.$num_modulo};
		if(count($nodo_puerta) > 9)
		{
			$color_interior = $db->getVar('SELECT nombre FROM colores WHERE id='.$nodo_puerta[28]);
			$color_cantoneras = $db->getVar('SELECT nombre FROM colores WHERE id='.$nodo_puerta[29]);

			if($color_interior == "Cream Stone" || $color_cantoneras == "Cream Stone")
			{
				$plus_cream_stone += 20;
			}

			if($color_interior == "Grey Stone" || $color_cantoneras == "Grey Stone")
			{
				$plus_grey_stone += 20;
			}
		}
		else
		{
			$color_interior = $db->getVar('SELECT nombre FROM colores WHERE id='.$nodo_puerta[28]);
			$color_cantoneras = $db->getVar('SELECT nombre FROM colores WHERE id='.$nodo_puerta[29]);

			if($color_interior == "Cream Stone" || $color_cantoneras == "Cream Stone")
			{
				$plus_cream_stone += 20;
			}

			if($color_interior == "Grey Stone" || $color_cantoneras == "Grey Stone")
			{
				$plus_grey_stone += 20;
			}
		}
	}

	return [
		'cream_stone' => $plus_cream_stone,
		'grey_stone' => $plus_grey_stone
	];
}

function extract_extra_data($db,$tipo_modulo)
{

}



?>