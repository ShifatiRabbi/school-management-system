<?php include "header.php"; 
include "admin/data/notice.php";
?>

<section class="py-5">
    <div class="container">
        <h2 class="section-title mb-5">All Notices</h2>
        <div class="table-responsive">
            <table class="table table-hover notice-table">
                <thead>
                    <tr>
                        <th scope="col">SI</th>
                        <th scope="col">Date</th>
                        <th scope="col">Notice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $notices = getAllNotices($conn);
                    // Sort notices in descending order by date
                    usort($notices, function ($a, $b) {
                        return strtotime($b['notice_date']) - strtotime($a['notice_date']);
                    });
                    $serial_number = 1;
                    foreach ($notices as $notice) {
                        $notice_date = new DateTime($notice['notice_date']);
                        $notice_url = "notice-details.php?id=" . urlencode($notice['notice_id']); // Link to a new page
                    ?>
                        <tr>
                            <td><?= $serial_number++ ?></td>
                            <td><?= $notice_date->format('Y-m-d') ?></td>
                            <td>
                                <?php if (!empty($notice['image_path'])) : ?>
                                    <a href="<?= htmlspecialchars($notice_url) ?>" target="_blank" class="notice-link">
                                        <?= htmlspecialchars($notice['title']) ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?= htmlspecialchars($notice_url) ?>" target="_blank" class="notice-link">
                                        <i class="fas fa-file-pdf pdf-icon"></i>
                                        <?= htmlspecialchars($notice['title']) ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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
