<?php
require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

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
</head>

<body>
    <div class="container pt-5 text-center">
        <h2 class="mb-4">Actualizar empleado</h2>
        <div class="row justify-content-center align-items-center">
            <div class="col-7">
                <div>
                    <form action="" method="POST" target="_self" class="p-5 border rounded" id="form-update-employee">
                        <?php if (count($employees) > 0) : ?>
                            <?php foreach ($employees as $employee) : ?>
                                <input type="hidden" name="id" value="<?php echo $employee["id"]; ?>" id="id">
                                <div class="form-row ">
                                    <div class="form-group col-md-6 text-left">
                                        <span class="error">
                                            <input type="text" class="form-control" name="firstname" placeholder="Nombres" value="<?php echo $employee["first_name"]; ?>" id="firstname">
                                    </div>
                                    <div class="form-group col-md-6 text-left">
                                        <input type="text" class="form-control" name="lastname" placeholder="Apellidos" value="<?php echo $employee["last_name"]; ?>" id='lastname'>
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <input type="text" class="form-control" name="cc" placeholder="C.C" value="<?php echo $employee["cc"]; ?>" id="cc">
                                </div>

                                <div class="form-group text-left">
                                    <label for="birthday">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" name="birthday" id="birthday" value="<?php echo $employee['birthday'] ?>">
                                </div>

                                <div class="form-row">
                                    <div class="form-group text-left col-md-6">
                                        <label class="" for="position">Cargo</label>
                                        <select class="custom-select mr-sm-2" id="position" name="position">
                                            <option value="">Elige...</option>
                                            <option value="cargo 1" <?php if ($employee['position'] == "cargo 1") echo "selected" ?>>Cargo 1 </option>
                                            <option value="cargo 2" <?php if ($employee['position'] == "cargo 2") echo "selected" ?>>Cargo 2</option>
                                            <option value="cargo 3" <?php if ($employee['position'] == "cargo 3") echo "selected" ?>>Cargo 3</option>
                                            <option value="cargo 4" <?php if ($employee['position'] == "cargo 4") echo "selected" ?>>Cargo 4</option>
                                            <option value="cargo 5" <?php if ($employee['position'] == "cargo 5") echo "selected" ?>>Cargo 5</option>
                                        </select>
                                    </div>

                                    <div class="form-group text-left col-md-6">
                                        <label class="" for="selectarea">Área</label>
                                        <select class="custom-select mr-sm-2" id="selectarea" name="area">
                                            <option value="">Elige...</option>
                                            <option value="area 1" <?php if ($employee['working_area'] == "area 1") echo "selected" ?>>área 1 </option>
                                            <option value="area 2" <?php if ($employee['working_area'] == "area 2") echo "selected" ?>>área 2</option>
                                            <option value="area 3" <?php if ($employee['working_area'] == "area 3") echo "selected" ?>>área 3</option>
                                            <option value="area 4" <?php if ($employee['working_area'] == "area 4") echo "selected" ?>>área 4</option>
                                            <option value="area 5" <?php if ($employee['working_area'] == "area 5") echo "selected" ?>>área 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <label class="" for="selectcontract">Tipo de contrato</label>
                                    <select class="custom-select mr-sm-2" id="selectcontract" name="contracttype">
                                        <option value="">Elige...</option>
                                        <option value="termino fijo" <?php if ($employee['contract_type'] == "termino fijo") echo "selected" ?>>Término fijo</option>
                                        <option value="termino indefinido" <?php if ($employee['contract_type'] == "termino indefinido") echo "selected" ?>>Término indefinido</option>
                                        <option value="obra labor" <?php if ($employee['contract_type'] == "obra labor") echo "selected" ?>>Obra o labor</option>
                                    </select>
                                </div>
                                <div class="form-group text-left">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 text-left">
                                            <input type="text" class="form-control" name="phonenumber" placeholder="Telefono" value="<?php echo $employee["phone_number"]; ?>" id="phonenumber">
                                        </div>
                                        <div class="form-group col-md-6 text-left">
                                            <input type="text" class="form-control" name="address" placeholder="Dirección" value="<?php echo $employee["home_address"]; ?>" id="address">
                                        </div>
                                    </div>
                                    <div class="form-group text-left">
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $employee["email"]; ?>" id="email">
                                    </div>
                                    <div class="form-group text-left">
                                        <input type="number" class="form-control" name="salary" placeholder="Salario" value="<?php echo $employee["salary"]; ?>" id="salary">
                                    </div>
                                    <div class="form-row ">
                                        <div class="form-group col-md-4 text-left">
                                            <input type="text" class="form-control" name="arl" placeholder="ARL" value="<?php echo $employee["arl"]; ?>" id="arl">
                                        </div>
                                        <div class="form-group col-md-4 text-left">
                                            <input type="text" class="form-control" name="ccf" placeholder="C.C.F" value="<?php echo $employee["c_c_f"]; ?>" id="ccf">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control" name="eps" placeholder="EPS" value="<?php echo $employee["eps"]; ?>" id="eps">
                                        </div>
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="startdate">Fecha de ingreso </label>
                                        <input type="date" class="form-control" name="startdate"  value="<?php echo $employee["start_of_date"]; ?>" id="startdate">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" id="button-update">Actualizar</button>
                                <?php endforeach; ?>
                            <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../../controllers/employees/update-employee.js"></script>
    <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>
</body>

</html>