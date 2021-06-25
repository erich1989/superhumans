<?php

require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');


$title = $_GET['title'];
$start = $_GET['start'];

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$training = new LearningMethod($connection->connection);

echo json_encode($training->selectLearningMethodInformationJson($title, $start));
