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

        .content select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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

        <form action="user_page2_form5.php" method="post">
        <h3>บิดาคนเดียว</h3>
                <p>นักศึกษาอยู่ในความดูแลของบิดาคนเดียว กรุณาให้รายละเอียดเกี่ยวกับอาชีพของบิดา
คำจำกัดความการประกอบอาชีพ
1. อาชีพอิสระ คือ การประกอบอาชีพที่มีค่าตอบแทนที่แบบไม่มีสลิปเงินเดือน หรือหนังสือรับรองเงินเดือน เช่น เกษตรกรประมง ค้าขาย รับจ้างทั่วไป ธุรกิจส่วนตัว ฯลฯ
​2. อาชีพที่มีเงินเดือนประจำ คือ การประกอบอาชีพที่ได้รับค่าตอบแทนเป็นรายครึ่งเดือน หรือรายเดือน (มีสลิปเงินเดือน หรือหนังสือรับรองเงินเดือน) เช่น พนักงานบริษัท รับราชการ รัฐวิสาหกิจ ฯลฯ
​3. ไม่ได้ประกอบอาชีพ คือ ไม่มีรายได้ ไม่ได้ทำงานใด ๆ เช่น พ่อบ้าน แม่บ้าน พิการ ป่วย บวช มีโทษจำคุก ฯลฯ</p>

            <!-- ส่วน 2: อาชีพของบิดาและมารดา -->
            <div class="question-section">
                <h3>บิดาประกอบอาชีพ</h3>
                <div class="form-group">
                    <label for="parent_occupation">เลือกอาชีพของบิดา:</label>
                    <select id="parent_occupation" name="parent_occupation" required>
                        <option value="" disabled selected>-- เลือกอาชีพ --</option>
                        <option value="free">อาชีพอิสระ (หากท่านเลือกข้อนี้ กรุณาดาวน์โหลดหนังสือรับรองรายได้ กยศ. 102)</option>
                        <option value="salaried">อาชีพที่มีเงินเดือนประจำ (หากท่านเลือกข้อนี้ กรุณาแนบหนังสือรับรองเงินเดือนหรือสลีปเงินเดือนที่ออกจากหน่วยงานที่บิดาปฏิบัติงานอยู๋)</option>
                        <option value="unemployed">ไม่ได้ประกอบอาชีพ (หากท่านเลือกข้อนี้ กรุณาดาวน์โหลด หนังสือรับรองรายได้ กยศ. 102)</option>
                    </select>
                </div>
            </div>

            <!-- ส่วน 3: สถานะทางเศรษฐกิจ -->
            <div class="question-section">
                <h3>มารดามีสถานะอย่างไร คำจำกัดความสถานภาพ</h3>
                <div class="form-group">
                    <p><b>การกรอกสถานภาพครอบครัว มีผลต่อการพิจารณาให้กู้ยืม กรุณากรอกข้อมูลตามความเป็นจริง ตามสถานภาพครอบครัวที่เป็นอยู่ในปัจจุบัน ณ วันกรอกข้อมูล<br>
     - นักศึกษาอยู่ในความดูแลของบิดา และมารดา คือ บิดามารดาอยู่ร่วมกันฉันท์สามีภรรยา ไม่ว่าจะได้ทำการสมรสกันถูกต้องตามกฎหมายหรือไม่ก็ตาม<br>
     - กรณีนักศึกษาอยู่กับคนใดคนหนึ่ง<br>
ความหมายของสถานะ<br>
1. แยกทางกัน คือ บิดามารดาไม่ได้อยู่ร่วมกันฉันท์สามีภรรยาแล้ว แต่ยังไม่ได้หย่ากันตามกฎหมาย รวมทั้งผู้ที่ไม่ได้สมรสอย่างถูกต้องตามกฎหมาย แต่ไม่ได้อยู่ร่วมกันฉันท์สามีภรรยาแล้ว<br>
​2. หย่าร้าง คือ สามีภรรยาที่จดทะเบียนหย่าต่อนายทะเบียนถือว่าถูกต้องตามกฎหมาย เพื่อให้ความเป็นสามีภรรยา สิ้นสุดลง<br>
3. เสียชีวิต คือ หยุดหายใจ หัวใจหยุดเต้น สมองหยุดทำงานโดยสิ้นเชิง<br>
4. ไม่ส่งเสียเลี้ยงดู คือ ไม่อุปการะ ส่งเสียในเรื่องค่าใช้จ่าย และไม่ดูแลนักศึกษา<br>
5. หายสาบสูญ เรียกบุคคลซึ่งได้ไปจากภูมิลำเนา หรือถิ่นที่อยู่ และไม่มีใครรู้แน่ว่าบุคคลนั้นยังมีชีวิตอยู่หรือไม่ ตลอดระยะเวลา ๕ ปี และศาลมีคำสั่งให้เป็นคนสาบสูญว่า คนสาบสูญ</b></p>
                    <label for="economic_status">เลือกสถานะของมารดา:</label>
                    <select id="economic_status" name="economic_status" required>
                        <option value="" disabled selected>-- เลือกสถานะ --</option>
                        <option value="poor">มารดาแยกทางกับบิดา (หากเลือกข้อนี้กรุณาดาวน์โหลดหนังสือรับรองสถานภาพ)</option>
                        <option value="middle">มารดาหย่าร้างกับบิดา (หากเลือกข้อนี้กรุณาแนบหลักฐาน สำเนาใบหย่าที่ออกจากทางรายชการ)</option>
                        <option value="rich">มารดาเสียชีวิต (หากเลือกข้อนี้กรุณาแนบหลักฐาน สำเนาใบมรณบัตร หรือหลักฐานอื่น ๆ จากทางราชการที่แสดงว่าเสียชีวิต)</option>
                        <option value="">มารดาไม่ส่งเสียเลี้ยงดู หากเลือกข้อนี้กรุณาดาวน์โหลดหนังสือรับรองสถานภาพ</option>
                        <option value="">มารดาหายสาบสูญ หากเลือกข้อนี้กรุณาแนบหลักฐานจากทางราชการที่เป็นบุคคลสาบสูญ</option>
                    </select>
                </div>
            </div>

            <!-- ส่วน 4: เอกสารที่ต้องเตรียมเพิ่มเติม -->
            <div class="question-section">
                <h3>เอกสารที่ต้องเตรียมเพิ่มเติมสำหรับนักศึกษาที่อยู่ในความดูแลของบิดาและมารดา แยกตามสถานภาพครอบครัว คือ</h3>
                <div class="form-group">
                    <label for="additional_docs">เลือกเอกสารที่ต้องเตรียม:</label>
                    <select id="additional_docs" name="additional_docs" required>
                        <option value="" disabled selected>-- เลือกเอกสาร --</option>
                        <option value="doc1">บิดาประกอบอาชีพอิสระ มารดาแยกทาง หรือหย่าร้าง หรือไม่ส่งเสียเลี้ยงดู จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 2.1</option>
                        <option value="doc2">บิดาประกอบอาชีพอิสระ มารดาเสียชีวิต จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 2.2</option>
                        <option value="doc3">บิดาประกอบอาชีพมีเงินเดือนประจำ มารดาแยกทาง หรือหย่าร้าง หรือไม่ส่งเสียเลี้ยงดู จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 2.3</option>
                        <option value="doc4">บิดาประกอบอาชีพมีเงินเดือนประจำ มารดาเสียชีวิต จดจำ ว่าสถานภาพครอบครัวอยู่ข้อ 2.4</option>
                        <option value="doc5">บิดาไม่ประกอบอาชีพ มารดาแยกทาง หรือหย่าร้าง หรือไม่ส่งเสียเลี้ยงดู หรือเสียชีวิต กรุณาไปข้อต่อไปเพื่อให้ข้อมูลผู้ปกครอง</option>
                        <option value="doc6">บิดาไม่ประกอบอาชีพ มารดาเสียชีวิต</option>
                    </select>
                </div>
            </div>

            <button type="submit">ตกลง</button>
            <button type="button" onclick="document.querySelector('form').reset();" style="float: right;">ล้างแบบฟอร์ม</button>
        </form>
    </div>
</div>

</body>

</html>