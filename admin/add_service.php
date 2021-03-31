<?php
if (!(isset($_COOKIE['admin']))) {
    header('location: login.php');
    exit();
}
include '../connect.php';

if (isset($_POST['title'])) {

    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $time = filter_var($_POST['time'], FILTER_SANITIZE_NUMBER_INT);

    $tmpFilePath = $_FILES['img']['tmp_name'];
    $img = $_FILES['img']['name'];

    move_uploaded_file($tmpFilePath, '../images/services/' . $img);
    // upload to images folder

    // // insert to data base 

    $stmt = $con->prepare('INSERT INTO services (title, price, content, img, service_time) 
                            VALUES (:title, :price, :content, :img, :serv_time)');
    $stmt->execute(array(
        'title'     => $title,
        'price'     => $price,
        'content'   => $content,
        'img'       => $img,
        'serv_time' => $time
    ));
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
    <title>Admin</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
        form input,
        form button,
        form textarea {
            margin: 20px;
        }

        form textarea {
            width: 100%;
            min-height: 200px;
        }
    </style>

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

                <form class="form-group container" action="add_service.php" method="POST" enctype="multipart/form-data">
                    <h1 class="h3 mb-3 fw-normal text-center">اضافة خدمة جديدة</h1>
                    <label for="service_title" class="">اسم الخدمة</label>
                    <input type="text" id="service_title" class="form-control" placeholder="اسم الخدمة" required autofocus name="title">
                    <label for="service_price" class="">سعر الخدمة</label>
                    <input type="number" id="service_price" class="form-control" placeholder="سعر الخدمة" required autofocus name="price">
                    <label for="service_time" class="">وقت الخدمة</label>
                    <input type="number" id="service_time" class="form-control" placeholder="وقت الخدمة" required autofocus name="time">
                    <label for="service_discription" class="">وصف الخدمة</label>
                    <textarea name="content" id="service_discription"></textarea>
                    <label for="service_img" class="">صورة الخدمة</label>
                    <input type="file" id="service_img" name="img">
                    <button class="w-100 btn btn-lg btn-primary" type="submit">اضافة</button>
                </form>

            </main>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>