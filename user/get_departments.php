<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Unauthorized access']);
    exit();
}

// Check if faculty_id is provided
if (!isset($_GET['faculty_id']) || empty($_GET['faculty_id'])) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Faculty ID is required']);
    exit();
}

$faculty_id = intval($_GET['faculty_id']);

// Prepare SQL query to get departments for the selected faculty
$sql = "SELECT department_id, department_name FROM department WHERE faculty_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Database query preparation failed']);
    exit();
}

$stmt->bind_param("i", $faculty_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Database query execution failed']);
    exit();
}

// Fetch all departments for the selected faculty
$departments = [];
while ($row = $result->fetch_assoc()) {
    $departments[] = [
        'department_id' => $row['department_id'],
        'department_name' => $row['department_name']
    ];
}

// Return departments as JSON
header('Content-Type: application/json');
echo json_encode($departments);

$stmt->close();
$conn->close();
?> 