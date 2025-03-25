<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // รับค่าชื่อผู้ใช้ หรือเลขบัตรประชาชน
    $password = $_POST['password']; // รับค่ารหัสผ่าน

    // ตรวจสอบในตาราง user (สำหรับเจ้าหน้าที่)
    $sql_user = "SELECT * FROM teacher WHERE officer_id  = '$username' AND password_hash = '$password'";
    $result_user = $conn->query($sql_user);

    // ตรวจสอบในตาราง collegian (สำหรับนักศึกษา)
    $sql_collegian = "SELECT * FROM student WHERE student_id = '$username'";
    $result_collegian = $conn->query($sql_collegian);

    if ($result_user->num_rows > 0) {
        // ถ้าเป็นเจ้าหน้าที่ (user)
        $user = $result_user->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = "user";
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: index.php");
        exit();
    } elseif ($result_collegian->num_rows > 0) {
        // ถ้าเป็นนักศึกษา (collegian)
        $collegian = $result_collegian->fetch_assoc();
        $_SESSION['username'] = $collegian['student_id']; 
        $_SESSION['role'] = "collegian";
        $_SESSION['user_id'] = $collegian['student_id'];
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid ID or password.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กองทุน</title>
    <link rel="stylesheet" href="../static/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
</head>
<body>

    <script src="../static/js/bootstrap.min.js"></script>

    <div class="container">
        <nav class="header">
            <img src="../static/img/logo.png" alt="">
            <h1>เข้าสู่ระบบ</h1>
                
            <form method="POST" action="">
                <div class="input-box">
                    <label for="username"></label>
                    <input type="text" name="username" placeholder="เลขบัตรประจำตัวประชาชน / ชื่อผู้ใช้" required>
                </div>

                <div class="input-box">
                    <label for="password"></label>
                    <input type="password" name="password" placeholder="รหัสผ่าน" required>
                </div>

                <button type="submit" class="btn">เข้าสู่ระบบ</button>
            </form>

            <div class="remember-forgot">
                <label> <input type="checkbox">จดจำฉันไว้</label>
                <a href="#">ลืมรหัสผ่าน</a>
            </div>

            <div class="register-link">
                <p>ยังไม่มีชื่อผู้ใช้งาน
                    <a href="register.php">ลงทะเบียนขอสิทธิ์เข้าใช้งาน</a>
                </p> 
            </div>

            <div class="register-link-2">
                <a href="../admin/adminlogin.php">เข้าสู่ระบบสำหรับเจ้าหน้าที่</a>
            </div>
        </nav>
        <div class="box-black"></div>
    </div>
</body>
</html>
