<?php

include "db.php";

$search = $_GET['search'] ?? '';

$search = "%$search%";

$stmt = $conn->prepare(
    "SELECT * FROM students
     WHERE name LIKE ?
     OR gender LIKE ?
     OR course LIKE ?
     ORDER BY id ASC"
);

$stmt->bind_param(
    "sss",
    $search,
    $search,
    $search
);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . $row['age'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['course'] . "</td>";
        echo "<td>" . $row['marks'] . "</td>";

        echo "<td>
                <button onclick=\"deleteStudent(" . $row['id'] . ")\">
                    Delete
                </button>
              </td>";

        echo "</tr>";
    }

} else {

    echo "<tr>
            <td colspan='7'>
                No matching records
            </td>
          </tr>";
}

$stmt->close();
$conn->close();

?>