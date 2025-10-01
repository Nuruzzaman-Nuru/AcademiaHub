<?php
$servername = "localhost";
$user = "root";
$password = "";
$dbname = "portal";

// Create connection with error checking
$conn = new mysqli($servername, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

// Set the correct charset
$conn->set_charset("utf8mb4");
?>