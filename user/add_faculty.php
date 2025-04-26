<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
    exit();
}

// Check if request is POST and faculty_name is provided
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['faculty_name']) || empty($_POST['faculty_name'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'คณะต้องมีชื่อ']);
    exit();
}

$faculty_name = trim($_POST['faculty_name']);

// Sanitize and validate faculty name
if (strlen($faculty_name) < 2 || strlen($faculty_name) > 255) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'ชื่อคณะต้องมีความยาวระหว่าง 2-255 ตัวอักษร']);
    exit();
}

// Check if faculty name already exists
$checkSql = "SELECT * FROM faculty WHERE faculty_name = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("s", $faculty_name);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $checkStmt->close();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'คณะนี้มีอยู่แล้วในระบบ']);
    exit();
}
$checkStmt->close();

// Insert new faculty
$insertSql = "INSERT INTO faculty (faculty_name) VALUES (?)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("s", $faculty_name);

if ($insertStmt->execute()) {
    $faculty_id = $insertStmt->insert_id;
    $insertStmt->close();
    
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'faculty_id' => $faculty_id, 'faculty_name' => $faculty_name]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $conn->error]);
}

$conn->close();
?> 