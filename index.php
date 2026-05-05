<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include "connection.php";
 $fnameErr = $lnameErr = $emailErr = "";
    $ageErr = $genderErr = $courseErr = "";
    $hobbiesErr = $skillErr = $agreeErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // error messsage variable

   

    $fnameT = $lnameT = $emailT = false;
    $ageT = $genderT = $courseT = false;
    $skillT = $agreeT = $hobbiesT = false;


    //fname
    if (empty($_POST['fname'])) {
        $fnameErr = "First Name is required";

    } elseif (!preg_match("/^[a-zA-Z-' ]{2,}$/", $_POST['fname'])) {
        $fnameErr = "Only letters and white space allowed";
    } else {
        $fname = trim($_POST['fname']);
        $fnameT = true;
    }

    //lname
    if (empty($_POST['lname'])) {
        $lnameErr = "Last Name is required";
    } elseif (!preg_match("/^[a-zA-Z-' ]{2,}$/", $_POST['lname'])) {
        $fnameErr = "Only letters and white space allowed";
    } else {
        $lname = trim($_POST['lname']);
        $lnameT = true;
    }

    //email
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } elseif (!preg_match('/^[a-zA-z][a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST['email'])) {
        // !preg_match('/^[a-zA-z][a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)
        //!filter_var($email, FILTER_VALIDATE_EMAIL

        $emailErr = "Email is not in right format";
    } else {
        $email = trim($_POST["email"]);
        $emailT = true;
    }

    //age
    if (empty($_POST["age"]) || !is_numeric($_POST['age'])) {
        $ageErr = "Age is required";
    } elseif ($_POST['age'] < 6 || $_POST['age'] > 60) {
        $ageErr = "Age must be a number between 6 to 59.";
    } else {
        $age = trim($_POST["age"]);
        $ageT = true;
    }

    $age = $_POST['age'];

if ($age === "") {
    $age = null;
}


    //gender
    if (!isset($_POST["gender"])) {
        $genderErr = "Please Select any Gender";
    } else {
        $gender = $_POS["gender"];
        $genderT = true;
    }

    //course
    if (!isset($_POST["course"]) || empty($_POST["course"])) {
        $courseErr = "Please select any course";
    } else {
        $course = ($_POST["course"]);
        $courseT = true;
    }

    //hobbies
    if (!isset($_POST["hobbies"])) {
        $hobbiesErr = "Please select at least one hobby";
    } else {
        $hobbies = ($_POST["hobbies"]);
        $hobbiesT = true;
    }

    //skill
    if (!isset($_POST["skill"])) {
        $skillErr = "Please select your skill level";
    } else {
        $skill = ($_POST["skill"]);
        $skillT = true;
    }


    //agree
    if (!isset($_POST["agree"])) {
        $agreeErr = "Please Agree to terms and conditions";
    } else {
        $agree = ($_POST["agree"]);
        $agreeT = true;
    }
    if ($fnameT && $lnameT && $emailT && $ageT && $genderT && $agreeT && $skillT && $hobbiesT && $courseT) {
       $stmt = $db->prepare("INSERT INTO student (fname, lname, email, age, gender, course, hobbies, skill, agree)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssisssssi", $_POST['fname'], $_POST['lname'],$_POST['email'],$age,$_POST["gender"],$_POST["course"],$_POST["hobbies"],$_POST["skill"],$_POST["agree"]);
 
        if ($stmt->execute()) {

            echo "Data submitted successfully!";

            // Optional: clear fields or redirect

        } else {

            $error = "Database error: " . $db->error;

        }

        $stmt->close();
        exit;
    } else {
        $failure = "none";
    }

//     $stmt = $conn->prepare("INSERT INTO student (fname, lname, email, age, gender, course, hobbies, skill, agree)
// VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

//  $stmt->bind_param("ssisssssi", $_POST['fname'], $_POST['lname'],$_POST['email'],$_POST["age"],$_POST["gender"],$_POST["course"],$_POST["hobbies"],$_POST["skill"],$_POST["agree"]);

//   if ($stmt->execute()) {
//         echo "Data saved successfully!";
//     } else {
//         echo "Error: " . $stmt->error;
//     }
    
//     $stmt->close();
//     $conn->close();


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Submission Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="head">
        <h2>Student Submission Form</h2>
        <p>Fill all the details correctly</p>
    </div>
    <div class="line"></div>
    <form method="post" action="">


        </div>
        <div class="fname">
            <label for="fname">First Name :</label>
            <input type="text" name="fname" id="fname" placeholder="Ente your first name" value="<?php echo $fname; ?>"
                class="input" value="<?php echo $fname; ?>">
            <p id="errorfName"> <?php echo $fnameErr; ?></p>
        </div>

        <div class="lname">
            <label for="lname">Last Name :</label>
            <input type="text" name="lname" id="lname" placeholder="Ente your last name" class="input"
                value="<?php echo $lname; ?>">
            <p id="errorlName"> <?php echo $lnameErr; ?></p>
        </div>

        <div class="email">
            <label for="email">Email Address :</label>
            <input type="text" name="email" id="email" placeholder="Ente your Email" class="input"
                value="<?php echo $email; ?>">
            <p id="errorEmail"> <?php echo $emailErr; ?></p>
        </div>

        <div class="age">
            <label for="age">Age :</label>
            <input type="number" name="age" id="age" placeholder="Ente your age" class="input"
                value="<?php echo $age; ?>">
            <p id="errorAge"> <?php echo $ageErr; ?></p>
        </div>

        <div class="gender" style="width : unset ">
            <fieldset class="fieldset">
                <legend>Gender:</legend>

                <input type="radio" name="gender" id="male" name="male" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Male")
                    echo "checked"; ?> class="input">
                <label for="male">Male</label>

                <input type="radio" name="gender" id="female" name="female" value="Female" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Female")
                    echo "checked"; ?> class="input">
                <label for="female">Female</label>
            </fieldset>

            <p id="errorGender"> <?php echo $genderErr; ?></p>
        </div>

        <div class="dropDown">
            <label for="course">Choose a course :</label>
            <select name="course" id="course">
                <option value="" class="input">Please choose an option &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</option>
                <option value="webDevlopment" <?php if (isset($_POST['course']) && $_POST['course'] == "webDevlopment")
                    echo "selected"; ?> class="input">Web Devlopment</option>
                <option value="android" <?php if (isset($_POST['course']) && $_POST['course'] == "android")
                    echo "selected"; ?> class="input">Android</option>
                <option value="uiux" <?php if (isset($_POST['course']) && $_POST['course'] == "uiux")
                    echo "selected"; ?>
                    class="input">UI and UX</option>
                <option value="dataScience" <?php if (isset($_POST['course']) && $_POST['course'] == "dataScience")
                    echo "selected"; ?> class="input">Data Science</option>
            </select>

            <p id="errorCourse"> <?php echo $courseErr; ?></p>
        </div>

        <div class="hobbies">
            <label for="hobbies">Hobbies :</label>
            <input type="checkbox" name="hobbies" id="reading" value="Reading" <?php echo ($hobbies == 'reading') ? 'checked' : ''; ?> class="input">
            <label for="reading">Reading</label>

            <input type="checkbox" name="hobbies" id="sports" value="Sports" <?php if (isset($_POST['hobbies']) && $_POST['hobbies'] == "Sports")
                echo "checked"; ?> class="input">
            <label for="sports">Sports</label>

            <input type="checkbox" name="hobbies" id="music" value="Music" <?php if (isset($_POST['hobbies']) && $_POST['hobbies'] == "Music")
                echo "checked"; ?> class="input">
            <label for="music">Music</label>

            <input type="checkbox" name="hobbies" id="coding" value="Coding" <?php if (isset($_POST['hobbies']) && $_POST['hobbies'] == "Coding")
                echo "checked"; ?> class="input">
            <label for="coding">Coding</label>

            <input type="checkbox" name="hobbies" id="traveling" value="Traveling" <?php if (isset($_POST['hobbies']) && $_POST['hobbies'] == "Traveling")
                echo "checked"; ?> class="input">
            <label for="traveling">Traveling</label>

            <p id="errorHobbies"> <?php echo $hobbiesErr; ?></p>
        </div>

        <div class="skillLevel">
            <label for="skill">Skill Level :</label>

            <input type="radio" name="skill" id="beginner" value="Beginner" <?php if (isset($_POST['skill']) && $_POST['skill'] == "Beginner")
                echo "checked"; ?> class="input">
            <label for="beginner">Beginner</label>

            <input type="radio" name="skill" id="intermediate" value="Intermediate" <?php if (isset($_POST['skill']) && $_POST['skill'] == "Intermediate")
                echo "checked"; ?> class="input">
            <label for="intermediate">Intermediate</label>

            <input type="radio" name="skill" id="advanced" value="Advanced" <?php if (isset($_POST['skill']) && $_POST['skill'] == "Advanced")
                echo "checked"; ?> class="input">
            <label for="advanced">Advanced</label>

            <p id="errorSkill">

                <?php echo $skillErr; ?>

            </p>
        </div>

        <div class="agreeTerms">
            <input type="checkbox" name="agree" id="agree" class="input" value="1" <?php if (isset($_POST['agree']) && $_POST['agree'] == "1")
                echo "checked"; ?>>
            <label for="agree" class="agree">By clicking this box you agree to our terms and condition</label>

            <p id="errorAgree"> <?php echo $agreeErr; ?></p>
        </div>

        <div class="submitOut">
            <input type="submit" value="Submit" style="padding: 1% 2%;" class="submit">
        </div>

        <div class="success" style="color:green; font-size:20px;">
            <h4><?php echo $success ?></h4>
        </div>

    </form>

    <div class="popup-overlay" id="popup" style="display: '<?php echo $success ?>;'">
        <div class="popup-content">
            <h2>Thank You!</h2>
            <p>Your form has been successfully submitted.</p>
            <button id="closeBtn">Close</button>
        </div>
    </div>

    <div class="popup-overlay-empty" id="popup1" style="display: '<?php echo $failure ?>;'">
        <div class="popup-content">
            <h2>Please fill the form first</h2>
            <button id="closeBtn-empty">Close</button>
        </div>
    </div>


    <h2 class="mid-head">Student Data</h2>

    <table class="table">
        <thead class="th">
            <tr class="tr">
                <th class="thead">First Name</th>
                <th class="thead">Last Name</th>
                <th class="thead">Email Address</th>
                <th class="thead">&nbsp; Age &nbsp; &nbsp;</th>
                <th class="thead">&nbsp; Gender &nbsp; &nbsp;</th>
                <th class="thead">Course</th>
                <th class="thead">Hobbies</th>
                <th class="thead">Skill Level</th>
                <th class="thead">Agreement Of T&C</th>
            </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>

    <script src="test1.js"></script>
</body>

</html>
