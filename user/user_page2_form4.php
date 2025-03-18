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
    </style>
</head>

<body>

    <?php include('../user/header.php'); ?>

    <div class="container">
        <div class="content">
            <h2>ดาวน์โหลดแบบฟอร์มขอกู้ยืมปี 2568</h2>
            <p>* ระบุว่าเป็นคำถามที่จำเป็น</p>

            <form action="user_page2_form4.php" method="post">

                <div class="question-text">
                    <h3>บิดาและมารดา</h3>
                    <p>นักศึกษาอยู่ในความดูแลของบิดาและมารดา กรุณาให้รายละเอียดเกี่ยวกับอาชีพของบิดาและมารดา
                        คำจำกัดความการประกอบอาชีพ
                        1. อาชีพอิสระ คือ การประกอบอาชีพที่มีค่าตอบแทนที่แบบไม่มีสลิปเงินเดือน
                        หรือหนังสือรับรองเงินเดือน เช่น เกษตรกรประมง ค้าขาย รับจ้างทั่วไป ธุรกิจส่วนตัว ฯลฯ
                        ​2. อาชีพที่มีเงินเดือนประจำ คือ การประกอบอาชีพที่ได้รับค่าตอบแทนเป็นรายครึ่งเดือน หรือรายเดือน
                        (มีสลิปเงินเดือน หรือหนังสือรับรองเงินเดือน) เช่น พนักงานบริษัท รับราชการ รัฐวิสาหกิจ ฯลฯ
                        ​3. ไม่ได้ประกอบอาชีพ คือ ไม่มีรายได้ ไม่ได้ทำงานใด ๆ เช่น พ่อบ้าน แม่บ้าน พิการ ป่วย บวช
                        มีโทษจำคุก ฯลฯ</p>


                </div>
                <div class="question-section">
                    <div class="content-section">
                        <p><b>บิดาประกอบอาชีพ *</b></p>
                        <div class="form-group">
                            <input type="radio" id="both-parents" name="guardian" value="both-parents">
                            <label for="both-parents">อาชีพอิสระ หากท่านเลือกข้อนี้ กรุณาดาวน์โหลดหนังสือรับรองรายได้
                                กยศ. 102</label><br>
                            <input type="radio" id="father-only" name="guardian" value="father-only">
                            <label for="father-only">อาชีพที่มีเงินเดือนประจำ หากท่านเลือกข้อนี้
                                กรุณาแนบหนังสือรับรองเงินเดือน
                                หรือสลิปเงินเดือนที่ออกจากหน่วยงานที่บิดาปฏิบัติงานอยู่</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">ไม่ได้ประกอบอาชีพ หากท่านเลือกข้อนี้ กรุณาดาวน์โหลด
                                หนังสือรับรองรายได้ กยศ.102</label><br>
                        </div>
                    </div>
                </div>


                <div class="question-section">
                    <div class="content-section">
                        <p><b>มารดาประกอบอาชีพ *</b></p>
                        <div class="form-group">
                            <input type="radio" id="both-parents" name="guardian" value="both-parents">
                            <label for="both-parents">อาชีพอิสระ หากท่านเลือกข้อนี้ กรุณาดาวน์โหลดหนังสือรับรองรายได้
                                กยศ. 102</label><br>
                            <input type="radio" id="father-only" name="guardian" value="father-only">
                            <label for="father-only">อาชีพที่มีเงินเดือนประจำ หากท่านเลือกข้อนี้
                                กรุณาแนบหนังสือรับรองเงินเดือน
                                หรือสลิปเงินเดือนที่ออกจากหน่วยงานที่บิดาปฏิบัติงานอยู่</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">ไม่ได้ประกอบอาชีพ หากท่านเลือกข้อนี้ กรุณาดาวน์โหลด
                                หนังสือรับรองรายได้ กยศ.102</label><br>
                        </div>
                    </div>
                </div>


                <div class="question-section">
                    <div class="content-section">
                        <p><b>เอกสารที่ต้องเตรียมเพิ่มเติมสำหรับนักศึกษาที่อยู่ในความดูแลของบิดาและมารดา แยกตามอาชีพของบิดามารดา คือ</b></p>
                        <div class="form-group">
                            <input type="radio" id="both-parents" name="guardian" value="both-parents">
                            <label for="both-parents">บิดาและมารดาประกอบอาชีพอิสระ  จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 1.1</label><br>
                            <input type="radio" id="father-only" name="guardian" value="father-only">
                            <label for="father-only">บิดาประกอบอาชีพอิสระ มารดามีเงินเดือนประจำ จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 1.2</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">บิดาประกอบอาชีพอิสระ มารดาไม่ประกอบอาชีพ จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 1.3</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">มารดาประกอบอาชีพอิสระ บิดามีเงินเดือนประจำ จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 1.4</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">บิดาและมารดาประกอบอาชีพมีเงินเดือนประจำ จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 1.5</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">บิดามีเงินเดือนประจำ มารดาไม่ประกอบอาชีพ  จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 1.6</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">มารดาประกอบอาชีพอิสระ บิดาไม่ประกอบอาชีพ จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 1.7</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">มารดามีเงินเดือนประจำ บิดาไม่ประกอบอาชีพ จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 1.8</label><br>
                            <input type="radio" id="mother-only" name="guardian" value="mother-only">
                            <label for="mother-only">บิดาและมารดาไม่ประกอบอาชีพ กรุณาไปข้อต่อไปเพื่อให้ข้อมูลผู้ปกครอง</label><br>

                                
                        </div>
                    </div>
                </div>



                    <button type="submit"><a href="user_page2_form5.php"></a>ตกลง</button>
                    <button type="button" style="float: right;">ล้างแบบฟอร์ม</button>
            </form>
        </div>
    </div>

</body>

</html>