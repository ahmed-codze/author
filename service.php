<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/nice-select.css" />
    <link rel="stylesheet" href="css/all.css" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css" />

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

        @media (min-width: 900px) {
            .row {
                margin-top: 50px;
            }

            @media (max-width: 500px) {
                img {
                    max-height: 300px;
                }
            }
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

        @media (max-width: 600px) {
            .logo {
                width: 15% !important;
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

        /* end media */
    </style>
</head>

<body style="background-color: #000; color: #fff">
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
                        <a class="nav-link" href="#serv">الخدمات</a>
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

    <!-- Navigation end -->
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET['id'])) {

                $service_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                include 'connect.php';

                // check if the id is exist

                $stmt = $con->prepare("SELECT id FROM services WHERE id = ?");
                $stmt->execute(array($service_id));
                $count = $stmt->rowCount();
                // if exist 

                if ($count > 0) {

                    // get if exist

                    $stmt = $con->prepare("SELECT * FROM services Where id =?");
                    $stmt->execute(array($service_id));
                    $services = $stmt->fetchAll();
                    foreach ($services as $serv) {
                        echo '
                <div class="col-sm-6 text-center" style="height: 100%;">
                <img src="images/services/' . $serv['img'] . '">
                </div>
                <div class="col-sm-6">
                    <h2>' . $serv["title"] . '</h2>
                    <p class="price">' . $serv["price"] . '$</p>
                    <p>' . $serv["service_time"] . 'دقيقة </p>
                    <div style="max-width: 400px; margin-bottom: 20px;">
                    ' . $serv["content"] . '
                </div>
            ';
                    }
                } else {
                    header('location: index.php');
                    exit();
                }
            } else {
                header('location: index.php');
                exit();
            }

            ?>

            <div class="box" style="margin-bottom: 60px; color: #000">
                <label class="h5" style="margin-bottom: 20px; color: #fff;">اختر اليوم المناسب</label>
                <select class="wide day">
                    <option data-display="Select">اليوم\الشهر\السنة</option>
                    <?php

                    $stmt = $con->prepare("SELECT * FROM avilable_date");
                    $stmt->execute();
                    $days = $stmt->fetchAll();
                    $repeated = array();
                    // the loop 
                    foreach ($days as $day) {
                        if (!(in_array($day['time_day'], $repeated))) {
                            echo '
                                <option value="' . $day['time_day'] . '">' . $day['time_day'] . '</option>

                                ';
                            array_push($repeated, $day['time_day']);
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="time" style="display: none;">
                <p class="h5">اختر الوقت المناسب</p>
                <?php

                $stmt = $con->prepare("SELECT * FROM avilable_date");
                $stmt->execute();
                $hours = $stmt->fetchAll();

                foreach ($hours as $hour) {
                    echo '
                            <div class="' . $hour["time_day"] . '" data-time="' . $hour["time_hour"] . '" data-id="' . $service_id . '">' . $hour["time_hour"] . '</div>
                            ';
                }
                ?>

            </div>
            <div class="text-center book " style="display: none; margin-top:30px">
                <a>
                    <div class="btn btn-danger" style="width: 150px; text-align:center; font-size: 18px;">حجز</div>
                </a>
            </div>
        </div>
    </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script>
        $('select').niceSelect();
        $('.current').html('اختر');

        $('.day .option').click(function() {
            $choosen = $(this).data('value');
            $('.time').fadeIn('slow');
            $('.time div').hide();
            $('.time .' + $choosen).show();
        });

        $('.time div').click(function() {
            $('.time div').css({
                backgroundColor: '#000',
                color: '#fff'
            });
            $hour = $(this);
            $(this).css({
                backgroundColor: '#fff',
                color: '#000'
            });
            $('.book').fadeIn(800);
            $('.book a').attr('href', 'book.php?day=' + $hour.attr('class') + '&hour=' + $hour.data('time') + '&id=' + $hour.data('id'));
        });
    </script>
</body>

</html>