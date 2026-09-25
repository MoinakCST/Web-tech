// 1. Display Hello PHP
function helloPHP() {

    fetch("hello.php")
        .then(response => response.text())
        .then(data => {

            document.getElementById("helloResult").innerHTML = data;

        })
        .catch(error => {

            document.getElementById("helloResult").innerHTML =
                "Error: " + error;

        });
}


// 2. Calculate Grade
function calculateGrade() {

    let marks = document.getElementById("marks").value;

    if (marks === "") {
        alert("Please enter marks.");
        return;
    }

    fetch("grade.php?marks=" + encodeURIComponent(marks))
        .then(response => response.text())
        .then(data => {

            document.getElementById("gradeResult").innerHTML = data;

        });
}


// 3. Display Odd Numbers
function displayOddNumbers() {

    let n = document.getElementById("nOdd").value;

    if (n === "") {
        alert("Please enter N.");
        return;
    }

    fetch("odd.php?n=" + encodeURIComponent(n))
        .then(response => response.text())
        .then(data => {

            document.getElementById("oddResult").innerHTML = data;

        });
}


// 4. Sort Numbers
function sortNumbers() {

    let numbers = document.getElementById("numbers").value;

    if (numbers === "") {
        alert("Please enter numbers.");
        return;
    }

    fetch(
        "sort.php?numbers=" +
        encodeURIComponent(numbers)
    )
        .then(response => response.text())
        .then(data => {

            document.getElementById("sortResult").innerHTML = data;

        });
}

