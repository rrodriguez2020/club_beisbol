<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

// Obtener el nombre del jugador desde la URL
$nombre_jugador = $_GET['id']; // Este valor se pasa desde el enlace en el roster

// Consultar los datos del jugador
$sql = "SELECT jugadores.nombre, jugadores.apellido, jugadores.edad, jugadores.numero, jugadores.pais, jugadores.foto, equipos.nombre AS equipo 
        FROM jugadores 
        INNER JOIN equipos ON jugadores.id_equipo = equipos.id 
        WHERE jugadores.nombre = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $nombre_jugador);
$stmt->execute();
$result = $stmt->get_result();
$jugador = $result->fetch_assoc();

if (!$jugador) {
    die("Jugador no encontrado.");
}

// Consultar las estadísticas de bateo por jugador
$sql = "SELECT 
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
            IF(SUM(eb.ab) > 0, ROUND((SUM(eb.h) + SUM(eb.dobles) + SUM(eb.triples) + SUM(eb.hr)) / SUM(eb.ab) * 1000), 0) AS avg
        FROM 
            estadistica_bateador eb
        WHERE 
            eb.id_jugador = (SELECT id FROM jugadores WHERE nombre = ?)
        GROUP BY 
            eb.id_jugador";

// Preparar y ejecutar la consulta
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $nombre_jugador);
$stmt->execute();
$result = $stmt->get_result();
$estadisticas = $result->fetch_assoc();

// Calcular el promedio general (AVG)
$total_avg = isset($estadisticas['avg']) ? $estadisticas['avg'] / 1000 : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Perfil de <?php echo htmlspecialchars($jugador['nombre'] . ' ' . $jugador['apellido']); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <!-- Barra de Navegación -->
<?php
include 'nav.php'; 
?>
    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1>Perfil de <?php echo htmlspecialchars($jugador['nombre'] . ' ' . $jugador['apellido']); ?></h1>
        <div class="row">
            <div class="col-md-4">
                <img src="uploads/<?php echo htmlspecialchars($jugador['foto']); ?>" alt="Foto de <?php echo htmlspecialchars($jugador['nombre']); ?>" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h3>Información del Jugador</h3>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($jugador['nombre'] . ' ' . $jugador['apellido']); ?></li>
                    <li class="list-group-item"><strong>Edad:</strong> <?php echo htmlspecialchars($jugador['edad']); ?></li>
                    <li class="list-group-item"><strong>Número:</strong> <?php echo htmlspecialchars($jugador['numero']); ?></li>
                    <li class="list-group-item"><strong>País:</strong> <?php echo htmlspecialchars($jugador['pais']); ?></li>
                    <li class="list-group-item"><strong>Equipo:</strong> <?php echo htmlspecialchars($jugador['equipo']); ?></li>
                </ul>
                <h3>Estadísticas de Bateo</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
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
                        <tr>
                            <td><?php echo htmlspecialchars($estadisticas['juegos']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['ab']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['hr']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['bb']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['rbi']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['r']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['so']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['h']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['dobles']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['triples']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['hbp']); ?></td>
                            <td><?php echo htmlspecialchars($estadisticas['sb']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($total_avg, 3)); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$mysqli->close();
?>

