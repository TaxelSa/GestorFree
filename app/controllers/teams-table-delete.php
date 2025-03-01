<?php
require_once "../models/conexionBD.php"; // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger el código del equipo a eliminar
    $codigo_equipo = $_POST['codigo_equipo'];

    // Preparar la consulta SQL
    $sql = "DELETE FROM Equipo WHERE codigo_equipo = ?";
    
    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);
    
    // Vincular el parámetro
    $stmt->bind_param("s", $codigo_equipo);
    
    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Redirigir al usuario a la página de gestión de equipos con un mensaje de éxito
        header("Location: ../views/teams.php?success=1"); // Puedes agregar un parámetro para mostrar un mensaje de éxito
        exit();
    } else {
        // Redirigir con un mensaje de error
        header("Location: ../views/teams.php?error=1");
        exit();
    }
    
    // Cerrar la sentencia
    $stmt->close();
} else {
    // Redirigir si el método no es POST
    header("Location: ../views/teams.php?error=2");
    exit();
}

// Cerrar la conexión
$conexion->close();
?>