<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

$id = $_REQUEST['id'];
$stateActive;
$stateInactive;

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);
$employees = $employee->selectAnEmployee($id);

foreach ($employees as $employee) {
    $id = $employee['id'];
    $firstname = $employee['first_name'];
    $lastname = $employee['last_name'];
    $cc = $employee['cc'];
    $birthday = $employee['birthday'];
    $phone = $employee['phone_number'];
    $address = $employee['home_address'];
    $email = $employee['email'];
    $position = $employee['position'];
    $area = $employee['working_area'];
    $salary = $employee['salary'];
    $startDate = $employee['start_of_date'];
    $endDate = $employee['end_date'];
    $reasonDismissal = $employee['reason_dismissal'];
    $eps = $employee['eps'];
    $arl = $employee['arl'];
    $ccf = $employee['c_c_f'];
    $image = $employee['photo'];
    $pdf = $employee['cv_pdf'];
    $active = $employee['active'];
}

if ($active == 1) {
    $stateActive = "Activo";
}

if ($active == 0) {
    $stateInactive = "Retirado";
}

function newDate($oldDate)
{
    $newDate = str_replace('-', '/', date('d-m-Y', strtotime($oldDate)));
    return $newDate;
}

$newStartDate = newDate($startDate);
$newEndDate = newDate($endDate);
if ($newEndDate === '01/01/1970') {
    $newEndDate = '';
}
$newBirthday = newDate($birthday);

function calcular_edad($fecha)
{
    $dias = explode("/", $fecha, 3);
    $dias = mktime(0, 0, 0, $dias[1], $dias[0], $dias[2]);
    $edad = (int)((time() - $dias) / 31556926);
    return $edad;
}

$age = calcular_edad($newBirthday);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .card-title {
            font-weight: bold;
        }

        .employee-active {
            color: green;
        }

        .employee-inactive {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0" id="container-primary">
        <div class="row" style="height: 100%;">
            <div class="col-2 pr-0">
                <?php include_once('../../src/components/navbar/navbar.php') ?>
            </div>
            <div class="col-10 p-3">
                <div class="row mb-4">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div class="">
                            <img src="../../src/images/employees-photos/<?= $image ?>" alt="" srcset="" width="250px" height="380px" class="rounded border border-secondary">
                        </div>
                    </div>
                    <div class="col-9 ">
                        <div class="">
                            <h1><em><?= strtoupper($firstname) . " " . strtoupper($lastname) ?> </em></h1>
                            <?php
                            if ($active == 1) {
                                echo '<h3 class= "employee-active">' . $stateActive . '</h3>';
                            } else {
                                echo '<h3 class= "employee-inactive">' . $stateInactive . '</h3>';
                            }

                            ?>
                        </div>

                        <div class=" pl-0 pr-4 pt-4 pb-0">
                            <div class="card border-0">
                                <div class="card-header">
                                    <h5>Información personal</h5>
                                </div>
                                <div class="card-body d-flex">
                                    <div>
                                        <div class="mr-5">
                                            <P class="m-0"><span class="card-title m-0">C.C: </span><?= $cc ?></P>
                                            <P class="m-0"><span class="card-title m-0">F/NACIMIENTO: </span><?= $newBirthday ?></P>
                                            <P class="m-0"><span class="card-title m-0">EDAD: </span><?= $age ?></P>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mr-5">
                                            <P class="m-0"><span class="card-title m-0">E/CIVIL: </span>soltero</P>
                                            <P class="m-0"><span class="card-title m-0">HIJOS: </span>1</P>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mr-4">
                                            <P class="m-0"><span class="card-title m-0">TELEFONO: </span><?= $phone ?></P>
                                            <P class="m-0"><span class="card-title m-0">CORREO: </span><?= $email ?></P>
                                            <P class="m-0"><span class="card-title m-0">DIRECCION: </span><?= $address ?></P>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class=" pl-0 pr-4 pt-4 pb-4">
                            <div class="card border-0">
                                <div class="card-header">
                                    <h5>Información Contractual </h5>
                                </div>
                                <div class="card-body d-flex">
                                    <div>
                                        <div class="mr-5">
                                            <P class="m-0"><span class="card-title m-0">CARGO: </span><?= $position ?></P>
                                            <P class="m-0"><span class="card-title m-0">ÁREA: </span><?= $area ?></P>
                                            <P class="m-0"><span class="card-title m-0">SALARIO: </span><?= $salary ?></P>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mr-5">
                                            <P class="m-0"><span class="card-title m-0">F/INGRESO: </span><?= $newStartDate ?></P>
                                            <P class="m-0"><span class="card-title m-0">F/RETIRO: </span><?= $newEndDate ?></P>
                                            <P class="m-0"><span class="card-title m-0">M/RETIRO: </span><?= $reasonDismissal ?></P>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mr-4">
                                            <P class="m-0"><span class="card-title m-0">EPS: </span><?= $eps ?></P>
                                            <P class="m-0"><span class="card-title m-0">ARL: </span><?= $arl ?></P>
                                            <P class="m-0"><span class="card-title m-0">CCF: </span><?= $ccf ?></P>
                                        </div>
                                    </div>
                                    <div class="text-center" style="width: 150px; ">
                                        <a href="read-pdf.php?id=<?= $id ?>" style="font-size: 50px; color: red;" target="_blank"><i class="fas fa-file-pdf"></i></a>
                                        <p class="m-0 card-title">HV</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card border-0">
                            <div class="card-header">
                                <h5>Capacitaciones</h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-0">
                            <div class="card-header">
                                <h5>Ausentismo</h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-0">
                            <div class="card-header">
                                <h5>Desempeño</h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="styles.js"></script>
    <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

    <!-- Bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>

<?php

?>