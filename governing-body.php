<?php
include "header.php";
include "DB_connection.php";
include "admin/data/governing_body.php";

$members = getAllGoverningMembers($conn);
?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center section-title mb-5">Governing Body</h2>
        <div class="row justify-content-center">
            <?php foreach ($members as $member): ?>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card member-card h-100">
                        <div class="card-img-top">
                            <?php if (!empty($member['image_path'])): ?>
                                <img src="<?= htmlspecialchars($member['image_path']) ?>" class="member-img" alt="<?= htmlspecialchars($member['name']) ?>">
                            <?php else: ?>
                                <div class="img-placeholder">
                                    <i class="fas fa-user-circle fa-4x text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title mb-1"><?= htmlspecialchars($member['name']) ?></h5>
                            <p class="text-muted mb-2"><?= htmlspecialchars($member['role']) ?></p>
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="fas fa-phone me-2 text-muted"></i>
                                <a href="tel:<?= htmlspecialchars($member['contact']) ?>" class="text-decoration-none">
                                    <?= htmlspecialchars($member['contact']) ?>
                                </a>
                            </div>
                            <div class="mt-auto">
                                <span class="position-bdg-gb
                                    <?php
                                        switch ($member['position']) {
                                            case 'Chairman':
                                                echo 'bg-primary text-white';
                                                break;
                                            case 'Member Secretary':
                                                echo 'bg-info text-dark';
                                                break;
                                            case 'Guardians Representative':
                                                echo 'bg-warning text-dark';
                                                break;
                                            case 'Teachers Representative':
                                                echo 'bg-success text-white';
                                                break;
                                            case 'Bidyut Sahi Member':
                                                echo 'bg-secondary text-white';
                                                break;
                                            case 'Donor Member':
                                                echo 'bg-dark text-white';
                                                break;
                                            default:
                                                echo 'bg-light text-dark';
                                                break;
                                        }
                                    ?> ">
                                    <?= htmlspecialchars($member['position']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>