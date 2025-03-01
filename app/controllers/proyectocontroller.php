<?php
// Archivo: controllers/ProyectosController.php

require_once '../models/proyectomodel.php';

class ProyectosController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para obtener todos los proyectos
    public function obtenerProyectos() {
        try {
            $stmt = $this->pdo->query("SELECT nombre_proyecto, descripcion FROM proyecto");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener los proyectos: " . $e->getMessage());
        }
    }
}
