
<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de ajustar este archivo según tu configuración

// Consultar los equipos
$sql = "SELECT id, nombre FROM equipos";
$result = $mysqli->query($sql);

// Consultar los resultados de los juegos con estadísticas de ganados 
$sql1 = "
SELECT 
    j.visitante AS equipo_id,  -- o e.id si quieres el nombre del equipo
    e.nombre AS equipo_nombre,
    SUM(j.ganador_visitante) AS ganados_visitante -- Suma los juegos ganados como visitante
FROM 
    juegos j
INNER JOIN 
    equipos e ON e.id = j.visitante
GROUP BY 
    j.visitante, e.nombre;  -- Asegúrate de agrupar por ambas columnas que estás seleccionando

";

$result1 = $mysqli->query($sql1);

// Consultar los resultados de los juegos con estadísticas de ganados home club
$sql2 = "
SELECT 
    j.home_club AS equipo_id,  -- o e.id si quieres el nombre del equipo
    e.nombre AS equipo_nombre,
    SUM(j.ganador_home_club) AS ganados_home_club -- Suma los juegos ganados como home_club
FROM 
    juegos j
INNER JOIN 
    equipos e ON e.id = j.home_club
GROUP BY 
    j.home_club, e.nombre;  -- Asegúrate de agrupar por ambas columnas que estás seleccionando

";

$result2 = $mysqli->query($sql2);


$sql = "SELECT 
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
     
$result = $mysqli->query($sql);



// Verificar la conexión
if (!$result1) {
    die("Error en la consulta: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posiciones de Equipos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/Logo.png" alt="Logo del Club" width="30" height="30" class="d-inline-block align-text-top">
                Club de Béisbol
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="equiposDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Equipos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="equiposDropdown">
                            <li><a class="dropdown-item" href="roster.php">Tiburones</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resultados.php">Resultados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Estadísticas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="equiposDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="equiposDropdown">
                            <li><a class="dropdown-item" href="agregar_jugador.php">Agregar Jugador</a></li>
                            <li><a class="dropdown-item" href="agregar_resultado.php">Agregar Resultado</a></li>
                            <li><a class="dropdown-item" href="agregar_equipo.php">Agregar Equipo</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Primario -->
    <div class="container mt-4">
        <h1>Posiciones de Equipos</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Equipo</th>
                    <th scope="col">Ganados Visitante</th>
                    <th scope="col">Ganados Home Club</th>
                    <th scope="col">Perdidos Home Club</th>
                    <th scope="col">Empatados</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result1->fetch_assoc()) : 
               
                   // echo var_dump($row);
                    //die (); 
                    ?>
              
                    
                <tr>
                    <td><?php echo htmlspecialchars($row['equipo_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['equipo_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['ganados_visitante']); ?></td>
                 
                </tr>
                <?php endwhile; ?>

                <?php while ($row1 = $result2->fetch_assoc()) : 
               
               // echo var_dump($row);
                //die (); 
                ?>
          
                
            <tr>
                <td><?php echo htmlspecialchars($row1['ganados_home_club']); ?></td>
             
            </tr>
            <?php endwhile; ?>
             
            </tbody>
        </table>
    </div>

     <!-- Contenido Secundario -->
     <div class="container mt-4">
        <h1>Resultados agregados</h1>
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
                <?php while ($row = $result->fetch_assoc()) : ?>
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
