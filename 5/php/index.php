<!DOCTYPE html>
<html>

<head>

    <title>Student Management</title>

    <style>

        body {
            font-family: Arial;
            margin: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #eee;
            cursor: pointer;
        }

        input, select {
            padding: 8px;
            margin: 5px;
        }

        button {
            padding: 8px 15px;
            cursor: pointer;
        }

        #message {
            margin-top: 15px;
        }

    </style>

</head>

<body>

<h1>Student Management System</h1>


<!-- Q4 -->

<h2>Add Student</h2>

<form id="studentForm">

    <input
        type="text"
        name="name"
        placeholder="Name"
        required
    >

    <input
        type="number"
        name="age"
        placeholder="Age"
        required
    >

    <br>

    Gender:

    <input
        type="radio"
        name="gender"
        value="Male"
        required
    > Male

    <input
        type="radio"
        name="gender"
        value="Female"
    > Female

    <br>

    <select name="course" required>

        <option value="">Select Course</option>
        <option value="CSE">CSE</option>
        <option value="ECE">ECE</option>
        <option value="IT">IT</option>
        <option value="ME">ME</option>

    </select>

    <input
        type="number"
        name="marks"
        placeholder="Marks"
        required
    >

    <input
        type="hidden"
        name="source"
        value="ajax_form"
    >

    <button type="submit">
        Add Student
    </button>

</form>


<div id="message"></div>


<!-- Q5 -->

<h2>Search</h2>

<input
    type="text"
    id="search"
    placeholder="Search students..."
>


<!-- Q3 + Q8 -->

<h2>Student Records</h2>

<table>

    <thead>

        <tr>

            <th onclick="sortTable('id')">
                ID
            </th>

            <th onclick="sortTable('name')">
                Name
            </th>

            <th onclick="sortTable('age')">
                Age
            </th>

            <th onclick="sortTable('gender')">
                Gender
            </th>

            <th onclick="sortTable('course')">
                Course
            </th>

            <th onclick="sortTable('marks')">
                Marks
            </th>

            <th>
                Action
            </th>

        </tr>

    </thead>

    <tbody id="studentTable"></tbody>

</table>


<!-- Q6 -->

<h2>Statistics</h2>

<div id="statistics"></div>


<script>


// ------------------------------------
// Q3
// Load students
// ------------------------------------

function loadStudents() {

    fetch("fetch.php")

    .then(response => response.text())

    .then(data => {

        document.getElementById(
            "studentTable"
        ).innerHTML = data;

    });

}

loadStudents();


// ------------------------------------
// Q4
// Insert student using AJAX
// ------------------------------------

document
.getElementById("studentForm")
.addEventListener("submit", function(event) {

    event.preventDefault();

    const formData = new FormData(this);

    fetch("insert.php", {

        method: "POST",

        body: formData

    })

    .then(response => response.text())

    .then(data => {

        document.getElementById(
            "message"
        ).innerHTML = data;

        this.reset();

        loadStudents();

        loadStatistics();

    });

});


// ------------------------------------
// Q5
// Live search
// ------------------------------------

document
.getElementById("search")
.addEventListener("input", function() {

    const value = this.value;

    fetch(
        "search.php?search=" +
        encodeURIComponent(value)
    )

    .then(response => response.text())

    .then(data => {

        document.getElementById(
            "studentTable"
        ).innerHTML = data;

    });

});


// ------------------------------------
// Q6
// Statistics
// ------------------------------------

function loadStatistics() {

    fetch("stats.php")

    .then(response => response.text())

    .then(data => {

        document.getElementById(
            "statistics"
        ).innerHTML = data;

    });

}

loadStatistics();


// ------------------------------------
// Q7
// Delete
// ------------------------------------

function deleteStudent(id) {

    const formData = new FormData();

    formData.append("id", id);

    fetch("delete.php", {

        method: "POST",

        body: formData

    })

    .then(response => response.text())

    .then(data => {

        document.getElementById(
            "message"
        ).innerHTML = data;

        loadStudents();

        loadStatistics();

    });

}


// ------------------------------------
// Q8
// Sorting
// ------------------------------------

let sortOrders = {};

function sortTable(column) {

    if (!sortOrders[column]) {

        sortOrders[column] = "ASC";

    }
    else {

        sortOrders[column] =
            sortOrders[column] === "ASC"
            ? "DESC"
            : "ASC";

    }

    const order = sortOrders[column];

    fetch(
        "sort.php?column=" +
        encodeURIComponent(column) +
        "&order=" +
        order
    )

    .then(response => response.text())

    .then(data => {

        document.getElementById(
            "studentTable"
        ).innerHTML = data;

    });

}

</script>

</body>

</html>