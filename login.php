<?php
include 'connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Retrieve user from users table
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session
            $_SESSION['email'] = $email;
            $_SESSION['unique_id'] = $row['unique_id']; // Add unique_id to the session
            $_SESSION['username'] = $row['username']; // Add username to the session
            $_SESSION['loginType'] = $row['loginType'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['logged_in'] = true;

          
            $statusUpdate = "UPDATE users SET status='Online' WHERE email='$email'";
            mysqli_query($con, $statusUpdate);

            if ($row['loginType'] == 'Admin') {
               
                echo "<script>
                        alert('Login successful! Redirecting to admin dashboard.');
                        window.location.href = 'admindashboard.php';
                      </script>";
                exit(); 
            } else {
                
              
                  echo "<script>
                          // Show the login successful message
                          alert('Login successful!');
                
                          // Use setTimeout to delay the next dialog slightly
                          setTimeout(function() {
                            // Ask if they need to change their password
                            if (confirm('Do you need to change your password?')) {
                              // User clicked OK
                              window.location.href = 'profile.php'; // Redirect to profile page
                            } else {
                              // User clicked Cancel
                              window.location.href = 'index.php'; // Redirect to home page
                            }
                          }, 500); // Delay to ensure alert message is shown first
                        </script>";
                  exit();
                
            }
        } else {
            
            echo "<script>
                    alert('Incorrect password');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        }
    } else {
        // Check in experts table if user is not found in users table
        $query = "SELECT * FROM experts WHERE email='$email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Password is correct, start session
                $_SESSION['email'] = $email;
                $_SESSION['unique_id'] = $row['unique_id']; // Add unique_id to the session
                $_SESSION['logged_in'] = true;
                $_SESSION['expert_id'] = $row['expert_id'];
                $_SESSION['name'] = $row['name'];

                // Update expert status to 'Online'
                $statusUpdate = "UPDATE experts SET status='Online' WHERE email='$email'";
                mysqli_query($con, $statusUpdate);

                // Redirect to home page
                echo "<script>
                        alert('Login successful! Redirecting to home page.');
                        window.location.href = 'chatIndex.php';
                      </script>";
                exit();
            } else {
                // Incorrect password
                echo "<script>
                        alert('Incorrect password');
                        window.location.href = 'login.php';
                      </script>";
                exit();
            }
        } else {
            // User not found in either table
            echo "<script>
                    alert('User not found');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        }
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
  <title>FutureFocus Official Website - Login</title>
  
</head>

<body>
  <div class="login-container">
    <div class="login-box">
      <h2>Login</h2>
      <form action="login.php" method="post">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>

        <input type="submit" value="Login" class="button">
      </form>

      <p>Don't have an account? <a href='register.php'>Sign up</a></p>
      <p>Having trouble logging in? <a href='recoverpassword.php'>Recover Password</a></p>
    </div>
    <div class="other-box">
      <h2>Premium Accounts</h2>
      <p>Upgrade to a premium account for exclusive features and benefits:</p>
      <ul>
        <li>Unlimited access to premium content-chat service</li>
        <li>Priority customer support</li>
        <li>Exclusive Content Access</li>
        
      </ul>
      <p>Only LKR1999.99 per year. For more information or to upgrade, contact our sales team.</p>
    </div>
  </div>
</body>
</html>
