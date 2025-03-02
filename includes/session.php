<?php
session_start(); // Ensure session is started before accessing session variables

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: /index.php");
    exit();
}

// Function to check user role
function checkUserRole($required_role) {
    if ($_SESSION['user_role'] !== $required_role) {
        header("Location: /index.php");
        exit();
    }
}

// Function to log out the user
function logout() {
    session_unset();
    session_destroy();
    header("Location: /index.php");
    exit();
}
?>