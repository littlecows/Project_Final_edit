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
            <a href="user_studentloan2.php" class="btn btn-primary">กิจกรรม</a>
        </div>
    </div>

    <main class="container my-4">
        <h2 class="text-center mb-4">กิจกรรม</h2>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ลำดับที่</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>ชั่วโมง</th>
                    <th>เลือกทำ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="h2o">เกี่ยวกับ การบริจาคร่างกาย</td>
                    <td>สูงสุด 9 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="h2o">เกี่ยวกับ ทำความสะอาด</td>
                    <td>สูงสุด 4 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="h2o">เกี่ยวกับ การให้ความรู้</td>
                    <td>สูงสุด 4 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="h2o">เกี่ยวกับ การบริจาคสิ่งของภายนอกมหาวิทยาลัย</td>
                    <td>สูงสุด 4 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="h2o">เกี่ยวกับ การดูแล</td>
                    <td>สูงสุด 6 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td class="h2o">เกี่ยวกับ อาสาสมัคร (เฉพาะผู้มีบัตรจิตอาสา)</td>
                    <td>สูงสุด 18 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td class="h2o">เกี่ยวกับ งานหน่วยงานภายในมหาวิทยาลัย</td>
                    <td>สูงสุด 18 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td class="h2o">เกี่ยวกับ การออมเงิน กอช.</td>
                    <td>สูงสุด 5 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td class="h2o">เกี่ยวกับ สิ่งแวดล้อม</td>
                    <td>สูงสุด 4 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td class="h2o">เกี่ยวกับ หน่วยงานภายนอก</td>
                    <td>สูงสุด 8 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td class="h2o">เกี่ยวกับ e-learning</td>
                    <td>สูงสุด 18 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td class="h2o">เกี่ยวกับ ช่วยสร้างขาเทียมช่วยผู้พิการ</td>
                    <td>สูงสุด 18 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td class="h2o">เกี่ยวกับ ขอขวดเป็นของขวัญ</td>
                    <td>สูงสุด 18 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td class="h2o">เกี่ยวกับ รู้รักสามัคคี รักษ์สิ่งแวดล้อม พัฒนาคุณภาพชีวิต</td>
                    <td>สูงสุด 4 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>15</td>
                    <td class="h2o">เกี่ยวกับ ความมั่นคง</td>
                    <td>สูงสุด 8 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>16</td>
                    <td class="h2o">เกี่ยวกับ กิจกรรม 100 ปี กาชาด</td>
                    <td>สูงสุด 6 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>17</td>
                    <td class="h2o">เกี่ยวกับ งานรับปริญญา</td>
                    <td>สูงสุด 18 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>18</td>
                    <td class="h2o">เกี่ยวกับ Music Interventions for Enhancing Children Development</td>
                    <td>สูงสุด 3 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>19</td>
                    <td class="h2o">เกี่ยวกับ มหกรรมกีฬา สุขภาพดี วิถีไทย</td>
                    <td>สูงสุด 8 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>20</td>
                    <td class="h2o">เกี่ยวกับ สถาปนิก 67</td>
                    <td>สูงสุด 18 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>21</td>
                    <td class="h2o">เกี่ยวกับ วันพยาบาลสากลและวันงดสูบบุหรี่โลก</td>
                    <td>สูงสุด 6 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <tr>
                    <td>22</td>
                    <td class="h2o">เกี่ยวกับ ลอยกระทง</td>
                    <td>สูงสุด 18 ชั่วโมง</td>
                    <td><a href="user_studentloan3.php" class="btn btn-success">เลือก</a></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Kasem Bundit University</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>