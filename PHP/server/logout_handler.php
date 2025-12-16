<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Destroy the session
session_destroy();

// Clear session variables
$_SESSION = array();

// Redirect to login page
header("Location: ../index.php");
exit();

} else {
    // If the user tries to access this script directly without submitting the form
    header("Location: ../index.php");
    exit;
}
?>