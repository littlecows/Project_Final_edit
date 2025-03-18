<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = intval($_POST['student_id']);
    $student_code = $_POST['student_code'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $spouse_id = $_POST['spouse_id'];
    $father_id = $_POST['father_id'];
    $mother_id = $_POST['mother_id'];
    $guardian_id = $_POST['guardian_id'];
    $endorser_id = $_POST['endorser_id'];
    $department_id = $_POST['department_id'];
    $family_status_id = $_POST['family_status_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handle file upload
    $target_dir = "/xampp/htdocs/Project_Final/uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Debugging information
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';

    if (isset($_FILES['profile_image'])) {
        if ($_FILES['profile_image']['error'] == 0) {
            $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $profile_image = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File upload error. Error code: " . $_FILES['profile_image']['error'];
            exit();
        }
    } else {
        echo "No file uploaded or there was an error uploading the file.";
        exit();
    }

    $sql = "UPDATE student SET 
            student_code='$student_code', 
            f_name='$f_name', 
            l_name='$l_name', 
            address='$address', 
            phone_number='$phone_number', 
            email='$email', 
            profile_image='$profile_image', 
            spouse_id='$spouse_id', 
            father_id='$father_id', 
            mother_id='$mother_id', 
            guardian_id='$guardian_id', 
            endorser_id='$endorser_id', 
            department_id='$department_id', 
            family_status_id='$family_status_id', 
            password='$password' 
            WHERE student_id=$student_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}


?>