<?php
// Incluir el archivo que realiza la consulta a la base de datos
require_once "../controllers/teams-table.php";

// Mostrar mensajes de éxito o error
$message = '';
$messageType = '';
if (isset($_GET['success'])) {
    $messageType = 'success';
    $message = match ($_GET['success']) {
        1 => "Equipo creado exitosamente.",
        2 => "Te has unido al equipo exitosamente.",
        default => "Operación exitosa."
    };
} elseif (isset($_GET['error'])) {
    $messageType = 'error';
    $message = match ($_GET['error']) {
        1 => "Error al crear el equipo.",
        2 => "Método de solicitud no válido.",
        3 => "Error al unirse al equipo.",
        4 => "Método de solicitud no válido.",
        default => "Ha ocurrido un error."
    };
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Equipos - Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow-x: hidden;
            transition: background 0.3s, color 0.3s;
        }
        .dark-mode {
            background: #2e2e2e;
            color: white;
        }
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 100px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .toggle-btn:hover {
            transform: scale(1.2);
        }
        .sidebar {
            width: 250px;
            background-color: #F4F5F7;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #172B4D;
            text-decoration: none;
            padding: 10px 0;
        }

        .sidebar a:hover {
            background-color: #DFE1E6;
            border-radius: 5px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .teams-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .teams-table th, .teams-table td {
            text-align: left;
            padding: 12px;
        }

        .teams-table th {
            background-color: #EBECF0;
        }

        .teams-table tr:nth-child(even) {
            background-color: #FAFBFC;
        }

        .btn-create {
            background-color: #EFB036;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-create:hover {
            background-color: #0747A6;
        }

        .toggle-menu {
            cursor: pointer;
            padding: 10px;
            background-color: #EFB036;
            color: white;
            border: none;
            border-radius: 5px;
            position: absolute;
            top: 10;
            left: 20px;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: absolute;
                height: 100vh;
            }

            .main-content {
                margin-left: 0;
            }

            #menu-toggle:checked ~ .sidebar {
                transform: translateX(0);
            }

            #menu-toggle:checked ~ .main-content {
                margin-left: 250px;
            }
        }

        @media (min-width: 769px) {
            .sidebar.collapsed {
                transform: translateX(-250px);
            }

            .main-content.shifted {
                margin-left: 0;
            }
        }

        /* Estilos para los modales */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal:target {
            display: block;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button[type="submit"]:hover {
            background-color: #218838;
        }

        /* Estilos para los mensajes */
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            animation: slideIn 0.5s ease-out;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        .close-btn {
            margin-left: 15px;
            color: inherit;
            font-weight: bold;
            float: right;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <input type="checkbox" id="menu-toggle" style="display:none;">
    <label for="menu-toggle" class="toggle-menu">☰ Menú</label>
    <div class="sidebar">
        <br>
        <a href="#">Tu trabajo</a>
        <a href="proyecto.php">Proyectos</a>
        <a href="teams.php">Equipos</a>
    </div>
    <button id="themeToggle" class="toggle-btn">☀️</button>

    <!-- Contenedor para mensajes -->
    <?php if (!empty($message)): ?>
        <div class="message <?php echo $messageType; ?>">
            <span><?php echo $message; ?></span>
            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    <?php endif; ?>

    <div class="main-content">
        <div class="header">
            <h1>Gestión de Equipos</h1>
            <a href="#formCrear" class="btn-create">Crear un Equipo</a>
            <a href="#formUnirse" class="btn-create">Unirse a un Equipo</a>
        </div>

        <!-- Formulario para crear equipo -->
        <div id="formCrear" class="modal">
            <div class="modal-content">
                <a href="#" class="close">&times;</a>
                <h2>Equipo Nuevo</h2>
                <form id="crearform" action="/GestorFree/app/controllers/teams-table-insert.php" method="POST">
                    <label for="codigo_equipo">Codigo del Equipo:</label>
                    <input type="text" id="codigo_equipo" name="codigo_equipo" required><br><br>

                    <label for="nombre_equipo">Nombre del Equipo:</label>
                    <input type="text" id="nombre_equipo" name="nombre_equipo" required><br><br>
                    
                    <label for="descripcion">Describe a el Equipo:</label>
                    <input type="text" id="descripcion" name="descripcion" required><br><br>

                    <label for="numero_control">Ingresa tu numero de Control</label>
                    <input type="text" id="numero_control" name="numero_control" required><br><br>

                    <button type="submit">Crear Equipo</button>
                </form>
            </div>
        </div>

        <!-- Formulario para unirse a un equipo -->
        <div id="formUnirse" class="modal">
            <div class="modal-content">
                <a href="#" class="close">&times;</a>
                <h2>Unirse a un Equipo</h2>
                <form id="unirseform" action="/GestorFree/app/controllers/teams-table-unirseT.php" method="POST">
                    <label for="codigo_equipo">Ingresa El Codigo del Equipo:</label>
                    <input type="text" id="codigo_equipo" name="codigo_equipo" required><br><br>
                    
                    <label for="numero_control">Ingresa tu numero de Control</label>
                    <input type="text" id="numero_control" name="numero_control" required><br><br>

                    <button type="submit">Unirse Equipo</button>
                </form>
            </div>
        </div>

        <!-- Tabla de equipos existentes -->
        <h2>Equipos Existentes</h2>
        <table id="teamsTable" class="teams-table">
            <thead>
                <tr>
                    <th>Codigo Equipo</th>
                    <th>Nombre Del Equipo</th>
                    <th>Descripcion</th>
                    <th>Numero Control Lider</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($equipos)): ?>
                    <?php foreach ($equipos as $equipo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($equipo['codigo_equipo']); ?></td>
                            <td><?php echo htmlspecialchars($equipo['nombre_equipo']); ?></td>
                            <td><?php echo htmlspecialchars($equipo['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($equipo['numero_control']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay equipos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Ocultar el mensaje después de 5 segundos
        setTimeout(() => {
            const message = document.querySelector('.message');
            if (message) {
                message.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>