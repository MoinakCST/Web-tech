-- Assignment-5: SQL setup
-- Database: college
-- Table: students1
-- Q2 requires at least 4 relevant columns and 5 sample records.

CREATE DATABASE IF NOT EXISTS college;
USE college;

DROP TABLE IF EXISTS students1;

CREATE TABLE students1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    course VARCHAR(50) NOT NULL,
    marks INT NOT NULL CHECK (marks BETWEEN 0 AND 100),
    email VARCHAR(120) NOT NULL UNIQUE
);

INSERT INTO students1 (name, gender, course, marks, email) VALUES
('Aarav Sharma', 'Male', 'CSE', 88, 'aarav@example.com'),
('Diya Sen', 'Female', 'ECE', 76, 'diya@example.com'),
('Rohan Das', 'Male', 'IT', 64, 'rohan@example.com'),
('Ananya Roy', 'Female', 'CSE', 92, 'ananya@example.com'),
('Kabir Singh', 'Male', 'ME', 53, 'kabir@example.com');
