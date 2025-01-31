<?php
session_start();

$isLoggedIn = isset($_SESSION['email']) && isset($_SESSION['loginType']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';
$user_loginType = $isLoggedIn ? $_SESSION['loginType'] : '';


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) { 
    header('Location: login.php'); 
    exit(); 
}


include 'connection.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);


    $stmt = $con->prepare("INSERT INTO contact (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('MySQL prepare() failed: ' . htmlspecialchars($con->error));
    }

    
    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

  
    if ($stmt->execute()) {
        
        echo "<script>
                alert('Message sent successfully!');
                window.location.href = 'contact.php';
              </script>";
        exit(); 

    } else {
        $errorMessage = "Error: " . $stmt->error;
    }


    
    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="free-educational-responsive-web-template-webEdu">
	<meta name="author" content="webThemez.com">
	<title>FutureFocus Official Website - Contact</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="./assets/css/style.css">

	<link rel="stylesheet" href="./assets/css/contact.css">
	<script>
    
    <?php if (isset($_SESSION['successMessage'])): ?>
        alert("<?php echo $_SESSION['successMessage']; ?>");
        <?php unset($_SESSION['successMessage']); ?> 
    <?php endif; ?>
    </script>
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

	<div class="navbar navbar-inverse">
        <div class="container">
          <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
            <a href="index.php" class="navbar-brand d-flex align-items-center px-44 px-lg-5">
                <h2 class="m-0"><i class="fa fa-rocket" aria-hidden="true"></i>FutureFocus</h2>
            </a>
            
        </nav>
            <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <div class="container">
        <nav class="mx-auto site-navigation navbar-nav-container">
          <ul class="nav navbar-nav pull-right mainNav">
                <li><a href="index.php">Home</a></li>
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
                <li class="active"><a href="contact.php">Contact</a></li>
                <li><a class="mainicon" href="chatIndex.php"><i class="fa fa-comment"></i></a></li>
                <li><a class="mainicon" href="logout.php"><i class="fa fa-sign-out"></i></a></li>
            </ul>
        </nav>
        </div>
        </nav>
            <!--/.nav-collapse -->
        </div>
    </div>

		<header id="head" class="secondary">
            <div class="container">
                    <h1>Contact Us</h1>
                    <p>Got questions or ideas? Reach out! We're here to help</p>
                </div>
    </header>


	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h3 class="section-title">Any Queries?</h3>
						<p class="qcontent">
							Have burning questions about your career or academic journey? Our app's got you covered! Just fill out the form, and our expert advisors will provide tailored guidance. From job prospects to academic pursuits, we're here to support your path to success. Ask away!
						</p>
						
						<form class="form-light mt-20" role="form" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" placeholder="Write your message here..." style="height:100px;" required></textarea>
    </div>
    <button type="submit" class="btns btn-two" name="submit">Send message</button>
</form>


					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<h3 class="section-title">Our Info</h3>
								<div class="contact-info">
									<h5>Address</h5>
									<p>No 11, Street Avenue, Colombo 05</p>
									
									<h5>Email</h5>
									<p>info@futurefocus.com</p>
									
									<h5>Phone</h5>
									<p>+94112993939</p>
								</div>
							</div> 
						</div> 						
					</div>
				</div>
			</div>
	<!-- /container -->

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
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-3 border-0" placeholder="Your Email">
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>

	<!-- Google Maps -->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script src="assets/js/google-map.js"></script>


</body>
</html>
