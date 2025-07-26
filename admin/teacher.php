<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/class.php";
        
        $teachers = getAllTeachers($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Teachers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="teacher-add.php" class="btn btn-dark">Add New Teacher</a>
            <div>
                <a href="req/teacher-export.php" class="btn btn-success me-2">
                    <i class="fas fa-file-export"></i> Export CSV
                </a>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-file-import"></i> Import CSV
                </button>
            </div>
        </div>

        <!-- Import Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="req/teacher-import.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Import Teachers from CSV</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="csvFile" class="form-label">Select CSV File</label>
                                <input class="form-control" type="file" id="csvFile" name="csvFile" accept=".csv" required>
                            </div>
                            <div class="alert alert-info">
                                <small>CSV format should match the exported file structure. <a href="sample/teacher_sample.csv" download>Download sample CSV</a></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
            <div class="table-responsive">
                <table class="table table-bordered mt-3 table-hover">
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teachers as $i => $teacher) { ?>
                        <tr>
                            <th scope="row"><?=$i+1?></th>
                            <td><?=$teacher['teacher_id']?></td>
                            <td>
                                <a href="teacher-view.php?teacher_id=<?=$teacher['teacher_id']?>">
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
                            <td>
                                <a href="teacher-edit.php?teacher_id=<?=$teacher['teacher_id']?>" 
                                   class="btn btn-warning btn-sm">
                                   <i class="fas fa-edit"></i>
                                </a>
                                <a href="teacher-delete.php?teacher_id=<?=$teacher['teacher_id']?>" 
                                   class="btn btn-danger btn-sm">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-info .w-450 m-5" role="alert">
                No teachers found.
            </div>
        <?php } ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(2) a").addClass('active');
        });
    </script>
</body>
</html>
<?php 
    } else {
        header("Location: ../login.php");
        exit;
    } 
} else {
    header("Location: ../login.php");
    exit;
}
?>