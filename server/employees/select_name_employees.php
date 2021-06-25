<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employees = new Employee($connection->connection);

$nameEmployees = $employees->selectNameEmployees();

$jsonstring = json_encode($nameEmployees);
echo $jsonstring;