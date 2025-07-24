<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['teacher_id'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/class.php";

        $teacher_id = $_GET['teacher_id'];
        $teacher = getTeacherById($teacher_id, $conn);    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Teacher Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .teacher-card {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .teacher-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .teacher-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            margin-top: -60px;
        }
        .info-label {
            font-weight: 600;
            color: #555;
        }
        .info-value {
            color: #333;
        }
        .subject-badge {
            background-color: #e9f7fe;
            color: #2575fc;
            border-radius: 20px;
            padding: 5px 15px;
            margin-right: 8px;
            margin-bottom: 8px;
            display: inline-block;
        }
        .class-badge {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-radius: 20px;
            padding: 5px 15px;
            margin-right: 8px;
            margin-bottom: 8px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <a href="teacher.php" class="btn btn-dark mb-3">
            <i class="fas fa-arrow-left"></i> Back to Teachers
        </a>

        <div class="card teacher-card mb-4">
            <div class="teacher-header p-4 text-center">
                <h3><?=$teacher['fname']?> <?=$teacher['lname']?></h3>
                <p class="mb-0"><?=$teacher['designation']?></p>
            </div>
            <br>
            <div class="card-body text-center">
                <img src="../img/teacher-<?=$teacher['gender']?>.png" class="teacher-img mb-3" alt="Teacher Image">
                
                <div class="d-flex justify-content-center mb-4">
                    <a href="teacher-edit.php?teacher_id=<?=$teacher['teacher_id']?>" class="btn btn-warning me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="teacher-delete.php?teacher_id=<?=$teacher['teacher_id']?>" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-id-card"></i> Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Teacher ID:</div>
                            <div class="col-md-8 info-value"><?=$teacher['teacher_id']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Teacher Index:</div>
                            <div class="col-md-8 info-value"><?=$teacher['teacher_index']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Username:</div>
                            <div class="col-md-8 info-value"><?=$teacher['username']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Employee Number:</div>
                            <div class="col-md-8 info-value"><?=$teacher['employee_number']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Gender:</div>
                            <div class="col-md-8 info-value"><?=$teacher['gender']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Date of Birth:</div>
                            <div class="col-md-8 info-value"><?=$teacher['date_of_birth']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Date Joined:</div>
                            <div class="col-md-8 info-value"><?=$teacher['date_of_joined']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Years of Experience:</div>
                            <div class="col-md-8 info-value"><?=$teacher['years_of_experience'] ?? 'N/A'?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-address-book"></i> Contact Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Address:</div>
                            <div class="col-md-8 info-value"><?=$teacher['address']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Phone Number:</div>
                            <div class="col-md-8 info-value"><?=$teacher['phone_number']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Email:</div>
                            <div class="col-md-8 info-value"><?=$teacher['email_address']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Marital Status:</div>
                            <div class="col-md-8 info-value"><?=$teacher['marital_status'] ?? 'N/A'?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Emergency Contact:</div>
                            <div class="col-md-8 info-value"><?=$teacher['emergency_contact'] ?? 'N/A'?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Emergency Phone:</div>
                            <div class="col-md-8 info-value"><?=$teacher['emergency_phone'] ?? 'N/A'?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Professional Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Designation:</div>
                            <div class="col-md-8 info-value"><?=$teacher['designation']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Salary Code:</div>
                            <div class="col-md-8 info-value"><?=$teacher['salary_code'] ?? 'N/A'?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Salary:</div>
                            <div class="col-md-8 info-value"><?=$teacher['salary'] ? number_format($teacher['salary'], 2) : 'N/A'?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Highest Qualification:</div>
                            <div class="col-md-8 info-value"><?=$teacher['highest_qualification']?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Qualification Details:</div>
                            <div class="col-md-8 info-value"><?=$teacher['qualification_details'] ?? 'N/A'?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Bank Name:</div>
                            <div class="col-md-8 info-value"><?=$teacher['bank_name'] ?? 'N/A'?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 info-label">Bank Account:</div>
                            <div class="col-md-8 info-value"><?=$teacher['bank_account'] ?? 'N/A'?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-book"></i> Teaching Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6>Subjects:</h6>
                            <?php 
                            if (!empty($teacher['subjects'])) {
                                $subjectIds = explode(',', $teacher['subjects']);
                                foreach ($subjectIds as $subjectId) {
                                    $subject = getSubjectById($subjectId, $conn);
                                    if ($subject) {
                                        echo '<span class="subject-badge">' . $subject['subject_name'] . ' (' . $subject['subject_code'] . ')</span>';
                                    }
                                }
                            } else {
                                echo '<p>No subjects assigned</p>';
                            }
                            ?>
                        </div>
                        
                        <div class="mb-3">
                            <h6>Classes Assigned:</h6>
                            <?php 
                            if (!empty($teacher['classes_assigned'])) {
                                $classIds = explode(',', $teacher['classes_assigned']);
                                foreach ($classIds as $classId) {
                                    $class = getClassById($classId, $conn);
                                    if ($class) {
                                        echo '<span class="class-badge">' . $class['class_name'] . '</span>';
                                    }
                                }
                            } else {
                                echo '<p>No classes assigned</p>';
                            }
                            ?>
                        </div>
                        
                        <div class="mb-3">
                            <h6>Notes:</h6>
                            <p><?=$teacher['notes'] ?? 'No notes available'?></p>
                        </div>
                    </div>
                </div>
            </div>
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
        header("Location: teacher.php");
        exit;
    }
} else {
    header("Location: teacher.php");
    exit;
}
?>