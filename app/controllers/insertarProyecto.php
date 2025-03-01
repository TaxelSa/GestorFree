<?php
require_once "../models/conexionBD.php"; 
// Procesar la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proyecto = $_POST['id_proyecto'] ?? '';
    $nombre = $_POST['nombre_proyecto'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha_entrega = $_POST['fecha_entrega'] ?? '';
    $id_usuario = $_POST['id_usuario'] ?? '';
    $id_estado = $_POST['id_estado'] ?? '';
    $id_materia = $_POST['id_materia'] ?? '';
    $id_equipo = $_POST['id_equipo'] ?? '';

    $sql = "INSERT INTO proyecto (id_proyecto, nombre_proyecto, descripcion, fecha_entrega, id_usuario,id_estado, id_materia, id_equipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    
    $stmt->bind_param("ssssiiii", $id_proyecto, $nombre, $descripcion, $fecha_entrega, $id_usuario , $id_estado, $id_materia, $id_equipo);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Redirigir al usuario a la página de gestión de equipos
        header("Location: ../views/home.php?success=1"); 
        exit();
    } else {
        // Redirigir con un mensaje de error
        header("Location: ../views/home.php?error=1");
        exit();
    }

    // Cerrar la sentencia
    $stmt->close();
} else {
    // Redirigir si el método no es POST
    header("Location: ../views/home.php?error=2");
    exit();
}

// Cerrar la conexión
$conexion->close();
?>
