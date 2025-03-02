<?php
session_start(); // Ensure session is started before accessing session variables

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: index.php");
exit();
?>
