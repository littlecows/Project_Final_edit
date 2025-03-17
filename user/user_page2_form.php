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
    </style>
</head>
<body>

<?php include('../user/header.php'); ?>

<div class="container">
    <div class="content">
        <h2>ดาวน์โหลดแบบฟอร์มขอกู้ยืมปี 2568</h2>
        <p>ในการดาวน์โหลดแบบฟอร์มขอกู้ยืม ขอให้นักศึกษาบันทึกสถานภาพครอบครัว ขอให้อ่านให้ละเอียด เนื่องจากแต่ละสถานภาพของครอบครัวมีการเตรียมเอกสารที่แตกต่างกันออกไป เพื่อไม่ให้เป็นการเสียเวลาในการแก้ไขเอกสารขอให้นักศึกษาบันทึกข้อมูลให้ถูกต้อง "การดาวน์โหลดเอกสารทุกอย่าง สามารถดาวน์โหลดได้หลังจากบันทึกข้อมูลเรียบร้อยแล้วค่ะ"</p>

        <div class="email-section">
            <p>pummarin2003@gmail.com สลับบัญชี</p>
            <p><a href="#">ไม่ใช่ร่วมกัน</a></p>
        </div>

        <form action="#" method="post">
            <label>* ระบุว่าเป็นคำถามที่จำเป็น</label>
            <p>การดาวน์โหลดแบบค้าขอกู้ยืมครั้งนี้หาวิทยาลัยขอข้อมูลส่วนบุคคลของนักศึกษาและครอบครัว เพื่อนำเสนอแบบฟอร์มขอกู้ยืมที่ถูกต้องสำหรับครอบครัวของนักศึกษา ในการเตรียมเอกสารเพื่อขอกู้ยืมเงินกองทุนเงินให้กู้ยืมเพื่อการศึกษาต่อไป ข้อมูลที่ทำกรอกมาจะนำไปเก็บรวบรวมเพื่อประกอบการพิจารณา และมีบางส่วนที่ต้องเปิดเผยข้อมูลให้หน่วยงานภายในและภายนอกหาวิทยาลัย</p>
            <input type="radio" id="yes" name="answer" value="yes">
            <label for="yes">ยินยอม</label><br>
            <input type="radio" id="no" name="answer" value="no">
            <label for="no">ไม่ยินยอม</label><br>
            <button type="submit">ตกลง</button>
            <button type="button" style="float: right;">ล้างแบบฟอร์ม</button>
        </form>
    </div>
</div>

</body>
</html>