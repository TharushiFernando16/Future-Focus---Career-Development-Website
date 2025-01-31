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
	<title>FutureFocus Official Website - Blog</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="./assets/css/style.css">
	
	<link rel="stylesheet" href="./assets/css/blog.css">
	
	
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
                <li class="active"><a href="blog.php">Blog</a></li>
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
				<h1 class="content">Blog</h1>
				<p>Empowering Careers: Explore Insights, Tips, and Success Stories in Our Blog Section!</p>
			</div>
  </header>
  

  <?php

include 'connection.php';

$sql = "SELECT * FROM blogs";
$result = $con->query($sql);

$blogs = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
} else {
    echo "No blog posts found.";
}

$con->close();
?>


<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
			<div class="container py-5">
				<div class="row g-5">
					<!-- Blog list Start -->
					<div class="col-lg-8">
						<div class="row g-5">

    <?php foreach ($blogs as $blog): ?>
        <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
            <div class="blog-item bg-light rounded overflow-hidden">
                <div class="blog-img position-relative overflow-hidden">
                    <img class="img-fluid" src="<?php echo htmlspecialchars($blog['image']); ?>" alt="" style="width: 300px; height: 300px;">
                    
                </div>
                <div class="p-4">
                    <div class="d-flex mb-3">
                        <small class="me-3"><i class="fa fa-user" aria-hidden="true"></i> <?php echo htmlspecialchars($blog['author']); ?></small>
                        <small><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo htmlspecialchars($blog['year']); ?></small>
                    </div>
                    <h4 class="mb-3"><?php echo htmlspecialchars($blog['title']); ?></h4>
                    <p><?php echo htmlspecialchars($blog['summary']); ?></p>
                    <a class="text-uppercase" href="<?php echo htmlspecialchars($blog['link']); ?>">Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
	</div>
	
	
<!-- Sidebar Start -->
<div class="col-lg-4">
						<!-- Search Form Start -->
						<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
							<div class="input-group">
								<input type="text" class="form-control p-3" placeholder="Keyword">
								<button class="btn btn-primary px-4"><i class="fa fa-search"></i></button>
							</div>
						</div>
						<!-- Search Form End -->
		
						<!-- Category Start -->
						<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
							<div class="section-title section-title-sm position-relative pb-3 mb-4">
								<h3 class="mb-0">Categories</h3>
							</div>
							<div class="link-animated d-flex flex-column justify-content-start">
								<a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-arrow-right me-2"></i>Resume Making</a>
								<a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="assets/pdf/blog articles/HowtoPrepareforaJobInterviewGuide.pdf"><i class="fa fa-arrow-right me-2"></i>Interview tips</a>
								<a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-arrow-right me-2"></i>Professional Development</a>
								<a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-arrow-right me-2"></i>Flex Jobs</a>
								<a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-arrow-right me-2"></i>Trending Degrees</a>
							</div>
						</div>
						<!-- Category End -->
		
						<!-- Recent Post Start -->
						<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
							<div class="section-title section-title-sm position-relative pb-3 mb-4">
								<h3 class="mb-0">Recent Posts</h3>
							</div>
							<div class="d-flex rounded overflow-hidden mb-3">
								<img class="img-fluid" src="assets/images/blogside1.jpg" style="width: 600px; height: 100px; object-fit: cover;" alt="">
								<a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">"Forging Future Leaders: Nurturing Growth Through Leadership Development."
								</a></p>
							</div>
							<div class="d-flex rounded overflow-hidden mb-3">
								<img class="img-fluid" src="assets/images/blogside2.jpg" style="width: 600px; height: 100px; object-fit: cover;" alt="">
								<a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">"Elevating Expertise: Empowering Through Skills Training."
								</a></p>
							</div>
							<div class="d-flex rounded overflow-hidden mb-3">
								<img class="img-fluid" src="assets/images/blogside3.jpg" style="width: 600px; height: 100px; object-fit: cover;" alt="">
								<a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">"Ascending Excellence: The Art of Skill Level Enhancement."
								</a>
							</div>
							<div class="d-flex rounded overflow-hidden mb-3">
								<img class="img-fluid" src="assets/images/blogside4.jpg" style="width: 600px; height: 100px; object-fit: cover;" alt="">
								<a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">"Guiding Lights: Illuminating Paths to Professional Fulfillment."
								</a>
							</div>
							<div class="d-flex rounded overflow-hidden mb-3">
								<img class="img-fluid" src="assets/images/blogside5.jpg" style="width: 600px; height: 100px; object-fit: cover;" alt="">
								<a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">"Strength in Unity: The Power of a Cohesive Team."
								</a>
							</div>
							<div class="d-flex rounded overflow-hidden mb-3">
								<img class="img-fluid" src="assets/images/blogside6.jpg" style="width: 600px; height: 100px; object-fit: cover;" alt="">
								<a href="" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">"Achieving Excellence: Recognizing the Top Ranker in College."
								</a>
							</div>
						</div>
						<!-- Recent Post End -->
		
						<!-- Image Start -->
						<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
							<img src="assets/images/blogsidepic.jpg" alt="" class="img-fluid rounded">
						</div>
						<!-- Image End -->
		
						<!-- Tags Start -->
						<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
							<div class="section-title section-title-sm position-relative pb-3 mb-4">
								<h3 class="mb-0">Connect with us</h3>
							</div>
							<div class="d-flex flex-wrap m-n1">
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Design</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Development</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Marketing</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>SEO</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Writing</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Consulting</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Design</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Development</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Marketing</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>SEO</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Writing</a>
								<a href="" class="btn btn-light m-1"><i class="fa fa-tag" aria-hidden="true"></i>Consulting</a>
							</div>
						</div>
						<!-- Tags End -->
		
						<!-- Plain Text Start -->
						<div class="wow slideInUp" data-wow-delay="0.1s">
							<div class="section-title section-title-sm position-relative pb-3 mb-4">
								<h3 class="mb-0"></h3>
							</div>
							<div class="bg-light text-center" style="padding: 30px;">
								<p>Whether you're looking for career guidance, personal development tips, or industry trends, our blog is your go-to resource for valuable insights. Stay informed, inspired, and empowered as you navigate your journey towards success. Happy reading!</p>
									
							</div>
						</div>
						<!-- Plain Text End -->
					</div>


  
		 <!-- Blog Start -->

		
		
				</div>
			</div>
		</div>
		<!-- Blog End -->
	
	
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


	<script>
$(document).ready(function() {
    var blogs = <?php echo json_encode($blogs); ?>;
    displayBlogs(blogs);

    function displayBlogs(blogs) {
        var blogContainer = $('#blog-container');
        blogContainer.empty();

        $.each(blogs, function(index, blog) {
            var blogHtml = `
                <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                    <div class="blog-item bg-light rounded overflow-hidden">
                        <div class="blog-img position-relative overflow-hidden">
                            <img class="img-fluid" src="${blog.image}" alt="" style="width: 300px; height: 300px;">
                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="${blog.link}">Interview Tips</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="fa fa-user" aria-hidden="true"></i> ${blog.author}</small>
                                <small><i class="fa fa-calendar" aria-hidden="true"></i> ${blog.year}</small>
                            </div>
                            <h4 class="mb-3">${blog.title}</h4>
                            <p>${blog.summary}</p>
                            <a class="text-uppercase" href="${blog.link}">Read More <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            `;
            blogContainer.append(blogHtml);
        });
    }
});
</script>



</body>
</html>
