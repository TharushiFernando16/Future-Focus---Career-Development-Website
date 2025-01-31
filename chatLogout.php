<?php
session_start();
if (isset($_SESSION['email'])) {
    include "connection.php";
    $user_email = mysqli_real_escape_string($con, $_SESSION['email']); // Get email from session

    if (isset($user_email)) {
        $status = "Offline";
        $sql = mysqli_query($con, "UPDATE users SET status = '{$status}' WHERE email='{$user_email}'");
        
        if ($sql) {
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit(); // Ensure no further code is executed after redirection
        } else {
            // Handle SQL error (optional)
            echo "Error updating status.";
        }
    } else {
        header("Location: chatIndex.php");
        exit(); // Ensure no further code is executed after redirection
    }
} else {  
    header("Location: login.php");
    exit(); // Ensure no further code is executed after redirection
}
?>
