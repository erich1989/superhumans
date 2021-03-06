<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>

<body onload="selectRetiredEmployees()">
    <div class="container-fluid p-0" id="container-primary">
        <div class="row" style="height: 100%;">
            <div class="col-2 pr-0">
            <?php require_once('../../src/components/navbar/navbar.php'); ?>
            </div>
            <div class="col-10 p-3 table-responsive">
                <div class="row mb-5">
                    <div class="col-5">
                        <h1>Retiros</h1>
                    </div>
                    <div class="col-3 text-center">
                        <!-- <a href="newEmployee.php" class="btn btn-success mb-4"> <i class="fas fa-user-plus"></i> Nuevo empleado </a> -->
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center">
                        <form class=" w-75">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" id="value" onkeyup="searchRetiredEmployees(this.value)">
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <table class="table table-sm table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">C.C</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">??rea</th>
                                <th scope="col">T/contrato</th>
                                <th scope="col">F/ingreso</th>
                                <th scope="col">F/salida</th>
                                <th scope="col">M/salida</th>
                                <th scope="col">Acci??n</th>
                            </tr>
                        </thead>

                        <tbody id="bodytable">

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../../controllers/employees/disables-employees.js"></script>
    <script src="../../src/styles/js/style.js"></script>
    <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

    <!-- Bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>