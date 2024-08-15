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
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $confirm_pass = $_POST["confirm_password"];

    if ($pass !== $confirm_pass) {
        $error = "Passwords do not match.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            // Insert new user into database
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $user, $email, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION["username"] = $user;
                header("Location: login1.php");
                exit();
            } else {
                $error = "Error registering user.";
            }
        }

        $stmt->close();
    }

    $conn->close();
}

if (!isset($_SESSION['redirected'])) {
    if (is_mobile()) {
        $_SESSION['redirected'] = true; // Set redirection flag
        header('Location: register1.php');
    } else {
        $_SESSION['redirected'] = true; // Set redirection flag
        header('Location: register.php');
    }
    exit();
}

function is_mobile() {
    $mobile_agents = array('iPhone', 'Android', 'webOS', 'BlackBerry', 'iPod', 'Symbian');
    foreach ($mobile_agents as $agent) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], $agent) !== false) {
            return true;
        }
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
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
    <style>
        .wrap-input100 {
            margin-bottom: 30px; /* Add space between the form fields */
        }
    </style>
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="" method="POST">
                    <span class="login100-form-title p-b-49">
                        Sign up
                    </span>

                    <?php
                    if (!empty($error)) {
                        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    }
                    ?>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Type your username" required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Type your email" required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password" required>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Confirm password is required">
                        <span class="label-input100">Confirm Password</span>
                        <input class="input100" type="password" name="confirm_password" placeholder="Type your password again" required>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="submit">
                                Register
                            </button>
                        </div>
                    </div>

                    <div class="flex-col-c p-t-155">
                        <span class="txt1 p-b-17">
                            Or Login Using
                        </span>

                        <a href="login1.php" class="txt2">
                            Login
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

        if (isMobile && !currentPath.includes('register1.php')) {
            window.location.href = 'register1.php';
        } else if (!isMobile && !currentPath.includes('register.php')) {
            window.location.href = 'register.php';
        }
    }

    // Run the redirection function on page load
    window.onload = redirectBasedOnDevice;

    // Run the redirection function on window resize
    window.onresize = redirectBasedOnDevice;

    // Run the redirection function on document ready
    document.addEventListener('DOMContentLoaded', redirectBasedOnDevice);
</script>
</html>
