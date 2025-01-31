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

$isLoggedIn = isset($_SESSION['email']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';

if ($isLoggedIn) {
    if (isset($_SESSION['loginType'])) {
        $user_loginType = $_SESSION['loginType'];
    } else {
        $user_loginType = 'expert';
    }
}

// Include necessary files
include './includes/header.php';
include './includes/topbar.php';
include './includes/sidebar.php';
include './includes/connection.php';

?>

<style>
    .profile-buttons {
        margin-top: 15px;
        display: flex;
        justify-content: center;
    }

    .profile-buttons button{
        padding: 10px 20px;
        margin: 0px 10px;
        background-color: #70034a;
        color: rgb(221, 160, 194);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .profile-buttons button:hover{
        background-color: #8b0e4a;
        color: #fff;
    }
</style>

<main id="main" class="main">

<div class="pagetitle">
    <h1 style="color: #4e1f42;">Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="chatIndex.php">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile d-flex justify-content-center align-items-center">
    <div class="col-xl-8">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" style="background-color: #f7e9f0;">
            <?php
                if ($isLoggedIn) {
                    // Prepare and execute the SQL query to fetch the image path
                    $stmt = $con->prepare("SELECT img FROM users WHERE email = ?");
                    $stmt->bind_param("s", $user_email);
                    $stmt->execute();
                    $stmt->bind_result($img_path);
                    $stmt->fetch();
                    $stmt->close();

                    // Check if the image path was fetched
                    if ($img_path) {
                        // Display the image
                        echo '<img src="' . htmlspecialchars($img_path, ENT_QUOTES, 'UTF-8') . '" alt="Profile Image" class="rounded-circle" style="border: 2px solid #592c42; object-fit: cover;" />';
                    } else {
                        echo '<i class="fa fa-user" style="color: #4e1f42; font-size: 50px;"></i>';
                    }

                    // Check if the user email exists in the experts table and fetch specialization and skills
                    $specialization = '';
                    $skills = '';
                    $stmt = $con->prepare("
                        SELECT e.specialization, e.skills 
                        FROM experts e 
                        INNER JOIN users u ON e.email = u.email 
                        WHERE u.email = ?
                    ");
                    $stmt->bind_param("s", $user_email);
                    $stmt->execute();
                    $stmt->bind_result($specialization, $skills);
                    $stmt->fetch();
                    $stmt->close();

                    $con->close();
                }
                ?>

            <div class="pt-2">
                <input type="file" name="profileImage" id="profileImageInput" style="display: none;" accept="image/*" onchange="previewImage(event)">
                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" id="ChooseProfileImage" style="border: 0; outline: 0;"><i class="bi bi-upload"></i></a>
                <a href="#" class="btn btn-success btn-sm" title="Save profile image" id="SaveProfileImage" style="color: #fff; border: 0; outline: 0;"><i class="bi bi-floppy"></i></a>
            </div>
            <h2 style="color: #000;"><?php echo htmlspecialchars($user_email); ?></h2>
            <?php if ($specialization || $skills): ?>
                <p style="color: #000;"><?php echo htmlspecialchars($specialization, ENT_QUOTES, 'UTF-8'); ?></p>
                <p style="color: #000;"><?php echo htmlspecialchars($skills, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php else: ?>
                <p style="color: #000;">Premium User</p>
            <?php endif; ?>

            <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div> 
            <div class="profile-buttons">
                <button onclick="window.location.href = 'profile.php';" class="back-button">Profile</button>
            </div>
        </div>
    </div>
</section>

</main><!-- End #main -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Function to handle choosing a profile image
    $('#ChooseProfileImage').click(function() {
        $('#profileImageInput').click();
    });

    $('#SaveProfileImage').click(function() {
        var profileImage = $('#profileImageInput').prop('files')[0];
        
        if (profileImage) {
            var formData = new FormData();
            formData.append('profileImage', profileImage);

            $.ajax({
                url: 'update_profile_img.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var responseData = JSON.parse(response);
                    if (responseData.success) {
                        // Update the image source attribute with the new image path
                        $('img[alt="Profile"]').attr('src', responseData.imagePath);
                        alert(responseData.message);
                    } else {
                        alert(responseData.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('An error occurred while updating the profile image. Please try again later.');
                }
            });
        } else {
            alert('Please choose an image to upload.');
        }
    });
</script>

<?php
include './includes/footer.php';
include './includes/script.php';
?>

</body>
</html>
