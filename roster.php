<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

session_start();

// Consultar los jugadores junto con el nombre del equipo
$sql = "SELECT jugadores.nombre, jugadores.apellido, jugadores.edad, jugadores.numero, jugadores.pais, equipos.nombre AS equipo 
        FROM jugadores 
        INNER JOIN equipos ON jugadores.id_equipo = equipos.id";
$result = $mysqli->query($sql);

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
    <title>Roster - Tiburones</title>
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
        <h1>Roster del Equipo Tiburones</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Número</th>
                    <th scope="col">País</th>
                    <th scope="col">Equipo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><a class="dropdown-item" href="perfil_jugador.php?id=<?php echo urlencode($row['nombre']); ?>"><?php echo htmlspecialchars($row['nombre']); ?></a></td>
                    <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($row['edad']); ?></td>
                    <td><?php echo htmlspecialchars($row['numero']); ?></td>
                    <td><?php echo htmlspecialchars($row['pais']); ?></td>
                    <td><?php echo htmlspecialchars($row['equipo']); ?></td>
                </tr>
                <?php endwhile; ?>
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

