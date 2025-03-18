<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../static/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>กู้ยืมเงินนักศึกษา - มหาวิทยาลัยเกษมบัณฑิต</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .header img {
            height: 50px;
        }

        .nav {
            background-color: #444;
            overflow: hidden;
        }

        .nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .content {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>
    <?php include('../user/header.php'); ?>

   

    <div class="container my-4">
        <div class="text-center mb-4">
        </div>
        <div class="d-flex justify-content-center mb-4">
            <a href="user_studentloan1.php" class="btn btn-primary mx-2">หน้าแรก</a>
            <a href="user_studentloan2.php" class="btn btn-secondary mx-2">กิจกรรม</a>
            <a href="user_studentloan4.php" class="btn btn-secondary mx-2">เพิ่มเติม</a>
        </div>
        <hr>

        <div class="content">
            <!-- เนื้อหาของคุณอยู่ที่นี่ -->
            <section id="home">
                <h1 class="h11">กิจกรรมจิตสาธารณะ กยศ</h1>
                <p>ทั้งนี้ ผู้กู้ยืมสามารถทำกิจกรรมจิตสาธารณะได้ โดยบันทึกการเข้าร่วมโครงการ/กิจกรรมที่ทำประโยชน์ต่อสังคมหรือสาธารณะ ในแบบฟอร์มตามที่กองทุนกำหนด และลงลายมือชื่อผู้รับรองการทำกิจกรรม ได้แก่ หัวหน้าหน่วยงานหรือผู้ที่ได้รับมอบหมาย และ ผู้บริหารสถานศึกษา</p>
                <p>1. กรณีเป็นผู้กู้ยืมเงินรายใหม่ ไม่กำหนดจำนวนชั่วโมง<br />
                    2. กรณีเป็นผู้กู้ยืมเงินรายเก่าเปลี่ยนระดับการศึกษา ไม่กำหนดจำนวนชั่วโมง<br />
                    3. กรณีเป็นผู้กู้ยืมเงินรายเก่าเลื่อนชั้นปีทุกระดับการศึกษา กำหนดจำนวนไม่น้อยกว่า 36 ชั่วโมง<br />
                </p>
            </section>
        </div>
    </div>

    <?php include('../user/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>