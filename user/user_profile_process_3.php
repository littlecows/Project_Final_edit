<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['student_id'])) {
    $student_id = intval($_GET['student_id']);

    // ดึงข้อมูลนักเรียนจากฐานข้อมูล
    $sql = "SELECT student.*, mother.mother_name, mother.mother_last_name, father.father_name, father.father_last_name, father.father_id, mother.mother_id, mother.mother_address, father.father_address, mother.mother_phone_number, father.father_phone_number, mother.mother_occupation, father.father_occupation, mother.mother_income, father.father_income, student.phone_number_home
            FROM student 
            LEFT JOIN mother ON student.mother_id = mother.mother_id 
            LEFT JOIN father ON student.father_id = father.father_id 
            WHERE student.student_id = $student_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูล";
        exit();
    }
} else {
    echo "ไม่มีการระบุ ID นักเรียน";
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลนักเรียน</title>

    <link rel="stylesheet" href="../static/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ปรับพื้นหลังและฟอร์ม */
        body {
            background: #f4f7f6;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border: 2px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-primary {
            background: #F17629;
            border: none;
        }

        .btn-primary:hover {
            background: #d65c1e;
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        @media (max-width: 768px) {
            .container {
                max-width: 90%;
            }
        }
    </style>

    <!-- <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script> -->
</head>

<body>

    <?php include('../user/header.php'); ?>

    <div class="container mt-5">
        <h2 class="mb-4">สถานภาพครอบครัว</h2>
        <form action="user_profile_process_save3.php" method="POST" onsubmit="return validateForm()">
    <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($row['student_id']); ?>">

    <!-- Father Information -->
    <h4 class="mb-4">ข้อมูลบิดา</h4>
    <div class="mb-3">
        <label for="father_name" class="form-label">ชื่อ</label>
        <input type="text" class="form-control" id="father_name" name="father_name"
            value="<?php echo htmlspecialchars($row['father_name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="father_last_name" class="form-label">นามสกุล</label>
        <input type="text" class="form-control" id="father_last_name" name="father_last_name"
            value="<?php echo htmlspecialchars($row['father_last_name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="father_id" class="form-label">เลขบัตรประจำตัวประชาชน</label>
        <input type="text" class="form-control" id="father_id" name="father_id"
            value="<?php echo htmlspecialchars($row['father_id']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="father_address" class="form-label">ที่อยู่</label>
        <input type="text" class="form-control" id="father_address" name="father_address"
            value="<?php echo htmlspecialchars($row['father_address']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="father_occupation" class="form-label">อาชีพ</label>
        <input type="text" class="form-control" id="father_occupation" name="father_occupation"
            value="<?php echo htmlspecialchars($row['father_occupation']); ?>" required>
    </div>
    <div class="md-3">
        <label for="father_income" class="form-label">เงินเดือนบิดา</label>
        <input type="text" class="form-control" id="father_income" name="father_income"
            value="<?php echo htmlspecialchars($row['father_income']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="father_phone_number" class="form-label">เบอร์โทรศัพท์</label>
        <input type="text" class="form-control" id="father_phone_number" name="father_phone_number"
            value="<?php echo htmlspecialchars($row['father_phone_number']); ?>" required>
    </div>

    <!-- Mother Information -->
    <h4 class="mb-4">ข้อมูลมารดา</h4>
    <div class="mb-3">
        <label for="mother_name" class="form-label">ชื่อ</label>
        <input type="text" class="form-control" id="mother_name" name="mother_name"
            value="<?php echo htmlspecialchars($row['mother_name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="mother_last_name" class="form-label">นามสกุล</label>
        <input type="text" class="form-control" id="mother_last_name" name="mother_last_name"
            value="<?php echo htmlspecialchars($row['mother_last_name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="mother_id" class="form-label">เลขบัตรประจำตัวประชาชน</label>
        <input type="text" class="form-control" id="mother_id" name="mother_id"
            value="<?php echo htmlspecialchars($row['mother_id']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="mother_address" class="form-label">ที่อยู่</label>
        <input type="text" class="form-control" id="mother_address" name="mother_address"
            value="<?php echo htmlspecialchars($row['mother_address']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="mother_occupation" class="form-label">อาชีพ</label>
        <input type="text" class="form-control" id="mother_occupation" name="mother_occupation"
            value="<?php echo htmlspecialchars($row['mother_occupation']); ?>" required>
    </div>
    <div class="md-3">
        <label for="mother_income" class="form-label">เงินเดือนมารดา</label>
        <input type="text" class="form-control" id="mother_income" name="mother_income"
            value="<?php echo htmlspecialchars($row['mother_income']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="mother_phone_number" class="form-label">เบอร์โทรศัพท์</label>
        <input type="text" class="form-control" id="mother_phone_number" name="mother_phone_number"
            value="<?php echo htmlspecialchars($row['mother_phone_number']); ?>" required>
    </div>

    <!-- Family Status -->
    <div class="mb-3">
        <label for="family_status" class="form-label">สถานภาพครอบครัว</label>
        <select class="form-control" id="family_status" name="family_status" required>
            <option value="สมรส">สมรส</option>
            <option value="แต่งงานและอยู่ด้วยกัน">แต่งงานและอยู่ด้วยกัน</option>
            <option value="แต่งงานแต่ไม่ได้อยู่ด้วยกัน">แต่งงานแต่ไม่ได้อยู่ด้วยกัน</option>
            <option value="ไม่แต่งงานแต่อยู่ด้วยกัน">ไม่แต่งงานแต่อยู่ด้วยกัน</option>
            <option value="หม้าย">หม้าย</option>
            <option value="หย่าร้าง/แยกทาง/เลิกกัน">หย่าร้าง/แยกทาง/เลิกกัน</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
    <a href="user_profile.php" class="btn btn-secondary mt-2">ยกเลิก</a>
</form>
    </div>

</body>

</html>