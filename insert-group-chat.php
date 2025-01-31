<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once "connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Initialize variables
        $group_id = mysqli_real_escape_string($con, $_POST['group_id']);
        $sender_id = $_SESSION['id'];
        $message = '';
        $is_file_uploaded = !empty($_FILES['uploadFile']['name']);

        if ($is_file_uploaded) {
            // Handle file upload
            if (is_uploaded_file($_FILES['uploadFile']['tmp_name'])) {
                $ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
                $allowed_ext = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'docx', 'doc'); 

                if (in_array($ext, $allowed_ext)) {
                    $source_path = $_FILES['uploadFile']['tmp_name'];
                    $target_path = 'uploads_files/' . time() . '_' . $_FILES['uploadFile']['name']; 

                    if (move_uploaded_file($source_path, $target_path)) {
                        $message = $target_path; // Store the file path as the message
                    } else {
                        echo json_encode(['success' => false, 'error' => "Error uploading file!"]);
                        exit();
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => "Invalid file type!"]);
                    exit();
                }
            } else {
                echo json_encode(['success' => false, 'error' => "File not uploaded correctly."]);
                exit();
            }
        } else {
            // Handle text message
            $message = mysqli_real_escape_string($con, $_POST['message']);
        }

        // Insert the message into the group_messages table
        $sql = "INSERT INTO group_messages (group_id, sender_id, msg, sent_at) VALUES ('$group_id', '$sender_id', '$message', NOW())";
        if (mysqli_query($con, $sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => "Database Error: " . mysqli_error($con)]);
        }
    }
} else {
    header("location: login.php");
    exit();
}
?>
