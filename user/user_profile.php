<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

$student_id = $_SESSION['username']; // Assuming username is actually student_id
$sql = "SELECT * FROM student WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$student = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว</title>

    <link rel="stylesheet" href="../static/css/user_profile.css">
    <link rel="stylesheet" href="../static/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/bootstrap.css">


    <style>
        .info-body {
            display: grid;
            grid-template-columns: 1fr 2fr; /* คอลัมน์ซ้ายเล็ก ขวาใหญ่ */
            row-gap: 10px; /* ระยะห่างระหว่างแถว */
        }

        .info-row {
            display: contents;
        }

        .info-row strong {
            font-weight: 700;
            text-align: left;
            padding-right: 15px;
        }

        .info-row span {
            text-align: left;
        }
    </style>
</head>

<body>
    <?php include('../user/header.php'); ?>

    <div class="container" id="profile-container">
        <h2 class="title">ข้อมูลส่วนตัว</h2>
        <p class="subtitle">ข้อมูลส่วนตัวของนักศึกษา</p>

        <!-- กล่องข้อมูลส่วนตัว -->
        <div class="info-card">
            <div class="info-header">ข้อมูลส่วนตัว</div>
            <div class="gradient-line"></div>
            <div class="info-body">
                <div class="info-row"><strong>เลขบัตรประจำตัวประชาชน</strong> <span><?php echo htmlspecialchars($student["student_id"]); ?></span></div>
                <div class="info-row"><strong>เลขรหัสนักศึกษา</strong> <span><?php echo htmlspecialchars($student["student_code"]); ?></span></div>
                <div class="info-row"><strong>ชื่อ</strong> <span><?php echo htmlspecialchars($student["f_name"]); ?></span></div>
                <div class="info-row"><strong>นามสกุล</strong> <span><?php echo htmlspecialchars($student["l_name"]); ?></span></div>
                <div class="info-row"><strong>ที่อยู่</strong> <span><?php echo htmlspecialchars($student["address"]); ?></span></div>
            </div>
            <a href="user_profile_process_1.php?student_id=<?php echo htmlspecialchars($student['student_id']); ?>" class="edit-btn">
                <i class="bi bi-pencil-square"></i> แก้ไขข้อมูล
            </a>
        </div>

        <!-- กล่องข้อมูลติดต่อ -->
        <div class="info-card">
            <div class="info-header">ข้อมูลติดต่อ</div>
            <div class="gradient-line"></div>
            <div class="info-body">
                <div class="info-row"><strong>เบอร์โทรศัพท์บ้าน</strong> <span><?php echo htmlspecialchars($student["phone_number_home"]); ?></span></div>
                <div class="info-row"><strong>เบอร์โทรศัพท์มือถือ</strong> <span><?php echo htmlspecialchars($student["phone_number"]); ?></span></div>
                <div class="info-row"><strong>อีเมล</strong> <span><?php echo htmlspecialchars($student["email"]); ?></span></div>
            </div>
            <a href="user_profile_process_2.php?student_id=<?php echo htmlspecialchars($student['student_id']); ?>" class="edit-btn">
                <i class="bi bi-pencil-square"></i> แก้ไขข้อมูล
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
