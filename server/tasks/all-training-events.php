<?php

require_once('../../models/database-connection.php');
require_once('../../models/tasks-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$newEvent = new Events($connection->connection);

echo $newEvent->AllTrainingEvents('training');