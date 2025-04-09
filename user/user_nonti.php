<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

// ดึงข้อมูลจากฐานข้อมูล
$status = 1; // ค่าเริ่มต้นของสถานะ
if (isset($_GET['status'])) {
    $status = intval($_GET['status']); // รับสถานะจาก URL
}

$query = "SELECT * FROM documents WHERE status = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $status);
$stmt->execute();
$result = $stmt->get_result();

$documents = [];
while ($row = $result->fetch_assoc()) {
    $documents[] = $row;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำยินยอมตรวจสอบเอกสาร</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <style>
        /* CSS ตามที่คุณมีอยู่ */
    </style>
</head>
<body>

<?php include('../user/header.php'); ?>

<div class="container">
    <div class="step-container">
        <a href="?status=1" class="step <?= $status == 1 ? 'active' : '' ?>">1</a>
        <a href="?status=2" class="step <?= $status == 2 ? 'active' : '' ?>">2</a>
        <a href="?status=3" class="step <?= $status == 3 ? 'active' : '' ?>">3</a>
    </div>
    <h3>กำลังตรวจสอบเอกสาร</h3>
    <p>สถานะปัจจุบัน: <?= $status ?></p>
    <table border="1" style="width: 100%; margin-top: 20px;">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อเอกสาร</th>
                <th>วันที่อัปโหลด</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($documents) > 0): ?>
                <?php foreach ($documents as $index => $doc): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($doc['document_name']) ?></td>
                        <td><?= htmlspecialchars($doc['upload_date']) ?></td>
                        <td><?= htmlspecialchars($doc['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">ไม่มีข้อมูล</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>