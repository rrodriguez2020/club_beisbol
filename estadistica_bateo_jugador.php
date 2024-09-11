<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración
session_start();


// Consultar las estadísticas de bateo por jugador
$sql = "SELECT 
            eb.id, 
            eb.g,
             j.nombre AS jugador_nombre, 
            COUNT(eb.g) AS juegos,
            SUM(eb.ab) AS ab, 
            SUM(eb.hr) AS hr,
            SUM(eb.bb) AS bb,
            SUM(eb.rbi) AS rbi,
            SUM(eb.r) AS r,
            SUM(eb.so) AS so,
            SUM(eb.h) AS h,
            SUM(eb.dobles) AS dobles,
            SUM(eb.triples) AS triples,
            SUM(eb.hbp) AS hbp,
            SUM(eb.sb) AS sb,
            IF(SUM(eb.ab) > 0, ROUND((SUM(eb.h) + SUM(eb.dobles) + SUM(eb.triples) + SUM(eb.hr)) / SUM(eb.ab) * 1000), 0) AS avg -- Calcular AVG utilizando directamente la suma de hb
        FROM 
            jugadores j
        LEFT JOIN 
            estadistica_bateador eb ON j.id = eb.id_jugador
        GROUP BY 
            j.nombre
        ORDER BY 
            avg DESC"; // Puedes cambiar el orden según lo necesites

$result = $mysqli->query($sql);

// Inicializar variables para totales
$total_g = $total_ab = $total_hr = $total_bb = $total_rbi = $total_r = 0;
$total_so = $total_h = $total_dobles = $total_triples = $total_hbp = $total_sb = 0;

while ($row = $result->fetch_assoc()) {
    // Acumular los totales
    $total_g += $row['g'];
    $total_ab += $row['ab'];
    $total_hr += $row['hr'];
    $total_bb += $row['bb'];
    $total_rbi += $row['rbi'];
    $total_r += $row['r'];
    $total_so += $row['so'];
    $total_h += $row['h'];
    $total_dobles += $row['dobles'];
    $total_triples += $row['triples'];
    $total_hbp += $row['hbp'];
    $total_sb += $row['sb'];

    // Guardar filas para mostrar
    $rows[] = $row;
}

// Calcular el promedio general (AVG)
//$total_avg = ($total_ab > 0) ? round(($total_h || $total_hr || $total_dobles ||$total_triples / $total_ab) * 1000, 3) : 0;
$total_avg = ($total_ab > 0) ? round((($total_h + $total_hr + $total_dobles + $total_triples) / $total_ab) * 1000) : 0;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Estadísticas de Bateo - Tiburones</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
// Barra de Navegacion
include 'nav.php'; 
?>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1>Estadísticas de Bateo</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Jugador</th>
                    <th>Juegos</th>
                    <th>AB</th>
                    <th>HR</th>
                    <th>BB</th>
                    <th>RBI</th>
                    <th>R</th>
                    <th>SO</th>
                    <th>H</th>
                    <th>Dobles</th>
                    <th>Triples</th>
                    <th>HBP</th>
                    <th>SB</th>
                    <th>AVG</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?php echo $row['jugador_nombre']; ?></td>
                    <td><?php echo $row['g']; ?></td>
                    <td><?php echo $row['ab']; ?></td>
                    <td><?php echo $row['hr']; ?></td>
                    <td><?php echo $row['bb']; ?></td>
                    <td><?php echo $row['rbi']; ?></td>
                    <td><?php echo $row['r']; ?></td>
                    <td><?php echo $row['so']; ?></td>
                    <td><?php echo $row['h']; ?></td>
                    <td><?php echo $row['dobles']; ?></td>
                    <td><?php echo $row['triples']; ?></td>
                    <td><?php echo $row['hbp']; ?></td>
                    <td><?php echo $row['sb']; ?></td>
                    <td><?php echo $row['avg']; ?></td>
                </tr>
                <?php endforeach; ?>
                
                <!-- Fila de Totales -->
                <tr class="fw-bold">
                    <td>Totales</td>
                    <td><?php echo $total_g; ?></td>
                    <td><?php echo $total_ab; ?></td>
                    <td><?php echo $total_hr; ?></td>
                    <td><?php echo $total_bb; ?></td>
                    <td><?php echo $total_rbi; ?></td>
                    <td><?php echo $total_r; ?></td>
                    <td><?php echo $total_so; ?></td>
                    <td><?php echo $total_h; ?></td>
                    <td><?php echo $total_dobles; ?></td>
                    <td><?php echo $total_triples; ?></td>
                    <td><?php echo $total_hbp; ?></td>
                    <td><?php echo $total_sb; ?></td>
                    <td><?php echo $total_avg; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$mysqli->close();
?>

