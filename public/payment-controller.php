<?php
require_once '../classes/database.php';
require_once '../classes/payments.php';
require_once '../classes/application.php';
require_once '../classes/user.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = $_POST['application_id'];
    $user_id = $_SESSION['user']['user_id'];
    
    if (isset($_POST['business_type']) && !empty($_POST['business_type'])) {
        $business_type = $_POST['business_type']; // Corrected variable name
    } else {
        header("Location: ../invoice-view.php?status=error&message=missing_business_type");
        exit();
    }

    $database = new Database();
    $db = $database->connect();

    $payments = new Payments($db);
    $application = new Application();

    $data = [
        'application_id' => $application_id,
        'user_id' => $user_id,
        'business_type' => $business_type // Corrected key name
    ];

    if ($payments->create($data)) {
        $application->verifyPaymentStatus($application_id);
        echo "<script>
                alert('Payment successful');
                window.location.href = '../user-dashboard.php';
              </script>";
    } else {
        header("Location: ../invoice-view.php?status=error");
    }
} else {
    header("Location: ../invoice-view.php");
}
?>
