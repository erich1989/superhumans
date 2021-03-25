<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

$id = $_POST['id'];

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);

$employee->endDate = $_POST['enddate'];
$employee->reasonDismissal = $_POST['reasondismissal'];


$deleteEmployee = $employee->deleteEmployee($id);

if ($deleteEmployee) {
    echo $id . "\n";
    echo 'Successful delete';
} else {
    echo "failed delete";
}
