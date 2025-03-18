<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = intval($_POST['student_id']);
    $phone_number = $_POST['phone_number'];
    $phone_number_home = $_POST['phone_number_home'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Update student information in the database
    $sql = "UPDATE student SET 
            phone_number='$phone_number', 
            phone_number_home='$phone_number_home', 
            email='$email', 
            address='$address' 
            WHERE student_id=$student_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: user_profile.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>