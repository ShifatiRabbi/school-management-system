<?php 
    include "header.php";
    include "admin/data/subject.php";
    include "admin/data/class.php";
    
    $subjects = getAllSubjects($conn);
?>
    <div class="container mt-5">
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" role="alert">
                <?=$_GET['error']?>
            </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" role="alert">
                <?=$_GET['success']?>
            </div>
        <?php } ?>

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
                            <th scope="row"><?=$i+1?></th>
                            <td><?=$subject['subject_name']?></td>
                            <td><?=$subject['subject_code']?></td>
                            <td>
                                <?php if ($assigned_classes != 0) { 
                                    $class_names = array_map(function($c) {
                                        return $c['class_name'];
                                    }, $assigned_classes);
                                    echo implode(', ', $class_names);
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
                No subjects found. Comming Soon!
            </div>
        <?php } ?>
    </div>

<div class="mb-5" style="justify-self: center;">
    <a href="index.php" class="btn btn-outline-primary">Go Back Home</a>
</div>

<?php 
include "footer.php";
?>