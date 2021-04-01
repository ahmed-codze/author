<?php
include 'connect.php';

// email

$user_id = $_COOKIE['user'];

$stmt = $con->prepare("SELECT * FROM customers WHERE email = ?");
$stmt->execute(array($_COOKIE['email']));
$rows = $stmt->fetchAll();

foreach ($rows as $row) {
    $fist_name = $row['first_name'];
    $second_name = $row['second_name'];
    $phone = $row['phone'];
    $service_title = $row['service_title'];
    $serv_hour = $row['service_hour'];
    $serv_day = $row['service_day'];
    $around = $row['around'];
    $note = $row['note'];
}

require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'allsends2020@gmail.com';                     // SMTP username
    $mail->Password   = 'Programer123';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;
    $mail->isHTML(true);
    $mail->charset = "UTF-8";
    $mail->setFrom('allsends2020@gmail.com', 'mahmoud');
    $mail->addAddress($_COOKIE['email']);
    $mail->Subject = 'new date';
    $mail->Body    = "
        
        <html>
        <head>
        <meta charset='utf-8'>
        <title>HTML email</title>
        </head>
        <body>
        <h1>confirm your order</h1>
        <h3>Thank you for your order we will call you later</h3>
        <p>الاسم الاول</p>
        <h3>" . $fist_name . "</h3>
        <p>الاسم الثاني</p>
        <h3>" . $second_name . "</h3>
        <p>الهاتف</p>
        <h3>" . $phone . "</h3>
        <p>اسم الخدمة</p>
        <h3>" . $service_title . "</h3>
        <p>اليوم</p>
        <h3>" . $serv_day . "</h3>
        <p>الساعة</p>
        <h3>" . $serv_hour . "</h3>
        <p>الموضوع الذي ستدور حوله الخدمة</p>
        <h3>" . $around . "</h3>
        <p>ملاحظات</p>
        <h4>" . $note . "</h4>
        </body>
        </html>
        ";

    $mail->send();

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>check out</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.css" />

    <style>
        h1 {
            margin: 20px 0;
        }

        .heart {
            color: #ba0f0f;
        }

        .btn {
            margin: 20px;
        }

        i {
            color: green;
        }
    </style>
    <div class="container text-center">
        <h1>تم طلب الخدمة</h1>
        <i class="fas fa-check fa-4x"></i>
        <br>
        <a href="index.php">
            <div class="btn btn-primary">العودة للرئيسية</div>
        </a>
        <br>
        <h3>سوف تصلك رسالة تأكيد علي الايميل</h3>
    </div>
    </body>

</html>