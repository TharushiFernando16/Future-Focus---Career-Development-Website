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
	<title>FutureFocus Official Website - Researches</title>
	
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="./assets/css/style.css">

	<link rel="stylesheet" href="./assets/css/researches.css">
    
	
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
                    <h1>Resources- Researches</h1>
                    <p>Explore our resource page, featuring a curated collection of example research papers, designed to support your academic and professional growth</p>
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
		$sql = "SELECT title, authors, pdf_path, image_path FROM researches";
		$result = $con->query($sql);
		
		$researches = [];
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$researches[] = $row;
			}
		}
		
		$con->close();
		?>

<!-- container -->
<section class="container">
    <h2>Researches</h2>
    <div class="row">
        <div class="col-md-12">
            <section id="portfolio" class="page-section section appear clearfix">
                <br />
                <br />
                


                <div class="row">
                    <nav id="filter" class="col-md-12 text-center">
                        <ul>
                            <li><a href="#" class="current btn-theme btn-small" data-filter="*">All</a></li>
                            <li><a href="#" class="btn-theme btn-small" data-filter=".webdesign">Computer Science</a></li>
                            <li><a href="#" class="btn-theme btn-small" data-filter=".photography">Business</a></li>
                            <li><a href="#" class="btn-theme btn-small" data-filter=".print">Science</a></li>
                        </ul>
                    </nav>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="portfolio-items isotopeWrapper clearfix" id="3">
                            <?php foreach ($researches as $research): ?>
                                <article class="col-sm-4 isotopeItem webdesign">
                                    <div class="portfolio-item">
                                        
                                    <img src="<?php echo htmlspecialchars($research['image_path']); ?>" alt="" />
                                      
                                        <div class="portfolio-desc align-center">
                                            <div class="folio-info">
                                                <a href="<?php echo htmlspecialchars($research['pdf_path']); ?>" class="fancybox">
                                                    <h5><?php echo htmlspecialchars($research['title']); ?></h5>
                                                    <p><?php echo htmlspecialchars($research['authors']); ?></p>
                                                    <i class="fa fa-link fa-2x"></i></a>
                                                    <p align="center"><a href="<?php echo htmlspecialchars($research['pdf_path']); ?>" >Click Here to View </p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php endforeach; ?>

                               



                            </div>

                        </div>


                    </div>
                </div>

            </section>
        </div>
    </div>

</section>
	
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
