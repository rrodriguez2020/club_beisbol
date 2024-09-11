<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $visitante = $_POST['visitante'];
    $home_club = $_POST['home_club'];
    $fecha_juego = $_POST['fecha_juego'];
    $resultado_visitante = $_POST['resultado_visitante'];
    $resultado_home_club = $_POST['resultado_home_club'];
    $temporada = $_POST['temporada'];

    // Inicializar valores de ganadores/perdedores
    $ganador_home_club = 0;
    $perdedor_home_club = 0;
    $ganador_visitante = 0;
    $perdedor_visitante = 0;
    $empate = 0;

    // Determinar los resultados de los equipos
    if ($resultado_home_club > $resultado_visitante) {
        // El equipo local ganó
        $ganador_home_club = $home_club; // ID del equipo local
        $perdedor_visitante = $visitante; // ID del equipo visitante
    } elseif ($resultado_home_club < $resultado_visitante) {
        // El equipo visitante ganó
        $ganador_visitante = $visitante; // ID del equipo visitante
        $perdedor_home_club = $home_club; // ID del equipo local
    } else {
        // En caso de empate
        $empate = 1;
    }

    // Insertar los datos del juego en la base de datos
    $sql = "INSERT INTO juegos (visitante, home_club, fecha_juego, resultado_visitante, resultado_home_club, temporada, 
            ganador_home_club, perdedor_home_club, ganador_visitante, perdedor_visitante, empate) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Enlazar parámetros
        $stmt->bind_param("iisssiiiiii", $visitante, $home_club, $fecha_juego, $resultado_visitante, $resultado_home_club, 
                          $temporada, $ganador_home_club, $perdedor_home_club, $ganador_visitante, $perdedor_visitante, $empate);

        // Ejecutar la consulta de inserción
        if ($stmt->execute()) {
            // Mensaje de éxito y redirección
            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Resultado Agregado</title>
                <script>
                    function redirigir() {
                        window.location.href = 'agregar_resultado.php'; // Cambia esto a la URL del formulario
                    }
                    setTimeout(redirigir, 2000); // Redirige después de 2 segundos
                </script>
            </head>
            <body>
                <h1>Resultado agregado exitosamente</h1>
            </body>
            </html>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración de inserción
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>
