<?php
session_start();
include 'connection.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Fetch email of the selected user by user_id
    $sql = "SELECT email FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $selected_user_email = $result->fetch_assoc()['email'];
    $stmt->close();

    echo $selected_user_email;
} else {
    echo "Invalid request.";
}

$con->close();
?>
