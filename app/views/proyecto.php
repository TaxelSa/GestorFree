<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos - Dashboard</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
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
        #tabs {
            margin-top: 20px;
        }
        .ui-tabs-nav {
            background: #F4F5F7;
            padding: 10px;
            border-radius: 5px;
        }
        .ui-tabs-nav li {
            display: inline;
            margin-right: 10px;
        }
        .ui-tabs-nav a {
            text-decoration: none;
            padding: 8px 12px;
            background: #DFE1E6;
            border-radius: 5px;
        }
        .ui-tabs-nav a:hover {
            background: #C1C7D0;
        }
    </style>
    <script>
        $(function() {
            $("#tabs").tabs();
        });
        $(document).ready(function() {
            $("#themeToggle").click(function() {
                $("body").toggleClass("dark-mode");
                $("#themeToggle").text($("body").hasClass("dark-mode") ? '🌙' : '☀️');
            });
        
            $("#tabs").tabs({
            activate: function(event, ui) {
                var tabId = ui.newPanel.attr("id"); // Obtiene el ID del tab activo
                var pageMap = {
                    
                    "tabs-2": "cronograma.php",
                    "tabs-3": "tablero.php",
                    "tabs-4": "creaTarea.php",
                    "tabs-5": "configuracionTareas.php"
                };
                $("#" + tabId).load(pageMap[tabId]); // Carga el contenido en el div correspondiente
            }
        });   
        });
    </script>
</head>
<body>
    <button class="toggle-btn" id="themeToggle">☀️</button>
    <div class="sidebar">
        <a href="#">Tu trabajo</a>
        <a href="home.php">Proyectos</a>
        <a href="#">Equipos</a>
    </div>
    <div class="main-content">
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Resumen</a></li>
                <li><a href="#tabs-4">Crea Tarea</a></li>
                <li><a href="#tabs-2">Cronograma</a></li>
                <li><a href="#tabs-3">Tablero</a></li>
                <li><a href="#tabs-5">Configuración</a></li>
            </ul>
            <div id="tabs-1">
                <p>Aquí va el resumen del proyecto.</p>
            </div>
            <div id="tabs-2">
                <p>Sección de cronograma con actividades planificadas.</p>
            </div>
            <div id="tabs-3">
                <p>Tablero con tareas y estados.</p>
            </div>
            <div id="tabs-4">
                <p>Informes y métricas del proyecto.</p>
            </div>
            <div id="tabs-5">
                <p>Configuración de preferencias y usuarios.</p>
            </div>
        </div>
    </div>
</body>
</html>
