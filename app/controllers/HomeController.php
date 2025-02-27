<?php
// app/controllers/HomeController.php

class HomeController {
    public function index() {
        // Lógica para la página de inicio
        require_once 'app/views/login.php';
    }

    public function about() {
        // Lógica para la página "Acerca de"
        echo "Página Acerca de";
    }
}