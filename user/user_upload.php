<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['student_id'];
    $document_type = $_POST['document_type'];
    $document_file = '';

    // Handle file upload
    if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] == 0) {
        $uploads_dir = '/xampp/htdocs/Project_Final/uploads/documents';
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }
        $document_file = $uploads_dir . '/' . basename($_FILES['document_file']['name']);
        move_uploaded_file($_FILES['document_file']['tmp_name'], $document_file);
    }

    // Insert data into the database
    $sql = "INSERT INTO documents (student_id, document_type, document_file) VALUES ('$student_id', '$document_type', '$document_file')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('อัปโหลดเอกสารสำเร็จ'); window.location.href='user_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อัปโหลดเอกสารกองทุนกู้ยืม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">อัปโหลดเอกสารกองทุนกู้ยืม</h2>
    <form action="upload_document.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="document_type" class="form-label">ประเภทเอกสาร</label>
            <select class="form-control" id="document_type" name="document_type" required>
                <option value="loan_application">แบบฟอร์มการกู้ยืม</option>
                <option value="loan_agreement">สัญญาการกู้ยืม</option>
                <option value="other">อื่น ๆ</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="document_file" class="form-label">ไฟล์เอกสาร</label>
            <input type="file" class="form-control" id="document_file" name="document_file" required>
        </div>
        <button type="submit" class="btn btn-primary">อัปโหลดเอกสาร</button>
        <a href="user_dashboard.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>
</body>
</html>