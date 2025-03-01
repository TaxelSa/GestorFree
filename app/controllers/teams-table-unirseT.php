<?php
require_once "../models/conexionBD.php"; // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $codigo_equipo = $_POST['codigo_equipo'];
    $numero_control = $_POST['numero_control'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO integrante_equipo (numero_control, codigo_equipo) VALUES (?, ?)";
    
    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param("ss", $numero_control, $codigo_equipo);
    
    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Redirigir al usuario a la página de gestión de equipos
        header("Location: ../views/teams.php?success=2"); // Puedes agregar un parámetro para mostrar un mensaje de éxito
        exit();
    } else {
        // Redirigir con un mensaje de error
        header("Location: ../views/teams.php?error=3");
        exit();
    }
    
    // Cerrar la sentencia
    $stmt->close();
} else {
    // Redirigir si el método no es POST
    header("Location: ../views/teams.php?error=4");
    exit();
}

// Cerrar la conexión
$conexion->close();
?>