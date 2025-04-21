<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// ดึงข้อมูลนักศึกษาทั้งหมด
$sql = "
    SELECT 
        nau.id, 
        nau.activity_name, 
        nau.hours AS hours_completed, 
        nau.location, 
        nau.details, 
        nau.image_path, 
        nau.username, 
        stu.f_name, 
        stu.l_name,
        act.max_hours,
        nau.created_at
    FROM 
        new_user_activities nau
    LEFT JOIN 
        student stu      
    ON 
        nau.username = stu.student_id
    LEFT JOIN 
        activities act
    ON 
        nau.activity_id = act.id
    ORDER BY 
        nau.created_at DESC;
";

// เตรียมคำสั่ง SQL
$result = $conn->query($sql);
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
        <h2 class="text-center">ตรวจสอบเอกสารจิตอาสา</h2>
        <p class="text-center">ข้อมูลเอกสารที่ส่งเข้ามาในระบบ</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>ชื่อจิตกรรม</th>
                    <th>ชั่วโมงสูงสุด</th>
                    <th>ชั่วโมงที่ทำได้</th>
                    <th>สถานที่</th>
                    <th>คำอธิบาย</th>
                    <th>รูปภาพ</th>
                    <th>วันที่สร้าง</th>
                    <th>เพิ่มชั่วโมง</th> <!-- เพิ่มหัวข้อสำหรับปุ่ม -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $count = 1; // ตัวนับลำดับ
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($count) . "</td>";
                        echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["activity_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["max_hours"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["hours_completed"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["location"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["details"]) . "</td>";
                        // แสดงรูปภาพ
                        if (!empty($row["image_path"])) {
                            echo "<td><img src='" . htmlspecialchars($row["image_path"]) . "' alt='Activity Image' style='width: 100px; height: auto;'></td>";
                        } else {
                            echo "<td>ไม่มีรูปภาพ</td>";
                        }
                        // แสดงวันที่สร้าง
                        echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                        // เพิ่มปุ่มสำหรับใส่ชั่วโมง
                        echo "<td>
                                <form method='POST' action='save_hours.php'>
                                    <input type='hidden' name='activity_id' value='" . htmlspecialchars($row["id"]) . "'>
                                    <input type='number' name='hours' min='0' max='" . htmlspecialchars($row["max_hours"]) . "' required>
                                    <button type='submit' class='btn btn-primary'>บันทึก</button>
                                </form>
                              </td>";
                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>ไม่มีข้อมูลกิจกรรม</td></tr>";
                }
                ?>
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
    <div class="text-center mt-4">
        <a href="admin_dashboard.php" class="btn btn-secondary">ย้อนกลับ</a>
    </div>
</body>

</html>