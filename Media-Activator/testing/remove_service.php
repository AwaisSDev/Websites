<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST['id'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "digital_fixer";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM services WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);

    if ($stmt->execute()) {
        echo "Service removed successfully.";
    } else {
        echo "Error removing service: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
