<?php 
session_start();
include_once "connection.php";

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if the user has a 'Premium user' subscription
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

// Ensure the email is set in the session
$isLoggedIn = isset($_SESSION['email']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';

if ($isLoggedIn && !empty($user_email)) {
    // Fetch user details using the email from the session
    $selectSql = "SELECT `id`, `status` FROM `users` WHERE `email` = ?";
    $stmt = $con->prepare($selectSql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        $status = htmlspecialchars($rows['status']); // Fetching status
    } else {
        $status = 'User not found';
    }

    $stmt->close();
} else {
    $status = 'User email not found';
}

$con->close();
?>

<!-- HTML output -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Status</title>
</head>
<body>
    <div>
        <h1>User Status</h1>
        <p>Status: <?php echo $status; ?></p>
    </div>
</body>
</html>
