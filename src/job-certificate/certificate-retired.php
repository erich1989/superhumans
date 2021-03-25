<?php


require('fpdf182/fpdf.php');
require_once('../../models/database-connection.php');
require_once('../../models/employees-class.php');

date_default_timezone_set("America/Bogota");
// setlocale(LC_ALL, 'es_ES.utf-8');

$month = date('F');

$monthNames = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo'];

$date = $monthNames[$month] . date(' d \d\e Y');

$id = $_GET['id'];
$name;

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$employee = new Employee($connection->connection);
$employees = $employee->selectAnEmployee($id);

if (count($employees) > 0) {
    foreach ($employees as $employee) {
        $firstName = $employee['first_name'];
        $lastName = $employee['last_name'];
        $cc = $employee['cc'];
        $StartDate = $employee['start_of_date'];
        $endDate = $employee['end_date'];
        $position = $employee['position'];
        $contractType = $employee['contract_type'];
        $salary = $employee['salary'];
    };
}

function newDate($oldDate)
{
    $newDate = str_replace('-', '/', date('d-m-Y', strtotime($oldDate)));
    return $newDate;
}

$newDate = newDate($StartDate);
$newEndDate = newDate($endDate);

$pdf = new FPDF();
$pdf->SetMargins(20, 35, 20, 18);
$pdf->AddPage('portrait', 'A4');
$pdf->SetFont('Arial', '', 12);
$pdf->Image('../images/logosh.png', 140, 15, 55, 14, 'png');
$pdf->Cell(40, 10, utf8_decode('Medellin, ' . $date));
$pdf->ln(25);
$pdf->Cell(170, 10, utf8_decode('EL DEPARTAMENTO DE GESTIÓN HUMANA'), 0, 0, 'C', false);
$pdf->ln(25);
$pdf->Write(8, utf8_decode('Certifica que él(a) señor(a) '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, strtoupper($firstName) . ' ' . strtoupper($lastName));
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode(' identificado(a) con cédula de ciudadanía número '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, $cc);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode(' laboró al servicio del (empresa xxxxxxx)  desde el '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, $newDate);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, ' hasta el ');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, $newEndDate);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode(' desempeñando el cargo de '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, strtoupper($position));
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, ' con un contrato de ');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, strtoupper($contractType));
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, ' y devengando un salario de ');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, $salary . '.');
$pdf->ln(18);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode('Cualquier información adicional con gusto será suministrada en el teléfono (número tel xxx).'));
$pdf->ln(18);
$pdf->Cell(170, 10, utf8_decode('El presente certificado se expide a solicitud del interesado.'), 0, 0, 'L', false);
$pdf->ln(18);
$pdf->Cell(170, 10, utf8_decode('Cordialmente,'), 0, 0, 'L', false);
$pdf->ln(18);
$pdf->Cell(170, 10, utf8_decode('Nombre de encargado'), 0, 0, 'L', false);
$pdf->ln(8);
$pdf->Cell(170, 10, utf8_decode('Cargo'), 0, 0, 'L', false);
$pdf->ln(8);
$pdf->Cell(170, 10, utf8_decode('Empresa'), 0, 0, 'L', false);
$pdf->ln(8);
$pdf->Cell(170, 10, utf8_decode('Nit'), 0, 0, 'L', false);


$pdf->Output();
