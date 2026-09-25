<?php
require_once "db.php";

$name = trim($_POST["name"] ?? "");
$gender = trim($_POST["gender"] ?? "");
$course = trim($_POST["course"] ?? "");
$marks = $_POST["marks"] ?? "";
$email = trim($_POST["email"] ?? "");
$source = $_POST["source"] ?? ""; // Hidden element

if ($source !== "assignment5" || $name === "" || $gender === "" || $course === "" || $email === "" || $marks === "") {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Please fill all fields correctly."]);
    exit;
}

if (!is_numeric($marks) || $marks < 0 || $marks > 100) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Marks must be between 0 and 100."]);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO `$table` (name, gender, course, marks, email) VALUES (?, ?, ?, ?, ?)"
);
$marks = (int)$marks;
$stmt->bind_param("sssis", $name, $gender, $course, $marks, $email);

header("Content-Type: application/json");

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Record inserted successfully."]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Insert failed: " . $stmt->error]);
}
?>
