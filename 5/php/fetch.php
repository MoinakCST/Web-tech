<?php

include "db.php";

$sql = "SELECT * FROM students1 ORDER BY id ASC";

$result = $conn->query($sql);

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
            <td colspan='7'>No records found</td>
          </tr>";
}

$conn->close();

?>