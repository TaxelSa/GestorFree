<?php
// Incluir la conexión PDO
require_once '../models/proyectomodel.php';

// Definir los estados de las tareas
$estados = [
    1 => 'Por hacer',
    2 => 'En curso',
    3 => 'En revisión',
    4 => 'Terminado'
];

// Asegúrate de que el formulario esté enviando los datos a este archivo.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_tarea'])) {
    // Imprime los datos recibidos
    var_dump($_POST); // Esto imprimirá todos los datos recibidos por el formulario

    // Recibe los valores del formulario
    $id_tarea = $_POST['id_tarea'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $hora_entrega = $_POST['hora_entrega'];
    $estado = $_POST['estado'];

    // Realiza una validación simple
    if(empty($nombre) || empty($descripcion) || empty($fecha_entrega) || empty($hora_entrega) || empty($estado)) {
        echo "Por favor, completa todos los campos.";
    }

    // Si los datos son correctos, actualizamos en la base de datos
    if(!empty($nombre) && !empty($descripcion) && !empty($fecha_entrega) && !empty($hora_entrega) && !empty($estado)) {
        try {
            $sql = "UPDATE tarea SET nombre_tarea = ?, descripcion = ?, fecha_entrega = ?, hora_entrega = ?, id_estado = ? WHERE id_tarea = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nombre, $descripcion, $fecha_entrega, $hora_entrega, $estado, $id_tarea]);

            echo "Tarea actualizada con éxito.";
            // Redirigir a proyecto.php
            header("Location: proyecto.php");
            exit();
        } catch (PDOException $e) {
            echo "Error al actualizar la tarea: " . $e->getMessage();
        }
    }
}


// Procesar la eliminación de tareas
if (isset($_GET['eliminar'])) {
    $id_tarea = $_GET['eliminar'];

    $sql = "DELETE FROM tarea WHERE id_tarea = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_tarea]);

    // Redirigir a proyecto.php
    header("Location: proyecto.php");
    exit();
}

// Obtener todas las tareas para mostrarlas en la tabla
$sql = "SELECT id_tarea, nombre_tarea, descripcion, fecha_entrega, hora_entrega, id_estado FROM tarea";
$stmt = $pdo->query($sql);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
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

<h2>Lista de Tareas</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha de Entrega</th>
            <th>Hora de Entrega</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tareas as $tarea): ?>
            <tr>
                <td><?php echo $tarea['id_tarea']; ?></td>
                <td><?php echo $tarea['nombre_tarea']; ?></td>
                <td><?php echo $tarea['descripcion']; ?></td>
                <td><?php echo $tarea['fecha_entrega']; ?></td>
                <td><?php echo $tarea['hora_entrega']; ?></td>
                <td><?php echo $estados[$tarea['id_estado']]; ?></td>
                <td>
                    <button onclick="editarTarea(<?php echo $tarea['id_tarea']; ?>, '<?php echo $tarea['nombre_tarea']; ?>', '<?php echo $tarea['descripcion']; ?>', '<?php echo $tarea['fecha_entrega']; ?>', '<?php echo $tarea['hora_entrega']; ?>', <?php echo $tarea['id_estado']; ?>)">Editar</button>
                    <a href="configuracionTareas.php?eliminar=<?php echo $tarea['id_tarea']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="editarFormulario" style="display:none;">
    <h2>Editar Tarea</h2>
    <form method="POST" onsubmit="return confirmarDatos()">
    <input type="hidden" id="editar_id_tarea" name="id_tarea">
    <label for="editar_nombre">Nombre de la Tarea:</label><br>
    <input type="text" id="editar_nombre" name="nombre" required><br><br>

    <label for="editar_descripcion">Descripción:</label><br>
    <textarea id="editar_descripcion" name="descripcion" required></textarea><br><br>

    <label for="editar_fecha_entrega">Fecha de Entrega:</label><br>
    <input type="date" id="editar_fecha_entrega" name="fecha_entrega" required><br><br>

    <label for="editar_hora_entrega">Hora de Entrega:</label><br>
    <input type="time" id="editar_hora_entrega" name="hora_entrega" required><br><br>

    <label for="editar_estado">Estado:</label><br>
    <select id="editar_estado" name="estado">
        <?php foreach ($estados as $id => $nombre): ?>
            <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit" name="editar_tarea">Guardar Cambios</button>
</form>
</div>

<script>
    function editarTarea(id, nombre, descripcion, fecha, hora, estado) {
        document.getElementById('editar_id_tarea').value = id;
        document.getElementById('editar_nombre').value = nombre;
        document.getElementById('editar_descripcion').value = descripcion;
        document.getElementById('editar_fecha_entrega').value = fecha;
        document.getElementById('editar_hora_entrega').value = hora;
        document.getElementById('editar_estado').value = estado;
        document.getElementById('editarFormulario').style.display = 'block';
    }
</script>
<script>
    // Esta función se llama cuando el formulario se envía
    function confirmarDatos() {
        // Obtener los valores de los campos del formulario
        var nombre = document.getElementById('editar_nombre').value;
        var descripcion = document.getElementById('editar_descripcion').value;
        var fecha_entrega = document.getElementById('editar_fecha_entrega').value;
        var hora_entrega = document.getElementById('editar_hora_entrega').value;
        var estado = document.getElementById('editar_estado').value;

        // Mostrar los valores en un alert para que el usuario los vea antes de guardar
        alert("¡Confirmar datos de la tarea!\n\n" +
            "Nombre: " + nombre + "\n" +
            "Descripción: " + descripcion + "\n" +
            "Fecha de entrega: " + fecha_entrega + "\n" +
            "Hora de entrega: " + hora_entrega + "\n" +
            "Estado: " + estado);
        
        // Si el usuario confirma, el formulario se envía, si no, no hace nada
        return true; // Aquí podrías agregar lógica para validar datos si fuera necesario
    }
</script>


</body>
</html>