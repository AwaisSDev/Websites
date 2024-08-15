<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital_fixer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST["service_id"];
    $service_name = $_POST["service_name"];
    $service_count = $_POST["service_count"];

    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("UPDATE services SET service_name = ?, service_count = ? WHERE id = ? AND user_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("siii", $service_name, $service_count, $service_id, $user_id);
    if ($stmt->execute()) {
        echo "Service updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    session_start();

// Handle login logic

// After successful login
$_SESSION["user_id"] = $user_id; // Store user ID in session

    $stmt->close();
}

$service_id = $_GET["id"];
$user_id = $_SESSION["user_id"];

$sql = "SELECT service_name, service_count FROM services WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $service_id, $user_id);
$stmt->execute();
$stmt->bind_result($service_name, $service_count);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Service</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Your CSS here */
    </style>
</head>
<body>
    <nav class="sidebar open">
    <header>
            <div class="image-text">
                <span class="image">
                    <!--<img src="logo.png" alt="">-->
                </span>
                <div class="text logo-text">
                    <span class="name">Awais</span>
                    <span class="profession">Web developer</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="dashboard.html">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="services.php">
                            <i class='bx bx-cog icon'></i>
                            <span class="text nav-text">Services</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="revenue.php">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Revenue</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="notifications.php">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="analytics.php">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">Analytics</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="wallets.php">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Wallets</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <section class="home">
        <div class="text">Update Service</div>
        <div class="form-container">
            <form action="update_service.php" method="POST">
                <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service_id); ?>">

                <label for="service_name">Service Name:</label>
                <input type="text" id="service_name" name="service_name" value="<?php echo htmlspecialchars($service_name); ?>" required>

                <label for="service_count">Service Count:</label>
                <input type="number" id="service_count" name="service_count" value="<?php echo htmlspecialchars($service_count); ?>" required>

                <button type="submit">Update Service</button>
            </form>
        </div>
    </section>
</body>
</html>
