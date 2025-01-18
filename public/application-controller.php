<?php
require_once '../classes/Application.php';
require_once '../config/Database.php';
session_start();  // Ensure session is started to use session variables

// Retrieve form data from application form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs to prevent SQL injection
    $nationalId = filter_input(INPUT_POST, 'nationalId', FILTER_SANITIZE_STRING);
    $businessName = filter_input(INPUT_POST, 'businessName', FILTER_SANITIZE_STRING);
    $businessType = filter_input(INPUT_POST, 'businessType', FILTER_SANITIZE_STRING);
    $businessAddress = filter_input(INPUT_POST, 'businessAddress', FILTER_SANITIZE_STRING);
    $taxCertificate = filter_input(INPUT_POST, 'taxCertificate', FILTER_SANITIZE_STRING);
    $leaseNumber = filter_input(INPUT_POST, 'leaseNumber', FILTER_SANITIZE_STRING);
    
    // Validate the business certificate application form
    if (empty($nationalId) || empty($businessName) || empty($businessType) || empty($businessAddress) || empty($taxCertificate)) {
        $error = "All fields are required.";
    } else {
        // Create a new Application object to access the apply method
        $application = new Application();

        // Attempt to apply for the certificate
        if ($application->apply($nationalId, $businessName, $businessType, $businessAddress, $taxCertificate)) {
            // If successful, set a success message and redirect to the user dashboard
            $_SESSION['success_message'] = "Application successful. You will be notified once your application is processed.";
            header("Location: ../user-dashboard.php");
            exit;  // Stop script execution after redirection
        } else {
            // Application failed
            $error = "Application failed. Please try again.";
        }
    }
}
?>
