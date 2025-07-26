<?php 
    include "header.php";
    include "admin/data/teacher.php";
    include "admin/data/subject.php";
    include "admin/data/class.php";

    $teacher_id = $_GET['teacher_id'];
    $teacher = getTeacherById($teacher_id, $conn);    
?>

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
                        <div class="col-md-4 info-label">Teacher Index:</div>
                        <div class="col-md-8 info-value"><?=$teacher['teacher_index']?></div>
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
                        <div class="col-md-4 info-label">Highest Qualification:</div>
                        <div class="col-md-8 info-value"><?=$teacher['highest_qualification']?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 info-label">Qualification Details:</div>
                        <div class="col-md-8 info-value"><?=$teacher['qualification_details'] ?? 'N/A'?></div>
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

<?php include 'footer.php' ?>