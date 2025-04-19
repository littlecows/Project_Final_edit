<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// เพิ่ม Debug: แสดงค่า $_SESSION['username']
echo "Session username: " . htmlspecialchars($_SESSION['username']);

// ดึงข้อมูลเฉพาะนักศึกษาคนนี้ (ใช้ $_SESSION['username'])
// ดึงข้อมูลเฉพาะนักศึกษาคนนี้ (ใช้ $_SESSION['username'])
// ดึงข้อมูลเฉพาะนักศึกษาคนนี้ (ใช้ $_SESSION['username'])
$sql = "
    SELECT 
        nau.id, 
        nau.activity_name, 
        nau.hours AS hours_completed, -- ชั่วโมงที่ทำได้
        nau.location, 
        nau.details, 
        nau.image_path, 
        nau.username, 
        stu.f_name, 
        stu.l_name,
        ua.max_hours -- เพิ่มคอลัมน์ max_hours จากตาราง user_activities
    FROM 
        new_user_activities nau
    LEFT JOIN 
        student stu      
    ON 
        nau.username = stu.student_id -- เชื่อมโยงโดยใช้ student_id
    LEFT JOIN 
        user_activities ua -- เชื่อมโยงกับตาราง user_activities
    ON 
        nau.activity_id = ua.activity_id -- เชื่อมโยงผ่าน activity_id
    WHERE 
        nau.username = ? -- กรองข้อมูลเฉพาะ username ของนักศึกษาคนนี้
    ORDER BY 
        nau.created_at DESC;
";

// เตรียมคำสั่ง SQL แบบ prepared statement เพื่อป้องกัน SQL Injection
$stmt = $conn->prepare($sql);

// ตรวจสอบว่าคำสั่ง SQL ถูกเตรียมไว้สำเร็จหรือไม่
if (!$stmt) {
    die("Error preparing SQL: " . $conn->error);
}

// ผูกพารามิเตอร์
$stmt->bind_param("s", $_SESSION['username']);

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
    <title>กิจกรรมจิตสาธารณะ</title>

    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">

    <!-- Internal CSS -->
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        /* Header */
        header {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 24px;
            color: #333;
        }

        /* Main Content */
        main {
            padding: 20px;
        }

        /* Filter Section */
        .filter-section {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end; /* จัดให้อยู่ชิดขวา */
            gap: 10px; /* ระยะห่างระหว่างองค์ประกอบ */
            padding-right: 20px; /* เพิ่มระยะห่างจากขอบขวา */
        }

        .filter-section label {
            margin-right: 5px;
        }

        .filter-section select {
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filter-section button {
            padding: 5px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .filter-section button:hover {
            background-color: #0056b3;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        /* Adjust table text alignment to left */
        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left; /* ค่า 기본: ชิดซ้าย */
        }

        /* กำหนด alignment สำหรับคอลัมน์ "ชั่วโมง" และ "ชั่วโมงที่ได้" */
        table th:nth-child(3),
        table th:nth-child(4),
        table td:nth-child(3),
        table td:nth-child(4) {
            text-align: center; /* ตรงกลาง */
        }

        /* Header of the table */
        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        /* Footer of the table (Total Hours) */
        table tfoot tr {
            background-color: #e9ecef; /* Light gray background for total row */
        }

        /* กำหนด alignment สำหรับ td ใน tfoot */
        table tfoot td {
            text-align: center; /* ตรงกลาง */
            font-weight: bold; /* Bold text for total hours */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
        }

        /* Custom Header Style */
        h1 {
            text-align: right; /* จัดข้อความให้ชิดขวา */
            margin-right: 20px; /* เพิ่มระยะห่างจากขอบขวา */
            margin-top: 20px; /* เพิ่มระยะห่างจากขอบบน */
            margin-bottom: 20px; /* เพิ่มระยะห่างจากขอบล่าง */
            font-size: 32px; /* ปรับขนาดตัวอักษรให้ใหญ่ขึ้น */
            color: #333; /* สีของข้อความ */
        }

        /* กำหนด alignment สำหรับ td ใน tfoot */
        table tfoot td {
            text-align: left; /* ชิดซ้าย */
            font-weight: bold; /* ทำให้ข้อความเป็นตัวหนา */
            padding-left: 10px; /* เพิ่มระยะห่างจากขอบซ้าย */
        }

        /* กำหนด alignment สำหรับ td ใน tfoot */
        table tfoot td:first-child {
            text-align: left; /* ชิดซ้ายสำหรับข้อความ "รวมชั่วโมงทั้งหมด" */
            font-weight: bold; /* ทำให้ข้อความเป็นตัวหนา */
            padding-left: 10px; /* เพิ่มระยะห่างจากขอบซ้าย */
        }

        table tfoot td:last-child {
            text-align: center; /* จัดตัวเลขให้อยู่ตรงกลาง */
            font-weight: bold; /* ทำให้ตัวเลขเป็นตัวหนา */
        }

        /* จัดข้อความในคอลัมน์ "ลำดับ" และ "ชื่อกิจกรรม" ให้อยู่ตรงกลาง */
        table th:nth-child(1),
        table td:nth-child(1),
        table th:nth-child(2),
        table td:nth-child(2) {
            text-align: center; /* จัดให้อยู่ตรงกลาง */
        }
    </style>
</head>

<body>

<?php include('../user/header.php'); ?>


<h1>กิจกรรมจิตสาธารณะ กยศ</h1>

<!-- Filter Section -->
<div class="filter-section">
    <form>
        <label for="year">เลือกปี:</label>
        <select id="year" name="year">
            <option value="">ทั้งหมด</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
        </select>

        <label for="term">เลือกเทอม:</label>
        <select id="term" name="term">
            <option value="">ทั้งหมด</option>
            <option value="1">เทอม 1</option>
            <option value="2">เทอม 2</option>
        </select>

        <button type="submit">กรองข้อมูล</button>
    </form>
</div>

<!-- Main Content -->
<main>
    <table id="activity-table">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อกิจกรรม</th>
                <th>ชั่วโมงสูงสุด</th>
                <th>ชั่วโมงที่ทำได้</th>
            </tr>
        </thead>
        <tbody>
    <?php
    if ($result->num_rows > 0) {
        $count = 1; // ตัวนับลำดับ
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($count) . "</td>";
            echo "<td>" . htmlspecialchars($row["activity_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["max_hours"]) . "</td>"; // ชั่วโมงสูงสุด
            echo "<td>" . htmlspecialchars($row["hours_completed"]) . "</td>"; // ชั่วโมงที่ทำได้
            echo "</tr>";

            $total_hours += $row["hours_completed"];
            $count++;
        }
    } else {
        echo "<tr><td colspan='5'>ไม่มีข้อมูลกิจกรรม</td></tr>";
    }
    ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="3">รวมชั่วโมงทั้งหมด:</td>
        <td><strong><?php echo htmlspecialchars($total_hours); ?></strong></td>
    </tr>
</tfoot>
        <tfoot>
            <tr>
                <td colspan="3">รวมชั่วโมงทั้งหมด:</td>
                <td><strong><?php echo htmlspecialchars($total_hours); ?></strong></td>
            </tr>
        </tfoot>
    </table>
</main>

</body>
</html>