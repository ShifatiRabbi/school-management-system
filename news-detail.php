<?php
include "header.php";
include_once "admin/data/news.php";

if (isset($_GET['id'])) {
    $news = getNewsById($conn, $_GET['id']);
    if (!$news) {
        header("Location: news.php");
        exit;
    }
} else {
    header("Location: news.php");
    exit;
}
?>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <article>
                        <header class="mb-4">
                            <h1 class="fw-bolder mb-1"><?= htmlspecialchars($news['title']) ?></h1>
                            <div class="text-muted fst-italic mb-2">
                                Posted on <?= date('F j, Y', strtotime($news['publish_date'])) ?>
                                <?php if ($news['author']): ?>
                                by <?= htmlspecialchars($news['author']) ?>
                                <?php endif; ?>
                            </div>
                            <span class="badge bg-secondary"><?= $news['news_category'] ?></span>
                        </header>
                        
                        <?php if ($news['image_path']): ?>
                        <figure class="mb-4">
                            <img class="img-fluid rounded" src="<?= $news['image_path'] ?>" alt="<?= htmlspecialchars($news['title']) ?>" />
                        </figure>
                        <?php endif; ?>
                        
                        <section class="mb-5">
                            <?= nl2br(htmlspecialchars($news['content'])) ?>
                        </section>
                    </article>
                    
                    <div class="text-center mt-4">
                        <a href="news.php" class="btn btn-primary">Back to News</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "footer.php"; ?>
