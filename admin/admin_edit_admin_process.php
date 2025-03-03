<?php
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

if (isset($_GET['admin_id'])) {
    $admin_id = intval($_GET['admin_id']);

    // ดึงข้อมูล admin จากฐานข้อมูล
    $sql = "SELECT * FROM admins WHERE admin_id = $admin_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูล";
        exit();
    }
} else {
    echo "ไม่มีการระบุ ID admin";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูล Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">แก้ไขข้อมูล Admin</h2>
    <form action="admin_edit_admin_process_save.php" method="POST">
        <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($row['admin_id']); ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="admin_email" class="form-label">Admin Email</label>
            <input type="email" class="form-control" id="admin_email" name="admin_email" value="<?php echo htmlspecialchars($row['admin_email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>
</body>
</html>
