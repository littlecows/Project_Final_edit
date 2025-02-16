<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";  // No password set by default in XAMPP
    $dbname = "project_final";  // Make sure this matches your database name

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {   
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "Connected successfully";
    }
?>
