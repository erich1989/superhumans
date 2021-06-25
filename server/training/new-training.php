<?php

require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$training = new Training($connection->connection);

$training->title = $_POST['titleevent'];
$training->type = $_POST['type'];


echo $training->title;
echo '<br>';
echo $training->type;


$training->newTraining();

header('Location: http://localhost/superhumans_mvc/views/training/new-learning-method.php');
