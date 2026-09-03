function loadFacultyProfile() {
    const facultyName = document.getElementById("facultyName").value.trim();
    const basePath = "faculty_profiles/";
    const facultyMapping = {
        "Abhik Mukherjee": "abhik_mukherjee.html",
        "Apurba Sarkar": "apurba_sarkar.html",
        "Tamal Pal": "tamal_pal.html",
        "Ashish Kumar Layek": "ashish_layek.html",
        "Malay Kule" : "malay_kule.html"
        // Add more faculty names and HTML file names as needed
    };

    const facultyProfile = document.getElementById("facultyProfile");
    const facultyFile = facultyMapping[facultyName];

    if (facultyFile) {
        fetch(`${basePath}${facultyFile}`)
            .then(response => response.text())
            .then(data => facultyProfile.innerHTML = data)
            .catch(error => {
                console.error("Error loading faculty profile:", error);
                facultyProfile.innerHTML = "<p>Faculty profile not found.</p>";
            });
    } else {
        facultyProfile.innerHTML = "<p>Faculty not found.</p>";
    }
}
