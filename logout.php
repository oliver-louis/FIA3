<?php
    // Kill Session
    session_start();
    session_destroy();

    // Redirect to Login Page
    header("Location: login.php");
?>