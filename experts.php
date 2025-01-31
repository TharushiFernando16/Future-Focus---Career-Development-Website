<?php 
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) { 
    header('Location: login.php'); 
    exit(); 
}

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

// Include necessary files
include './includes/header.php';
include './includes/topbar.php';
include './includes/sidebar.php';
include './includes/connection.php';
?>

<style>
.user-list {
    width: 80%;
    margin: 50px auto;
    background-color: #fdf1f3;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.user-list h2 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: left;
    color: #6c2c42;
}

.user-list ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.user-list ul li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #d5a0a0;
}

.user-list ul li:last-child {
    border-bottom: none;
}

.user-name {
    display: flex;
    align-items: center;
    font-size: 18px;
    color: #4e1f42;
}

.user-name i {
    margin-right: 10px;
    color: #4e1f42;
}

.user-actions i {
    margin-left: 15px;
    cursor: pointer;
    color: #4e1f42;
}

.user-actions i:hover {
    color: #fff;
    background-color: #000;
    padding: 5px 10px;
}
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1 style="color: #4e1f42;">Experts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Experts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="user-list">
        <ul>
            <?php
            include 'connection.php';

            $isLoggedIn = isset($_SESSION['email']);
            $user_email = $isLoggedIn ? $_SESSION['email'] : '';

            if ($isLoggedIn) {
                $loggedUser = $user_email;

                // Updated query to join experts and users based on email
                $query = "
                    SELECT e.name, u.unique_id
                    FROM experts e
                    JOIN users u ON e.email = u.email
                    WHERE u.email != ?
                ";
                $stmt = $con->prepare($query);
                $stmt->bind_param("s", $loggedUser);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $name = htmlspecialchars($row['name']);
                        $unique_id = htmlspecialchars($row['unique_id']);

                        echo '<li>';
                        echo '<span class="user-name"><i class="fas fa-user"></i>'. $name .'</span>';
                        echo '<span class="user-actions">';
                        echo '<a href="chat_UI.php?id=' . urlencode($unique_id) . '"><i class="fas fa-comments"></i></a>';
                        echo '<a href="userprofile.php?email=<?php echo $email; ?>"><i class="fas fa-info-circle"></i></a>';
                        echo '<span>';
                        echo '</li>';
                    }
                } else {
                    echo "No experts found.";
                }

                $stmt->close();
            } else {
                echo "User is not logged in.";
            }

            $con->close();
            ?>
        </ul>
    </div>
</main><!-- End #main -->

<?php
include './includes/footer.php';
include './includes/script.php';
?>
</body>
</html>
