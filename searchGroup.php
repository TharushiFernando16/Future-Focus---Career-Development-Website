<?php
session_start();
include('connection.php');

$searchTerm = isset($_POST['searchTerm']) ? mysqli_real_escape_string($con, $_POST['searchTerm']) : '';

// Query to search groups by name based on the search term
$sql = "
    SELECT g.group_id, g.name, g.image, 
            gm.msg AS last_message, 
            gm.sent_at AS last_message_time, 
            u.username AS sender_username, 
            u.img AS sender_image
    FROM `groups` g
    LEFT JOIN (
        SELECT group_id, msg, sent_at, sender_id
        FROM `group_messages`
        WHERE (group_id, sent_at) IN (
            SELECT group_id, MAX(sent_at)
            FROM `group_messages`
            GROUP BY group_id
        )
    ) gm ON g.group_id = gm.group_id
    LEFT JOIN `users` u ON gm.sender_id = u.id
    WHERE g.name LIKE '%$searchTerm%'
";

// Execute the query and handle results
$query = mysqli_query($con, $sql);

if(mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $group_image = htmlspecialchars($row['image']);
        $group_name = htmlspecialchars($row['name']);
        $group_id = htmlspecialchars($row['group_id']);
        $last_message = htmlspecialchars($row['last_message']) ?: 'No messages yet';
        $sender_username = htmlspecialchars($row['sender_username']) ?: 'Unknown';
        $sender_image = htmlspecialchars($row['sender_image']) ?: 'default-profile.png';

        echo '<a href="groupChat_UI.php?group_id=' . $group_id . '&user_id=' . $_SESSION['id'] . '" style="padding-bottom: 10px; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; display: flex; align-items: center; flex-wrap: wrap; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; color: #fff !important;">
                            <div class="content" style="display: flex; align-items: center;">
                            <img src="' . $group_image . '" alt="' . $group_name . '" class="users-img" style="width: 45px; height: 45px;">
                            <div class="details" style="color: #fff; margin-left: 20px;">
                                <span style="font-size: 18px; font-weight: 500;">' . $group_name . '</span>
                                <p class="font-size: 9px;">Last message: ' . $last_message . ' <br> Sent by: <img src="' . $sender_image . '" class="users-img" style="width: 30px; height: 30px;"> ' . $sender_username . '</p>
                            </div>
                            </div>
                        </a>';
    }
} else {
    echo '<p>No groups found.</p>';
}
?>
