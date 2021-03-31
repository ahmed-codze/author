<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/all.css" />
    <!-- cairo font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
    <title>محمود التركستاني</title>
    <style>
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

        i {
            margin: 0 5px;
            color: #fff;
            cursor: pointer;
            font-size: 20px;
            margin-top: 4px;
            transition: all .3s ease-in-out;
        }

        i:hover {
            font-size: 26px;
            color: orangered;
        }

        .fa-facebook-f:hover {
            color: #3b5999;
        }

        .fa-instagram:hover {
            color: #e4405f;
        }

        .fa-twitter:hover {
            color: #55acee;
        }

        .fa-linkedin:hover {
            color: #0077B5;
        }

        .fa-youtube:hover {
            color: #cd201f;
        }

        .fa-envelope:hover {
            color: #BB001B;
        }

        .footer-text {
            font-size: 22px;
            text-align: right;
            color: #fff;
            font-weight: 545;
        }

        .row {
            overflow: hidden;
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

<body>

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
                                                                                ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Navigation end -->

    <!-- Top banner -->
    <?php
    include 'connect.php';

    $stmt = $con->prepare("SELECT * FROM author");
    $stmt->execute();
    $information = $stmt->fetchAll();


    foreach ($information as $info) {
        echo '
                    <section class="fh5co-top-banner">
                        <div class="top-banner__inner site-container">
                            <div class="top-banner__image">
                                <img src="./images/author/' . $info['first_img'] . '" alt="author image" style="max-width: 500px;">
                            </div>
                            <div class="top-banner__text">
                                <div class="top-banner__text-up">
                                    <span class="brand-span" style="font-size: 18px;">مرحبا, أنا</span>
                                    <h2 class="top-banner__h2">' . $info['first_name'] . '</h2>
                                </div>
                                <div class="top-banner__text-down">
                                    <h2 class="top-banner__h2">' . $info['second_name'] . '</h2>
                                    <span class="brand-span" style="font-size: 15px;">سعيد بوجودك هنا</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Top banner end -->

                    <!-- About me -->
                    <section class="fh5co-about-me" id="about_me">
                        <div class="about-me-inner site-container">

                        <article class="portfolio-wrapper">
                        <div class="portfolio__img">
                            <img src="./images/author/' . $info['second_img'] . '" class="about-me__profile" alt="about me profile picture">
                        </div>
                        <div class="portfolio__bottom">
                            <div class="portfolio__name">
                                <h2 class="universal-h2">عليك تعلم قواعد اللعبة، ثم تلعب أفضل من الباقين! </h2>
                            </div>
                            <p>اينشتاين</p>
                        </div>
                    </article>
                    <div class="about-me__text" id="about_me">
                        <div class="about-me-slider">
                            <div class="about-me-single-slide">
                                <h2 class="universal-h2 universal-h2-bckg">نبذة عني</h2>
                                <p>' . $info['about_me'] . '</p>
                            </div>
                        </div>
                    </div>
                        ';
    }

    ?>

    </div>
    <div class="about-me-bckg"></div>
    </section>
    <!-- About me end -->

    <!-- Blog -->
    <section class="fh5co-blog" id="serv">
        <h2 class="universal-h2 universal-h2-bckg">خدماتي</h2>
        <div class="container">
            <?Php
            // get services from data base 

            $stmt = $con->prepare("SELECT * FROM services WHERE service_hidden = 0");
            $stmt->execute();
            $services = $stmt->fetchAll();


            foreach ($services as $serv) {
                echo '
            <div class="row text-center serv" 
                style="min-height: 20px; overflow: hiddden; margin-bottom: 40px; background-color: #000; color: #fff; padding: 20px;">

                <div class="col-4" style="overflow: hidden; height: 200px;">
                    <img src="images/services/' . $serv['img'] . '" style="width: 100%; max-height: 120px;" class="img-fluid" />
                </div>

                <div class="col-8">

                <div class="row">
                <div class="col-sm-8">
                    <h5> ' . $serv['title'] . ' </h5>
                    <span style="font-size: 20px;">' . $serv['service_time'] .  'min</span> | 
                    <span style="color: #006fcc; font-size:20px;">' . $serv['price'] . '$ </span>
                    <p style="margin-top: 10px; color:#e9573f;" class="discription">
                        ' . $serv['content'] . '
                    </p>
                </div>
              
                <div class="col-sm-4">
                <a href="service.php?id=' . $serv['id'] . '">
               <div class=" btn btn-lg btn-danger" style="height: 50px; line-height: 40px; font-size: 18px">
               حجز
                </div>
                </a>
                </div>
                </div>
                </div>

            </div>
         ';
            }

            ?>
        </div>

    </section>
    <!-- Blog end -->

    <!-- Social -->
    <section class="footer ">
        <footer class="footer mt-auto py-2 " style="background-color:#5db26b;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 d-none d-sm-block">
                        <a target="_blank" href="https://web.facebook.com/mahmoudx"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="https://www.instagram.com/mahmoudx"><i class="fab fa-instagram "></i></a>
                        <a target="_blank" href="https://twitter.com/mahmoudx"><i class="fab fa-twitter "></i></a>
                        <a target="_blank" href="https://www.linkedin.com/in/mahmoudm?trk=hp-identity-name"><i class="fab fa-linkedin "></i></a>
                        <a target="_blank" href="https://www.youtube.com/user/CSRinSaudi/videos"><i class="fab fa-youtube"></i></a>
                        <i id="gm" class="fa fa-envelope"></i>
                        <a target="_blank" href="http://mmt.sa/"><i class="fas fa-globe-americas"></i></a>
                    </div>
                    <div class="col-sm-6 text-center d-block d-sm-none">
                        <a target="_blank" href="https://web.facebook.com/mahmoudx"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="https://www.instagram.com/mahmoudx"><i class="fab fa-instagram "></i></a>
                        <a target="_blank" href="https://twitter.com/mahmoudx"><i class="fab fa-twitter "></i></a>
                        <a target="_blank" href="https://www.linkedin.com/in/mahmoudm?trk=hp-identity-name"><i class="fab fa-linkedin "></i></a>
                        <a target="_blank" href="https://www.youtube.com/user/CSRinSaudi/videos"><i class="fab fa-youtube"></i></a>
                        <i id="gm" class="fa fa-envelope"></i>
                        <a target="_blank" href="http://mmt.sa/"><i class="fas fa-globe-americas"></i></a>
                    </div>
                    <div class="col-sm-6 footer-text d-none d-sm-block" style="overflow: hidden;">
                        <a href="https://maroof.sa/192926" target="_blank"><img src="images/footer.png" height="30px" />
                    </div>
                    <div class="col-sm-6 footer-text d-block d-sm-none text-center" style="overflow: hidden;">
                        <a href="https://maroof.sa/192926" target="_blank"><img src="images/footer.png" height="30px" />
                    </div>

                </div>
            </div>
        </footer>
    </section>
    <!-- Social -->

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $("#stamp").css('width', '100px');
    </script>
    <script>
        document.getElementById('gm').onclick = function() {
            window.location.href = "mailto:allforms2020@gmail.com";
        }
    </script>
</body>

</html>