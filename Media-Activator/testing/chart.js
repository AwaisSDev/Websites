    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('activeCustomersChart').getContext('2d');
        var activeCustomersChart = new Chart(ctx, {
            type: 'bar', // Change to 'line', 'pie', etc., for different chart types
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Active Customers',
                    data: [2921, 2573, 1241, 3512, 8123, 2314, 6124], // Dummy data
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
