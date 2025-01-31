<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: profile.php");
    exit;
}

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$email = $_SESSION['email']; 

$user_type = ''; 
$table_name = ''; 
$name_field = ''; 


$sql = "SELECT 'user' as type FROM users WHERE email = ?
        UNION 
        SELECT 'expert' as type FROM experts WHERE email = ?";
$stmt = $con->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $stmt->bind_result($user_type);
    $stmt->fetch();
    $stmt->close();

    if ($user_type == 'user') {
        $table_name = 'users';
        $name_field = 'username';
    } elseif ($user_type == 'expert') {
        $table_name = 'experts';
        $name_field = 'name';
    }
} else {
    die("Error preparing statement: " . $con->error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_username'])) {
        $new_username = trim($_POST['new_username']);

        if (!empty($new_username)) {
            $update_sql = "UPDATE $table_name SET $name_field = ? WHERE email = ?";
            $update_stmt = $con->prepare($update_sql);

            if ($update_stmt) {
                $update_stmt->bind_param("ss", $new_username, $email);

                if ($update_stmt->execute()) {
                    echo "<script>alert('Name updated successfully!');</script>";
                } else {
                    echo "<script>alert('Error updating name!');</script>";
                }

                $update_stmt->close();
            } else {
                echo "<script>alert('Error preparing statement:');</script>";
            }
        } else {
            echo "<script>alert('Name cannot be empty!');</script>";
        }
    } elseif (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $current_password = trim($_POST['current_password']);
        $new_password = trim($_POST['new_password']);
        $confirm_password = trim($_POST['confirm_password']);

        if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
            $sql = "SELECT password FROM $table_name WHERE email = ?";
            $stmt = $con->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                if (password_verify($current_password, $hashed_password)) {
                    if ($new_password === $confirm_password) {
                        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $update_sql = "UPDATE $table_name SET password = ? WHERE email = ?";
                        $update_stmt = $con->prepare($update_sql);

                        if ($update_stmt) {
                            $update_stmt->bind_param("ss", $hashed_new_password, $email);

                            if ($update_stmt->execute()) {
                                echo "<script>alert('Password updated successfully!');</script>";
                            } else {
                                echo "<script>alert('Error updating password!');</script>";
                            }

                            $update_stmt->close();
                        } else {
                            echo "<script>alert('Error preparing statement:');</script>";
                        }
                    } else {
                        echo "<script>alert('Passwords do not match!');</script>";
                    }
                } else {
                    echo "<script>alert('Current password is incorrect!');</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Error preparing statement:');</script>";
            }
        } else {
            echo "<script>alert('All fields are required!');</script>";
        }
    }
}

$username = ''; 
$premium_expiration = '';
$specialization = '';
$loginType = '';


if ($user_type === 'user') {
    $sql = "SELECT username, email, premium_expiration, loginType FROM users WHERE email = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($name_field, $email, $premium_expiration, $loginType);
        $stmt->fetch();
        $stmt->close();
    } else {
        die("Error preparing statement: " . $con->error);
    }
    } elseif ($user_type === 'expert') {
        $sql = "SELECT name, email, specialization FROM experts WHERE email = ?";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($name_field, $email, $specialization);
            $stmt->fetch();
            $stmt->close();
        } else {
            die("Error preparing statement: " . $con->error);
        }
    }
$con->close();

$remaining_days = '';
if (!empty($premium_expiration)) {
    $expiration_date = new DateTime($premium_expiration);
    $current_date = new DateTime();
    $interval = $current_date->diff($expiration_date);
    $remaining_days = $interval->format('%a days');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>FutureFocus Official Website - Chat Profile</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .profile-container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-box {
            text-align: center;
        }

        .edit-icon, .close-icon {
            cursor: pointer;
        }

        .edit-menu {
            display: none;
        }

        .profile-buttons button {
            margin: 5px;
        }

        
    </style>
</head>
<body>

    
<div class="profile-container">
    <div class="profile-box">
        <div class="edit-icon" onclick="toggleEditMenu()">
            <i class="fa fa-pencil"></i>
        </div>
        <div id="edit-menu" class="edit-menu">
            <div class="close-icon" onclick="closeEditMenu()">
                <i class="fa fa-times"></i>
            </div>

            <form action="profile.php" method="post">
                <div class="form-group">
                    <label for="new_username">Change Name:</label>
                    <input type="text" id="new_username" name="new_username" placeholder="Enter new name">
                </div>
                <button type="submit" class="buttonedit">Update Name</button>
            </form>

            <form action="profile.php" method="post">
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
                </div>
                <button type="submit" class="buttonedit">Reset Password</button>
            </form>
        </div>

        <div class="profile-icon">
            <i class="fa fa-user"></i>
        </div>
        <h2><?php echo $user_type === 'expert' ? 'You are an expert' : 'You are a member'; ?></h2>
        <div class="profile-name">
            
            <h2><?php  echo htmlspecialchars($name_field); ?></h2>
        </div>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>

        <?php if ($user_type === 'user' && !empty($premium_expiration)): ?>
            <p class="remdays">Premium Expiration: <?php echo htmlspecialchars($remaining_days); ?></p>
        <?php elseif ($user_type === 'user'): ?>

            <p class="remdays"><a href="upgrade.php">Upgrade to Premium</a></p>
            <?php elseif ($user_type === 'expert'): ?>
                <p class="remdays"><a href="chat.php"><?php echo htmlspecialchars($specialization); ?></a></p>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <p style="color: green;"><?php echo htmlspecialchars($success_message); ?></p>
        <?php elseif (isset($error_message)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <div class="profile-buttons">
        <?php if ($user_type === 'user' ): ?>
    <button onclick="window.location.href = 'index.php';" class="back-button">Home</button>
    <?php endif; ?>
    <?php if ($user_type === 'expert' || ($user_type === 'user' && $loginType !== 'Free user')): ?>
        <button onclick="window.location.href = 'chatIndex.php';" class="continue-button">Chat</button>
    <?php endif; ?>
    <button onclick="window.location.href = 'login.php';" class="continue-button">Logout</button>
</div>
    </div>
</div>

<script>
    function toggleEditMenu() {
        var menu = document.getElementById('edit-menu');
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }

    function closeEditMenu() {
        var menu = document.getElementById('edit-menu');
        menu.style.display = 'none';
    }
</script>
</body>
</html>
