<?php
if (!(isset($_COOKIE['admin']))) {
    header('location: login.php');
    exit();
}
include '../connect.php';

if (isset($_POST['first_name'])) {

    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $second_name = filter_var($_POST['second_name'], FILTER_SANITIZE_STRING);
    $about = filter_var($_POST['about_me'], FILTER_SANITIZE_STRING);

    // Count # of uploaded files in array
    $total = count($_FILES['upload']['name']);

    // Loop through each file
    for ($i = 0; $i < $total; $i++) {

        //Get the temp file path
        $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

        //Make sure we have a file path
        if ($tmpFilePath != "") {
            //Setup our new file path
            $newFilePath = "../images/author/" . $_FILES['upload']['name'][$i];

            //Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            }
        }
    }
    $firstImg = $_FILES['upload']['name'][0];
    $second_img = $_FILES['upload']['name'][1];

    $stmt = $con->prepare('UPDATE author SET first_name = ? , second_name = ?, first_img = ?, second_img = ?, about_me = ? 
                            WHERE id = 1');

    $stmt->execute(array(
        $first_name, $second_name, $second_img, $firstImg, $about
    ));
    echo '<script> alert("تم تحديث معلوماتك بنجاح") </script>';
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

                <form class="form-group container" action="author.php" method="POST" enctype="multipart/form-data">
                    <h1 class="h3 mb-3 fw-normal text-center">تحديث المعلومات الخاصة بك</h1>

                    <label for="firstName">الاسم الاول</label>
                    <input type="text" id="firstName" class="form-control" placeholder="الاسم الاول" required autofocus name="first_name">

                    <label for="second_name">الاسم الثاني</label>
                    <input type="text" id="second_name" class="form-control" placeholder="الاسم الثاني" required autofocus name="second_name">
                    <label for="img" class="">اختر الصورة الاولي والثانية علي الترتيب</label>
                    <input type="file" id="img" class="form-control" placeholder="صورتين لك" required autofocus name="upload[]" multiple>

                    <label for="aboutMe" class="">نبذة تعريفية</label>
                    <textarea name="about_me" id="aboutMe"></textarea>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">تحديث</button>
                </form>

            </main>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>