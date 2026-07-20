<?php
require_once("etc/conf.php");
require_once("libs/database.php");

$db = new Database();

// Inicializamos las variables
$acabado = $colores_tipo = "";

$colores_tipos = $db->getResults("SELECT nombre FROM colores_tipo");
$colores_activos = [];
$all_colores = [];
$activar_color = false;
$colores_seleccionados = "";

if(isset($_POST['ver_colores'])){
    $colores_tipo = $_POST['colores_tipo'];
    $id_color_tipo = $db->getVar("SELECT id FROM colores_tipo WHERE nombre = '$colores_tipo'");
    $cactivos = $db->getResults("SELECT nombre FROM colores WHERE activo = 1 AND es_tablero = 1 AND id_colores_tipo = $id_color_tipo");
    $colores = $db->getResults("SELECT nombre FROM colores WHERE activo = 1  AND id_colores_tipo = $id_color_tipo");
    foreach($cactivos as $c){
        $colores_activos[] = $c['nombre'];
    }
    foreach($colores as $i){
        $all_colores[] = $i['nombre'];
    }
}

if(isset($_POST['anotar_cambio'])){
    $colores_tipo = $_POST['colores_tipo'];
    $id_color_tipo = $db->getVar("SELECT id FROM colores_tipo WHERE nombre = '$colores_tipo'");
    // Recoge el string del input reactivo
    $colores_seleccionados = isset($_POST['colores_seleccionados']) ? $_POST['colores_seleccionados'] : '';
    $activar_color = isset($_POST['activar_color']) ? true : false;

    if($activar_color == false)
    { 
        $id_color = $db->getVar("SELECT id FROM colores WHERE nombre = '$colores_seleccionados' AND id_colores_tipo = $id_color_tipo AND es_tablero = 1");
        // Anotar los cambios en el fichero cambios_colores_series.csv
        $file = fopen("cambios_colores_frentes.csv", "a");
        fputcsv($file, [$id_color_tipo, $id_color, $activar_color ? 1 : 0]);
        fclose($file);
        echo "<h3>Cambio anotado: Serie: $colores_tipo, Color: $colores_seleccionados, Activar: " . ($activar_color ? "Sí" : "No") . "</h3>";

    }
    else
    {
        $id_color = $db->getVar("SELECT id FROM colores WHERE nombre = '$colores_seleccionados' AND id_colores_tipo = $id_color_tipo AND es_tablero = 0");
        // Anotar los cambios en el fichero cambios_colores_series.csv
        $file = fopen("cambios_colores_frentes.csv", "a");
        fputcsv($file, [$id_color_tipo, $id_color, $activar_color ? 1 : 0]);
        fclose($file);  
        echo "<h3>Cambio anotado: Serie: $colores_tipo, Color: $colores_seleccionados, Activar: " . ($activar_color ? "Sí" : "No") . "</h3>";

    }


    $cactivos = $db->getResults("SELECT nombre FROM colores WHERE activo = 1 AND es_tablero = 1 AND id_colores_tipo = $id_color_tipo");
    $colores = $db->getResults("SELECT nombre FROM colores WHERE activo = 1  AND id_colores_tipo = $id_color_tipo");
    foreach($cactivos as $c){
        $colores_activos[] = $c['nombre'];
    }
    foreach($colores as $i){
        $all_colores[] = $i['nombre'];
    }
}

if(isset($_POST['guardar_cambios'])){
    $colores_tipo = $_POST['colores_tipo'];
    $id_color_tipo = $db->getVar("SELECT id FROM colores_tipo WHERE nombre = '$colores_tipo'");
    // Leer el archivo CSV y actualizar los precios en la base de datos
    if (($file = fopen("cambios_colores_frentes.csv", "r")) !== FALSE) {
        // Omitir la primera línea si contiene encabezados
        $headers = fgetcsv($file);
        while (($data = fgetcsv($file)) !== FALSE) {
            list($id_color_tipo, $id_color, $activar_color) = $data;
            // Actualizar el precio en la base de datos
            
            $conexion = $db->connectDB();
            if($activar_color==1)
            {
                $query = "UPDATE colores SET es_tablero = 1 WHERE id = $id_color AND id_colores_tipo = $id_color_tipo";
                mysqli_query($conexion, $query);
            }
            else
            {
                $query = "UPDATE colores SET es_tablero = 0 WHERE id = $id_color AND id_colores_tipo = $id_color_tipo";
                mysqli_query($conexion, $query);
            }
        }
        fclose($file);
        echo "<h3>Todos los cambios han sido guardados en la base de datos.</h3>";
    } else {
        echo "<h3>Error al abrir el archivo de cambios.</h3>";
    }
    // Volver a cargar los colores activos y todos los colores
     $cactivos = $db->getResults("SELECT nombre FROM colores WHERE activo = 1 AND es_tablero = 1 AND id_colores_tipo = $id_color_tipo");
    $colores = $db->getResults("SELECT nombre FROM colores WHERE activo = 1  AND id_colores_tipo = $id_color_tipo");
    $colores_activos = [];
    $all_colores = [];
    foreach($cactivos as $c){
        $colores_activos[] = $c['nombre'];
    }
    foreach($colores as $i){
        $all_colores[] = $i['nombre'];
    }
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Colores Series</title>
</head>
<body>
    <form method="post">
         <label for="colores_tipo">Tipo de Color:</label>
        <select id="colores_tipo" name="colores_tipo">
            <?php foreach ($colores_tipos as $ct): ?>
                <option value="<?php echo htmlspecialchars($ct['nombre']); ?>" <?php if ($colores_tipos == $ct['nombre']) echo "selected"; ?>>
                    <?php echo htmlspecialchars($ct['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <button type="submit" name="ver_colores">Ver Colores</button>
    </form>
    <form method="post">
        <input type="hidden" name="colores_tipo" value="<?php echo htmlspecialchars($colores_tipo); ?>">

        <?php if (!empty($colores_activos) || !empty($all_colores)): ?>
            <h2>Colores Activos</h2>
            <table border="1">
                <tr>
                    <th>Color</th>
                </tr>
                <?php foreach ($colores_activos as $color): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($color); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <label for="colores">Seleccionar Colores:</label>
        <select id="colores" name="colores[]" multiple>
            <?php foreach ($all_colores as $color): ?>
                <option value="<?php echo htmlspecialchars($color); ?>"><?php echo htmlspecialchars($color); ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <!-- Input reactivo -->
        <label for="colores_seleccionados">Colores seleccionados:</label>
        <input type="text" id="colores_seleccionados" name="colores_seleccionados" readonly>
        <script>
            const selectColores = document.getElementById('colores');
            const inputColores = document.getElementById('colores_seleccionados');
            selectColores.addEventListener('change', function() {
                const seleccionados = Array.from(this.selectedOptions).map(opt => opt.value);
                inputColores.value = seleccionados.join(', ');
            });
        </script>
        <br><br>
        <label>Activar color:</label>
        <input type="checkbox" id="activar_color" name="activar_color" <?php if ($activar_color) echo "checked"; ?>>
        <br><br>
        <button type="submit" name="anotar_cambio">Anotar Cambio</button>

    </form>

     <h1>GUARDAR CAMBIOS</h1>
    <h3><b>ATENCIÓN:</b> Guardar los cambios una vez que se haya actualizado todos los precios de los frentes.</h3>
    <form method="post">
        <input type="hidden" name="colores_tipo" value="<?php echo htmlspecialchars($colores_tipo); ?>">
        <button type="submit" name="guardar_cambios">Guardar Cambios en la Base de Datos</button>
    </form>
</body>
</html>