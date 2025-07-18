<?php 
include "DB_connection.php";
include "data/setting.php";
$setting = getSetting($conn);

if ($setting != 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$setting['school_name']?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="logo.png">
	<style>
		


/* ----------------------------------- index.php css file ----------------------------------
********************************************************************************************
********************************************************************************************/
:root {
            --primary-color: #003366;
            --secondary-color: #ff6600;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .navbar {
            background-color: var(--primary-color) !important;
            padding: 0;
        }
        
        .navbar-brand img {
            height: 80px;
        }
        
        .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 8px 15px !important;
        }
        
        .nav-link:hover {
            color: var(--secondary-color) !important;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 51, 102, 0.8)), url('img/campus.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background-color: var(--secondary-color);
            bottom: -10px;
            left: 0;
        }
        
        .feature-box {
            text-align: center;
            padding: 30px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }
        
        .about-section {
            padding: 80px 0;
            background-color: var(--light-color);
        }
        
        .event-card {
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .event-date {
            background-color: var(--primary-color);
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 0 0 5px;
        }
        
        .event-day {
            font-size: 2rem;
            font-weight: 700;
            display: block;
        }
        
        .event-month {
            font-size: 1rem;
            display: block;
        }
        
        .news-section {
            padding: 80px 0;
        }
        
        .news-card {
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .news-img {
            height: 200px;
            object-fit: cover;
        }
        
        .contact-section {
            padding: 80px 0;
            background-color: var(--light-color);
        }
        
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer-links h5 {
            color: var(--secondary-color);
            margin-bottom: 20px;
        }
        
        .footer-links ul {
            list-style: none;
            padding-left: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: color 0.3s;
        }
        
        .social-icons a:hover {
            color: var(--secondary-color);
        }
        
        .copyright {
            border-top: 1px solid #495057;
            padding-top: 20px;
            margin-top: 30px;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
        }
	</style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="<?=$setting['school_name']?>">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#academics">Academics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#admissions">Admissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title"><?=$setting['school_name']?></h1>
            <p class="hero-subtitle"><?=$setting['slogan']?></p>
            <div class="d-flex justify-content-center gap-3">
            <!--    <a href="#admissions" class="btn btn-primary btn-lg">Apply Now</a>  -->
                <a href="#about" class="btn btn-outline-light btn-lg">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Quick Features -->
    <section class="py-5">
        <div class="container">
            <div class="row">
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-map-marked-alt"></i>
						</div>
						<h3>TOTAL LAND</h3>
						<p>150 Decimals</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-futbol"></i>
						</div>
						<h3>PLAYGROUND</h3>
						<p>90 Decimals</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-building"></i>
						</div>
						<h3>FLOOR SPACE</h3>
						<p>21,575 Sq. Ft.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-user-tie"></i>
						</div>
						<h3>AVERAGE TEACHER AGE</h3>
						<p>49 Years</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-chalkboard-teacher"></i>
						</div>
						<h3>STUDENT TO TEACHER</h3>
						<p>Ratio 48:1</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-users"></i>
						</div>
						<h3>STUDENT TO EMPLOYEE</h3>
						<p>Ratio 144:1</p>
					</div>
				</div>
			</div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2 class="text-center section-title">About <?=$setting['school_name']?></h2>
            <div class="row ">
                <div class="col-lg-6">
                    <img src="img/about.jpg" alt="About our school" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <p><?=$setting['about']?></p>
                <!--    <a href="#" class="btn btn-primary mt-3">Read More</a>  -->
                </div>
            </div>
			<div class="row ">
                <div class="col-lg-12">
                    <img src="img/rank.jpg" alt="our school ranking" class="img-fluid rounded" >
                </div>
            </div>
        </div>
    </section>

    <!-- Video Tour Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="section-title">Video Tour in <?=$setting['school_name']?></h2>
            <p class="mb-4">Take a tour in our university and discover why we're the best in the state. The video will take you to every place in this university.</p>
            <a href="#" class="btn btn-light btn-lg">Watch Video</a>
        </div>
    </section>

    <!-- Admissions Section -->
    <section id="admissions" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Apply for Admission</h2>
                    <p>We don't just give students an education and experiences that set them up for success in a career. We help them succeed in their career—to discover a field they're passionate about and dare to lead it.</p>
                    <a href="#" class="btn btn-primary">Apply Now</a>
                </div>
                <div class="col-lg-6">
                    <img src="img/admissions.jpg" alt="Admissions" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Education Services</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h4>International Hubs</h4>
                        <p>Global connections with partner institutions worldwide for student exchange programs.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h4>Bachelor's Degrees</h4>
                        <p>Comprehensive undergraduate programs across various disciplines.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Master's Degrees</h4>
                        <p>Advanced graduate programs designed for career advancement.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h4>Campus Life</h4>
                        <p>Vibrant residential life with modern facilities and support services.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title">Alumni Events</h2>
                <a href="#" class="btn btn-outline-primary">View All Events</a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card event-card">
                        <div class="row g-0">
                            <div class="col-md-2 bg-primary text-white d-flex align-items-center justify-content-center">
                                <div class="event-date">
                                    <span class="event-day">17</span>
                                    <span class="event-month">DEC</span>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">Fintech & Key Investment Conference</h5>
                                    <p class="card-text text-muted"><small><i class="far fa-clock"></i> 1:00 pm - 5:00 pm</small></p>
                                    <p class="card-text text-muted"><small><i class="fas fa-map-marker-alt"></i> <?=$setting['school_name']?> Grand Hall</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card event-card">
                        <div class="row g-0">
                            <div class="col-md-2 bg-primary text-white d-flex align-items-center justify-content-center">
                                <div class="event-date">
                                    <span class="event-day">20</span>
                                    <span class="event-month">JAN</span>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">Sport Management Information Webinar</h5>
                                    <p class="card-text text-muted"><small><i class="far fa-clock"></i> 1:00 pm - 3:00 pm</small></p>
                                    <p class="card-text text-muted"><small><i class="fas fa-map-marker-alt"></i> Online Event</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title">News & Updates</h2>
                <a href="#" class="btn btn-outline-primary">Read All News</a>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card news-card">
                        <img src="img/news1.jpg" class="card-img-top news-img" alt="News">
                        <div class="card-body">
                            <h5 class="card-title">Professor Albert joint research on mobile money in Tanzania</h5>
                            <p class="card-text">Groundbreaking research on financial inclusion in East Africa.</p>
                            <a href="#" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card news-card">
                        <img src="img/news2.jpg" class="card-img-top news-img" alt="News">
                        <div class="card-body">
                            <h5 class="card-title">A Global MBA for the next generation of business leaders</h5>
                            <p class="card-text">Our redesigned MBA program focuses on global leadership.</p>
                            <a href="#" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card news-card">
                        <img src="img/news3.jpg" class="card-img-top news-img" alt="News">
                        <div class="card-body">
                            <h5 class="card-title">Professor Tom comments on voluntary recalls by snack brands</h5>
                            <p class="card-text">Expert analysis on food safety and corporate responsibility.</p>
                            <a href="#" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="text-center section-title">Contact Us</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-4">
                        <h4><i class="fas fa-map-marker-alt me-2"></i> Address</h4>
                        <p>Box 35300<br>1810 Campus Way NE<br>Bothell, WA 98011-8246</p>
                    </div>
                    <div class="mb-4">
                        <h4><i class="fas fa-phone-alt me-2"></i> Phone</h4>
                        <p>+1-2534-4456-345</p>
                    </div>
                    <div class="mb-4">
                        <h4><i class="fas fa-envelope me-2"></i> Email</h4>
                        <p>admin@<?=strtolower(str_replace(' ', '', $setting['school_name']))?>.edu</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="post" action="req/contact.php">
                        <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$_GET['error']?>
                        </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?=$_GET['success']?>
                        </div>
                        <?php } ?>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><?=$setting['school_name']?></h5>
                    <p>We are one of the largest, most diverse universities with a commitment to excellence in education, research, and community engagement.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#academics">Academics</a></li>
                        <li><a href="#admissions">Admissions</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Academics</h5>
                    <ul>
                        <li><a href="#">Undergraduate Programs</a></li>
                        <li><a href="#">Graduate Programs</a></li>
                        <li><a href="#">Professional Studies</a></li>
                        <li><a href="#">Online Learning</a></li>
                        <li><a href="#">Academic Calendar</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <ul>
                        <li><i class="fas fa-map-marker-alt me-2"></i> 1810 Campus Way NE, Bothell, WA</li>
                        <li><i class="fas fa-phone-alt me-2"></i> +1-2534-4456-345</li>
                        <li><i class="fas fa-envelope me-2"></i> admin@<?=strtolower(str_replace(' ', '', $setting['school_name']))?>.edu</li>
                    </ul>
                </div>
            </div>
            <div class="copyright text-center">
                <p>&copy; <?=$setting['current_year']?> <?=$setting['school_name']?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php } else {
    header("Location: login.php");
    exit;
} ?>