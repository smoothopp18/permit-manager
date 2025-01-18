<?php

require_once '../classes/User.php';

// Check if the login form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and retrieve the email input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Retrieve the password input (without sanitization to preserve its exact form)
    $password = $_POST['password'];

    // Validate that both email and password fields are filled
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";  // Error if any field is empty
    } else {
        // Create a new User object to use the login method
        $user = new User();

        // Attempt to authenticate the user with the provided credentials
        $logged_in_user = $user->login($email, $password);

        // If login is successful and the user role is 'business_owner'
        if ($logged_in_user && $logged_in_user['role'] == 'business_owner') {
            $_SESSION['user'] = $logged_in_user;           // Store user data in session
            header("Location: ../user-dashboard.php");     // Redirect to Business Owner dashboard

            // If login is successful and the user role is 'trading_officer'
        } elseif ($logged_in_user && $logged_in_user['role'] == 'trading_officer') {
            $_SESSION['user'] = $logged_in_user;           // Store user data in session
            header("Location: ../tlo-dashboard.php");      // Redirect to Trading & Licensing Officer dashboard

            // If login is successful and the user role is 'ceo'
        } elseif ($logged_in_user && $logged_in_user['role'] == 'ceo') {
            $_SESSION['user'] = $logged_in_user;           // Store user data in session
            header("Location: ../ceo-dashboard.php");      // Redirect to CEO dashboard

            // If login is successful and the user role is 'health_officer'
        } elseif ($logged_in_user && $logged_in_user['role'] == 'health_officer') {
            $_SESSION['user'] = $logged_in_user;           // Store user data in session
            header("Location: ../ho-dashboard.php");       // Redirect to Health Officer dashboard

            // If login is successful and the user role is 'director_commerce'
        } elseif ($logged_in_user && $logged_in_user['role'] == 'director_commerce') {
            $_SESSION['user'] = $logged_in_user;           // Store user data in session
            header("Location: ../doc-dashboard.php");      // Redirect to Director of Commerce dashboard
        }
    }
}
