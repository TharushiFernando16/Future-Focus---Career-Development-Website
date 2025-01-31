<?php
include 'connection.php';

if (isset($_GET['token']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_GET['token'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update user's password in the database
    $query = "UPDATE users SET password='$hashedPassword', reset_token=NULL WHERE reset_token='$token'";
    mysqli_query($con, $query);

    echo "<script>
            alert('Password has been reset successfully. Please log in.');
            window.location.href = 'login.php';
          </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/login.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FutureFocus Official Website - Reset Password</title>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Reset Password</h2>
            <form action="resetpassword.php?token=<?php echo $_GET['token']; ?>" method="post">
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" placeholder="New Password" required>
                </div>
                <input type="submit" value="Reset Password" class="button">
            </form>
        </div>
    </div>
</body>
</html>
