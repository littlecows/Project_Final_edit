<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// รับ ID และคะแนนจาก URL
if (isset($_GET['username']) && isset($_GET['h_hours'])) {
    $username = $_GET['username']; // Treat username as a string
    $h_hours = intval($_GET['h_hours']);
    echo "Debug: username = $username, h_hours = $h_hours"; // Debugging line

    // อัปเดตคะแนนในฐานข้อมูล
    $query = "UPDATE new_user_activities SET h_hours = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $h_hours, $username); // Use "is" for integer and string

    if ($stmt->execute()) {
        echo "บันทึกคะแนนสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกคะแนน";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ไม่มีการระบุ ID หรือคะแนน";
    exit();
}
?>
<a href="admin_Check_document_status.php">กลับ</a>