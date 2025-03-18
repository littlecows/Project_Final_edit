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
    <title>ข่าวสาร</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: white;
            margin: 0;
            padding: 0;
        }

        .news-container {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            flex-wrap: wrap;
        }

        .news-item {
            width: 30%;
            margin: 10px;
            text-align: center;
            background-color: #2a2a2a;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .news-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .news-content {
            padding: 10px;
            text-align: left;
        }

        .date {
            font-size: 0.9em;
            margin-bottom: 5px;
            color: #aaa;
        }

        h2 {
            font-size: 1.2em;
            margin: 5px 0;
        }

        p {
            font-size: 0.9em;
            line-height: 1.5;
        }

        .read-more {
            display: inline-block;
            margin-top: 10px;
            font-size: 1.2em;
            color: #ff6b6b;
            text-decoration: none;
        }

        .read-more:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .news-item {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="news-container">
        <div class="news-item">
            <img src="image1.jpg" alt="BU รวมพลัง CMO">
            <div class="news-content">
                <p class="date">13/03/2025</p>
                <h2>BU รวมพลัง CMO เป็นเด็กนิเทศฯ สู่วงการอีเวนต์ระดับมืออาชีพ</h2>
                <p>คณะนิเทศศาสตร์ มหวิทยาลัยกรุงเทพ ลงนามความร่วมมือทางวิชาการ(MoU) กับ บริษัท ซีเอ็ม...</p>
                <a href="#" class="read-more">→</a>
            </div>
        </div>
        <div class="news-item">
            <img src="image2.jpg" alt="Behind Things">
            <div class="news-content">
                <p class="date">12/03/2025</p>
                <h2>เปลี่ยนขยะเป็นคุณค่า Behind Things ทิ้งแล้วไปไหน เปิดโลกแห่ง...</h2>
                <p>นักศึกษาทุนผู้นำทางสังคมและสิ่งแวดล้อม จัดโครงการ Behind Things ทิ้งแล้วไปไหน เป็น...</p>
                <a href="#" class="read-more">→</a>
            </div>
        </div>
        <div class="news-item">
            <img src="image3.jpg" alt="Golden Gate University">
            <div class="news-content">
                <p class="date">12/03/2025</p>
                <h2>BU จับมือ Golden Gate University ถ้ากระโดดสู่การศึกษา...</h2>
                <p>มหาวิทยาลัยกรุงเทพ ลงนามในบันทึกข้อตกลงความร่วมมือ (MoU) กับ Golden Gate...</p>
                <a href="#" class="read-more">→</a>
            </div>
        </div>
    </div>
</body>
</html>