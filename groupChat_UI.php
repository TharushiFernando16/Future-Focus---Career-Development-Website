<?php
session_start();
include 'connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if the user is a premium user
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

// Retrieve the logged-in user's ID
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

if (empty($user_id)) {
    echo "<script>alert('No user ID provided. Please log in.'); window.location.href = 'login.php';</script>";
    exit();
}

// Retrieve the group ID from the URL
$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : '';

if (empty($group_id)) {
    echo "<script>alert('No group ID provided.'); window.location.href = 'index.php';</script>";
    exit();
}

// Fetch the group data
$sql = "SELECT * FROM groups WHERE group_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $group = $result->fetch_assoc();
} else {
    echo "<script>alert('Group not found.'); window.location.href = 'index.php';</script>";
    exit();
}

// Include necessary files
include './includes/header.php';
include './includes/topbar.php';
include './includes/sidebar.php';
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
    box-sizing: border-box;
    text-decoration: none;

    }
    :root{
    --pink-color:#263238;
    --pink-dark:#263238;
    }

    /* body{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: var(--pink-color);
    padding: 0 10px;
    } */
    .wrapper{
    background:#37474F;
    max-width:600px;
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                0 32px 64px -48px rgba(0,0,0,0.5);
                color: #fff !important;
    }

    /* Login & Signup Form CSS Start */
    /* .form{
    padding: 25px 30px;
    }
    .form header{
    font-size: 25px;
    font-weight: 600;
    padding-bottom: 20px;
    border-bottom: 1px solid #8a8a8a;
    }
    .form form{
    margin: 20px 0;
    }
    .form form .error-text{
    color: #721c24;
    padding: 8px 10px;
    text-align: center;
    border-radius: 5px;
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    margin-bottom: 10px;
    display: none;
    }
    .form form .name-details{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    }
    .form form .name-details .field{
    width: 45%;
    } */
    /* .form .name-details .field:first-child{
    margin-right: 10px;
    }
    .form .name-details .field:last-child{
    margin-left: 10px;
    } */
    /* .form form .field{
    display: flex;
    margin-bottom: 10px;
    flex-direction: column;
    position: relative;
    }
    .form form .field label{
    margin-bottom: 2px;
    }
    .form form .input input{
    height: 40px;
    width: 100%;
    font-size: 16px;
    padding: 0 10px;
    position: relative;
    border-radius: 5px;
    border: none;
    background: transparent;
    color: #fff;
    }
    .form form .input input::placeholder{
    color: #ccc;
    }
    .form form .input::before{
    content: '';
    position: absolute;
    bottom:0px;
    left: 0;
    width: 100%;
    height: 1px;
    background:#fff;
    display: block;
    z-index: 10;
    transition: all 0.2s ease;
    }
    .form form .field input{
    outline: none;
    }
    .form form .image input{
    font-size: 17px;
    }
    .profile-image{
    display: none;
    }
    .form form .button input{
    height: 45px;
    border: none;
    color: #fff;
    font-size: 17px;
    background: var(--pink-color);
    border-radius: 5px;
    cursor: pointer;
    margin-top: 13px;
    transition: all .5s ease;
    }
    .form form .button input:hover{
    background: var(--pink-dark);
    }
    .form form .field i{
    position: absolute;
    right: 15px;
    top: 70%;
    color: #ccc;
    cursor: pointer;
    transform: translateY(-50%);
    }

    .form form .field i.active::before{
    color: var(--pink-color);
    content: "\f070";
    }
    .form .link{
    text-align: center;
    margin: 10px 0;
    font-size: 17px;
    }
    .form .link a{
    color: #eee;
    margin-left: .5rem;
    }
    .form .link a:hover{
    text-decoration: underline;
    }



 */









    /* Users List CSS Start */
    .user_wrapper{
    background:#fff;
    max-width: 700px;
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                0 32px 64px -48px rgba(0,0,0,0.5);
    }
    .users{
    padding: 25px 30px;
    
    }
    .users header,
    .users-list a{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    padding-bottom: 20px;
    border-bottom: 1px solid #e6e6e6;
    justify-content: space-between;
    color: #fff !important;
    }
    .wrapper img{
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid var(--pink-color);
    }
    .users header img{
    height: 60px;
    width: 60px;
    }
    :is(.users, .users-list) .content{
    display: flex;
    align-items: center;
    }
    :is(.users, .users-list) .content .details{
    color: #fff !important;
    margin-left: 20px;
    }
    :is(.users, .users-list) .details span{
    font-size: 18px;
    font-weight: 500;
    }
    .users header .logout{
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
    .users .search{
    margin: 20px 0;
    display: flex;
    position: relative;
    align-items: center;
    justify-content: space-between;
    }
    .users .search .text{
    font-size: 18px;
    }
    .users .search input{
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
    .users .search input:focus{
    border: 1px solid var(--pink-color);
    }
    .users .search input.show{
    opacity: 1;
    pointer-events: auto;
    }
    .users .search button{
    position: relative;
    z-index: 1;
    width: 47px;
    height: 42px;
    font-size: 17px;
    cursor: pointer;
    border: none;
    background:var(--pink-dark);
    color: #fff;
    outline: none;
    border-radius: 0 5px 5px 0;
    transition: all 0.2s ease;
    }
    .users .search button.active{
    background: var(--pink-color);
    color: #fff;
    }
    .search button.active i::before{
    content: '\f00d';
    }
    .users-list{
    max-height: 350px;
    overflow-y: auto;
    }
    :is(.users-list, .chat-box)::-webkit-scrollbar{
    width: 0px;
    }
    .users-list a{
    padding-bottom: 10px;
    margin-bottom: 15px;
    padding-right: 15px;
    border-bottom-color: #f1f1f1;
    }
    .users-list a:last-child{
    margin-bottom: 0px;
    border-bottom: none;
    }
    .users-list a img{
    height: 45px;
    width: 45px;
    }
    .users-list a .details p{
    color: rgb(190, 190, 190);
    }
    .users-list a .status-dot{
    font-size: 12px;
    color:  forestgreen;
    padding-left: 10px;
    
    }
    .users-list a .status-dot.offline{
    color: #ccc;
    }















    /* Chat Area CSS Start */
    .chating{
    background: #37474F;

        max-width: 80%;
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                    0 32px 64px -48px rgba(0,0,0,0.5);

    }
    .chat-area header{
    display: flex;
    align-items: center;
    padding: 18px 30px;
    position: relative;
    }
    .chat-area header .back-icon{
    color: #fff;
    font-size: 18px;
    }
    .chat-area header img{
    height: 45px;
    width: 45px;
    margin: 0 15px;
    }
    .chat-area header .details span{
    font-size: 17px;
    font-weight: 500;
    }
    .chat-area header .theme{
    position: absolute;
    right: 40px;
    top: 50%;
    transform: translateY(-50%);
    }
    .chat-area header .theme i{
    font-size: 25px;
    cursor: pointer;
    }
    .chat-area header .theme #night.active::before{
    content: '\f185';
    }



    .chat-box{
    position: relative;
    min-height: 380px;
    max-height: 450px;
    overflow-y: auto;
    padding: 10px 30px 20px 30px;
    background: #546E7A;
    box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
                inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
    }
    .chat-box .text{
    position: absolute;
    top: 45%;
    left: 50%;
    width: calc(100% - 50px);
    text-align: center;
    transform: translate(-50%, -50%);
    }
    .chat-box .chat{
    margin: 15px 0;
    }
    .chat-box .chat p{
    word-wrap: break-word;
    padding: 8px 16px;
    box-shadow: 0 0 45px rgb(0 0 0 / 14%),
                0rem 25px 25px -25px rgb(0 0 0 / 19%);
    }

    .chat-box .outgoing .details{
    margin-left: auto;
    max-width: calc(100% - 130px);
    }
    .outgoing .details p{
    background: var(--pink-color);
    color: #fff;
    border-radius: 18px 18px 0 18px;
    }
    .chat-box .incoming{
    display: flex;
    align-items: flex-end;
    }
    .chat-box .incoming .images{
    height: 35px;
    width: 35px;
    }
    .chat-box .outgoing .images{
    height: 35px;
    width: 35px;
    }
    .chat-box .outgoing{
    display: flex;
    align-items: flex-end;
    }
    .chat-box .incoming .details{
    margin-right: auto;
    margin-left: 10px;
    max-width: calc(100% - 130px);
    }
    .chat-box .outgoing .details{
    margin-right: auto;
    margin-right: 10px;
    max-width: calc(100% - 130px);
    }
    .incoming .details p{
    background:#fff;
    color: #333;
    border-radius: 18px 18px 18px 0;
    }
    .typing-area{
    padding: 18px 30px;
    display: flex;
    justify-content: space-between;
    }
    .typing-area input{
    height: 45px;
    width: calc(100% - 58px);
    font-size: 16px;
    padding: 0 13px;
    border: 1px solid #e6e6e6;
    outline: none;
    border-radius: 5px 0 0 5px;
    }
    .typing-area input:focus{
    border: 1px solid var(--pink-color);
    }
    .typing-area button{
    color: #fff;
    width: 55px;
    border: none;
    outline: none;
    background: var(--pink-color);
    font-size: 19px;
    cursor: pointer;
    opacity: 0.7;
    pointer-events: none;
    border-radius: 0 5px 5px 0;
    transition: all 0.3s ease;
    cursor: pointer;
    z-index: 100;
    }
    .typing-area button:hover{
    background: var(--pink-dark);
    }
    .typing-area button.active{
    opacity: 1;
    pointer-events: auto;
    }

    /* Responive media query */
    @media screen and (max-width: 550px) {
    .chat-box .outgoing .details{
        margin-left: auto;
        max-width: calc(100% - 30px);
    }
    .chat-box .incoming .details{
        margin-right: auto;
        margin-left: 10px;
        max-width: calc(100% - 30px);
    }
    .chating{
        max-width: 98%;
        width: 100%;
    }
    .wrapper {
        margin: 1rem 0;
    }
    .form, .users{
        padding: 20px;
    }
    .form header{
        text-align: center;
    }
    .form form .name-details{
        flex-direction: column;
    }
    .form form .name-details .field{
        width: 100%;
    }

    .users header img{
        height: 45px;
        width: 45px;
    }
    .users header .logout{
        padding: 6px 10px;
        font-size: 16px;
    }
    :is(.users, .users-list) .content .details{
        margin-left: 15px;
    }

    .users-list a{
        padding-right: 10px;
    }

    .chat-area header{
        padding: 15px 20px;
    }
    .chat-box{
        min-height: 400px;
        padding: 10px 15px 15px 20px;
    }
    .chat-box .chat p{
        font-size: 15px;
    }
    .chat-box .outogoing .details{
        max-width: 230px;
    }
    .chat-box .incoming .details{
        max-width: 265px;
    }
    .incoming .details img{
        height: 30px;
        width: 30px;
    }
    .chat-area form{
        padding: 20px;
    }
    .chat-area form input{
        height: 40px;
        width: calc(100% - 48px);
    }
    .chat-area form button{
        width: 45px;
    }
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

    <div class="wrapper chating">
        <section class="chat-area">
            <header>
            <a href="groupChat.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <img src="<?php echo htmlspecialchars($group['image']); ?>" alt="Image">
            <div class="details">
                <span><?php echo htmlspecialchars($group['name']); ?></span>
            </div>
            </header>
            <div class="chat-box"></div>
            <form action="#" method="post" class="typing-area" enctype="multipart/form-data">
                <input type="hidden" name="group_id" id="group_id" value="<?php echo $_GET['group_id']; ?>" >
                <label for="file-input" class="file-attach-icon">
                    <i class="fas fa-paperclip" style="font-size: 22px; margin-top: 10px; margin-right: 10px; cursor: pointer;"></i>
                </label>
                <input type="file" id="file-input" name="uploadFile" style="display: none;" accept=".jpg,.jpeg,.png,.pdf,.docx,.doc">
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off" style="border-radius: 30px;">
                <button class="sendBtn" style="margin-left: 10px;"><i class="fab fa-telegram-plane"></i></button>
            </form>

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
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".typing-area"),
          group_id = form.querySelector("#group_id").value,
          inputField = form.querySelector(".input-field"),
          fileInput = form.querySelector("#file-input"),
          sendBtn = form.querySelector("button"),
          chatBox = document.querySelector(".chat-box");

    form.onsubmit = (e) => {
        e.preventDefault();
    };

    inputField.focus();

    const toggleSendButton = () => {
        if (inputField.value !== "" || fileInput.files.length > 0) {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    };

    inputField.onkeyup = toggleSendButton;
    fileInput.onchange = toggleSendButton;

    sendBtn.onclick = () => {
        if (sendBtn.classList.contains("active")) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "insert-group-chat.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            inputField.value = "";
                            fileInput.value = ""; // Clear the file input
                            sendBtn.classList.remove("active"); // Deactivate send button
                            scrollToBottom();
                        } else {
                            alert(response.error); // Display any errors
                        }
                    } else {
                        alert("Request failed. Returned status of " + xhr.status);
                    }
                }
            };
            let formData = new FormData(form);
            xhr.send(formData);
        }
    };

    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    };

    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    };

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "get-group-chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.responseText;
                    chatBox.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                } else {
                    console.error("Request failed. Returned status of " + xhr.status);
                }
            }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("group_id=" + encodeURIComponent(group_id));
    }, 500);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
});
</script>
