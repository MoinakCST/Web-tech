<?php
require_once "db.php";

$search = trim($_GET["search"] ?? "");
$sort = $_GET["sort"] ?? "id";
$order = strtoupper($_GET["order"] ?? "ASC");

$allowedSort = [
    "id" => "id",
    "name" => "name",
    "gender" => "gender",
    "course" => "course",
    "marks" => "marks",
    "email" => "email"
];

$sortColumn = $allowedSort[$sort] ?? "id";
$order = ($order === "DESC") ? "DESC" : "ASC";

if ($search !== "") {
    $stmt = $conn->prepare(
        "SELECT id, name, gender, course, marks, email
         FROM `$table`
         WHERE name LIKE ? OR gender LIKE ? OR course LIKE ? OR email LIKE ?
         ORDER BY `$sortColumn` $order"
    );
    $like = "%" . $search . "%";
    $stmt->bind_param("ssss", $like, $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query(
        "SELECT id, name, gender, course, marks, email
         FROM `$table`
         ORDER BY `$sortColumn` $order"
    );
}

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

header("Content-Type: application/json");
echo json_encode(["success" => true, "data" => $rows]);
?>
