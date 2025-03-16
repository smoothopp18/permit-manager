<?php 
require_once '../classes/Application.php';
require_once '../classes/session.php';

// Ensure uploads directory exists
$uploadDir = "../uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nationalId = filter_input(INPUT_POST, 'nationalId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $businessName = filter_input(INPUT_POST, 'businessName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $businessTypeId= filter_input(INPUT_POST, 'businessType', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $businessAddress = filter_input(INPUT_POST, 'businessAddress', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $taxCertificate = filter_input(INPUT_POST, 'taxCertificate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // File upload handling
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
            $_SESSION['error_message'] = "Error uploading {$file['name']}.";
            header("Location: ../applyform.php");
            exit;
        }
    }



    // Validate all inputs and file uploads
    if (
        empty($nationalId) || empty($businessName) || empty($businessTypeId) || empty($businessAddress) || empty($taxCertificate) || 
        empty($uploadedPaths['nationalIdFile']) || empty($uploadedPaths['healthReportFile']) || empty($uploadedPaths['taxClearanceFile'])
    ) {
        $_SESSION['error_message'] = "All fields and file uploads are required.";
        header("Location: ../applyform.php");
        exit;
    }

    // Create Application object and attempt application submission
    $application = new Application();
    $result = $application->apply(
        $nationalId,
        $businessName,
        $businessTypeId,
        $businessAddress,
        $taxCertificate,
        $uploadedPaths['nationalIdFile'],
        $uploadedPaths['healthReportFile'],
        $uploadedPaths['taxClearanceFile'],
    );

    if ($result) {
        $_SESSION['success_message'] = "Application successful. You will be notified once your application is processed.";
        header("Location: ../user-dashboard.php");
        exit;
    } else {
        $error_message = "Application failed. Please try again.";
        echo "<p>{$error_message}</p>";
        echo "<p>Error details: " . htmlspecialchars($application->getLastError()) . "</p>";
        $_SESSION['error_message'] = $error_message;
        header("Location: ../applyform.php");
        exit;
    }
}

// Handling GET requests for approval, rejection, and payment verification
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $application = new Application();

    // Approve application
    if (isset($_GET['approve_id'])) {
        $application_id = intval($_GET['approve_id']);
        if ($application->approveApplication($application_id)) {
            $_SESSION['success_message'] = "Application approved successfully.";
        } else {
            $_SESSION['error_message'] = "Application approval failed. Please try again.";
        }
        header("Location: ../tlo-dashboard.php");
        exit;
    }

    // Reject application
    if (isset($_GET['reject_id'])) {
        $application_id = intval($_GET['reject_id']);
        if ($application->rejectApplication($application_id)) {
            $_SESSION['success_message'] = "Application rejected successfully.";
        } else {
            $_SESSION['error_message'] = "Application rejection failed. Please try again.";
        }
        header("Location: ../tlo-dashboard.php");
        exit;
    }

    // Verify payment status
    if (isset($_GET['verify_payment'])) {
        $application_id = intval($_GET['verify_payment']);
        if ($application->verifyPaymentStatus($application_id)) {
            $_SESSION['success_message'] = "Payment verified successfully.";
        } else {
            $_SESSION['error_message'] = "Payment verification failed. Please try again.";
        }
        header("Location: ../doc-dashboard.php");
        exit;
    }
}
?>