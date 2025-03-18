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
    <title>ดาวน์โหลดแบบฟอร์มขอกู้ยืมปี 2568</title>

    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="stylesheet" href="../static/css/bootstrap.css">

    <style>
        .content {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            color: #F17629;
            margin-bottom: 20px;
        }

        .content p {
            margin-bottom: 10px;
        }

        .content form {
            margin-bottom: 20px;
        }

        .content label {
            display: block;
            margin-bottom: 5px;
        }

        .content input[type="radio"] {
            margin-right: 5px;
        }

        .content button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #F17629;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .content button:hover {
            background-color: #e06a0d;
        }

        .content .email-section {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .content .email-section p {
            margin-bottom: 5px;
        }

        .content .question-section {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .content .question-section h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .content .question-section p {
            margin-bottom: 5px;

        }

        .form-group {
            display: flex;
            align-items: center;
            gap: 10px;
            /* ระยะห่างระหว่าง radio button และข้อความ */
            flex-wrap: wrap;
            /* ให้ข้อความที่ยาวเกินไปขึ้นบรรทัดใหม่ */
        }

        .form-group label {
            margin: 0;
        }

        .form-group div {
            margin-bottom: 20px;
            /* เพิ่มระยะห่างระหว่างแต่ละข้อ */
            display: flex;
            align-items: center;
        }

        .form-group input[type="radio"] {
            margin-right: 10px;
            /* ระยะห่างระหว่าง radio button และข้อความ */
        }
    </style>
</head>

<body>

    <?php include('../user/header.php'); ?>

    <div class="container">
        <div class="content">
            <h2>ดาวน์โหลดแบบฟอร์มขอกู้ยืมปี 2568</h2>
            <p>* ระบุว่าเป็นคำถามที่จำเป็น</p>

            <form action="user_nonti.php" method="post">

                <div class="question-text">
                    <h3>หนังสือให้ความยินยอม</h3>
                    <p>การกู้ยืมทุกคนจะต้องมีหนังสือให้ความยินยอมที่เขียนด้วยลายมือตัวเองเท่านั้น
                        กรุณาดาวน์โหลดตามจำนวนดังต่อไปนี้</p>
                </div>

                <div class="question-section">
                    <div class="content-section">
                        <p><b>หนังสือให้ความยินยอม *</b></p>
                        
                            <div>
                                <input type="radio" id="both-parents" name="guardian" value="both-parents">
                                <label for="both-parents">นักศึกษาอยู่ในความดูแลของบิดาและมารดา ดาวน์โหลด 3 แผ่น</label>
                            </div>
                            <div>
                                <input type="radio" id="father-only" name="guardian" value="father-only">
                                <label for="father-only">นักศึกษาอยู่ในความดูแลของบิดาคนเดียว ดาวน์โหลด 2 แผ่น</label>
                            </div>
                            <div>
                                <input type="radio" id="mother-only" name="guardian" value="mother-only">
                                <label for="mother-only">นักศึกษาอยู่ในความดูแลของมารดาคนเดียว ดาวน์โหลด 2 แผ่น</label>
                            </div>
                            <div>
                                <input type="radio" id="guardian" name="guardian" value="guardian">
                                <label for="guardian">นักศึกษาอยู่ในความดูแลของผู้ปกครอง
                                    (กรณีไม่ได้อยู่ในความดูแลของทั้งบิดาและมารดา) ดาวน์โหลด 2 แผ่น</label>
                            </div>
                            <div>
                                <input type="radio" id="both-parents-guardian" name="guardian"
                                    value="both-parents-guardian">
                                <label for="both-parents-guardian">นักศึกษาอยู่ในความดูแลของบิดามารดา และผู้ปกครอง
                                    ดาวน์โหลด 4 แผ่น (กรณีบิดาและมารดาไม่มีรายได้)</label>
                            </div>
                    </div>
                </div>

                <div class="question-section">
                    <div class="content-section">
                        <p><b>แบบฟอร์มการกู้ยืม *</b></p>
                        <p>นักศึกษาสามารถดาวน์โหลดแบบฟอร์มการกู้ยืม กยศ.101ได้หลังจากบันทึกข้อมูลและกดส่งเรียบร้อยแล้ว
                            ขอให้นำส่งหลังจากดาวน์โหลดแบบฟอร์มการกู้ยืม กยศ.101 ภายใน 7 วันทำการ</p>
                        <div class="form-group">
                            <input type="radio" id="both-parents" name="guardian" value="both-parents">
                            <label for="both-parents">รับทราบ</label><br>
                        </div>
                    </div>
                </div>

                <button type="submit"><a href="user_nonti.php"></a>ตกลง</button>
                <button type="button" style="float: right;">ล้างแบบฟอร์ม</button>
            </form>
        </div>
    </div>

</body>

</html>