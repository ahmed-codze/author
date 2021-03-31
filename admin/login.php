<?php
$header_message = 'Admin login';

if (isset($_POST['email'])) {

    include '../connect.php';

    $email  = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pass   = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    // check if is admin 

    $stmt = $con->prepare("SELECT email, pass FROM users WHERE email = ? AND pass = ? AND group_id = 1");
    $stmt->execute(array($email, $pass));

    $count = $stmt->rowCount();
    if ($count > 0) {

        setcookie("admin", 1, time() + 3600 * 24, "/");
        header("location: index.php");
        exit();
    } else {
        $header_message = 'Data is wrong!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>admin login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/all.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="../images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="login.php" method="post">
                    <span class="login100-form-title" style="font-weight: bold;">
                        <?php echo $header_message; ?>
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="js/main.js"></script>

</body>

</html>