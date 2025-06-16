<?php
session_start(); // Start the session to access session data

// Clear all session variables
$_SESSION = [];

// Terminate the session
session_destroy();

// Redirect to login page
header("Location: index.php");
exit();
?>
