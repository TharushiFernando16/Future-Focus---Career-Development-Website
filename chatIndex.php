<?php
session_start(); 

include('connection.php'); 

$isLoggedIn = isset($_SESSION['email']) && isset($_SESSION['loginType']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';
$user_loginType = $isLoggedIn ? $_SESSION['loginType'] : '';


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) { 
    header('Location: login.php'); 
    exit(); 
}

function str_openssl_dec($msg, $iv) {
    $key = "1234567890vishal%$%^%$$#$#"; 
    $cipher = "AES-128-CTR";
    $options = 0;
    $decrypted_msg = openssl_decrypt($msg, $cipher, $key, $options, $iv);
    return $decrypted_msg;
}


if (!isset($_SESSION['unique_id'])) {
    echo "<script>
    if (confirm('You have to subscribe to our premium services to access this page. Would you like to subscribe now?')) {
        window.location.href = 'login.php'; 
    } else {
        window.location.href = 'index.php'; 
    }
  </script>";
exit();
}

$outgoing_id = $_SESSION['unique_id']; 


if ($_SESSION['loginType'] !== 'Premium user') {
    echo "<script>
            if (confirm('You have to subscribe to our premium services to access this page. Would you like to subscribe now?')) {
                window.location.href = 'login.php'; 
            } else {
                window.location.href = 'index.php'; 
            }
        </script>";
    exit();
}

// Search term processing
$searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm'] ?? '');

// Query to select only premium users who are allowed to chat, excluding the logged-in user
$sql = "SELECT * FROM users WHERE loginType = 'Premium user' AND unique_id != {$outgoing_id} AND username LIKE '%{$searchTerm}%'";
$query = mysqli_query($con, $sql);

// Check if the query was successful
if (!$query) {
    die("Query failed: " . mysqli_error($con)); // Handle the error appropriately
}

// Include necessary files
include './includes/header.php';
include './includes/topbar.php';
include './includes/sidebar.php';
?>
<!-- Your HTML and other PHP code continues here... -->



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
                <?php
                     //Fetch users from the database
                    include 'includes/connection.php';
                    $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                        if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                        }
                    
                    ?>
                    <img src="<?php echo htmlspecialchars($row['img']); ?>" alt="">
                    <div class="details">
                        <span><?php echo htmlspecialchars($row['username']); ?></span>
                        <p><?php echo htmlspecialchars($row['status']); ?></p>
                    </div>
                </div>
                <a href="chatLogout.php?logout_id=<?php echo htmlspecialchars($row['unique_id']); ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select a user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                <?php
                // Initialize $output to avoid undefined variable errors
                $output = "";

                // Fetch and display the users
                while ($row = mysqli_fetch_assoc($query)) {
                    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
                    $query2 = mysqli_query($con, $sql2);

                    if ($query2 && mysqli_num_rows($query2) > 0) {
                        $row2 = mysqli_fetch_assoc($query2);
                        $result = $row2['msg'];
                        $v = $row2["iv"];
                        $iv = hex2bin($v);
                        $mess = str_openssl_dec($result, $iv);  // Decrypt the message using the function
                    } else {
                        $mess = "No message available";
                    }

                    if (strlen($mess) > 22) {
                        $mess = substr($mess, 0, 22) . '...';
                    }

                    $you = isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id'] ? "You: " : "";

                    $offline = $row['status'] == "Offline" ? "offline" : "";

                    $hid_me = ($outgoing_id == $row['unique_id']) ? "hide" : "";

                    $output .= '<a href="chat_UI.php?id=' . $row['unique_id'] . '" class="user-list-item ' . $offline . '" style="padding-bottom: 10px; margin-bottom: 15px; padding-right: 15px; border-bottom-color: #f1f1f1; display: flex; align-items: center; flex-wrap: wrap; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6; justify-content: space-between; color: #fff !important;">
                                <div class="content ' . $hid_me . '" style="display: flex; align-items: center;">
                                    <img src="' . htmlspecialchars($row['img']) .'" class="user-img" style="height: 45px; width: 45px;">
                                    <div class="details" style="color: #fff; margin-left: 20px;">
                                        <span style="font-size: 18px; font-weight: 500;">' . htmlspecialchars($row['username']) . '</span>
                                        <p>' . $you . htmlspecialchars($mess) . '</p>
                                    </div>
                                </div>
                                <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                            </a>';

                }
                echo $output; 
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
    updateUserList();  // Update user list when search term changes
};

// Function to fetch and update user list
function updateUserList() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "search.php", true);
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
