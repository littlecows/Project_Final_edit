<?php
// เชื่อมต่อฐานข้อมูล
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

// ดึงข้อมูลจากฐานข้อมูล
$student_id = $_SESSION['username']; // Assuming username is actually student_id
$sql = "SELECT * FROM student WHERE student_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Execute failed: " . htmlspecialchars($stmt->error));
}
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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>เลขบัตรประจำตัวประชาชน</th>
                            <th>เลขรหัสนักศึกษา</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>ที่อยู่</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                            <td>" . htmlspecialchars($row["student_id"]) . "</td>
                            <td>" . htmlspecialchars($row["student_code"]) . "</td>
                            <td>" . htmlspecialchars($row["f_name"]) . "</td>
                            <td>" . htmlspecialchars($row["l_name"]) . "</td>
                            <td>" . htmlspecialchars($row["address"]) . "</td>
                            <td><a href='user_profile_process.php?student_id=" . htmlspecialchars($row["student_id"]) . "' class='edit-btn'><i class='bi bi-pencil-square'></i> แก้ไขข้อมูล</a></td>
                          </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>ไม่พบข้อมูล</td></tr>";
                        }
                        $stmt->close();
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- กล่องข้อมูลติดต่อ -->
        <div class="info-card">
            <div class="info-header">ข้อมูลติดต่อ</div>
            <div class="gradient-line"></div>
            <div class="info-body">
                <p><strong>เบอร์โทรศัพท์บ้าน</strong> - </p>
                <p><strong>เบอร์โทรศัพท์มือถือ</strong> 094-112-XXXX</p>
                <p><strong>อีเมล</strong> your@email.com</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>