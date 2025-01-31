<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "connection.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
    $output = "";
    $mess = "";

    function str_openssl_dec($str, $iv)
    {
        $key = '1234567890vishal%$%^%$$#$#';
        $chiper = "AES-128-CTR";
        $options = 0;
        $decrypted_str = openssl_decrypt($str, $chiper, $key, $options, $iv);
        return $decrypted_str;
    }

    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
            ORDER BY msg_id";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $iv = hex2bin($row['iv']);
            $mess = str_openssl_dec($row['msg'], $iv);
            $timestamp = date('h:i A', strtotime($row['sent_at'])); // Format the timestamp

            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $mess . '</p>
                                    <div class="timestamp" style="font-size:8px; color: #fff; text-align: right;">' . $timestamp . '</div>
                                </div>
                                <img src="'. htmlspecialchars($row['img']) .'" alt="">
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="'. htmlspecialchars($row['img']) .'" alt="">
                                <div class="details">
                                    <p>' . $mess . '</p>
                                    <div class="timestamp" style="font-size:8px; color: #fff; text-align: left;">' . $timestamp . '</div>
                                </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">Messages are end-to-end encrypted. No one outside of this chat can read them.<br>Your messages will appear here as you start chatting</div>';
    }
    echo $output;
} else {
    header("location: login.php");
}
?>
