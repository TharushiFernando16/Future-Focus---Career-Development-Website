
<?php

session_start();

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
	<title>FutureFocus Official Website</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen"> 
	<link rel="stylesheet" href="./assets/css/style.css">
    <link rel='stylesheet' id='camera-css'  href='assets/css/camera.css' type='text/css' media='all'> 
    <link rel="stylesheet" href="./assets/css/main.css">

<style>
   .bg-image {
    background-size: cover; 
    background-position: center; 
    height: 75vh;
    display: flex; 
    align-items: center; 
    transition: background-image 0.2s ease-in-out;
    margin-top:5px;
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
	<!-- Fixed navbar -->
  
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0"><i class="fa fa-rocket" aria-hidden="true"></i>FutureFocus</h2>
    </a>
    
</nav>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <div class="container">
        <nav class="mx-auto site-navigation navbar-nav-container">
            <ul class="nav navbar-nav text-right main-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="reviews.php">Reviews</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Resources <i class="fa fa-caret-down"></i></a>
                  <ul class="dropdown-menu">
                      <li><a href="projects.php">Projects</a></li>
                      <li><a href="researches.php">Researches</a></li>
                      <li><a href="coursevideos.php">Course Videos</a></li>
                      <li><a href="cvtemplates.php">CV Templates</a></li>
                      <li><a href="businessmagazines.php">Business Magazines</a></li>
                  </ul>
              </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="right-cta-menu text-right d-flex align-items-center col-6">
            <div class="ml-auto">
                <a href="chatIndex.php" class="btn btn-custom border-width-2 d-none d-lg-inline-block" style="background-color: rgb(156, 50, 91) !important;">
                    <span class="mr-2 icon-add"></span>Chat</a>
                
                    <?php if($isLoggedIn): ?>
                <a href="logout.php" class="btn btn-custom border-width-2 d-none d-lg-inline-block" style="background-color: rgb(156, 50, 91) !important;">
                    <span class="mr-2 icon-lock_outline"></span>Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-custom border-width-2 d-none d-lg-inline-block" style="background-color: rgb(156, 50, 91) !important;">
                    <span class="mr-2 icon-lock_outline"></span>Login
                </a>
            <?php endif; ?>
            


            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3">
                <span class="icon-menu h3 m-0 p-0 mt-2"></span>
            </a>
        </div>
    </div>
</nav>

	

  

<section class="home-section section-hero overlay bg-image" id="home-section">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-12">
        <div class="mb-5 text-center">
          <h1 class="text-white font-weight-bold">"Success: where preparation meets opportunity, fueled by determination."</h1>
          <p>"Unlock Your Potential: Navigate Career Paths with Our Expert Consultancy Services Today!"</p>
        </div>
      </div>
    </div>
  </div>
  <div id="image-slider"></div>
</section>

<?php
  include 'connection.php';
  $sql = "SELECT COUNT(*) AS experts_count FROM experts";  
  $result = $con->query($sql);
  if ($result) { 
      $row = $result->fetch_assoc();
      $expertsCount = $row['experts_count'];  
  } else {
      
      echo "Error retrieving expert count: " . $con->error;
  }
  $con->close();
?>

<?php
  include 'connection.php';
  $sql = "SELECT COUNT(*) AS groups_count FROM groups";  
  $result = $con->query($sql);
  if ($result) { 
      $row = $result->fetch_assoc();
      $groupsCount = $row['groups_count'];  
  } else {
      
      echo "Error retrieving group count: " . $con->error;
  }
  $con->close();
?>

<?php
  include 'connection.php';
  $sql = "SELECT COUNT(*) AS users_count FROM users";  
  $result = $con->query($sql);
  if ($result) { 
      $row = $result->fetch_assoc();
      $usersCount = $row['users_count'];  
  } else {
      
      echo "Error retrieving user count: " . $con->error;
  }
  $con->close();
?>

<?php
  include 'connection.php';
  $sql = "SELECT COUNT(*) AS blogs_count FROM blogs";  
  $result = $con->query($sql);
  if ($result) { 
      $row = $result->fetch_assoc();
      $blogsCount = $row['blogs_count'];  
  } else {
      
      echo "Error retrieving blog count: " . $con->error;
  }
  $con->close();
?>

<?php
  include 'connection.php';

  $sql = "SELECT 
           (SELECT COUNT(*) FROM projects) AS projects_count,
          (SELECT COUNT(*) FROM researches) AS researches_count,
           (SELECT COUNT(*) FROM courses) AS courses_count,
           (SELECT COUNT(*) FROM cvtemplates) AS cvtemplates_count,
           (SELECT COUNT(*) FROM magazines) AS magazines_count";

  
  $result = $con->query($sql);

 
  if ($result) {
     
      $row = $result->fetch_assoc();
      $projectsCount = $row['projects_count'];
      $researchesCount = $row['researches_count'];
      $coursesCount = $row['courses_count'];
      $cvTemplatesCount = $row['cvtemplates_count'];
      $businessMagazinesCount = $row['magazines_count'];

     
      $totalResources = $projectsCount + $researchesCount + $coursesCount + $cvTemplatesCount + $businessMagazinesCount;

  } else {
      
      echo "Error retrieving data: " . $con->error;
  }

 
  $con->close();
?>
      

<!--list-topics-->
<section id="list-topics" class="list-topics">
  <div class="container">
    <div class="list-topics-content">
      <ul>

      <li>
       <div class="single-list-topics-content">
        <div class="single-list-topics-icon">
          <i class="flaticon-restaurant"></i>
        </div>
        <h2><a href="index.php">Users</a></h2>
        <p class="cc"><?php echo $usersCount; ?> </p>  
        </div>
      </li>


      <li>
       <div class="single-list-topics-content">
        <div class="single-list-topics-icon">
          <i class="flaticon-restaurant"></i>
        </div>
        <h2><a href="blog.php">Blogs</a></h2>
        <p class="cc"><?php echo $blogsCount; ?> </p>  
        </div>
      </li>

       
        <li>
      <div class="single-list-topics-content">
        <div class="single-list-topics-icon">
           <i class="flaticon-building"></i>
        </div>
        <h2><a href="projects.php">Resources</a></h2>
        <p class="cc"><?php echo $totalResources; ?> </p>  
      </div>
      </li>
      
      <li>
      <div class="single-list-topics-content">
        <div class="single-list-topics-icon">
           <i class="flaticon-building"></i>
        </div>
        <h2><a href="index.php">Experts</a></h2>
        <p class="cc"><?php echo $expertsCount; ?> </p>   
      </div>
      </li>

      
      <li>
      <div class="single-list-topics-content">
        <div class="single-list-topics-icon">
           <i class="flaticon-building"></i>
        </div>
        <h2><a href="chatIndex.php">Groups</a></h2>
        <p class="cc"><?php echo $groupsCount; ?> </p>   
      </div>
      </li>

        
      </ul>
    </div>
  </div><!--/.container-->
  
  <section id="contact" class="subscription">
    <div class="container">
        <div class="subscribe-title text-center">
            <h2>Calling all experts! Elevate your influence by joining with us.</h2>
            <p>Showcase your expertise and guide individuals toward success. Let's empower careers together.</p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="subscription-input-group">
                    <form id="subscriptionForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                      <input type="hidden" name="form_type" value="request">
                        <input type="email" name="email" class="subscription-input-form" placeholder="Enter your email here" required>
                        <button type="submit" class="appsLand-btn subscribe-btn">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- homebarone -->
  <section class="Feautes section">
      <div class="row">
        <div class="col-lg-12">
          <div class="features-title"></br>
            <h2>We Are Always Ready to Help Your Career</h2>
            
            <p>Guiding Your Career Journey: Empowering You to Reach New Heights..!</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-12">
          
          <div class="single-features">
            <div class="signle-icon">
              <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </div>
            <h3>Career Exploration</h3>
            <p> Tools and resources to help users explore various career paths, industries, and job roles</p>
          </div>
          
        </div>
        <div class="col-lg-4 col-12">
          
          <div class="single-features">
            <div class="signle-icon">
              <i class="fa fa-tasks" aria-hidden="true"></i>
            </div>
            <h3>Job Search and Counselling</h3>
            <p>Job listings from various industries and locations, resume and cover letter templates, interview tips, and techniques etc</p>
          </div>
          
        </div>
        <div class="col-lg-4 col-12">
         
          <div class="single-features last">
            <div class="signle-icon">
              <i class="fa fa-quote-left" aria-hidden="true"></i>
            </div>
            <h3>Professional Development</h3>
            <p> Online courses, webinars, workshops, networking strategies, communication skills, leadership development, and project management.</p>
          </div>
         
        </div>
      </div>
    </div></p></p></p>
  </section>
  <!--/ Endbarone-->
  <!-- Team -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
  <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 1200px;">
          <h5 class="fw-bold text-primary text-uppercase">Our Experts</h5>
          <h1 class="mb-0">Professional Stuffs Ready to Help Your Journey</h1>
      </div>
      <div class="row g-5">
          <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
              <div class="team-item bg-light rounded overflow-hidden">
                  <div class="team-img position-relative overflow-hidden">
                      <img class="img-fluid w-100" src="./assets/images/person1.jfif" alt="" style="width: 250px; height: 250px;" >
                      <div class="social text-center">
                        <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                <a class="sicons" href="#"><i class="fa fa-dribbble"></i></a>
                <a class="sicons" href="#"><i class="fa fa-flickr"></i></a>
                <a class="sicons" href="#"><i class="fa fa-github"></i></a>
                      </div>
                  </div>
                  <div class="text-center py-4">
                      <h4 class="text-primary">Dr. Lakmal Fernando</h4>
                      <p class="text-uppercase m-0">Senior Career Consultant</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
              <div class="team-item bg-light rounded overflow-hidden">
                  <div class="team-img position-relative overflow-hidden">
                      <img class="img-fluid w-100" src="./assets/images/person2.jfif" alt="" style="width: 250px; height: 250px;">
                      <div class="social text-center">
                      <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                <a class="sicons" href="#"><i class="fa fa-dribbble"></i></a>
                <a class="sicons" href="#"><i class="fa fa-flickr"></i></a>
                <a class="sicons" href="#"><i class="fa fa-github"></i></a>
                      </div>
                  </div>
                  <div class="text-center py-4">
                      <h4 class="text-primary">Prof. Nirmala Perera</h4>
                      <p class="text-uppercase m-0">Career Coach</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
              <div class="team-item bg-light rounded overflow-hidden">
                  <div class="team-img position-relative overflow-hidden">
                      <img class="img-fluid w-100" src="./assets/images/person3.jfif" alt="" style="width: 250px; height: 250px;">
                      <div class="social text-center">
                      <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                <a class="sicons" href="#"><i class="fa fa-dribbble"></i></a>
                <a class="sicons" href="#"><i class="fa fa-flickr"></i></a>
                <a class="sicons" href="#"><i class="fa fa-github"></i></a>
                      </div>
                  </div>
                  <div class="text-center py-4">
                      <h4 class="text-primary">Mr. Dinesh Wijesinghe</h4>
                      <p class="text-uppercase m-0">Industry Advisor</p>
                  </div>
              </div>
          </div>
      </div></p>
      <div class="row">
        <div class="col-sm-12">
            <div class="explore-input-group">
                <button class="appsLand-btn team-btn" onclick="window.location.href='about.php'">
                    View More
                </button></p>
            </div>
        </div> 
    </div></p></p>
  </div>
</div>
<!-- Team -->

  
  <!-- Review -->
  <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 1200px;"></p>
          <h5 class="fw-bold text-primary text-uppercase">Our Clients</h5>
            <h1 class="mb-0">What Our Clients Say About Our Services</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
            <div class="testimonial-item bg-light my-4">
                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                    <img class="img-fluid rounded" src="./assets/images/shanya.jpg" style="width: 300px; height: 200px;" >
                    <div class="ps-4">
                        <h4 class="text-primary mb-1">Shanya Fernando</h4>
                        <small class="text-uppercase">Web Developer</small>
                    </div>
                </div>
                
                <div class="pt-4 pb-5 px-5">
                  FutureFocus has been a game-changer for me! The personalized career guidance I received helped me identify my strengths and career goals with clarity. The user-friendly interface made navigation a breeze. Highly recommended!
                </div>
            </div>
            <div class="testimonial-item bg-light my-4">
                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                    <img class="img-fluid rounded" src="./assets/images/naduni.jpg" style="width: 300px; height: 200px;" >
                    <div class="ps-4">
                        <h4 class="text-primary mb-1">Naduni Dias</h4>
                        <small class="text-uppercase">Marketing Intern</small>
                    </div>
                </div>
                <div class="pt-4 pb-5 px-5">
                  As a recent graduate, I was feeling lost in my job search until I stumbled upon FutureFocus. The resources and expert advice available on the platform provided me with the direction I needed to kick-start my career. Thank you, FutureFocus!
                </div>
            </div>
            <div class="testimonial-item bg-light my-4">
                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                    <img class="img-fluid rounded" src="./assets/images/Dulanja.jpg" style="width: 300px; height: 200px;" >
                    <div class="ps-4">
                        <h4 class="text-primary mb-1">Dulanja Fernando</h4>
                        <small class="text-uppercase">Bank Manager</small>
                    </div>
                </div>
                <div class="pt-4 pb-5 px-5">
                  I've tried many career counseling services in the past, but none compare to FutureFocus. The depth of insight and the quality of advice surpassed my expectations. It's like having a personal career coach at your fingertips!
                </div>
            </div>
            <div class="testimonial-item bg-light my-4">
                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                    <img class="img-fluid rounded" src="./assets/images/saroj.jpg" style="width: 300px; height: 200px;" >
                    <div class="ps-4">
                        <h4 class="text-primary mb-1">Saroj Ranaweera</h4>
                        <small class="text-uppercase">Fashion Analyst</small>
                    </div>
                </div>
                <div class="pt-4 pb-5 px-5">
                  FutureFocus doesn't just tell you what careers you might like; it helps you understand why they're a good fit for you. The assessments were eye-opening, and the guidance provided afterward was invaluable. A must-try for anyone navigating their career path!
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
              <div class="explore-input-group">
                  <button class="appsLand-btn team-btn" onclick="window.location.href='reviews.php'">
                      View More
                  </button></p>
              </div>
          </div> 
      </div></p></p></br>
    </div>
</div>
<!-- review End -->
   
              
          
          

      
      <section id="contact"  class="explore">
        <div class="container">
          <div class="explore-title text-center">
            <h2>
              Explore insightful articles, expert advice, and practical tips tailored to every stage of your career journey.
            </h2>
            <p>
              Whether you're a recent graduate, seasoned professional, or contemplating a career change, our hub offers valuable insights and guidance to help you make informed decisions and achieve your goals.

            </br></br>Gain access to industry trends, job search strategies, interview tips, resume writing techniques, and much more. With our comprehensive array of resources, you'll gain the confidence and skills needed to stand out in a competitive landscape.

Take the next step towards realizing your career aspirations. </br>Explore our hub, ignite your passion, and embark on a fulfilling career path with confidence and clarity. Your future starts here.
            </p>
          </div>
          <div class="row">
            <div class="col-sm-12">
                <div class="explore-input-group">
                    <button class="appsLand-btn explore-btn" onclick="window.location.href='chatIndex.php'">
                        Explore More
                    </button>
                </div>
            </div> 
        </div>
        </div>
  
      </section>

      
    

		
   
		
      <?php

include 'connection.php';




$email = "";
$form_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($isLoggedIn) {
        if (isset($_POST['email']) && isset($_POST['form_type'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $form_type = $_POST['form_type'];

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($form_type == 'subscription') {
                    $stmt = $con->prepare("INSERT INTO subscription (subscribed_email) VALUES (?)");
                    $stmt->bind_param("s", $email);

                    if ($stmt->execute()) {
                        echo "<script>
                            alert('Subscribed successfully!');
                            window.location.href = 'index.php';
                        </script>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } elseif ($form_type == 'request') {
                    $stmt = $con->prepare("INSERT INTO requests (submitted_email) VALUES (?)");
                    $stmt->bind_param("s", $email);

                    if ($stmt->execute()) {
                        echo "<script>
                            alert('Request sent successfully!');
                            window.location.href = 'index.php';
                        </script>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo "Invalid form type";
                }
            } else {
                echo "Invalid email format";
            }
        } else {
            echo "Email or form type is not set";
        }
    } else {
        echo "<script>
                alert('You must be logged in to perform this action.');
                window.location.href = 'login.php';
              </script>";
    }
}

$con->close();
?>



         

    	 
   <!-- Footer Start -->
   <div class="container-fluid bg-dark bg-footer text-light py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary">Get In Touch</h4>
                <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                <p class="mb-4">Connect with us to unlock your potential and steer your career towards success. Let's shape your future together!</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i> No 11, Street Avenue, Colombo 05</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>info@futurefocus.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+94112993939</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary">Our Services</h4>
                <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-light mb-2" href="chatIndex.php"><i class="fa fa-angle-right me-2"></i>Job Search Assistance</a>
                    <a class="text-light mb-2" href="chatIndex.php"><i class="fa fa-angle-right me-2"></i>Career Counselling</a>
                    <a class="text-light mb-2" href="projects.php"><i class="fa fa-angle-right me-2"></i>Career Resources</a>
                    <a class="text-light mb-2" href="blog.php"><i class="fa fa-angle-right me-2"></i>Interview Preparation</a>
                    <a class="text-light mb-2" href="projects.php"><i class="fa fa-angle-right me-2"></i>Skill Development</a>
                    <a class="text-light mb-2" href="blog.php"><i class="fa fa-angle-right me-2"></i>Resume Building</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary">Quick Links</h4>
                <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                <div class="d-flex flex-column justify-content-start">
                  <a class="text-light mb-2" href="index.php"><i class="fa fa-angle-right me-2"></i>Home</a>
                  <a class="text-light mb-2" href="about.php"><i class="fa fa-angle-right me-2"></i>About</a>
                  <a class="text-light mb-2" href="blog.php"><i class="fa fa-angle-right me-2"></i>Blog</a>
                  <a class="text-light mb-2" href="reviews.php"><i class="fa fa-angle-right me-2"></i>Reviews</a>
                  <a class="text-light mb-2" href="projects.php"><i class="fa fa-angle-right me-2"></i>Resources</a>
                  <a class="text-light mb-2" href="contact.php"><i class="fa fa-angle-right me-2"></i>Contact</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary">Newsletter</h4>
                <hr class="w-25 text-secondary mb-4" style="opacity: 1;">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-group">
                      <input type="hidden" name="form_type" value="subscription">
                    <input type="text" name="email" class="form-control p-3 border-0" placeholder="Your Email" required>
                        
                        <button class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
                <h6 class="text-primary mt-4 mb-3">Follow Us</h6>
                
                <div class="social text-center">
                  <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                  <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-dribbble"></i></a>
                  <a href="#"><i class="fa fa-flickr"></i></a>
                  <a href="#"><i class="fa fa-github"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer2">
  <div class="container">
    <div class="row">

      <div class="col-md-6 panel">
        <div class="panel-body">
          <p class="simplenav">
            <a href="index.php">Home</a> | 
            <a href="about.php">About</a> |
            <a href="blog.php">Blog</a> |
            <a href="reviews.php">Reviews</a> |
            <a href="projects.php">Resources</a> |
            <a href="contact.php">Contact</a>
          </p>
        </div>
      </div>

      <div class="col-md-6 panel">
        <div class="panel-body">
          <p class="text-right">
            Copyright &copy; 2024 FutureFocus. All rights reserved!!!
          </p>
        </div>
      </div>

    </div>
    <!-- /row of panels -->
  </div>
</div>
<!-- Footer End -->

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="assets/js/modernizr-latest.js"></script> 
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='assets/js/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='assets/js/camera.min.js'></script> 
    <script src="assets/js/bootstrap.min.js"></script> 
	<script src="assets/js/custom.js"></script>
  <script src="./assets/js/main.js"></script>

	<script src="./assets/js/homeslider.js"></script>
  <script src="./assets/js/loginlogout.js"></script>
    <script>
		jQuery(function(){
			
			jQuery('#camera_wrap_4').camera({
                transPeriod: 500,
                time: 3000,
				height: '600',
				loader: 'false',
				pagination: true,
				thumbnails: false,
				hover: false,
                playPause: false,
                navigation: false,
				opacityOnGrid: false,
				imagePath: 'assets/images/'
			});

		});
      
	</script>



  

</body>
</html>
