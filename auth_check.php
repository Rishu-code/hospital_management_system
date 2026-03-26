<?php
// Check if a session is already active before starting a new one
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Your existing auth logic below...
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>