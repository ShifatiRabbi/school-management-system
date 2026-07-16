<?php include "header.php"; ?>

<section class="py-5">
    <div class="container">
        <h2 class="section-title mb-5">Latest News</h2>
        <div class="row">
            <?php
            include "admin/data/news.php";
            $news_items = getAllNews($conn);
            
            foreach ($news_items as $news) {
                $publish_date = new DateTime($news['publish_date']);
            ?>
            <div class="col-md-4 mb-4">
                <div class="card news-card h-100">
                    <?php if ($news['image_path']): ?>
                    <img src="<?= $news['image_path'] ?>" class="card-img-top news-img" alt="<?= htmlspecialchars($news['title']) ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <span class="badge bg-primary mb-2"><?= $news['news_category'] ?></span>
                        <h5 class="card-title"><?= htmlspecialchars($news['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($news['short_description']) ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?= $publish_date->format('M d, Y') ?></small>
                            <a href="news-detail.php?id=<?= $news['news_id'] ?>" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>