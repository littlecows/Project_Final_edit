<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// ดึงข้อมูลเอกสารจากฐานข้อมูล
$query = "SELECT id, document_name, upload_date, status FROM documents";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบสถานะเอกสาร</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <style>
        .btn-check {
            background-color: #5d6d7e;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-check:hover {
            background-color: #34495e;
        }

        .btn-score {
            background-color: #7dcea0;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-score:hover {
            background-color: #52be80;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">ตรวจสอบสถานะเอกสาร</h2>
        <p class="text-center">ข้อมูลเอกสารที่ส่งเข้ามาในระบบ</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อเอกสาร</th>
                    <th>วันที่อัปโหลด</th>
                    <th>สถานะ</th>
                    <th>การดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['document_name']) ?></td>
                            <td><?= htmlspecialchars($row['upload_date']) ?></td>
                            <td>
                                <?php
                                switch ($row['status']) {
                                    case 1:
                                        echo "รอดำเนินการ";
                                        break;
                                    case 2:
                                        echo "กำลังตรวจสอบ";
                                        break;
                                    case 3:
                                        echo "อนุมัติแล้ว";
                                        break;
                                    default:
                                        echo "ไม่ทราบสถานะ";
                                }
                                ?>
                            </td>
                            <td>
                                <button class="btn-check" onclick="checkDocument(<?= $row['id'] ?>)">ตรวจเอกสาร</button>
                                <button class="btn-score" onclick="giveScore(<?= $row['id'] ?>)">ให้คะแนน</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">ไม่มีข้อมูลเอกสาร</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        function checkDocument(id) {
            if (confirm("คุณต้องการตรวจเอกสารนี้หรือไม่?")) {
                window.location.href = `check_document.php?id=${id}`;
            }
        }

        function giveScore(id) {
            const score = prompt("กรุณากรอกคะแนน (0-100):");
            if (score !== null && !isNaN(score) && score >= 0 && score <= 100) {
                window.location.href = `give_score.php?id=${id}&score=${score}`;
            } else {
                alert("กรุณากรอกคะแนนที่ถูกต้อง!");
            }
        }
    </script>
</body>

</html>