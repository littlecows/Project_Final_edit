<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// ดึงข้อมูลเอกสารจากฐานข้อมูล
$query = "SELECT username, activity_name, locations,details,image_path,h_hours,created_at,  status FROM new_user_activities";
// ตรวจสอบการเชื่อมต่อ
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
                    <th>ผู้ทำ</th>
                    <th>ชื่อจิตกรรม</th>
                    <th>สถานที่</th>
                    <th>คำอธิบาย</th>
                    <th>รูปจิตอาสา</th>
                    <th>ชั่วโมง</th>
                    <th>วันที่ส่ง</th>
                    <th>สถานะ</th>
                    

                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['activity_name']) ?></td>
                            <td><?= htmlspecialchars($row['locations']) ?></td>
                            <td><?= htmlspecialchars($row['details']) ?></td>
                            <td><img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Document Image" style="max-width: 100px;"></td>
                            <td><?= htmlspecialchars($row['h_hours']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>

                        
                            
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
                                <button class="btn-check" onclick="checkDocument('<?= htmlspecialchars($row['username']) ?>')">ตรวจเอกสาร</button>
                                <button class="btn-score" onclick="giveScore('<?= htmlspecialchars($row['username']) ?>')">ให้คะแนน</button>
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
        function checkDocument(username) {
            if (confirm("คุณต้องการตรวจเอกสารนี้หรือไม่?")) {
                window.location.href = `check_document.php?username=${encodeURIComponent(username)}`;
            }
        }

        function giveScore(username) {
            const h_hours = prompt("กรุณากรอกคะแนน (0-100):");
            if (h_hours !== null && !isNaN(h_hours) && h_hours >= 0 && h_hours <= 100) {
                window.location.href = `give_score.php?username=${encodeURIComponent(username)}&h_hours=${h_hours}`;
            } else {
                alert("กรุณากรอกคะแนนที่ถูกต้อง!");
            }
        }
    </script>
</body>

</html>