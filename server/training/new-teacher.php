<?php

require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$teacher = new Teacher($connection->connection);

$teacher->firstName = $_POST['firstname'];
$teacher->lastName = $_POST['lastname'];
$teacher->cc = $_POST['cc'];
$teacher->profession = $_POST['profession'];

$teacher->newTeacher();

header('Location: http://localhost/superhumans_mvc/views/training/new-training.php');
