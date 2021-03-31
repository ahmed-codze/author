<?php
if (!(isset($_COOKIE['admin']))) {
    header('location: login.php');
    exit();
}
include '../connect.php';
if (isset($_GET['id'])) {

    $service_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


    // check if the id is exist

    $stmt = $con->prepare("SELECT id FROM services WHERE id = ?");
    $stmt->execute(array($service_id));
    $count = $stmt->rowCount();
    // if exist 

    if ($count > 0) {

        // Delete if exist

        $stmt = $con->prepare("DELETE FROM `services` WHERE `services`.`id` = :id");
        $stmt->bindParam(":id", $service_id);
        $stmt->execute();
    } else {
        header('location: index.php');
    }
}
// stop service

if (isset($_GET['stop'])) {

    $service_id = filter_var($_GET['stop'], FILTER_SANITIZE_NUMBER_INT);


    // check if the id is exist

    $stmt = $con->prepare("SELECT id FROM services WHERE id = ?");
    $stmt->execute(array($service_id));
    $count = $stmt->rowCount();
    // if exist 

    if ($count > 0) {

        // stop if exist

        $stmt = $con->prepare('UPDATE services SET service_hidden = 1 WHERE id = ?');

        $stmt->execute(array(
            $service_id
        ));

        echo '<script> alert(" تم ايقاف الخدمة بنجاح") </script>';
    } else {
        header('location: index.php');
    }
}

// continue service 

if (isset($_GET['work'])) {

    $service_id = filter_var($_GET['work'], FILTER_SANITIZE_NUMBER_INT);


    // check if the id is exist

    $stmt = $con->prepare("SELECT id FROM services WHERE id = ?");
    $stmt->execute(array($service_id));
    $count = $stmt->rowCount();
    // if exist 

    if ($count > 0) {

        // work if exist

        $stmt = $con->prepare('UPDATE services SET service_hidden = 0 WHERE id = ?');

        $stmt->execute(array(
            $service_id
        ));

        echo '<script> alert(" تم بدأ الخدمة بنجاح") </script>';
    } else {
        header('location: index.php');
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
    <title> Admin </title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">اسم الموقع</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="تبديل التنقل">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">
                                <span data-feather="home"></span>
                                الخدمات </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_service.php">
                                <span data-feather="file"></span>
                                اضافة خدمة
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dates.php">
                                <span data-feather="shopping-cart"></span>
                                المواعيد
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customers.php">
                                <span data-feather="shopping-cart"></span>
                                الحجوزات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="author.php">
                                <span data-feather="shopping-cart"></span>
                                نبذة عني
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pass.php">
                                <span data-feather="shopping-cart"></span>
                                تغيير الباسورد
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">لوحة التحكم</h1>
                </div>
                <?php

                $stmt = $con->prepare("SELECT * FROM services");
                $stmt->execute();
                $services = $stmt->fetchAll();

                // the loop 
                foreach ($services as $serv) {
                    echo '
                    <div class="row" style="box-shadow: 0 2px 5px 0 rgb(0 0 0 / 8%); margin: 20px;">
                    <div class="col-sm-6 ' . $serv['service_hidden'] . '">
                    <h3>' . $serv["title"] . '</h3>
                    <p>' . $serv['content'] . '</p>
                    <a class="" href="index.php?id=' . $serv["id"] . '"><div class="btn btn-danger"> حذف </div></a>
                    <a class="stop" href="index.php?stop=' . $serv["id"] . '"><div class="btn btn-primary"> ايقاف </div></a>
                    <a class="start" href="index.php?work=' . $serv["id"] . '"><div class="btn btn-success"> بدأ </div></a>
                    </div>
                    <div class="col-sm-6 ' . $serv['service_hidden'] . '">
                    <img src="../images/services/' . $serv["img"] . '" / style="max-height: 200px;" class="img-fluid">
                    </div>
                    </div>
                ';
                }

                ?>

            </main>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            $('.1 .stop').hide();
            $('.0 .start').hide();
        })
    </script>
</body>

</html>