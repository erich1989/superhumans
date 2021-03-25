<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);
$employees = $employee->selectAllEmployees(0);

$jsonstring = json_encode($employees);
echo $jsonstring;
