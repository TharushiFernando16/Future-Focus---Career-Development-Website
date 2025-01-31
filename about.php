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
    <title>FutureFocus Official Website - About</title>
    <link rel="favicon" href="assets/images/favicon.png">
    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
    <link rel="stylesheet" href="./assets/css/style.css">
    
    <link rel="stylesheet" href="./assets/css/about.css">


  


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
                <li class="active"><a href="about.php">About</a></li>
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
            
        </div>
    </div>
    
    <header id="head" class="secondary">
      <div class="container">
              <h1 class="acontent">About Us</h1>
              <p>Empower Your Career Journey: Welcome to FutureFocus, Your Partner in Success!</p>
          </div>
</header>



    
    
            <div class="container">
              <h3>How we make a difference</h3>
    
                <p class="acontentt">
                    <img src="" alt="" class="img-rounded pull-right" width="300">
                    "At Future Focus, we blend academic proficiency with real-world experience to illuminate your career path. Our seasoned consultants offer personalized guidance, bridging the gap between academia and industry. Whether you're charting your academic trajectory or embarking on a professional journey, we provide expert support every step of the way. With a commitment to your success, we empower you to make informed decisions and seize opportunities in today's ever-evolving landscape. Trust Future Focus to unlock the full spectrum of your potential and propel you towards a fulfilling and prosperous future.</p>
                    <p class="acontentt">Future Focus merges academic expertise with real-world insight, guiding you through every career milestone. Our seasoned consultants bridge academia and industry seamlessly, empowering informed decisions and unlocking your full potential."</p>
            </section>
            
            <section id="contact"  class="experience">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <img class="img-fluid mb-4 mb-lg-0" src="./assets/images/about_1.jpg" alt="Image" style="width: 470px; height: 370px;">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="display-4 font-weight-bold mb-4">10+ Years Experience</h2></p></p>
                        <p>Seamless Navigation, Tailored Insights: Elevate Your Career Journey with Future Focus. Explore Intuitive Tools and Personalized Guidance for Every Step Forward</p></p>
                        <div class="row py-2">
                            <div class="col-sm-6">
                                <i class="flaticon-barbell display-2 text-primary"></i>
                                <h4 class="font-weight-bold">Certified Counselling Center</h4></p>
                                <p>We provide certified counseling services with a compassionate touch. Our team of experienced counselors is dedicated to guiding you through life's challenges with empathy and expertise.</p>
                            </div>
                            <div class="col-sm-6">
                                <i class="flaticon-medal display-2 text-primary"></i>
                                <h4 class="font-weight-bold">Award Winning</h4></p>
                                <p>Our team of certified counselors, recipients of prestigious awards, stands ready to provide you with compassionate guidance and evidence-based therapy.</p>
                            </div>
                        
                </div>
            </div>
            </section>

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
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
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
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
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
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">Mr. Dinesh Wijesinghe</h4>
                        <p class="text-uppercase m-0">Industry Advisor</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="./assets/images/young-beautiful-woman-pinexpert5.avif" alt="" style="width: 250px; height: 250px;">
                        <div class="social text-center">
                            <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">Dr. Diluxa Dias</h4>
                        <p class="text-uppercase m-0">Fashino Analyst</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="./assets/images/expert1.jpg" alt="" style="width: 250px; height: 250px;">
                        <div class="social text-center">
                            <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">Mr. John Bendaz</h4>
                        <p class="text-uppercase m-0">Business Developer</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="./assets/images/expert2.jpg" alt="" style="width: 250px; height: 250px;">
                        <div class="social text-center">
                            <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">Mrs. Ann Thakur</h4>
                        <p class="text-uppercase m-0">Counsellor</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="assets/images/expert3.jpg" alt="" style="width: 250px; height: 250px;">
                        <div class="social text-center">
                            <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">Mr. Vihara Gayantha</h4>
                        <p class="text-uppercase m-0">Director</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="assets/images/Tharuka Fernando-Mechandiser-MAS holdings.jfif" alt="" style="width: 250px; height: 250px;">
                        <div class="social text-center">
                            <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">Mr. Tharuka Fernando</h4>
                        <p class="text-uppercase m-0">Mechandizer</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                <div class="team-item bg-light rounded overflow-hidden">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="assets/images/Ravi Abeysuriya - Group Director of Candor Group.jfif" alt="" style="width: 250px; height: 250px;">
                        <div class="social text-center">
                            <a class="sicons" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="sicons" href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h4 class="text-primary">Mr. Ravi Abeysuriya</h4>
                        <p class="text-uppercase m-0">Director</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team -->
            <!-- Sidebar -->
            <aside class="col-sm-4 sidebar sidebar-right">
                
                <div class="panel">
                    <h3 class="news">Latest News</h3>
                    <ul class="list-unstyled list-spaces">
                        <li>
                            <a href="#">New Research Findings</a><br>
                            <span class="small text-muted">Reports or studies uncovering trends in employment, skills development, or the job market.</span>
                        </li>
                        <li>
                            <a href="#">Success Stories</a><br>
                            <span class="small text-muted">Profiles or testimonials highlighting individuals who have benefited from career counseling services and achieved success in their professional lives.</span>
                        </li>
                        <li>
                            <a href="#">Technology and Innovation</a><br>
                            <span class="small text-muted">The integration of new technologies or innovative tools into career counseling platforms to improve services or accessibility.</span>
                        </li>
                        <li>
                            <a href="#">Events and Conferences</a><br>
                            <span class="small text-muted">Upcoming conferences, workshops, or seminars related to career counseling, featuring discussions on best practices, research findings, and networking opportunities.</span>
                        </li>
                        <li>
                            <a href="#">Industry Trends</a><br>
                            <span class="small text-muted">Insights into emerging industries, in-demand skills, or changing job market dynamics that may influence career counseling strategies.</span>
                        </li>
                     </ul>
                </div>

            </aside>
            <!-- /Sidebar -->

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
    <script src="assets/js/custom.js"></script>
</body>
</html>
