<?php
// Database configuration
define('DB_HOST', 'mysql');
define('DB_USER', 'user');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'login_db');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

session_start();
?>
