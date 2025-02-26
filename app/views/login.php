<!-- app/views/home.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Gestor de Proyectos</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Gestor de Proyectos</h2>
            <form action="/controllers/login.php" method="POST">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>
