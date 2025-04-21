<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// ดึงข้อมูลปีจาก start_date และ end_date
$year_sql = "SELECT DISTINCT YEAR(start_date) AS year_start, YEAR(end_date) AS year_end FROM new_user_activities ORDER BY year_start DESC";
$year_result = $conn->query($year_sql);

// ตรวจสอบผลลัพธ์
$years = [];
if ($year_result->num_rows > 0) {
    while ($year_row = $year_result->fetch_assoc()) {
        $years[] = $year_row['year_start'];
        if ($year_row['year_end'] !== $year_row['year_start']) {
            $years[] = $year_row['year_end'];
        }
    }
    $years = array_unique($years); // ลบค่าที่ซ้ำกัน
    rsort($years); // เรียงลำดับจากมากไปน้อย
}

// รับค่าปีและเทอมจาก URL (GET)
$selected_year = isset($_GET['year']) ? $_GET['year'] : '';
$selected_term = isset($_GET['term']) ? $_GET['term'] : '';

// ปรับ SQL Query เพื่อกรองข้อมูลตามปีและเทอมที่เลือก
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
    WHERE 1=1
";

// เพิ่มเงื่อนไขกรองปี
if (!empty($selected_year)) {
    $sql .= " AND YEAR(nau.start_date) = ?";
}

// เพิ่มเงื่อนไขกรองเทอม
if (!empty($selected_term)) {
    $sql .= " AND nau.term = ?";
}

$sql .= " ORDER BY nau.created_at DESC";

// เตรียมคำสั่ง SQL
$stmt = $conn->prepare($sql);

// ตรวจสอบว่าคำสั่ง SQL ถูกเตรียมไว้สำเร็จหรือไม่
if (!$stmt) {
    die("Error preparing SQL: " . $conn->error);
}

// ผูกพารามิเตอร์
if (!empty($selected_year) && !empty($selected_term)) {
    $stmt->bind_param("ss", $selected_year, $selected_term);
} elseif (!empty($selected_year)) {
    $stmt->bind_param("s", $selected_year);
} elseif (!empty($selected_term)) {
    $stmt->bind_param("s", $selected_term);
}

// รันคำสั่ง SQL
$stmt->execute();

// ดึงผลลัพธ์
$result = $stmt->get_result();
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

        <div class="filters mb-3">
            <label for="year">ปี:</label>
            <select id="year" name="year">
                <option value="">ทั้งหมด</option>
                <?php foreach ($years as $year): ?>
                    <option value="<?php echo htmlspecialchars($year); ?>" <?php echo ($selected_year == $year) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($year); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="term">เทอม:</label>
            <select id="term" name="term">
                <option value="">ทั้งหมด</option>
                <option value="1" <?php echo ($selected_term == '1') ? 'selected' : ''; ?>>เทอม 1</option>
                <option value="2" <?php echo ($selected_term == '2') ? 'selected' : ''; ?>>เทอม 2</option>
            </select>
        </div>

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
    <script>
        document.getElementById('year').addEventListener('change', function () {
            updateFilters();
        });

        document.getElementById('term').addEventListener('change', function () {
            updateFilters();
        });

        function updateFilters() {
            const selectedYear = document.getElementById('year').value;
            const selectedTerm = document.getElementById('term').value;
            const url = new URL(window.location.href);

            if (selectedYear) {
                url.searchParams.set('year', selectedYear);
            } else {
                url.searchParams.delete('year');
            }

            if (selectedTerm) {
                url.searchParams.set('term', selectedTerm);
            } else {
                url.searchParams.delete('term');
            }

            window.location.href = url.toString();
        }
    </script>
    <div class="text-center mt-4">
        <a href="admin_dashboard.php" class="btn btn-secondary">ย้อนกลับ</a>
    </div>
</body>

</html>