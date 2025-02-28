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

if (isset($_GET['officer_id'])) {
    $officer_id = intval($_GET['officer_id']);

    // ดึงข้อมูลนักเรียนจากฐานข้อมูล
    $sql = "SELECT * FROM teacher WHERE officer_id = $officer_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูล";
        exit();
    }
} else {
    echo "ไม่มีการระบุ ID อาจารย์";
    exit();
}
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
    <h2 class="mb-4">แก้ไขข้อมูลอาจารย์</h2>
    <form action="admin_edit_teacher_process_save.php" method="POST">
        <input type="hidden" name="officer_id" value="<?php echo htmlspecialchars($row['officer_id']); ?>">
        <!-- <div class="mb-3">
            <label for="officer_id" class="form-label">officer_id</label>
            <input type="text" class="form-control" id="officer_id" name="officer_id" value="<?php echo htmlspecialchars($row['officer_id']); ?>" required>
        </div> -->
        <div class="mb-3">
            <label for="f_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="f_name" name="f_name" value="<?php echo htmlspecialchars($row['f_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="l_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="l_name" name="l_name" value="<?php echo htmlspecialchars($row['l_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="campus" class="form-label">campus</label>
            <input type="text" class="form-control" id="campus" name="campus" value="<?php echo htmlspecialchars($row['campus']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="room_number" class="form-label">room_number</label>
            <input type="text" class="form-control" id="room_number" name="room_number" value="<?php echo htmlspecialchars($row['room_number']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">position</label>
            <input type="text" class="form-control" id="position" name="position" value="<?php echo htmlspecialchars($row['position']); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>
</body>
</html>
