<?php
session_start();
// Include the User class to access registration functionality
require_once '../classes/User.php';

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize and retrieve user input from the form
    $firstname = filter_input(INPUT_POST, 'firstname');                   // Get and sanitize the first name
    $lastname = filter_input(INPUT_POST, 'surname');                     // Get and sanitize the last name
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);  // Sanitize the email input
    $password = $_POST['password'];                                    // Retrieve the password
    $passwordconfirm = $_POST['passwordconfirm'];                     // Retrieve the password confirmation
    $role = 'business_owner';                                        // Set default role for registration

    // Check if any of the fields are empty
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordconfirm)) {
        $error = "All fields are required.";  // Error message for incomplete form
    }
    // Check if password and confirmation match
    elseif ($password !== $passwordconfirm) {
        $error = "Passwords do not match.";   // Error message for mismatched passwords
    } else {
        // All inputs are valid; proceed with registration

        // Create a new User object to access the register method
        $user = new User();

        // Combine first and last name into a full name
        $fullname = trim("$firstname $lastname");

        // Attempt to register the user
        if ($user->register($fullname, $email, $password, $role)) {
            // If successful, set a success message and redirect to the login page
            $_SESSION['success_message'] = "Registration successful. You can now log in.";
            header("Location: ../index.php");
            exit;  // Stop script execution after redirection
        } else {
            // Registration failed, possibly due to duplicate email
            $error = "Registration failed. Email might already be in use.";
        }
    }
}

