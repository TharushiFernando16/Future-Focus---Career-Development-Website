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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="free-educational-responsive-web-template-webEdu">
	<meta name="author" content="webThemez.com">
	<title>FutureFocus Official Website - Chat</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="./assets/css/chat.css">


    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <style>


.profile-container {
            width: 100%;
            max-width: 900px;
            margin: auto;
            margin-top: 70px;
            padding: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);    
            
           
        }

        .profile-box {
            text-align: center;
        }




        .edit-icon, .close-icon {
            cursor: pointer;
        }
        .profile-icon {
    font-size: 5em; 
    color: rgb(71, 20, 41); 
    display:flex;
    justify-content: center;
}
.profile-buttons button {
            margin: 5px;
        }

        .profile-buttons {
        margin-top: 15px; 
    display: flex;
    justify-content: center;
}
.profile-buttons button {
    padding: 10px 20px;
    margin: 0 10px;
    background-color: #70034a;
    color: rgb(221, 160, 194);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em; 
    font-weight: bold; 
    transition: background-color 0.3s;
}
.profile-buttons button:hover {
    background-color: #8b0e4a;
    color: #fff;
}

        </style>
	
</head>



<body>

<?php if($isLoggedIn): ?>
  <div class="notification-bar">
  <a href="profile.php" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3">
                <span class="icon-menu h3 m-0 p-0 mt-2"><i class="fa fa-user" aria-hidden="true"></i></span>
            </a>
            <?php echo htmlspecialchars($user_email); ?>
        </div>
    <?php endif; ?>

<div class="window-wrapper">
    <div class="window-title">
        <div class="dots">
            <i class="fa fa-circle" aria-hidden="true"></i>
            <i class="fa fa-circle" aria-hidden="true"></i>
                <i class="fa fa-circle" aria-hidden="true"></i>
        </div>
        <div class="title">
            <span>Connect Zone</span>
        </div>
        <div class="expand">
            <i class="fa fa-expand"></i>
        </div>
    </div>
    <div class="window-area">
        <div class="conversation-list">
            <ul class="">
      

      <div class="dashboard-section">
        <h3><i class="fa fa-rocket" aria-hidden="true"></i>FutureFocus</h3>
        
        <ul class="">
        <li class="item" onclick="showSection('Mecontent')"><a href="#"><i class="fa fa-user"></i><span>Me</span></a></li>
        <li class="item" onclick="showSection('Chatscontent')"><a href="#"><i class="fa fa-comments"></i><span>Chats</span></a></li>
            <li class="item" onclick="showSection('Channelscontent')" ><a href="#"><i class="fa fa-list-alt"></i><span>Channels</span></a></li>
            <li class="item" onclick="showSection('Threadscontent')" ><a href="#"><i class="fa fa-indent"></i><span>Threads</span></a></li>
            <li class="item" onclick="showSection('Groupscontent')"><a href="#"><i class="fa fa-users"></i><span>Groups</span></a></li>
            <li class="item" onclick="showSection('Userscontent')"><a href="#"><i class="fa fa-user"></i><span>Users</span></a></li>
            <li class="item" onclick="showSection('Expertscontent')"><a href="#"><i class="fa fa-trophy"></i><span>Experts</span></a></li>
            <li class="item" onclick="showSection('Notificationscontent')"><a href="#"><i class="fa fa-bell"></i><span>Notifications</span></a></li>
            <li class="item" onclick="showSection('Settingscontent')"><a href="#"><i class="fa fa-cog"></i><span>Settings</span></a></li>
        </ul>
        

        
        
    </div>


                
           
          
        </div>
        
        <div id="Mecontent" class="section" >

            <div class="chat-area" style="background-color:rgb(247, 233, 240);">
        
        <div class="profile-container">
        <div class="profile-box">
       

        <div class="profile-icon">
            <i class="fa fa-user"></i>
        </div>
        <h2><?php echo htmlspecialchars($user_email); ?></h2>
        <div class="profile-name">
            
        </div>
                    <p>Channels</p>
                    <p>Groups</p>
                    <p>Notifications</p>
                    <div class="profile-buttons">
        
    <button onclick="window.location.href = 'profile.php';" class="back-button">Profile</button>
    </div>        
                </div>
        </div>
            </div>

        </div>


        <div id="Userscontent" class="section">

        <div class="chat-area">
            


        <ul class="membermain-list">
        <h2>Users</h2>

        <?php
include 'connection.php';


$isLoggedIn = isset($_SESSION['email']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';

if ($isLoggedIn) {
    $loggedUser = $user_email; 

    $sql = "SELECT username FROM users WHERE loginType = 'Premium user' AND email != ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $loggedUser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $username = htmlspecialchars($row["username"]);
            echo '<li>';
            echo '  <div class="user-info">';
            echo '    <span class="status online"><i class="fa fa-user"></i></span>';
            echo '    <span>' .  $username  . '</span>';
            echo '  </div>';
            echo '  <div class="user-options">';
           echo '<button class="msg-btn" onclick="showSection(\'Chatscontent\')"><i class="fa fa-comments"></i></button>';

            echo '    <button class="pin-btn"><i class="fa fa-heart"></i></button>';
            echo '    <button class="pin-btn"><i class="fa fa-info-circle"></i></button>';
            echo '  </div>';
            echo '</li>';
        }
    } else {
        echo "No premium users found.";
    }

    $stmt->close();
} else {
    echo "User is not logged in.";
}

$con->close();
?>



    </ul>



                    
               
        </div>

        </div>

        <div id="Expertscontent" class="section">

<div class="chat-area">
    


<ul class="membermain-list">
    <h2>Experts</h2>
<?php
include 'connection.php';

$isLoggedIn = isset($_SESSION['email']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';

if ($isLoggedIn) {
    $loggedUser = $user_email; 

$sql = "SELECT name FROM experts WHERE email != ?";
$stmt = $con->prepare($sql);
    $stmt->bind_param("s", $loggedUser);
    $stmt->execute();
    $result = $stmt->get_result();


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<li>';
        echo '  <div  class="user-info">';
        echo '    <span class="status online"><i class="fa fa-user"></i></span>';
        echo '    <span>' . htmlspecialchars($row["name"]). '</span>'; 
        echo '  </div>';
        echo '  <div class="user-options">';
        echo '    <button class="msg-btn"><i class="fa fa-comments"></i></button>';
        echo '    <button class="pin-btn"><i class="fa fa-heart"></i></button>';
        echo '    <button class="pin-btn"><i class="fa fa-info-circle"></i></button>';

        
        echo '  </div>';
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

</div>

<div id="Chatscontent" class="section" style="display:none;">
    <div class="chat-area">
        <div class="title">
            <b id="conversationTitle"></b>
            <i class="fa fa-search"></i>
        </div>
        <div class="chat-list">
            <ul id="chat-list-ul">
                <!-- Chat messages will be inserted here -->
            </ul>
        </div>
        <div class="message-input">
            <input type="text" id="messageText" placeholder="Type your message here...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>

        <div class="right-tabs">
            <ul class="tabs">
            <li class="item"><a href="profile.php"><i class="fa fa-user"></i><span></span></a></li>
            <li class="item"  ><a href="index.php"><i class="fa fa-home"></i><span></span></a></li>
            <li class="item"  ><a href="login.php"><i class="fa fa-sign-out"></i><span></span></a></li>
            </ul>
            <ul class="tabs-container">
                <li class="active">

               



<?php
include 'connection.php';


$isLoggedIn = isset($_SESSION['email']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';

if ($isLoggedIn) {
    $loggedUser = $user_email; 

    $sql = "SELECT username FROM users WHERE loginType = 'Premium user' AND email != ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $loggedUser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<ul class="member-list">';
        while($row = $result->fetch_assoc()) {
            echo '<li><span class="status online"><i class="fa fa-user"></i></span><span>' . $row["username"] . '</span></li>';
        }
        echo '</ul>';
    } else {
        echo "No premium users found.";
    }

    $stmt->close();
} else {
    echo "User is not logged in.";
}

$con->close();
?>

                </li>
                <li></li>
                <li></li>
            </ul>
            
        </div>



        <div id="Channelscontent" class="section">
<div class="chat-area">
<ul class="membermain-list">
    <h2>Channels</h2>
    <li>
        <div class="user-info">
            <span class="status online"><i class="fa fa-user">React Native Enthuisms</i></span>
            <span></span>
        </div>
        <div class="user-options">
            <button class="msg-btn"><i class="fa fa-comments"></i></button>
            <button class="pin-btn"><i class="fa fa-heart"></i></button>
            <button class="pin-btn"><i class="fa fa-info-circle"></i></button>
        </div>
    </li>
   
</ul>
</div>
</div>


<!-- dddddddddddd -->


<div id="Threadscontent" class="section">
<div class="chat-area">
<ul class="membermain-list">
    <h2>Threads</h2>
    <li>
        <div class="user-info">
            <span class="status online"><i class="fa fa-user"></i></span>
            <span></span>
        </div>
        <div class="user-options">
            <button class="msg-btn"><i class="fa fa-comments"></i></button>
            <button class="pin-btn"><i class="fa fa-heart"></i></button>
            <button class="pin-btn"><i class="fa fa-info-circle"></i></button>
        </div>
    </li>
   
</ul>
</div>
</div>


<!-- dddddddddddd -->

 

<div id="Groupscontent" class="section">
<div class="chat-area">
<ul class="membermain-list">
    <h2>Groups</h2>
    <li>
        <div class="user-info">
            <span class="status online"><i class="fa fa-user">Leadership Development</i></span>
            <span></span>
        </div>
        <div class="user-options">
            <button class="msg-btn"><i class="fa fa-comments"></i></button>
            <button class="pin-btn"><i class="fa fa-heart"></i></button>
            <button class="pin-btn"><i class="fa fa-info-circle"></i></button>
        </div>
    </li>
   
</ul>
</div>
</div>



        <div id="Settingscontent" class="section">

<div class="chat-area">
    
<ul class="membermain-list">
    <h2>Settings</h2>
    <li>
        <div class="user-info">
            <span class="status online"><i class="fa fa-user"></i></span>
            <span></span>
        </div>
        <div class="user-options">
            <button class="msg-btn"><i class="fa fa-comments"></i></button>
            <button class="pin-btn"><i class="fa fa-heart"></i></button>
            <button class="pin-btn"><i class="fa fa-info-circle"></i></button>
        </div>
    </li>
   
</ul>

</div>

</div>



    </div>

    

</div>




<script src="assets/js/chat.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.section');
        sections.forEach(section => {
            section.style.display = 'none';
        });

        const selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.style.display = 'block';
        }
    }

    function createConversation(username) {
        document.getElementById('conversationTitle').innerText = 'Conversation with ' + username;
        const chatList = document.getElementById('chat-list-ul');
        chatList.innerHTML = ''; // Clear any existing messages
    }

    function sendMessage() {
        const chatList = document.getElementById('chat-list-ul');
        const messageText = document.getElementById('messageText').value;
        if (messageText.trim() !== '') {
            const newMessage = document.createElement('li');
            newMessage.innerHTML = `
                <div class="message">
                    <p>${messageText}</p>
                    <span class="msg-time">${new Date().toLocaleTimeString()}</span>
                </div>`;
            chatList.appendChild(newMessage);
            document.getElementById('messageText').value = ''; // Clear the input field
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        showSection('Chatscontent');
    });
</script>



</body>
</html>