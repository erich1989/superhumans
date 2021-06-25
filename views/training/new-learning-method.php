<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../../models/database-connection.php');
    require_once('../../models/training-class.php');
    require_once('../../models/evaluation-class.php');

    $title = $_POST['title'];
    // echo '<br>';
    $start = $_POST['start'];


    $connection = new Database("localhost", "transito", "valeria2", "superhumanos");
    $training = new LearningMethod($connection->connection);
    $evaluation = new Evaluation($connection->connection);

    $oneTraining = $training->selectLearningMethodInformation($title, $start);
    $questions = $evaluation->allEvaluationInformation($title, $start);

    // echo '<pre>';
    // print_r($oneTraining);
    // echo '</pre>';

    // echo '<pre>';
    // print_r($questions);
    // echo '</pre>';

    $id = $questions[0]['id'];
    $name = $oneTraining[0]['title'];
    $teacher = $oneTraining[0]['teacher'];
    // print_r($employees = $oneTraining[0]['employees'][0]['employee']);
} else {
    $id = "";
    $name = "";
    $teacher = "";
    $employees = [];
}

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
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body onload="nameEmployees()">
    <div class="container-fluid p-0 " id="container-primary">
        <div class="row" style="height: 100%;">
            <div class="col-2 pr-0">
                <?php require_once('../../src/components/navbar/navbar.php'); ?>
            </div>
            <div class="col-10 p-4 bg-light">
                <div class="col-12 bg-white p-3 rounded shadow-sm mb-2">
                    <div class="">
                        <h3 class="font-weight-light">Nueva capacitación</h3>
                    </div>
                </div>
                <div class="row ">

                    <input type="hidden" id="hidden-title" name="title" value="<?= $name ?>">
                    <input type="hidden" id="hidden-start" name="start" value="<?= $start ?>">

                    <div class="col-12 p-3">
                        <form action="../../server/training/new-learning-method.php" class="p-0 bg-light" method="POST" id="formprimary" name="formprimary">
                            <div class="row">
                                <div class="col-6">
                                    <div class="p-4 mb-4 bg-white rounded shadow-sm">
                                        <div class="form-row">

                                            <div class="form-group col-10">
                                                <label for="inputTraining">Capacitación</label><span class="error" id="errorTraining"></span>
                                                <select id="inputTraining" class="form-control" name="training">
                                                    <option value="">Selecciona...</option>
                                                </select>
                                            </div>
                                            <div class="form-group d-flex flex-column align-items-center justify-content-end col-2">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-10">
                                                <input type="hidden" id="hidden-teacher" value="<?= $teacher ?>">
                                                <label for="inputTeacher">Facilitador</label><span class="error" id="errorTeacher"></span>
                                                <select id="inputTeacher" class="form-control" name="teacher">
                                                    <option value="">Selecciona...</option>
                                                </select>
                                            </div>
                                            <div class="form-group d-flex flex-column align-items-center justify-content-end col-2">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropTeacher">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="objetivetraining">Objetivo</label><span class="error" id="errorTextarea"></span>
                                            <textarea class="form-control" id="objetivetraining" rows="4" name="objetive"></textarea>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="p-4 mb-4 bg-white rounded shadow-sm">
                                        <div class="form-group">
                                            <label for="inputEmployees">Participantes</label><span class="error" id="errorEmployees"></span>
                                            <select id="inputEmployees" class="form-control" name="employees[]" multiple>
                                            </select>
                                        </div>
                                        <!-- <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-3">Todo el dia</legend>
                                                <div class="">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="1">
                                                        <label class="form-check-label" for="gridRadios1">
                                                            SI
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="0" checked>
                                                        <label class="form-check-label" for="gridRadios2">
                                                            NO
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset> -->

                                        <div class="form-group">
                                            <label for="startDate">Fecha de inicio</label><span class="error" id="errorStartDate"></span>
                                            <input type="datetime-local" class="form-control" name="startDate" id="startDate">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="endDate">Fecha de finalización</label><span class="error" id="errorEndDate"></span>
                                            <input type="datetime-local" class="form-control" name="endDate" id="endDate">
                                        </div>

                                        <input type="hidden" name="className" value="primary">
                                        <input type="hidden" id="old-hidden-title" name="old-title" value="<?= $name ?>">
                                        <input type="hidden" id="old-hidden-start" name="old-start" value="<?= $start ?>">
                                        <input type="hidden" id="hidden-id" name="id" value="<?= $id ?>">

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white p-3 rounded shadow-sm mb-4">
                                <div class="">
                                    <h4 class="font-weight-light">Evaluación de capacitación</h4>
                                </div>
                            </div>

                            <div id="container-questions">

                                <div class="col-12 p-4 bg-white shadow-sm mb-4">
                                    <div class="mb-3 text-center border-bottom">
                                        <h4 class="font-weight-light mb-4"> Pregunta 1</h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="questionOne">Pregunta</label><span class="error" id="errorQuestionOne"></span>
                                        <input type="text" class="form-control" id="questionOne" name="questionone">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionAQuestionOne"> Opcion A.</label><span class="error" id="errorOptionAQuestionOne"></span>
                                                <input type="text" class="form-control" id="optionAQuestionOne" name="optionAQuestionOne">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionCQuestionOne"> Opcion C.</label><span class="error" id="errorOptionCQuestionOne"></span>
                                                <input type="text" class="form-control" id="optionCQuestionOne" name="optionCQuestionOne">
                                            </div>

                                            <div class="form-group">
                                                <label for="correctOptionQuestionOne">Respuesta Correcta</label><span class="error" id="errorCorrectOptionQuestionOne"></span>
                                                <select id="correctOptionQuestionOne" class="form-control" name="correctOptionQuestionOne">
                                                    <option value="">Selecciona...</option>
                                                    <option value="a">A.</option>
                                                    <option value="b">B.</option>
                                                    <option value="c">C.</option>
                                                    <option value="d">D.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionBQuestionOne">Opcion B.</label><span class="error" id="errorOptionBQuestionOne"></span>
                                                <input type="text" class="form-control" id="optionBQuestionOne" name="optionBQuestionOne">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionDQuestionOne"> Opcion D.</label><span class="error" id="errorOptionDQuestionOne"></span>
                                                <input type="text" class="form-control" id="optionDQuestionOne" name="optionDQuestionOne">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 p-4 bg-white shadow-sm mb-4">
                                    <div class="mb-3 text-center border-bottom">
                                        <h4 class="font-weight-light mb-4"> Pregunta 2</h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="questionTwo">Pregunta</label><span class="error" id="errorQuestionTwo"></span>
                                        <input type="text" class="form-control" id="questionTwo" name="questionTwo">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionAQuestionTwo"> Opcion A.</label><span class="error" id="errorOptionAQuestionTwo"></span>
                                                <input type="text" class="form-control" id="optionAQuestionTwo" name="optionAQuestionTwo">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionCQuestionTwo"> Opcion C.</label><span class="error" id="errorOptionCQuestionTwo"></span>
                                                <input type="text" class="form-control" id="optionCQuestionTwo" name="optionCQuestionTwo">
                                            </div>

                                            <div class="form-group">
                                                <label for="correctOptionQuestionTwo">Respuesta Correcta</label><span class="error" id="errorCorrectOptionQuestionTwo"></span>
                                                <select id="correctOptionQuestionTwo" class="form-control" name="correctOptionQuestionTwo">
                                                    <option value="">Selecciona...</option>
                                                    <option value="a">A.</option>
                                                    <option value="b">B.</option>
                                                    <option value="c">C.</option>
                                                    <option value="d">D.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionBQuestionTwo">Opcion B.</label><span class="error" id="errorOptionBQuestionTwo"></span>
                                                <input type="text" class="form-control" id="optionBQuestionTwo" name="optionBQuestionTwo">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionDQuestionTwo"> Opcion D.</label><span class="error" id="errorOptionDQuestionTwo"></span>
                                                <input type="text" class="form-control" id="optionDQuestionTwo" name="optionDQuestionTwo">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 p-4 bg-white shadow-sm mb-4">
                                    <div class="mb-3 text-center border-bottom">
                                        <h4 class="font-weight-light mb-4"> Pregunta 3</h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="questionThree">Pregunta</label><span class="error" id="errorQuestionThree"></span>
                                        <input type="text" class="form-control" id="questionThree" name="questionThree">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionAQuestionThree"> Opcion A.</label><span class="error" id="errorOptionAQuestionThree"></span>
                                                <input type="text" class="form-control" id="optionAQuestionThree" name="optionAQuestionThree">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionCQuestionThree"> Opcion C.</label><span class="error" id="errorOptionCQuestionThree"></span>
                                                <input type="text" class="form-control" id="optionCQuestionThree" name="optionCQuestionThree">
                                            </div>

                                            <div class="form-group">
                                                <label for="correctOptionQuestionThree">Respuesta Correcta</label><span class="error" id="errorCorrectOptionQuestionThree"></span>
                                                <select id="correctOptionQuestionThree" class="form-control" name="correctOptionQuestionThree">
                                                    <option value="">Selecciona...</option>
                                                    <option value="a">A.</option>
                                                    <option value="b">B.</option>
                                                    <option value="c">C.</option>
                                                    <option value="d">D.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionBQuestionThree">Opcion B.</label><span class="error" id="errorOptionBQuestionThree"></span>
                                                <input type="text" class="form-control" id="optionBQuestionThree" name="optionBQuestionThree">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionDQuestionThree"> Opcion D.</label><span class="error" id="errorOptionDQuestionThree"></span>
                                                <input type="text" class="form-control" id="optionDQuestionThree" name="optionDQuestionThree">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 p-4 bg-white shadow-sm mb-4">
                                    <div class="mb-3 text-center border-bottom">
                                        <h4 class="font-weight-light mb-4"> Pregunta 4</h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="questionFour">Pregunta</label><span class="error" id="errorQuestionFour"></span>
                                        <input type="text" class="form-control" id="questionFour" name="questionFour">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionAQuestionFour"> Opcion A.</label><span class="error" id="errorOptionAQuestionFour"></span>
                                                <input type="text" class="form-control" id="optionAQuestionFour" name="optionAQuestionFour">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionCQuestionFour"> Opcion C.</label><span class="error" id="errorOptionCQuestionFour"></span>
                                                <input type="text" class="form-control" id="optionCQuestionFour" name="optionCQuestionFour">
                                            </div>

                                            <div class="form-group">
                                                <label for="typetraining">Respuesta Correcta</label><span class="error" id="errorCorrectOptionQuestionFour"></span>
                                                <select id="correctOptionQuestionFour" class="form-control" name="correctOptionQuestionFour">
                                                    <option value="">Selecciona...</option>
                                                    <option value="a">A.</option>
                                                    <option value="b">B.</option>
                                                    <option value="c">C.</option>
                                                    <option value="d">D.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionBQuestionFour">Opcion B.</label><span class="error" id="errorOptionBQuestionFour"></span>
                                                <input type="text" class="form-control" id="optionBQuestionFour" name="optionBQuestionFour">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionDQuestionFour"> Opcion D.</label><span class="error" id="errorOptionDQuestionFour"></span>
                                                <input type="text" class="form-control" id="optionDQuestionFour" name="optionDQuestionFour">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 p-4 bg-white shadow-sm mb-4">
                                    <div class="mb-3 text-center border-bottom">
                                        <h4 class="font-weight-light mb-4"> Pregunta 5</h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="questionFive">Pregunta</label><span class="error" id="errorQuestionFive"></span>
                                        <input type="text" class="form-control" id="questionFive" name="questionFive">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionAQuestionFive"> Opcion A.</label><span class="error" id="errorOptionAQuestionFive"></span>
                                                <input type="text" class="form-control" id="optionAQuestionFive" name="optionAQuestionFive">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionCQuestionFive"> Opcion C.</label><span class="error" id="errorOptionCQuestionFive"></span>
                                                <input type="text" class="form-control" id="optionCQuestionFive" name="optionCQuestionFive">
                                            </div>

                                            <div class="form-group">
                                                <label for="correctOptionQuestionFive">Respuesta Correcta</label><span class="error" id="errorCorrectOptionQuestionFive"></span>
                                                <select id="correctOptionQuestionFive" class="form-control" name="correctOptionQuestionFive">
                                                    <option value="">Selecciona...</option>
                                                    <option value="a">A.</option>
                                                    <option value="b">B.</option>
                                                    <option value="c">C.</option>
                                                    <option value="d">D.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="optionBQuestionFive">Opcion B.</label><span class="error" id="errorOptionBQuestionFive"></span>
                                                <input type="text" class="form-control" id="optionBQuestionFive" name="optionBQuestionFive">
                                            </div>

                                            <div class="form-group">
                                                <label for="optionDQuestionFive"> Opcion D.</label><span class="error" id="errorOptionDQuestionFive"></span>
                                                <input type="text" class="form-control" id="optionDQuestionFive" name="optionDQuestionFive">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="col-12 bg-white p-3 rounded shadow-sm mb-2">
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="buttonCancel">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" data-target="#staticBackdrop" id="button-event">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php require_once('../../src/components/modales/modal-training.php'); ?>
                <?php require_once('../../src/components/modales/modal-teacher.php'); ?>

                <div id='calendar'></div>
            </div>
        </div>

        <script>
            //input fron form 
            let $formPrimary = document.getElementById('formprimary');
            let $selectTranining = document.getElementById('inputTraining');
            let $selectTeacher = document.getElementById('inputTeacher');
            let $selectEmployees = document.getElementById('inputEmployees');
            let $selectStartDate = document.getElementById('startDate');
            let $selectEndDate = document.getElementById("endDate");

            //Question One
            const $questionOne = document.getElementById("questionOne");
            const $optionAQuestionOne = document.getElementById("optionAQuestionOne");
            const $optionBQuestionOne = document.getElementById("optionBQuestionOne");
            const $optionCQuestionOne = document.getElementById("optionCQuestionOne");
            const $optionDQuestionOne = document.getElementById("optionDQuestionOne");
            const $correctOptionQuestionOne = document.getElementById("correctOptionQuestionOne");

            const $errorQuestionOne = document.getElementById('errorQuestionOne');
            const $errorOptionAQuestionOne = document.getElementById('errorOptionAQuestionOne');
            const $errorOptionBQuestionOne = document.getElementById('errorOptionBQuestionOne');
            const $errorOptionCQuestionOne = document.getElementById('errorOptionCQuestionOne');
            const $errorOptionDQuestionOne = document.getElementById('errorOptionDQuestionOne');
            const $errorCorrectOptionQuestionOne = document.getElementById('errorCorrectOptionQuestionOne');

            //Question two
            const $questionTwo = document.getElementById('questionTwo');
            const $optionAQuestionTwo = document.getElementById("optionAQuestionTwo");
            const $optionBQuestionTwo = document.getElementById("optionBQuestionTwo");
            const $optionCQuestionTwo = document.getElementById("optionCQuestionTwo");
            const $optionDQuestionTwo = document.getElementById("optionDQuestionTwo");
            const $correctOptionQuestionTwo = document.getElementById("correctOptionQuestionTwo");

            const $errorQuestionTwo = document.getElementById('errorQuestionTwo');
            const $errorOptionAQuestionTwo = document.getElementById('errorOptionAQuestionTwo');
            const $errorOptionBQuestionTwo = document.getElementById('errorOptionBQuestionTwo');
            const $errorOptionCQuestionTwo = document.getElementById('errorOptionCQuestionTwo');
            const $errorOptionDQuestionTwo = document.getElementById('errorOptionDQuestionTwo');
            const $errorCorrectOptionQuestionTwo = document.getElementById('errorCorrectOptionQuestionTwo');

            //Question three
            const $questionThree = document.getElementById('questionThree');
            const $optionAQuestionThree = document.getElementById("optionAQuestionThree");
            const $optionBQuestionThree = document.getElementById("optionBQuestionThree");
            const $optionCQuestionThree = document.getElementById("optionCQuestionThree");
            const $optionDQuestionThree = document.getElementById("optionDQuestionThree");
            const $correctOptionQuestionThree = document.getElementById("correctOptionQuestionThree");

            const $errorQuestionThree = document.getElementById('errorQuestionThree');
            const $errorOptionAQuestionThree = document.getElementById('errorOptionAQuestionThree');
            const $errorOptionBQuestionThree = document.getElementById('errorOptionBQuestionThree');
            const $errorOptionCQuestionThree = document.getElementById('errorOptionCQuestionThree');
            const $errorOptionDQuestionThree = document.getElementById('errorOptionDQuestionThree');
            const $errorCorrectOptionQuestionThree = document.getElementById('errorCorrectOptionQuestionThree');

            //Question Four
            const $questionFour = document.getElementById('questionFour');
            const $optionAQuestionFour = document.getElementById("optionAQuestionFour");
            const $optionBQuestionFour = document.getElementById("optionBQuestionFour");
            const $optionCQuestionFour = document.getElementById("optionCQuestionFour");
            const $optionDQuestionFour = document.getElementById("optionDQuestionFour");
            const $correctOptionQuestionFour = document.getElementById("correctOptionQuestionFour");

            const $errorQuestionFour = document.getElementById('errorQuestionFour');
            const $errorOptionAQuestionFour = document.getElementById('errorOptionAQuestionFour');
            const $errorOptionBQuestionFour = document.getElementById('errorOptionBQuestionFour');
            const $errorOptionCQuestionFour = document.getElementById('errorOptionCQuestionFour');
            const $errorOptionDQuestionFour = document.getElementById('errorOptionDQuestionFour');
            const $errorCorrectOptionQuestionFour = document.getElementById('errorCorrectOptionQuestionFour');

            //Question Five
            const $questionFive = document.getElementById('questionFive');
            const $optionAQuestionFive = document.getElementById("optionAQuestionFive");
            const $optionBQuestionFive = document.getElementById("optionBQuestionFive");
            const $optionCQuestionFive = document.getElementById("optionCQuestionFive");
            const $optionDQuestionFive = document.getElementById("optionDQuestionFive");
            const $correctOptionQuestionFive = document.getElementById("correctOptionQuestionFive");

            const $errorQuestionFive = document.getElementById('errorQuestionFive');
            const $errorOptionAQuestionFive = document.getElementById('errorOptionAQuestionFive');
            const $errorOptionBQuestionFive = document.getElementById('errorOptionBQuestionFive');
            const $errorOptionCQuestionFive = document.getElementById('errorOptionCQuestionFive');
            const $errorOptionDQuestionFive = document.getElementById('errorOptionDQuestionFive');
            const $errorCorrectOptionQuestionFive = document.getElementById('errorCorrectOptionQuestionFive');

            //span from input
            let $errorInputTraining = document.getElementById('errorTraining');
            let $errorTeacher = document.getElementById('errorTeacher');
            let $errorEmployees = document.getElementById('errorEmployees');
            let $errorStartDate = document.getElementById('errorStartDate');
            let $errorEndDate = document.getElementById('errorEndDate');

            //select cancel button
            let $selectButtonCancel = document.getElementById('buttonCancel');

            let $fragment = document.createDocumentFragment();


            function nameEmployees() {

                fetch('/superhumans_mvc/server/training/all-training.php')
                    .then((res) => (res.ok ? res.json() : Promise.reject(res)))
                    .then((json) => {
                        // console.log(json);
                        json.forEach((el) => {
                            const $option = document.createElement("option");
                            $option.setAttribute('value', `${el.title}`);
                            $option.innerHTML = `${el.title.toUpperCase()}`;
                            $fragment.appendChild($option);
                        });

                        $selectTranining.appendChild($fragment);
                        return json;
                    })
                    .then((json) => {
                        if (document.getElementById('hidden-title').value) {
                            $formPrimary.setAttribute('action', '../../server/training/update-learning-method.php');
                            for (i = 0; i <= json.length; i++) {
                                if (document.getElementById('inputTraining')[i].value === document.getElementById('hidden-title').value) {
                                    document.getElementById('inputTraining')[i].setAttribute('selected', '');
                                }
                            }

                        }
                        return json;
                    })
                    .catch((err) => {
                        console.log(err);
                        let message = err.statusText || "Ocurrió un error";
                        $selectTranining.innerHTML = `Error ${err.status}: ${message}`;
                    });

                fetch('/superhumans_mvc/server/training/all-teacher.php')
                    .then((res) => (res.ok ? res.json() : Promise.reject(res)))
                    .then((json) => {
                        json.forEach((el) => {
                            const $option = document.createElement("option");
                            $option.setAttribute('value', `${el.first_name} ${el.last_name}`);
                            $option.innerHTML = `${el.first_name.toUpperCase()} ${el.last_name.toUpperCase()}`;
                            $fragment.appendChild($option);
                        });

                        $selectTeacher.appendChild($fragment);
                        return json;

                    })
                    .then((json) => {
                        const nameTeacher = document.getElementById('inputTeacher');
                        const nameHiddenTeacher = document.getElementById('hidden-teacher');
                        for (i = 0; i <= json.length; i++) {
                            if (nameTeacher[i].value === nameHiddenTeacher.value) {
                                nameTeacher[i].setAttribute('selected', '');
                            }
                        }
                        return json;
                    })
                    .catch((err) => {
                        console.log(err);
                        let message = err.statusText || "Ocurrió un error";
                        $selectTeacher.innerHTML = `Error ${err.status}: ${message}`;
                    });


                fetch('/superhumans_mvc/server/employees/select_name_employees.php')
                    .then((res) => (res.ok ? res.json() : Promise.reject(res)))
                    .then((json) => {

                        json.forEach((el) => {
                            const $option = document.createElement("option");
                            $option.setAttribute('class', 'optionEmployee');
                            $option.setAttribute('value', `${el.first_name} ${el.last_name}`);
                            $option.innerHTML = `${el.first_name.toUpperCase()} ${el.last_name.toUpperCase()}`;
                            $fragment.appendChild($option);
                        });
                        $selectEmployees.appendChild($fragment);
                        return json;

                    })
                    .then((json) => {

                        const titleHidden = document.getElementById('hidden-title');
                        const startHidden = document.getElementById('hidden-start');
                        // const idHidden = document.getElementById('hidden-id');

                        if (titleHidden.value && startHidden.value) {
                            const url = `../../server/training/select-training-json.php?title=${titleHidden.value}&start=${startHidden.value}`;

                            fetch(url)
                                .then((res) => (res.ok ? res.json() : Promise.reject(res)))
                                .then((json) => {
                                    console.log(json[0].objetive);
                                    const $objetive = json[0].objetive;
                                    document.getElementById('objetivetraining').innerHTML = $objetive;

                                    function newTimeFormat($oldDate) {
                                        function addZero(i) {

                                            if (i < 10) {
                                                i = "0" + i;
                                            }
                                            return i;
                                        }

                                        const fecha = new Date($oldDate);

                                        $age = fecha.getFullYear();
                                        $month = addZero(fecha.getMonth() + 1);
                                        $day = addZero(fecha.getDate());
                                        $hours = addZero(fecha.getHours());
                                        $minutes = addZero(fecha.getMinutes());
                                        $seconds = fecha.getSeconds();

                                        return `${$age}-${$month}-${$day}T${$hours}:${$minutes}`;
                                    }
                                    console.log(json[0].start)

                                    const newDateStart = newTimeFormat(json[0].start);
                                    const newDateEnd = newTimeFormat(json[0].end);


                                    $selectStartDate.setAttribute('value', newDateStart.toLocaleString([], {
                                        hour12: true
                                    }));
                                    $selectEndDate.setAttribute('value', newDateEnd.toLocaleString([], {
                                        hour12: true
                                    }));


                                    const numberOfoptions = document.querySelectorAll('#inputEmployees > option');
                                    var contador = 0;

                                    for (i = 0; i < json[0].employees.length; i++) {

                                        for (x = 0; x < numberOfoptions.length; x++) {
                                            if (json[0].employees[i]['employee'] == numberOfoptions[x].value) {
                                                numberOfoptions[x].selected = true
                                                console.log(contador++)
                                            }
                                        }
                                    }
                                })
                        }

                    })

                    .catch((err) => {
                        console.log(err);
                        let message = err.statusText || "Ocurrió un error";
                        $selectTeacher.innerHTML = `Error ${err.status}: ${message}`;
                    });

                if (document.getElementById('hidden-title').value && document.getElementById('hidden-start')) {

                    $id_questions = document.getElementById('hidden-id').value;
                    $url = `../../server/training/all-questions.php?id=${$id_questions}`;

                    fetch($url)
                        .then((res) => (res.ok ? res.json() : Promise.reject(res)))
                        .then((json) => {

                            $contanierQuestions = document.getElementById('container-questions');

                            // console.log(json[0].question);

                            $questionOne.setAttribute('value', json[0].question);
                            $optionAQuestionOne.setAttribute('value', json[0].option_a);
                            $optionBQuestionOne.setAttribute('value', json[0].option_b);
                            $optionCQuestionOne.setAttribute('value', json[0].option_c);
                            $optionDQuestionOne.setAttribute('value', json[0].option_d);

                            if (json[0].correct_response === json[0].option_a) {
                                $correctOptionQuestionOne.options[1].setAttribute('selected', '');
                            } else if (json[0].correct_response === json[0].option_b) {
                                $correctOptionQuestionOne.options[2].setAttribute('selected', '');
                            } else if (json[0].correct_response === json[0].option_c) {
                                $correctOptionQuestionOne.options[3].setAttribute('selected', '');
                            } else if (json[0].correct_response === json[0].option_d) {
                                $correctOptionQuestionOne.options[4].setAttribute('selected', '');
                            }

                            $questionTwo.setAttribute('value', json[1].question);
                            $optionAQuestionTwo.setAttribute('value', json[1].option_a);
                            $optionBQuestionTwo.setAttribute('value', json[1].option_b);
                            $optionCQuestionTwo.setAttribute('value', json[1].option_c);
                            $optionDQuestionTwo.setAttribute('value', json[1].option_d);

                            if (json[1].correct_response === json[1].option_a) {
                                $correctOptionQuestionTwo.options[1].setAttribute('selected', '');
                            } else if (json[1].correct_response === json[1].option_b) {
                                $correctOptionQuestionTwo.options[2].setAttribute('selected', '');
                            } else if (json[1].correct_response === json[1].option_c) {
                                $correctOptionQuestionTwo.options[3].setAttribute('selected', '');
                            } else if (json[1].correct_response === json[1].option_d) {
                                $correctOptionQuestionTwo.options[4].setAttribute('selected', '');
                            }

                            $questionThree.setAttribute('value', json[2].question);
                            $optionAQuestionThree.setAttribute('value', json[2].option_a);
                            $optionBQuestionThree.setAttribute('value', json[2].option_b);
                            $optionCQuestionThree.setAttribute('value', json[2].option_c);
                            $optionDQuestionThree.setAttribute('value', json[2].option_d);

                            if (json[2].correct_response === json[2].option_a) {
                                $correctOptionQuestionThree.options[1].setAttribute('selected', '');
                            } else if (json[2].correct_response === json[2].option_b) {
                                $correctOptionQuestionThree.options[2].setAttribute('selected', '');
                            } else if (json[2].correct_response === json[2].option_c) {
                                $correctOptionQuestionThree.options[3].setAttribute('selected', '');
                            } else if (json[2].correct_response === json[2].option_d) {
                                $correctOptionQuestionThree.options[4].setAttribute('selected', '');
                            }

                            $questionFour.setAttribute('value', json[3].question);
                            $optionAQuestionFour.setAttribute('value', json[3].option_a);
                            $optionBQuestionFour.setAttribute('value', json[3].option_b);
                            $optionCQuestionFour.setAttribute('value', json[3].option_c);
                            $optionDQuestionFour.setAttribute('value', json[3].option_d);

                            if (json[3].correct_response === json[3].option_a) {
                                $correctOptionQuestionFour.options[1].setAttribute('selected', '');
                            } else if (json[3].correct_response === json[3].option_b) {
                                $correctOptionQuestionFour.options[2].setAttribute('selected', '');
                            } else if (json[3].correct_response === json[3].option_c) {
                                $correctOptionQuestionFour.options[3].setAttribute('selected', '');
                            } else if (json[3].correct_response === json[3].option_d) {
                                $correctOptionQuestionFour.options[4].setAttribute('selected', '');
                            }

                            $questionFive.setAttribute('value', json[4].question);
                            $optionAQuestionFive.setAttribute('value', json[4].option_a);
                            $optionBQuestionFive.setAttribute('value', json[4].option_b);
                            $optionCQuestionFive.setAttribute('value', json[4].option_c);
                            $optionDQuestionFive.setAttribute('value', json[4].option_d);

                            if (json[4].correct_response === json[4].option_a) {
                                $correctOptionQuestionFive.options[1].setAttribute('selected', '');
                            } else if (json[4].correct_response === json[4].option_b) {
                                $correctOptionQuestionFive.options[2].setAttribute('selected', '');
                            } else if (json[4].correct_response === json[4].option_c) {
                                $correctOptionQuestionFive.options[3].setAttribute('selected', '');
                            } else if (json[4].correct_response === json[4].option_d) {
                                $correctOptionQuestionFive.options[4].setAttribute('selected', '');
                            }


                            // for (x = 0; x < json.length; x++) {
                            //     if (json[x].correct_response === json[x].option_a) {
                            //         document.getElementsByClassName('select-correct-response')[x].options[1].setAttribute('selected', '');
                            //     } else if (json[x].correct_response === json[x].option_b) {
                            //         document.getElementsByClassName('select-correct-response')[x].options[2].setAttribute('selected', '');
                            //     } else if (json[x].correct_response === json[x].option_c) {
                            //         document.getElementsByClassName('select-correct-response')[x].options[3].setAttribute('selected', '');
                            //     } else if (json[x].correct_response === json[x].option_d) {
                            //         document.getElementsByClassName('select-correct-response')[x].options[4].setAttribute('selected', '');
                            //     }
                            // }
                            return json;
                        })
                       
                        .catch((err) => {
                            console.log(err);
                            let message = err.statusText || "Ocurrió un error";
                            $selectTeacher.innerHTML = `Error ${err.status}: ${message}`;
                        })
                }


            }

            $formPrimary.addEventListener('submit', function(e) {

                if ($selectTranining.value === "") {
                    $errorInputTraining.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorInputTraining.innerHTML = "";
                }
                if ($selectTeacher.value === "") {
                    $errorTeacher.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorTeacher.innerHTML = "";
                }
                if ($selectEmployees.value === "") {
                    $errorEmployees.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorEmployees.innerHTML = "";
                }
                if ($selectStartDate.value === "") {
                    $errorStartDate.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorStartDate.innerHTML = "";
                }
                if ($selectEndDate.value === "") {
                    $errorEndDate.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorEndDate = "";
                }

                //Validate question one
                if ($questionOne.value === "") {
                    $errorQuestionOne.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorQuestionOne.innerHTML = "";
                }
                if ($optionAQuestionOne.value === "") {
                    $errorOptionAQuestionOne.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionAQuestionOne.innerHTML = "";
                }
                if ($optionBQuestionOne.value === "") {
                    $errorOptionBQuestionOne.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionBQuestionOne.innerHTML = "";
                }
                if ($optionCQuestionOne.value === "") {
                    $errorOptionCQuestionOne.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionCQuestionOne.innerHTML = "";
                }
                if ($optionDQuestionOne.value === "") {
                    $errorOptionDQuestionOne.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionDQuestionOne.innerHTML = "";
                }
                if ($correctOptionQuestionOne.value === "") {
                    $errorCorrectOptionQuestionOne.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorCorrectOptionQuestionOne.innerHTML = "";
                }

                //Validate question two
                if ($questionTwo.value === "") {
                    $errorQuestionTwo.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorQuestionTwo.innerHTML = "";
                }
                if ($optionAQuestionTwo.value === "") {
                    $errorOptionAQuestionTwo.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionAQuestionTwo.innerHTML = "";
                }
                if ($optionBQuestionTwo.value === "") {
                    $errorOptionBQuestionTwo.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionBQuestionTwo.innerHTML = "";
                }
                if ($optionCQuestionTwo.value === "") {
                    $errorOptionCQuestionTwo.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionCQuestionTwo.innerHTML = "";
                }
                if ($optionDQuestionTwo.value === "") {
                    $errorOptionDQuestionTwo.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionDQuestionTwo.innerHTML = "";
                }
                if ($correctOptionQuestionTwo.value === "") {
                    $errorCorrectOptionQuestionTwo.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorCorrectOptionQuestionTwo.innerHTML = "";
                }

                //Validate question Three
                if ($questionThree.value === "") {
                    $errorQuestionThree.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorQuestioThree.innerHTML = "";
                }
                if ($optionAQuestionThree.value === "") {
                    $errorOptionAQuestionThree.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionAQuestionThree.innerHTML = "";
                }
                if ($optionBQuestionThree.value === "") {
                    $errorOptionBQuestionThree.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionBQuestionThree.innerHTML = "";
                }
                if ($optionCQuestionThree.value === "") {
                    $errorOptionCQuestionThree.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionCQuestionThree.innerHTML = "";
                }
                if ($optionDQuestionThree.value === "") {
                    $errorOptionDQuestionThree.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionDQuestionThree.innerHTML = "";
                }
                if ($correctOptionQuestionThree.value === "") {
                    $errorCorrectOptionQuestionThree.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorCorrectOptionQuestionThree.innerHTML = "";
                }

                //Validate question Four
                if ($questionFour.value === "") {
                    $errorQuestionFour.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorQuestioFour.innerHTML = "";
                }
                if ($optionAQuestionFour.value === "") {
                    $errorOptionAQuestionFour.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionAQuestionFour.innerHTML = "";
                }
                if ($optionBQuestionFour.value === "") {
                    $errorOptionBQuestionFour.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionBQuestionFour.innerHTML = "";
                }
                if ($optionCQuestionFour.value === "") {
                    $errorOptionCQuestionFour.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionCQuestionFour.innerHTML = "";
                }
                if ($optionDQuestionFour.value === "") {
                    $errorOptionDQuestionFour.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionDQuestionFour.innerHTML = "";
                }
                if ($correctOptionQuestionFour.value === "") {
                    $errorCorrectOptionQuestionFour.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorCorrectOptionQuestionFour.innerHTML = "";
                }

                //Validate question Five
                if ($questionFive.value === "") {
                    $errorQuestionFive.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorQuestioFive.innerHTML = "";
                }
                if ($optionAQuestionFive.value === "") {
                    $errorOptionAQuestionFive.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionAQuestionFive.innerHTML = "";
                }
                if ($optionBQuestionFive.value === "") {
                    $errorOptionBQuestionFive.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionBQuestionFive.innerHTML = "";
                }
                if ($optionCQuestionFive.value === "") {
                    $errorOptionCQuestionFive.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionCQuestionFive.innerHTML = "";
                }
                if ($optionDQuestionFive.value === "") {
                    $errorOptionDQuestionFive.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorOptionDQuestionFive.innerHTML = "";
                }
                if ($correctOptionQuestionFive.value === "") {
                    $errorCorrectOptionQuestionFive.innerHTML = " Requerido";
                    e.preventDefault();
                } else {
                    $errorCorrectOptionQuestionFive.innerHTML = "";
                }

            });

            $selectButtonCancel.addEventListener('click', function() {
                window.location = "/superhumans_mvc/views/training/";
            });
        </script>

        <script src="../../src/styles/js/style.js"></script>
        <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>