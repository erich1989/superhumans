<?php

require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$teacher = new Teacher($connection->connection);

$teacher->allTeacher();




