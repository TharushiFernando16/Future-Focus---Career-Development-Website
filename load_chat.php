<?php
session_start();
include 'connection.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Fetch chat messages between the logged-in user and the selected user
    $loggedUser = $_SESSION['email'];

    // Assuming you have a `messages` table with columns `id`, `sender_email`, `receiver_email`, `message`, `created_at`
    $sql = "SELECT sender_email, receiver_email, message, created_at FROM messages WHERE (sender_email = ? AND receiver_email = ?) OR (sender_email = ? AND receiver_email = ?) ORDER BY created_at";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $loggedUser, $user_id, $user_id, $loggedUser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sender_email = htmlspecialchars($row['sender_email']);
            $receiver_email = htmlspecialchars($row['receiver_email']);
            $message = htmlspecialchars($row['message']);
            $created_at = htmlspecialchars($row['created_at']);

            echo "<div class='chat-message'>";
            echo "<strong>" . ($sender_email == $loggedUser ? "You" : $sender_email) . ":</strong> ";
            echo "<p>$message</p>";
            echo "<span class='timestamp'>$created_at</span>";
            echo "</div>";
        }
    } else {
        echo "<p>No messages found.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Invalid request.</p>";
}

$con->close();
?>
