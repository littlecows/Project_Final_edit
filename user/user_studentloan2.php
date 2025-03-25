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

// Fetch activities from the database
$sql = "SELECT id, name, max_hours FROM activities";
$result = $conn->query($sql);
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
        <form action="save_data.php" method="POST">
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
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td class='h2o'>" . $row["name"] . "</td>";
                            echo "<td>สูงสุด " . $row["max_hours"] . " ชั่วโมง</td>";
                            echo "<td><button type='submit' name='activity' value='" . $row["id"] . "' class='btn btn-success'>เลือก</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>ไม่มีข้อมูลกิจกรรม</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>