/*
* Matthew Moczynski
* Programming Final Project
* Spring 2025 Semester
* Instructor: Melissa Dix
*/

/*** Note: DROP DATABASE might be disabled in phpMyAdmin. Comment out below command if not.  ***/
/*** DROP DATABASE IF EXISTS student_management; ***/

CREATE DATABASE student_management;

USE student_management;

CREATE TABLE students (

    id INT AUTO_INCREMENT, 
    name VARCHAR(100),
    email VARCHAR(100),
    dob DATE,
    grade VARCHAR(10),

    PRIMARY KEY (id)

);

/*** Insert sample data ***/

INSERT INTO students (name, email, dob, grade) 
VALUES ("John Doe", "johndoe@example.com", "1995-3-25", "AB");

INSERT INTO students (name, email, dob, grade) 
VALUES ("Mary Jane", "maryjane@example.com", "1980-6-3", "A");

INSERT INTO students (name, email, dob, grade) 
VALUES ("Mark Brown", "markbrown@example.com", "2001-5-20", "B");