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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["service_name"])) {
        die("Service name is required.");
    }

    $service_name = $_POST["service_name"];
    $user_id = $_SESSION["user_id"];

    // Check if the service already exists for the user
    $check_stmt = $conn->prepare("SELECT id FROM services WHERE service_name = ? AND user_id = ?");
    if ($check_stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $check_stmt->bind_param("si", $service_name, $user_id);
    if ($check_stmt->execute() === false) {
        die("Execute failed: " . $check_stmt->error);
    }

    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows === 0) {
        // Insert new service if it doesn't exist
        $stmt = $conn->prepare("INSERT INTO services (service_name, user_id) VALUES (?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("si", $service_name, $user_id);
        if ($stmt->execute()) {
            echo "Service added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Service already exists.";
    }
    
    $check_stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
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

h1{
    margin-top:20px;
}
h2{
    margin-top:25px;
}
body.dark h2{
    margin-top:25px;
}

body.dark h1{
    margin-top:20px;
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
body.dark .service-option button {
            margin-top: 10px; /* Add space above the button */
            margin-bottom: 10px; /* Add space below the button */
            background-color: gray     ;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 100px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f5ff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .container h1 {
            margin-left:50px;
            font-size: 30px;
        }
        .service-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 50px;
            padding: 20px;
        }
        .service-option {;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px 10px;
            text-align: center;
            transition: transform 0.3s;
        }
        .service-option:hover {
            transform: translateY(-10px);
        }
        .service-option img {
            max-width: 100%;
            border-radius: 8px;
        }
        .service-option h3 {
            font-size: 22px;
            color: #333;
            margin: 20px 0 10px;
        }
        .service-option p {
            font-size: 16px;
            color: #777;
        }
        .service-option button {
            margin-top: 10px; /* Add space above the button */
            margin-bottom: 10px; /* Add space below the button */
            background-color:white;
            color: black;
            border: 1px black solid;
            border-radius: 8px;
            padding: 10px 100px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .service-option button:hover {
            background-color: #ccc;
        }
        .selected-services {
            margin-top: 40px;
            padding: 20px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left:180px;
            margin-right:15px;
        }
        .selected-services h2 {
            margin-left: 80px;
            font-size: 30px;
            margin-bottom: 20px;
        }
        .selected-services ul {
            list-style: none;
            padding: 0;
        }
        .selected-services ul li {
            margin-left: 50px;
            background: #e0e0e0;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .selected-services ul li .remove-btn {
            margin-left: 50px;
            background: #ff5f5f;
            border: none;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s;
        }
        .selected-services ul li .remove-btn:hover {
            background: #ff3f3f;
        }
        @media (max-width: 767px) {
            .container {
                max-width: 1200px;
                margin-left: 10px;
                padding: 20px;
                text-align: center;
            }
            .container h1 {
                font-size: 22px;
            }
            .selected-services h2 {
                font-size: 22px;
            }
        }
        .service-option img {
            width: 100%;
            height: 200px; /* Adjust height as needed */
            object-fit: cover; /* This will ensure images cover the area without distortion */
            border-radius: 8px;
        }
.service-options {
    margin-top:40px;
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 3 columns by default */
    gap: 20px;
    padding: 10px;
    margin-left:170px;
}

@media (min-width: 821px ) {

            .home {
                margin-left: 0;
            }
            nav {
                width: 100%;
                height: auto;
                position: relative;
            }
            nav.close {
                width: 100%;
            }
        }
            @media (max-width: 767px) {

                .selected-services {
                    display: flex;
                flex-direction: column;
                align-items: center; /* Center horizontally */
                justify-content: center; /* Center vertically */
                text-align: center; /* Center text inside the container */
                    margin-right:20px;
                    margin-top: 40px;
                    padding: 20px;
                    background: #fff;
                    border-radius: 16px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    margin-left: 70px;
                }
            
            .service-option {
                margin-left:0px;
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px 10px;
                text-align: center;
                transition: transform 0.3s;
            }


            .text2 {
                font-size: 22px;
            }
            .selected-services h2 {
                display: flex;
                flex-direction: column;
                align-items: center; /* Center horizontally */
                justify-content: center; /* Center vertically */
                text-align: center; /* Center text inside the container */
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                font-weight: 500;
                color: var(--text-color);
                font-size: 18px;
                margin-left:-2px;
                margin-top:10px;
                padding:30px;
            }
            .sidebar {
                width: 80px;
            }
            .sidebar.close {
                width: 80px;
            }
            .sidebar:not(.close) {
                width: 250px;
            }
        

        @media (max-width: 800px) {
        .service-options {
            grid-template-columns: 1fr; /* 1 column for small screens */
            margin-left: 50px;
        }
        }}
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

    <div class="container">
        <h1>Our Features & Services</h1>
        <div class="service-options">
            <div class="service-option" data-service="Facebook Ads">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlSWRYWxFfY9bUHF9z0qltJqQlOlbZbbuKMg&s" alt="Facebook Ads">
                <h3>Facebook Ads</h3>
                <p>Create effective ads to reach your audience on Facebook.</p>
                <button class="add-btn">Add</button>
            </div>
            <div class="service-option" data-service="Instagram Ads">
                <img src="https://media.licdn.com/dms/image/D5612AQES9FHO0nAc0g/article-cover_image-shrink_720_1280/0/1692123667037?e=2147483647&v=beta&t=M4gcfqiST1NieM0rPSAoGFqzM--Tk8FPa8vma6_uotE" alt="Instagram Ads">
                <h3>Instagram Ads</h3>
                <p>Engage your Instagram followers with captivating ads.</p>
                <button class="add-btn">Add</button><br>
            </div>
            <div class="service-option" data-service="SEO Optimization">
                <img src="https://oneclickwi.com/wp-content/uploads/2023/10/Depositphotos_36633383_L-1030x729.jpg" alt="SEO Optimization">
                <h3>SEO Optimization</h3>
                <p>Improve your website's ranking on search engines.</p>
                <button class="add-btn">Add</button>
            </div>
            <div class="service-option" data-service="Email Marketing">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6G29y19jAKc8hIU-d6KyE052fBvwbK-nDtQ&s" alt="Email Marketing">
                <h3>Email Marketing</h3>
                <p>Reach your customers directly through email campaigns.</p>
                <button class="add-btn">Add</button>
            </div>
        </div>
        <div class="selected-services">
            <h2>Selected Services</h2>
            <ul id="selected-services-list">
                <!-- Selected services will be added here -->
            </ul>
        </div>
    </div>
<script>
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
</script>
    <script>
       document.addEventListener('DOMContentLoaded', () => {
    const serviceOptions = document.querySelectorAll('.service-option');
    const selectedServicesList = document.getElementById('selected-services-list');

    serviceOptions.forEach(option => {
        option.querySelector('.add-btn').addEventListener('click', () => {
            const serviceName = option.getAttribute('data-service');

            if (![...selectedServicesList.children].some(li => li.textContent.includes(serviceName))) {
                const listItem = document.createElement('li');
                listItem.textContent = serviceName;

                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'x';
                removeBtn.classList.add('remove-btn');
                removeBtn.addEventListener('click', () => {
                    listItem.remove();
                });

                listItem.appendChild(removeBtn);
                selectedServicesList.appendChild(listItem);

                // Send the service to the server
                fetch('add_services.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        'service_name': serviceName,
                    }),
                })
                .then(response => response.text())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
            }
        });
    });
});

    </script>
    <script>
        const services = ["Facebook Ads", "Instagram Ads", "SEO Opimization", "Email Marketing"];
        const serviceContainer = document.querySelector('.service-options');
        const template = document.getElementById('service-template').content;

        // Generate service options from the template
        services.forEach(service => {
            const clone = document.importNode(template, true);
            clone.querySelector('.service-name').textContent = service;
            clone.querySelector('.service-option').setAttribute('data-service', service);
            serviceContainer.appendChild(clone);
        });

        // Event listener for selecting services
        serviceContainer.addEventListener('click', function(event) {
            if (event.target.closest('.service-option')) {
                const serviceName = event.target.closest('.service-option').getAttribute('data-service');
                const list = document.getElementById('selected-services-list');

                // Add the service to the list if not already added
                if (![...list.children].some(li => li.textContent.includes(serviceName))) {
                    const listItem = document.createElement('li');
                    listItem.textContent = serviceName;

                    // Send service to the server for saving
                    fetch('add_services.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'service_name': serviceName,
                        }),
                    })
                    .then(response => response.text())
                    .then(data => console.log(data))
                    .catch(error => console.error('Error:', error));

                    list.appendChild(listItem);
                }
            }
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
        const services = ["Facebook Ads", "Instagram Ads", "SEO Opimization", "Email Marketing"];
        const serviceContainer = document.querySelector('.service-options');
        const template = document.getElementById('service-template').content;

        // Generate service options from the template
        services.forEach(service => {
            const clone = document.importNode(template, true);
            clone.querySelector('.service-name').textContent = service;
            clone.querySelector('.service-option').setAttribute('data-service', service);
            serviceContainer.appendChild(clone);
        });

        // Event listener for selecting services
        serviceContainer.addEventListener('click', function(event) {
            if (event.target.closest('.service-option')) {
                const serviceName = event.target.closest('.service-option').getAttribute('data-service');
                const list = document.getElementById('selected-services-list');

                // Add the service to the list if not already added
                if (![...list.children].some(li => li.textContent.includes(serviceName))) {
                    const listItem = document.createElement('li');
                    listItem.textContent = serviceName;

                    // Send service to the server for saving
                    fetch('add_services.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'service_name': serviceName,
                        }),
                    })
                    .then(response => response.text())
                    .then(data => console.log(data))
                    .catch(error => console.error('Error:', error));

                    list.appendChild(listItem);
                }
            }
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
        document.querySelectorAll('.service-option').forEach(option => {
            option.addEventListener('click', function() {
                const serviceName = this.getAttribute('data-service');
                const form = document.getElementById('add-service-form');
                const input = document.getElementById('service_name_input');
                
                // Set the service name in the hidden input
                input.value = serviceName;
                
                // Submit the form to add the service
                form.submit();
            });
        });
        const services = ["Facebook Ads", "Instagram Ads", "SEO Opimization", "Email Marketing"];
        const serviceContainer = document.querySelector('.service-options');
        const template = document.getElementById('service-template').content;

        // Generate service options from the template
        services.forEach(service => {
            const clone = document.importNode(template, true);
            clone.querySelector('.service-name').textContent = service;
            clone.querySelector('.service-option').setAttribute('data-service', service);
            serviceContainer.appendChild(clone);
        });

        // Event listener for selecting services
        serviceContainer.addEventListener('click', function(event) {
            if (event.target.closest('.service-option')) {
                const serviceName = event.target.closest('.service-option').getAttribute('data-service');
                const list = document.getElementById('selected-services-list');

                // Add the service to the list if not already added
                if (![...list.children].some(li => li.textContent.includes(serviceName))) {
                    const listItem = document.createElement('li');
                    listItem.textContent = serviceName;

                    // Send service to the server for saving
                    fetch('add_services.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'service_name': serviceName,
                        }),
                    })
                    .then(response => response.text())
                    .then(data => console.log(data))
                    .catch(error => console.error('Error:', error));

                    list.appendChild(listItem);
                }
            }
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
</body>
</html>