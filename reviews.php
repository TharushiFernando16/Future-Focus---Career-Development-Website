<?php
session_start();

$isLoggedIn = isset($_SESSION['email']) && isset($_SESSION['loginType']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';
$user_loginType = $isLoggedIn ? $_SESSION['loginType'] : '';



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="free-educational-responsive-web-template-webEdu">
	<meta name="author" content="webThemez.com">
	<title>FutureFocus Official Website - Reviews</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="./assets/css/style.css">

	<link rel="stylesheet" href="./assets/css/reviews.css">
	
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
            <!-- Add any additional content here if needed -->
        </nav>
            <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <div class="container">
        <nav class="mx-auto site-navigation navbar-nav-container">
          <ul class="nav navbar-nav pull-right mainNav">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li  class="active"><a href="reviews.php">Reviews</a></li>
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
				<li><a class="mainicon" href="chatIndex.php"><i class="fa fa-comment"></i></a></li>
				
				<li>
    <?php if($isLoggedIn): ?>
        <!-- Sign out icon -->
        <a class="mainicon" href="logout.php" title="Logout">
            <i class="fa fa-sign-out"></i>
        </a>
    <?php else: ?>
        <!-- Sign in icon -->
        <a class="mainicon" href="login.php" title="Login">
            <i class="fa fa-sign-in"></i>
        </a>
    <?php endif; ?>
</li>

            </ul>
        </nav>
        </div>
        </nav>
            <!--/.nav-collapse -->
        </div>
    </div>

		<header id="head" class="secondary">
            <div class="container">
                    <h1>Reviews</h1>
                    <p>What our clients say about our services</p>
                </div>
    </header>
	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<section id="portfolio" class="page-section section appear clearfix">
					<br />
					<br />
					<p class="rcontent">
						Welcome to FutureFocus Career Consultancy, where success stories come to life! Discover what our clients have to say about their experiences with our personalized career guidance and expert advice.

					</br></br>
					Our clients' testimonials speak volumes about the transformative impact of our services. From recent graduates to seasoned professionals, we've helped individuals at every stage of their career journey achieve their goals and unlock their full potential.
					
					
</br></br>

Explore the testimonials below to learn how FutureFocus has empowered individuals to navigate their career paths with confidence, clarity, and purpose. Join our community of satisfied clients and embark on your journey toward a brighter future today!</br></br>


						<br />
					</p>


					
						

									


				</section>
			</div>
		</div>

	</section>
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
						<img class="img-fluid rounded" src="assets/images/shanya.jpg" style="width: 300px; height: 200px;" >
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
						<img class="img-fluid rounded" src="assets/images/naduni.jpg" style="width: 300px; height: 200px;" >
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
						<img class="img-fluid rounded" src="assets/images/Dulanja.jpg" style="width: 300px; height: 200px;" >
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
						<img class="img-fluid rounded" src="assets/images/saroj.jpg" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Saroj Ranaweera</h4>
							<small class="text-uppercase">Fashin Analyst</small>
						</div>
					</div>
					<div class="pt-4 pb-5 px-5">
					  FutureFocus doesn't just tell you what careers you might like; it helps you understand why they're a good fit for you. The assessments were eye-opening, and the guidance provided afterward was invaluable. A must-try for anyone navigating their career path!
					</div>
				</div>
				


			</div>
			
		</div>
	</div>

	<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
		<div class="container py-5">
			
			<div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
				<div class="testimonial-item bg-light my-4">
					<div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
						<img class="img-fluid rounded" src="assets/images/Ayesha Rodrigo - Human Resources Manager at Hayleys PLC.jfif" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Ayesha Rodrigo</h4>
							<small class="text-uppercase">Human Resources Manager</small>
						</div>
					</div>
					
					<div class="pt-4 pb-5 px-5">
					  FutureFocus has been a game-changer for me! The personalized career guidance I received helped me identify my strengths and career goals with clarity. The user-friendly interface made navigation a breeze. Highly recommended!
					</div>
				</div>
				<div class="testimonial-item bg-light my-4">
					<div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
						<img class="img-fluid rounded" src="assets/images/Tharuka Fernando-Mechandiser-MAS holdings.jfif" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Tharuka Fernando</h4>
							<small class="text-uppercase">MMechandiser</small>
						</div>
					</div>
					<div class="pt-4 pb-5 px-5">
					  As a recent graduate, I was feeling lost in my job search until I stumbled upon FutureFocus. The resources and expert advice available on the platform provided me with the direction I needed to kick-start my career. Thank you, FutureFocus!
					</div>
				</div>
				<div class="testimonial-item bg-light my-4">
					<div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
						<img class="img-fluid rounded" src="assets/images/Ravi Abeysuriya - Group Director of Candor Group.jfif" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Ravi Abeysuriya</h4>
							<small class="text-uppercase">Director</small>
						</div>
					</div>
					<div class="pt-4 pb-5 px-5">
					  I've tried many career counseling services in the past, but none compare to FutureFocus. The depth of insight and the quality of advice surpassed my expectations. It's like having a personal career coach at your fingertips!
					</div>shan
				</div>
				<div class="testimonial-item bg-light my-4">
					<div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
						<img class="img-fluid rounded" src="assets/images/sarath.jpg" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Sarath Ranaweera</h4>
							<small class="text-uppercase">Data Analyst</small>
						</div>
					</div>
					<div class="pt-4 pb-5 px-5">
					  FutureFocus doesn't just tell you what careers you might like; it helps you understand why they're a good fit for you. The assessments were eye-opening, and the guidance provided afterward was invaluable. A must-try for anyone navigating their career path!
					</div>
				</div>
				


			</div>
			
		</div>
	</div>

	<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
		<div class="container py-5">
			
			<div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
				<div class="testimonial-item bg-light my-4">
					<div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
						<img class="img-fluid rounded" src="assets/images/photo-2.jpg" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Kevin Rooz</h4>
							<small class="text-uppercase">Administrator</small>
						</div>
					</div>
					
					<div class="pt-4 pb-5 px-5">
					  FutureFocus has been a game-changer for me! The personalized career guidance I received helped me identify my strengths and career goals with clarity. The user-friendly interface made navigation a breeze. Highly recommended!
					</div>
				</div>
				<div class="testimonial-item bg-light my-4">
					<div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
						<img class="img-fluid rounded" src="assets/images/photo-3.jpg" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Govindi Dias</h4>
							<small class="text-uppercase">Technical Developer</small>
						</div>
					</div>
					<div class="pt-4 pb-5 px-5">
					  As a recent graduate, I was feeling lost in my job search until I stumbled upon FutureFocus. The resources and expert advice available on the platform provided me with the direction I needed to kick-start my career. Thank you, FutureFocus!
					</div>
				</div>
				<div class="testimonial-item bg-light my-4">
					<div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
						<img class="img-fluid rounded" src="assets/images/review9.jpg" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Shriyani Fernando</h4>
							<small class="text-uppercase">Marketing Manager</small>
						</div>
					</div>
					<div class="pt-4 pb-5 px-5">
					  I've tried many career counseling services in the past, but none compare to FutureFocus. The depth of insight and the quality of advice surpassed my expectations. It's like having a personal career coach at your fingertips!
					</div>
				</div>
				<div class="testimonial-item bg-light my-4">
					<div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
						<img class="img-fluid rounded" src="assets/images/review7.jpg" style="width: 300px; height: 200px;" >
						<div class="ps-4">
							<h4 class="text-primary mb-1">Thinuri Gamage</h4>
							<small class="text-uppercase">Fashion Analyst</small>
						</div>
					</div>
					<div class="pt-4 pb-5 px-5">
					  FutureFocus doesn't just tell you what careers you might like; it helps you understand why they're a good fit for you. The assessments were eye-opening, and the guidance provided afterward was invaluable. A must-try for anyone navigating their career path!
					</div>
				</div>
				


			</div>
			
		</div>
	</div>
	<!-- review End -->

	

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
