<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

session_start();

// Consultar las posiciones de los equipos
$sql = "
SELECT 
    e.id AS equipo_id,
    e.nombre AS equipo_nombre,
    SUM(
        CASE 
            WHEN j.home_club = e.id AND j.ganador_home_club = e.id THEN 1 
            WHEN j.visitante = e.id AND j.ganador_visitante = e.id THEN 1 
            ELSE 0 
        END
    ) AS ganados,
    SUM(
        CASE 
            WHEN j.home_club = e.id AND j.perdedor_home_club = e.id THEN 1 
            WHEN j.visitante = e.id AND j.perdedor_visitante = e.id THEN 1 
            ELSE 0 
        END
    ) AS perdidos,
    SUM(
        CASE 
            WHEN j.empate = 1 AND (j.home_club = e.id OR j.visitante = e.id) THEN 1 
            ELSE 0 
        END
    ) AS empatados,
    COUNT(j.id) AS juegos_jugados -- Nueva columna para contar el total de juegos jugados
FROM 
    equipos e
LEFT JOIN 
    juegos j ON e.id = j.home_club OR e.id = j.visitante
GROUP BY 
    e.id, e.nombre
ORDER BY 
    ganados DESC, empatados DESC;


";

$result = $mysqli->query($sql);


// Verificar si hay resultados
if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
}

// Resultados agregados

$sql1 = "SELECT 
    juegos.id,
    juegos.fecha_juego,
    juegos.resultado_visitante,
    juegos.resultado_home_club,
    juegos.temporada,
    equipos_visitante.nombre AS nombre_visitante,
    equipos_home_club.nombre AS nombre_home_club
FROM juegos
INNER JOIN equipos AS equipos_visitante ON juegos.visitante = equipos_visitante.id
INNER JOIN equipos AS equipos_home_club ON juegos.home_club = equipos_home_club.id;
";

     
$result1 = $mysqli->query($sql1);

// Verificar si hay resultados
if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Posiciones del Club de Béisbol</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
// Barra de Navegacion
include 'nav.php'; 
?>

    <!-- Tabla de Posiciones -->
    <div class="container mt-4">
        <h1>Posiciones del Club de Béisbol</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Posición</th>
                    <th>Equipo</th>
                    <th>Juegos Jugados</th>
                    <th>Ganados</th>
                    <th>Perdidos</th>
                    <th>Empatados</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $posicion = 1;
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $posicion++; ?></td>
                        <td><?php echo htmlspecialchars($row['equipo_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['juegos_jugados']); ?></td>
                        <td><?php echo htmlspecialchars($row['ganados']); ?></td>
                        <td><?php echo htmlspecialchars($row['perdidos']); ?></td>
                        <td><?php echo htmlspecialchars($row['empatados']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


         <!-- Contenido Primario -->
         <div class="container mt-4">
        <h1>Resultados juegos</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Visitante</th>
                    <th scope="col">Carreras</th>
                    <th scope="col">Home Club</th>
                    <th scope="col">Carreras</th>
                    <th scope="col">Fecha de Juego</th>
                    <th scope="col">Temporada</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result1->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_visitante']); ?></td>
                    <td><?php echo htmlspecialchars($row['resultado_visitante']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre_home_club']); ?></td>
                    <td><?php echo htmlspecialchars($row['resultado_home_club']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_juego']); ?></td>
                    <td><?php echo htmlspecialchars($row['temporada']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
