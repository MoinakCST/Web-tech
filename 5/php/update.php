<?php
require_once "db.php";

$id = (int)($_POST["id"] ?? 0);
$name = trim($_POST["name"] ?? "");
$gender = trim($_POST["gender"] ?? "");
$course = trim($_POST["course"] ?? "");
$marks = $_POST["marks"] ?? "";
$email = trim($_POST["email"] ?? "");

header("Content-Type: application/json");

if ($id <= 0 || $name === "" || $gender === "" || $course === "" || $email === "" || $marks === "") {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit;
}

if (!is_numeric($marks) || $marks < 0 || $marks > 100) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Marks must be between 0 and 100."]);
    exit;
}

$stmt = $conn->prepare(
    "UPDATE `$table` SET name=?, gender=?, course=?, marks=?, email=? WHERE id=?"
);
$marks = (int)$marks;
$stmt->bind_param("sssisi", $name, $gender, $course, $marks, $email, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Record updated successfully."]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Update failed: " . $stmt->error]);
}
?>
