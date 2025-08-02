<?php 
include "header.php";
include "admin/data/teacher.php";
include "admin/data/subject.php";
include "admin/data/class.php";

$teachers = getAllTeachers($conn);
?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center section-title mb-5">Our Teachers</h2>
        
        <form action="teacher-search.php" class="mb-5" method="get">
            <div class="input-group shadow-sm">
                <input type="text" class="form-control form-control-lg" name="searchKey" placeholder="Search teachers..." required>
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?=$_GET['error']?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?=$_GET['success']?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="row">
            <?php if ($teachers != 0) { 
                foreach ($teachers as $teacher) { 
                    $subjects = [];
                    if (!empty($teacher['subjects'])) {
                        $subjectIds = explode(',', $teacher['subjects']);
                        foreach ($subjectIds as $subjectId) {
                            $subject = getSubjectById($subjectId, $conn);
                            if ($subject) $subjects[] = $subject['subject_name'];
                        }
                    }
            ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card teacher-card h-100">
                    <div class="card-img-top position-relative">
                        <?php if (!empty($teacher['image_path'])): ?>
                            <img src="admin/<?=$teacher['image_path']?>" class="teacher-img" alt="<?=$teacher['fname']?> <?=$teacher['lname']?>">
                        <?php else: ?>
                            <div class="teacher-img-placeholder">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        <?php endif; ?>
                        <span class="position-badge bg-<?= 
                            strpos($teacher['designation'], 'Head') !== false ? 'primary' : 
                            (strpos($teacher['designation'], 'Senior') !== false ? 'info' : 'success') ?>">
                            <?=$teacher['designation']?>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-1"><?=$teacher['fname']?> <?=$teacher['lname']?></h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-book me-2"></i>
                            <?=!empty($subjects) ? implode(', ', $subjects) : 'Not assigned'?>
                        </p>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone me-2 text-muted"></i>
                            <a href="tel:<?=$teacher['phone_number']?>" class="text-decoration-none">
                                <?=$teacher['phone_number']?>
                            </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope me-2 text-muted"></i>
                            <a href="mailto:<?=$teacher['email_address']?>" class="text-decoration-none">
                                <?=$teacher['email_address']?>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="teacher-view.php?teacher_id=<?=$teacher['teacher_id']?>" class="btn btn-sm btn-outline-primary">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
            <?php } 
            } else { ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-4" role="alert">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>No teachers found</h4>
                    <p class="mb-0">Please check back later or contact the administration</p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>