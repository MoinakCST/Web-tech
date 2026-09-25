<?php

function calculateResult($marks)
{
    $total = array_sum($marks);

    $average = $total / count($marks);

    if ($average >= 90) {
        $grade = "A+";
    }
    elseif ($average >= 80) {
        $grade = "A";
    }
    elseif ($average >= 70) {
        $grade = "B";
    }
    elseif ($average >= 60) {
        $grade = "C";
    }
    elseif ($average >= 50) {
        $grade = "D";
    }
    else {
        $grade = "F";
    }

    echo "<h2>Student Result</h2>";

    echo "Total Marks: " . $total . "<br>";

    echo "Average Marks: " . number_format($average, 2) . "<br>";

    echo "Grade: " . $grade . "<br><br>";


    echo "<h3>Subject-wise Marks</h3>";

    foreach ($marks as $subject => $mark) {

        echo $subject . ": " . $mark . "<br>";
    }
}


// PHP associative array

$marks = [
    "Computer Science" => 85,
    "Mathematics" => 92,
    "Physics" => 78,
    "English" => 88,
    "Electronics" => 81
];


calculateResult($marks);

?>