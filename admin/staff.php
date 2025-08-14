<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/class.php";
        
        // Pull only teachers (defensive: even if helper isn't updated)
        $all = getAllTeachers($conn); // if you updated helper to filter, this is already "teachers only"
        $teachers = [];
        if ($all && is_array($all)) {
            foreach ($all as $t) {
                if (!isset($t['person_type']) || $t['person_type'] === 'staff') {
                    $teachers[] = $t;
                }
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Staff</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <style>
        .teacher-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .teacher-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            object-position: top;
        }
        .teacher-img-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #f5f5f5, #e0e0e0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 4rem;
        }
        .position-badge {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manage Staff</h2>
            <div>
                <a href="teacher-add.php" class="btn btn-dark me-2">
                    <i class="fas fa-plus"></i> Add Staff
                </a>
                <a href="req/teacher-export.php" class="btn btn-success me-2">
                    <i class="fas fa-file-export"></i> Export
                </a>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-file-import"></i> Import
                </button>
            </div>
        </div>

        <!-- Import Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="req/teacher-import.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Import Staff</h5>
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

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?=$_GET['error']?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?=$_GET['success']?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="row">
            <?php if ($teachers != 0) { 
                foreach ($teachers as $teacher) { 
                    $subjects = [];
                    if (!empty($teacher['subjects'])) {
                        $subjectIds = explode(',', $teacher['subjects']);
                        foreach ($subjectIds as $subjectId) {
                            $subject = getSubjectById($subjectId, $conn);
                            if ($subject) $subjects[] = $subject['subject_name'];
                        }
                    }
            ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card teacher-card h-100">
                    <div class="card-img-top position-relative">
                        <?php if (!empty($teacher['image_path'])): ?>
                            <img src="../admin/<?=htmlspecialchars($teacher['image_path'])?>" class="teacher-img" alt="<?=htmlspecialchars($teacher['fname'])?> <?=htmlspecialchars($teacher['lname'])?>">
                        <?php else: ?>
                            <div class="teacher-img-placeholder">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        <?php endif; ?>
                        <span class="position-badge bg-<?= 
                            strpos($teacher['designation'], 'Head') !== false ? 'primary' : 
                            (strpos($teacher['designation'], 'Senior') !== false ? 'info' : 'success') ?>">
                            <?=$teacher['designation']?>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-1"><?=$teacher['fname']?> <?=$teacher['lname']?></h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-id-card me-2"></i><?=$teacher['teacher_index']?>
                        </p>
                        <p class="text-muted mb-2">
                            <i class="fas fa-book me-2"></i>
                            <?=!empty($subjects) ? implode(', ', $subjects) : 'Not assigned'?>
                        </p>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-phone me-2 text-muted"></i>
                            <?=$teacher['phone_number']?>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <div class="d-flex justify-content-end">
                            <a href="teacher-edit.php?teacher_id=<?=$teacher['teacher_id']?>" 
                               class="btn btn-sm btn-warning me-2">
                               <i class="fas fa-edit"></i>
                            </a>
                            <a href="teacher-delete.php?teacher_id=<?=$teacher['teacher_id']?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this teacher?')">
                               <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } 
            } else { ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-4" role="alert">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>No staff found</h4>
                    <p class="mb-0">Click "Add Staff" to create a new staff record</p>
                </div>
            </div>
            <?php } ?>
        </div>
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