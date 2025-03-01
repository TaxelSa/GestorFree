<?php

require_once '../models/proyectomodel.php';

class ProyectosController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para obtener todos los proyectos
    public function obtenerProyectos() {
        try {
            $stmt = $this->pdo->query("SELECT p.id_proyecto, p.nombre_proyecto, p.descripcion, p.fecha_entrega, p.id_estado, u.numero_control, u.nombre, u.apellido FROM proyecto p JOIN usuario u ON p.id_usuario = u.numero_control");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener los proyectos: " . $e->getMessage());
        }
    }

    public function obtenerAlumno() {
        try {
            $stmt = $this->pdo->query("SELECT numero_control, nombre, apellido FROM usuario");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener los proyectos: " . $e->getMessage());
        }
    }

   
}