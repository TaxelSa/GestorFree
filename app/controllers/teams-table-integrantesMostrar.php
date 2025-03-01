<?php
require_once "../models/conexionBD.php"; // Asegúrate de que la ruta sea correcta

// Verificar si se ha solicitado ver los integrantes de un equipo
$integrantes = [];
if (isset($_GET['codigo_equipo'])) {
    $codigoEquipo = $_GET['codigo_equipo'];

    // Preparar la consulta SQL
    $sql = "
        SELECT 
            integrante_equipo.codigo_equipo, 
            integrante_equipo.numero_control, 
            usuario.nombre, 
            usuario.apellido 
        FROM 
            integrante_equipo 
        INNER JOIN 
            usuario 
        ON 
            integrante_equipo.numero_control = usuario.numero_control
        WHERE integrante_equipo.codigo_equipo = ?
    ";

    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);
    if ($stmt) {
        // Vincular el parámetro
        $stmt->bind_param("s", $codigoEquipo);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $integrantes[] = $row;
            }
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
}

// Realizar la consulta a la base de datos para obtener los equipos
$sqlEquipos = $conexion->query("SELECT codigo_equipo, nombre_equipo, descripcion, numero_control FROM Equipo;");

// Verificar si hay resultados
if ($sqlEquipos->num_rows > 0) {
    // Crear un array para almacenar los datos
    $equipos = [];
    while ($row = $sqlEquipos->fetch_assoc()) {
        $equipos[] = $row;
    }
} else {
    $equipos = []; // Si no hay datos, inicializar un array vacío
}
?>