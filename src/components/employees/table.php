<div class="row mb-5">
    <div class="col-5">
        <h1>Activos</h1>
    </div>
    <div class="col-3 text-center my-auto">
        <div>
            <a href="new-employee.php" class="btn btn-success"> <i class="fas fa-user-plus"></i> Nuevo empleado </a>
        </div>
    </div>
    <div class="col-4 d-flex justify-content-center align-items-center">
        <form class=" w-75">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" id="value" onkeyup="searchEmployees(this.value)">
        </form>
    </div>
</div>

<div class="d-flex justify-content-center align-items-center">
    <table class="table-sm table-hover table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">C.C</th>
                <th scope="col">Cargo</th>
                <th scope="col">Área</th>
                <th scope="col">T/contrato</th>
                <th scope="col">F/ingreso</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody id="bodytable">

        </tbody>
    </table>
</div>