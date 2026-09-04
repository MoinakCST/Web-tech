// This script generates the entire visible page content using document.write()

document.write("<div class='container'>");
document.write("<h1>Welcome to My Web Page</h1>");
document.write("<p>This entire page's content was generated using the <strong>document.write()</strong> method from an external JavaScript file.</p>");

document.write("<h2>About This Demo</h2>");
document.write("<p>The <code>document.write()</code> function writes HTML directly into the document while it is being loaded. ");
document.write("It is an older technique, generally replaced today by DOM methods like <code>innerHTML</code> or <code>appendChild()</code>, ");
document.write("but it's still useful for learning how JavaScript can dynamically build page content.</p>");

document.write("<h2>Current Date & Time</h2>");
document.write("<p>" + new Date().toLocaleString() + "</p>");

// Print button
document.write("<button onclick='window.print()'> Print This Page</button>");

document.write("</div>");