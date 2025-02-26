<?php
// app/models/UserModel.php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    }

    public function getUsers() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}