-- database.sql

CREATE DATABASE student_db;

USE student_db;

CREATE TABLE student (

    id INT AUTO_INCREMENT PRIMARY KEY,

    fname VARCHAR(100),
    lname VARCHAR(100),
    email VARCHAR(100),
    age INT,
    gender VARCHAR(20),
    course VARCHAR(100),
    hobbies TEXT,
    skill VARCHAR(100)

);
