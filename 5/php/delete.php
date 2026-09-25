<?php
require_once "db.php";

$id = (int)($_POST["id"] ?? 0);
header("Content-Type: application/json");

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid record ID."]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM `$table` WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Record deleted successfully."]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Delete failed: " . $stmt->error]);
}
?>
