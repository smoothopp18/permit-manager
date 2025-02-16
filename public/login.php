<?php

session_start();
require_once '../classes/User.php';

// Check if the login form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and retrieve the email input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Retrieve the password input (without sanitization to preserve its exact form)
    $password = $_POST['password'];

    // Validate that both email and password fields are filled
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $user = new User();
        $logged_in_user = $user->login($email, $password);

        if ($logged_in_user && $logged_in_user['role'] == 'business_owner') {
            $_SESSION['user'] = $logged_in_user;
            header("Location: ../user-dashboard.php");
        } elseif ($logged_in_user && $logged_in_user['role'] == 'trading_officer') {
            $_SESSION['user'] = $logged_in_user;
            header("Location: ../tlo-dashboard.php");
        } elseif ($logged_in_user && $logged_in_user['role'] == 'ceo') {
            $_SESSION['user'] = $logged_in_user;
            header("Location: ../ceo-dashboard.php");
        } elseif ($logged_in_user && $logged_in_user['role'] == 'director_commerce') {
            $_SESSION['user'] = $logged_in_user;
            header("Location: ../doc-dashboard.php");
        } else {
            echo "<script>alert('Wrong details. Please try again.'); window.location.href = '../index.php';</script>";
        }
    }
}
?>
