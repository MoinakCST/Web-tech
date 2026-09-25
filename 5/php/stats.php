<?php
require_once "db.php";

/*
Q6: PHP function using an array to calculate total and average,
and determine a grade/category for every record.
*/
function getGrade($marks) {
    if ($marks >= 80) return "A";
    if ($marks >= 60) return "B";
    if ($marks >= 40) return "C";
    return "F";
}

$result = $conn->query("SELECT id, name, marks FROM `$table` ORDER BY id ASC");

$marksArray = [];
$records = [];

while ($row = $result->fetch_assoc()) {
    $marksArray[] = (int)$row["marks"];
    $row["grade"] = getGrade((int)$row["marks"]);
    $records[] = $row;
}

$total = array_sum($marksArray);
$count = count($marksArray);
$average = $count > 0 ? $total / $count : 0;

header("Content-Type: application/json");
echo json_encode([
    "success" => true,
    "total" => $total,
    "average" => round($average, 2),
    "records" => $records
]);
?>
