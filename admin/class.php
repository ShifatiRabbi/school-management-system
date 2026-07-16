<?php
require_once __DIR__ . '/../app/bootstrap.php';

if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/class.php";
        $classes = getAllClasses($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Classes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <a href="class-add.php" class="btn btn-dark">Add New Class</a>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" role="alert">
                <?= e($_GET['error'] ?? '') ?>
                </div>

        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" role="alert">
                <?= e($_GET['error'] ?? '') ?></div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" role="alert">
                <?= e($_GET['error'] ?? '') ?></div>
        <?php } ?>

        <?php if ($classes != 0) { ?>
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Class Name</th>
                            <th scope="col">Discipline</th>
                            <th scope="col">Sections</th>
                            <th scope="col">Students</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($classes as $i => $class) { 
                            $sections = getSectionsByClass($class['class_id'], $conn);
                            $totalStudents = getTotalStudentsInClass($class['class_id'], $conn);
                        ?>
                        <tr>
                            <th scope="row"><?=$i+1?></th>
                            <td><?=$class['class_name']?></td>
                            <td><?=$class['discipline']?></td>
                            <td><?=($sections != 0) ? count($sections) : 0?></td>
                            <td><?=$totalStudents?></td>
                            <td>
                                <a href="class-edit.php?class_id=<?=$class['class_id']?>" class="btn btn-warning">Edit</a>
                                <form method="post" action="class-delete.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
<?= csrf_field() ?>
<input type="hidden" name="class_id" value="<?=$class['class_id']?>">
<button type="submit" class="btn btn-danger">Delete</button>
</form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-info mt-3" role="alert">
                No classes found. Add your first class!
            </div>
        <?php } ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(6) a").addClass('active');
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
