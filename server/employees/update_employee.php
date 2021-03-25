<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);

$id = $_POST['id'];

$employee->firstName = $_POST['firstname'];
$employee->lastName = $_POST['lastname'];
$employee->cc = $_POST['cc'];
$employee->birthday = $_POST['birthday'];
$employee->position = $_POST['position'];
$employee->workingArea = $_POST['area'];
$employee->contractType = $_POST['contract'];
$employee->phoneNumber = $_POST['phone'];
$employee->address = $_POST['address'];
$employee->email = $_POST['email'];
$employee->salary = $_POST['salary'];
$employee->arl = $_POST['arl'];
$employee->ccf = $_POST['ccf'];
$employee->eps = $_POST['eps'];
$employee->startDate = $_POST['startdate'];

$updateEmployee = $employee->updateEmployee($id);

if ($updateEmployee) {
    echo $id . "\n";
    echo $employee->firstName . "\n";
    echo $employee->lastName . "\n";
    echo "successful update";
}else{
    echo "failed update";
}
