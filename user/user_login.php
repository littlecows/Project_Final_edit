<?php

session_start();

include 'server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    print_r($student_id);
    print_r($password);

    // สร้างคำสั่ง SQL
    $sql = "SELECT * FROM collegian WHERE student_id = '$student_id' AND password = '$password'";

    // รันคำสั่ง SQL
    $result = $conn->query($sql);

    print_r($result);

    // ตรวจสอบรหัสผ่านแบบธรรมดา (ไม่เข้ารหัส)
if ($password === $user['password']) {
    $_SESSION['student_id'] = $user['student_id'];
    $_SESSION['f_name'] = $user['f_name'];
    $_SESSION['l_name'] = $user['l_name'];
    header("Location: index.php");
    exit();
} else {
    echo "รหัสผ่านไม่ถูกต้อง!";
}

    // ปิดการเชื่อมต่อ
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กองทุน</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">

</head>
<body>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>


    <div class="container">
        <nav class="header">
            <img src="logo (1).png" alt="">
            <h1>เข้าสู่ระบบ</h1>
                
                <form method="POST" action="">
                    <div class="input-box">
                        <label for="student_id"></label>
                        <input type="text" name="student_id" placeholder="เลขบัตรประจำตัวประชาชน" required>
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
                    <a href="#">เข้าสู่ระบบสำหรับเจ้าหน้าที่</a>
                </div>

        </nav>
        <div class="box-black"></div>
    </div>
</body>
</html>
