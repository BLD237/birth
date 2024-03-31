<?php
$name = 'mufor belmond';
require_once('vendor/autoload.php');

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetTitle('Birth Certificate');
$pdf->SetAuthor('John Doe');
$pdf->SetSubject('Birth Certificate');

$pdf->SetDefaultMonospacedFont('helvetica');

$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 7, 'Birth Certificate', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 15);
$pdf->Cell(0, 7, "Name: $name ", 0, 1);
$pdf->Cell(0, 7, "Date", 0, 1);
$pdf->Cell(0, 7, 'Date of Birth: January 1, 2000', 0, 1 ,'R');
$pdf->Cell(0, 7, 'Gender: Male', 0, 1);
$pdf->Cell(0, 7, 'Father\'s Name: John Doe', 0, 1);
$pdf->Cell(0, 7, 'Mother\'s Name: Jane Doe', 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 5, 'Signature of Attending Physician:', 0, 1, 'R');
$pdf->Cell(0, 5, '', 0, 1, 'R');
$pdf->Cell(0, 5, '', 0, 1, 'R');
$pdf->Cell(0, 5, '_______________________', 0, 1, 'R');

$pdf->Cell(0, 7, 'Signature of Registrar:', 0, 1, 'L');

$pdf->Output("$name.pdf", 'I');
?>