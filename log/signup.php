<?Php
include '../connect.php';

$head_message = 'انشاء حساب ';

if (isset($_POST['first_name'])) {

    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $seond_name = filter_var($_POST['second_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);

    // check if account is exist

    $stmt = $con->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute(array($email));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $head_message = "هذاالحساب موجود بالفعل !";
    } else {

        // if email is not exist

        $stmt = $con->prepare('INSERT INTO users (first_name, second_name, pass, email, phone) 
                                        VALUES (:first_name, :second_name, :pass, :email, :phone)');
        $stmt->execute(array(
            'first_name' => $first_name,
            'second_name' => $seond_name,
            'pass' => $pass,
            'email' => $email,
            'phone' => $phone
        ));

        // get id 

        $stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute(array($email));
        $rows = $stmt->fetchAll();

        // the loop 
        foreach ($rows as $row) {
            setcookie("user", $row['id'], time() + 3600 * 24 * 90, "/");
        }

        header('location: ../index.php?up=our7rei437g');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V11</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico" /> -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="../css/all.css" />

    <!--===============================================================================================-->
    <style>
        /* media */
        .navbar ul li a:hover {
            color: rgba(217, 101, 75, 1) !important;
            background-color: #fff;
        }


        @media (max-width: 370px) {

            .logo {
                width: 45px !important;
            }
        }

        /* end media */
    </style>

</head>

<body class="bg-dark">
    <!-- Navigation -->

    <nav class="navbar navbar-dark bg-dark" aria-label="First navbar example" style="background-color: rgba(217, 101, 75, 1) !important; padding: 0;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php" style="position: relative;">
                <img src="../images/logo (1).png" style="width: 55px; position: absolute; margin-top: -7px; z-index: 99999; top: 0;" class="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample01">
                <ul class="navbar-nav me-auto mb-2 text-center">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="../index.php">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php#serv">الخدمات</a>
                    </li>
                    <?php

                    if (isset($_COOKIE['user'])) {
                        echo '
                    
                    <li class="nav-item">
                    <a class="nav-link" href="../profile.php">حسابي</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link logout" >تسجيل الخروج</a>
                    </li>
                    
                    ';
                    } else {

                        echo '
                        
                        <li class="nav-item">
                        <a class="nav-link" href="signin.php">تسجيل الدخول</a>
                        </li>
                        
                        ';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Navigation end -->
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
                <form class="login100-form validate-form" method="POST" action="signup.php">
                    <span class="login100-form-title p-b-55">
                        <?Php echo $head_message; ?>
                    </span>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="first_name" placeholder="الاسم الأول">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-user"></span>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="second_name" placeholder="الاسم الثاني">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-user"></span>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="tel" name="phone" placeholder="رقم الهاتف">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-phone"></span>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" placeholder="البريد الالكتروني">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-envelope"></span>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="كلمة المرور">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-lock"></span>
                        </span>
                    </div>


                    <div class="container-login100-form-btn p-t-25">
                        <button class="login100-form-btn">
                            انشاء
                        </button>
                    </div>

                    <div class="text-center w-full p-t-115">
                        <span class="txt1">
                            لديك حساب بالفعل ؟
                        </span>

                        <a class="txt1 bo1 hov1" href="signin.php">
                            تسجيل الدخول
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <script>
        $('.logout').click(function() {
            window.location.replace('index.php?logout=1');
        })
    </script>
</body>

</html>