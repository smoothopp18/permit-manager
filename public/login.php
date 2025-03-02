<?php
session_start(); // Ensure session is started before accessing session variables
require_once '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $user = new User();
    $logged_in_user = $user->login($email, $password);

    if ($logged_in_user) {
        $_SESSION['user'] = $logged_in_user;
        switch ($logged_in_user['role']) {
            case 'business_owner':
                header("Location: ../user-dashboard.php");
                break;
            case 'trading_officer':
                header("Location: ../tlo-dashboard.php");
                break;
            case 'chief_executive_officer':
                header("Location: ../ceo-dashboard.php");
                break;
            case 'director_commerce':
                header("Location: ../doc-dashboard.php");
                break;
            default:
                echo "<script>alert('Unauthorized role. Please contact support.'); window.location.href = '../index.php';</script>";
                exit;
        }
        exit;
    } else {
        echo "<script>alert('Incorrect email or password. Please try again.'); window.location.href = '../index.php';</script>";
        exit;
    }
}
?>
