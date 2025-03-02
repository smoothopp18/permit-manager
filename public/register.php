<?php
session_start();
require_once '../classes/User.php';

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and retrieve user input from the form
    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastname = filter_input(INPUT_POST, 'surname');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $passwordconfirm = $_POST['passwordconfirm'];
    $role = 'business_owner';
    $phone = filter_input(INPUT_POST, 'phone');

    // Check if any of the fields are empty
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordconfirm) || empty($phone)) {
        $error = "All fields are required.";
    }
    // Check if password and confirmation match
    elseif ($password !== $passwordconfirm) {
        $error = "Passwords do not match.";
    } else {
        $user = new User();
        $fullname = trim("$firstname $lastname");

        // Attempt to register the user
        if ($user->register($fullname, $email, $password, $role, $phone)) {
            $_SESSION['success_message'] = "Registration successful. You can now log in.";
            header("Location: ../index.php");
            exit;
        } else {
            $error = "Registration failed. Email might already be in use.";
        }
    }
}
?>
