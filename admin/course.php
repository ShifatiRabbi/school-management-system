<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/subject.php";
        include "data/class.php";
        
        $subjects = getAllSubjects($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Subjects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <a href="course-add.php" class="btn btn-dark">Add New Subject</a>

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
                            <th scope="col">Action</th>
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
                            <td>
                                <a href="course-edit.php?course_id=<?=$subject['subject_id']?>" 
                                   class="btn btn-warning">Edit</a>
                                <a href="course-delete.php?course_id=<?=$subject['subject_id']?>" 
                                   class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-info mt-3" role="alert">
                No subjects found. Add your first subject!
            </div>
        <?php } ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(8) a").addClass('active');
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