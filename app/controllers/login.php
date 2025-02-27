<?php

require_once "../models/conexionBD.php"; 

    if (empty($_POST["numero_control"]) and empty($_POST["password"])) {
            echo '<script>alert("Completa Los Campos");</script>';
        } else {
            
            $usuario = (int) $_POST["numero_control"];
            $clave=$_POST["password"];
            $sql=$conexion->query(" SELECT * FROM Usuario where numero_control = $usuario and password = '$clave';"); 
            
            if ($datos=$sql->fetch_object()) {
            header("Location: ../views/home.php");
            } else {
                echo '<script>alert("Acceso Denegado");</script>';

            }
    } 
?>

