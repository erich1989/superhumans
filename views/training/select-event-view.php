<?php

require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');
require_once('../../models/evaluation-class.php');


$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$training = new LearningMethod($connection->connection);
$selectAnTraining = new Training($connection->connection);
$allEvaluation = new Evaluation($connection->connection);
$allQuestions = new Question($connection->connection);


$title = $_POST['titletraining'];
$start = $_POST['starttraining'];
$end = $_POST['endtraining'];

$oneTraining = $training->selectLearningMethodInformation($title, $start);
$infoTraining = $selectAnTraining->selectTraining($title);

$evaluation = $allEvaluation->allEvaluationInformation($title, $start);


// echo '<pre>';
// print_r($evaluation[0]['id']);
// echo '</pre>';

$questions = $allQuestions->selectQuestions($evaluation[0]['id']);

// echo '<pre>';
// print_r($questions);
// echo '</pre>';

// echo '<pre>';
// print_r($infoTraining);
// echo '</pre>';

?>

<?php
// echo '<pre>';
// print_r($oneTraining);
// echo '</pre>';
$name = $oneTraining[0]['title'];
$objetive = $oneTraining[0]['objetive'];
$teacher = $oneTraining[0]['teacher'];
$type = $infoTraining[0]['type'];

$fechaComoEnteroInicio = strtotime($oneTraining[0]['start']);
$fechaComoEnteroFin = strtotime($oneTraining[0]['end']);

$day = date("d", $fechaComoEnteroInicio);
$monthTraining = date("F", $fechaComoEnteroInicio);
$age = date("Y", $fechaComoEnteroInicio);
$startTime = date("h:i A ", $fechaComoEnteroInicio);
$endTime = date("h:i A ", $fechaComoEnteroFin);

$monthNames = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre', 'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'];

$dias = ['Monday' => 'lunes', 'Tuesday' => 'martes', 'Wednesday' => 'miércoles', 'Thursday' => 'jueves', 'Friday' => 'viernes', 'Saturday' => 'sábado', 'Sunday' => 'domingo'];

$dateOne = $day . " " . $monthNames[$monthTraining] . " del " . $age;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid p-0" id="container-primary">
        <div class="row" style="height: 100%;">
            <div class="col-2 pr-0">
                <?php require_once('../../src/components/navbar/navbar.php'); ?>
            </div>
            <div class="col-10 p-4  p-5" style="background-color: rgba(0,0,0,.03);">
                <div class="card shadow mb-3">
                    <div class="card-header">
                        <h3 class="text-center">Información de capacitación</h3>
                    </div>
                    <div class="card-body px-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex ">
                                    <h5 class="mb-0 mr-2">Titulo:</h5>
                                    <h5 class="m-0 font-weight-normal"> <?php echo ucfirst($name) ?></h>
                                </div>
                                <div class="d-flex">
                                    <h5 class="mb-0 mr-2">Objetivo:</h5>
                                    <h5 class="font-weight-normal"><?php echo ucfirst($objetive) ?></h5>
                                    </h4>
                                </div>

                                <div class="d-flex">
                                    <h5 class="mr-2">Facilitador:</h5>
                                    <h5 class="font-weight-normal"><?php echo ucwords($teacher) ?></h5>
                                </div>

                                <div class="d-flex">
                                    <h5 class="mr-2">Tipo:</h5>
                                    <h5 class="font-weight-normal"><?php echo ucwords($type) ?></h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="">
                                    <div class="d-flex">
                                        <h5 class="mr-2">Fecha de inicio:</h5>
                                        <h5 class="font-weight-normal"><?php echo ucwords($dateOne) ?></h5>
                                    </div>
                                    <div class="d-flex">
                                        <h5 class="mr-2">Hora de inicio:</h5>
                                        <h5 class="font-weight-normal"><?php echo ucwords($startTime) ?></h5>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <h5 class="mr-2">Hora de fin:</h5>
                                    <h5 class="font-weight-normal"><?php echo ucwords($endTime) ?></h5>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer text-center d-flex justify-content-center">
                        <form action="../../views/training/new-learning-method.php" method="POST" id="form-info-training">
                            <input type="hidden" name="title" id="title-learning-method" value="<?php echo  $title ?>">
                            <input type="hidden" name="start" id="start-learning-method" value="<?php echo  $start ?>">
                            <button class="btn btn-primary mr-2" id="button-edit-learning-method"><i class="far fa-edit"></i> Editar</button>
                        </form>
                        <form action="../../server/training/delete-learning-method.php" method="post" id="form-delete-learning-method">
                            <input type="hidden" name="titledelete" id="title-learning-method-delete" value="<?php echo  $title ?>">
                            <input type="hidden" name="startdelete" id="start-learning-method-delete" value="<?php echo  $start ?>">
                            <button class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</button>
                        </form>

                    </div>
                </div>

                <div class="card shadow mb-3">
                    <div class="card-header">
                        <h3 class="text-center">Participantes</h3>
                    </div>
                    <div class="card-body px-4">
                        <ul>
                            <?php
                            for ($i = 0; $i < count($oneTraining[0]['employees']); $i++) {
                                echo '<li>' . strtoupper($oneTraining[0]['employees'][$i]['employee']) . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="col-12 bg-white p-3 rounded shadow-sm mb-2">
                    <div class="">
                        <h3 class="font-weight-light">Evaluación</h3>
                    </div>
                </div>

                <div class="col-12 bg-white p-3 rounded shadow-sm mb-2 p-4">
                    <div class="row">

                        <?php
                        $contador = 1;
                        foreach ($questions as $question) {
                            
                            echo '<div class="col-6 mb-2">';
                                echo '<div class="card shadow-sm mb-3">';
                                    echo '<div class="card-header">';
                                        echo '<h5 class="text-center">'.'Pregunta '.$contador++.'</h5>';        
                                    echo '</div>';
                                    echo '<div class="card-body px-4">';
                                        echo '<p>'.$question['question'].'</p>';
                                        echo '<div class="d-flex mb-2">';
                                            echo '<div class="bg-light p-2 border rounded-left">';
                                                echo '<p class="m-0">A</p>';
                                            echo '</div>';
                                            echo '<div class="p-2 border-top border-right border-bottom rounded-right w-100">';
                                                echo '<p class="m-0">'.$question['option_a'].'</p>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="d-flex mb-2">';
                                            echo '<div class="bg-light p-2 border rounded-left">';
                                                echo '<p class="m-0">B</p>';
                                            echo '</div>';
                                            echo '<div class="p-2 border-top border-right border-bottom rounded-right w-100">';
                                                echo '<p class="m-0">'.$question['option_b'].'</p>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="d-flex mb-2">';
                                            echo '<div class="bg-light p-2 border rounded-left">';
                                                echo '<p class="m-0">C</p>';
                                            echo '</div>';
                                            echo '<div class="p-2 border-top border-right border-bottom rounded-right w-100">';
                                                echo '<p class="m-0">'.$question['option_c'].'</p>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="d-flex mb-2">';
                                            echo '<div class="bg-light p-2 border rounded-left">';
                                                echo '<p class="m-0">D</p>';
                                            echo '</div>';
                                            echo '<div class="p-2 border-top border-right border-bottom rounded-right w-100">';
                                                echo '<p class="m-0">'.$question['option_d'].'</p>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="">';
                                            echo '<h6>Respuesta coreecta:</h6>';
                                            echo '<p>'.$question['correct_response'].'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="card shadow mb-3">
                    <div class="card-header">
                        <h3 class="text-center">Estadisticas</h3>
                    </div>
                    <div class="card-body px-4">

                    </div>
                </div>

                <div class="card shadow mb-3">
                    <div class="card-header">
                        <h3 class="text-center">Formatos</h3>
                    </div>
                    <div class="card-body px-4 text-center">
                        <?php echo "<a href='../../src/pdf-certificates/certificate-training.php?titulo=$title&fecha-inicio=$start&fecha-fin=$end' class='btn btn-primary' target='_blank' rel='noopener noreferrer'><i class='far fa-file-alt'></i> Certificado</a>" ?>

                        <a href="#" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><i class="far fa-calendar-check"></i> Evaluación capacitación</a>
                        <a href="#" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><i class="far fa-id-card"></i> Evaluación empleados</a>
                        <a href="#" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><i class="fas fa-chalkboard-teacher"></i> Evaluación Facilitador</a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        const formDeletelearningMethod = document.getElementById('form-delete-learning-method');

        formDeletelearningMethod.addEventListener('submit', function(e) {
            alert('Esta seguro de eliminar la capacitación');
        })
    </script>

    <script src="../../src/styles/js/style.js"></script>
    <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>