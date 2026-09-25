<?php

function calculateGrade($marks)
{
    if ($marks >= 90) {
        return "A+";
    }
    elseif ($marks >= 80) {
        return "A";
    }
    elseif ($marks >= 70) {
        return "B";
    }
    elseif ($marks >= 60) {
        return "C";
    }
    elseif ($marks >= 50) {
        return "D";
    }
    else {
        return "F";
    }
}


$marks = $_GET["marks"];

echo "Marks: " . $marks . "<br>";
echo "Grade: " . calculateGrade($marks);

?>