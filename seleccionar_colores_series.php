<?php
require_once("etc/conf.php");
require_once("libs/database.php");

$db = new Database();

// Inicializamos las variables
$serie = $acabado = "";

$series = $db->getResults("SELECT id,nombre FROM series");
$acabados = $db->getResults("SELECT nombre FROM acabados");
$colores_activos = [];
$all_colores = [];
$activar_color = false;
$colores_seleccionados = "";
if(isset($_POST['ver_colores'])){
    $serie = $_POST['serie'];
    $acabado = $_POST['acabado'];
    $id_acabado = $db->getVar("SELECT id_colores_tipo FROM acabados WHERE nombre = '$acabado'");
    $nombre_serie = $db->getVar("SELECT nombre FROM series WHERE id = $serie");
    $cactivos = $db->getResults("SELECT c.nombre FROM colores as c, series_colores as sc WHERE sc.id_series = $serie AND c.id = sc.id_colores AND c.activo = 1 AND c.es_perfileria = 1 AND c.id_colores_tipo = $id_acabado");

    $colores = $db->getResults("SELECT nombre FROM colores WHERE activo = 1 AND es_perfileria = 1 AND id_colores_tipo = $id_acabado");
    foreach($cactivos as $c){
        $colores_activos[] = $c['nombre'];
    }
    foreach($colores as $i){
        $all_colores[] = $i['nombre'];
    }
}

if(isset($_POST['anotar_cambio'])){
    $serie = $_POST['serie'];
    $acabado = $_POST['acabado'];
    $id_acabado = $db->getVar("SELECT id_colores_tipo FROM acabados WHERE nombre = '$acabado'");
    // Recoge el string del input reactivo
    $colores_seleccionados = isset($_POST['colores_seleccionados']) ? $_POST['colores_seleccionados'] : '';
    $activar_color = isset($_POST['activar_color']) ? true : false;
    $nombre_serie = $db->getVar("SELECT nombre FROM series WHERE id = $serie");

    if($activar_color == false)
    { 
        $id_color = $db->getVar("SELECT id FROM colores WHERE nombre = '$colores_seleccionados' AND id_colores_tipo = $id_acabado");
        // Anotar los cambios en el fichero cambios_colores_series.csv
        $file = fopen("cambios_colores_series.csv", "a");
        fputcsv($file, [$serie, $id_color, $activar_color ? 1 : 0]);
        fclose($file);
        echo "<h3>Cambio anotado: Serie: $nombre_serie, Color: $colores_seleccionados, Acabado: $acabado, Activar: " . ($activar_color ? "Sí" : "No") . "</h3>";

    }
    else
    {
        $id_color = $db->getVar("SELECT id FROM colores WHERE nombre = '$colores_seleccionados' AND id_colores_tipo = $id_acabado");
        // Anotar los cambios en el fichero cambios_colores_series.csv
        $file = fopen("cambios_colores_series.csv", "a");
        fputcsv($file, [$serie, $id_color, $activar_color ? 1 : 0]);
        fclose($file);  
        echo "<h3>Cambio anotado: Serie: $nombre_serie, Color: $colores_seleccionados, Acabado: $acabado, Activar: " . ($activar_color ? "Sí" : "No") . "</h3>";

    }


    $cactivos = $db->getResults("SELECT c.nombre FROM colores as c, series_colores as sc WHERE sc.id_series = $serie AND c.id = sc.id_colores AND c.activo = 1 AND c.es_perfileria = 1 AND c.id_colores_tipo = $id_acabado");
    $colores = $db->getResults("SELECT nombre FROM colores WHERE activo = 1 AND es_perfileria = 1");
    foreach($cactivos as $c){
        $colores_activos[] = $c['nombre'];
    }
    foreach($colores as $i){
        $all_colores[] = $i['nombre'];
    }
}

if(isset($_POST['guardar_cambios'])){
    $serie = $_POST['serie'];
    $acabado = $_POST['acabado'];
    $id_acabado = $db->getVar("SELECT id_colores_tipo FROM acabados WHERE nombre = '$acabado'");
    // Leer el archivo CSV y actualizar los precios en la base de datos
    if (($file = fopen("cambios_colores_series.csv", "r")) !== FALSE) {
        // Omitir la primera línea si contiene encabezados
        $headers = fgetcsv($file);
        while (($data = fgetcsv($file)) !== FALSE) {
            list($serie, $id_color, $activar_color) = $data;
            // Actualizar el precio en la base de datos
            
            $conexion = $db->connectDB();
            echo $activar_color;
            if($activar_color==1)
            {
                $query = "INSERT INTO series_colores (id_series,id_colores) VALUES ($serie,$id_color)";
                mysqli_query($conexion, $query);
            }
            else
            {
                $query = "DELETE FROM series_colores WHERE id_series = $serie AND id_colores = $id_color";
                mysqli_query($conexion, $query);
            }
        }
        fclose($file);
        echo "<h3>Todos los cambios han sido guardados en la base de datos.</h3>";
    } else {
        echo "<h3>Error al abrir el archivo de cambios.</h3>";
    }
    // Volver a cargar los colores activos y todos los colores
    $cactivos = $db->getResults("SELECT c.nombre FROM colores as c, series_colores as sc WHERE sc.id_series = $serie AND c.id = sc.id_colores AND c.activo = 1 AND c.es_perfileria = 1 AND c.id_colores_tipo = $id_acabado");
    $colores = $db->getResults("SELECT nombre FROM colores WHERE activo = 1 AND es_perfileria = 1");
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
                <option value="<?php echo htmlspecialchars($a['nombre']); ?>" <?php if ($acabado == $a['nombre']) echo "selected"; ?>>
                    <?php echo htmlspecialchars($a['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <button type="submit" name="ver_colores">Ver Colores</button>
    </form>
    <form method="post">
        <input type="hidden" name="serie" value="<?php echo htmlspecialchars($serie); ?>">
        <input type="hidden" name="acabado" value="<?php echo htmlspecialchars($acabado); ?>">
        
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
        <input type="hidden" name="serie" value="<?php echo htmlspecialchars($serie); ?>">
        <input type="hidden" name="acabado" value="<?php echo htmlspecialchars($acabado); ?>">
        <button type="submit" name="guardar_cambios">Guardar Cambios en la Base de Datos</button>
    </form>
</body>
</html>