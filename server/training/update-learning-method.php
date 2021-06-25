<?php

require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');
require_once('../../models/tasks-class.php');
require_once('../../models/evaluation-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$learningMethod = new LearningMethod($connection->connection);
$newEvent = new Events($connection->connection);
$newEvaluation = new Evaluation($connection->connection);
$newQuestion = new Question($connection->connection);


if (isset($_POST['training']) && isset($_POST['startDate'])) {

    $titleTraining = $_POST['training'];
    $startTraining = $_POST['startDate'];
    $oldTitle = $_POST['old-title'];
    $oldStart = $_POST['old-start'];
    $idEvaluations = $_POST['id'];

    echo $titleTraining;
    echo '<br>';
    echo $startTraining;
    echo '<br>';

    $learningMethod->deleteLearningMethod($oldTitle, $oldStart);
    $newEvent->deleteEvent($oldTitle, $oldStart);
    $newQuestion->deleteEvalauationQuestions($idEvaluations);
    $newEvaluation->deleteEvaluation($oldTitle, $oldStart);

    //Create training_teacher_employee
    $employees = $_POST['employees'];

    for ($i = 0; $i < count($employees); $i++) {
        $learningMethod->nameTraining = $_POST['training'];
        $learningMethod->nameTeacher = $_POST['teacher'];
        $learningMethod->objetive = $_POST['objetive'];
        $learningMethod->nameEmployee = $employees[$i];
        $learningMethod->start = $_POST['startDate'];
        $learningMethod->end = $_POST['endDate'];
        $learningMethod->newLearningMethod();
        echo '<br> id employee ' . $i . ':' . ' ' . $employees[$i];
    }
    echo '<br>';
    echo $_POST['startDate'];
    echo '<br>';
    echo $_POST['endDate'];
    echo '<br>';
    echo $_POST['gridRadios'];

    $newEvent->title = $_POST['training'];
    $newEvent->allDay = 0;
    $newEvent->start = $_POST['startDate'];
    $newEvent->end = $_POST['endDate'];
    $newEvent->className = "primary";
    $newEvent->type = "training";
    $newEvent->createEvent();

    $newEvaluation->competence = $_POST['training'];
    $newEvaluation->startDate = $_POST['startDate'];
    $newEvaluation->endDate = $_POST['endDate'];
    $newEvaluation->createNewEvaluation();


    //Create new Question of evaluation

    $idEvaluation = $newEvaluation->allEvaluationInformation($_POST['training'], $_POST['startDate']);
    var_dump($idEvaluation[0]['id']);
    echo '<br>';
    echo '<br>';
    echo $newQuestion->idEvaluation = $idEvaluation[0]['id'];
    echo '<br>';
    echo $newQuestion->question = $_POST['questionone'];
    echo '<br>';

    if ($_POST['correctOptionQuestionOne'] === 'a') {
        echo $newQuestion->correctResponse = $_POST['optionAQuestionOne'];
    } else {
        if ($_POST['correctOptionQuestionOne'] === 'b') {
            echo $newQuestion->correctResponse = $_POST['optionBQuestionOne'];
        } else {
            if ($_POST['correctOptionQuestionOne'] === 'c') {
                echo $newQuestion->correctResponse = $_POST['optionCQuestionOne'];
            } else {
                if ($_POST['correctOptionQuestionOne'] === 'd') {
                    echo $newQuestion->correctResponse = $_POST['optionDQuestionOne'];
                }
            }
        }
    }

    echo '<br>';
    echo $newQuestion->optionA = $_POST['optionAQuestionOne'];
    echo '<br>';
    echo $newQuestion->optionB = $_POST['optionBQuestionOne'];
    echo '<br>';
    echo $newQuestion->optionC = $_POST['optionCQuestionOne'];
    echo '<br>';
    echo $newQuestion->optionD = $_POST['optionDQuestionOne'];
    echo '<br>';

    $newQuestion->createNewEvaluationQuestion();

    //Question two
    echo '<br>';
    echo '<br>';
    echo $newQuestion->idEvaluation = $idEvaluation[0]['id'];
    echo '<br>';
    echo $newQuestion->question = $_POST['questionTwo'];
    echo '<br>';

    if ($_POST['correctOptionQuestionTwo'] === 'a') {
        echo $newQuestion->correctResponse = $_POST['optionAQuestionTwo'];
    } else {
        if ($_POST['correctOptionQuestionTwo'] === 'b') {
            echo $newQuestion->correctResponse = $_POST['optionBQuestionTwo'];
        } else {
            if ($_POST['correctOptionQuestionTwo'] === 'c') {
                echo $newQuestion->correctResponse = $_POST['optionCQuestionTwo'];
            } else {
                if ($_POST['correctOptionQuestionTwo'] === 'd') {
                    echo $newQuestion->correctResponse = $_POST['optionDQuestionTwo'];
                }
            }
        }
    }

    echo '<br>';
    echo $newQuestion->optionA = $_POST['optionAQuestionTwo'];
    echo '<br>';
    echo $newQuestion->optionB = $_POST['optionBQuestionTwo'];
    echo '<br>';
    echo $newQuestion->optionC = $_POST['optionCQuestionTwo'];
    echo '<br>';
    echo $newQuestion->optionD = $_POST['optionDQuestionTwo'];
    echo '<br>';

    $newQuestion->createNewEvaluationQuestion();

    //Question three
    echo '<br>';
    echo '<br>';
    echo $newQuestion->idEvaluation = $idEvaluation[0]['id'];
    echo '<br>';
    echo $newQuestion->question = $_POST['questionThree'];
    echo '<br>';

    if ($_POST['correctOptionQuestionThree'] === 'a') {
        echo $newQuestion->correctResponse = $_POST['optionAQuestionThree'];
    } else {
        if ($_POST['correctOptionQuestionThree'] === 'b') {
            echo $newQuestion->correctResponse = $_POST['optionBQuestionThree'];
        } else {
            if ($_POST['correctOptionQuestionThree'] === 'c') {
                echo $newQuestion->correctResponse = $_POST['optionCQuestionThree'];
            } else {
                if ($_POST['correctOptionQuestionThree'] === 'd') {
                    echo $newQuestion->correctResponse = $_POST['optionDQuestionThree'];
                }
            }
        }
    }

    echo '<br>';
    echo $newQuestion->optionA = $_POST['optionAQuestionThree'];
    echo '<br>';
    echo $newQuestion->optionB = $_POST['optionBQuestionThree'];
    echo '<br>';
    echo $newQuestion->optionC = $_POST['optionCQuestionThree'];
    echo '<br>';
    echo $newQuestion->optionD = $_POST['optionDQuestionThree'];
    echo '<br>';

    $newQuestion->createNewEvaluationQuestion();

    //Question four
    echo '<br>';
    echo '<br>';
    echo $newQuestion->idEvaluation = $idEvaluation[0]['id'];
    echo '<br>';
    echo $newQuestion->question = $_POST['questionFour'];
    echo '<br>';

    if ($_POST['correctOptionQuestionFour'] === 'a') {
        echo $newQuestion->correctResponse = $_POST['optionAQuestionFour'];
    } else {
        if ($_POST['correctOptionQuestionFour'] === 'b') {
            echo $newQuestion->correctResponse = $_POST['optionBQuestionFour'];
        } else {
            if ($_POST['correctOptionQuestionFour'] === 'c') {
                echo $newQuestion->correctResponse = $_POST['optionCQuestionFour'];
            } else {
                if ($_POST['correctOptionQuestionFour'] === 'd') {
                    echo $newQuestion->correctResponse = $_POST['optionDQuestionFour'];
                }
            }
        }
    }

    echo '<br>';
    echo $newQuestion->optionA = $_POST['optionAQuestionFour'];
    echo '<br>';
    echo $newQuestion->optionB = $_POST['optionBQuestionFour'];
    echo '<br>';
    echo $newQuestion->optionC = $_POST['optionCQuestionFour'];
    echo '<br>';
    echo $newQuestion->optionD = $_POST['optionDQuestionFour'];
    echo '<br>';

    $newQuestion->createNewEvaluationQuestion();

    //Question four
    echo '<br>';
    echo '<br>';
    echo $newQuestion->idEvaluation = $idEvaluation[0]['id'];
    echo '<br>';
    echo $newQuestion->question = $_POST['questionFive'];
    echo '<br>';

    if ($_POST['correctOptionQuestionFive'] === 'a') {
        echo $newQuestion->correctResponse = $_POST['optionAQuestionFive'];
    } else {
        if ($_POST['correctOptionQuestionFive'] === 'b') {
            echo $newQuestion->correctResponse = $_POST['optionBQuestionFive'];
        } else {
            if ($_POST['correctOptionQuestionFive'] === 'c') {
                echo $newQuestion->correctResponse = $_POST['optionCQuestionFive'];
            } else {
                if ($_POST['correctOptionQuestionFive'] === 'd') {
                    echo $newQuestion->correctResponse = $_POST['optionDQuestionFive'];
                }
            }
        }
    }

    echo '<br>';
    echo $newQuestion->optionA = $_POST['optionAQuestionFive'];
    echo '<br>';
    echo $newQuestion->optionB = $_POST['optionBQuestionFive'];
    echo '<br>';
    echo $newQuestion->optionC = $_POST['optionCQuestionFive'];
    echo '<br>';
    echo $newQuestion->optionD = $_POST['optionDQuestionFive'];
    echo '<br>';

    $newQuestion->createNewEvaluationQuestion();


    header('Location: http://localhost/superhumans_mvc/views/training/');
}
