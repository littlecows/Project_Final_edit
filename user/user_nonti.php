<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch document status
$sql = "SELECT * FROM documents WHERE student_id = '$student_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะเอกสารกองทุนกู้ยืม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">สถานะเอกสารกองทุนกู้ยืม</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ประเภทเอกสาร</th>
                <th>สถานะ</th>
                <th>วันที่อัปโหลด</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["document_type"]) . "</td>
                            <td>" . htmlspecialchars($row["status"]) . "</td>
                            <td>" . htmlspecialchars($row["upload_date"]) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>ไม่พบข้อมูล</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <a href="user_dashboard.php" class="btn btn-secondary">กลับไปที่แดชบอร์ด</a>
</div>
</body>
</html>