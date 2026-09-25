<?php

function displayOddNumbers($n)
{
    $result = "";

    for ($i = 1; $i <= $n; $i++) {

        if ($i % 2 != 0) {
            $result .= $i . " ";
        }
    }

    return $result;
}


$n = $_GET["n"];

echo "Odd Numbers: ";
echo displayOddNumbers($n);

?>