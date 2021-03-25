<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');
require_once('../../models/validator-class.php');


$id = $_GET['id'];

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);
$employees = $employee->selectAnEmployee($id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container text-center pt-5">
        <h1 class="mb-4">Retiro de empleado </h1>
        <div class="row justify-content-center align-items-center">
            <div class="col-7">
                <div>
                    <form action="" method="POST" class="p-5 border rounded" id="form-delete-employee">
                        <?php if (count($employees) > 0) : ?>
                            <?php foreach ($employees as $employee) : ?>
                                <input type="hidden" name="id" value="<?php echo $employee["id"]; ?>" id="id">
                                <div class="form-row ">
                                    <div class="form-group col-md-6 text-left">
                                        <input type="text" class="form-control" name="firstname" placeholder="Nombres" value="<?php echo $employee["first_name"]; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6 text-left">
                                        <input type="text" class="form-control" name="lastname" placeholder="Apellidos" value="<?php echo $employee["last_name"]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <input type="text" class="form-control" name="cc" placeholder="C.C" value="<?php echo $employee["cc"]; ?>" readonly>
                                </div>
                                <div class="form-group text-left">
                                    <label for="enddate">Fecha de retiro </label><span class="error" id="errorEndDate"> </span>
                                    <input type="date" class="form-control" name="enddate" id="enddate" value="">
                                </div>
                                <div class="form-group text-left">
                                    <label class="" for="reasondismissal">Motivo de retiro</label><span class="error" id="errorReasonDismissal"> </span>
                                    <select class="custom-select mr-sm-2" id="reasondismissal" name="reasondismissal">
                                        <option value="">Selecciona...</option>
                                        <option value="terminacion de contrato">Terminacion de contrato</option>
                                        <option value="renuncia">Renuncia</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../controllers/employees/delete-employee.js"></script>
</body>

</html>