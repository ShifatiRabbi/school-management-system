<?php
include "header.php";
include "admin/data/notice.php";

// Check if a notice ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<section class='py-5'><div class='container'><p>Notice not found. Please go back to the list of notices.</p></div></section>";
    include "footer.php";
    exit;
}

$notice_id = $_GET['id'];

// Get the specific notice from the database
$notice = getNoticeById($conn, $notice_id);

// Check if the notice exists
if (!$notice) {
    echo "<section class='py-5'><div class='container'><p>Notice not found.</p></div></section>";
    include "footer.php";
    exit;
}

$notice_date = new DateTime($notice['notice_date']);
?>

<section class="py-5">
    <div class="container">
        <div class="notice-container">
            <div class="notice-header">
                <h1 class="notice-title"><?= htmlspecialchars($notice['title']) ?></h1>
                <p class="notice-date">Published on: <?= $notice_date->format('F d, Y') ?></p>
            </div>
            
            <hr>
            
            <div class="notice-content">
                <?php if (!empty($notice['image_path'])): ?>
                    <div class="text-center mb-4">
                        <img src="<?= htmlspecialchars($notice['image_path']) ?>" class="img-fluid notice-image-full" alt="<?= htmlspecialchars($notice['title']) ?>">
                    </div>
                <?php else: ?>
                    <div class="pdf-placeholder text-center mb-4">
                        <i class="fas fa-file-pdf fa-4x mb-3 text-danger"></i>
                        <p>This notice is available as a document.</p>
                    </div>
                <?php endif; ?>

                <p class="notice-description"><?= nl2br(htmlspecialchars($notice['description'])) ?></p>
            </div>
            
            <div class="d-flex justify-content-center mt-5">
                <a href="/notices" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>