<?php 
    include "./connection.php";

    if (isset($_POST["hire_student"])) {
        $fullname = mysqli_real_escape_string($SQL, $_POST["full_name"]);
        $companyname = mysqli_real_escape_string($SQL, $_POST["company_name"]);
        $companyemail = mysqli_real_escape_string($SQL, $_POST["company_email"]);
        $companymobile = mysqli_real_escape_string($SQL, $_POST["company_mobile"]);
        $studentfrom = mysqli_real_escape_string($SQL, $_POST["type_of_student"]);

        if (!isset($_POST["type_of_student"])) {
            header("location: ../form?false-course");
            return true;
        }

        $query = mysqli_query($SQL, "INSERT INTO hiring (fullname, companyname, companyemail, companymobile, studentfrom) VALUES ('$fullname', '$companyname', '$companyemail', '$companymobile', '$studentfrom')");

        if ($query) {
            header("location: ../form?true");
            return true;
        }
        else {
            header("location: ../form?false");
            return false;
        }
    }

    else {
        header("Location: ../form");
    }
?>