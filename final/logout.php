<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
// echo "使用者已登出，轉入登入頁面中...";
header('location: index.php');
?>