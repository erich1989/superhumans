<nav class="navbar navbar-expand-lg navbar-light bg-primary flex-column" style="height: 100%;">
    <div class="mb-4 mt-3">
        <a class="navbar-brand" href="#"><img src="../../src/images/logo_sh_blue.png" alt="" style="width: 120px;"></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-center align-items-start w-100" id="navbarColor02">

        <div class="accordion w-100" id="accordionExample">

            <!-- tasks -->
            <div class="card">
                <div class="card-header" id="headingTask">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTask" aria-expanded="true" aria-controls="collapseOne">
                            Planificador
                        </button>
                    </h2>
                </div>

                <div id="collapseTask" class="collapse show" aria-labelledby="headingTask" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="navbar-nav mr-auto flex-column">
                            <li class="nav-item active">
                                <a class="nav-link" href="../tasks/tasks.php">Tareas diarias
                                    <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../tasks/day.php">Tareas diarias</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- employees -->
            <div class="card">
                <div class="card-header" id="headingEmployee">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseEmployees" aria-expanded="false" aria-controls="collapseTwo">
                            Empleados
                        </button>
                    </h2>
                </div>

                <div id="collapseEmployees" class="collapse" aria-labelledby="headingEmployee" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="navbar-nav mr-auto flex-column">
                            <li class="nav-item active">
                                <a class="nav-link" href="../employees/active-employees.php">Activos <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../employees/disables-employees.php">Retiros</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseThree">
                            Capacitaciones
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit,
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseFour">
                            Collapsible
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit,
                    </div>
                </div>
            </div>

        </div>

    </div>
</nav>