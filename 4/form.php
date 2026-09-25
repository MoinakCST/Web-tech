<?php

function displayInformation()
{
    echo "<h1>Submitted Information</h1>";

    echo "Name: " . htmlspecialchars($_POST["name"]) . "<br>";

    echo "Password: " . htmlspecialchars($_POST["password"]) . "<br>";

    echo "Gender: " . htmlspecialchars($_POST["gender"]) . "<br>";

    echo "Animal: " . htmlspecialchars($_POST["animal"]) . "<br>";

    echo "Hidden Value: "
        . htmlspecialchars($_POST["hiddenValue"])
        . "<br>";


    if (isset($_FILES["file"]) &&
        $_FILES["file"]["error"] == 0) {

        echo "Uploaded File: "
            . htmlspecialchars($_FILES["file"]["name"]);
    }
    else {

        echo "No file uploaded.";
    }
}


displayInformation();

?>