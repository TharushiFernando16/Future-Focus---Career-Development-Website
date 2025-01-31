<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists in database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $token = bin2hex(random_bytes(50)); // Generate a unique token
        $query = "UPDATE users SET reset_token='$token' WHERE email='$email'";
        mysqli_query($con, $query);

        // Send reset email
        $resetLink = "http://yourwebsite.com/resetpassword.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click on this link to reset your password: $resetLink";
        $headers = "From: noreply@yourwebsite.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "<script>
                    alert('Password reset link has been sent to your email.');
                    window.location.href = 'login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to send email.');
                    window.location.href = 'recoverpassword.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Email not found.');
                window.location.href = 'recoverpassword.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FutureFocus Official Website - Recover Password</title>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Recover Password</h2>
            <form action="recoverpassword.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <input type="submit" value="Send Reset Link" class="button">
            </form>
        </div>
    </div>
</body>
</html>
