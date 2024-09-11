<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-signin img {
            margin-bottom: 15px;
            width: 72px;
            height: 72px;
        }
        .form-signin h1 {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: normal;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            margin-bottom: 10px;
        }
        .form-signin button {
            width: 100%;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <main class="form-signin text-center">
        <form action="procesar_login.php" method="POST">
            <!-- Logo -->
            <img class="mb-4" src="img/logo.png" alt="Bootstrap Logo">

            <!-- Título del formulario -->
            <h1 class="h3 mb-3 fw-normal">Inicio de Sesion</h1>

            <!-- Campos del formulario -->
            <div class="form-floating">
                <input type="texto" class="form-control" id="username" name="username" placeholder="usuario" required>
                <label for="username">Usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Contraseña</label>
            </div>

            <!-- Recordarme -->
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recuerdame
                </label>
            </div>

            <!-- Botón de envío -->
            <button class="btn btn-primary" type="submit">Iniciar Sesion</button>

            <!-- Pie de página -->
            <div class="footer">
                <p class="mt-5 mb-3 text-muted">&copy; 2024 Creado por Roger</p>
            </div>
        </form>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
