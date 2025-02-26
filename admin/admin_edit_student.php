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

// ตรวจสอบว่ามีการส่งค่า student_id มาหรือไม่
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูล";
        exit();
    }
} else {
    echo "ไม่พบข้อมูล";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">แก้ไขข้อมูล</h2>
    <form action="adminedit_process.php" method="POST">
        <div class="mb-3">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo htmlspecialchars($row['student_id']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="student_code" class="form-label">Student Code</label>
            <input type="text" class="form-control" id="student_code" name="student_code" value="<?php echo htmlspecialchars($row['student_code']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="f_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="f_name" name="f_name" value="<?php echo htmlspecialchars($row['f_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="l_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="l_name" name="l_name" value="<?php echo htmlspecialchars($row['l_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>
</body>
</html>
