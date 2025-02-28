<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            margin: 0;
        }
        .container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        h2 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 0.9rem;
            margin-bottom: 5px;
            text-align: left;
        }
        input {
            padding: 8px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }
        button {
            background: #EFB036;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">

        <img src="/GestorFree/app/img/ito-logo.jpg" alt="Logo-ITO" class="logo" class="logo">
        
        <h2>Iniciar Sesión</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        
        <form action="/GestorFree/app/controllers/login.php" method="POST">
            <label for="numero_control">Número de Control:</label>
            <input type="text" name="numero_control" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
