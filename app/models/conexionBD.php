<?php
    /*$enlace = mysqli_connect("localhost", "root", "", "gp_base");

    if(!$enlace){
        die("no se realizo la concexion exitosamente" . mysqli_error());
    }

    echo "Conexion Exitosa";
    mysqli_close($enlace); */

    $conexion = new mysqli("localhost", "root", "", "gp_base");
    $conexion -> set_charset("utf8");
?> 