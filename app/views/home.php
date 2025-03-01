
<?php
// Incluir el controlador y la conexión
require_once '../controllers/ProyectoController.php';
require_once '../models/proyectomodel.php';

// Crear una instancia del controlador
$proyectosController = new ProyectosController($pdo);

// Obtener los proyectos
$proyectos = $proyectosController->obtenerProyectos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos - Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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

        .project-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .project-table th, .project-table td {
            text-align: left;
            padding: 10px;
        }

        .project-table th {
            background-color: #EBECF0;
        }

        .project-table tr:nth-child(even) {
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
        /* Estilos para los modales */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 50;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 5px;
        }

        .modal:target {
            display: block;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 40px;
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

      
    </style>
</head>
<body>
    <button class="toggle-menu">☰ Menú</button>
    <div class="sidebar">
        <br>
        <a href="#">Tu trabajo</a>
        <a href="proyecto.php">Proyectos</a>
        <a href="teams.php">Equipos</a>
    </div>
    <button id="themeToggle" class="toggle-btn">☀️</button>
    <script>
        const button = document.getElementById('themeToggle');
        const body = document.body;

        button.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            button.textContent = body.classList.contains('dark-mode') ? '🌙' : '☀️';
        });
    </script>
    <div class="main-content">
        <div class="header">
            <h1>Proyectos</h1>
            <a href="#crea" class="btn-create">Crear proyecto</a>
            </div>

        <table class="project-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de entrega</th>
                    <th>Estado</th>
                    <th>Estudiante Propietario</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($proyectos) > 0): ?>
                <?php foreach ($proyectos as $proyecto): ?>
                    <tr>
                        <td><?= htmlspecialchars(string: $proyecto['id_proyecto']) ?></td>
                        <td><a href="proyecto.php"><?=($proyecto['nombre_proyecto']) ?></td>
                        <td><?= htmlspecialchars($proyecto['descripcion']) ?></a></td>
                        <td><?= htmlspecialchars($proyecto['fecha_entrega']) ?></td>
                        <td><?= htmlspecialchars($proyecto['id_estado']) ?></td>
                        <td><?= htmlspecialchars($proyecto['nombre'] . ' ' . $proyecto['apellido']) ?></td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay proyectos disponibles.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div id="crea" class="modal">
            <div class="modal-content">
                <a href="#" class="close">&times;</a>
                <h2>Nuevo proyecto</h2>
                <form id="crearform" action="/GestorFree/app/controllers/insertarProyecto.php" method="POST">
                    <label for="id_proyecto">ID del Proyecto:</label>
                    <input type="text" id="id_proyecto" name="id_proyecto" required><br><br>

                    <label for="nombre_proyecto">Nombre del Proyecto:</label>
                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" required><br><br>
                    
                    <label for="descripcion">Describe el Proyecto:</label>
                    <input type="text" id="descripcion" name="descripcion" required><br><br>

                    <label for="fecha_entrega">Ingresa fecha</label>
                    <input type="date" id="fecha_entrega" name="fecha_entrega" required><br><br>

                    <label for="id_usuario">Ingresa id usuario</label>
                    <input type="text" id="id_usuario" name="id_usuario" required><br><br>

                    <label for="id_estado">Ingresa id Estado</label>
                    <input type="text" id="id_estado" name="id_estado" required><br><br>

                    <label for="id_materia">Ingresa id materia</label>
                    <input type="text" id="id_materia" name="id_materia" required><br><br>

                    <label for="id_equipo">Ingresa id de equipo</label>
                    <input type="text" id="id_equipo" name="id_equipo" required><br><br>

                    <button type="submit">Crear Proyecto</button>
                </form>
            </div>
        </div>

</body>
</html>