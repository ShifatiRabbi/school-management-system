<?php
include "header.php";
include "admin/data/subject.php";
include "admin/data/class.php";

$subjects = getAllSubjects($conn);
?>
<div class="container mt-5">
    <?= alert_from_query() ?>

    <?php if ($subjects != 0) { ?>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Assigned Classes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subjects as $i => $subject) {
                        $assigned_classes = getSubjectClasses($subject['subject_id'], $conn);
                    ?>
                    <tr>
                        <th scope="row"><?= (int)($i + 1) ?></th>
                        <td><?= e($subject['subject_name'] ?? '') ?></td>
                        <td><?= e($subject['subject_code'] ?? '') ?></td>
                        <td>
                            <?php if ($assigned_classes != 0) {
                                $class_names = array_map(static function ($c) {
                                    return $c['class_name'];
                                }, $assigned_classes);
                                echo e(implode(', ', $class_names));
                            } else {
                                echo 'Not assigned';
                            } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-info mt-3" role="alert">
            No subjects found. Coming Soon!
        </div>
    <?php } ?>
</div>

<div class="mb-5 text-center">
    <a href="index.php" class="btn btn-outline-primary">Go Back Home</a>
</div>

<?php include "footer.php"; ?>
