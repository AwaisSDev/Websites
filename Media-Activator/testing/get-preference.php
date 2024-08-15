<?php
session_start();
header('Content-Type: application/json');
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    // Fetch the user's dark mode preference from the database
    $stmt = $pdo->prepare("SELECT dark_mode FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
} else {
    echo json_encode(['darkMode' => 'disabled']);
}
?>
