<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $darkMode = json_decode(file_get_contents('php://input'))->darkMode;
    // Assuming you have a database connection
    $userId = $_SESSION['user_id'];
    // Update the user's dark mode preference in the database
    $stmt = $pdo->prepare("UPDATE users SET dark_mode = :dark_mode WHERE id = :id");
    $stmt->execute(['dark_mode' => $darkMode, 'id' => $userId]);
}
?>
