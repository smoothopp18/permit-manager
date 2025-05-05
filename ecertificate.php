<?php
require_once 'fpdf186/fpdf.php'; 

// Get dynamic values
$name = "Jane Banda"; // You can fetch this from a database or a form
$date = date("F j, Y"); // Today's date

// Create PDF
$pdf = new FPDF('L', 'mm', 'A4'); // Landscape mode
$pdf->AddPage();

// Set background image
$pdf->Image('cert-bg.jpg', 0, 0, 297, 210); // Full page background

// Add logo
$pdf->Image('logo.png', 20, 20, 30); // x, y, width

// Set font for name
$pdf->SetFont('Arial', 'B', 28);
$pdf->SetTextColor(0, 0, 102); // Navy blue

// Position and write name
$pdf->SetXY(0, 110); // Adjust Y to match design
$pdf->Cell(297, 10, $name, 0, 1, 'C');

// Set font for date
$pdf->SetFont('Arial', '', 16);
$pdf->SetTextColor(50, 50, 50);

// Position and write date
$pdf->SetXY(0, 130);
$pdf->Cell(297, 10, "Awarded on: $date", 0, 1, 'C');

// Output PDF
$pdf->Output('I', "certificate_$name.pdf"); // I = inline in browser
?>
