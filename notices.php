<?php include "header.php"; 
include "admin/data/notice.php";
?>

<section class="py-5">
    <div class="container">
        
        <h2 class="section-title mb-5">All Notices</h2>
        <div class="row">
            <?php
            $notices = getAllNotices($conn);
            foreach ($notices as $notice) {
                $notice_date = new DateTime($notice['notice_date']);
            ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card notice-card h-100">
                    <?php if (!empty($notice['image_path'])): ?>
                    <div class="notice-image-container">
                        <img src="<?= htmlspecialchars($notice['image_path']) ?>" class="card-img-top notice-image" alt="<?= htmlspecialchars($notice['title']) ?>">
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0"><?= htmlspecialchars($notice['title']) ?></h5>
                            <span class="badge bg-primary"><?= $notice_date->format('d M, Y') ?></span>
                        </div>
                        <p class="card-text notice-description"><?= htmlspecialchars(substr($notice['description'], 0, 100)) ?>...</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-sm btn-outline-primary notice-view-btn" data-id="<?= $notice['notice_id'] ?>">View Details</button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Notice Modal -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noticeModalBody">
                <!-- Content will be loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
