<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "kbuloan"; // ชื่อฐานข้อมูลที่ใช้

// สร้างการเชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลกิจกรรมทั้งหมด
function getActivities() {
    global $conn;
    $sql = "SELECT * FROM addactivities";
    $result = $conn->query($sql);
    $activities = [];
    while($row = $result->fetch_assoc()) {
        $activities[] = $row;
    }
    return $activities;
}

// ดึงกิจกรรมตาม ID
function getActivityById($id) {
    global $conn;
    $sql = "SELECT * FROM addactivities WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// เพิ่มหรือแก้ไขกิจกรรม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $hour = $_POST['hour'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $file = $_FILES['file'];

    // อัปโหลดไฟล์
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    if ($file['name']) {
        move_uploaded_file($file["tmp_name"], $target_file);
    } else {
        $target_file = $_POST['existingFile'] ?? ''; // ใช้ไฟล์เดิมถ้าไม่อัปโหลดใหม่
    }

    // ถ้าเป็นการแก้ไข
    if ($id) {
        $sql = "UPDATE addactivities SET name='$name', hour='$hour', startDate='$startDate', endDate='$endDate', file='$target_file' WHERE id=$id";
    } else {
        // ถ้าเป็นการเพิ่มใหม่
        $sql = "INSERT INTO addactivities (name, hour, startDate, endDate, file) VALUES ('$name', '$hour', '$startDate', '$endDate', '$target_file')";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: index.html');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

// ลบกิจกรรม
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM addactivities WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
}

$conn->close();
?>
