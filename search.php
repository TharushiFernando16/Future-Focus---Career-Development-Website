<?php
session_start(); // Start the session

// Include the database connection file
include_once 'connection.php'; // Ensure this file defines $con

// Define the decryption function
function str_openssl_dec($msg, $iv) {
    $key = "1234567890vishal%$%^%$$#$#"; // Replace with your actual encryption key
    $cipher = "AES-128-CTR";
    $options = 0;
    return openssl_decrypt($msg, $cipher, $key, $options, $iv);
}

// Check if the session variable is set
if (!isset($_SESSION['unique_id'])) {
    die("User not logged in.");
}

$outgoing_id = $_SESSION['unique_id']; // Retrieve from session

// Check if the user is a Premium user
if ($_SESSION['loginType'] !== 'Premium user') {
    echo "<script>
            if (confirm('You have to subscribe to our premium services to access this page. Would you like to subscribe now?')) {
                window.location.href = 'upgrade.php'; 
            } else {
                window.location.href = 'index.php'; 
            }
        </script>";
    exit();
}

// Search term processing
$searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm'] ?? '');

// Query to select only premium users who are allowed to chat, excluding the logged-in user
$sql = "SELECT * FROM users WHERE loginType = 'Premium user' AND unique_id != {$outgoing_id} AND username LIKE '%{$searchTerm}%'";
$query = mysqli_query($con, $sql);

// Check if the query was successful
if (!$query) {
    die("Query failed: " . mysqli_error($con)); // Handle the error appropriately
}

// Initialize $output to store user list items
$output = "";

while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($con, $sql2);

    if ($query2 && mysqli_num_rows($query2) > 0) {
        $row2 = mysqli_fetch_assoc($query2);
        $result = $row2['msg'];
        $v = $row2["iv"];
        $iv = hex2bin($v);
        $mess = str_openssl_dec($result, $iv);  // Decrypt the message using the function
    } else {
        $mess = "No message available";
    }

    if (strlen($mess) > 22) {
        $mess = substr($mess, 0, 22) . '...';
    }

    $you = isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id'] ? "You: " : "";

    $offline = $row['status'] == "Offline" ? "offline" : "";

    $hid_me = ($outgoing_id == $row['unique_id']) ? "hide" : "";

    $output .= '<a href="chat_UI.php?id=' . $row['unique_id'] . '" class="user-list-item ' . $offline . '" style="padding-bottom: 10px; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; display: flex; align-items: center; flex-wrap: wrap; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; color: #fff !important;">
                                <div class="content ' . $hid_me . '" style="display: flex; align-items: center;">
                                    <img src="' . htmlspecialchars($row['img']) .'" class="user-img" style="height: 45px; width: 45px;">
                                    <div class="details" style="color: #fff; margin-left: 20px;">
                                        <span style="font-size: 18px; font-weight: 500;">' . htmlspecialchars($row['username']) . '</span>
                                        <p>' . $you . htmlspecialchars($mess) . '</p>
                                    </div>
                                </div>
                                <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                            </a>';
}

echo $output;
?>
