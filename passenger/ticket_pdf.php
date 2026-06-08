<?php
include '../config/db.php';
require('../fpdf/fpdf.php');

$booking_id = $_GET['id'];

$data = $conn->query("
SELECT b.*, f.flight_number, f.origin, f.destination
FROM bookings b
JOIN flights f ON b.flight_id = f.id
WHERE b.id='$booking_id'
")->fetch_assoc();

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'MTUI AIRMODE TICKET');

$pdf->Ln(10);
$pdf->SetFont('Arial','',12);

$pdf->Cell(40,10,'Ticket: '.$data['ticket_number']);
$pdf->Ln();
$pdf->Cell(40,10,'Flight: '.$data['flight_number']);
$pdf->Ln();
$pdf->Cell(40,10,'Route: '.$data['origin'].' -> '.$data['destination']);
$pdf->Ln();
$pdf->Cell(40,10,'Status: '.$data['payment_status']);

$pdf->Output();
?>