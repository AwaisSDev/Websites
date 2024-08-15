<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $period = $_POST['period'];
    $timezone = $_POST['timezone'];
    $date = $_POST['date'];

    $time = sprintf("%02d:%02d %s %s", $hours, $minutes, $period, $timezone);
    $time = sprintf("%02d:%02d %s %s", $hours, $minutes, $period, $timezone);

    // Save data to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "digital_fixer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Avoid SQL injection by using prepared statements
    $stmt = $conn->prepare("INSERT INTO meeting (name, email, message, time, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $message, $time, $date);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Send email using PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'awais201001@gmail.com'; // SMTP username
        $mail->Password = 'gzpw dcnk gpbr foaw'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('awais201001@gmail.com', 'Mailer');
        $mail->addAddress('awais201001@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Form Submission';
        $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message<br>Time: $time<br>Timezone: $timezone<br>Date: $date";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message\nTime: $time\nTimezone: $timezone\nDate: $date";

        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>