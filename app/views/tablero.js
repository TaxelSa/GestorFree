$(document).ready(function() {
    function createKanbanBoard() {
      const kanbanData = {
        "POR HACER": [
          { id: "HU-04", title: "Intercambio Libros", scrum: "SCRUM-23", users: 2 },
          { id: "HU-07", title: "Administración Usuarios y Cuentas", scrum: "SCRUM-25", users: 3, description: "Crear la GUI de Administración Usuarios y Libros", subtasks: [{ checked: true, text: "SCRUM-37" }] },
          { id: "HU-05", title: "Leer Reseñas", scrum: "SCRUM-22", users: 2 },
          { id: "HU-06", title: "Reseña y Valoración", scrum: "SCRUM-24", users: 3 },
          { id: "HU-10", title: "Emergencia de Lectura", scrum: "SCRUM-27", users: 1 },
          { id: "HU-09", title: "Recuperar Contraseña", scrum: "SCRUM-26", users: 2 }
        ],
        "EN CURSO": [
          { id: "HU-08", title: "Acceso a Lectura Digital", scrum: "SCRUM-26", users: 5 }
        ],
        "REVIEW": [
          { id: "Backend para Lectura Digital", scrum: "SCRUM-41", users: 1 },
          { id: "Creacion de gui para Lectura Digital", scrum: "SCRUM-40", users: 1 }
        ],
        "TERMINADO": [
          { id: "Crear backend para 'Agregar Libros'", scrum: "SCRUM-39", users: 1 },
          { id: "HU-03", title: "Agregar Libros", scrum: "SCRUM-21", users: 3, subtasks: [{ checked: true, text: "SERUM-30" }] },
          { id: "Crear la GUI para 'Agregar Libros'", scrum: "SCRUM-38", users: 1 }
        ]
      };
  
      const $tab3 = $("#tabs-3");
      $tab3.empty(); // Limpiar el contenido anterior
  
      const $kanbanBoard = $("<div class='kanban-board' style='display: flex; justify-content: space-around; padding: 20px;'></div>");
      $tab3.append($kanbanBoard);
  
      for (const status in kanbanData) {
        const $column = $("<div class='kanban-column' style='border: 1px solid #ccc; padding: 10px; min-width: 200px; margin: 10px;'></div>");
        $column.append(`<h3>${status} ${kanbanData[status].length}</h3>`);
  
        kanbanData[status].forEach(task => {
          const $task = $("<div class='kanban-task' style='border: 1px solid #ddd; padding: 10px; margin-bottom: 5px;'></div>");
          $task.append(`<p><strong>${task.id} ${task.title}</strong></p>`);
          $task.append(`<p>${task.scrum}</p>`);
          if (task.description) {
            $task.append(`<p>${task.description}</p>`);
          }
          if (task.subtasks) {
            task.subtasks.forEach(subtask => {
              $task.append(`<p><input type='checkbox' ${subtask.checked ? 'checked' : ''}> ${subtask.text}</p>`);
            });
          }
          $task.append(`<p>Usuarios: ${task.users}</p>`);
          $column.append($task);
        });
        $kanbanBoard.append($column);
      }
    }
  
    // Llama a la función para crear el tablero Kanban
    createKanbanBoard();
  });