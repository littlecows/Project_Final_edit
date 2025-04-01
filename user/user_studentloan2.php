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

// Fetch activities from the database
$sql = "SELECT id, name, max_hours FROM activities";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['activity'])) {
    $activity_id = $_GET['activity'];
    $sql_activity = "SELECT * FROM activities WHERE id = ?";
    $stmt = $conn->prepare($sql_activity);
    $stmt->bind_param("i", $activity_id);
    $stmt->execute();
    $activity_result = $stmt->get_result();
    if ($activity_result->num_rows > 0) {
        $activity = $activity_result->fetch_assoc();
        $_SESSION['selected_activity'] = $activity;
        header("Location: user_studentloan3.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรม</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('../user/header.php'); ?>
    <div class="menu-container">
        <div class="menu">
            <a href="user_studentloan1.php" class="btn btn-primary">หน้าแรก</a>
            <a href="user_studentloan2.php" class="btn btn-secondary">กิจกรรม</a>
            <a href="user_studentloan4.php" class="btn btn-secondary">เพิ่มเติม</a>
        </div>
    </div>
    <main class="container my-4">
        <h2 class="text-center mb-4">กิจกรรม</h2>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ลำดับที่</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>ชั่วโมง</th>
                    <th>เลือกทำ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td class='h2o'>" . $row["name"] . "</td>";
                        echo "<td>สูงสุด " . $row["max_hours"] . " ชั่วโมง</td>";
                        echo "<td><a href='user_studentloan2.php?activity=" . $row["id"] . "' class='btn btn-success'>เลือก</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>ไม่มีข้อมูลกิจกรรม</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Kasem Bundit University</p>
    </footer>
</body>
</html>