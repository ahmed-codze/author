<?Php
include 'connect.php';

$first_name_val = '';
$second_name_val = '';
$email_val = '';
$note_val = '';
$phone_val = '';
$service_hour = '';
$service_day = '';

if (isset($_GET['id']) and isset($_GET['day']) and isset($_GET['hour'])) {

    $service_id      = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $service_day     = filter_var($_GET['day'], FILTER_SANITIZE_STRING);
    $service_hour    = filter_var($_GET['hour'], FILTER_SANITIZE_STRING);



    // check if the id is exist

    $stmt = $con->prepare("SELECT id FROM services WHERE id = ?");
    $stmt->execute(array($service_id));
    $count = $stmt->rowCount();
    // if exist 

    if ($count > 0) {

        // check the date if exist 

        $stmt = $con->prepare("SELECT * FROM avilable_date WHERE time_day = ? AND time_hour = ?");
        $stmt->execute(array($service_day, $service_hour));
        $count = $stmt->rowCount();

        if (!($count > 0)) {
            header('location: service.php');
        }
    } else {
        header('location: service.php');
    }
} elseif (isset($_POST['first_name'])) {

    $fist_name      = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $second_name    = filter_var($_POST['second_name'], FILTER_SANITIZE_STRING);
    $email          = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $note           = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
    $service_title  = filter_var($_POST['service_name'], FILTER_SANITIZE_STRING);
    $serv_day       = filter_var($_POST['serv_day'], FILTER_SANITIZE_STRING);
    $serv_hour      = filter_var($_POST['serv_hour'], FILTER_SANITIZE_STRING);
    $around         = filter_var($_POST['around'], FILTER_SANITIZE_STRING);
    $useful         = filter_var($_POST['useful'], FILTER_SANITIZE_STRING);
    $phone          = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $price          = filter_var($_POST['serv_price'], FILTER_SANITIZE_NUMBER_INT);

    if ($note == "") {
        $note = 'لم تتم اضافة ملاحظات';
    }

    $stmt = $con->prepare('INSERT INTO customers (first_name, second_name, email, phone, note, service_day, service_hour, service_title, around, useful) 
                            VALUES (:fname, :secname, :email, :phone, :note, :serv_day, :serv_hour, :serv_title, :around, :useful)');
    $stmt->execute(array(
        'fname' => $fist_name,
        'secname' => $second_name,
        'email' => $email,
        'phone' => $phone,
        'note' => $note,
        'serv_day' => $serv_day,
        'serv_hour' => $serv_hour,
        'serv_title' => $service_title,
        'around'    => $around,
        'useful'    => $useful
    ));
    echo '
        <div class="overlay">
        <div class="buy">
        <h3>قم بالدفع عن طريق paypal</h3>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

            <!-- Identify your business so that you can collect the payments. -->
            <input type="hidden" name="business" value="sb-b4lxz5442457@personal.example.com">

            <!-- Specify a Buy Now button. -->
            <input type="hidden" name="cmd" value="_xclick">

            <!-- Specify details about the item that buyers will purchase. -->
            <input type="hidden" name="item_name" value="' . $service_title . '">
            <input type="hidden" name="amount" value="' . $price . '">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="return" value="http://4bcb23af82f5.ngrok.io/author/thx.php" />
            <!-- Display the payment button. -->
            <input type="image" name="submit" border="0" src="images/buy.png" alt="Buy Now" 
            style="width: 200px !important; height: 100px; border: 3px solid #000; border-radius: 20px; padding: 10px; cursor: pointer;">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
            <br>
            <a href="book.php?back=1&day=' . $serv_day . '&hour=' . $serv_hour . '"><div class="btn btn-primary"> تراجع </div>
        </form>
        </div>
        </div>
        ';

    setcookie("email", $email, time() + 3600 * 24 * 90, "/");

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
        $mail->addAddress('allforms2020@gmail.com');
        $mail->Subject = 'new date';
        $mail->Body    = "
            
            <html>
            <head>
            <meta charset='utf-8'>
            <title>HTML email</title>
            </head>
            <body>
            <h1>شخص حجز موعد</h1>
            <p>الاسم الاول</p>
            <h3>" . $fist_name . "</h3>
            <p>الاسم الثاني</p>
            <h3>" . $second_name . "</h3>
            <p>الايميل</p>
            <h3>" . $email . "</h3>
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
            <p>معلومات لتحقيق اقص استفادة</p>
            <h3>" . $useful . "</h3>
            <p>ملاحظات</p>
            <h4>" . $note . "</h4>
            </body>
            </html>
            ";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    $stmt = $con->prepare("DELETE FROM `avilable_date` WHERE `avilable_date`.`time_hour` = :hour");
    $stmt->bindParam(":hour", $serv_hour);
    $stmt->execute();
    $count = $stmt->rowCount();
} elseif (isset($_GET['back'])) {

    $stmt = $con->prepare("DELETE FROM customers WHERE service_day = ? AND service_hour = ?");
    $stmt->execute(array($_GET['day'], $_GET['hour']));
    $count = $stmt->rowCount();


    $stmt = $con->prepare('INSERT INTO avilable_date (time_day, time_hour) 
                            VALUES (:serv_day, :serv_hour)');

    $stmt->execute(array(
        'serv_day' => $_GET["day"],
        'serv_hour' => $_GET["hour"]
    ));
    header('location: index.php');
} else {
    header('location: index.php');
}

if (isset($_COOKIE['user'])) {

    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute(array($_COOKIE['user']));
    $rows = $stmt->fetchAll();

    // the loop 
    foreach ($rows as $row) {


        $first_name_val = $row['first_name'];
        $second_name_val = $row['second_name'];
        $email_val = $row['email'];
        $note_val = $row['note'];
        $phone_val = $row['phone'];
    }
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
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .buy {
            background-color: #fff;
            width: 400px;
            height: 400px;
            text-align: center;
            border-radius: 20px;
        }

        .buy h3 {
            font-weight: bold;
            margin-top: 50px;
        }

        .buy form {
            margin-top: 80px;
        }

        @media (max-width: 450px) {
            .buy {
                width: 250px;
                height: 250px;
            }

            .buy form {
                margin-top: 20px;
            }
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .book-button {
            color: #fff;
            background-color: #000;
        }

        .book-button:hover {
            color: #000;
            background-color: #fff;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="../checkout/form-validation.css" rel="stylesheet">
    <style>
        /* media */
        .navbar ul li a:hover {
            color: rgba(217, 101, 75, 1) !important;
            background-color: #fff;
        }


        @media (max-width: 600px) {
            .logo {
                width: 15% !important;
            }
        }

        @media (max-width: 370px) {

            .logo {
                width: 45px !important;
            }
        }

        body {
            color: #fff;
        }

        /* end media */
    </style>

</head>

<body class="bg-dark">
    <!-- Navigation -->

    <nav class="navbar navbar-dark bg-dark" aria-label="First navbar example" style="background-color: rgba(217, 101, 75, 1) !important; padding: 0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> <img src="images/logo (1).png" style="width: 14%; margin-top: -7px;" class="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample01">
                <ul class="navbar-nav me-auto mb-2 text-center">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="index.php">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#serv">الخدمات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="log/signin.php">تسجيل الدخول <?php
                                                                                if (isset($_COOKIE['user'])) {
                                                                                    echo ' (تم التسجيل<i class="fas fa-check" ></i> )';
                                                                                }
                                                                                ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <main style="margin-bottom: 20px;">
            <div class="py-5 text-center">
                <h2> طلب الخدمة </h2>
            </div>

            <div class="row g-3">
                <div class="col-md-5 col-lg-4 order-md-last">

                    <?Php


                    if (isset($_GET['id']) and isset($_GET['day']) and isset($_GET['hour'])) {

                        $stmt = $con->prepare("SELECT * FROM services WHERE id = ?");
                        $stmt->execute(array($service_id));
                        $rows = $stmt->fetchAll();

                        // the loop 
                        foreach ($rows as $row) {
                            echo '
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">الخدمة</span>
                            <span class="badge bg-secondary rounded-pill">' . $row['price'] . '$</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">' . $row['title'] . '</h6>
                                    <small class="text-muted" style="overflow: hidden; height: 37px; display: inline-block"> ' . $row['content'] . '</small>
                                </div>
                                <span class="text-muted">' . $row['service_time'] . 'دقيقة</span>
                            </li>
    
                        </ul>
    

                            ';
                        }
                    }
                    ?>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3 d-inline-block">معلومات شخصية</h4> <a href="log/signin.php">أو سجل الدخول</a> </span>
                    <form class="needs-validation" novalidate action="book.php" method="POST">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">الاسم الاول</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" value="<?php echo $first_name_val; ?>" required>
                                <div class="invalid-feedback">
                                    مطلوب الاسم الأول .
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">الكنية</label>
                                <input type="text" class="form-control" name="second_name" id="lastName" value="<?Php echo $second_name_val; ?>" required>
                                <div class="invalid-feedback">
                                    مطلوب اسم أخير .
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">البريد الإلكتروني </label>
                                <input type="email" class="form-control" id="email" name="email" value="<?Php echo $email_val; ?>" placeholder="you@example.com" required>
                                <div class="invalid-feedback">
                                    يرجى إدخال عنوان بريد إلكتروني صالح.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">رقم الهاتف</label>
                                <input type="tel" class="form-control" name="phone" id="address" value="<?Php echo $phone_val; ?>" required>
                                <div class="invalid-feedback">
                                    يرجى إدخال رقم الهاتف الخاص بك.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="around" class="form-label">مالذي تريد ان نركز حديثنا عنه في الجلسة؟</label>
                                <input type="text" class="form-control" id="around" name="around" required>
                                <div class="invalid-feedback">
                                    يرجى إدخال موضوع الجلسة.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="useful" class="form-label">كيف أستطيع أن أحقق لك أقصي استفادة من هذه الجلسة؟ <span> (اختياري)</span></label>
                                <input type="text" class="form-control" id="useful" name="useful">
                                <div class="invalid-feedback">
                                    يرجى إدخال موضوع الجلسة.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="note">ملاحظات تريد ادخالها <span>(اختياري)</span></label>
                                <textarea name="note" id="note" style="width: 100%; height: 120px; margin-top: 20px;"><?Php echo $note_val; ?></textarea>
                            </div>
                        </div>
                        <?Php

                        if (isset($_GET['id']) and isset($_GET['day']) and isset($_GET['hour'])) {

                            $stmt = $con->prepare("SELECT * FROM services WHERE id = ?");
                            $stmt->execute(array($service_id));
                            $rows = $stmt->fetchAll();

                            // the loop 
                            foreach ($rows as $row) {
                                echo '
                            <input type="hidden" name="service_name" value="' . $row['title'] . '" />
                            <input type="hidden" name="serv_price" value="' . $row['price'] . '" />
                                ';
                            }
                        }

                        ?>
                        <input type="hidden" name="serv_day" value="<?php echo $service_day ?>" />
                        <input type="hidden" name="serv_hour" value="<?php echo $service_hour ?> " />

                        <hr class="my-4">

                        <input class="w-100 btn btn-light btn-lg form-control book-button" type="submit" value="حجز الخدمة" />
                    </form>
                </div>
            </div>
        </main>
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();
        $('.overlay').parents().css('overflowY', 'hidden');
    </script>
</body>

</html>