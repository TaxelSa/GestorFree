<?php
// Incluir la conexión PDO
require_once '../models/proyectomodel.php';

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_tarea'])) {
    $id_tarea = $_POST['id_tarea'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $hora_entrega = $_POST['hora_entrega'];
    $estado = 1; // Estado por defecto: 1 (Por Hacer)

    $sql = "INSERT INTO tarea (id_tarea, nombre_tarea, descripcion, fecha_entrega, hora_entrega, id_estado, id_usuario, id_materia, id_proyecto) VALUES (?, ?, ?, ?, ?, ?, 21011062, 1, 30)"; // Asumiendo valores fijos para id_usuario, id_materia e id_proyecto
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_tarea, $nombre, $descripcion, $fecha_entrega, $hora_entrega, $estado]);

    // Redirigir para evitar reenvío del formulario al recargar la página
     header("Location: proyecto.php");
     exit();
}

// ... (Código para el tablero Kanban) ...
?>

<?php
// Incluir la conexión PDO
require_once '../models/proyectomodel.php';

// ... (Código para el tablero Kanban) ...
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kanban-board {
            display: flex;
            gap: 20px;
        }
        .kanban-column {
            width: 25%;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f4f4f4;
        }
        .kanban-card, form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
        form label, form input, form textarea {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Crear Nueva Tarea</h2>

<form action="creaTarea.php" method="POST">
    <label for="id_tarea">ID de la Tarea:</label><br>
    <input type="number" id="id_tarea" name="id_tarea" required><br><br>

    <label for="nombre">Nombre de la Tarea:</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="descripcion">Descripción:</label><br>
    <textarea id="descripcion" name="descripcion" required></textarea><br><br>

    <label for="fecha_entrega">Fecha de Entrega:</label><br>
    <input type="date" id="fecha_entrega" name="fecha_entrega" required><br><br>

    <label for="hora_entrega">Hora de Entrega:</label><br>
    <input type="time" id="hora_entrega" name="hora_entrega" required><br><br>

    <button type="submit" name="crear_tarea">Crear Tarea</button>
</form>

</body>
</html>