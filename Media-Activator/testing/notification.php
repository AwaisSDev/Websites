<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Page</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    /* General styles */
/* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
}

/* Notification styles */

@media (min-width: 768px) {
    main {
    margin-left: 250px; /* Adjust based on sidebar width */
    padding: 20px;
}
}

@media (max-width:480px) {
    main {
    margin-left: 100px; /* Adjust based on sidebar width */
    padding: 20px;
}
}

.notification-list {
    list-style: none;
    padding: 0;
}

.notification-item {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    padding: 10px;
    position: relative;
}

.notification-item.unread {
    border-left: 5px solid #007bff;
    background-color: #e9f5ff;
}

.notification-item.read {
    border-left: 5px solid #ddd;
    background-color: #fff;
}

.notification-item .mark-as-read {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    color: #007bff;
}

.btn {
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    padding: 10px 20px;
    font-size: 16px;
}

.btn:hover {
    background-color: #0056b3;
}

/* Dark mode styles */  
</style>
<body>
    <header>
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
    <main>
        <header>
            <h1>Notifications</h1>
        </header>
        <div id="notifications" class="notification-list">
            <!-- Notifications will be dynamically added here -->
        </div>
        <button id="clearAll" class="btn">Clear All</button>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>
</html>