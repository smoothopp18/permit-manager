<?php

echo 'form submitted';

// Retrieve form data from application form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    $nationalId = $_POST['nationalId'];
    $businessName = $_POST['businessName'];
    $businessType = $_POST['businessType'];
    $businessAddress = $_POST['businessAddress'];
    $taxCertificate = $_POST['taxCertificate'];

    // Retrieve file uploads
    $uploadNationalId = $_FILES['uploadNationalId'];
    $uploadTaxCertificate = $_FILES['uploadTaxCertificate'];
    $uploadProofOfPremises = $_FILES['uploadProofOfPremises'];
    $uploadHealthSafetyReport = $_FILES['uploadHealthSafetyReport'];
}

// Validate the business certificate application form
if (empty($fullName) || empty($nationalId) || empty($businessName) || empty($businessType) || empty($businessAddress) || empty($taxCertificate) || empty($uploadNationalId['name']) || empty($uploadTaxCertificate['name']) || empty($uploadProofOfPremises['name']) || empty($uploadHealthSafetyReport['name'])) {
    $error = "All fields are required.";
} else {
    // All inputs are valid; proceed with application

    // Create a new Application object to access the apply method
    $application = new Application();

    // Attempt to apply for the certificate
    if ($application->apply($nationalId, $businessName, $businessType, $businessAddress, $taxCertificate,$uploadProofOfPremises, $uploadHealthSafetyReport, $uploadNationalId, $uploadTaxCertificate)) {
        // If successful, set a success message and redirect to the login page
        $_SESSION['success_message'] = "Application successful. You will be notified once your application is processed.";
        header("Location: ../user-dashboard.php");
        exit;  // Stop script execution after redirection
    } else {
        // Application failed
        $error = "Application failed. Please try again.";
    }
}
?>