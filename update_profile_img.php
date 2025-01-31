<?php
session_start();
include './includes/connection.php'; // Ensure this file connects to your database

$response = ['success' => false, 'message' => ''];

if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
    // Get the user email from session
    $user_email = $_SESSION['email'];

    // Define the directory to store the image
    $uploadDir = 'profile_images/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Define the file path
    $fileName = basename($_FILES['profileImage']['name']);
    $targetFilePath = $uploadDir . $user_email . '_' . $fileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetFilePath)) {
        // Update the img column in the database
        $stmt = $con->prepare("UPDATE users SET img = ? WHERE email = ?");
        
        if ($stmt === false) {
            $response['message'] = 'Failed to prepare the statement: ' . htmlspecialchars($conn->error);
        } else {
            $stmt->bind_param("ss", $targetFilePath, $user_email);
            
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response['success'] = true;
                    $response['message'] = 'Profile image updated successfully!';
                    $response['imagePath'] = $targetFilePath;
                } else {
                    $response['message'] = 'No rows were affected. Check if the email exists.';
                }
            } else {
                $response['message'] = 'Failed to execute the statement: ' . htmlspecialchars($stmt->error);
            }
            
            $stmt->close();
        }
    } else {
        $response['message'] = 'Failed to upload the image.';
    }
} else {
    $response['message'] = 'No image was uploaded or there was an upload error.';
}

echo json_encode($response);
