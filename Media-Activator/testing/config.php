<?php
session_start();
include 'config.php'; // Database connection

// Check if remember me cookie exists
if (isset($_COOKIE["remember_me"])) {
    $token = $_COOKIE["remember_me"];

    // Verify the token with the database
    $sql = "SELECT username FROM users WHERE remember_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
    } else {
        // Token is invalid, clear the cookie
        setcookie("remember_me", "", time() - 3600, "/", "", true, true);
    }
}
?>
