<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/section.php";
        include "data/class.php";
        
        $sections = getAllSections($conn);
        $classes = getAllClasses($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sections</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <a href="section-add.php" class="btn btn-dark">Add New Section</a>

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

        <?php if ($sections != 0) { ?>
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Class</th>
                            <th scope="col">Section Name</th>
                            <th scope="col">Male Students</th>
                            <th scope="col">Female Students</th>
                            <th scope="col">Total Students</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sections as $i => $section) { 
                            $total = $section['male_students'] + $section['female_students'];
                        ?>
                        <tr>
                            <th scope="row"><?=$i+1?></th>
                            <td><?=$section['class_name']?></td>
                            <td><?=$section['section_name']?></td>
                            <td><?=$section['male_students']?></td>
                            <td><?=$section['female_students']?></td>
                            <td><?=$total?></td>
                            <td>
                                <a href="section-edit.php?section_id=<?=$section['section_id']?>" class="btn btn-warning">Edit</a>
                                <a href="section-delete.php?section_id=<?=$section['section_id']?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-info mt-3" role="alert">
                No sections found. Add your first section!
            </div>
        <?php } ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(5) a").addClass('active');
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