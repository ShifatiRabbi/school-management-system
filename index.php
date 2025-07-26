<?php 
    include "header.php";
?>

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

    <!-- Video Tour Section --><!--
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="section-title">Video Tour in <?=$setting['school_name']?></h2>
            <p class="mb-4">Take a tour in our university and discover why we're the best in the state. The video will take you to every place in this university.</p>
            <a href="#" class="btn btn-light btn-lg">Watch Video</a>
        </div>
    </section>
    -->
    <!-- Admissions Section --><!--
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
    -->
    <!-- Services Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Education Services</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4>Experienced Teachers</h4>
                        <p>Highly qualified educators who delivering impactful and engaging instruction.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h4>Monthly Exam</h4>
                        <p>Regular assessments to ensure academic progress and concept clarity.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h4>Student Monetization</h4>
                        <p>Opportunities for students to earn through skills, projects, and internships.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h4>Co-curricular Activities</h4>
                        <p>Balanced growth through quiz, sports, arts, clubs, and leadership programs.</p>
                    </div>
                </div>
            </div>    
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title">Upcoming Events</h2>
                <a href="events.php" class="btn btn-outline-primary">View All Events</a>
            </div>
            <div class="row">
                <?php
                include "admin/data/event.php";
                $events = getAllEvents($conn, 4); // Show 2 events
                foreach ($events as $event) {
                    $event_date = new DateTime($event['event_date']);
                    $start_time = new DateTime($event['start_time']);
                    $end_time = new DateTime($event['end_time']);
                ?>
                <div class="col-md-6">
                    <div class="card event-card">
                        <div class="row g-0">
                            <div class="col-md-2 bg-primary text-white d-flex align-items-center justify-content-center">
                                <div class="event-date">
                                    <span class="event-day"><?= $event_date->format('d') ?></span>
                                    <span class="event-month"><?= strtoupper($event_date->format('M')) ?></span>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                                    <p class="card-text text-muted"><small>
                                        <i class="far fa-clock"></i> 
                                        <?= $start_time->format('g:i a') ?> - <?= $end_time->format('g:i a') ?>
                                    </small></p>
                                    <p class="card-text text-muted"><small>
                                        <i class="fas fa-map-marker-alt"></i> 
                                        <?= $event['is_online'] ? 'Online Event' : htmlspecialchars($event['location']) ?>
                                    </small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title">News & Updates</h2>
                <a href="news.php" class="btn btn-outline-primary">Read All News</a>
            </div>
            <div class="row">
                <?php
                include "admin/data/news.php";
                $news_items = getAllNews($conn, 3); // Show 3 news items
                foreach ($news_items as $news) {
                ?>
                <div class="col-md-4">
                    <div class="card news-card">
                        <?php if ($news['image_path']): ?>
                        <img src="<?= htmlspecialchars($news['image_path']) ?>" class="card-img-top news-img" alt="<?= htmlspecialchars($news['title']) ?>">
                        <?php else: ?>
                        <div class="news-img-placeholder"></div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($news['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($news['short_description']) ?></p>
                            <a href="news-detail.php?id=<?= $news['news_id'] ?>" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
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
                        <p>Dohar<br>Dhaka<br></p>
                    </div>
                    <div class="mb-4">
                        <h4><i class="fas fa-phone-alt me-2"></i> Phone</h4>
                        <p>01712334847</p>
                    </div>
                    <div class="mb-4">
                        <h4><i class="fas fa-envelope me-2"></i> Email</h4>
                        <p>admin@spahhs.edu</p>
                    </div>
                </div>
                <div class="contact-form">
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
                            <label for="full_name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Your Mobile</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" required></textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-send">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php 
include "footer.php";
?>