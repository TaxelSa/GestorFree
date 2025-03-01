<?php
// Archivo: models/conexion.php

// Configuración de la conexión
$host = 'localhost';
$dbname = 'gp_base';
$user = 'root';
$password = '';

try {
    // Crear conexión con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}