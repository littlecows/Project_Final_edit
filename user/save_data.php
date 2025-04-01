<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['activity'])) {
    $activity_id = $_GET['activity'];
    $username = $_SESSION['username'];

    // Fetch activity details
    $sql = "SELECT name, max_hours FROM activities WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $activity_id);
    $stmt->execute();
    $stmt->bind_result($activity_name, $max_hours);
    $stmt->fetch();
    $stmt->close();

    // Insert selected activity into user_activities table
    $sql = "INSERT INTO user_activities (username, activity_id, activity_name, max_hours) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $username, $activity_id, $activity_name, $max_hours);

    if ($stmt->execute()) {
        header("Location: user_studentloan3.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>