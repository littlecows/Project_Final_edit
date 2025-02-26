<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id']; // รับค่าชื่อผู้ใช้
    $password = $_POST['password']; // รับค่ารหัสผ่าน

    // ตรวจสอบในตาราง user
    $sql_user = "SELECT * FROM collegian WHERE student_id = '$student_id' AND password = '$password'";
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows > 0) {
        // ถ้า user มีข้อมูล
        $user = $result_user->fetch_assoc();
        $_SESSION['student_id'] = $user['student_id'];
        $_SESSION['user_id'] = $user['user_id'];

        // ดึงข้อมูลชื่อ-นามสกุลจาก collegian
        $sql_user = "SELECT * FROM collegian WHERE student_id = ? AND password = ?";
        $stmt = $conn->prepare($sql_user);
        $stmt->bind_param("ss", $student_id, $password);
        $stmt->execute();
        $result_user = $stmt->get_result();

        $result_collegian = $conn->query($sql_collegian);


        if ($result_collegian->num_rows > 0) {
            $collegian = $result_collegian->fetch_assoc();
            $_SESSION['f_name'] = $collegian['f_name'];
            $_SESSION['l_name'] = $collegian['l_name'];
        } else {
            $_SESSION['f_name'] = "ไม่พบ";
            $_SESSION['l_name'] = "ข้อมูล";
        }

        header("Location: index.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/bootstrap-grid.css">
</head>
<body>

    <script src="../static/js/bootstrap.min.js"></script>
    <script src="../static/js/bootstrap.js"></script>
    <script src="../static/js/popper.min.js"></script>
    <script src="../static/js/jquery-3.5.1.min.js"></script>

    <div class="container">
        <nav class="header">
            <img src="../static/img/logo (1).png" alt="">
            <h1>เข้าสู่ระบบ</h1>
                
            <form method="POST" action="">
                <div class="input-box">
                    <label for="username"></label>
                    <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
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
                <p>ยังไม่มีชื่อผู้ใช้งาน?
                    <a href="register.php">ลงทะเบียน</a>
                </p> 
            </div>
        </nav>
        <div class="box-black"></div>
    </div>

</body>
</html>
