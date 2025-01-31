<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $loginType = $_POST['loginType'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

    
    $unique_id =  rand(time(), 100000000); 


    
    $status = 'Online';

    if ($password != $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href = 'register.php';</script>";
        exit();
    }

   
    $query = $con->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('User already exists!'); window.location.href = 'login.php';</script>";
    } else {
        
        if ($loginType == "Premium user") {
            $cardName = $_POST['cardName'];
            $cardNumber = $_POST['cardNumber'];
            $expiryDate = $_POST['expiryDate'];
            $cvv = $_POST['cvv'];
            $amount = $_POST['amount'];

            
            $payment_status = true; 

            if ($payment_status) {
              
                $created_at = date("Y-m-d H:i:s");
                $premium_expiration = date("Y-m-d H:i:s", strtotime($created_at . ' + 1 year'));

                $insert_query = $con->prepare("INSERT INTO users (username, email, password, loginType, cardName, cardNumber, expiryDate, cvv, amount, created_at, premium_expiration, unique_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_query->bind_param("sssssssssssss", $name, $email, $hashed_password, $loginType, $cardName, $cardNumber, $expiryDate, $cvv, $amount, $created_at, $premium_expiration, $unique_id, $status);
                $insert_result = $insert_query->execute();

                if ($insert_result) {
                    echo "<script>alert('User registered successfully!'); window.location.href = 'login.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Error: " . $con->error . "'); window.location.href = 'register.php';</script>";
                }
            } else {
                echo "<script>alert('Payment failed. Please try again.'); window.location.href = 'register.php';</script>";
            }
        } else  {
            $insert_query = $con->prepare("INSERT INTO users (username, email, password, loginType, unique_id, status) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_query->bind_param("ssssss", $name, $email, $hashed_password, $loginType, $unique_id, $status);
            $insert_result = $insert_query->execute();

            if ($insert_result) {
                echo "<script>alert('User registered successfully!'); window.location.href = 'login.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error: " . $con->error . "'); window.location.href = 'register.php';</script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
<title>FutureFocus Official Website - Sign up</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./assets/css/register.css">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


</head>

<body>
  <div class="login-container">
    <h2>Sign up</h2>
    <form action='register.php' method="post">
      <div class="login-type">
        <input type="radio" id="freeuser" name="loginType" value="free user" checked>
        <label for="freeuser">Free user</label>
        <input type="radio" id="premiumuser" name="loginType" value="Premium user">
        <label for="premiumuser">Premium user</label>
      </div>
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Name" required>
      </div>

      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
      </div>

      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>

      <div>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
      </div>

      <div id="paymentFields" style="display: none;">
        
        <div>
          <label for="cardName">Card Name:</label>
          <input type="text" id="cardName" name="cardName" placeholder="Card Name">
        </div>
        <div>
          <label for="cardNumber">Card Number:</label>
          <input type="text" id="cardNumber" name="cardNumber" placeholder="Card Number">
        </div>
        <div>
          <label for="expiryDate">Expiry Date:</label>
          <div class="expiry-cvv-container">
            <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YYYY">
            <input type="text" id="cvv" name="cvv" placeholder="CVV">
          </div>
        </div>
        <div>
          <label for="amount">Amount to be deducted:</label>
          <input type="text" id="amount" name="amount" placeholder="Amount" value="LKR 1999.99" readonly>
        </div>
      </div>

      <div id="payregisterFields" style="display: none;">
        <div>
          <input type="submit" value="Pay for the registration" class="button">
        </div>
      </div>

      <div id="registerFields">
        <div>
          <input type="submit" value="Register" class="button">
        </div>
        </div>

      <p>Already Registered? <a href='login.php'>Login here</a></p>
      
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var loginTypeRadios = document.querySelectorAll('input[name="loginType"]');
      var paymentFields = document.getElementById("paymentFields");
      var payregisterFields = document.getElementById("payregisterFields");
      var registerFields = document.getElementById("registerFields");

      function handleLoginTypeChange() {
        if (this.value === "freeuser") {
          paymentFields.style.display = "none";
          payregisterFields.style.display = "none";
          registerFields.style.display = "block";
        } else if (this.value === "Premium user") {
          paymentFields.style.display = "block";
          payregisterFields.style.display = "block";
          registerFields.style.display = "none";
        }
      }

      loginTypeRadios.forEach(function(radio) {
        radio.addEventListener("change", handleLoginTypeChange);
      });

      loginTypeRadios.forEach(function(radio) {
        if (radio.checked) {
          radio.dispatchEvent(new Event("change"));
        }
      });
    });
  </script>
</body>

</html>
