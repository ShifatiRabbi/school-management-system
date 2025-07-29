<?php 
include "header.php";

// Get latest gallery images from DB
$sql_images = "SELECT * FROM gallery_images WHERE file_type = 'image'";
$stmt_images = $conn->prepare($sql_images);
$stmt_images->execute();
$all_images = $stmt_images->fetchAll();

// Pick 10 random images
$images = [];
if (count($all_images) > 0) {
    $random_keys = array_rand($all_images, min(10, count($all_images)));
    if (is_array($random_keys)) {
        foreach ($random_keys as $key) {
            $images[] = $all_images[$key];
        }
    } else {
        $images[] = $all_images[$random_keys];
    }
}
?>
<div class="container">
    <div class="marquee-container">
        <div class="marquee-title">Latest Notices</div>
        <div class="marquee-content">
            <?php
            include "admin/data/notice.php";
            $latestNotices = getLatestNotices($conn, 3);
            foreach ($latestNotices as $notice) {
                echo '<span class="marquee-item">' . htmlspecialchars($notice['title']) . '</span>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Hero Slider Section -->
<section class="hero-slider-section">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <?php foreach ($images as $index => $image): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <div class="hero-slide" style="background-image: url('<?= $image['file_path'] ?>')">
                        <div class="hero-overlay d-flex flex-column justify-content-center align-items-center text-center text-white px-3">
                            <h1 class="display-4 fw-bold"><?= $setting['school_name'] ?></h1>
                            <p class="lead"><?= $setting['slogan'] ?></p>
                            <?php if (!empty($image['caption'])): ?>
                                <div class="bg-dark bg-opacity-50 rounded p-2 mt-3">
                                    <em><?= htmlspecialchars($image['caption']) ?></em>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($images) > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        <?php endif; ?>
    </div>
</section>

<!-- Quick Links Section -->
<section class="quick-links-section">
    <div class="container">
        <h2 class="text-center section-title">Quick Access</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">

            <div class="col">
                <a href="basic-info" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-info-circle"></i>
                    <span>School Details</span>
                </a>
            </div>

            <div class="col">
                <a href="people_info" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-user-friends"></i>
                    <span>Teacher Staff Student</span>
                </a>
            </div>

            <div class="col">
                <a href="teacher-info" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>All Teachers</span>
                </a>
            </div>
            
            <div class="col">
                <a href="student-info" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-user-graduate"></i>
                    <span>All Students</span>
                </a>
            </div>

            <div class="col">
                <a href="governing-body" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-users-cog"></i>
                    <span>Governing Body</span>
                </a>
            </div>

            <div class="col">
                <a href="ragistrar-office" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-file-signature"></i>
                    <span>Registrar Office</span>
                </a>
            </div>

            <div class="col">
                <a href="events" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Events</span>
                </a>
            </div>

            <div class="col">
                <a href="news" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-bullhorn"></i>
                    <span>News</span>
                </a>
            </div>

            <div class="col">
                <a href="notices" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-bell"></i>
                    <span>Notices</span>
                </a>
            </div>

            <div class="col">
                <a href="gallery" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
                </a>
            </div>

            <div class="col">
                <a href="all-subject" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-book-open"></i>
                    <span>All Subjects</span>
                </a>
            </div>
            
            <div class="col">
                <a href="class-info" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-school"></i>
                    <span>Class</span>
                </a>
            </div>

            <div class="col">
                <a href="routine" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-bell"></i>
                    <span>Routine</span>
                </a>
            </div>

            <div class="col">
                <a href="public_results_ssc" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-chart-line"></i>
                    <span>Public Results</span>
                </a>
            </div>

            <div class="col">
                <a href="contact" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-envelope"></i>
                    <span>Message</span>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <h2 class="text-center section-title">Education Services</h2>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h4>Experienced Teachers</h4>
                    <p>Highly qualified educators delivering impactful and engaging instruction.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4>Monthly Exam</h4>
                    <p>Regular assessments to ensure academic progress and concept clarity.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h4>Student Monetization</h4>
                    <p>Opportunities for students to earn through skills, projects, and internships.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
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
<section class="events-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title">Upcoming Events</h2>
            <a href="events.php" class="btn btn-outline-primary">View All Events</a>
        </div>
        <div class="row">
            <?php
            include "admin/data/event.php";
            $events = getAllEvents($conn, 4); // Show 4 events
            foreach ($events as $event) {
                $event_date = new DateTime($event['event_date']);
                $start_time = new DateTime($event['start_time']);
                $end_time = new DateTime($event['end_time']);
            ?>
            <div class="col-md-6 mb-3">
                <div class="card event-card h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-3">
                            <div class="event-date h-100 d-flex flex-column justify-content-center">
                                <span class="event-day"><?= $event_date->format('d') ?></span>
                                <span class="event-month"><?= strtoupper($event_date->format('M')) ?></span>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body h-100 d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                                <p class="card-text text-muted mb-2">
                                    <i class="far fa-clock me-2"></i>
                                    <?= $start_time->format('g:i a') ?> - <?= $end_time->format('g:i a') ?>
                                </p>
                                <p class="card-text text-muted mt-auto">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <?= $event['is_online'] ? 'Online Event' : htmlspecialchars($event['location']) ?>
                                </p>
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
<section class="news-section">
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
                <div class="card news-card h-100">
                    <?php if ($news['image_path']): ?>
                    <img src="<?= htmlspecialchars($news['image_path']) ?>" class="card-img-top news-img" alt="<?= htmlspecialchars($news['title']) ?>">
                    <?php else: ?>
                    <div class="news-img-placeholder d-flex align-items-center justify-content-center">
                        <i class="fas fa-newspaper fa-3x text-muted"></i>
                    </div>
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($news['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($news['short_description']) ?></p>
                        <a href="news-detail.php?id=<?= $news['news_id'] ?>" class="btn btn-sm btn-primary mt-auto align-self-start">Read More</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Events Section -->
<section class="events-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title">Gallery</h2>
            <a href="gallery" class="btn btn-outline-primary">View Full Gallery</a>
        </div>

        <?php
        // Fetch and randomize 6 images
        $sql = "SELECT * FROM gallery_images WHERE file_type = 'image'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $allImages = $stmt->fetchAll();

        $galleryImages = [];
        if (count($allImages) > 0) {
            $randomKeys = array_rand($allImages, min(6, count($allImages)));
            if (is_array($randomKeys)) {
                foreach ($randomKeys as $key) {
                    $galleryImages[] = $allImages[$key];
                }
            } else {
                $galleryImages[] = $allImages[$randomKeys];
            }
        }
        ?>

        <div class="row">
            <?php foreach ($galleryImages as $image): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="<?= htmlspecialchars($image['file_path']) ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($image['caption']) ?>" 
                             style="height: 200px; object-fit: cover;">
                        <?php if (!empty($image['caption'])): ?>
                            <div class="card-body p-2">
                                <p class="card-text text-muted small"><?= htmlspecialchars($image['caption']) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="text-center section-title">Contact Us</h2>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="contact-info">
                    <h4><i class="fas fa-map-marker-alt me-2"></i> Address</h4>
                    <p class="mb-4">Dohar<br>Dhaka<br></p>
                    
                    <h4><i class="fas fa-phone-alt me-2"></i> Phone</h4>
                    <p class="mb-4">01712334847</p>
                    
                    <h4><i class="fas fa-envelope me-2"></i> Email</h4>
                    <p>admin@spahhs.edu</p>
                </div>
            </div>
            <div class="col-lg-7">
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
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="full_name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="col-12">
                                <label for="mobile" class="form-label">Your Mobile</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile" required>
                            </div>
                            
                            <div class="col-12">
                                <label for="message" class="form-label">Your Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            
                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-send">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
include "footer.php";
?>