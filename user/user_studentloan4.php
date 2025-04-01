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
    <title>กิจกรรม</title>
    
    <link rel="stylesheet" href="../static/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #F17629;
            padding: 20px;
            display: flex;
            align-items: center;
        }

        .header img {
            height: 50px;
        }

        .header .title {
            flex: 1;
            text-align: center;
            color: white;
            font-size: 24px;
        }

        .nav {
            background-color: #F17629;
            overflow: hidden;
        }

        .nav a {
            float: right;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 18px;
        }

        .nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .content {
            padding: 20px;
        }

        .nav .active {
            background-color: white;
            color: #F17629;
        }

        .nav .active:hover {
            background-color: white;
            color: #F17629;
        }

        .menu-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #ffffff;
            border-bottom: 2px solid #F17629;
        }

        .menu-container img.logo {
            height: 60px;
            /* ปรับขนาดภาพเป็น 60px */
        }

        .menu {
            display: flex;
            justify-content: flex-end;
        }

        .menu a {
            margin: 0 10px;
            color: #F17629;
            text-decoration: none;
            font-size: 18px;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        .h11 {
            font-size: 25px;
            color: #17008a;
        }

        footer {
            background-color: #F17629;
            color: white;
            text-align: center;
            padding: 5px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>

<?php include('../user/header.php'); ?>
    <div class="menu-container">
        <div class="menu">
            <a href="user_studentloan1.php" class="btn btn-primary">หน้าแรก</a>
            <a href="user_studentloan2.php" class="btn btn-secondary">กิจกรรม</a>
            <!-- <a href="user_studentloan4.php" class="btn btn-secondary">เพิ่มเติม</a> -->
        </div>
    </div>

    <main class="container my-4">
        <div class="content mb-4">
            <span>ชั่วโมงที่ทำ: 13 / 18</span>
            <select class="form-select w-auto d-inline-block ms-2">
                <option value="1">ภาคเรียนที่ 1/67</option>
                <option value="1">ภาคเรียนที่ 2/67</option>
                <option value="1">ภาคเรียนที่ 1/68</option>
                <option value="1">ภาคเรียนที่ 2/68</option>
                <!-- Add other options here -->
            </select>
        </div>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ลำดับที่</th>
                    <th>ภาพประกอบ</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>สถานที่</th>
                    <th>รายละเอียด</th>
                    <th>ชั่วโมงที่ได้</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><img src="activity1.jpg" alt="เกี่ยวกับ การบริจาคร่างกาย" class="img-fluid" style="max-width: 100px;"></td>
                    <td>เกี่ยวกับ การบริจาคร่างกาย</td>
                    <td>โรงพยาบาลนพรัตน์</td>
                    <td>การบริจาคโลหิต</td>
                    <td>9 ชั่วโมง</td>
                    <td>ผ่าน</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><img src="activity2.jpg" alt="เกี่ยวกับ ทำความสะอาด" class="img-fluid" style="max-width: 100px;"></td>
                    <td>เกี่ยวกับ ทำความสะอาด</td>
                    <td>วัดบางเพ็งเหนือ</td>
                    <td>ทำความสะอาดบริเวณวัด</td>
                    <td>4 ชั่วโมง</td>
                    <td>ผ่าน</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><img src="activity3.jpg" alt="เกี่ยวกับ การบริจาคสิ่งของ" class="img-fluid" style="max-width: 100px;"></td>
                    <td>เกี่ยวกับ การบริจาคสิ่งของ</td>
                    <td>มูลนิธิบ้านนกขมิ้น</td>
                    <td>บริจาคสิ่งของ</td>
                    <td>4 ชั่วโมง</td>
                    <td>รอตรวจสอบ</td>
                </tr>
                <!-- เพิ่มแถวอื่น ๆ ตามต้องการ -->
            </tbody>
        </table>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>