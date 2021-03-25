
let conteinerSearchTasks = document.getElementById('task-result');
let newTask = document.getElementById('task-form');
let str = document.getElementById('search');
let buttonsDelete = document.getElementsByClassName('task-delete');
let linkEditTask = document.getElementsByClassName('task-item');
let buttonSuccessfulTask = document.getElementsByClassName('button-success');
let successTaskRow = document.getElementsByClassName('row-task');


let edit = false;


function searchTasks (valueInput) {
    // let search = str.value;
    let classSuccess;
    if (valueInput) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                let tasks = JSON.parse(this.responseText)//convierte la respuesta que es un string a formaton JSON
                let template = '';
                
                if (tasks.length == 0) {
                    template = 'La tarea no existe';
                }

                tasks.forEach(task => {
                    if (task.state === 'completed') {
                        classSuccess = 'table-success';
                    } else {
                        classSuccess = '';
                    }
                   
                    template += `
                        <tr taskId = "${task.id}" class="${classSuccess}">
                            <td>${task.id}</td>
                            <td><a href="#" class="task-item">${task.name}</a></td>
                            <td>${task.description}</td>
                            <td >
                                <button class="btn btn-success button-success" name="success"><i class="fas fa-check"></i></button>
                                <button class="btn btn-danger task-delete" onclick=""><i class="far fa-trash-alt"></i></button>  
                            </td>
                        </tr>
                    `
                });

                document.getElementById('tasks').innerHTML = template;

                console.log(this.responseText);
                console.log(tasks);
            
            }
        };
        xmlhttp.open("GET", "../../server/tasks/task-search.php?q=" + valueInput, true);
        xmlhttp.send();

    }else{
        viewAllTasks();
    }

};

newTask.addEventListener('submit', function (e) {

    let name = document.getElementById('name').value;
    let description = document.getElementById('description').value;
    let id = document.getElementById('task-id').getAttribute('value');

    let url = '';
    let data = '';
    // let url = edit === false ? 'task-add.php' : 'task-edit.php';
    if (edit === false) {
        url = '../../server/tasks/task-add.php';
        data = `name=${name}&description=${description}`;

    } else {
        url = '../../server/tasks/task-edit.php';
        data = `name=${name}&description=${description}&id=${id}`;
    }
    console.log(url);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            console.log(this.responseText);
            viewAllTasks();
            // newTask.reset();
            window.location.assign("http://localhost/superhumans_mvc/views/tasks/tasks.php");

        }
    };
    xmlhttp.open("POST", `${url}`, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);

    e.preventDefault();
})


function viewAllTasks() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            let allTasks = JSON.parse(this.responseText);
            let template = '';
            let classSuccess = '';
            console.log(allTasks.length);

            allTasks.forEach(task => {
                console.log(task.state);
                if (task.state === 'completed') {
                    classSuccess = 'table-success';
                } else {
                    classSuccess = '';
                }

                template += `
                <tr taskId = "${task.id}" class="${classSuccess}">
                    <td>${task.id}</td>
                    <td><a href="#" class="task-item">${task.name}</a></td>
                    <td>${task.description}</td>
                    <td >
                        <button class="btn btn-success button-success" name="success"><i class="fas fa-check"></i></button>
                        <button class="btn btn-danger task-delete" onclick=""><i class="far fa-trash-alt"></i></button>  
                    </td>
                </tr>
                `;
            })
            document.getElementById('tasks').innerHTML = template;
            console.log(allTasks);
            taskDelete();
            editTask();
            successfulTask();
        }
    }
    xmlhttp.open('GET', '../../server/tasks/task-list.php', true);
    xmlhttp.send();

}


function taskDelete() {

    for (var i = 0; i < buttonsDelete.length; i++) {

        let elementID = buttonsDelete[i].parentElement.parentElement.getAttribute('taskId');
        buttonsDelete[i].addEventListener('click', function () {
            if (confirm('¡Está seguro de elimiar la tarea?')) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        viewAllTasks();
                    }
                }
                xmlhttp.open('POST', '../../server/tasks/task-delete.php', true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(`id=${elementID}`);
            }
        }
        )


    }

}

function editTask() {
    for (var i = 0; i < linkEditTask.length; i++) {
        let elementID = linkEditTask[i].parentElement.parentElement.getAttribute('taskId');
        linkEditTask[i].addEventListener('click', function () {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    edit = true;
                    const task = JSON.parse(this.responseText);
                    document.getElementById('name').setAttribute('value', `${task.name}`);
                    document.getElementById('description').innerHTML = task.description;
                    document.getElementById('task-id').setAttribute('value', `${task.id}`);
                    console.log(this.responseText);
                    console.log(elementID);
                }
            }
            xmlhttp.open('POST', '../../server/tasks/task-single.php', true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(`id=${elementID}`);
        }
        )
    }
}

function successfulTask() {

    for (var i = 0; i < buttonSuccessfulTask.length; i++) {
        let elementID = buttonSuccessfulTask[i].parentElement.parentElement.getAttribute('taskId');
        // let newClass = successTaskRow[i];
        buttonSuccessfulTask[i].addEventListener('click', function () {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    viewAllTasks();
                }
            }
            xmlhttp.open('POST', '../../server/tasks/task-edit-success.php', true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(`id=${elementID}`);

        })
    }

}



