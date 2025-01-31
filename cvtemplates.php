<?php
session_start();

$isLoggedIn = isset($_SESSION['email']) && isset($_SESSION['loginType']);
$user_email = $isLoggedIn ? $_SESSION['email'] : '';
$user_loginType = $isLoggedIn ? $_SESSION['loginType'] : '';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) { 
    header('Location: login.php'); 
    exit(); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="free-educational-responsive-web-template-webEdu">
	<meta name="author" content="webThemez.com">
	<title>FutureFocus Official Website - CV Templates</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" type="text/css" href="assets/css/isotope.css" media="screen" />
	<link rel="stylesheet" href="assets/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="./assets/css/style.css">
	<link rel="stylesheet" href="./assets/css/cvtemplates.css">
  
	
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
            <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
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
                <li><a href="reviews.php">Reviews</a></li>
                <li class="active dropdown">
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
                <li><a class="mainicon" href="logout.php"><i class="fa fa-sign-out"></i></a></li>
            </ul>
        </nav>  
        </div>
        </nav>
            <!--/.nav-collapse -->
        </div>
    </div>
    <!-- /.navbar -->
		<header id="head" class="secondary">
            <div class="container">
                    <h1>Resources-CV Templates</h1>
                    <p>Explore our Career Resources Hub, your gateway to invaluable insights!</p>
                    
                </div>
    </header>


	<!-- container -->
	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<section id="portfolio" class="page-section section appear clearfix">
					<br />
					<br />
					<p class="rcontent">
						Welcome to our Resources Hub!</br></br>

Empower your career journey with our comprehensive collection of resources designed to guide you towards success. Whether you're exploring career options, seeking advice on professional development, or looking for tips on acing interviews, we've got you covered.

Discover a wealth of articles, guides, webinars, and more curated by industry experts. Stay updated with the latest trends, strategies, and insights to navigate the ever-evolving landscape of the job market.</br></br>

Take charge of your career growth today. Explore our resources and unlock your full potential!</br></br>

Ready to get started? Dive in now!
						<br />
					</p>


					
									

									


				</section>
			</div>
		</div>

	</section>

	<?php
        include 'connection.php';
		$sql = "SELECT image_url, download_link, title, description FROM cvtemplates";
		$result = $con->query($sql);
		
		$cv_templates = [];
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$cv_templates[] = $row;
			}
		}
		
		$con->close();
		?>

    <section id="cvtemplates"  class="cvtemplates">
    <div id="contents">
		<div id="services">
			<h1>Explore Templates</h1>
			<div id="grid">
				<ul>
				<?php foreach ($cv_templates as $template): ?>
        <a href="<?php echo htmlspecialchars($template['download_link']); ?>" download>
            <li>
                <img src="<?php echo htmlspecialchars($template['image_url']); ?>" alt="CV Template Image">
                <h5><?php echo htmlspecialchars($template['title']); ?></h5>
                <p><?php echo htmlspecialchars($template['description']); ?></p>
            </li>
        </a>
    <?php endforeach; ?>
				
					
				</ul>


			</div>
			<div id="sidebar">
				<h3>Cover Letters</h3>
				<ul>
					<li class="selected">
						<a href="assets/cvtemplates/coletter1.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Application for Marketing Manager Position</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter2.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Cover Letter for Software Developer Role</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter3.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Administrative Assistant Job Application Letter</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter4.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Sales Executive Position Cover Letter</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter5.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Graphic Designer Cover Letter Sample</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter6.png" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Cover Letter for Data Analyst Application</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter7.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Human Resources Manager Cover Letter</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter8.png" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Entry-Level Finance Cover Letter Example</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter9.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Project Manager Job Application Cover Letter</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter10.png" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Nursing Position Cover Letter Example</a>
					</li>
				</ul>

				<h3>Job Applications</h3>
				<ul>
					
                    <li class="selected">
						<a href="assets/cvtemplates/coletter1.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Software Development</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter2.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Marketing and Sales</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter3.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Customer Service</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter4.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Human Resources</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter5.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Finance and Accounting</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter6.PNG" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Project Management</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter2.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Healthcare and Nursing</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter3.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Education and Teaching</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter4.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Engineering</a>
					</li>
					<li class="selected">
						<a href="assets/cvtemplates/coletter5.jpg" download><i class="fa fa-arrow-right" aria-hidden="true"></i>Administrative Support</a>
					</li>
				</ul>
				
                
				<h3>Explore Our Blog</h3>
				<ul>
        <p>
			Visit our blog for articles on CV making ideas and more!
		</p>
        <a href="blog.php" class="btnbn btnbn-primary">Explore Blog</a>
	</ul>

		<h3>Networking</h3>
		<ul>
        <p>
			For tailored tips and advice, join us in the chat section—where your success story begins!
		</p>
        <a href="chatIndex.php" class="btnbn btnbn-primary">Chat Now</a>
		</ul>
                
				
				
			</div>
		</div>
	</div>
    </section>
  
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
	<script src="assets/js/jquery.cslider.js"></script>
	<script src="assets/js/jquery.isotope.min.js"></script>
	<script src="assets/js/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>
