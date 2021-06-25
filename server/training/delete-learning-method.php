<?php

require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');
require_once('../../models/tasks-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$learningMethod = new LearningMethod($connection->connection);
$newEvent = new Events($connection->connection);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['titledelete'];
    $start = $_POST['startdelete'];

    echo $title;
    echo '<br>';
    echo $start;
    echo '<br>';

    $learningMethod->deleteLearningMethod($title, $title);
    $newEvent->deleteEvent($title, $start);
    header('Location: http://localhost/superhumans_mvc/views/training/');
}
