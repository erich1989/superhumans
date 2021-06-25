<?php

date_default_timezone_set("America/Bogota");
setlocale(LC_ALL, 'es_ES.utf-8');

require('fpdf182/fpdf.php');

require_once('../../models/database-connection.php');
require_once('../../models/training-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$training = new LearningMethod($connection->connection);
$selectAnTraining = new Training($connection->connection);

$title = $_GET['titulo'];
$start = $_GET['fecha-inicio'];
$end = $_GET['fecha-fin'];

$oneTraining = $training->selectLearningMethodInformation($title, $start);
$infoTraining = $selectAnTraining->selectTraining($title);

$objetive = $oneTraining[0]['objetive'];
$teacher = $oneTraining[0]['teacher'];

$fechaComoEnteroInicio = strtotime($start);
$fechaComoEnteroFin = strtotime($end);


$age = date("Y", $fechaComoEnteroInicio);
$day = date("d", $fechaComoEnteroInicio);

$startTime = date("h:i A ", $fechaComoEnteroInicio);
$endTime = date("h:i A ", $fechaComoEnteroFin);

$monthTraining = date("F", $fechaComoEnteroInicio);


// setlocale(LC_ALL, 'es_ES.utf-8');

$month = date('F');

$monthNames = ['January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo', 'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio', 'July' => 'Julio', 'August' => 'Agosto', 'September'=> 'Septiembre', 'October'=> 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre'];

$dias = ['Monday' => 'lunes', 'Tuesday' => 'martes', 'Wednesday' => 'miércoles', 'Thursday' => 'jueves', 'Friday' => 'viernes', 'Saturday' => 'sábado', 'Sunday' => 'domingo'];

$dateOne = $day . " " . $monthNames[$monthTraining] . " del " . $age;

$date = $monthNames[$month] . date(' d \d\e Y');


$pdf = new FPDF();
$pdf->SetMargins(20, 35, 20, 18);
$pdf->AddPage('portrait', 'A4');
$pdf->SetFont('Arial', '', 12);
$pdf->Image('../images/logosh.png', 140, 15, 55, 14, 'png');
$pdf->Cell(40, 10, utf8_decode('Medellin, ' . $date));
$pdf->ln(25);
$pdf->Cell(170, 10, utf8_decode('EL DEPARTAMENTO DE GESTIÓN HUMANA'), 0, 0, 'C', false);
$pdf->ln(25);
$pdf->Write(8, utf8_decode('Certifica que el dia '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, $dateOne);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode(' se realizó la capacitación '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, strtoupper($title));
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode(' de '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, $startTime);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, ' hasta ');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, $endTime);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode(', la cual tiene como objetivo '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, utf8_decode($objetive . '.'));
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode(' Esta capacitación estuvo a cargo de el señor(a) '));
$pdf->SetFont('Arial', 'B', 12);
$pdf->Write(8, strtoupper($teacher));
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode(' y asistieron los siguientes empleados: '));
$pdf->ln(14);
$pdf->SetFont('Arial', '', 11);
for ($i = 0; $i < count($oneTraining[0]['employees']); $i++) {
    $pdf->Write(8,' '.' '.' '.($i+1).'.'.' '.strtoupper($oneTraining[0]['employees'][$i]['employee']));
    $pdf->ln(5);
}
$pdf->ln(14);
$pdf->SetFont('Arial', '', 12);
$pdf->Write(8, utf8_decode('La presente capacitación es aprobada por: '));
$pdf->ln(30);

$pdf->Cell(55,10,'Nombre de encargado',0,0,'C');
$pdf->Cell(55,10,'Nombre de encargado',0,0,'C');
$pdf->Cell(55,10,'Nombre de encargado',0,1,'C');
$pdf->Cell(55,10,'Cargo',0,0,'C');
$pdf->Cell(55,10,'Cargo',0,0,'C');
$pdf->Cell(55,10,'Cargo',0,0,'C');


$pdf->Output();
