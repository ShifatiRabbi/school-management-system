<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['course_id'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/subject.php";
        include "data/class.php";
        
        $course_id = $_GET['course_id'];
        $course = getSubjectById($course_id, $conn);
        $classes = getAllClasses($conn);
        $assigned_classes = getSubjectClasses($course_id, $conn);

        if ($course == 0) {
            header("Location: course.php");
            exit;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Subject</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <a href="course.php" class="btn btn-dark">Go Back</a>

        <form method="post" class="shadow p-3 mt-5 form-w" action="req/course-edit.php">
            <h3>Edit Subject</h3><hr>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_GET['error']?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?=$_GET['success']?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Subject Name</label>
                <input type="text" class="form-control" 
                       value="<?=$course['subject_name']?>" 
                       name="course_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Subject Code</label>
                <input type="text" class="form-control" 
                       value="<?=$course['subject_code']?>" 
                       name="course_code" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Classes for this Subject</label>
                <?php if ($classes != 0) { ?>
                    <div class="form-check">
                        <?php foreach ($classes as $class) { 
                            $checked = false;
                            if ($assigned_classes != 0) {
                                foreach ($assigned_classes as $ac) {
                                    if ($ac['class_id'] == $class['class_id']) {
                                        $checked = true;
                                        break;
                                    }
                                }
                            }
                        ?>
                            <div>
                                <input class="form-check-input" type="checkbox" 
                                       name="class_ids[]" 
                                       value="<?=$class['class_id']?>" 
                                       id="class_<?=$class['class_id']?>"
                                       <?=$checked ? 'checked' : ''?>>
                                <label class="form-check-label" for="class_<?=$class['class_id']?>">
                                    <?=$class['class_name']?> (<?=$class['discipline']?>)
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <p>No classes found.</p>
                <?php } ?>
            </div>
            <input type="hidden" name="course_id" value="<?=$course['subject_id']?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
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
        header("Location: course.php");
        exit;
    } 
} else {
    header("Location: course.php");
    exit;
}
?>