<?php 

    $servername = "localhost";
    $username = "freedb_adminbabe";
    $password = "h#45J2g62WHayeB";
    $dbname = "freedb_Project_Final";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("เชื่อมต่อไม่ได้" . mysqli_connect_error());
    }

?>
