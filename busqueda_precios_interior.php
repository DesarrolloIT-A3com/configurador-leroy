<?php
require_once("etc/conf.php");
require_once("libs/database.php");

$db = new Database();

// Inicializamos las variables
$serie = "";
$series = $db->getResults("SELECT id,nombre FROM series");
$medida = "2-140"; // Valor por defecto

// Funcion que muestre el precio segun las variables seleccionadas
if(isset($_POST['ver_precio'])){
    // necesito recoger los valores de los select del form anterior para realizar una consulta de los precios
    $serie = $_POST['serie'];
    $medida = $_POST['medida'];
    $modulos = substr($medida, 0, 1); // Extraer el número de módulos de la medida seleccionada
    $precio = $db->getVar("SELECT `$medida` FROM interiores_c1 WHERE id_series = $serie");
    $montaje = $db->getVar("SELECT precio FROM montajes_interiores WHERE modulos = $modulos");

    echo "<h3>Id de la serie: ". $serie . "</h3>";
    echo "<h3>El precio sin montaje es: ". $precio . "€</h3>";
    echo "<h3>El precio con montaje es: ". round(($precio * 1.35 + $montaje)*1.21) . "€</h3>";
}

// Funcion que anote los cambios en el fichero changes.csv
if(isset($_POST['anotar_cambio'])){
    $serie = $_POST['serie'];;
    $medida = $_POST['medida'];
    $nuevo_precio = $_POST['nuevo_precio'];

    $old_price = $db->getVar("SELECT `$medida` FROM interiores_c1 WHERE id_series = $serie");

    // Obtener los nombres de serie, acabado, diseño y terminación
    $nombre_serie = $db->getVar("SELECT nombre FROM series WHERE id = $serie");

    // Anotar los cambios en el fichero cambios_precios_interiores.csv
    $file = fopen("cambios_precios_interiores.csv", "a");
    fputcsv($file, [$nombre_serie, $serie, $medida, $old_price, $nuevo_precio]);
    fclose($file);
    echo "<h3>Cambio anotado: Serie: $nombre_serie, Precio Antiguo: $old_price €, Nuevo Precio: $nuevo_precio €</h3>";
}

if(isset($_POST['guardar_cambios'])){
    // Leer el archivo CSV y actualizar los precios en la base de datos
    if (($file = fopen("cambios_precios_interiores.csv", "r")) !== FALSE) {
        // Omitir la primera línea si contiene encabezados
        $headers = fgetcsv($file);
        while (($data = fgetcsv($file)) !== FALSE) {
            list($nombre_serie, $id_serie, $medida, $old_price, $new_price) = $data;
            // Actualizar el precio en la base de datos
            
            $conexion = $db->connectDB();
            $update_sql = "UPDATE interiores_c1 SET `$medida` = $new_price WHERE id_series = $id_serie";
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
        <button type="submit" name="ver_precio">Ver precio</button>
    </form>

    <form method="post">
        <input type="hidden" name="serie" value="<?php echo htmlspecialchars($serie); ?>">
        <input type="hidden" name="acabado" value="<?php echo htmlspecialchars($acabado); ?>">
        <input type="hidden" name="diseno" value="<?php echo htmlspecialchars($diseno); ?>">
        <input type="hidden" name="terminacion" value="<?php echo htmlspecialchars($terminacion); ?>">
        <input type="hidden" name="medida" value="<?php echo htmlspecialchars($medida); ?>">
        <input type="number" name="id_serie" placeholder="ID Serie">
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