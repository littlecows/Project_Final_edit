<?php
// เชื่อมต่อฐานข้อมูล
session_start();
include '/xampp/htdocs/Project_Final/server.php';
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลนักเรียน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ตั้งค่า Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            color: #333;
            padding-top: 20px;
            border-right: 2px solid #ddd;
        }

        .sidebar img {
            display: block;
            width: 80%;
            margin: 0 auto 10px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .sidebar ul li a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 16px;
            transition: 0.3s;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 18px;
            color: #F17629;
        }

        .sidebar ul li a:hover {
            background: #f5f5f5;
            padding-left: 10px;
            border-radius: 5px;
        }

        /* ตั้งค่าเนื้อหาหลัก */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .box_head {
            background: #F17629;
            color: white;
            padding: 15px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
        }

        .status-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .status-card {
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .pending { background-color: #f8c471; }
        .in-review { background-color: #5d6d7e; }
        .approved { background-color: #7dcea0; }

        /* ตาราง */
        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f17629;
            color: white;
        }

        /* ปุ่มแก้ไข */
        .btn-edit {
            background-color: #f17629;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e65c00;
            color: white;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center rounded-pill mb-4 col px-md-5 btn-edit ">แก้ไขข้อมูลนักเรียน</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Student ID</th>
                <th>Student Code</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["student_id"]) . "</td>
                            <td>" . htmlspecialchars($row["student_code"]) . "</td>
                            <td>" . htmlspecialchars($row["f_name"]) . "</td>
                            <td>" . htmlspecialchars($row["l_name"]) . "</td>
                            <td>" . htmlspecialchars($row["address"]) . "</td>
                            <td><a href='admin_edit_student_process.php?student_id=" . htmlspecialchars($row["student_id"]) . "' class='btn  btn-edit'>แก้ไข</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>ไม่พบข้อมูล</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <a href="admin_dashboard.php" class="btn btn-secondary">กลับไปที่แดชบอร์ด</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
