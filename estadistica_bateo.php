<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirige al formulario de inicio de sesión si no hay sesión
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Estadísticas de Bateo</title>
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
        <h1>Agregar Estadísticas de Bateo</h1>
        <form action="procesar_estadisticas_bateador.php" method="POST">
            <!-- Selección del Jugador -->
            <div class="mb-3">
                <label for="id_jugador" class="form-label">Jugador:</label>
                <select class="form-select" id="id_jugador" name="id_jugador" required>
                    <?php
                    // Conectar a la base de datos
                    include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración
                    $sql = "SELECT id, nombre FROM jugadores";
                    $result = $mysqli->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Campos de Estadísticas de Bateo -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="ab" class="form-label">Turnos al bate (AB):</label>
                    <input type="number" class="form-control" id="ab" name="ab" required>
                </div>
                <div class="col-md-4">
                    <label for="hr" class="form-label">Jonrones (HR):</label>
                    <input type="number" class="form-control" id="hr" name="hr" required>
                </div>
                <div class="col-md-4">
                    <label for="bb" class="form-label">Bases por bolas (BB):</label>
                    <input type="number" class="form-control" id="bb" name="bb" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="rbi" class="form-label">Carreras empujadas (RBI):</label>
                    <input type="number" class="form-control" id="rbi" name="rbi" required>
                </div>
                <div class="col-md-4">
                    <label for="r" class="form-label">Carreras (R):</label>
                    <input type="number" class="form-control" id="r" name="r" required>
                </div>
                <div class="col-md-4">
                    <label for="so" class="form-label">Ponches (SO):</label>
                    <input type="number" class="form-control" id="so" name="so" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="h" class="form-label">Hits (H):</label>
                    <input type="number" class="form-control" id="h" name="h" required>
                </div>
                <div class="col-md-4">
                    <label for="dobles" class="form-label">Dobles (2B):</label>
                    <input type="number" class="form-control" id="dobles" name="dobles" required>
                </div>
                <div class="col-md-4">
                    <label for="triples" class="form-label">Triples (3B):</label>
                    <input type="number" class="form-control" id="triples" name="triples" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="hbp" class="form-label">Golpeado (HBP):</label>
                    <input type="number" class="form-control" id="hbp" name="hbp" required>
                </div>
                <div class="col-md-4">
                    <label for="sb" class="form-label">Bases robadas (SB):</label>
                    <input type="number" class="form-control" id="sb" name="sb" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Estadísticas</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
