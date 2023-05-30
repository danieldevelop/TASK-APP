// Funcion anonima que se ejecuta cuando el documento esté listo
$(document).ready(function() {
    let edit = false; // Variable que nos indica si estamos editando o no
    $('#task-result').hide();
    fetchTasks();
    
    // Cuando el usuario presione una tecla
    $('#search').keyup(function() {
        if ($('#search').val()) {
            let search = $('#search').val().trim();

            $.ajax({
                url: 'task-search.php',
                type: 'POST',
                data: {
                    search
                },
                success: function(response) {
                    let tasks = JSON.parse(response); // Convertimos el JSON a un objeto de JS
                    let template = '';

                    tasks.forEach(task => {
                        const { name } = task;
                        template += `<li>
                            <td>${name}</td>
                        </li>`
                    });

                    $('#container').html(template);
                    $('#task-result').show();
                }
            });
        }
    });



    // Cuando el usuario envíe el formulario
    $('#task-form').submit(function(e) {
        e.preventDefault(); // Prevenimos que se recargue la página
        const postData = {
            name: $('#name').val().trim(),
            description: $('#description').val().trim(),
            id: $('#taskId').val() // input oculto (hidden) desde mi index.html
        };

        let url = edit === false ? 'task-add.php' : 'task-edit.php';

        $.post(url, postData, function(response) {
            $('#info').html(response);
            $('#task-form').trigger('reset'); // Reseteamos el formulario
            fetchTasks(); // Mostramos las tareas
        });
    });



    function fetchTasks(){
        // Mostramos las tareas al iniciar nuestra aplication
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            success: function(response) {
                let tasks = JSON.parse(response); // Convertimos el JSON a un objeto de JS
                let template = '';

                tasks.forEach(task => {
                    const { id, name, description } = task;
                    template += `<tr taskId="${id}">
                        <td>${id}</td>
                        <td><a href="#" class="task-item">${name}</a></td>
                        <td>${description}</td>
                        <td><button class="task-delete btn btn-danger btn-sm">Delete</button></td>
                    </tr>`
                });

                $('#tasks').html(template);
            }
        });
    };



    $(document).on('click', '.task-delete', function() {
        if (confirm('Are you sure you want to delete it?')) {
            let element = $(this)[0].parentElement.parentElement; // Obtenemos el elemento padre del elemento padre del elemento que se ha hecho click
            let id = $(element).attr('taskId'); // Obtenemos el atributo id del elemento

            $.post('task-delete.php', { id }, function(response) {
                $('#info').html(response);
                fetchTasks();
            });
        }
    });



    $(document).on('click', '.task-item', function() {
        let element = $(this)[0].parentElement.parentElement; // Obtenemos el elemento padre del elemento padre del elemento que se ha hecho click
        let id = $(element).attr('taskId'); // Obtenemos el atributo id del elemento

        $.post('task-single.php', { id }, function(response) {
            const task = JSON.parse(response);
            const { id, name, description } = task;
            
            $('#taskId').val(id);
            $('#name').val(name);
            $('#description').val(description);
            edit = true;
        });
    });

});