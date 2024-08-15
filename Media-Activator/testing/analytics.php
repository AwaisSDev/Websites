<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Page</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body.dark {
    background-color: #18191a; /* Dark background for body */
    color: white !important; /* Light text color for body */
}

body.dark .container {
    background-color:#18191a; /* Dark background for container */
    color: black !important; /* Light text color for container */
}

h1{
    color:white !important;
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
    color:  !important;  /* Light text color for mode toggle text */
}
body.dark .block {
    border:none;
    background: #3a3b3c; /* Dark background for selected services list items */
    color: black !important;  /* Light text color for list items */
}
body.dark .text1{
    color:black;
}
body.dark .big-block{
    border:none;
    background: #3a3b3c; /* Dark background for selected services list items */
    color: black !important;  /* Light text color for list items */
}
body.dark .box{
    box-shadow:2px 2px 10px black;
    border:none;
    background: #3a3b3c; /* Dark background for selected services list items */
    color: black !important;  /* Light text color for list items */
}
body.dark .summary-item{
    background-color:#3a3b3c;
    color:white;
}
body.dark .summary-item p{
    background-color:#3a3b3c;
    color:white;
}

body.dark .graph-text {
    color: white; /* Dark mode text color */
}
                body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            padding-left:20px;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .summary {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 30px 0;
        }
        .summary-item {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            flex: 1 1 45%;
            margin: 10px;
            min-width: 300px;
        }
        .summary-item h2 {
            margin: 10px 0;
            font-size: 24px;
        }
        .chart-container {
            position: relative;
            width: 100%;
            height: 400px;
        }
        @media (max-width: 768px) {
            .summary-item {
                margin: 10px 0;
                width: 100%;
            }
        }
        .revenue-page {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
}

.box, .chart {
    flex: 1;
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.chart {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.chart canvas {
    width: 100% !important;
    height: 300px !important;
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
                        <a href="#">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Notifications</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="analytics.php">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">Analytics</a>
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
        <h1>Monthly Revenue Overview</h1>
        <div class="summary">
            <div class="summary-item">
                <h2>Total Earned This Month</h2>
                <div class="chart-container">
                    <canvas id="totalEarnedChart"></canvas>
                </div>
            </div>
            <div class="summary-item">
                <h2>User Behavior</h2>
                <div class="chart-container" style='margin-left:50px'>
                    <canvas id="userBehaviorChart"></canvas>
                </div>
            </div>
            <div class="summary-item" >
        <h2>Total Sales</h2>
        <canvas id="chart1" width='200px' style="width:200px; height:40px;" ></canvas>
    </div>

</div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Total Earned This Month Chart
            var ctx1 = document.getElementById('totalEarnedChart').getContext('2d');
            var totalEarnedChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [{
                        label: 'Total Earned (in USD)',
                        data: [3000, 4000, 5000, 6000],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Revenue (in USD)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: ''
                                
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += `$${context.parsed.y.toLocaleString()}`;
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // User Behavior Chart
            var ctx2 = document.getElementById('userBehaviorChart').getContext('2d');
            var userBehaviorChart = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Just Visited', 'Added to Cart', 'Made a Purchase'],
                    datasets: [{
                        data: [300, 150, 50],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += `${context.raw.toLocaleString()}`;
                                    return label;
                                }
                            }
                        }
                    }
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

   updateGraphStyles();

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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('chart1').getContext('2d');
    new Chart(ctx1, {
        type: 'bar', // Bar chart
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Sales',
                data: [2140, 5152, 1195, 12663, 2201],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx2 = document.getElementById('chart2').getContext('2d');
    new Chart(ctx2, {
        type: 'line', // Line chart
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Revenue',
                data: [5, 15, 25, 35, 45],
                fill: false,
                borderColor: 'rgba(153, 102, 255, 1)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx3 = document.getElementById('chart3').getContext('2d');
    new Chart(ctx3, {
        type: 'pie', // Pie chart
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
            datasets: [{
                label: 'Product Share',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing Chart.js code...

        // Area Chart
        var ctxArea = document.getElementById('areaChart').getContext('2d');
        new Chart(ctxArea, {
            type: 'line', // Use 'line' chart type for area chart
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Monthly Revenue',
                    data: [15, 25, 35, 45, 55],
                    fill: true, // Enable area fill
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Light color for the fill
                    borderColor: 'rgba(153, 102, 255, 0)', // Hide the line by making its color transparent
                    borderWidth: 0, // No border
                    pointRadius: 0 // No points
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += `${context.raw.toLocaleString()}`;
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

</script>
</body>
</html>
