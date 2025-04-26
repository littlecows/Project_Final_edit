<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
    exit();
}

// Check if request is POST and required fields are provided
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || 
    !isset($_POST['faculty_id']) || empty($_POST['faculty_id']) || 
    !isset($_POST['department_name']) || empty($_POST['department_name'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'ข้อมูลไม่ครบถ้วน กรุณากรอกข้อมูลให้ครบ']);
    exit();
}

$faculty_id = intval($_POST['faculty_id']);
$department_name = trim($_POST['department_name']);

// Validate faculty ID
if ($faculty_id <= 0) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'กรุณาเลือกคณะ']);
    exit();
}

// Sanitize and validate department name
if (strlen($department_name) < 2 || strlen($department_name) > 255) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'ชื่อสาขาต้องมีความยาวระหว่าง 2-255 ตัวอักษร']);
    exit();
}

// Verify faculty exists
$facultySql = "SELECT * FROM faculty WHERE faculty_id = ?";
$facultyStmt = $conn->prepare($facultySql);
$facultyStmt->bind_param("i", $faculty_id);
$facultyStmt->execute();
$facultyResult = $facultyStmt->get_result();

if ($facultyResult->num_rows == 0) {
    $facultyStmt->close();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'ไม่พบคณะที่เลือก']);
    exit();
}
$facultyStmt->close();

// Check if department name already exists in this faculty
$checkSql = "SELECT * FROM department WHERE department_name = ? AND faculty_id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("si", $department_name, $faculty_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $checkStmt->close();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'สาขานี้มีอยู่แล้วในคณะที่เลือก']);
    exit();
}
$checkStmt->close();

// Insert new department
$insertSql = "INSERT INTO department (department_name, faculty_id) VALUES (?, ?)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("si", $department_name, $faculty_id);

if ($insertStmt->execute()) {
    $department_id = $insertStmt->insert_id;
    $insertStmt->close();
    
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true, 
        'department_id' => $department_id, 
        'department_name' => $department_name,
        'faculty_id' => $faculty_id
    ]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $conn->error]);
}

$conn->close();
?> 