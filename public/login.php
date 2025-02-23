<?php
session_start(); // Ensure session starts at the top
require_once '../classes/User.php';

// Debugging: Check if session is already active
error_log("Session started. ID: " . session_id());

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize email input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Do not sanitize passwords (preserve input)

    // Validate inputs
    if (empty($email) || empty($password)) {
        error_log("Login failed: Empty email or password.");
        echo "<script>alert('Please enter both email and password.'); window.location.href = '../index.php';</script>";
        exit;
    }

    // Create user object and attempt login
    $user = new User();
    $logged_in_user = $user->login($email, $password);

    // If user is found, set session and redirect
    if ($logged_in_user) {
        session_regenerate_id(true); // Prevent session fixation attacks
        $_SESSION['user'] = $logged_in_user;
        
        // Debug: Check if session is properly set
        error_log("User logged in: " . print_r($_SESSION['user'], true));

        // Redirect based on user role
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
                error_log("Unknown role: " . $logged_in_user['role']);
                echo "<script>alert('Unauthorized role. Please contact support.'); window.location.href = '../index.php';</script>";
                exit;
        }
        exit;
    } else {
        // Debug: Log failed login attempt
        error_log("Login failed: Incorrect email or password.");
        echo "<script>alert('Wrong details. Please try again.'); window.location.href = '../index.php';</script>";
        exit;
    }
}
?>
