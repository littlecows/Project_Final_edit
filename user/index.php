<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
</head>

<body>

    <script src="../static/js/bootstrap.min.js"></script>

    <div class="container">

        <body>

            <script src="js/bootstrap.min.js"></script>


        </body>

        <?php include('../user/header.php'); ?>

        <div class="container">
            <div class="box_menu">
                <img src="../static/img/slide-image-1.jpg" alt="">
                <nav>
                    <a href="#">ขอแบบฟอร์มการกู้ยืม</a>
                    <a href="user_page1.php">นักศึกษาเริ่มกู้กับเกษม</a>
                    <a href="#">นักศึกษาเก่าในสถาบัน</a>
                    <a href="#">ปฏิทินกิจกรรม</a>
                </nav>
            </div>


            <div class="selection">
                <div class="box-face">
                    <img src="https://campus.campus-star.com/app/uploads/2015/09/edu.jpg" alt="">
                    <p class="box-text">Sample text. Click to select the text box. Click again or double click to start
                        editing the text.</p>
                    <a href="#" class="box-button">อ่านต่อ </a>
                </div>
                <div class="box-face">
                    <img src="https://campus.campus-star.com/app/uploads/2015/09/edu.jpg" alt="">
                    <p class="box-text">Sample text. Click to select the text box. Click again or double click to start
                        editing the text.</p>
                    <a href="#" class="box-button">อ่านต่อ </a>
                </div>
                <div class="box-face">
                    <img src="https://campus.campus-star.com/app/uploads/2015/09/edu.jpg" alt="">
                    <p class="box-text">Sample text. Click to select the text box. Click again or double click to start
                        editing the text.</p>
                    <a href="#" class="box-button">อ่านต่อ </a>
                </div>
                <div class="box-face">
                    <img src="https://campus.campus-star.com/app/uploads/2015/09/edu.jpg" alt="">
                    <p class="box-text">Sample text. Click to select the text box. Click again or double click to start
                        editing the text.</p>
                    <a href="#" class="box-button">อ่านต่อ </a>
                </div>
            </div>

            <footer>
                <div class="footer-bar">

                </div>
            </footer>

        </div>
    </div>

</body>

</html>

</html>