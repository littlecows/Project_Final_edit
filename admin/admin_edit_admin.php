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
$sql = "SELECT * FROM admins";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลอาจารย์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">แก้ไขข้อมูล Admin</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Admin_id</th>
                <th>Username</th>
                <th>Admin_email</th>
                <th>password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["admin_id"]) . "</td>
                            <td>" . htmlspecialchars($row["username"]) . "</td>
                            <td>" . htmlspecialchars($row["admin_email"]) . "</td>
                            <td><a href='admin_edit_admin_process.php?admin_id=" . htmlspecialchars($row["admin_id"]) . "' class='btn btn-primary'>แก้ไข</a></td>
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
