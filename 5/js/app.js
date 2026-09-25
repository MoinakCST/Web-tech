const API = "php/";
let sortColumn = "id";
let sortOrder = "ASC";
let currentRows = [];

const $ = (id) => document.getElementById(id);

async function fetchJSON(url, options = {}) {
    const response = await fetch(url, options);
    const data = await response.json();
    if (!response.ok || data.success === false) {
        throw new Error(data.message || "Request failed");
    }
    return data;
}

async function loadStudents() {
    const search = encodeURIComponent($("search").value.trim());
    $("tableStatus").textContent = "Loading...";
    try {
        const data = await fetchJSON(
            `${API}fetch.php?search=${search}&sort=${encodeURIComponent(sortColumn)}&order=${sortOrder}`
        );
        currentRows = data.data;
        renderStudents(currentRows);
        $("tableStatus").textContent = `${currentRows.length} record(s) found`;
    } catch (error) {
        $("tableStatus").textContent = error.message;
    }
}

function renderStudents(rows) {
    const body = $("studentBody");
    if (!rows.length) {
        body.innerHTML = `<tr><td colspan="7" class="empty">No matching records found.</td></tr>`;
        return;
    }

    body.innerHTML = rows.map(row => `
        <tr>
            <td>${escapeHTML(row.id)}</td>
            <td>${escapeHTML(row.name)}</td>
            <td>${escapeHTML(row.gender)}</td>
            <td><span class="pill">${escapeHTML(row.course)}</span></td>
            <td><strong>${escapeHTML(row.marks)}</strong></td>
            <td>${escapeHTML(row.email)}</td>
            <td class="actions">
                <button class="edit" onclick="openEdit(${row.id})">Edit</button>
                <button class="delete" onclick="deleteStudent(${row.id})">Delete</button>
            </td>
        </tr>
    `).join("");
}

function escapeHTML(value) {
    return String(value)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

async function loadStats() {
    try {
        const data = await fetchJSON(`${API}stats.php`);
        $("totalMarks").textContent = data.total;
        $("avgMarks").textContent = data.average;

        $("statsBody").innerHTML = data.records.map(row => `
            <tr>
                <td>${escapeHTML(row.id)}</td>
                <td>${escapeHTML(row.name)}</td>
                <td>${escapeHTML(row.marks)}</td>
                <td><span class="grade grade-${row.grade}">${row.grade}</span></td>
            </tr>
        `).join("");
    } catch (error) {
        $("statsBody").innerHTML = `<tr><td colspan="4">${escapeHTML(error.message)}</td></tr>`;
    }
}

$("studentForm").addEventListener("submit", async (event) => {
    event.preventDefault();
    const form = event.target;
    const message = $("formMessage");
    message.textContent = "Saving...";
    message.className = "message";

    try {
        const data = await fetchJSON(`${API}insert.php`, {
            method: "POST",
            body: new FormData(form)
        });
        message.textContent = data.message;
        message.className = "message success";
        form.reset();
        await loadStudents();
        await loadStats();
    } catch (error) {
        message.textContent = error.message;
        message.className = "message error";
    }
});

let searchTimer;
$("search").addEventListener("input", () => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(loadStudents, 180);
});

$("refreshBtn").addEventListener("click", () => {
    loadStudents();
    loadStats();
});

document.querySelectorAll("th[data-sort]").forEach(header => {
    header.addEventListener("click", () => {
        const column = header.dataset.sort;
        if (sortColumn === column) {
            sortOrder = sortOrder === "ASC" ? "DESC" : "ASC";
        } else {
            sortColumn = column;
            sortOrder = "ASC";
        }
        loadStudents();
    });
});

function openEdit(id) {
    const row = currentRows.find(item => Number(item.id) === Number(id));
    if (!row) return;

    $("editId").value = row.id;
    $("editName").value = row.name;
    $("editGender").value = row.gender;
    $("editCourse").value = row.course;
    $("editMarks").value = row.marks;
    $("editEmail").value = row.email;
    $("editMessage").textContent = "";
    $("editModal").classList.remove("hidden");
}

$("closeModal").addEventListener("click", () => {
    $("editModal").classList.add("hidden");
});

$("editForm").addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new URLSearchParams();
    formData.append("id", $("editId").value);
    formData.append("name", $("editName").value);
    formData.append("gender", $("editGender").value);
    formData.append("course", $("editCourse").value);
    formData.append("marks", $("editMarks").value);
    formData.append("email", $("editEmail").value);

    $("editMessage").textContent = "Updating...";
    try {
        const data = await fetchJSON(`${API}update.php`, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: formData.toString()
        });
        $("editMessage").textContent = data.message;
        $("editMessage").className = "message success";
        await loadStudents();
        await loadStats();
        setTimeout(() => $("editModal").classList.add("hidden"), 500);
    } catch (error) {
        $("editMessage").textContent = error.message;
        $("editMessage").className = "message error";
    }
});

async function deleteStudent(id) {
    if (!confirm("Delete this student record?")) return;

    const formData = new URLSearchParams();
    formData.append("id", id);

    try {
        const data = await fetchJSON(`${API}delete.php`, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: formData.toString()
        });
        $("tableStatus").textContent = data.message;
        await loadStudents();
        await loadStats();
    } catch (error) {
        $("tableStatus").textContent = error.message;
    }
}

loadStudents();
loadStats();
