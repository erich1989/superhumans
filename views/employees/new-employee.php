<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');
require_once('../../models/validator-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);
$validator = new Validator();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $employee->firstName = $_POST['firstname'];
    $employee->lastName = $_POST['lastname'];
    $employee->cc = $_POST['cc'];
    $employee->birthday = $_POST['birthday'];
    $employee->position = $_POST['position'];
    $employee->workingArea = $_POST['area'];
    $employee->contractType  = $_POST['contracttype'];
    $employee->phoneNumber = $_POST['phonenumber'];
    $employee->address = $_POST['address'];
    $employee->email = $_POST['email'];
    $employee->salary = $_POST['salary'];
    $employee->arl = $_POST['arl'];
    $employee->ccf = $_POST['ccf'];
    $employee->eps = $_POST['eps'];
    $employee->startDate = $_POST['startdate'];
    $employee->photo = $_FILES['photo']['name'];
    $employee->pdf = $_FILES['pdf']['name'];


    $validateFirstName = $validator->isValidFirstName($employee->firstName);
    $validateFirstName = $validator->isValidLastName($employee->lastName);
    $validateCc = $validator->isValidCc($employee->cc);
    $validateBirthday = $validator->isValidBirthday($employee->birthday);
    $validatePosition = $validator->isValidPosition($employee->position);
    $validateArea = $validator->isValidWorkingArea($employee->workingArea);
    $validateContract = $validator->isValidContractType($employee->contractType);
    $validatePhone = $validator->isValidPhone($employee->phoneNumber);
    $validateAddress = $validator->isValidAddress($employee->address);
    $validateEmail = $validator->isValidEmail($employee->email);
    $validateSalary = $validator->isValidSalary($employee->salary);
    $validateArl = $validator->isValidArl($employee->arl);
    $validateCcf = $validator->isValidCcf($employee->ccf);
    $validateEps = $validator->isValidEps($employee->eps);
    $validateStartDate = $validator->isValidStartDate($employee->startDate);
    $validateEmailDb = $validator->isValidEmailDb($connection->connection, $employee->email);
    $validateCcDb = $validator->isValidCcDb($connection->connection, $employee->cc);
    $validatePhoneDb = $validator->isValidPhoneDb($connection->connection, $employee->phoneNumber);
    $validatePhoto = $validator->isValidPhoto($employee->photo);
    $validatePdf = $validator->isValidPdf($employee->pdf);

    if ($validateFirstName == true && $validateFirstName == true && $validateCc == true && $validateBirthday == true && $validatePosition == true && $validatePhone == true && $validateAddress == true && $validateSalary == true && $validateArea == true && $validateContract == true && $validateArl == true && $validateCcf && $validateCcf == true && $validateEps == true && $validateStartDate == true && $validatePhoto == true && $validatePdf == true) {
        $employee->createEmployee();
        header('Location:http://localhost/superhumans_mvc/views/employees/active-employees.php');
    }
}


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

        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 " id="container-primary">
        <div class="row w-100 m-0">
            <div class="col-2 p-0">
                <?php require_once('../../src/components/navbar/navbar.php'); ?>
            </div>
            <div class="col-10">
                <div class="row mb-4">
                    <div class="col-12 p-0">
                        <nav class="navbar navbar-light bg-white shadow-sm">
                            <div class="">
                                <h3 class="font-weight-light p-2">Nuevo empleado</h3>
                            </div>
                            <form class="form-inline">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </nav>

                    </div>
                </div>

                <div class="row px-4">

                    <form action="" method="POST" class="w-100" enctype="multipart/form-data">
                        <div class="col-12 bg-white p-3 rounded shadow-sm mb-4">
                            <div class="">
                                <h3 class="font-weight-light">Datos personales</h3>
                            </div>
                        </div>

                        <div class="row mb-4">

                            <div class="col-6 ">
                                <div class="p-4 bg-white rounded shadow-sm h-100">

                                    <div class="form-group  text-left">
                                        <span class="error"> <?php echo $validator->errorFirstName; ?></span>
                                        <input type="text" class="form-control" name="firstname" placeholder="Nombres" value="<?php echo $employee->firstName ?>">
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="error"> <?php echo $validator->errorLastName; ?></span>
                                        <input type="text" class="form-control" name="lastname" placeholder="Apellidos" value="<?php echo $employee->lastName ?>">
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="error"> <?php echo $validator->errorCc; ?></span>
                                        <input type="text" class="form-control" name="cc" placeholder="C.C" value="<?php echo $employee->cc ?>">
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="exampleInputPassword1">Fecha de nacimiento</label><span class="error"> <?php echo $validator->errorBirthday; ?></span>
                                        <input type="date" class="form-control" name="birthday" id="exampleInputPassword1" value="<?php echo $employee->birthday ?>">
                                    </div>

                                </div>
                            </div>

                            <div class="col-6">

                                <div class="p-4 bg-white rounded shadow-sm h-100">

                                    <div class="form-group text-left">
                                        <span class="error"> <?php echo $validator->errorPhone; ?></span>
                                        <input type="text" class="form-control" name="phonenumber" placeholder="Telefono" value="<?php echo $employee->phoneNumber ?>">
                                    </div>

                                    <div class="form-group text-left">
                                        <span class="error"> <?php echo $validator->errorEmail; ?></span>
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $employee->email ?>">
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="error"></span>
                                        <input type="text" class="form-control" name="departamento" placeholder="Departamento" value="">
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="error"></span>
                                        <input type="text" class="form-control" name="city" placeholder="Ciudad" value="">
                                    </div>
                                    <div class="form-group text-left m-0">
                                        <span class="error"> <?php echo $validator->errorAddress; ?></span>
                                        <input type="text" class="form-control" name="address" placeholder="Dirección" value="<?php echo $employee->address ?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 bg-white p-3 rounded shadow-sm mb-4">
                            <div class="">
                                <h3 class="font-weight-light">Datos contractuales</h3>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6 ">
                                <div class="p-4 bg-white rounded shadow-sm h-100">

                                    <div class="form-group text-left">
                                        <label for="exampleInputPassword1">Fecha de ingreso </label><span class="error"> <?php echo $validator->errorStartDate; ?></span>
                                        <input type="date" class="form-control" name="startdate" id="exampleInputPassword1" value="<?php echo $employee->startDate ?>">
                                    </div>

                                    <div class="form-group text-left">
                                        <label class="" for="inlineFormCustomSelect">Área</label><span class="error"> <?php echo $validator->errorWorkingArea; ?></span>
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="area">
                                            <option value="">Elige...</option>
                                            <option value="area 1" <?php if ($employee->workingArea == "area 1") echo "selected" ?>>área 1 </option>
                                            <option value="area 2" <?php if ($employee->workingArea == "area 2") echo "selected" ?>>área 2</option>
                                            <option value="area 3" <?php if ($employee->workingArea == "area 3") echo "selected" ?>>área 3</option>
                                            <option value="area 4" <?php if ($employee->workingArea == "area 4") echo "selected" ?>>área 4</option>
                                            <option value="area 5" <?php if ($employee->workingArea == "area 5") echo "selected" ?>>área 5</option>
                                        </select>
                                    </div>

                                    <div class="form-group text-left">
                                        <label class="" for="inlineFormCustomSelect">Cargo</label><span class="error"> <?php echo $validator->errorPosition; ?></span>
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="position">
                                            <option value="">Elige...</option>
                                            <option value="cargo 1" <?php if ($employee->position == "cargo 1") echo "selected" ?>>Cargo 1 </option>
                                            <option value="cargo 2" <?php if ($employee->position == "cargo 2") echo "selected" ?>>Cargo 2</option>
                                            <option value="cargo 3" <?php if ($employee->position == "cargo 3") echo "selected" ?>>Cargo 3</option>
                                            <option value="cargo 4" <?php if ($employee->position == "cargo 4") echo "selected" ?>>Cargo 4</option>
                                            <option value="cargo 5" <?php if ($employee->position == "cargo 5") echo "selected" ?>>Cargo 5</option>
                                        </select>
                                    </div>

                                    <div class="form-group text-left">
                                        <span class="error"> <?php echo $validator->errorSalary; ?></span>
                                        <input type="number" class="form-control" name="salary" placeholder="Salario" value="<?php echo $employee->salary ?>">
                                    </div>

                                </div>
                            </div>

                            <div class="col-6 ">
                                <div class="p-4 bg-white rounded shadow-sm h-100">

                                    <div class="form-group text-left">
                                        <label class="" for="selectcontract">Tipo de contrato</label><span class="error"> <?php echo $validator->errorContractType; ?></span>
                                        <select class="custom-select mr-sm-2" id="selectcontract" name="contracttype">
                                            <option value="">Elige...</option>
                                            <option value="termino fijo" <?php if ($employee->contractType == "termino fijo") echo "selected" ?>>Término fijo</option>
                                            <option value="termino indefinido" <?php if ($employee->contractType == "termino indefinido") echo "selected" ?>>Término indefinido</option>
                                            <option value="obra labor" <?php if ($employee->contractType == "obra labor") echo "selected" ?>>Obra o labor</option>
                                        </select>
                                    </div>

                                    <div class="form-group text-left">
                                        <span class="error"></span>
                                        <input type="text" class="form-control" name="" placeholder="Número de cuenta" value="">
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="error"> <?php echo $validator->errorArl; ?></span>
                                        <input type="text" class="form-control" name="arl" placeholder="ARL" value="<?php echo $employee->arl ?>">
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="error"> <?php echo $validator->errorCcf; ?></span>
                                        <input type="text" class="form-control" name="ccf" placeholder="C.C.F" value="<?php echo $employee->ccf ?>">
                                    </div>
                                    <div class="form-group">
                                        <span class="error"> <?php echo $validator->errorEps; ?></span>
                                        <input type="text" class="form-control" name="eps" placeholder="EPS" value="<?php echo $employee->eps ?>">
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-12 bg-white p-3 rounded shadow-sm mb-4">
                            <div class="">
                                <h3 class="font-weight-light">Usuario-hv-foto</h3>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6 ">
                                <div class="p-4 bg-white rounded shadow-sm h-100">

                                    <div class="form-group text-left">
                                        <span class="error"></span>
                                        <input type="text" class="form-control" name="salary" placeholder="Nombre de usuario" value="">
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="error"></span>
                                        <input type="password" class="form-control" name="password" placeholder="Contraseña" value="">
                                    </div>
                                    <div class="form-group text-left">
                                        <span class="error"></span>
                                        <input type="password" class="form-control" name="" placeholder="Confrimar contraseña" value="">
                                    </div>

                                </div>
                            </div>

                            <div class="col-6 ">
                                <div class="p-4 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center align-items-center">

                                    <div class="form-group text-left mb-4">
                                        <label for="exampleFormControlFile1">Elige una foto</label><span class="error"> <?php echo $validator->errorPhoto; ?></span>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="photo" value="">
                                        <!-- <input type="hidden" name="" value="<?php echo $employee->photo ?>"> -->
                                    </div>

                                    <div class="form-group text-left ">
                                        <label for="exampleFormControlFilePdf">Elige HV (pdf)</label><span class="error"> <?php echo $validator->errorPdf; ?></span>
                                        <input type="file" class="form-control-file" id="exampleFormControlFilePdf" name="pdf" value="">
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-12 bg-white p-3 rounded shadow-sm mb-4">
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="buttonCancel">Cancelar</button>
                                <button type="submit" class="btn btn-primary" data-target="#staticBackdrop" id="button-event">Guardar</button>
                            </div>
                        </div>
                    </form>

                </div>



            </div>
        </div>
    </div>

    <script src="../../src/styles/js/style.js"></script>
    <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>