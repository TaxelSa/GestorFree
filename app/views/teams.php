<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proyectos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Gestión de Equipos</h1>

<button id="btnCrear">Crear un Equipo</button>
<button id="btnUniser">Unirse a un Equipo</button>

<div id="formCrear" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Equipo Nuevo</h2>
        <form id="crearform">
            <label for="nombre_equipo">Nombre del Equipo:</label>
            <input type="text" id="nombre_equipo" name="nombre_equipo" required><br><br>
            
            <label for="descripcion">Describe a el Equipo:</label>
            <input type="text" id="descripcion" name="descripcion" required><br><br>

            <label for="numero_control">Ingresa tu numero de Control</label>
            <input type="text" id="numero_control" name="numero_control" required><br><br>

            <button type="submit">Crear Equipo</button>
        </form>
    </div>
</div>

<div id="formUnirse" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Equipo Nuevo</h2>
        <form id="unirseform">
            <label for="codigo_equipo">Ingresa El Codigo del Equipo:</label>
            <input type="text" id="codigo_equipo" name="codigo_equipo" required><br><br>
            
            <label for="numero_control">Ingresa tu numero de Control</label>
            <input type="text" id="numero_control" name="numero_control" required><br><br>

            <button type="submit">Unirse Equipo</button>
        </form>
    </div>
</div>

<h2>Proyectos Existentes</h2>
<table id="projectsTable">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha de Entrega</th>
            <th>ID Usuario</th>
            <th>Estado</th>
            <th>Materia</th>
            <th>Equipo</th>
        </tr>
    </thead>
    <tbody>
        <!-- Los proyectos se añadirán aquí dinámicamente -->
    </tbody>
</table>

<script>
    //Variables para formulario de crear proyecto
    var modalCrear = document.getElementById("formCrear");
    var modalCrear = document.getElementById("formCrear");
    var btnCrear = document.getElementById("btnCrear");
    var spanCrear = document.getElementsByClassName("close")[0];
    var formCrear = document.getElementById("formCrear");
    
    //Variables para formulario de unirse proyecto
    var modalUnirse = document.getElementById("formUnirse");
    var modalUnirse = document.getElementById("formUnirse");
    var btnUnirse = document.getElementById("btnUniser");
    var spanUnirse = document.getElementsByClassName("close")[0];
    var formUnirse = document.getElementById("formUnirse");


    var tableBody = document.querySelector("#projectsTable tbody");

    btnCrear.onclick = function() {
        modalCrear.style.display = "block";
    }

    spanCrear.onclick = function() {
        modalCrear.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalCrear) {
            modalCrear.style.display = "none";
        }
    }

    formCrear.onsubmit = function(event) {
        event.preventDefault();
        var projectName = document.getElementById("projectName").value;
        var description = document.getElementById("description").value;
        var dueDate = document.getElementById("dueDate").value;
        

        var newRow = tableBody.insertRow();
        newRow.innerHTML = `
            <td>${nombre_equipo}</td>
            <td>${descripcion}</td>
            <td>${numero_control}</td>
            
        `;

        modal.style.display = "none";
        form.reset();
    }
</script>

</body>
</html>