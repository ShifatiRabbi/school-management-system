<?php include "header.php";
include "DB_connection.php";
include "admin/data/class.php";
include "admin/data/section.php";
include "admin/data/routine.php";

$classes = getAllClasses($conn);
$selectedClass = isset($_GET['class_id']) ? $_GET['class_id'] : null;
$selectedSection = isset($_GET['section_id']) ? $_GET['section_id'] : null;
$routine = null;

if ($selectedClass && $selectedSection) {
    $routine = getRoutineByClassSection($conn, $selectedClass, $selectedSection);
}
?>

<section class="py-5">
    <div class="container">
        <h2 class="text-center section-title mb-5">Class Routine</h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form method="get" class="card shadow-sm p-4 mb-5">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="class_id" class="form-label">Select Class</label>
                            <select class="form-select" id="class_id" name="class_id" required>
                                <option value="">Select Class</option>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?=$class['class_id']?>" <?=$selectedClass==$class['class_id']?'selected':''?>>
                                        <?=$class['class_name']?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="section_id" class="form-label">Select Section</label>
                            <select class="form-select" id="section_id" name="section_id" required <?=!$selectedClass?'disabled':''?>>
                                <option value="">Select Section</option>
                                <?php if ($selectedClass): 
                                    $sections = getSectionsByClass($selectedClass, $conn);
                                    foreach ($sections as $section): ?>
                                        <option value="<?=$section['section_id']?>" <?=$selectedSection==$section['section_id']?'selected':''?>>
                                            <?=$section['section_name']?>
                                        </option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary px-4">Show Routine</button>
                        </div>
                    </div>
                </form>
                
                <?php if ($selectedClass && $selectedSection): ?>
                    <?php if ($routine): ?>
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">
                                    <?php 
                                        $class = getClassById($selectedClass, $conn);
                                        $section = getSectioById($selectedSection, $conn);
                                        echo htmlspecialchars($class['class_name']) . ' - ' . htmlspecialchars($section['section_name']);
                                    ?>
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <img src="<?=htmlspecialchars($routine['routine_image'])?>" class="img-fluid" alt="Class Routine" style="max-height: 80vh;">
                            </div>
                            <div class="card-footer text-muted">
                                <small>Last updated: <?=date('M d, Y', strtotime($routine['upload_date']))?></small>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info text-center py-4" role="alert">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <h4>No routine found</h4>
                            <p class="mb-0">The routine for this class and section has not been uploaded yet.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Class-Section dynamic dropdown
    $('#class_id').change(function() {
        const classId = $(this).val();
        if (classId) {
            $('#section_id').prop('disabled', false);
            $.ajax({
                url: 'admin/req/get-sections.php',
                type: 'GET',
                data: { class_id: classId },
                success: function(data) {
                    $('#section_id').html(data);
                }
            });
        } else {
            $('#section_id').prop('disabled', true).html('<option value="">Select Section</option>');
        }
    });
</script>