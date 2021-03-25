<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body onload="viewAllTasks()">
    <div class="container-fluid p-0 " id="container-primary">
        <div class="row" style="height: 100%;">

            <div class="col-2 pr-0">
                <?php require_once('../../src/components/navbar/navbar.php'); ?>
            </div>

            <div class="col-10 p-0">

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a href="#" class="navbar-brand">Tareas diarias</a>
                    <ul class="navbar-nav ml-auto ">
                        <form action="" class="form-inline my-2 my-lg-0">
                            <input type="search" name="" id="search" class="form-control mr-md-2" placeholder="search your tasks" onkeyup="searchTasks (this.value)">
                            <button type="submit" class="btn btn-success my-sm-0">Search</button>
                        </form>
                    </ul>
                </nav>

                <div class="container p-4">
                    <div class="row">

                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" id="task-form">
                                        <input type="hidden" id="task-id">
                                        <div class="form-group">
                                            <input type="text" id="name" placeholder="Task name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="" id="description" class="form-control" placeholder="Task Description"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block text-center">Save
                                            task</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 d-flex justify-content-center align-items-center flex-column p-4">
                            <table class="table table-hover table-sm text-center">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>NAME</td>
                                        <td>DESCRIPTION</td>
                                        <td>ACCIÓN</td>
                                    </tr>
                                </thead>
                                <tbody id="tasks" class="">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="../../controllers/tasks/tasks.js"></script>
    <script src="../../src/styles/js/style.js"></script>
    <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>