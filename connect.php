<?php

$servername = "localhost";
$username = "root";
$password = "q1w2e3123*";
$database = "encrypter";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 ?>
