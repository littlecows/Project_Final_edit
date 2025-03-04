@ -0,0 +1,61 @@
<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../static/css/user_profile.css">
    <link rel="stylesheet" href="../static/css/style.css">

</head>

<body>

    <?php include('../user/header.php'); ?>
    <div class="container" id="profile-container">
        <h2 class="title">ข้อมูลส่วนตัว</h2>
        <p class="subtitle">ข้อมูลส่วนตัวของนักศึกษา</p>

        <!-- กล่องข้อมูลส่วนตัว -->
        <div class="info-card">
            <div class="info-header">ข้อมูลส่วนตัว</div>
            <div class="gradient-line"></div>
            <div class="info-body">
                <p><strong>ชื่อ - นามสกุล</strong> ย่อม ยอดเยี่ยม</p>
                <p><strong>เลขประจำตัวประชาชน</strong> 1-2345-678XX-XX-X</p>
                <p><strong>วัน เดือน ปีเกิด</strong> 9 มี.ค. 2546</p>
            </div>
            <div class="gradient-line"></div>
            <button class="edit-btn"><i class="bi bi-pencil-square"></i> แก้ไขข้อมูล</button>
        </div>


        <!-- กล่องข้อมูลติดต่อ -->
        <div class="info-card">
            <div class="info-header">ข้อมูลติดต่อ</div>
            <div class="gradient-line"></div>
            <div class="info-body">
                <p><strong>เบอร์โทรศัพท์บ้าน</strong> - </p>
                <p><strong>เบอร์โทรศัพท์มือถือ</strong> 094-112-XXXX</p>
                <p><strong>อีเมล</strong> your@email.com</p>
            </div>
            <div class="gradient-line"></div>
            <button class="edit-btn"><i class="bi bi-pencil-square"></i> แก้ไขข้อมูล</button>
        </div>
    </div>
</body>

</html>