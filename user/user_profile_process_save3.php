<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = intval($_POST['student_id']);
    $father_name = $_POST['father_name'];
    $father_last_name = $_POST['father_last_name'];
    $mother_name = $_POST['mother_name'];
    $mother_last_name = $_POST['mother_last_name'];
    $phone_number_home = $_POST['phone_number_home'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Update student information in the database
    $sql = "UPDATE student 
            SET phone_number_home='$phone_number_home', email='$email', address='$address' 
            WHERE student_id=$student_id";

    if ($conn->query($sql) === TRUE) {
        // Update father information in the database
        $sql_father = "UPDATE father 
                       SET father_name='$father_name', father_last_name='$father_last_name' 
                       WHERE father_id=(SELECT father_id FROM student WHERE student_id=$student_id)";
        $conn->query($sql_father);

        // Update mother information in the database
        $sql_mother = "UPDATE mother 
                       SET mother_name='$mother_name', mother_last_name='$mother_last_name' 
                       WHERE mother_id=(SELECT mother_id FROM student WHERE student_id=$student_id)";
        $conn->query($sql_mother);

        header("Location: user_profile.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>