<?php
if (!(isset($_COOKIE['admin']))) {
    header('location: login.php');
    exit();
}
include '../connect.php';


if (isset($_GET['id'])) {

    $date_id  = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


    // check if the id is exist

    $stmt = $con->prepare("SELECT id FROM customers WHERE id = ?");
    $stmt->execute(array($date_id));
    $count = $stmt->rowCount();
    // if exist 

    if ($count > 0) {

        // Delete if exist

        $stmt = $con->prepare("DELETE FROM `customers` WHERE `customers`.`id` = :id");
        $stmt->bindParam(":id", $date_id);
        $stmt->execute();
    } else {
        header('location: customers.php');
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
                    <h1 class="h2">الحجوزات</h1>
                </div>

                <div class="avilable-dates">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">الاسم الأول</th>
                                <th scope="col">الاسم الثاني</th>
                                <th scope="col">الايميل</th>
                                <th scope="col">الهاتف</th>
                                <th scope="col">االيوم</th>
                                <th scope="col">الساعة</th>
                                <th scope="col">ملاحظة</th>
                                <th scope="col">اسم الخدمة</th>
                                <th scope="col">موضوع الخدمة</th>
                                <th scope="col">معلومات لأقصي استفادة</th>
                                <th scope="col">تم</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $con->prepare("SELECT * FROM customers");
                            $stmt->execute();
                            $dates = $stmt->fetchAll();

                            // the loop 
                            foreach ($dates as $date) {
                                echo '
                            <tr>
                                <td>' . $date["first_name"] . '</td>
                                <td>' . $date["second_name"] . '</td>
                                <td>' . $date["email"] . '</td>
                                <td>' . $date["phone"] . '</td>
                                <td>' . $date["service_day"] . '</td>
                                <td>' . $date["service_hour"] . '</td>
                                <td>' . $date["note"] . '</td>
                                <td>' . $date["service_title"] . '</td>
                                <td>' . $date["around"] . '</td>
                                <td>' . $date["useful"] . '</td>
                                <td><a href="customers.php?id=' . $date["id"] . '" class="btn btn-danger">تم</a></td>
                            </tr>
                            ';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <script src="../js/jquery.min.js"></script>
                <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>