<?php
require_once 'classes/fpdf/fpdf.php';
require_once 'classes/application.php';
require_once 'classes/user.php';
require_once 'classes/invoice.php';

// Assume you get the application ID from a GET parameter
$appId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$application = null;
if ($appId > 0) {
    $appObj = new Application();
    $application = $appObj->getApplicationById($appId); // You need to implement this method if not present
}

if (!$application) {
    die("Certificate data not found.");
}
// Debug: print application data
// Remove or comment this out in production!
// echo '<pre>'; print_r($application); exit;

// Dynamic values from DB
$name = $application['businessName'];
$issue_date = date("F j, Y", strtotime($application['issueDate']));
$expiry_date = date("F j, Y", strtotime($application['expiryDate']));
$type_of_business = $application['businessType'];
$amount_paid = "K" . number_format($application['amount'], 2);

// Create PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

// Set background image
$pdf->Image('certificate-background.jpg', 0, 0, 297, 210);

// Add logo
$pdf->Image('logo.png', 20, 20, 30);

// Add watermark (large, diagonal)
$pdf->SetFont('Arial', 'B', 60);
$pdf->SetTextColor(220, 220, 220);
$pdf->SetXY(0, 80);
// $pdf->Rotate(30, 148, 105);
$pdf->Cell(297, 40, 'PERMIT MANAGER', 0, 1, 'C');
// $pdf->Rotate(0);

// Add a second watermark for style
$pdf->SetFont('Arial', 'B', 30);
$pdf->SetTextColor(200, 200, 255);
$pdf->SetXY(0, 170);
// $pdf->Rotate(-20, 148, 170);
$pdf->Cell(297, 20, 'OFFICIAL CERTIFICATE', 0, 1, 'C');
// $pdf->Rotate(0);

// Set font for name
$pdf->SetFont('Arial', 'B', 28);
$pdf->SetTextColor(0, 0, 102);
$pdf->SetXY(0, 110);
$pdf->Cell(297, 10, $name, 0, 1, 'C');

// Set font for details
$pdf->SetFont('Arial', '', 16);
$pdf->SetTextColor(50, 50, 50);

// Issue Date
$pdf->SetXY(40, 140);
$pdf->Cell(80, 10, "Issue Date: $issue_date", 0, 0, 'L');

// Expiry Date
$pdf->SetXY(110, 140);
$pdf->Cell(80, 10, "Expiry Date: $expiry_date", 0, 0, 'L');

// Type of Business
$pdf->SetXY(180, 140);
$pdf->Cell(80, 10, "Type: $type_of_business", 0, 0, 'L');

// Amount Paid
$pdf->SetXY(40, 155);
$pdf->Cell(80, 10, "Amount Paid: $amount_paid", 0, 0, 'L');

// Output PDF
$pdf->Output('I', "certificate_$name.pdf");

// --- Helper function for rotation ---
function Rotate($angle, $x = -1, $y = -1)
{
    global $pdf;
    if ($x == -1)
        $x = $pdf->GetX();
    if ($y == -1)
        $y = $pdf->GetY();
    if ($angle != 0) {
        $angle *= M_PI / 180;
        $c = cos($angle);
        $s = sin($angle);
        $cx = $x * $pdf->k;
        $cy = ($pdf->h - $y) * $pdf->k;
        $pdf->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy));
    } else
        $pdf->_out('Q');
}
$pdf->Rotate = function($angle, $x = -1, $y = -1) use ($pdf) {
    Rotate($angle, $x, $y);
};
?>
