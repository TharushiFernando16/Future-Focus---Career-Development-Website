<?php
session_start(); // Start the session

// Include the database connection file
include('connection.php'); // Ensure this file defines $con

// Check if the user is logged in and if their loginType is 'Premium user'
if (!isset($_SESSION['email']) || $_SESSION['loginType'] !== 'Premium user') {
    echo "<script>
            if (confirm('You need to be a premium user to access this page. Would you like to subscribe now?')) {
                window.location.href = 'upgrade.php'; 
            } else {
                window.location.href = 'index.php'; 
            }
        </script>";
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user details based on the email stored in the session
$email = $_SESSION['email'];
$query = "SELECT username, img, status FROM users WHERE email = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the user details
    $user = $result->fetch_assoc();
    $username = htmlspecialchars($user['username']);
    $user_img = htmlspecialchars($user['img']);
    $status = htmlspecialchars($user['status']);
} else {
    // Handle the case where user details are not found
    $username = 'Unknown';
    $user_img = 'chatImages/camera-icon.jpg'; // Default image if none exists
    $status = 'Offline';
}

$stmt->close();

// Query to fetch groups and their last message with the sender information
$sql = "
    SELECT g.group_id, g.name, g.image, 
            gm.msg AS last_message, 
            gm.sent_at AS last_message_time, 
            u.username AS sender_username, 
            u.img AS sender_image
    FROM `groups` g
    LEFT JOIN (
        SELECT group_id, msg, sent_at, sender_id
        FROM `group_messages`
        WHERE (group_id, sent_at) IN (
            SELECT group_id, MAX(sent_at)
            FROM `group_messages`
            GROUP BY group_id
        )
    ) gm ON g.group_id = gm.group_id
    LEFT JOIN `users` u ON gm.sender_id = u.id
";

// Execute the query
$query = mysqli_query($con, $sql);

// Check if the query was successful
if (!$query) {
    die("Query failed: " . mysqli_error($con)); // Handle the error appropriately
}

// Include necessary files for the page structure
include './includes/header.php';
include './includes/topbar.php';
include './includes/sidebar.php';
?>


<!-- styling for chat UI -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
* {
    box-sizing: border-box;
    text-decoration: none;
}
:root {
    --pink-color: #263238;
    --pink-dark: #263238;
}
.wrapper {
    background: #37474F;
    max-width: 750px;
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1), 0 32px 64px -48px rgba(0,0,0,0.5);
    color: #fff !important;
}
.user_wrapper {
    background: #fff;
    max-width: 700px;
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1), 0 32px 64px -48px rgba(0,0,0,0.5);
}
.users {
    padding: 25px 30px;
}
.users header {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    padding-bottom: 20px;
    border-bottom: 1px solid #e6e6e6;
    justify-content: space-between;
    color: #fff !important;
}
.wrapper img {
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid var(--pink-color);
}
.users header img {
    height: 60px;
    width: 60px;
}
:is(.users, .users-list) .content {
    display: flex;
    align-items: center;
}
:is(.users, .users-list) .content .details {
    color: #fff !important;
    margin-left: 20px;
}
:is(.users, .users-list) .details span {
    font-size: 18px;
    font-weight: 500;
}
.users header .logout {
    display: block;
    background: var(--pink-color);
    color: #fff;
    outline: none;
    border: none;
    padding: 7px 15px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 17px;
}
.users .search {
    margin: 20px 0;
    display: flex;
    position: relative;
    align-items: center;
    justify-content: space-between;
}
.users .search .text {
    font-size: 18px;
}
.users .search input {
    position: absolute;
    height: 42px;
    width: calc(100% - 50px);
    font-size: 16px;
    padding: 0 13px;
    border: 1px solid #e6e6e6;
    outline: none;
    border-radius: 5px 0 0 5px;
    opacity: 0;
    pointer-events: none;
    transition: all 0.2s ease;
}
.users .search input:focus {
    border: 1px solid var(--pink-color);
}
.users .search input.show {
    opacity: 1;
    pointer-events: auto;
}
.users .search button {
    position: relative;
    z-index: 1;
    width: 47px;
    height: 42px;
    font-size: 17px;
    cursor: pointer;
    border: none;
    background: var(--pink-dark);
    color: #fff;
    outline: none;
    border-radius: 0 5px 5px 0;
    transition: all 0.2s ease;
}
.users .search button.active {
    background: var(--pink-color);
    color: #fff;
}
.search button.active i::before {
    content: '\f00d';
}
.users-list {
    max-height: 350px;
    overflow-y: auto;
}
:is(.users-list, .chat-box)::-webkit-scrollbar {
    width: 0px;
}
.users-list a {
    padding-bottom: 10px;
    margin-bottom: 15px;
    padding-right: 15px;
    border-bottom-color: #f1f1f1;
}
.users-list a:last-child {
    margin-bottom: 0px;
    border-bottom: none;
}
.users-list a img {
    height: 45px;
    width: 45px;
}
.users-list a .details p {
    color: rgb(190, 190, 190);
}
.users-list a .status-dot {
    font-size: 12px;
    color: forestgreen;
    padding-left: 10px;
}
.users-list a .status-dot.offline {
    color: #ccc;
}

</style>

<?php
include './includes/header.php';
include './includes/topbar.php';
include './includes/sidebar.php';
?>

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

    <div class="wrapper user-wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="<?php echo $user_img; ?>" alt="<?php echo $username; ?>">
                    <div class="details">
                        <span><?php echo $username; ?></span>
                        <p><?php echo $status; ?></p>
                    </div>
                </div>
                <a href="chatLogout.php" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select a group to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list" style="max-height: 350px; overflow-y: auto;">
            <?php
                // Display groups with the last message and sender details
                while ($row = mysqli_fetch_assoc($query)) {
                    $group_image = htmlspecialchars($row['image']);
                    $group_name = htmlspecialchars($row['name']);
                    $group_id = htmlspecialchars($row['group_id']);
                    $last_message = htmlspecialchars($row['last_message']) ?: 'No messages yet';
                    $sender_username = htmlspecialchars($row['sender_username']) ?: 'Unknown';
                    $sender_image = htmlspecialchars($row['sender_image']) ?: 'default-profile.png';

                    echo '<a href="groupChat_UI.php?group_id=' . $group_id . '&user_id=' . $_SESSION['id'] . '" style="padding-bottom: 10px; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; display: flex; align-items: center; flex-wrap: wrap; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; color: #fff !important;">
                            <div class="content" style="display: flex; align-items: center;">
                            <img src="' . $group_image . '" alt="' . $group_name . '" class="users-img" style="width: 45px; height: 45px;">
                            <div class="details" style="color: #fff; margin-left: 20px;">
                                <span style="font-size: 18px; font-weight: 500;">' . $group_name . '</span>
                                <p class="font-size: 9px;">Last message: ' . $last_message . ' <br> Sent by: <img src="' . $sender_image . '" class="users-img" style="width: 30px; height: 30px;"> ' . $sender_username . '</p>
                            </div>
                            </div>
                        </a>';
                }
                ?>
            </div>
        </section>
    </div>
</main><!-- End #main -->

<?php
include './includes/footer.php';
include './includes/script.php';
?>

</body>
</html>



<script>
    const searchBar = document.querySelector(".search input"),
          searchIcon = document.querySelector(".search button"),
          usersList = document.querySelector(".users-list");

    let searchTerm = "";

    // Toggle search bar visibility
    searchIcon.onclick = () => {
        searchBar.classList.toggle("show");
        searchIcon.classList.toggle("active");
        searchBar.focus();
        if (searchBar.classList.contains("active")) {
            searchBar.value = "";
            searchBar.classList.remove("active");
        }
    };

    // Update searchTerm on input change
    searchBar.onkeyup = () => {
        searchTerm = searchBar.value;
        if (searchTerm != "") {
            searchBar.classList.add("active");
        } else {
            searchBar.classList.remove("active");
        }
    };

    // Function to fetch and update user list
    function updateUserList() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "searchGroup.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    usersList.innerHTML = data;
                }
            }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + encodeURIComponent(searchTerm));
    }

    // Set interval to update user list every 5 seconds (5000 milliseconds)
    setInterval(updateUserList, 5000);

    // Also update the user list immediately when the search term changes
    searchBar.addEventListener('input', updateUserList);

      // Reload the page every 60 seconds (60000 milliseconds)
    setInterval(() => {
        location.reload();
    }, 60000);
</script>
