<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../admin/adminlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome to Admin Dashboard</h2>
    <a href="logout.php">Logout</a>
</body>
</html>
