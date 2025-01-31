<style>
        

        .file-preview a {
            display: inline-block;
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: #000;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
        }

        .file-preview a:hover {
            background-color: #ddd;
        }

        .file-preview a[href$=".pdf"] {
            background-color: #d9534f;
            color: #fff;
        }
        
        .file-preview a[href$=".doc"], .file-preview a[href$=".docx"] {
            background-color: #5bc0de;
            color: #fff;
        }
</style>
<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once "connection.php";
    
    $outgoing_id = $_SESSION['id']; // Use session ID for outgoing messages
    $group_id = mysqli_real_escape_string($con, $_POST['group_id']); // Get group ID from POST request
    $output = "";

    $sql = "SELECT * FROM group_messages LEFT JOIN users ON users.id = group_messages.sender_id
            WHERE group_id = {$group_id}
            ORDER BY msg_id";
    $query = mysqli_query($con, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $message = htmlspecialchars($row['msg']);
            $timestamp = date('h:i A', strtotime($row['sent_at'])); // Format the timestamp
            if ($row['sender_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">';
                if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $message)) {
                    $output .= '<div class="file-preview" style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; overflow: hidden; border-radius: 10px; border: 1px solid #ddd; background-color: #f1f1f1; margin-bottom: 5px;">
                                    <img src="' . $message . '" alt="Image preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 0; border: none;">
                                </div>';
                } elseif (preg_match('/\.(pdf)$/i', $message)) {
                    $output .= '<div class="file-preview pdf-preview">
                                    <a href="' . $message . '" target="_blank">View PDF</a>
                                </div>';
                } elseif (preg_match('/\.(docx|doc)$/i', $message)) {
                    $output .= '<div class="file-preview doc-preview">
                                    <a href="' . $message . '" target="_blank">View Document</a>
                                </div>';
                } else {
                    $output .= '<p>' . $message . '</p>';
                }
                $output .= '</div>
                                <img src="' . htmlspecialchars($row['img']) . '" alt="" class="images">
                                <div class="timestamp" style="font-size:8px; color: #fff; margin-top: 5px;  text-align: right;">' . $timestamp . '</div> <!-- Timestamp added here -->
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="' . htmlspecialchars($row['img']) . '" alt="" class="images">
                                <div class="details">';
                if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $message)) {
                    $output .= '<div class="file-preview" style="display: flex; align-items: center; justify-content: center; width: 100px; height: 100px; overflow: hidden; border-radius: 10px; border: 1px solid #ddd; background-color: #f1f1f1; margin-bottom: 5px;">
                                    <img src="' . $message . '" alt="Image preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 0; border: none;">
                                </div>';
                } elseif (preg_match('/\.(pdf)$/i', $message)) {
                    $output .= '<div class="file-preview pdf-preview">
                                    <a href="' . $message . '" target="_blank">View PDF</a>
                                </div>';
                } elseif (preg_match('/\.(docx|doc)$/i', $message)) {
                    $output .= '<div class="file-preview doc-preview">
                                    <a href="' . $message . '" target="_blank">View Document</a>
                                </div>';
                } else {
                    $output .= '<p>' . $message . '</p>';
                }
                $output .= '</div>
                                <div class="timestamp" style="font-size:8px; color: #fff; margin-top: 5px;  text-align: left;">' . $timestamp . '</div> <!-- Timestamp added here -->
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


<script>
    
    $(document).ready(function() {

            // Apply styles to file links inside file preview containers
            $('.file-preview a').css({
                'display': 'inline-block',
                'padding': '10px',
                'border-radius': '10px',
                'text-decoration': 'none',
                'color': '#000',
                'background-color': '#f1f1f1',
                'border': '1px solid #ddd'
            });

            // Apply hover styles to file links
            $('.file-preview a').hover(function() {
                $(this).css('background-color', '#ddd');
            }, function() {
                $(this).css('background-color', '#f1f1f1');
            });

            // Apply specific styling for file types
            $('.file-preview a[href$=".pdf"]').css({
                'background-color': '#d9534f',
                'color': '#fff'
            });
            
            $('.file-preview a[href$=".doc"], .file-preview a[href$=".docx"]').css({
                'background-color': '#5bc0de',
                'color': '#fff'
            });
        });

</script>
