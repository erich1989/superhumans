<?php
require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

// echo $_GET['id'];
$id = $_REQUEST['id'];
$ruta;

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);
$employees = $employee->selectAnEmployee($id);
// die();
foreach ($employees as $employee) {
    $ruta = $employee['cv_pdf'];

}

echo '/src/cv-pdf/'.$ruta.'/';
// die();
header('content-type: application/pdf');
header("Content-Disposition: inline; filename=documento.pdf");
readfile('../../src/cv-pdf/'.$ruta);