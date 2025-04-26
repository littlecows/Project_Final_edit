<?php
session_start();
include '/xampp/htdocs/Project_Final/server.php';

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

$student_id = $_SESSION['username']; // Assuming username is actually student_id
$sql = "SELECT student.*, father.father_name, father.father_last_name, mother.mother_name, mother.mother_last_name, father.father_id, father.father_address, father.father_occupation, father.father_income, mother.mother_id, mother.mother_address, mother.mother_occupation, mother.mother_income, father.father_phone_number, mother.mother_phone_number, department.department_name, faculty.faculty_name
        FROM student 
        LEFT JOIN father ON student.father_id = father.father_id 
        LEFT JOIN mother ON student.mother_id = mother.mother_id
        LEFT JOIN department ON student.department_id = department.department_id
        LEFT JOIN faculty ON department.faculty_id = faculty.faculty_id
        WHERE student.student_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Execute failed: " . htmlspecialchars($stmt->error));
}

$student = $result->fetch_assoc();
$stmt->close();

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Determine which form was submitted
    if (isset($_POST['update_personal'])) {
        // Personal information update
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $student_code = $_POST['student_code'];
        $address = $_POST['address'];
        
        $updateSql = "UPDATE student SET 
                f_name = ?, 
                l_name = ?, 
                student_code = ?,
                address = ? 
                WHERE student_id = ?";
        
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssss", $f_name, $l_name, $student_code, $address, $student_id);
        
        if ($updateStmt->execute()) {
            $message = "Personal information updated successfully!";
        } else {
            $error = "Error updating personal information: " . $conn->error;
        }
        $updateStmt->close();
    } 
    else if (isset($_POST['update_contact'])) {
        // Contact information update
        $phone_number = $_POST['phone_number'];
        $phone_number_home = $_POST['phone_number_home'];
        $email = $_POST['email'];
        
        $updateSql = "UPDATE student SET 
                phone_number = ?, 
                phone_number_home = ?, 
                email = ? 
                WHERE student_id = ?";
        
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssss", $phone_number, $phone_number_home, $email, $student_id);
        
        if ($updateStmt->execute()) {
            $message = "Contact information updated successfully!";
        } else {
            $error = "Error updating contact information: " . $conn->error;
        }
        $updateStmt->close();
    }
    else if (isset($_POST['update_family'])) {
        // Family information update
        // Here you would handle the family information update
        // This would be more complex as it involves multiple tables
        
        // For example, updating father information
        if (!empty($_POST['father_id'])) {
            $father_id = $_POST['father_id'];
            $father_name = $_POST['father_name'];
            $father_last_name = $_POST['father_last_name'];
            $father_address = $_POST['father_address'];
            $father_occupation = $_POST['father_occupation'];
            $father_income = $_POST['father_income'];
            $father_phone = $_POST['father_phone_number'];
            
            // Check if father record exists
            $checkSql = "SELECT * FROM father WHERE father_id = ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("s", $father_id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            
            if ($checkResult->num_rows > 0) {
                // Update existing record
                $updateSql = "UPDATE father SET 
                        father_name = ?, 
                        father_last_name = ?, 
                        father_address = ?,
                        father_occupation = ?,
                        father_income = ?,
                        father_phone_number = ?
                        WHERE father_id = ?";
                
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("ssssdss", $father_name, $father_last_name, $father_address, $father_occupation, $father_income, $father_phone, $father_id);
                $updateStmt->execute();
                $updateStmt->close();
            } else {
                // Insert new record
                $insertSql = "INSERT INTO father (father_id, father_name, father_last_name, father_address, father_occupation, father_income, father_phone_number) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param("ssssdss", $father_id, $father_name, $father_last_name, $father_address, $father_occupation, $father_income, $father_phone);
                $insertStmt->execute();
                $insertStmt->close();
                
                // Update student record with father_id
                $updateStudentSql = "UPDATE student SET father_id = ? WHERE student_id = ?";
                $updateStudentStmt = $conn->prepare($updateStudentSql);
                $updateStudentStmt->bind_param("ss", $father_id, $student_id);
                $updateStudentStmt->execute();
                $updateStudentStmt->close();
            }
            $checkStmt->close();
        }
        
        // Similar logic for mother information
        if (!empty($_POST['mother_id'])) {
            $mother_id = $_POST['mother_id'];
            $mother_name = $_POST['mother_name'];
            $mother_last_name = $_POST['mother_last_name'];
            $mother_address = $_POST['mother_address'];
            $mother_occupation = $_POST['mother_occupation'];
            $mother_income = $_POST['mother_income'];
            $mother_phone = $_POST['mother_phone_number'];
            
            // Check if mother record exists
            $checkSql = "SELECT * FROM mother WHERE mother_id = ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("s", $mother_id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            
            if ($checkResult->num_rows > 0) {
                // Update existing record
                $updateSql = "UPDATE mother SET 
                        mother_name = ?, 
                        mother_last_name = ?, 
                        mother_address = ?,
                        mother_occupation = ?,
                        mother_income = ?,
                        mother_phone_number = ?
                        WHERE mother_id = ?";
                
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("ssssdss", $mother_name, $mother_last_name, $mother_address, $mother_occupation, $mother_income, $mother_phone, $mother_id);
                $updateStmt->execute();
                $updateStmt->close();
            } else {
                // Insert new record
                $insertSql = "INSERT INTO mother (mother_id, mother_name, mother_last_name, mother_address, mother_occupation, mother_income, mother_phone_number) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param("ssssdss", $mother_id, $mother_name, $mother_last_name, $mother_address, $mother_occupation, $mother_income, $mother_phone);
                $insertStmt->execute();
                $insertStmt->close();
                
                // Update student record with mother_id
                $updateStudentSql = "UPDATE student SET mother_id = ? WHERE student_id = ?";
                $updateStudentStmt = $conn->prepare($updateStudentSql);
                $updateStudentStmt->bind_param("ss", $mother_id, $student_id);
                $updateStudentStmt->execute();
                $updateStudentStmt->close();
            }
            $checkStmt->close();
        }
        
        // Update family status
        $family_status = $_POST['family_status'];
        $updateStatusSql = "UPDATE student SET family_status = ? WHERE student_id = ?";
        $updateStatusStmt = $conn->prepare($updateStatusSql);
        $updateStatusStmt->bind_param("ss", $family_status, $student_id);
        $updateStatusStmt->execute();
        $updateStatusStmt->close();
        
        $message = "Family information updated successfully!";
    }
    
    else if (isset($_POST['update_additional'])) {
        // Additional information update
        $spouse_id = $_POST['spouse_id'] ?: null;
        $guardian_id = $_POST['guardian_id'] ?: null;
        $endorser_id = $_POST['endorser_id'] ?: null;
        $department_id = $_POST['department_id'] ?: null;
        
        $updateSql = "UPDATE student SET 
                spouse_id = ?, 
                guardian_id = ?, 
                endorser_id = ?,
                department_id = ?
                WHERE student_id = ?";
        
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("siiss", $spouse_id, $guardian_id, $endorser_id, $department_id, $student_id);
        
        if ($updateStmt->execute()) {
            $message = "Additional information updated successfully!";
        } else {
            $error = "Error updating additional information: " . $conn->error;
        }
        $updateStmt->close();
    }
    
    // Refresh student data after update
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว</title>

    <link rel="stylesheet" href="../static/css/user_profile.css">
    <link rel="stylesheet" href="../static/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        .info-body {
            display: grid;
            grid-template-columns: 1fr 2fr;
            row-gap: 10px;
        }

        .info-row {
            display: contents;
        }

        .info-row strong {
            font-weight: 700;
            text-align: left;
            padding-right: 15px;
        }

        .info-row span, .info-row input, .info-row select {
            text-align: left;
        }
        
        .edit-mode {
            display: none;
        }
        
        .view-mode, .edit-mode {
            width: 100%;
        }
        
        .buttons-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }
        
        .buttons-container button {
            margin-left: 10px;
        }
        
        .save-btn, .cancel-btn, .edit-btn {
            padding: 5px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .save-btn {
            background-color: #F17629;
            color: white;
            border: none;
        }
        
        .cancel-btn {
            background-color: #6c757d;
            color: white;
            border: none;
        }
        
        .edit-btn {
            background-color: #F17629;
            color: white;
            border: none;
            text-decoration: none;
            display: inline-block;
            padding: 8px 15px;
            font-size: 15px;
            border-radius: 5px;
            margin-top: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .edit-btn:hover {
            background-color: #e06521;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }
        
        .edit-btn i {
            margin-right: 5px;
        }
        
        .alert {
            margin-top: 15px;
        }
        
        .main-edit-btn {
            background-color: #F17629;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .main-edit-btn:hover {
            background-color: #e06521;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        
        .main-edit-btn i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        /* Make the section title more prominent when editing */
        .editing .info-header {
            background-color: #f8f9fa;
            border-left: 4px solid #F17629;
            padding-left: 10px;
        }
    </style>

    <script>
        function toggleEditMode(sectionId) {
            // Hide all view modes and show all edit modes in the section
            document.querySelectorAll(`#${sectionId} .view-mode`).forEach(element => {
                element.style.display = 'none';
            });
            
            document.querySelectorAll(`#${sectionId} .edit-mode`).forEach(element => {
                element.style.display = 'block';
            });
            
            // Hide edit button and show buttons container
            document.querySelector(`#${sectionId} .edit-btn`).style.display = 'none';
            document.querySelector(`#${sectionId} .buttons-container`).style.display = 'flex';
        }
        
        function cancelEdit(sectionId) {
            // Show all view modes and hide all edit modes in the section
            document.querySelectorAll(`#${sectionId} .view-mode`).forEach(element => {
                element.style.display = 'block';
            });
            
            document.querySelectorAll(`#${sectionId} .edit-mode`).forEach(element => {
                element.style.display = 'none';
            });
            
            // Show edit button and hide buttons container
            document.querySelector(`#${sectionId} .edit-btn`).style.display = 'inline-block';
            document.querySelector(`#${sectionId} .buttons-container`).style.display = 'none';
        }

        function toggleAllEditModes() {
            // Show edit mode for all sections
            document.querySelectorAll('.info-card').forEach(card => {
                const sectionId = card.id;
                toggleEditMode(sectionId);
                card.classList.add('editing');
            });
            
            // Hide the main edit button
            document.getElementById('main-edit-btn').style.display = 'none';
            
            // Show the main save button
            document.getElementById('main-save-container').style.display = 'flex';
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        function cancelAllEdits() {
            // Cancel edit mode for all sections
            document.querySelectorAll('.info-card').forEach(card => {
                const sectionId = card.id;
                cancelEdit(sectionId);
                card.classList.remove('editing');
            });
            
            // Show the main edit button
            document.getElementById('main-edit-btn').style.display = 'flex';
            
            // Hide the main save button
            document.getElementById('main-save-container').style.display = 'none';
        }
    </script>
</head>

<body>
    <?php include('../user/header.php'); ?>

    <div class="container" id="profile-container">
        <h2 class="title">ข้อมูลส่วนตัว</h2>
        <p class="subtitle">ข้อมูลส่วนตัวของนักศึกษา</p>
        
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Main Edit Button -->
        <button type="button" id="main-edit-btn" class="main-edit-btn mx-auto" onclick="toggleAllEditModes()">
            <i class="bi bi-pencil-square"></i> แก้ไขข้อมูลทั้งหมด
        </button>
        
        <!-- Main Save/Cancel Button Container (Hidden by default) -->
        <div id="main-save-container" class="d-flex justify-content-center mb-4" style="display: none;">
            <button type="button" class="btn btn-secondary me-3" onclick="cancelAllEdits()">
                <i class="bi bi-x-circle"></i> ยกเลิกการแก้ไขทั้งหมด
            </button>
            <button type="button" class="btn btn-success" onclick="submitAllForms()">
                <i class="bi bi-check-circle"></i> บันทึกข้อมูลทั้งหมด
            </button>
        </div>

        <!-- กล่องข้อมูลส่วนตัว -->
        <div class="info-card" id="personal-info">
            <div class="info-header">ข้อมูลส่วนตัว</div>
            <div class="gradient-line"></div>
            
            <form method="POST" action="">
                <div class="info-body">
                    <div class="info-row">
                        <strong>เลขบัตรประจำตัวประชาชน</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["student_id"]); ?></span>
                        <input type="text" name="student_id" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["student_id"]); ?>" readonly>
                    </div>
                    <div class="info-row">
                        <strong>เลขรหัสนักศึกษา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["student_code"]); ?></span>
                        <input type="text" name="student_code" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["student_code"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>ชื่อ</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["f_name"]); ?></span>
                        <input type="text" name="f_name" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["f_name"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>นามสกุล</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["l_name"]); ?></span>
                        <input type="text" name="l_name" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["l_name"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>ที่อยู่</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["address"]); ?></span>
                        <input type="text" name="address" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["address"]); ?>">
                    </div>
                </div>
                
                <button type="button" class="edit-btn" onclick="toggleEditMode('personal-info')">
                    <i class="bi bi-pencil-square"></i> แก้ไขข้อมูล
                </button>
                
                <div class="buttons-container" style="display: none;">
                    <button type="button" class="cancel-btn" onclick="cancelEdit('personal-info')">ยกเลิก</button>
                    <button type="submit" name="update_personal" class="save-btn">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>

        <!-- กล่องข้อมูลติดต่อ -->
        <div class="info-card" id="contact-info">
            <div class="info-header">ข้อมูลติดต่อ</div>
            <div class="gradient-line"></div>
            
            <form method="POST" action="">
                <div class="info-body">
                    <div class="info-row">
                        <strong>เบอร์โทรศัพท์มือถือ</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["phone_number"]); ?></span>
                        <input type="text" name="phone_number" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["phone_number"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>เบอร์โทรศัพท์บ้าน</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["phone_number_home"]); ?></span>
                        <input type="text" name="phone_number_home" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["phone_number_home"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>อีเมล</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["email"]); ?></span>
                        <input type="email" name="email" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["email"]); ?>">
                    </div>
                </div>
                
                <button type="button" class="edit-btn" onclick="toggleEditMode('contact-info')">
                    <i class="bi bi-pencil-square"></i> แก้ไขข้อมูล
                </button>
                
                <div class="buttons-container" style="display: none;">
                    <button type="button" class="cancel-btn" onclick="cancelEdit('contact-info')">ยกเลิก</button>
                    <button type="submit" name="update_contact" class="save-btn">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>

        <!-- กล่องข้อมูลสถานภาพครอบครัว -->
        <div class="info-card" id="family-info">
            <div class="info-header">ข้อมูลสถานภาพครอบครัว</div>
            <div class="gradient-line"></div>
            
            <form method="POST" action="">
                <div class="info-body">
                    <div class="info-row">
                        <strong>ชื่อบิดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["father_name"]); ?></span>
                        <input type="text" name="father_name" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["father_name"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>นามสกุลบิดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["father_last_name"]); ?></span>
                        <input type="text" name="father_last_name" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["father_last_name"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>เลขบัตรประจำตัวประชาชนบิดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["father_id"]); ?></span>
                        <input type="text" name="father_id" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["father_id"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>ที่อยู่บิดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["father_address"]); ?></span>
                        <input type="text" name="father_address" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["father_address"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>อาชีพบิดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["father_occupation"]); ?></span>
                        <input type="text" name="father_occupation" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["father_occupation"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>เงินเดือนบิดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["father_income"]); ?></span>
                        <input type="number" name="father_income" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["father_income"]); ?>" step="0.01">
                    </div>
                    <div class="info-row">
                        <strong>เบอร์โทรศัพท์บิดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["father_phone_number"]); ?></span>
                        <input type="text" name="father_phone_number" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["father_phone_number"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>ชื่อมารดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["mother_name"]); ?></span>
                        <input type="text" name="mother_name" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["mother_name"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>นามสกุลมารดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["mother_last_name"]); ?></span>
                        <input type="text" name="mother_last_name" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["mother_last_name"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>เลขบัตรประจำตัวประชาชนมารดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["mother_id"]); ?></span>
                        <input type="text" name="mother_id" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["mother_id"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>ที่อยู่มารดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["mother_address"]); ?></span>
                        <input type="text" name="mother_address" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["mother_address"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>อาชีพมารดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["mother_occupation"]); ?></span>
                        <input type="text" name="mother_occupation" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["mother_occupation"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>เงินเดือนมารดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["mother_income"]); ?></span>
                        <input type="number" name="mother_income" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["mother_income"]); ?>" step="0.01">
                    </div>
                    <div class="info-row">
                        <strong>เบอร์โทรศัพท์มารดา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["mother_phone_number"]); ?></span>
                        <input type="text" name="mother_phone_number" class="form-control edit-mode" value="<?php echo htmlspecialchars($student["mother_phone_number"]); ?>">
                    </div>
                    <div class="info-row">
                        <strong>สถานภาพครอบครัว</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["family_status"]); ?></span>
                        <select name="family_status" class="form-control edit-mode">
                            <option value="">เลือกสถานภาพ</option>
                            <option value="โสด" <?php echo ($student["family_status"] == "โสด") ? "selected" : ""; ?>>โสด</option>
                            <option value="แต่งงานแล้ว" <?php echo ($student["family_status"] == "แต่งงานแล้ว") ? "selected" : ""; ?>>แต่งงานแล้ว</option>
                            <option value="หย่าร้าง" <?php echo ($student["family_status"] == "หย่าร้าง") ? "selected" : ""; ?>>หย่าร้าง</option>
                        </select>
                    </div>
                </div>
                
                <button type="button" class="edit-btn" onclick="toggleEditMode('family-info')">
                    <i class="bi bi-pencil-square"></i> แก้ไขข้อมูล
                </button>
                
                <div class="buttons-container" style="display: none;">
                    <button type="button" class="cancel-btn" onclick="cancelEdit('family-info')">ยกเลิก</button>
                    <button type="submit" name="update_family" class="save-btn">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>

        <!-- กล่องข้อมูลเพิ่มเติม -->
        <div class="info-card" id="additional-info">
            <div class="info-header">ข้อมูลเพิ่มเติม</div>
            <div class="gradient-line"></div>
            
            <form method="POST" action="">
                <div class="info-body">
                    <div class="info-row">
                        <strong>คณะ</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["faculty_name"] ?? ''); ?></span>
                        <div class="edit-mode">
                            <div class="d-flex">
                                <select name="faculty_id" id="faculty_id" class="form-control" onchange="updateDepartments()" style="flex-grow: 1; margin-right: 10px;">
                                    <option value="">- กรุณาเลือกคณะ -</option>
                                    <?php
                                    // Get all faculties from database
                                    $facultySql = "SELECT * FROM faculty ORDER BY faculty_name";
                                    $facultyResult = $conn->query($facultySql);
                                    while ($faculty = $facultyResult->fetch_assoc()) {
                                        $selected = ($student["faculty_name"] == $faculty["faculty_name"]) ? "selected" : "";
                                        echo "<option value='" . $faculty["faculty_id"] . "' $selected>" . htmlspecialchars($faculty["faculty_name"]) . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" class="btn btn-success" onclick="showAddFacultyForm()">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">เลือกคณะที่ท่านกำลังศึกษา หรือเพิ่มคณะใหม่</small>
                            
                            <!-- Add Faculty Form (Hidden by default) -->
                            <div id="addFacultyForm" style="display: none; margin-top: 10px;">
                                <div class="card p-3 bg-light">
                                    <h6 class="mb-3">เพิ่มคณะใหม่</h6>
                                    <div class="form-group mb-3">
                                        <label for="new_faculty_name">ชื่อคณะ</label>
                                        <input type="text" id="new_faculty_name" class="form-control" placeholder="กรุณากรอกชื่อคณะ">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2" onclick="hideAddFacultyForm()">ยกเลิก</button>
                                        <button type="button" class="btn btn-primary" onclick="addNewFaculty()">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-row">
                        <strong>สาขา</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["department_name"] ?? ''); ?></span>
                        <div class="edit-mode">
                            <div class="d-flex">
                                <select name="department_id" id="department_id" class="form-control" style="flex-grow: 1; margin-right: 10px;">
                                    <option value="">- กรุณาเลือกสาขา -</option>
                                    <?php
                                    if (!empty($student["faculty_name"])) {
                                        // Get departments from database based on faculty
                                        $facultyIdSql = "SELECT faculty_id FROM faculty WHERE faculty_name = ?";
                                        $facultyIdStmt = $conn->prepare($facultyIdSql);
                                        $facultyIdStmt->bind_param("s", $student["faculty_name"]);
                                        $facultyIdStmt->execute();
                                        $facultyIdResult = $facultyIdStmt->get_result();
                                        if ($facultyIdRow = $facultyIdResult->fetch_assoc()) {
                                            $facultyId = $facultyIdRow['faculty_id'];
                                            
                                            $deptSql = "SELECT * FROM department WHERE faculty_id = ? ORDER BY department_name";
                                            $deptStmt = $conn->prepare($deptSql);
                                            $deptStmt->bind_param("i", $facultyId);
                                            $deptStmt->execute();
                                            $deptResult = $deptStmt->get_result();
                                            
                                            while ($dept = $deptResult->fetch_assoc()) {
                                                $selected = ($student["department_id"] == $dept["department_id"]) ? "selected" : "";
                                                echo "<option value='" . $dept["department_id"] . "' $selected>" . htmlspecialchars($dept["department_name"]) . "</option>";
                                            }
                                            $deptStmt->close();
                                        }
                                        $facultyIdStmt->close();
                                    } else {
                                        // No faculty selected yet, show all departments
                                        $deptSql = "SELECT * FROM department ORDER BY department_name";
                                        $deptResult = $conn->query($deptSql);
                                        while ($dept = $deptResult->fetch_assoc()) {
                                            $selected = ($student["department_id"] == $dept["department_id"]) ? "selected" : "";
                                            echo "<option value='" . $dept["department_id"] . "' $selected>" . htmlspecialchars($dept["department_name"]) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <button type="button" class="btn btn-success" onclick="showAddDepartmentForm()">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">เลือกคณะก่อน แล้วจึงเลือกสาขาที่ท่านกำลังศึกษา หรือเพิ่มสาขาใหม่</small>
                            
                            <!-- Add Department Form (Hidden by default) -->
                            <div id="addDepartmentForm" style="display: none; margin-top: 10px;">
                                <div class="card p-3 bg-light">
                                    <h6 class="mb-3">เพิ่มสาขาใหม่</h6>
                                    <div class="form-group mb-3">
                                        <label for="dept_faculty_id">คณะ</label>
                                        <select id="dept_faculty_id" class="form-control">
                                            <option value="">- กรุณาเลือกคณะ -</option>
                                            <?php
                                            // Reset connection pointer for new query
                                            $facultyResult->data_seek(0);
                                            while ($faculty = $facultyResult->fetch_assoc()) {
                                                echo "<option value='" . $faculty["faculty_id"] . "'>" . htmlspecialchars($faculty["faculty_name"]) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="new_department_name">ชื่อสาขา</label>
                                        <input type="text" id="new_department_name" class="form-control" placeholder="กรุณากรอกชื่อสาขา">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2" onclick="hideAddDepartmentForm()">ยกเลิก</button>
                                        <button type="button" class="btn btn-primary" onclick="addNewDepartment()">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-row">
                        <strong>คู่สมรส ID</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["spouse_id"] ?? ''); ?></span>
                        <div class="edit-mode">
                            <input type="text" name="spouse_id" class="form-control" value="<?php echo htmlspecialchars($student["spouse_id"] ?? ''); ?>">
                            <small class="form-text text-muted">ใส่เลขบัตรประจำตัวประชาชนของคู่สมรส (ถ้ามี)</small>
                        </div>
                    </div>
                    <div class="info-row">
                        <strong>ผู้ปกครอง ID</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["guardian_id"] ?? ''); ?></span>
                        <div class="edit-mode">
                            <input type="text" name="guardian_id" class="form-control" value="<?php echo htmlspecialchars($student["guardian_id"] ?? ''); ?>">
                            <small class="form-text text-muted">ใส่เลขบัตรประจำตัวประชาชนของผู้ปกครอง</small>
                        </div>
                    </div>
                    <div class="info-row">
                        <strong>ผู้รับรองรายได้ ID</strong> 
                        <span class="view-mode"><?php echo htmlspecialchars($student["endorser_id"] ?? ''); ?></span>
                        <div class="edit-mode">
                            <input type="text" name="endorser_id" class="form-control" value="<?php echo htmlspecialchars($student["endorser_id"] ?? ''); ?>">
                            <small class="form-text text-muted">ใส่เลขบัตรประจำตัวประชาชนของผู้รับรองรายได้ครอบครัว</small>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="edit-btn" onclick="toggleEditMode('additional-info')">
                    <i class="bi bi-pencil-square"></i> แก้ไขข้อมูล
                </button>
                
                <div class="buttons-container" style="display: none;">
                    <button type="button" class="cancel-btn" onclick="cancelEdit('additional-info')">ยกเลิก</button>
                    <button type="submit" name="update_additional" class="save-btn">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
        
        <!-- กล่องสรุปข้อมูลสัญญากู้ยืม -->
        <div class="info-card" id="loan-summary">
            <div class="info-header">ข้อมูลสัญญากู้ยืม</div>
            <div class="gradient-line"></div>
            
            <?php
            // Get loan contract information
            $loanSql = "SELECT pact.*, money.amount 
                      FROM pact 
                      LEFT JOIN money ON pact.contract_id = money.contract_id 
                      WHERE pact.student_id = ? 
                      ORDER BY pact.academic_year DESC";
            $loanStmt = $conn->prepare($loanSql);
            $loanStmt->bind_param("s", $student_id);
            $loanStmt->execute();
            $loanResult = $loanStmt->get_result();
            
            if ($loanResult->num_rows > 0) {
                echo '<div class="table-responsive">
                      <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>รหัสสัญญา</th>
                          <th>ปีการศึกษา</th>
                          <th>วันที่ทำสัญญา</th>
                          <th>วงเงินกู้</th>
                          <th>จำนวนเงิน</th>
                        </tr>
                      </thead>
                      <tbody>';
                
                while ($loan = $loanResult->fetch_assoc()) {
                    echo '<tr>
                          <td>' . htmlspecialchars($loan["contract_id"]) . '</td>
                          <td>' . htmlspecialchars($loan["academic_year"]) . '</td>
                          <td>' . htmlspecialchars(date('d/m/Y', strtotime($loan["contract_date"]))) . '</td>
                          <td>' . htmlspecialchars(number_format($loan["loan_limit"], 2)) . ' บาท</td>
                          <td>' . htmlspecialchars(number_format($loan["amount"], 2)) . ' บาท</td>
                        </tr>';
                }
                
                echo '</tbody></table></div>';
            } else {
                echo '<div class="alert alert-info">ไม่พบข้อมูลสัญญากู้ยืม</div>';
            }
            $loanStmt->close();
            ?>
            
            <a href="user_studentloan1.php" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle"></i> สร้างสัญญากู้ยืมใหม่
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to update departments dropdown based on selected faculty
        function updateDepartments() {
            const facultyId = document.getElementById('faculty_id').value;
            const departmentSelect = document.getElementById('department_id');
            
            // Clear current options
            departmentSelect.innerHTML = '<option value="">- กรุณาเลือกสาขา -</option>';
            
            if (facultyId) {
                // Show loading indicator
                departmentSelect.innerHTML += '<option disabled>กำลังโหลดข้อมูล...</option>';
                
                // Use AJAX to fetch departments for the selected faculty
                fetch(`get_departments.php?faculty_id=${facultyId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Clear loading indicator
                        departmentSelect.innerHTML = '<option value="">- กรุณาเลือกสาขา -</option>';
                        
                        // Add departments to dropdown
                        if (data.length > 0) {
                            data.forEach(dept => {
                                const option = document.createElement('option');
                                option.value = dept.department_id;
                                option.textContent = dept.department_name;
                                departmentSelect.appendChild(option);
                            });
                        } else {
                            departmentSelect.innerHTML += '<option disabled>ไม่พบข้อมูลสาขา</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching departments:', error);
                        departmentSelect.innerHTML = '<option value="">- กรุณาเลือกสาขา -</option>';
                        departmentSelect.innerHTML += '<option disabled>เกิดข้อผิดพลาดในการโหลดข้อมูล</option>';
                    });
            }
        }

        // Functions for adding new faculty
        function showAddFacultyForm() {
            document.getElementById('addFacultyForm').style.display = 'block';
        }

        function hideAddFacultyForm() {
            document.getElementById('addFacultyForm').style.display = 'none';
            document.getElementById('new_faculty_name').value = '';
        }

        function addNewFaculty() {
            const facultyName = document.getElementById('new_faculty_name').value.trim();
            
            if (!facultyName) {
                alert('กรุณากรอกชื่อคณะ');
                return;
            }
            
            // Send AJAX request to add new faculty
            fetch('add_faculty.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `faculty_name=${encodeURIComponent(facultyName)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add new option to faculty dropdown
                    const facultySelect = document.getElementById('faculty_id');
                    const newOption = document.createElement('option');
                    newOption.value = data.faculty_id;
                    newOption.textContent = facultyName;
                    newOption.selected = true;
                    facultySelect.appendChild(newOption);
                    
                    // Update departments dropdown
                    updateDepartments();
                    
                    // Update dept_faculty_id dropdown in department form
                    const deptFacultySelect = document.getElementById('dept_faculty_id');
                    const newDeptOption = document.createElement('option');
                    newDeptOption.value = data.faculty_id;
                    newDeptOption.textContent = facultyName;
                    deptFacultySelect.appendChild(newDeptOption);
                    
                    // Hide the form
                    hideAddFacultyForm();
                    
                    alert('เพิ่มคณะใหม่เรียบร้อยแล้ว');
                } else {
                    alert('เกิดข้อผิดพลาด: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการเพิ่มคณะใหม่');
            });
        }

        // Functions for adding new department
        function showAddDepartmentForm() {
            // Check if faculty is selected
            const facultyId = document.getElementById('faculty_id').value;
            const deptFacultySelect = document.getElementById('dept_faculty_id');
            
            if (facultyId) {
                // Set the faculty in the department form
                deptFacultySelect.value = facultyId;
            }
            
            document.getElementById('addDepartmentForm').style.display = 'block';
        }

        function hideAddDepartmentForm() {
            document.getElementById('addDepartmentForm').style.display = 'none';
            document.getElementById('new_department_name').value = '';
        }

        function addNewDepartment() {
            const facultyId = document.getElementById('dept_faculty_id').value;
            const departmentName = document.getElementById('new_department_name').value.trim();
            
            if (!facultyId) {
                alert('กรุณาเลือกคณะ');
                return;
            }
            
            if (!departmentName) {
                alert('กรุณากรอกชื่อสาขา');
                return;
            }
            
            // Send AJAX request to add new department
            fetch('add_department.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `faculty_id=${encodeURIComponent(facultyId)}&department_name=${encodeURIComponent(departmentName)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update departments dropdown if the faculty matches the currently selected one
                    const currentFacultyId = document.getElementById('faculty_id').value;
                    if (currentFacultyId === facultyId) {
                        const departmentSelect = document.getElementById('department_id');
                        const newOption = document.createElement('option');
                        newOption.value = data.department_id;
                        newOption.textContent = departmentName;
                        newOption.selected = true;
                        departmentSelect.appendChild(newOption);
                    }
                    
                    // Hide the form
                    hideAddDepartmentForm();
                    
                    alert('เพิ่มสาขาใหม่เรียบร้อยแล้ว');
                } else {
                    alert('เกิดข้อผิดพลาด: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการเพิ่มสาขาใหม่');
            });
        }

        // Function to submit all forms
        function submitAllForms() {
            // Create a flag to track if all validations pass
            let allValid = true;
            
            // Validate personal info form
            const personalForm = document.querySelector('#personal-info form');
            if (!validateForm(personalForm)) {
                allValid = false;
            }
            
            // Validate contact info form
            const contactForm = document.querySelector('#contact-info form');
            if (!validateForm(contactForm)) {
                allValid = false;
            }
            
            // Validate family info form
            const familyForm = document.querySelector('#family-info form');
            if (!validateForm(familyForm)) {
                allValid = false;
            }
            
            // Validate additional info form
            const additionalForm = document.querySelector('#additional-info form');
            if (!validateForm(additionalForm)) {
                allValid = false;
            }
            
            // If all validations pass, submit all forms in sequence
            if (allValid) {
                // Add a hidden input to each form to indicate it's part of a batch submission
                const batchInput = document.createElement('input');
                batchInput.type = 'hidden';
                batchInput.name = 'batch_submission';
                batchInput.value = 'true';
                
                // Clone the input for each form
                personalForm.appendChild(batchInput.cloneNode(true));
                contactForm.appendChild(batchInput.cloneNode(true));
                familyForm.appendChild(batchInput.cloneNode(true));
                additionalForm.appendChild(batchInput.cloneNode(true));
                
                // Submit the forms
                personalForm.submit();
            } else {
                alert('กรุณาตรวจสอบข้อมูลและแก้ไขให้ถูกต้อง');
            }
        }
        
        // Helper function to validate a form
        function validateForm(form) {
            // Basic validation - check required fields
            let isValid = true;
            
            // Get all required inputs
            const requiredInputs = form.querySelectorAll('input[required], select[required]');
            
            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            return isValid;
        }
    </script>
</body>

</html>