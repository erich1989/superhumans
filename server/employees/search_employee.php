<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

$q = $_REQUEST['p'];

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);
$searchEmployees = $employee->searchEmployees(1, $q);

echo $searchEmployees;