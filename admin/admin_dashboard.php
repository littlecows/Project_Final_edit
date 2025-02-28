<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
        }

        .dashboard {
            margin: 20px;
        }
    </style>
</head>

<body>
    <script src="../static/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <div class="container">
    <p class="h4 text-left">Admin Dashboard</p>
        <header class="box_head">
            
            <?php if (isset($_SESSION['username'])): ?>
                <select id="navigationDropdown">
                    <option value="admin_dashboard.php">
                        <span>Welcome Admin, <?php echo $_SESSION['username']; ?></span>
                    </option>
                    <option value="adminlogout.php">Logout</option>
                    <option value="admin_edit.php">edit</option>
                    <option value="adminadd_user.php">add user</option>
                    <option value="admin_dashboard.php">Dashboard</option>
                    <option value="adminCheck_Borrower_Status.php">Check Borrower Status</option>
                    <option value="adminCheck_form_Status.php">Check Form Status</option>
                    <option value="admin_edit_student.php">Edit Student Status</option>
                    <option value="admin_edit_teacher.php">Edit Teacher Status</option>
                    <option value="adminadd_teacher.php">Add Teacher</option>
                    
                    
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
        <div class="container dashboard">
            <div class="row">
                <div class="col-md-12">
                    <h1>Welcome to the Admin Dashboard</h1>
                    <p>This is the admin dashboard where you can manage the website.</p>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <?php include('../admin/adminfooter.php'); ?>
</body>

</html>