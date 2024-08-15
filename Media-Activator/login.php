<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "digital_fixer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user = $_POST["username"];
    $pass = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashedPassword);
    $stmt->fetch();

    if ($hashedPassword && password_verify($pass, $hashedPassword)) {
        $_SESSION["user_id"] = $user_id;

        // Set a persistent cookie
        if (isset($_POST["remember_me"])) {
            setcookie("user_id", $user_id, time() + (86400 * 30), "/"); // 30 days
        }

        header("Location: welcome.html");
        exit();
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="colorlib-regform-7/colorlib-regform-7/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="colorlib-regform-7/colorlib-regform-7/css/style.css">
</head>
<body>

    <div class="main" form method="POST">

        <!-- Sign in Form -->
        <section class="sign-in" form method="POST">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="colorlib-regform-7/images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Login"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->

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

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
