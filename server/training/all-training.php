<?php
require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$training = new Training($connection->connection);

$training->allTraining();