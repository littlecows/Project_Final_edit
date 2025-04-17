<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// รับ ID และคะแนนจาก URL
if (isset($_GET['id']) && isset($_GET['score'])) {
    $id = intval($_GET['id']);
    $score = intval($_GET['score']);

    // อัปเดตคะแนนในฐานข้อมูล
    $query = "UPDATE documents SET score = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $score, $id);

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