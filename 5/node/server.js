// Assignment-5 Q1: Basic Node.js server using only the built-in http module.
const http = require("http");

const PORT = 3000;

const server = http.createServer((req, res) => {
    res.writeHead(200, { "Content-Type": "text/plain; charset=utf-8" });
    res.end("Hello Node");
});

server.listen(PORT, () => {
    console.log(`Node server running at http://localhost:${PORT}`);
});
