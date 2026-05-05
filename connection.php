<?php
$conn = new mysqli("localhost", "magecomp", "Mage@12345", "STUDENT");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);


// $sql = "INSERT INTO student (fname , lname , email , age , gender , course , hobbies , skill , agree, 
// VALUES
// (?,?,?,?,?,?,?,?,?)");

// $sql = INSERT INTO student (fname, lname, email, age, gender, course, hobbies, skill, agree)
// VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);


?>
