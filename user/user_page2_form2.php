<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดาวน์โหลดแบบฟอร์มขอกู้ยืมปี 2568</title>

    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">

    <style>
        .content {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            color: #F17629;
            margin-bottom: 20px;
        }

        .content p {
            margin-bottom: 10px;
        }

        .content form {
            margin-bottom: 20px;
        }

        .content label {
            display: block;
            margin-bottom: 5px;
        }

        .content input[type="radio"] {
            margin-right: 5px;
        }

        .content button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #F17629;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .content button:hover {
            background-color: #e06a0d;
        }

        .content .email-section {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .content .email-section p {
            margin-bottom: 5px;
        }

        .content .question-section {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .content .question-section h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .content .question-section p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<?php include('../user/header.php'); ?>

<div class="container">
    <div class="content">
        <h2>ดาวน์โหลดแบบฟอร์มขอกู้ยืมปี 2568</h2>

        <p>* ระบุว่าเป็นคำถามที่จำเป็น</p>

        <form action="user_page2_form3.php" method="post">
            <div class="question-section">
                <h3>กรุณากรอกข้อมูลส่วนตัวเพื่อประโยชน์ในการติดต่อ และการเตรียมเอกสารแบบฟอร์มที่ถูกต้อง</h3>
                <p>เลขประจำตัวประชาชน 13 หลัก โดยไม่ต้องใส่ช่อง เช่น 3100100775331 *</p>
                <input type="text" name="id_number" placeholder="คำตอบของคุณ" required>
            </div>

            <div class="question-section">
                <h3>รหัสนักศึกษา (กรณีมีรหัสนักศึกษาแล้วใส่รหัสนักศึกษา 12 หลักของมหาวิทยาลัยเกษมบัณฑิตที่คุณเรียนอยู่นี้ โดยไม่ต้องใส่ช่อง เช่น 680101422334 เป็นต้น</h3>
                <input type="text" name="student_id" placeholder="คำตอบของคุณ" required>
            </div>

            <div class="question-section">
                <h3>ชื่อ - สกุล ไม่ต้องใส่คำนำหน้า เช่น ออมสิน รักเรียน *</h3>
                <input type="text" name="name" placeholder="คำตอบของคุณ" required>
            </div>

            <div class="question-section">
                <h3>เบอร์โทรศัพท์นักศึกษา กรอกไม่ต้องใส่ช่อง เช่น 0891301731 *</h3>
                <input type="text" name="phone" placeholder="คำตอบของคุณ" required>
            </div>

            <div class="question-section">
                <h3>e-mail *</h3>
                <input type="email" name="email" placeholder="คำตอบของคุณ" required>
            </div>

            <button type="submit"><a href="user_page2_form3.php"></a>ตกลง</button>
            <button type="button" style="float: right;">ล้างแบบฟอร์ม</button>
        </form>
    </div>
</div>

</body>
</html>