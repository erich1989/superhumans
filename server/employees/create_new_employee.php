<?php

require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');
require_once('../../models/validator-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);
$validator = new Validator();



$employee->firstName = $validator->test_input($_POST['firstname']);
$employee->lastName = $validator->test_input($_POST['lastname']);
$employee->cc = $validator->test_input($_POST['cc']);
$employee->birthday = $validator->test_input($_POST['birthday']);
$employee->position = $validator->test_input($_POST['position']);
$employee->workingArea = $validator->test_input($_POST['area']);
$employee->contractType = $validator->test_input($_POST['contract']);
$employee->phoneNumber = $validator->test_input($_POST['phone']);
$employee->address = $validator->test_input($_POST['address']);
$employee->email = $validator->test_input($_POST['email']);
$employee->salary = $validator->test_input($_POST['salary']);
$employee->arl = $validator->test_input($_POST['arl']);
$employee->ccf = $validator->test_input($_POST['ccf']);
$employee->eps = $validator->test_input($_POST['eps']);
$employee->startDate = $validator->test_input($_POST['startdate']);
$employee->photo = $validator->test_input($_POST['namephoto']);
$employee->pdf = $validator->test_input($_POST['namepdf']);

$createEmployee = $employee->createEmployee();




echo "yes";
