<?php
session_start();
include 'connection.php';

if (isset($_POST['receiver_email']) && isset($_POST['message'])) {
    $receiver_email = $_POST['receiver_email'];
    $message = $_POST['message'];

    // Get the sender's email from the session
    $sender_email = $_SESSION['email'];

    // Insert the message into the database
    $sql = "INSERT INTO messages (sender_email, receiver_email, message) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $sender_email, $receiver_email, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully.";
    } else {
        echo "Failed to send message.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$con->close();
?>
