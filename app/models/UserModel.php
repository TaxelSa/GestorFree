<?php
// app/models/UserModel.php

class UserModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=gp_base', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getUserByNumeroControl($numero_control) {
        $stmt = $this->db->prepare("SELECT numero_control, password, nombre, apellido FROM Usuario WHERE numero_control = :numero_control");
        $stmt->bindParam(':numero_control', $numero_control, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

