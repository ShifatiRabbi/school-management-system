<?php 
session_start();
if (isset($_SESSION['teacher_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Teacher') {
        include "../DB_connection.php";
        include "data/class.php";
        include "data/section.php";
        include "data/teacher.php";
        
        $teacher_id = $_SESSION['teacher_id'];
        $teacher = getTeacherById($teacher_id, $conn);
        
        // Get all classes assigned to this teacher
        $assigned_classes = [];
        if (!empty($teacher['classes_assigned'])) {
            $class_ids = explode(',', $teacher['classes_assigned']);
            foreach ($class_ids as $class_id) {
                $class = getClassById($class_id, $conn);
                if ($class) {
                    $section = getSectioById($class['section'], $conn);
                    $grade = getGradeById($class['grade'], $conn);
                    if ($section && $grade) {
                        $assigned_classes[] = [
                            'class_id' => $class['class_id'],
                            'class_name' => $class['class_name'],
                            'grade_code' => $grade['grade_code'],
                            'grade' => $grade['grade'],
                            'section_name' => $section['section_name']
                        ];
                    }
                }
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher - My Classes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card-class {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card-class:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .class-header {
            background-color: #2c3e50;
            color: white;
            padding: 15px;
            font-weight: 600;
        }
        .class-body {
            padding: 20px;
        }
        .badge-discipline {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .science {
            background-color: #3498db;
        }
        .humanities {
            background-color: #e74c3c;
        }
        .business {
            background-color: #2ecc71;
        }
        .none {
            background-color: #95a5a6;
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <h3 class="mb-4">My Assigned Classes</h3>
        
        <?php if (!empty($assigned_classes)) { ?>
            <div class="row">
                <?php foreach ($assigned_classes as $class) { 
                    $discipline_class = strtolower($class['discipline']);
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card-class">
                        <div class="class-header">
                            <?= htmlspecialchars($class['grade_code']) ?>-<?= htmlspecialchars($class['grade']) ?><?= htmlspecialchars($class['section_name']) ?>
                        </div>
                        <div class="class-body">
                            <h5><?= htmlspecialchars($class['class_name']) ?></h5>
                            <span class="badge badge-discipline <?= $discipline_class ?>">
                                <?= htmlspecialchars($class['discipline']) ?>
                            </span>
                            <div class="mt-3">
                                <a href="class-students.php?class_id=<?= $class['class_id'] ?>" 
                                   class="btn btn-sm btn-primary">
                                   View Students <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> No classes have been assigned to you yet.
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