<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำยินยอมตรวจสอบเอกสาร</title>

    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">

    <style>
        .container {
            width: 50%;
            padding: 20px;
            background-color: white;
            border: 2px solid #F17629;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 50px; /* เพิ่มระยะห่างจากด้านบน */
        }

        .step-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .step {
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background-color: #ccc;
            color: white;
            font-weight: bold;
        }

        .step.active {
            background-color: #F17629;
        }

        .step::after {
            content: '';
            position: absolute;
            top: 15px;
            width: calc(100% - 60px);
            height: 2px;
            background-color: #ccc;
            z-index: -1;
        }

        .step:first-child::after {
            left: 30px;
        }

        .step:last-child::after {
            right: 30px;
            width: calc(100% - 60px);
        }

        .step.active + .step::after {
            background-color: #F17629;
        }

        h3 {
            margin: 20px 0;
        }

        button {
            padding: 10px 20px;
            background-color: #F17629;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #e06a0d;
        }
    </style>
</head>
<body>

<?php include('../user/header.php'); ?>

<div class="container">
    <div class="step-container">
        <div class="step active">1</div>
        <div class="step">2</div>
        <div class="step">3</div>
    </div>
    <h3>คำยินยอมตรวจสอบเอกสาร</h3>
    <p>วันที่ทำการลงทะเบียน 08 ก.พ. 2567</p>
    <button>รายละเอียดการลงทะเบียน</button>
</div>

</body>
</html>