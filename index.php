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
<div class="notice-bar bg-light py-2">
    <div class="container d-flex align-items-center">
        <div class="notice-label bg-primary text-white px-3 py-2 me-2 rounded-start">
            <strong>নোটিশঃ</strong>
        </div>
        <div class="marquee-wrapper overflow-hidden flex-grow-1">
            <div class="marquee-content d-flex align-items-center">
                <?php
                include "admin/data/notice.php";
                $latestNotices = getLatestNotices($conn, 5);
                foreach ($latestNotices as $notice) {
                    echo '<span class="marquee-item me-4"><i class="fas fa-bullhorn text-primary me-2"></i>' 
                        . htmlspecialchars($notice['title']) . '</span>';
                }
                ?>
            </div>
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

<!-- About Section -->
<section id="about" class="about-section mt-5">
    <div class="container">
        <h2 class="text-center section-title">About <?=$setting['school_name']?></h2>
        <div class="row ">
            <div class="col-lg-6">
                <img src="img/spahhs.jpeg" 
                alt="About our school" 
                class="img-fluid rounded clickable-image" 
                width="100%" 
                style="height: 350px; cursor: pointer;" 
                data-bs-toggle="modal" 
                data-bs-target="#aboutImageModal">
            </div>
            <div class="col-lg-6">
                <p>সুতারপাড়া আব্দুল হামেদ উচ্চ বিদ্যালয় (EIIN: 107986) একটি স্বনামধন্য মাধ্যমিক স্তরের শিক্ষাপ্রতিষ্ঠান, যা ১২ ফেব্রুয়ারি, ১৯৮৭ সালে প্রতিষ্ঠিত হয়। এটি স্থানীয়ভাবে "সুতারপাড়া আব্দুল হামেদ উচ্চ বিদ্যালয়" নামে পরিচিত এবং শিক্ষার্থীদের কাছে খুবই জনপ্রিয়।
                <br><br>
                বিদ্যালয়টি ১ জানুয়ারি, ১৯৯১ সালে সরকারি স্বীকৃতি লাভ করে। এটি ঢাকা শিক্ষা বোর্ডের অধীনে পরিচালিত হয় এবং বর্তমানে এটি বিজ্ঞান, মানবিক এবং ব্যবসায় শিক্ষা বিভাগে পাঠদান করে। বিদ্যালয়টি একটি সম্মিলিত (ছেলে-মেয়ে উভয়ের জন্য) শিক্ষা প্রতিষ্ঠান এবং এখানে শুধুমাত্র দিনের বেলায় ক্লাস পরিচালিত হয়।
                <br><br>
                এই বিদ্যালয়টি সরকার কর্তৃক স্বীকৃত এবং শিক্ষকগণ সরকারি বেতনের আওতায় (MPO) অন্তর্ভুক্ত রয়েছেন, যার নিবন্ধন নম্বর ২৬০৫১১৩০৫। </p>
                <a href="about" class="btn btn-outline-primary">Read More</a>
            </div>
        </div>
    </div>
</section>
<!-- Fullscreen Image Modal -->
<div class="modal fade" id="aboutImageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 position-relative">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        <img src="img/spahhs.jpeg" alt="Enlarged school image" class="img-fluid w-100 rounded">
      </div>
    </div>
  </div>
</div>

<!-- Head teacher and Chairman Say -->
<section class="leaders-section py-5">
  <div class="container">
    <div class="row g-4">
      
      <!-- Head Teacher Card -->
      <div class="col-md-6">
        <div class="card h-100 shadow-sm rounded-3 border">
          <div class="card-body">
            <div class="d-flex align-items-start mb-3">
              <img src="img/head-teacher.jpeg" alt="Head Teacher" class="rounded border me-3" style="width: 90px; height: 120px; object-fit: cover;">
              <div>
                <h4 class="mb-1 fw-bold text-uppercase">নগেন্দ্র কুমার সিংহ</h4>
                <h6 class="text-muted">Head Teacher</h6>
              </div>
            </div>
            <hr>
            <p>
                শিক্ষাই শক্তি শিক্ষাই আলো। কাজেই শিক্ষা অর্জন করা মানুষের মৌলিক অধিকার। এ অধিকারকে যথাযথভাবে বাস্তবায়নের মাধ্যমে বিশ্বের অনেক দেশ আজ উন্নত দেশ হিসেবে উন্নতির চরম শিখরে আরোহণ করেছে।
                <br>এ ক্ষেত্রে বাংলাদেশ তার কাঙ্ক্ষিত লক্ষ্য অর্জনে সাধ্যমত চেষ্টা চালিয়ে যাচ্ছে। যুগের সাথে তাল মিলিয়ে আমরা প্রত্যেকেই নিজ নিজ সন্তানদের বাস্তবমুখী শিক্ষায় গড়ে তুলতে আগ্রহী। প্রকৃতির সন্তান মানব শিশুকে পরিশুদ্ধ হতে হয়, পরিপুর্ণ হতে হয় স্বীয় পরিকল্পনায়। এ ক্ষেত্রে শিক্ষাই হলো আমাদের প্রধান চালিকা শক্তি। আমরা দৃঢ়ভাবে বিশ্বাস করি শিক্ষার মৌলিক উদ্দেশ্য হলো আচরণগত পরিবর্তন। আর এ লক্ষ্যে তাদেরকে সৃজনশীল, স্বাধীন, সক্রিয় এবং দায়িত্বশীল সুনাগরিক হিসেবে গড়ে তোলা।
                <br>এ জন্য প্রয়োজন যোগ্য শিক্ষকমন্ডলী এবং উপযুক্ত শিক্ষাদান পদ্ধতির সমন্বয়ে একটি শিক্ষাবান্ধব পরিবেশ। আমি দৃঢ়তার সাথে দাবী করি, বিদ্যালয়ে এসব কিছুর সমন্বয় ঘটানো সম্ভব হয়েছে। শিক্ষার্থীদের দুর্বল প্রতিভা সহজে বিকাশের জন্য প্রতিষ্ঠানটিতে রয়েছে সাধারণ শিক্ষার পাশাপাশি কম্পিউটার শিক্ষা, সাংস্কৃতিক, আনুষ্ঠানিক, খেলাধুলাসহ নানাবিধ শিক্ষা উপকরণ।
            </p>
          </div>
        </div>
      </div>

      <!-- Chairman Card -->
      <div class="col-md-6">
        <div class="card h-100 shadow-sm rounded-3 border">
          <div class="card-body">
            <div class="d-flex align-items-start mb-3">
              <img src="img/head-teacher.jpeg" alt="Chairman" class="rounded border me-3" style="width: 90px; height: 120px; object-fit: cover;">
              <div>
                <h4 class="mb-1 fw-bold text-uppercase">KANIK CHANDRA SHARMA</h4>
                <h6 class="text-muted">Chairman</h6>
              </div>
            </div>
            <hr>
            <p>
                শিক্ষাই জাতীর মেরুদন্ড। শিক্ষাই গতি, শিক্ষাই করবে দূর জগতের যত অন্ধকার। শিক্ষাই পারে তথ্য প্রযুক্তির সঠিক ব্যবহার ও বাস্তবায়নের মাধ্যমে মানুষের জীবনযাত্রাকে আধুনিক ও উন্নত করতে পারে।  
                <br>এ প্রতিষ্ঠানের অগ্রযাত্রাকে আরো যুগোপযোগী ও আধুনিক করার উদ্দেশ্যে বিভিন্ন প্রকল্প হাতে নেয়া হয়েছে। একটি আর্ন্তজাতিক মানসম্পন্ন ওয়েবসাইট চালুকরণ তার একটি প্রয়াস মাত্র। যার মাধ্যমে আমাদের প্রতিষ্ঠানের বিভিন্ন তথ্য ও ছবি বিশ্বব্যাপী ছড়িয়ে পড়বে এবং প্রতিষ্ঠানের ছত্র-ছাত্রীরা বাড়িতে বসেই পরীক্ষার রুটিন, সিলেবাস, ভর্তি ফরম ইত্যাদি পাবে। অভিভাবকরাও বাড়িতে বসেই উত্তরোত্তর তাদের সন্তানের পরীক্ষার ফলাফল, আচরণিক পরিবর্তন, সাফল্য সম্পর্কে জানতে পারবেন। 
                <br>পাশাপাশি শিক্ষক-শিক্ষার্থী ও অভিভাবকদের মধ্যে সুসম্পর্ক তৈরি হবে এবং বিদ্যালয়ের প্রাক্তন, বর্তমান ও অনাগত শিক্ষক-শিক্ষাথী, অভিভাবক, শুভানুধ্যায়ী, মহৎপ্রাণ ব্যক্তিগণ তাদের প্রিয় প্রতিষ্ঠানের ইতিহাস, ঐতিহ্য, শিক্ষক-শিক্ষার্থীদের তথ্য, বিভিন্ন অর্জন, বিজ্ঞপ্তি ও অন্যান্য তথ্য সমূহ দেখে উপকৃত হবেন।  এতে এ প্রতিষ্ঠানের সামগ্রিক মানোন্নয়নে একটি নতুন মাত্রিকতা যোগ হবে বলে আমার দৃঢ় বিশ্বাস। তাই এই প্রতিষ্ঠান সংশ্লিষ্ট সকলকে শুভেছা জানিয়ে এ ওয়েবসাইটের শুভ সূচনালগ্নে শুভকামনা করছি।
            </p>
          </div>
        </div>
      </div>

    </div>
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
                    <i class="fas fa-newspaper"></i>
                    <span>Notices</span>
                </a>
            </div>

            <div class="col">
                <a href="gallery" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-images"></i>
                    <span>Image Gallery</span>
                </a>
            </div>

            <div class="col">
                <a href="video-gallery" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-video"></i>
                    <span>Video Gallery</span>
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
            
            <div class="col">
                <a href="ragistrar-office" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-file-signature"></i>
                    <span>Registrar Office</span>
                </a>
            </div>
            <div class="col">
                <a href="library" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-book"></i>
                    <span>Library</span>
                </a>
            </div>
            <div class="col">
                <a href="ict-lab" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-desktop"></i>
                    <span>Ict Lab</span>
                </a>
            </div>
            <div class="col">
                <a href="play-ground" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-futbol"></i>
                    <span>Play Ground</span>
                </a>
            </div>
            <div class="col">
                <a href="vission&mission" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                    <i class="fa-solid fa-person-circle-question"></i>
                    <span>Mission & Vission</span>
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

<!-- Gallery Section -->
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
                             style="height: 300px; object-fit: cover;">
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
                    <p class="mb-4">Dohar, Dhaka<br></p>
                    
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

<!-- map Section -->
<section class="map-section py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-4">Our Location</h2>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="map-container ratio ratio-16x9">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.295777983086!2d90.14126997388676!3d23.593722994776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37558fe725fa5f01%3A0x8cdc75d8a08a0a7!2sSutarpara%20Abdul%20Hamid%20High%20School!5e0!3m2!1sen!2sbd!4v1753982696282!5m2!1sen!2sbd" 
                        width="600" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>


<?php 
include "footer.php";
?>