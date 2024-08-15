<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // change this if you have a different MySQL user
    $password = ""; // change this if you have a different MySQL password
    $dbname = "digital_fixer";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if ($hashedPassword) {
        if (password_verify($pass, $hashedPassword)) {
            $_SESSION["username"] = $user;
            header("Location: welcome.html");
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "No user found";
    }

    $stmt->close();
    $conn->close();
}

if (!isset($_SESSION['redirected'])) {
    if (is_mobile()) {
        $_SESSION['redirected'] = true; // Set redirection flag
        header('Location: login1.php');
    } else {
        $_SESSION['redirected'] = true; // Set redirection flag
        header('Location: login.php');
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/css/util.css">
    <link rel="stylesheet" type="text/css" href="login-form-v4/Login_v4/css/main.css">
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="" method="POST">
                    <span class="login100-form-title p-b-49">
                        Login
                    </span>

                    <?php
                    if (!empty($error)) {
                        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    }
                    ?>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Type your username">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>
                    
                    <div class="text-right p-t-8 p-b-31">
                        <a href="#">
                            Forgot password?
                        </a>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="submit">
                                Login
                            </button>
                        </div>
                    </div>

                    <div class="txt1 text-center p-t-54 p-b-20">
                        <span>
                            Or Sign Up Using
                        </span>
                    </div>

                    <div class="flex-c-m">
                        <a href="#" class="login100-social-item bg1">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="login100-social-item bg2">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="#" class="login100-social-item bg3">
                            <i class="fa fa-google"></i>
                        </a>
                    </div>

                    <div class="flex-col-c p-t-155">
                        <span class="txt1 p-b-17">
                            Or Sign Up Using
                        </span>

                        <a href="register.php" class="txt2">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="dropDownSelect1"></div>
    
    <script src="login-form-v4/Login_v4/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="login-form-v4/Login_v4/vendor/animsition/js/animsition.min.js"></script>
    <script src="login-form-v4/Login_v4/vendor/bootstrap/js/popper.js"></script>
    <script src="login-form-v4/Login_v4/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="login-form-v4/Login_v4/vendor/select2/select2.min.js"></script>
    <script src="login-form-v4/Login_v4/vendor/daterangepicker/moment.min.js"></script>
    <script src="login-form-v4/Login_v4/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="login-form-v4/Login_v4/vendor/countdowntime/countdowntime.js"></script>
    <script src="login-form-v4/Login_v4/js/main.js"></script>
                
    <script>
        function redirectBasedOnDevice() {
            const isMobile = window.innerWidth <= 768;
            const currentPath = window.location.pathname;

            if (isMobile && !currentPath.includes('login1.php')) {
                window.location.href = 'login1.php';
            } else if (!isMobile && !currentPath.includes('login.php')) {
                window.location.href = 'login.php';
            }
        }

        // Run the redirection function on page load
        window.onload = redirectBasedOnDevice;

        // Run the redirection function on window resize
        window.onresize = redirectBasedOnDevice;
    </script>

</html>
