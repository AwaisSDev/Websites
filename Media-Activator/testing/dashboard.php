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
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
         body.dark {
    background-color: #18191a; /* Dark background for body */
    color: white !important; /* Light text color for body */
}

body.dark .container {
    background-color:#18191a; /* Dark background for container */
    color: white !important; /* Light text color for container */
}

body.dark .service-option {
    background: #3a3b3c; /* Dark background for service options */
    color: white !important ; /* Light text color for service options */
}

body.dark .service-option h3 {
    color: white !important;  /* Lighter text color for service titles */
}

body.dark .service-option p {
    color: white !important;  /* Light gray text color for service descriptions */
}

body.dark .selected-services {
    background: #3a3b3c; /* Dark background for selected services section */
    color: white !important; /* Light text color for selected services section */
}

body.dark .selected-services ul li {
    background: #3a3b3c; /* Dark background for selected services list items */
    color: white !important;  /* Light text color for list items */
}

body.dark .selected-services ul li .remove-btn {
    background: #3a3b3c; /* Red color for remove button */
}

/* Dark mode toggle switch */
body.dark .mode-text {
    color: white !important;  /* Light text color for mode toggle text */
}
body.dark .block {
    border:none;
    background: #3a3b3c; /* Dark background for selected services list items */
    color: white !important;  /* Light text color for list items */
}
body.dark .text1{
    color:white;
}
body.dark .big-block{
    border:none;
    background: #3a3b3c; /* Dark background for selected services list items */
    color: white !important;  /* Light text color for list items */
}
body.dark .box{
    box-shadow:2px 2px 10px black;
    border:none;
    background: #3a3b3c; /* Dark background for selected services list items */
    color: white !important;  /* Light text color for list items */
}
        .text1{
            color:black;
            padding-bottom:50px;
        }
        .content-section { display: none; }
        .active { display: block; margin: 20px; }
        .dashboard {
            display: grid;
            grid-template-rows: repeat(2, auto);
            gap: 20px;
            padding: 20px;
        }
        .dashboard-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .big-block {
            grid-column: span 2;
            background: #f6f5ff;
            padding: 20px;
            border-radius: 8px;
        }
        .block {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .service-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .service-option {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            transition: background 0.3s, box-shadow 0.3s;
        }
        .service-option:hover {
            background: #f6f5ff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .service-option .plus-sign {
            font-size: 24px;
            color: #695cfe;
            margin-bottom: 10px;
            cursor: pointer;
            transition: color 0.3s;
        }
        .service-option .plus-sign:hover {
            color: #4e44c9;
        }
        .selected-services {
            padding: 20px;
        }
        .selected-services ul {
            list-style: none;
            padding: 0;
        }
        .selected-services ul li {
            background: #f6f5ff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .remove-btn {
            margin-bottom:40px;
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-left:307px;
        }

        .remove-btn:hover {
            background: #c0392b;
        }
        <style>
    .dashboard {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        padding: 20px;
    }
    .big-block,
    .block {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .big-block {
        grid-column: span 2;
        background: #f6f5ff;
    }

    .box {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .remove-btn {
        background: #e74c3c;
        color: white;
        border: none;
        padding: 10px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        display: block;
        margin: 10px auto; /* Center button */
        margin-bottom:50px;
    }

    .remove-btn:hover {
        background: #c0392b;
    }

    @media (max-width: 768px) {
        .dashboard {
            grid-template-columns: 1fr;
        }
        .dashboard-row {
            grid-template-columns: 1fr;
        }
        .remove-btn {
            margin-left: 0;
        }
    }

    @media (max-width: 480px) {
        .remove-btn {
            padding: 10px;
            font-size: 12px;
        }
    }

</style>

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
                        <a href="dashboard.php">
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

    <section class="home">
        <div class="text">Dashboard</div>
        <div class="dashboard">
            <div class="dashboard-row">
                <div class="block">
                    <h3>Active Services</h3>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text1"></th>
                                    <th class="text1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td class='text1'><?php echo htmlspecialchars($row['service_name']); ?></td>
                                        <td>
                                            <button class="remove-btn" data-id="<?php echo $row['id']; ?>">Remove</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="block">
                    <h3></h3>
                    <div id="active-customers" class="table-container">
                    <section class="dashboard">
    <!-- First Box: Active Services -->
    <!-- Second Box: Active Customers Chart -->
                    <div class="box box-chart">
                        <h2>Active Customers</h2>
                        <canvas id="activeCustomersChart" width="500" height="300"></canvas>
                    </div>

    <!-- Third Box: Additional Info -->
</section>

                        <!-- Active customers will be displayed here by JavaScript -->
                    </div>
                </div>
            </div>
            <div class="dashboard-row">
            <div class="big-block">
                <h3>Service Trends</h3>
                <canvas id="serviceTrendsChart" width="1000" height="170"></canvas>
            </div>

            </div>
        </div>
    </section>

    <script>
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

        const fetchActiveCustomers = async () => {
            try {
                const response = await
                const response = await fetch('https://api.google.com/active-customers'); // Replace with the actual API URL
                const data = await response.json();
                
                if (data.success) {
                    const customerCount = data.active_customers;
                    document.getElementById('active-customers').innerHTML = `<p>Active Customers: ${customerCount}</p>`;
                } else {
                    document.getElementById('active-customers').innerHTML = '<p>Failed to fetch active customers.</p>';
                }
            } catch (error) {
                console.error('Error fetching active customers:', error);
                document.getElementById('active-customers').innerHTML = '<p>Error fetching active customers.</p>';
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            fetchActiveCustomers();
        });

        document.querySelectorAll('.nav-link').forEach(item => {
            item.addEventListener('click', function() {
                const contentId = this.getAttribute('data-content');
                
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.remove('active');
                });
                
                document.getElementById(contentId).classList.add('active');
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth < 768) {
                document.querySelector('.sidebar').classList.add('close');
            }
        });
    </script>
    <script>document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('serviceTrendsChart').getContext('2d');
    var serviceTrendsChart = new Chart(ctx, {
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
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('activeCustomersChart').getContext('2d');
            var activeCustomersChart = new Chart(ctx, {
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
        });
    </script>
      <script>  // Function to toggle dark mode and save preference

     
    document.addEventListener('DOMContentLoaded', () => {
    const body = document.querySelector('body');
    const modeSwitch = document.querySelector(".toggle-switch");
    const modeText = modeSwitch;

    function toggleDarkMode() {
        const isDarkMode = body.classList.toggle("dark");
        localStorage.setItem("darkMode", isDarkMode ? "enabled" : "disabled");
    }
    
    // Load and apply dark mode setting from localStorage
    if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark');
    } else {
        body.classList.remove('dark');
    }
    
    // Attach event listener to toggle switch
    modeSwitch.addEventListener('click', toggleDarkMode);

    // Additional UI logic for other elements
    const sidebar = document.querySelector('nav'),
        toggle = document.querySelector(".toggle"),
        searchBtn = document.querySelector(".search-box");

    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    });

    document.querySelectorAll('.nav-link').forEach(item => {
        item.addEventListener('click', function() {
            const contentId = this.getAttribute('data-content');
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(contentId).classList.add('active');
        });
    });

    if (window.innerWidth < 768) {
        document.querySelector('.sidebar').classList.add('close');
    }})

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
        document.querySelectorAll('.remove-btn').forEach(button => {
    button.addEventListener('click', function() {
        console.log('Remove button clicked');  // Check if this logs to the console
        const serviceId = this.getAttribute('data-id');
        console.log('Service ID:', serviceId);  // Verify the ID is being retrieved

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
                console.log('Response:', data);  // Check the response
                alert(data);
                if (data.includes('successfully')) {
                    this.closest('tr').remove();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
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
