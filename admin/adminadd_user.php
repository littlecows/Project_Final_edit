<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Add New User</h2>
        <form action="adminadd_user.php" method="post">

            <div class="form-group">
                <label for="student_id">student_id</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <div class="form-group">
                <label for="student_code">student_code</label>
                <input type="text" class="form-control" id="student_code" name="student_code" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="f_name">f_name</label>
                <input type="text" class="form-control" id="f_name" name="f_name" required>
            </div>
            <div class="form-group">
                <label for="l_name">l_name</label>
                <input type="text" class="form-control" id="l_name" name="l_name" required>
            </div>
            <div class="form-group">
                <label for="address">address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <button type="submit" class="btn btn-primary">Add User</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Back</a>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $student_id = $_POST['student_id'];
        $student_code = $_POST['student_code'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $address = $_POST['address'];

        // Database connection
        session_start();
        include '/xampp/htdocs/Project_Final/server.php';
        if (!isset($_SESSION['username'])) {
            header("Location: admin_login.php");
            exit();
        }

        // ตรวจสอบการเชื่อมต่อ
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO student (student_id, student_code, password ,f_name , l_name , address) VALUES ('$student_id', '$student_code', '$password', '$f_name', '$l_name', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success mt-3'>New user added successfully</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>
</body>

</html>