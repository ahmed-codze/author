<?php

if (!(isset($_COOKIE['user']))) {
    header("location: log/signin.php");
    exit();
}
include "connect.php";



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/bootstrap.min.css" />

    <link rel="stylesheet" href="css/profile.css" />


</head>


<style>
    .edit {

        background-color: #4a65d2;
        color: #fff;
        font-size: 15px;
        border-radius: 5px;
        text-align: left;
        padding: 5px 10px;
        line-height: 2;
    }
</style>
<title>service</title>

<style>
    body {
        background-color: #f8f9fa;
    }

    img {
        max-width: 100%;
        max-height: 600px;
    }

    .price {

        color: #006fcc;
    }

    p {
        font-size: 24px;
        margin-top: 20px;
    }

    .time div {
        width: 70px;
        border-radius: 20px;
        border: 1px solid #888;
        text-align: center;
        cursor: pointer;
        line-height: 30px;
        transition: all .3s ease-in-out;
        display: inline-block;
        margin: 10px;
    }

    label::after {
        content: '';
        display: block;
        width: 100px;
        height: 1.5px;
        margin-top: 10px;
        background-color: #000;
    }

    /* media */
    .navbar ul li a:hover {
        color: rgba(217, 101, 75, 1) !important;
        background-color: #fff;
    }

    .single-blog__img {
        height: 270px;
    }

    .single-blog__img img {
        max-width: 100%;
        max-height: 100%;
    }

    .single-blog .single-blog__text p {
        margin-bottom: 20px;
    }



    @media (min-width: 900px) {
        .container {
            max-width: 700px;
        }

        .serv {
            height: 150px;
        }

        .discription {
            max-height: 50px;
            overflow: hidden;
        }
    }

    @media (max-width: 370px) {
        .blog-slider .slick-prev {
            left: 20%;
            bottom: -70px;
        }

        .blog-slider .slick-next {
            right: 20%;
            bottom: -70px;

        }

        .logo {
            width: 45px !important;
        }

        .slick-track {
            height: 200px;
        }

        .single-blog .single-blog__text p {
            max-height: 120px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .footer {
            text-align: center;
        }
    }

    /* @media (max-width: 700px) {
        .acc-info {
            width: 100% !important;
        }
    } */


    /* end media */
    .profile-head {
        display: none !important;
    }

    @media (width: 980px) {
        * {
            font-size: 33px;
        }
    }
</style>
</head>

<body class="bg-dark">
    <!-- Navigation -->

    <nav class="navbar navbar-dark bg-dark" aria-label="First navbar example" style="background-color: rgba(217, 101, 75, 1) !important; padding: 0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="position: relative; width: 55px;">
                <img src="images/logo (1).png" style="width: 55px; position: absolute; margin-top: -7px; z-index: 99999; top: 0;" class="logo" />
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
                    <?php

                    if (isset($_COOKIE['user'])) {
                        echo '
                
                <li class="nav-item">
                <a class="nav-link" href="profile.php">حسابي</a>
                </li>
                <li class="nav-item">
                <a class="nav-link logout" >تسجيل الخروج</a>
                </li>
                
                ';
                    } else {

                        echo '
                    
                    <li class="nav-item">
                    <a class="nav-link" href="log/signin.php">تسجيل الدخول</a>
                    </li>
                    
                    ';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Navigation end -->
    <div class="profile">
        <div class="container-fluid">
            <div class="row" style="margin-top: 0;">
                <div class=" acc-info col-sm-3 col-md-5 col-lg-3 col-xs-12">
                    <div class="profile-head ">
                        <div class=" text-center">
                            <span class='inf'> معلوماتك </span>
                        </div>

                    </div>

                    <?php

                    $user_id = $_COOKIE['user'];

                    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
                    $stmt->execute(array($user_id));
                    $rows = $stmt->fetchAll();

                    // the loop 
                    foreach ($rows as $row) {
                        echo '
                         <p class="line"> Name </p>
                         <p class="name"> ' . $row['first_name'] . '  ' . $row['second_name'] . '</p>
                         <p class="line"> Phone </p>
                         <p class="phone"> ' . $row['phone'] . ' </p>
                         <p class="line"> email </p>
                         <p class="name"> ' . $row['email'] . ' </p>


                        ';
                    }


                    ?>

                </div>

                <!-- cart -->
                <div class=" col-sm-9 col-md-7 col-lg-9 cart">
                    <h2 class="text-center" style="padding: 20px; color: #fff"> جدول الحجوزات</h2>
                    <?php

                    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
                    $stmt->execute(array($user_id));
                    $rows = $stmt->fetchAll();
                    foreach ($rows as $row) {
                        $user_email = $row['email'];
                    }

                    $stmt = $con->prepare("SELECT * FROM customers WHERE email = ?");
                    $stmt->execute(array($user_email));
                    $count = $stmt->rowCount();

                    if ($count > 0) {

                        $dates = $stmt->fetchAll();
                        echo '
                        <div class="avilable-dates">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th scope="col">االيوم</th>
                                    <th scope="col">الساعة</th>
                                    <th scope="col">ملاحظة</th>
                                    <th scope="col">اسم الخدمة</th>
                                    <th scope="col">موضوع الخدمة</th>
                                </tr>
                            </thead>
                            <tbody>
                              ';
                        // the loop 
                        foreach ($dates as $date) {
                            echo '
                                <tr>
                                    <td>' . $date["service_day"] . '</td>
                                    <td>' . $date["service_hour"] . '</td>
                                    <td>' . $date["note"] . '</td>
                                    <td>' . $date["service_title"] . '</td>
                                    <td>' . $date["around"] . '</td>
                                </tr>
                                ';
                        }
                    } else {
                        echo '
                            <div class="text-center">
                            <br>
                            <h4 style="color: #fff;">انت لم تقم بطلب اي خدمة بعد </h4>
                            <br>
                            <a href="index.php#serv"><div class="btn btn-primary">توجه الي الخدمات</div></a>
                            </div>
                        ';
                    }
                    ?>

                    </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>


    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
<script>
    if ($(window).width() > 500) {
        $(".acc-info").height($(window).height() - $(".navbar").height());
    }
    $(".cart .navbar, .cart .quantity, .quantity-box, .order, .remove-cart").hide();
    $('.logout').click(function() {
        window.location.replace('index.php?logout=1');
    })
</script>