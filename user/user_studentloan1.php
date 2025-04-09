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

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรมจิตสาธารณะ</title>

    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
</head>

<script src="../static/js/bootstrap.min.js"></script>
<!-- Internal CSS -->
<style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        /* Header */
        header {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 24px;
            color: #333;
        }

        /* Main Content */
        main {
            padding: 20px;
        }

        /* Filter Section */
        .filter-section {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start; /* จัดกลางตามแนวนอน */
            gap: 10px; /* ระยะห่างระหว่างองค์ประกอบ */
        }

        .filter-section label {
            margin-right: 5px;
        }

        .filter-section select {
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filter-section button {
            padding: 5px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .filter-section button:hover {
            background-color: #0056b3;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        /* Footer of the table (Total Hours) */
        table tfoot tr {
            background-color: #e9ecef; /* Light gray background for total row */
        }

        table tfoot td {
            font-weight: bold; /* Bold text for total hours */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
        }
    </style>

<body>

<?php include('../user/header.php'); ?>

    <!-- Header -->
    <header>
        <h1>กิจกรรมจิตสาธารณะ กยศ</h1>
    </header>

    <!-- Filter Section -->
    <div class="filter-section">
        <form>
            <label for="year">เลือกปี:</label>
            <select id="year" name="year">
                <option value="">ทั้งหมด</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
            </select>

            <label for="term">เลือกเทอม:</label>
            <select id="term" name="term">
                <option value="">ทั้งหมด</option>
                <option value="1">เทอม 1</option>
                <option value="2">เทอม 2</option>
            </select>

            <button type="submit">กรองข้อมูล</button>
        </form>
    </div>

    <!-- Main Content -->
    <main>
        <!-- Table -->
        <table id="activity-table">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>ชั่วโมง</th>
                    <th>ชั่วโมงที่ได้</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>กิจกรรมปลูกต้นไม้</td>
                    <td>9</td>
                    <td>9</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>กิจกรรมเก็บขยะชายหาด</td>
                    <td>13</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>กิจกรรมบริจาคโลหิต</td>
                    <td>10</td>
                    <td>10</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">รวมชั่วโมงทั้งหมด:</td>
                    <td><strong>32</strong></td> <!-- รวมชั่วโมง -->
                    <td><strong>29</strong></td> <!-- รวมชั่วโมงที่ได้ -->
                </tr>
            </tfoot>
        </table>
    </main>

</body>
</html>