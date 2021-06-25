<?php
require_once('../../models/database-connection.php');
require_once('../../models/evaluation-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$evaluationQuestions = new Question($connection->connection);
$id = $_GET['id'];
echo $questions =  $evaluationQuestions->selectQuestionsJson($id);