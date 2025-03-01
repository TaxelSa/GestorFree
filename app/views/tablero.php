<?php
// Incluir la conexión PDO
require_once '../models/proyectomodel.php';

// Definir los estados del tablero Kanban
$estados = [
    1 => "Por Hacer",
    2 => "En Curso",
    3 => "En Revisión",
    4 => "Finalizado"
];

// Consultar las tareas desde la base de datos
$sql = "SELECT * FROM tarea";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organizar tareas por estado
$tablero = [];
foreach ($estados as $id => $nombre) {
    $tablero[$id] = [];
}

foreach ($tareas as $tarea) {
    $estado = $tarea['id_estado'];
    $tablero[$estado][] = $tarea;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero Kanban</title>
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
        .kanban-card {
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<h2>Tablero Kanban</h2>

<div class="kanban-board">
    <?php foreach ($estados as $id => $nombre): ?>
        <div class="kanban-column">
            <h3><?php echo $nombre; ?></h3>
            <?php if (empty($tablero[$id])): ?>
                <p>No hay tareas en esta etapa</p>
            <?php else: ?>
                <?php foreach ($tablero[$id] as $tarea): ?>
                    <div class="kanban-card">
                        <strong><?php echo htmlspecialchars($tarea['nombre_tarea']); ?></strong>
                        <p><?php echo htmlspecialchars($tarea['descripcion']); ?></p>
                        <small>Entrega: <?php echo $tarea['fecha_entrega'] . ' ' . $tarea['hora_entrega']; ?></small>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
