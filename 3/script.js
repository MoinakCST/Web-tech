function getGrade(mark) {

    if (mark >= 90) {
        return ["A+", 10];
    } 
    else if (mark >= 80) {
        return ["A", 9];
    } 
    else if (mark >= 70) {
        return ["B+", 8];
    } 
    else if (mark >= 60) {
        return ["B", 7];
    } 
    else if (mark >= 50) {
        return ["C", 6];
    } 
    else if (mark >= 40) {
        return ["D", 5];
    } 
    else {
        return ["F", 0];
    }
}


function calculateResult() {

    let name = document.getElementById("name").value;

    let marks = [
        Number(document.getElementById("sub1").value),
        Number(document.getElementById("sub2").value),
        Number(document.getElementById("sub3").value),
        Number(document.getElementById("sub4").value),
        Number(document.getElementById("sub5").value)
    ];

    let error = document.getElementById("error");
    let result = document.getElementById("result");

    error.innerHTML = "";

    // Check empty fields
    for (let i = 0; i < marks.length; i++) {

        if (
            document.getElementById("sub" + (i + 1)).value === ""
        ) {
            error.innerHTML = "Please enter marks for all subjects.";
            result.style.display = "none";
            return;
        }
    }

    // Check marks range
    for (let i = 0; i < marks.length; i++) {

        if (marks[i] < 0 || marks[i] > 100) {
            error.innerHTML =
                "Marks must be between 0 and 100.";
            result.style.display = "none";
            return;
        }
    }

    // Calculate total
    let total = 0;

    for (let mark of marks) {
        total += mark;
    }

    // Calculate percentage
    let percentage = total / marks.length;

    // Calculate grades and grade points
    let gradeText = "";
    let totalGradePoints = 0;
    let failed = false;

    for (let i = 0; i < marks.length; i++) {

        let grade = getGrade(marks[i]);

        gradeText +=
            "Subject " + (i + 1) +
            ": " + marks[i] +
            " → Grade " + grade[0] +
            " (" + grade[1] + " points)<br>";

        totalGradePoints += grade[1];

        if (marks[i] < 40) {
            failed = true;
        }
    }

    // Calculate SGPA
    let sgpa = totalGradePoints / marks.length;

    // Display result
    document.getElementById("studentName").innerHTML =
        "<strong>Student:</strong> " + name;

    document.getElementById("total").innerHTML =
        "<strong>Total Marks:</strong> " + total + " / 500";

    document.getElementById("percentage").innerHTML =
        "<strong>Percentage:</strong> " +
        percentage.toFixed(2) + "%";

    document.getElementById("grades").innerHTML =
        "<strong>Grades:</strong><br>" + gradeText;

    document.getElementById("sgpa").innerHTML =
        "<strong>SGPA:</strong> " + sgpa.toFixed(2);

    if (failed) {

        document.getElementById("finalResult").innerHTML =
            "<strong>Final Result:</strong> FAIL";

        result.className = "fail";

    } else if (percentage >= 55) {

        document.getElementById("finalResult").innerHTML =
            "<strong>Final Result:</strong> PASS";

        result.className = "pass";

    } 

    result.style.display = "block";
}