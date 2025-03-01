<?php
require_once "../models/conexionBD.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $codigo_equipo = $_POST['codigo_equipo'];
    $nombre_equipo = $_POST['nombre_equipo'];
    $descripcion = $_POST['descripcion'];
    $numero_control = $_POST['numero_control'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO equipo (codigo_equipo, nombre_equipo, descripcion, numero_control) VALUES (?, ?, ?, ?)";
    
    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param("ssss", $codigo_equipo, $nombre_equipo, $descripcion, $numero_control);
    
    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Redirigir al usuario a la página de gestión de equipos
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