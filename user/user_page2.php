<?php
session_start();

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>นักศึกษาเริ่มกู้กับเกษม</title>

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

        .content h2, .content h3 {
            color: #F17629;
            margin-bottom: 20px;
        }

        .content p {
            margin-bottom: 10px;
        }

        .content ul {
            list-style-type: none;
            padding-left: 0;
        }

        .content ul li {
            margin-bottom: 10px;
        }

        .content ul li::before {
            content: "•";
            color: #F17629;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        .content a {
            color: #F17629;
            text-decoration: none;
        }

        .content a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<?php include('../user/header.php'); ?>

<div class="container">
    <div class="content">
        <h2>การเตรียมเอกสารขอกู้ยืม แบ่งตามอาชีพบิดามารดา และผู้ปกครอง</h2>

        <table>
            <thead>
                <tr>
                    <th>สถานภาพ/อาชีพ</th>
                    <th>บิดาอาชีพอิสระ</th>
                    <th>บิดาอาชีพมีเงินเดือนประจำ</th>
                    <th>บิดาไม่ประกอบอาชีพ</th>
                    <th>บิดาแยกทาง/หย่าร้าง หรือไม่ส่งเสียเลี้ยงดู หรือหายสาบสูญ</th>
                    <th>บิดาเสียชีวิต</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>มารดาอาชีพอิสระ</td>
                    <td>1.1</td>
                    <td>1.4</td>
                    <td>1.7</td>
                    <td>3.1</td>
                    <td>3.3</td>
                </tr>
                <tr>
                    <td>มารดาอาชีพมีเงินเดือนประจำ</td>
                    <td>1.2</td>
                    <td>1.5</td>
                    <td>1.8</td>
                    <td>3.2</td>
                    <td>3.4</td>
                </tr>
                <tr>
                    <td>มารดาไม่ประกอบอาชีพ</td>
                    <td>1.3</td>
                    <td>1.6</td>
                    <td>1.9 ผู้ปกครองอาชีพอิสระ</td>
                    <td>1.10 ผู้ปกครองอาชีพมีเงินเดือน</td>
                    <td>3.5 ผู้ปกครองอาชีพอิสระ</td>
                </tr>
                <tr>
                    <td>มารดาแยกทาง/หย่าร้าง หรือไม่ส่งเสียเลี้ยงดู หรือหายสาบสูญ</td>
                    <td>2.1</td>
                    <td>2.3</td>
                    <td>2.5 ผู้ปกครองอาชีพอิสระ</td>
                    <td>2.6 ผู้ปกครองอาชีพมีเงินเดือน</td>
                    <td>4.1 ผู้ปกครองอาชีพอิสระ</td>
                </tr>
                <tr>
                    <td>มารดาเสียชีวิต</td>
                    <td>2.2</td>
                    <td>2.4</td>
                    <td>2.7 ผู้ปกครองอาชีพอิสระ</td>
                    <td>2.8 ผู้ปกครองอาชีพมีเงินเดือน</td>
                    <td>4.2 ผู้ปกครองอาชีพอิสระ</td>
                </tr>
            </tbody>
        </table>

        <h3>คำจำกัดความการประกอบอาชีพ</h3>
        <ul>
            <li><strong>อาชีพอิสระ:</strong> การประกอบอาชีพที่มีค่าตอบแทนที่แบบไม่มีสลิปเงินเดือน หรือหนังสือรับรองเงินเดือน เช่น เกษตรกรประมง ค้าขาย รับจ้างทั่วไป ธุรกิจส่วนตัว ฯลฯ</li>
            <li><strong>อาชีพที่มีเงินเดือนประจำ:</strong> การประกอบอาชีพที่ได้รับค่าตอบแทนเป็นรายครึ่งเดือน หรือรายเดือน (มีสลิปเงินเดือน หรือหนังสือรับรองเงินเดือน) เช่น พนักงานบริษัท รับราชการ รัฐวิสาหกิจ ฯลฯ</li>
            <li><strong>ไม่ได้ประกอบอาชีพ:</strong> ไม่มีรายได้ ไม่ได้ทำงานใด ๆ เช่น พ่อบ้าน แม่บ้าน พิการ ป่วย บวช มีโทษจำคุก ฯลฯ</li>
        </ul>

        <h3>คำจำกัดความสถานภาพ</h3>
        <ul>
            <li><strong>แยกทางกัน:</strong> ผู้ที่มิได้อยู่ร่วมกันฉันท์สามีภรรยาแล้ว แต่ยังไม่ได้หย่ากันตามกฎหมาย รวมทั้งผู้ที่ไม่ได้สมรสอย่างถูกต้องตามกฎหมาย แต่ไม่ได้อยู่ร่วมกันฉันท์สามีภรรยาแล้ว</li>
            <li><strong>หย่าร้าง:</strong> สามีภรรยาที่จดทะเบียนหย่าต่อนายทะเบียนถือว่าถูกต้องตามกฎหมาย เพื่อให้ความเป็นสามีภรรยา สิ้นสุดลง</li>
            <li><strong>เสียชีวิต:</strong> หยุดหายใจ หัวใจหยุดเต้น สมองหยุดทำงานโดยสิ้นเชิง</li>
            <li><strong>ไม่ส่งเสียเลี้ยงดู:</strong> ไม่อุปการะ ส่งเสียในเรื่องค่าใช้จ่าย และไม่ดูแลนักศึกษา</li>
            <li><strong>หายสาบสูญ:</strong> เรียกบุคคลซึ่งได้ไปจากภูมิลำเนา หรือถิ่นที่อยู่ และไม่มีใครรู้แน่ว่าบุคคลนั้นยังมีชีวิตอยู่หรือไม่ ตลอดระยะเวลา ๕ ปี และศาลมีคำสั่งให้เป็นคนสาบสูญว่า คนสาบสูญ</li>
        </ul>

        <h3>กรอบวงเงินปีการศึกษา 2568</h3>
        <p>รอประกาศอย่างเป็นทางการ</p>

        <h3>ดาวน์โหลดแบบคำขอกู้ยืม</h3>
        <p>สแกน QR Code เพื่อขอแบบคำขอกู้ยืม หรือ <a href="https://docs.google.com/forms/d/e/1FAIpQLSedH4xCrJn2q_qV0dBUvcZ8zlhws7tGCA2nLXNezTAs5uj9WA/viewform?usp=header">คลิกเพื่อขอแบบคำขอกู้</a> (เปิดให้ดาวน์โหลดเดือนตุลาคม 2568 เป็นต้นไป)</p>
        <img src="path_to_qr_code_image.png" alt="QR Code" style="max-width: 200px; margin-top: 10px;">
    </div>
</div>

</body>
</html>