<?php
if (!(isset($_COOKIE['admin']))) {
    header('location: login.php');
    exit();
}
include '../connect.php';

if (isset($_POST['pass'])) {

    $pass =  filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    $stmt = $con->prepare('UPDATE users SET pass = ? WHERE Group_id = 1');

    $stmt->execute(array(
        $pass
    ));
    unset($_COOKIE['admin']);
    setcookie('admin', '', time() - 3600 * 24, '/');
    echo '<script> alert("تم تغيير كلمة المرور بنجاح") </script>';
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
    <title>قالب لوحة القيادة · Bootstrap v5.0</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        input {
            margin: 20px 0;
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
                            <a class="nav-link" href="#">
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
                if (isset($_POST['old_pass'])) {

                    // check the password 
                    $old_pass =  filter_var($_POST['old_pass'], FILTER_SANITIZE_STRING);

                    $stmt = $con->prepare("SELECT pass FROM users WHERE pass = ? AND Group_id = 1");
                    $stmt->execute(array($old_pass));

                    $count = $stmt->rowCount();

                    // if it true 

                    if ($count > 0) {

                        echo '
                        <form action="pass.php" method="post" class="form-group">
                        <label>أدخل الباسورد الجديد </label>
                        <input type="text" name="pass" class="form-control"  placeholder="أدخل كلمة المرور الجديدة" />
                        <input type="submit" value="ارسال " class="form-control btn btn-primary" />
                        </form>
                        ';

                        // if it false

                    } else {
                        echo '
                        <form action="pass.php" method="post" class="form-group">
                           <label>كلمة المرور خطأ!</label>
                           <input type="text" name="old_pass" class="form-control" placeholder="أدخل كلمة المرور القديمة" />
                           <input type="submit" value="ارسال " class="form-control btn btn-primary" />
                        </form>
                        ';
                    }
                } else {
                    echo '
                     <form action="pass.php" method="post" class="form-group">
                        <label>أدخل الباسورد القديم </label>
                        <input type="text" name="old_pass" class="form-control"  placeholder="أدخل كلمة المرور القديمة" />
                        <input type="submit" value="ارسال " class="form-control btn btn-primary" />
                     </form>
                     ';
                }
                ?>
            </main>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>