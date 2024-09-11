<?php
// Conexión a la base de datos
include 'conexion.php'; // Ajusta este archivo según tu configuración

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_jugador = $_POST['id_jugador'];
    $ab = $_POST['ab'];
    $hr = $_POST['hr'];
    $bb = $_POST['bb'];
    $rbi = $_POST['rbi'];
    $r = $_POST['r'];
    $so = $_POST['so'];
    $h = $_POST['h'];
    $dobles = $_POST['dobles'];
    $triples = $_POST['triples'];
    $hbp = $_POST['hbp'];
    $sb = $_POST['sb'];

    $avg = ($ab > 0) ? ($h / $ab) * 1000 : 0;

   //$avg = $h / $ab; // Aquí obtendrás el valor correcto, 0.500 en el ejemplo

    echo "avg:.$avg ";


    // Contar los juegos jugados (G)
    $g = 1; // Inicialmente 1 juego; ajustar esto si se necesita un cálculo diferente

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO estadistica_bateador (id_jugador, ab, hr, bb, rbi, r, so, h, dobles, triples, hbp, sb, avg, g) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Enlazar parámetros
        $stmt->bind_param("iiiiiiiiiiiiii", $id_jugador, $ab, $hr, $bb, $rbi, $r, $so, $h, $dobles, $triples, $hbp, $sb, $avg, $g);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Estadísticas Agregadas</title>
                <script>
                    function redirigir() {
                        window.location.href = 'estadistica_bateo.php'; // Cambia esto a la URL del formulario
                    }
                    setTimeout(redirigir, 2000); // Redirige después de 2 segundos
                </script>
            </head>
            <body>
                <h1>Estadísticas de bateo agregadas exitosamente</h1>
            </body>
            </html>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>
