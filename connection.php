<?php

$host = "localhost";
$user = "root";
$password = "";
$db_name = "future_focus";


$con = mysqli_connect($host, $user, $password, $db_name);

if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$dsn = 'mysql:host=localhost;dbname=future_focus';
try {
    $pdo = new PDO($dsn, $user, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}




?>
