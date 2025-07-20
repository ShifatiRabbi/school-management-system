<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['class_id'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/class.php";
        include "data/section.php";
        include "data/subject.php";

        $class = getClassById($_GET['class_id'], $conn);
        $sections = getSectionsByClass($_GET['class_id'], $conn);
        $all_subjects = getAllSubjects($conn);
        $class_subjects = getClassSubjects($_GET['class_id'], $conn);

        if ($class == 0) {
            header("Location: class.php");
            exit;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Class</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <a href="class.php" class="btn btn-dark">Go Back</a>

        <form method="post" class="shadow p-3 mt-5 form-w" action="req/class-edit.php">
            <h3>Edit Class</h3><hr>
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
                <label class="form-label">Class Name</label>
                <input type="text" class="form-control" 
                       value="<?=$class['class_name']?>" 
                       name="class_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Discipline</label>
                <select name="discipline" class="form-control" required>
                    <option value="None" <?=$class['discipline'] == 'None' ? 'selected' : ''?>>None</option>
                    <option value="Science" <?=$class['discipline'] == 'Science' ? 'selected' : ''?>>Science</option>
                    <option value="Humanities" <?=$class['discipline'] == 'Humanities' ? 'selected' : ''?>>Humanities</option>
                    <option value="Business Studies" <?=$class['discipline'] == 'Business Studies' ? 'selected' : ''?>>Business Studies</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Subjects for this Class</label>
                <?php if ($all_subjects != 0) { ?>
                    <div class="form-check">
                        <?php foreach ($all_subjects as $subject) { 
                            $checked = false;
                            if ($class_subjects != 0) {
                                foreach ($class_subjects as $cs) {
                                    if ($cs['subject_id'] == $subject['subject_id']) {
                                        $checked = true;
                                        break;
                                    }
                                }
                            }
                        ?>
                            <div>
                                <input class="form-check-input" type="checkbox" 
                                       name="subject_ids[]" 
                                       value="<?=$subject['subject_id']?>" 
                                       id="subject_<?=$subject['subject_id']?>"
                                       <?=$checked ? 'checked' : ''?>>
                                <label class="form-check-label" for="subject_<?=$subject['subject_id']?>">
                                    <?=$subject['subject_name']?> (<?=$subject['subject_code']?>)
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <p>No subjects found.</p>
                <?php } ?>
            </div>
            
            <input type="hidden" name="class_id" value="<?=$class['class_id']?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        
        <div class="mt-5">
            <h4>Sections in this Class</h4>
            <?php if ($sections != 0) { ?>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>Male Students</th>
                            <th>Female Students</th>
                            <th>Total Students</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sections as $section) { 
                            $total = $section['male_students'] + $section['female_students'];
                        ?>
                        <tr>
                            <td><?=$section['section_name']?></td>
                            <td><?=$section['male_students']?></td>
                            <td><?=$section['female_students']?></td>
                            <td><?=$total?></td>
                            <td>
                                <a href="section-edit.php?section_id=<?=$section['section_id']?>" 
                                   class="btn btn-warning btn-sm">Edit</a>
                                <a href="section-delete.php?section_id=<?=$section['section_id']?>" 
                                   class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No sections found for this class.</p>
            <?php } ?>
            <a href="section-add.php?class_id=<?=$class['class_id']?>" class="btn btn-success">Add New Section</a>
        </div>
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
        header("Location: class.php");
        exit;
    } 
} else {
    header("Location: class.php");
    exit;
}
?>