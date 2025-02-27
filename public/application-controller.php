<?php
session_start();
require_once '../classes/Application.php';

// Ensure uploads directory exists
$uploadDir = "../uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
}

// Retrieve form data from application form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $nationalId = filter_input(INPUT_POST, 'nationalId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $businessName = filter_input(INPUT_POST, 'businessName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $businessType = filter_input(INPUT_POST, 'businessType', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $businessAddress = filter_input(INPUT_POST, 'businessAddress', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $taxCertificate = filter_input(INPUT_POST, 'taxCertificate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
    // File uploads
    $files = [
        'nationalIdFile' => $_FILES['nationalIdUpload'] ?? null,
        'healthReportFile' => $_FILES['healthInspectionReport'] ?? null,
        'taxClearanceFile' => $_FILES['mraTaxClearance'] ?? null
    ];

    $uploadedPaths = [];

    foreach ($files as $key => $file) {
        if ($file && $file['error'] === 0) {
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = $key . "_" . time() . "." . $fileExtension; // Unique name
            $destination = $uploadDir . $newFileName;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $uploadedPaths[$key] = $destination;
            } else {
                $_SESSION['error_message'] = "File upload failed for {$file['name']}.";
                header("Location: ../applyform.php");
                exit;
            }
        } elseif ($file) {
            $_SESSION['error_message'] = "Error in uploading {$file['name']}.";
            header("Location: ../applyform.php");
            exit;
        }
    }

    // Validate that all fields and files were uploaded
    if (
        empty($nationalId) || empty($businessName) || empty($businessType) || empty($businessAddress) || empty($taxCertificate) || empty($amount) ||
        empty($uploadedPaths['nationalIdFile']) || empty($uploadedPaths['healthReportFile']) || empty($uploadedPaths['taxClearanceFile'])
    ) {
        $_SESSION['error_message'] = "All fields and file uploads are required.";
        header("Location: ../applyform.php");
        exit;
    } else {
        // Create Application object
        $application = new Application();

        // Attempt to apply for the certificate with file paths
        if ($application->apply(
            $nationalId,
            $businessName,
            $businessType,
            $businessAddress,
            $taxCertificate,
            $uploadedPaths['nationalIdFile'],
            $uploadedPaths['healthReportFile'],
            $uploadedPaths['taxClearanceFile'],
            $amount
        )) {
            $_SESSION['success_message'] = "Application successful. You will be notified once your application is processed.";
            header("Location: ../user-dashboard.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Application failed. Please try again.";
            header("Location: ../user-dashboard.php");
            exit;
        }
    }
}

// Handling GET requests for approval, rejection, and payment verification
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $application = new Application();

    if (isset($_GET['approve_id'])) {
        $application_id = intval($_GET['approve_id']); // Ensure it's an integer
        if ($application->approveApplication($application_id)) {
            $_SESSION['success_message'] = "Application approved successfully.";
        } else {
            $_SESSION['error_message'] = "Application approval failed. Please try again.";
        }
        header("Location: ../tlo-dashboard.php");
        exit;
    } elseif (isset($_GET['reject_id'])) {
        $application_id = intval($_GET['reject_id']); // Ensure it's an integer
        if ($application->rejectApplication($application_id)) {
            $_SESSION['success_message'] = "Application rejected successfully.";
        } else {
            $_SESSION['error_message'] = "Application rejection failed. Please try again.";
        }
        header("Location: ../tlo-dashboard.php");
        exit;
    } elseif (isset($_GET['verify_payment'])) {
        $application_id = intval($_GET['verify_payment']); // Ensure it's an integer
        if ($application->verifyPaymentStatus($application_id)) {
            $_SESSION['success_message'] = "Payment verified successfully.";
        } else {
            $_SESSION['error_message'] = "Payment verification failed. Please try again.";
        }
        header("Location: ../tlo-dashboard.php");
        exit;
    }
}
?>
