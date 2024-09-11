<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

session_start();

// Consultar los equipos
$sql = "SELECT id, nombre FROM equipos";

$result = $mysqli->query($sql);

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
// Verificar la conexión
if (!$result) {
    die("Error en la consulta: " . $mysqli->error);
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Resultados</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
// Barra de Navegacion
include 'nav.php'; 
?>

    

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
