<?php
// ตรวจสอบว่ามีการแก้ไขหรือเพิ่มข้อมูลใหม่
$isEdit = isset($_GET['id']);
$activity = null;

if ($isEdit) {
    // ถ้าเป็นการแก้ไข ดึงข้อมูลกิจกรรมจากฐานข้อมูล
    include('1-backend.php');
    $activity = getActivityById($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่ม/แก้ไขกิจกรรม</title>
    <link rel="stylesheet" href="1-styles.css">
</head>
<body>
    <h2><?php echo $isEdit ? "แก้ไขกิจกรรม" : "เพิ่มกิจกรรม"; ?></h2>

    <form id="activityForm" action="1-backend.php" method="POST" enctype="multipart/form-data" class="form-container">
        <input type="hidden" name="id" value="<?php echo $activity['id'] ?? ''; ?>">

        <label for="name"><b>ชื่อกิจกรรม</b></label>
        <input type="text" id="name" name="name" placeholder="กรอกชื่อกิจกรรม" value="<?php echo $activity['name'] ?? ''; ?>" required>

        <label for="hour"><b>ชั่วโมง</b></label>
        <input type="number" id="hour" name="hour" placeholder="กรอกจำนวนชั่วโมง" value="<?php echo $activity['hour'] ?? ''; ?>" required>

        <label for="startDate"><b>วันที่เริ่มต้น</b></label>
        <input type="date" id="startDate" name="startDate" value="<?php echo $activity['startDate'] ?? ''; ?>" required>

        <label for="endDate"><b>วันที่สิ้นสุด</b></label>
        <input type="date" id="endDate" name="endDate" value="<?php echo $activity['endDate'] ?? ''; ?>" required>

        <label for="file"><b>เลือกไฟล์</b></label>
        <input type="file" id="file" name="file" <?php echo !$isEdit ? 'required' : ''; ?>>

        <button type="submit" class="btn"><?php echo $isEdit ? "บันทึกการแก้ไข" : "บันทึกกิจกรรม"; ?></button>
        <button type="button" class="btn cancel" onclick="window.location.href='index.html'">ยกเลิก</button>
    </form>
</body>
</html>
