<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ตั้งค่า Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #ffffff;
            color: #333;
            padding-top: 20px;
            border-right: 2px solid #ddd;
        }

        .sidebar img {
            display: block;
            width: 80%;
            margin: 0 auto 10px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 12px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .sidebar ul li a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 16px;
            transition: 0.3s;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 18px;
            color: #F17629;
        }

        .sidebar ul li a:hover {
            background: #f5f5f5;
            padding-left: 10px;
            border-radius: 5px;
        }

        /* ตั้งค่าเนื้อหาหลัก */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .box_head {
            background: #F17629;
            color: white;
            padding: 15px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
        }

        .dashboard {
            margin-top: 20px;
        }

        img {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        /* ตั้งค่าปุ่ม Logout */
        .logout-btn {
            background: #E74C3C;
            color: white;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            margin: 15px auto;
            text-decoration: none;
            width: 80%;
            font-size: 16px;
            font-weight: bold;
        }

        .logout-btn i {
            margin-right: 8px;
            font-size: 18px;
        }

        .logout-btn:hover {
            background: #C0392B;
        }
    </style>
</head>

<body>
    <script src="../static/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="../static/img/logo.png" alt="Kasem Bundit University">
        <ul>
            <li><a href="admin_dashboard.php"><i class="bi bi-house"></i> หน้าหลัก (Dashboard)</a></li>
            <li><a href="adminCheck_Borrower_Status.php"><i class="bi bi-search"></i> ตรวจสอบสถานะผู้กู้</a></li>
            <li><a href="adminCheck_form_Status.php"><i class="bi bi-file-text"></i> ตรวจสอบสถานะเอกสาร</a></li>
            <li><a href="admin_edit_student.php"><i class="bi bi-person"></i> แก้ไขข้อมูลนักศึกษา</a></li>
            <li><a href="adminadd_user.php"><i class="bi bi-person-plus"></i> เพิ่มนักศึกษา</a></li>
            <li><a href="admin_edit_teacher.php"><i class="bi bi-briefcase"></i> แก้ไขข้อมูลอาจารย์</a></li>
            <li><a href="adminadd_teacher.php"><i class="bi bi-person-plus"></i> เพิ่มอาจารย์</a></li>
            <li><a href="admin_edit_admin.php"><i class="bi bi-gear"></i> จัดการแอดมิน</a></li>
            <li><a href="adminlogout.php" class="logout-btn"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header class="box_head">
            <?php if (isset($_SESSION['username'])): ?>
                <select id="navigationDropdown">
                    <option value="admin_dashboard.php">
                        <span>Welcome Admin, <?php echo $_SESSION['username']; ?></span>
                    </option>
                    <option value="adminlogout.php">Logout</option>
                    <option value="admin_edit.php">edit</option>
                    <option value="admin_dashboard.php">Dashboard</option>
                    <option value="adminCheck_Borrower_Status.php">Check Borrower Status</option>
                    <option value="adminCheck_form_Status.php">Check Form Status</option>
                    <option value="admin_edit_student.php">Edit Students Status</option>
                    <option value="adminadd_user.php">Add Student</option>
                    <option value="admin_edit_teacher.php">Edit Teachers Status</option>
                    <option value="adminadd_teacher.php">Add Teacher</option>
                    <option value="admin_edit_admin.php">Admin Edit admin</option>
                    <option value="admin_Check_Statustable.php">Statustable</option>

                    

                    
                </select>
                <script>
                    document.getElementById("navigationDropdown").onchange = function() {
                        var selectedLink = this.value;
                        if (selectedLink) {
                            window.location.href = selectedLink;
                        }
                    };
                </script>
            <?php endif; ?>
        </header>

        <div class="dashboard">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>This is the admin dashboard where you can manage the website.</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>