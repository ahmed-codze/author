<?php
include 'connect.php';

// email

require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'aalfoly18@gmail.com';                     // SMTP username
    $mail->Password   = 'ahmed2442004';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;
    $mail->isHTML(true);
    $mail->charset = "UTF-8";
    $mail->setFrom('aalfoly18@gmail.com', 'mahmoud');
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
           <p>Thank you for your order we will call you later</p>
           </body>
           </html>
           ";

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
        <p>سوف يصلك ايمل لتأكيد الطلب</p>
    </div>
    </body>

</html>