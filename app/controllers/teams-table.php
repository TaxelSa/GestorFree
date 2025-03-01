<?php
require_once "../models/conexionBD.php"; // Asegúrate de que la ruta sea correcta

// Realizar la consulta a la base de datos
$sql = $conexion->query("SELECT codigo_equipo, nombre_equipo, descripcion, numero_control FROM Equipo;");

// Verificar si hay resultados
if ($sql->num_rows > 0) {
    // Crear un array para almacenar los datos
    $equipos = [];
    while ($row = $sql->fetch_assoc()) {
        $equipos[] = $row;
    }
} else {
    $equipos = []; // Si no hay datos, inicializar un array vacío
}
?>