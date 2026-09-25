<?php

$host = "localhost";
$user = "root";
$password = "6294577710m";
$database = "college";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>