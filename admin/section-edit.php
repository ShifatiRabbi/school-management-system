<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['section_id'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/section.php";
        include "data/class.php";
        
        $section = getSectioById($_GET['section_id'], $conn);
        $classes = getAllClasses($conn);

        if ($section == 0) {
            header("Location: section.php");
            exit;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Section</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <a href="section.php" class="btn btn-dark">Go Back</a>

        <form method="post" class="shadow p-3 mt-5 form-w" action="req/section-edit.php">
            <h3>Edit Section</h3><hr>
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
                <label class="form-label">Class</label>
                <select name="class_id" class="form-control" required>
                    <?php foreach ($classes as $class) { ?>
                        <option value="<?=$class['class_id']?>" 
                            <?=$class['class_id'] == $section['class_id'] ? 'selected' : ''?>>
                            <?=$class['class_name']?> (<?=$class['discipline']?>)
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Section Name</label>
                <input type="text" class="form-control" 
                       value="<?=$section['section_name']?>" 
                       name="section_name" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Male Students</label>
                <input type="number" class="form-control" 
                       value="<?=$section['male_students']?>" 
                       name="male_students" min="0">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Female Students</label>
                <input type="number" class="form-control" 
                       value="<?=$section['female_students']?>" 
                       name="female_students" min="0">
            </div>
            
            <input type="hidden" name="section_id" value="<?=$section['section_id']?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
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
        header("Location: section.php");
        exit;
    } 
} else {
    header("Location: section.php");
    exit;
}
?>