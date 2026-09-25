<?php

function sortNumbers($numbers)
{
    sort($numbers);

    return $numbers;
}


$input = $_GET["numbers"];

$numbers = explode(",", $input);

$numbers = array_map("intval", $numbers);

$sortedNumbers = sortNumbers($numbers);

echo "Sorted Numbers: ";

foreach ($sortedNumbers as $number) {
    echo $number . " ";
}

?>