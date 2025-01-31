<!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <i class="fa fa-rocket m-0" aria-hidden="true" style="color: #4e1f42; font-size: 30px;"></i>
            <span class="d-none d-lg-block" style="color: #4e1f42; font-size: 30px;">FutureFocus</span>
        </a>

        <i class="bi bi-list toggle-sidebar-btn" style="color: #4e1f42;"></i>
        </div><!-- End Logo -->


        <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">

            <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell" style="color: #4e1f42;"></i>
                <span class="badge badge-number" style="background-color: #4e1f42;">4</span>
            </a>End Notification Icon -->

            <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                You have 4 new notifications
                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <h4>Lorem Ipsum</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>30 min. ago</p>
                </div>
                </li>

                <li>
                <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                <i class="bi bi-x-circle text-danger"></i>
                <div>
                    <h4>Atque rerum nesciunt</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>1 hr. ago</p>
                </div>
                </li>

                <li>
                <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                <i class="bi bi-check-circle text-success"></i>
                <div>
                    <h4>Sit rerum fuga</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>2 hrs. ago</p>
                </div>
                </li>

                <li>
                <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                <i class="bi bi-info-circle text-primary"></i>
                <div>
                    <h4>Dicta reprehenderit</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>4 hrs. ago</p>
                </div>
                </li>

                <li>
                <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                <a href="#">Show all notifications</a>
                </li>

            </ul>End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

        

            <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                
                <?php 
                // Check if the user is logged in
                $isLoggedIn = isset($_SESSION['email']);
                $user_email = $isLoggedIn ? $_SESSION['email'] : '';

                if($isLoggedIn){

                    include 'includes/connection.php';
                    

                    // Prepare and execute the SQL query to fetch the image path
                    $stmt = $con->prepare("SELECT img FROM users WHERE email = ?");
                    $stmt->bind_param("s", $user_email);
                    $stmt->execute();
                    $stmt->bind_result($img_path);
                    $stmt->fetch();
                    $stmt->close();
                    $con->close();

                    // Check if the image path was fetched
                    if($img_path) {
                        // Display the image
                        echo '<img src="' . htmlspecialchars($img_path, ENT_QUOTES, 'UTF-8') . '" alt="Profile Image" class="rounded-circle" style="border: 2px solid #592c42; object-fit: cover;" />';
                    } else {
                        echo '<i class="fas fa-user" style="color: #4e1f42;"></i>';
                    }
                } else {
                    echo '<i class="fa fa-user" style="color: #4e1f42; font-size: 20px;"></i>';
                }
                ?>

                
                <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #4e1f42;">
                    <?php 

                        $isLoggedIn = isset($_SESSION['email']);
                        $user_email = $isLoggedIn ? $_SESSION['email'] : '';

                        if($isLoggedIn){
                            echo htmlspecialchars($user_email, ENT_QUOTES, 'UTF-8');
                        } else {
                            echo "Not Logged In";
                        }
                    ?>
                </span>
            </a><!-- End Profile Image Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6>
                    <?php

                    $isLoggedIn = isset($_SESSION['unique_id']);
                    $user_name = '';

                    if ($isLoggedIn) {
                        $unique_id = $_SESSION['unique_id'];

                        include 'connection.php';

                        // Prepare and execute query to fetch user information
                        $stmt = $con->prepare("SELECT username FROM users WHERE unique_id = ?");
                        $stmt->bind_param("s", $unique_id);
                        $stmt->execute();
                        $stmt->bind_result($username);
                        if ($stmt->fetch()) {
                            $user_name = $username;
                        }
                        $stmt->close();
                        $con->close();
                    }

                    // Display the username or a "Not Logged In" message
                    if ($isLoggedIn) {
                        echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8');
                    } else {
                        echo "Not Logged In";
                    }
                    ?>

                    </h6>
                    <span><?php echo isset($designation) ? $designation : ''; ?></span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="profile.php">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="index.php">
                        <i class="bi bi-house"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="#" id="signOutLink">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                </li>
                
            </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

        </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#signOutLink').on('click', function(e) {
            e.preventDefault();
            // Make an AJAX request to signout.php
            $.ajax({
                type: 'POST',
                url: 'chatLogout.php',
                data: { signout: true },
                success: function(response) {
                    console.log('Logout successful:', response);
                    // Redirect to the login page after successful logout
                    window.location.href = 'login.php';
                },
                error: function(error) {
                    console.error('Logout error:', error);
                    // Handle errors if needed
                }
            });
        });
    });
</script>
    
