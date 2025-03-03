<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กองทุน</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/register.css">
    <link rel="stylesheet" href="../static/css/bootstrap-reboot.min.css">
</head>

<body>
    <div class="container">
        <div class="box-black"></div>
        <nav class="header">
            <img src="../static/img/logo.png" alt>
            <h1>ลงทะเบียน</h1>
            <form action="../register.php" method="POST">

                <div class="input-box">
                    <input type="text" id="student_id" name="student_id" required placeholder="เลขบัตรประจำตัวประชาชน">
                </div>

                <div class="input-box">
                    <input type="text" id="f_name" name="f_name" required placeholder="ชื่อ">
                </div>

                <div class="input-box">
                    <input type="text" id="l_name" name="l_name" required placeholder="นามสกุล">
                </div>


                <div class="input-box">
                    <input type="text" id="phone_number" name="phone_number" required placeholder="เบอร์โทรศัพท์">
                </div>
                

                <div class="input-box">
                    <input type="text" id="email" name="email" required placeholder="Email">
                </div>

                <!-- Button styled file input -->
                <!-- <label class="btn btn-primary">
                    Image <input type="file" accept="image/*" hidden id="imageInput">
                </label> -->

                <!-- Preview Image -->
                <div class="mt-3">
                    <img id="previewImage" src class="img-thumbnail d-none" width="200">
                </div>

                <script>
                    document.getElementById('imageInput').addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const img = document.getElementById('previewImage');
                                img.src = e.target.result;
                                img.classList.remove('d-none');
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                </script>

                <form id="passwordForm">
                    <!-- Password Field -->
                    <div class="input-box">
                        <input type="password" id="password" name="password" class="form-control" required
                            placeholder="รหัสผ่าน">
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="input-box">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                            required placeholder="ยืนยันรหัสผ่าน">
                        <div id="passwordError" class="text-danger mt-1 d-none">รหัสผ่านไม่ตรงกัน</div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">ลงทะเบียน</button>
                </form>

                <script>
                    document.getElementById("passwordForm").addEventListener("submit", function (event) {
                        const password = document.getElementById("password").value;
                        const confirmPassword = document.getElementById("confirm_password").value;
                        const errorText = document.getElementById("passwordError");

                        if (password !== confirmPassword) {
                            event.preventDefault();
                            errorText.classList.remove("d-none");
                        } else {
                            errorText.classList.add("d-none");
                        }
                    });
                </script>
                <div class="register-link">
                    <p>มีบัญชีเข้าใช้งานแล้ว
                        <a href="user_login.php">เข้าใช้งาน</a>
                    </p>
                </div>
            </form>
        </nav>
    </div>
</body>

</html>