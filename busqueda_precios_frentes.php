<?php
    require_once("etc/conf.php");
    require_once("libs/database.php");

    $db = new Database();

    // Inicializamos las variables
    $serie = $acabado = $diseno = $terminacion = "";

    $series = $db->getResults("SELECT id,nombre FROM series");
    $acabados = $db->getResults("SELECT id,nombre FROM acabados");
    $disenos = $db->getResults("SELECT id,nombre FROM disenos");
    $id_terminaciones = [];
    $nombre_terminaciones = []; 
    $medida = "2-140"; // Valor por defecto

    // Funcion que filtre las terminaciones, segun las variables seleccionadas $series,$acabados y $disenos
    if(isset($_POST['buscar'])){
        $serie = $_POST['serie'];
        $acabado = $_POST['acabado'];
        $diseno = $_POST['diseno'];

        $id_serie = intval($serie);
        $id_acabado = intval($acabado);
        $id_diseno = intval($diseno);
        $terminaciones = $db->getResults("SELECT id_terminaciones FROM series_acabados_disenos_terminaciones WHERE id_series = $id_serie AND id_acabados = $id_acabado AND id_disenos = $id_diseno");
        // Depurar array terminaciones para ver si coge los valores correctos
        foreach($terminaciones as $t){
            $id_terminaciones[] = $t['id_terminaciones'];
            $nombre = $db->getVar("SELECT nombre FROM terminaciones WHERE id = ".$t['id_terminaciones']);
            $nombre_terminaciones[] = $nombre;
        }
    }
    

    // Funcion que muestre el precio segun las variables seleccionadas
    if(isset($_POST['ver_precio'])){
       // necesito recoger los valores de los select del form anterior para realizar una consulta de los precios
        $serie = $_POST['serie'];
        $acabado = $_POST['acabado'];
        $diseno = $_POST['diseno'];
        $terminacion = $_POST['terminacion'];
        $medida = $_POST['medida'];
        $hojas = substr($medida, 0, 1); // Extraer el número de hojas de la medida seleccionada
        $id_precio = $db->getVar("SELECT id FROM series_acabados_disenos_terminaciones WHERE id_series = $serie AND id_acabados = $acabado AND id_disenos = $diseno AND id_terminaciones = $terminacion");
        $precio = $db->getVar("SELECT `$medida` FROM precios_c1 WHERE id_s_a_d_t = $id_precio");
        $montaje = $db->getVar("SELECT precio FROM montajes_frentes WHERE id_series = $serie AND hojas = $hojas");

        echo "<h3>Id del precio: ". $id_precio . "</h3>";
        echo "<h3>El precio sin montaje es: ". $precio . "€</h3>";
        echo "<h3>El precio con montaje es: ". round(($precio * 1.35 + $montaje)*1.21) . "€</h3>";
    }

    // Funcion que anote los cambios en el fichero changes.csv
    if(isset($_POST['anotar_cambio'])){
        $serie = $_POST['serie'];
        $acabado = $_POST['acabado'];
        $diseno = $_POST['diseno'];
        $terminacion = $_POST['terminacion'];
        $medida = $_POST['medida'];
        $id_precio = $_POST['id_precio'];
        $nuevo_precio = $_POST['nuevo_precio'];

        $old_price = $db->getVar("SELECT `$medida` FROM precios_c1 WHERE id_s_a_d_t = $id_precio");
        
        // Obtener los nombres de serie, acabado, diseño y terminación
        $nombre_serie = $db->getVar("SELECT nombre FROM series WHERE id = $serie");
        $nombre_acabado = $db->getVar("SELECT nombre FROM acabados WHERE id = $acabado");
        $nombre_diseno = $db->getVar("SELECT nombre FROM disenos WHERE id = $diseno");
        $nombre_terminacion = $db->getVar("SELECT nombre FROM `8432940_arjomy-17-10-22`.`terminaciones` WHERE `id` = $terminacion");

        // Anotar los cambios en el fichero cambios_precios_frentes.csv
        $file = fopen("cambios_precios_frentes.csv", "a");
        fputcsv($file, [$nombre_serie, $nombre_acabado, $nombre_diseno, $nombre_terminacion, $id_precio, $medida, $old_price, $nuevo_precio]);
        fclose($file);

        echo "<h3>Cambio anotado: Serie: $nombre_serie, Acabado: $nombre_acabado, Diseño: $nombre_diseno, Terminación: $nombre_terminacion, Precio Antiguo: $old_price €, Nuevo Precio: $nuevo_precio €</h3>";
    }

    if(isset($_POST['guardar_cambios'])){
        // Leer el archivo CSV y actualizar los precios en la base de datos
        if (($file = fopen("cambios_precios_frentes.csv", "r")) !== FALSE) {
            // Omitir la primera línea si contiene encabezados
            $headers = fgetcsv($file);
            while (($data = fgetcsv($file)) !== FALSE) {
                list($nombre_serie, $nombre_acabado, $nombre_diseno, $nombre_terminacion, $id_precio, $medida, $old_price, $new_price) = $data;
                // Actualizar el precio en la base de datos
                
                $conexion = $db->connectDB();
                $update_sql = "UPDATE precios_c1 SET `$medida` = $new_price WHERE id_s_a_d_t = $id_precio";
                mysqli_query($conexion, $update_sql);
                
                $db->disconnectDB($conexion);
            }
            fclose($file);
            echo "<h3>Todos los cambios han sido guardados en la base de datos.</h3>";
        } else {
            echo "<h3>Error al abrir el archivo de cambios.</h3>";
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda dinámica</title>
</head>
<body>
    <form method="post">
        <label for="serie">Serie:</label>
        <select id="serie" name="serie">
            <?php foreach ($series as $s): ?>
                <option value="<?php echo $s['id']; ?>" <?php if ($serie == $s['id']) echo "selected"; ?>><?php echo htmlspecialchars($s['nombre']); ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="acabado">Acabado:</label>
        <select id="acabado" name="acabado">
            <?php foreach ($acabados as $a): ?>
                <option value="<?php echo $a['id']; ?>" <?php if ($acabado == $a['id']) echo "selected"; ?>><?php echo htmlspecialchars($a['nombre']); ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="diseno">Diseño:</label>
        <select id="diseno" name="diseno">
            <?php foreach ($disenos as $d): ?>
                <option value="<?php echo $d['id']; ?>" <?php if ($diseno == $d['id']) echo "selected"; ?>><?php echo htmlspecialchars($d['nombre']); ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <button type="submit" name="buscar">Filtrar</button>
    </form>
    <br><br>
    <form method="post">
        <input type="hidden" name="serie" value="<?php echo htmlspecialchars($serie); ?>">
        <input type="hidden" name="acabado" value="<?php echo htmlspecialchars($acabado); ?>">
        <input type="hidden" name="diseno" value="<?php echo htmlspecialchars($diseno); ?>">
        <label for="terminacion">Terminación:</label>
        <select id="terminacion" name="terminacion">
            <?php foreach ($id_terminaciones as $t): ?>
                <option value="<?php echo $t; ?>" <?php if ($terminacion == $t) echo "selected"; ?>><?php echo htmlspecialchars($t); ?></option>
            <?php endforeach; ?>
        </select>
        <select id="nombre_terminacion" name="nombre_terminacion">
            <?php foreach ($nombre_terminaciones as $nombre_t): ?>
                <option value="<?php echo $nombre_t; ?>" <?php if ($terminacion == $nombre_t) echo "selected"; ?>><?php echo htmlspecialchars($nombre_t); ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label for="medida">Medida:</label>
        <select id="medida" name="medida">
            <option value="2-140" <?php if ($medida == "2-140") echo "selected"; ?>>2-140</option>
            <option value="2-200" <?php if ($medida == "2-200") echo "selected"; ?>>2-200</option>
            <option value="3-220" <?php if ($medida == "3-220") echo "selected"; ?>>3-220</option>
            <option value="3-300" <?php if ($medida == "3-300") echo "selected"; ?>>3-300</option>
            <option value="4-280" <?php if ($medida == "4-280") echo "selected"; ?>>4-280</option>
            <option value="4-340" <?php if ($medida == "4-340") echo "selected"; ?>>4-340</option>
            <option value="4-400" <?php if ($medida == "4-400") echo "selected"; ?>>4-400</option>
            <option value="5-360" <?php if ($medida == "5-360") echo "selected"; ?>>5-360</option>
            <option value="5-420" <?php if ($medida == "5-420") echo "selected"; ?>>5-420</option>
            <option value="5-440" <?php if ($medida == "5-440") echo "selected"; ?>>5-440</option>
            <option value="5-500" <?php if ($medida == "5-500") echo "selected"; ?>>5-500</option>
            <option value="6-440" <?php if ($medida == "6-440") echo "selected"; ?>>6-440</option>
            <option value="6-520" <?php if ($medida == "6-520") echo "selected"; ?>>6-520</option>
            <option value="6-600" <?php if ($medida == "6-600") echo "selected"; ?>>6-600</option>
            <option value="1-60" <?php if ($medida == "1-60") echo "selected"; ?>>1-60</option>
            <option value="2-130" <?php if ($medida == "2-130") echo "selected"; ?>>2-130</option>
            <option value="3-180" <?php if ($medida == "3-180") echo "selected"; ?>>3-180</option>
            <option value="4-240" <?php if ($medida == "4-240") echo "selected"; ?>>4-240</option>
            <option value="5-320" <?php if ($medida == "5-320") echo "selected"; ?>>5-320</option>
            <option value="6-360" <?php if ($medida == "6-360") echo "selected"; ?>>6-360</option>
        </select>
        <br><br>
        <button type="submit" name="ver_precio">Ver Precio</button>
    </form>
    <br><br>
    <form method="post">
        <input type="hidden" name="serie" value="<?php echo htmlspecialchars($serie); ?>">
        <input type="hidden" name="acabado" value="<?php echo htmlspecialchars($acabado); ?>">
        <input type="hidden" name="diseno" value="<?php echo htmlspecialchars($diseno); ?>">
        <input type="hidden" name="terminacion" value="<?php echo htmlspecialchars($terminacion); ?>">
        <input type="hidden" name="medida" value="<?php echo htmlspecialchars($medida); ?>">
        <input type="number" name="id_precio" placeholder="ID Precio">
        <br><br>
        <input type="number" name="nuevo_precio" placeholder="Nuevo Precio">
        <br><br>
        <button type="submit" name="anotar_cambio">Anotar Cambio</button>
    </form>

    <h1>GUARDAR CAMBIOS</h1>
    <h3><b>ATENCIÓN:</b> Guardar los cambios una vez que se haya actualizado todos los precios de los frentes.</h3>
    <form method="post">
        <button type="submit" name="guardar_cambios">Guardar Cambios en la Base de Datos</button>
    </form>
</body>
</html>
