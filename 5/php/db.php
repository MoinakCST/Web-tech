<?php
// Database connection for Assignment-5.
// Database: college
// Table: students1
//
// If your teacher requires the table to be named after your roll number,
// change TABLE_NAME below and use the same name in sql/college.sql.

$host = "localhost";
$user = "root";
$password = "";
$database = "college";
$table = "students1";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    http_response_code(500);
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
