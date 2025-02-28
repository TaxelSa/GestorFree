
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
            padding: 12px;
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

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: absolute;
                height: 100vh;
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.active {
                transform: translateX(0);
            }
        }

        @media (min-width: 769px) {
            .sidebar.collapsed {
                transform: translateX(-250px);
            }

            .main-content.shifted {
                margin-left: 0;
            }


            .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
            margin: 100px auto;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        }
    </style>
</head>
<body>
    <button class="toggle-menu">☰ Menú</button>
    <div class="sidebar">
        <br>
        <a href="#">Tu trabajo</a>
        <a href="#">Proyectos</a>
        <a href="#">Equipos</a>
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
            <a href="#" class="btn-create" id="openModal">Crear proyecto</a>
            </div>

        <table class="project-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Tipo</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($proyectos) > 0): ?>
                <?php foreach ($proyectos as $proyecto): ?>
                    <tr>
                        <td><a href="proyecto.php"><?= htmlspecialchars($proyecto['nombre_proyecto']) ?></a></td>
                        <td><?= htmlspecialchars($proyecto['descripcion']) ?></td>
                        
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

    <!-- Modal de Registro de Proyecto -->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Registrar Nuevo Proyecto</h2>
            <form action="../controllers/ProyectoController.php" method="POST">
                <label for="nombre">Nombre del Proyecto:</label>
                <input type="text" name="nombre" id="nombre" required><br><br>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required></textarea><br><br>

                <label for="tipo">Tipo:</label>
                <input type="text" name="tipo" id="tipo" required><br><br>

                <label for="responsable">Responsable:</label>
                <input type="text" name="responsable" id="responsable" required><br><br>

                <button type="submit" name="registrar">Registrar Proyecto</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.toggle-menu').click(function() {
                $('.sidebar').toggleClass('active collapsed');
                $('.main-content').toggleClass('shifted');
            });
        });
    </script>

<script>
        // Lógica para abrir y cerrar el modal
        $(document).ready(function() {
            $('#openModal').click(function() {
                $('#projectModal').fadeIn();
            });

            $('#closeModal').click(function() {
                $('#projectModal').fadeOut();
            });

            $('.toggle-menu').click(function() {
                $('.sidebar').toggleClass('active');
            });
        });
    </script>

</body>
</html>