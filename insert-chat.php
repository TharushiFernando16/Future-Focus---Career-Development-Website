<?php 
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "connection.php";

    function str_openssl_enc($str, $iv) {
        $key = '1234567890vishal%$%^%$$#$#';
        $cipher = 'AES-128-CTR';
        $options = 0;
        $encrypted_str = openssl_encrypt($str, $cipher, $key, $options, $iv);
        return $encrypted_str;
    }

    // Generate a new IV and convert it to hexadecimal
    $iv = openssl_random_pseudo_bytes(16);
    $iv_hex = bin2hex($iv);

    // Retrieve user IDs and message from POST request
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];

    // Sanitize inputs
    $incoming_id = mysqli_real_escape_string($con, $incoming_id);
    $message = mysqli_real_escape_string($con, $message);

    // Encrypt the message
    $encrypted_message = str_openssl_enc($message, $iv);

    if (!empty($encrypted_message)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, iv, sent_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("iiss", $incoming_id, $outgoing_id, $encrypted_message, $iv_hex);

        if ($stmt->execute()) {
            echo "Message sent successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Message encryption failed.";
    }
} else {
    header("Location: login.php");
    exit();
}
?>
