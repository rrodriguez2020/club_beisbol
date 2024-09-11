<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Calendario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .calendar-table th, .calendar-table td {
            text-align: center;
            vertical-align: middle;
        }
        .calendar-table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
// Barra de Navegacion
include 'nav.php'; 
?>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1>Calendario Copa Ciudad de Buenos Aires 2024</h1>
        
        <table class="table table-bordered calendar-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Equipos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fecha 1</td>
                    <td>MEDIAS VERDES vs BLACK SOX<br>
                        EXCURSIONISTAS vs VELEZ<br>
                        TIBURONES vs LA PLATA<br>
                        LANUS vs DAOM
                    </td>
                </tr>
                <tr>
                    <td>Fecha 2</td>
                    <td>VELEZ vs MEDIAS VERDES<br>
                        LA PLATA vs BLACK SOX<br>
                        DAOM vs TIBURONES<br>
                        EXCURSIONISTAS vs LANUS
                    </td>
                </tr>
                <tr>
                    <td>Fecha 3</td>
                    <td>DAOM vs VELEZ<br>
                        BLACK SOX vs EXCURSIONISTAS<br>
                        TIBURONES vs MEDIAS VERDES<br>
                        LANUS vs LA PLATA
                    </td>
                </tr>
                <tr>
                    <td>Fecha 4</td>
                    <td>VELEZ vs LA PLATA<br>
                        BLACK SOX vs DAOM<br>
                        TIBURONES vs LANUS<br>
                        MEDIAS VERDES vs EXCURSIONISTAS
                    </td>
                </tr>
                <tr>
                    <td>Fecha 5</td>
                    <td>VELEZ vs BLACK SOX<br>
                        EXCURSIONISTAS vs TIBURONES<br>
                        LANUS vs MEDIAS VERDES<br>
                        LA PLATA vs DAOM
                    </td>
                </tr>
                <tr>
                    <td>Fecha 6</td>
                    <td>TIBURONES vs VELEZ<br>
                        BLACK SOX vs LANUS<br>
                        DAOM vs MEDIAS VERDES<br>
                        LA PLATA vs EXCURSIONISTAS
                    </td>
                </tr>
                <tr>
                    <td>Fecha 7</td>
                    <td>VELEZ vs LANUS<br>
                        TIBURONES vs BLACK SOX<br>
                        EXCURSIONISTAS vs DAOM<br>
                        MEDIAS VERDES vs LA PLATA
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

