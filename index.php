<?php
// public/index.php

require_once 'app/controllers/HomeController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = new HomeController();

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "404 - Página no encontrada";
}