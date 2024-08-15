<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    die(header("Location: sorry.php"));
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "digital_fixer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];
$sql = "SELECT id, service_name, service_count FROM services WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .container {
            margin-left: 0;
            padding: 15px;
            flex: 1;
        }
        .header {
            background: #f6f5ff;
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .header h1 {
            margin: 0;
        }
        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            margin-top: 0;
            font-size: 18px;
        }
        .card button {
            margin-top: 30px;
            margin-bottom: 20px;
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 14px;
        }
        .card button:hover {
            background: #c0392b;
        }
        .chart-container {
            position: relative;
            height: 200px;
            margin-bottom: 15px;
        }
        .chart-container canvas {
            width: 100% !important;
            height: auto !important;
        }
        .toggle {
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="sidebar open">
        <header>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <a href="dashboard_mobile.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="add_services.php">
                            <i class='bx bx-cog icon'></i>
                            <span class="text nav-text">Services</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="notification.php">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
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
    <div class="container" style="margin-left:80px;">
        <div class="header">
            <h1>Dashboard</h1>
        </div>
        <div class="card">
            <h2>Active Services</h2>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody><tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                                    
                                        <td class='text1' style="color:black;"><?php echo htmlspecialchars($row['service_name']); ?></td>
                                        <td>
                                            <button class="remove-btn" data-id="<?php echo $row['id']; ?>">Remove</button>
                                        </td>
                                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="card">
            <h2>Active Customers</h2>
            <div class="chart-container">
                <canvas id="activeCustomersChart"></canvas>
            </div>
        </div>
        <div class="card">
            <h2>Service Trends</h2>
            <div class="chart-container">
                <canvas id="serviceTrendsChart"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx1 = document.getElementById('activeCustomersChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Active Customers',
                        data: [5921, 4573, 6241, 5512, 8123, 4314, 6124],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var ctx2 = document.getElementById('serviceTrendsChart').getContext('2d');
            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: 'Service A Usage',
                        data: [10, 20, 15, 25, 30, 20, 35],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function() {
                const serviceId = this.getAttribute('data-id');

                if (confirm('Are you sure you want to remove this service?')) {
                    fetch('remove_service.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'id': serviceId
                        }),
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        if (data.includes('successfully')) {
                            // Remove the row from the table
                            this.closest('tr').remove();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
  <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click" , () =>{
            sidebar.classList.toggle("close");
        });

        searchBtn.addEventListener("click" , () =>{
            sidebar.classList.remove("close");
        });

        modeSwitch.addEventListener("click" , () =>{
            body.classList.toggle("dark");
            modeText.innerText = body.classList.contains("dark") ? "Light mode" : "Dark mode";
        });

        // Handle content switching
        document.querySelectorAll('.nav-link').forEach(item => {
            item.addEventListener('click', function() {
                const contentId = this.getAttribute('data-content');
                
                // Hide all content sections
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show the selected content section
                document.getElementById(contentId).classList.add('active');
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth < 768) {
                document.querySelector('.sidebar').classList.add('close');
            }
        });
    </script>
    
    <script>
        function redirectBasedOnDevice() {
            const isMobile = window.innerWidth <= 768;
            const currentPath = window.location.pathname;

            if (isMobile && !currentPath.includes('dashboard_mobile.php')) {
                window.location.href = 'dashboard_mobile.php';
            } else if (!isMobile && !currentPath.includes('dashboard.php')) {
                window.location.href = 'dashboard.php';
            }
        }

        // Run the redirection function on page load
        window.onload = redirectBasedOnDevice;

        // Run the redirection function on window resize
        window.onresize = redirectBasedOnDevice;
    </script>

</body>
</html>
