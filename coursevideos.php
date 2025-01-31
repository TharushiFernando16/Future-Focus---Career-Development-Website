<?php
session_start();

$isLoggedIn = isset($_SESSION['email']) && isset($_SESSION['loginType']);
$user_email = $isLoggedIn ? htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') : '';
$user_loginType = $isLoggedIn ? htmlspecialchars($_SESSION['loginType'], ENT_QUOTES, 'UTF-8') : '';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) { 
    header('Location: login.php'); 
    exit(); 
}
?>
<?php
include 'connection.php';

// Fetch unique categories from the courses table
$sql = "SELECT DISTINCT category FROM courses";
$result = $con->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category'];
    }
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="free-educational-responsive-web-template-webEdu">
    <meta name="author" content="webThemez.com">
    <title>FutureFocus Official Website - Course Videos</title>
    
    
    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/coursevideos.css">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php if($isLoggedIn): ?>
  <div class="notification-bar">
            <i class="fa fa-user"></i>
            <?php echo $user_email; ?>
        </div>
<?php endif; ?>

<!-- Fixed navbar -->
<div class="navbar navbar-inverse">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
            <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
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
    </div>
</div>
<!-- /.navbar -->

<header id="head" class="secondary">
    <div class="container">
        <h1>Resources - Course Videos</h1>
        <p>Got questions or ideas? Reach out! We're here to help</p>
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

<h2>Courses</h2>

<section class="about" id="about">
    <div class="image">
        <img src="assets/images/o2.webp" alt="">
    </div>
    <div class="content">
        <h3>Why choose us?</h3>
        <p>Our courses are designed by industry experts with years of experience and are crafted to equip you with the skills and knowledge necessary for success in today's competitive job market. Here's our free courses.</p>
    </div>
</section>

<div class="dropdown">
    <button onclick="myFunction()" class="dropbtn">Select Category....</button>
    <div id="myDropdown" class="dropdown-content">
        <div class="search-container">
            <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
            <i class="fa fa-search search-icon" onclick="filterFunction()"></i>
        </div>
        <?php foreach ($categories as $category): ?>
            <a href="#" onclick="filterCourses('<?php echo htmlspecialchars($category); ?>', this)"><?php echo htmlspecialchars($category); ?></a>
        <?php endforeach; ?>
        <a href="#" onclick="cleanAll()">Clear All</a>
        <div id="notFound" class="not-found">Not Found</div>
    </div>
</div>

<!-- course section starts  -->
<section class="course" id="course">
    <h1 class="heading">Our popular courses</h1>
    <div class="box-container">
        <?php
        include 'connection.php';

        $sql = "SELECT * FROM courses ORDER BY course_id DESC";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="box" data-keywords="' . htmlspecialchars($row["category"], ENT_QUOTES, 'UTF-8') . '">
                    <img src="' . htmlspecialchars($row["image_url"], ENT_QUOTES, 'UTF-8') . '" alt="">
                    <h3 class="price">' . htmlspecialchars($row["price"], ENT_QUOTES, 'UTF-8') . '</h3>
                    <div class="content">
                        <div class="stars">
                            ' . str_repeat('<i class="fa fa-star"></i>', floor($row["rating"])) . 
                            ($row["rating"] - floor($row["rating"]) >= 0.5 ? '<i class="fa fa-star-half"></i>' : '') . '
                        </div>
						<a href="' . ($row["pdf_url"] ? htmlspecialchars($row["pdf_url"], ENT_QUOTES, 'UTF-8') : '#') . '" class="title">' . htmlspecialchars($row["title"], ENT_QUOTES, 'UTF-8') . '</a>
                        
                       
                        <div class="info">
                            <h3><i class="fa fa-clock"></i> ' . htmlspecialchars($row["duration"], ENT_QUOTES, 'UTF-8') . ' </h3>
                            <h3><i class="fa fa-book"></i> ' . htmlspecialchars($row["modules"], ENT_QUOTES, 'UTF-8') . ' modules </h3>
                            <h3><i class="fa fa-certificate"></i> ' . ($row["certificate"] ? 'FREE CERTIFICATE' : '') . '</h3>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "No courses found.";
        }

        $con->close();
        ?>
    </div>
</section>
<!-- course section ends -->

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
                    <a class="text-light mb-2" href="resources.php"><i class="fa fa-angle-right me-2"></i>Career Resources</a>
                    <a class="text-light mb-2" href="blog.php"><i class="fa fa-angle-right me-2"></i>Interview Preparation</a>
                    <a class="text-light mb-2" href="resources.php"><i class="fa fa-angle-right me-2"></i>Skill Development</a>
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


<script>
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    const input = document.getElementById("myInput");
    const filter = input.value.toUpperCase();
    const div = document.getElementById("myDropdown");
    const a = div.getElementsByTagName("a");
    let found = false;
    for (let i = 0; i < a.length; i++) {
        const txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            found = true;
        } else {
            a[i].style.display = "none";
        }
    }
    document.getElementById("notFound").style.display = found ? "none" : "block";
}

function filterCourses(keyword, element) {
    const boxes = document.querySelectorAll('.box');
    boxes.forEach(box => {
        if (box.getAttribute('data-keywords').toUpperCase().includes(keyword.toUpperCase())) {
            box.style.display = 'block';
        } else {
            box.style.display = 'none';
        }
    });
    highlightSelected(element);
}

function cleanAll() {
    const boxes = document.querySelectorAll('.box');
    boxes.forEach(box => {
        box.style.display = 'block';
    });
    highlightSelected(null);
}

function highlightSelected(element) {
    const links = document.querySelectorAll('.dropdown-content a');
    links.forEach(link => {
        link.classList.remove('selected');
    });
    if (element) {
        element.classList.add('selected');
    }
}
</script>
</body>
</html>
