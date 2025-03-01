<?php
require '../models/proyectomodel.php'; // Conexión a la base de datos

// Obtener tareas "Por hacer" ordenadas por fecha de entrega
$sql = "SELECT id_tarea, nombre_tarea, fecha_entrega FROM tarea WHERE id_estado = 1 ORDER BY fecha_entrega ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma de Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 50%;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 15px;
        }
        .tarea {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .tarea:last-child {
            border-bottom: none;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        a:hover {
            color: #0056b3;
        }
        .fecha {
            display: block;
            font-size: 0.9em;
            color: gray;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tareas Pendientes</h2>
    <?php if (!empty($tareas)): ?>
        <?php foreach ($tareas as $tarea): ?>
            <div class="tarea">
                <a href="tarea.php?id_tarea=<?= $tarea['id_tarea'] ?>">
                    <?= htmlspecialchars($tarea['nombre_tarea']) ?>
                </a>
                <span class="fecha">Fecha de entrega: <?= $tarea['fecha_entrega'] ?></span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay tareas pendientes.</p>
    <?php endif; ?>
</div>

</body>
</html>
