<?php
session_start();


$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$login_error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']);
unset($_SESSION['username']);
?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f8f9fa;
    }
    .login-container {  
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-container h2 {
        margin-bottom: 20px;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="adminlogin_process.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <div class="register-link">
                    <p>ไม่มีบัญชีเข้าใช้งาน
                        <a href="../admin/adminregister.php">สมัคร</a>
                    </p>
                </div>
        </form>
        <?php
    if ($login_error) {
        echo "<p style='color:red;'>$login_error</p>";
    }
    ?>
    </div>
</body>

