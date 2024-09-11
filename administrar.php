<?php
session_start();

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
    <!-- Encabezado con Imagen -->
    <div class="text-center my-4">
        <img src="img/Logo.png" alt="Equipo Tiburones" class="img-fluid" style="max-height: 100px;">
    </div>
<?php
include 'nav.php';

?>

    <!-- Contenido principal -->
    <div class="container mt-4">
                <table class="table table-striped mt-4">
          <!-- Aquí va el contenido del panel de administración -->
             <h2>Bienvenido, <?php echo $_SESSION['username']; ?></h2>
             <p> Una vez iniciada la sesion de usuario vas a poder seleccionar desde del menu 
                 agregar diferentes datos 
             </p>
        </table>
    </div>
   

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
