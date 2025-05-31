<?php
// Database connection parameters
$servername = "localhost";
$username = "chatlify_chirag";
$password = "Kavya.99";
$database = "chatlify_treddur";

// Create connection 
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$domain = $_SERVER['HTTP_HOST'];