<?php 
    include "header.php";
    include "admin/data/teacher.php";
    include "admin/data/subject.php";
    include "admin/data/class.php";
    
    $teachers = getAllTeachers($conn);
?>

    <div class="container mt-5" style="min-height: 500px;">

        <form action="teacher-search.php" class="mt-3 n-table" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="searchKey" placeholder="Search..." style="height: 50px;">
                <button class="btn btn-primary" style="height: 50px; width: 100px;">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </form>

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

        <?php if ($teachers != 0) { ?>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Teacher Index</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Subjects</th>
                            <th scope="col">Classes</th>
                            <th scope="col">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teachers as $i => $teacher) { ?>
                        <tr>
                            <th scope="row"><?=$i+1?></th>
                            <td><?=$teacher['teacher_id']?></td>
                            <td>
                                <a style="text-decoration: none;" href="teacher-view.php?teacher_id=<?=$teacher['teacher_id']?>">
                                    <?=$teacher['fname']?> <?=$teacher['lname']?>
                                </a>
                            </td>
                            <td><?=$teacher['teacher_index']?></td>
                            <td><?=$teacher['designation']?></td>
                            <td>
                                <?php 
                                    $subjectNames = [];
                                    if (!empty($teacher['subjects'])) {
                                        $subjectIds = explode(',', $teacher['subjects']);
                                        foreach ($subjectIds as $subjectId) {
                                            $subject = getSubjectById($subjectId, $conn);
                                            if ($subject) {
                                                $subjectNames[] = $subject['subject_name'];
                                            }
                                        }
                                    }
                                    echo implode(', ', $subjectNames);
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $classNames = [];
                                    if (!empty($teacher['classes_assigned'])) {
                                        $classIds = explode(',', $teacher['classes_assigned']);
                                        foreach ($classIds as $classId) {
                                            $class = getClassById($classId, $conn);
                                            if ($class) {
                                                $classNames[] = $class['class_name'];
                                            }
                                        }
                                    }
                                    echo implode(', ', $classNames);
                                ?>
                            </td>
                            <td><?=$teacher['phone_number']?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-info mt-3" role="alert">
                No teachers found.
            </div>
        <?php } ?>
    </div>
    
<?php 
    include 'footer.php'
?>