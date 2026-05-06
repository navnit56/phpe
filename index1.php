<!-- index.php -->

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "connection.php";

$fname = $lname = $email = $age = "";
$gender = $course = $skill = "";
$hobbies = "";

$fnameErr = $lnameErr = $emailErr = "";
$ageErr = $genderErr = $courseErr = "";
$hobbiesErr = $skillErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // First Name
    if (empty($_POST['fname'])) {
        $fnameErr = "First Name is required";
    } elseif (!preg_match("/^[a-zA-Z-' ]{2,}$/", $_POST['fname'])) {
        $fnameErr = "Only letters and spaces allowed";
    } else {
        $fname = trim($_POST['fname']);
    }

    // Last Name
    if (empty($_POST['lname'])) {
        $lnameErr = "Last Name is required";
    } elseif (!preg_match("/^[a-zA-Z-' ]{2,}$/", $_POST['lname'])) {
        $lnameErr = "Only letters and spaces allowed";
    } else {
        $lname = trim($_POST['lname']);
    }

    // Email
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid Email";
    } else {
        $email = trim($_POST['email']);
    }

    // Age
    if (empty($_POST['age'])) {
        $ageErr = "Age is required";
    } elseif (!is_numeric($_POST['age'])) {
        $ageErr = "Age must be a number";
    } else {
        $age = $_POST['age'];
    }

    // Gender
    if (!isset($_POST['gender'])) {
        $genderErr = "Please select gender";
    } else {
        $gender = $_POST['gender'];
    }

    // Course
    if (empty($_POST['course'])) {
        $courseErr = "Please select course";
    } else {
        $course = $_POST['course'];
    }

    // Hobbies
    if (!isset($_POST['hobbies'])) {
        $hobbiesErr = "Select at least one hobby";
    } else {
        $hobbies = implode(", ", $_POST['hobbies']);
    }

    // Skill
    if (!isset($_POST['skill'])) {
        $skillErr = "Please select skill";
    } else {
        $skill = $_POST['skill'];
    }

    // Insert Data
    if (
        empty($fnameErr) &&
        empty($lnameErr) &&
        empty($emailErr) &&
        empty($ageErr) &&
        empty($genderErr) &&
        empty($courseErr) &&
        empty($hobbiesErr) &&
        empty($skillErr)
    ) {

        $stmt = $conn->prepare("
            INSERT INTO student
            (fname, lname, email, age, gender, course, hobbies, skill)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sssissss",
            $fname,
            $lname,
            $email,
            $age,
            $gender,
            $course,
            $hobbies,
            $skill
        );

        if ($stmt->execute()) {
            echo "<script>alert('Data Submitted Successfully');</script>";
        } else {
            echo "Error : " . $stmt->error;
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">

        <h1>Student Registration Form</h1>

        <form method="POST" action="">

            <!-- First Name -->
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $fname; ?>">
            <span class="error"><?php echo $fnameErr; ?></span>

            <!-- Last Name -->
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $lname; ?>">
            <span class="error"><?php echo $lnameErr; ?></span>

            <!-- Email -->
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>

            <!-- Age -->
            <label>Age</label>
            <input type="number" name="age" value="<?php echo $age; ?>">
            <span class="error"><?php echo $ageErr; ?></span>

            <!-- Gender -->
            <label>Gender</label>

            <div class="radio-group">
                <input type="radio" name="gender" value="Male"> Male
                <input type="radio" name="gender" value="Female"> Female
            </div>

            <span class="error"><?php echo $genderErr; ?></span>

            <!-- Course -->
            <label>Course</label>

            <select name="course">
                <option value="">Select Course</option>
                <option value="BCA">BCA</option>
                <option value="BTech">BTech</option>
                <option value="MCA">MCA</option>
            </select>

            <span class="error"><?php echo $courseErr; ?></span>

            <!-- Hobbies -->
            <label>Hobbies</label>

            <div class="checkbox-group">
                <input type="checkbox" name="hobbies[]" value="Coding"> Coding
                <input type="checkbox" name="hobbies[]" value="Gaming"> Gaming
                <input type="checkbox" name="hobbies[]" value="Reading"> Reading
            </div>

            <span class="error"><?php echo $hobbiesErr; ?></span>

            <!-- Skill -->
            <label>Skill</label>

            <div class="radio-group">
                <input type="radio" name="skill" value="Frontend"> Frontend
                <input type="radio" name="skill" value="Backend"> Backend
                <input type="radio" name="skill" value="Full Stack"> Full Stack
            </div>

            <span class="error"><?php echo $skillErr; ?></span>

            <button type="submit">Submit</button>

        </form>

    </div>

</body>

</html>
