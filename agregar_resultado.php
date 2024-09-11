
<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

include 'session.php';

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
    <title>Agregar Resultado</title>
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
        <h1>Agregar Resultado de Juego</h1>
        <form action="procesar_agregar_resultado.php" method="POST">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="visitante" class="form-label">Equipo Visitante:</label>
                    <select class="form-select" id="visitante" name="visitante" required>
                        <option value="">Selecciona el equipo visitante</option>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="home_club" class="form-label">Equipo Home Club:</label>
                    <select class="form-select" id="home_club" name="home_club" required>
                        <option value="">Selecciona el equipo home club</option>
                        <?php
                        // Volver a consultar los equipos para el equipo home club
                        $result->data_seek(0);
                        while ($row = $result->fetch_assoc()) : ?>
                            <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="fecha_juego" class="form-label">Fecha del Juego:</label>
                    <input type="date" class="form-control" id="fecha_juego" name="fecha_juego" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="resultado_visitante" class="form-label">Resultado Visitante:</label>
                    <input type="number" class="form-control" id="resultado_visitante" name="resultado_visitante" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="resultado_home_club" class="form-label">Resultado Home Club:</label>
                    <input type="number" class="form-control" id="resultado_home_club" name="resultado_home_club" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="temporada" class="form-label">Temporada (Año):</label>
                    <input type="number" class="form-control" id="temporada" name="temporada" pattern="\d{4}"  min="2024" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Resultado</button>
        </form>
    </div>

     <!-- Contenido Secundario -->
     <div class="container mt-4">
        <h1>Equipos Agregados</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Visitante</th>
                    <th scope="col">Resultado Visitante</th>
                    <th scope="col">Home Club</th>
                    <th scope="col">Resultado Home Club</th>
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
