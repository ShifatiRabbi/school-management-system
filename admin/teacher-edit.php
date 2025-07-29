<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['teacher_id'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/subject.php";
        include "data/class.php";
        include "data/teacher.php";
        
        $teacher_id = $_GET['teacher_id'];
        $teacher = getTeacherById($teacher_id, $conn);
        $subjects = getAllSubjects($conn);
        $classes = getAllClasses($conn);

        if ($teacher == 0) {
            header("Location: teacher.php");
            exit;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    <div class="container mt-5">
        <a href="teacher.php" class="btn btn-dark">Go Back</a>

        <form method="post" class="shadow p-3 mt-5 form-w" action="req/teacher-edit.php">
            <h3>Edit Teacher</h3><hr>
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
            
            <input type="hidden" name="teacher_id" value="<?=$teacher['teacher_id']?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">First name</label>
                        <input type="text" class="form-control" value="<?=$teacher['fname']?>" name="fname" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Last name</label>
                        <input type="text" class="form-control" value="<?=$teacher['lname']?>" name="lname" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?=$teacher['username']?>" name="username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Teacher Index</label>
                        <input type="text" class="form-control" value="<?=$teacher['teacher_index']?>" name="teacher_index" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" value="<?=$teacher['designation']?>" name="designation" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Salary Code</label>
                        <input type="text" class="form-control" value="<?=$teacher['salary_code']?>" name="salary_code">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Salary</label>
                        <input type="number" step="0.01" class="form-control" value="<?=$teacher['salary']?>" name="salary">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Highest Qualification</label>
                        <input type="text" class="form-control" value="<?=$teacher['highest_qualification']?>" name="highest_qualification" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Qualification Details</label>
                <textarea class="form-control" name="qualification_details" rows="2"><?=$teacher['qualification_details']?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" value="<?=$teacher['address']?>" name="address" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Employee Number</label>
                        <input type="text" class="form-control" value="<?=$teacher['employee_number']?>" name="employee_number" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" value="<?=$teacher['date_of_birth']?>" name="date_of_birth" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" value="<?=$teacher['phone_number']?>" name="phone_number" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Male" <?=$teacher['gender'] == 'Male' ? 'checked' : ''?>>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Female" <?=$teacher['gender'] == 'Female' ? 'checked' : ''?>>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" value="<?=$teacher['email_address']?>" name="email_address" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Date Joined</label>
                        <input type="date" class="form-control" value="<?=$teacher['date_of_joined']?>" name="date_of_joined" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Years of Experience</label>
                        <input type="number" class="form-control" value="<?=$teacher['years_of_experience']?>" name="years_of_experience">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Marital Status</label>
                <select class="form-control" name="marital_status">
                    <option value="">Select</option>
                    <option value="Single" <?=$teacher['marital_status'] == 'Single' ? 'selected' : ''?>>Single</option>
                    <option value="Married" <?=$teacher['marital_status'] == 'Married' ? 'selected' : ''?>>Married</option>
                    <option value="Divorced" <?=$teacher['marital_status'] == 'Divorced' ? 'selected' : ''?>>Divorced</option>
                    <option value="Widowed" <?=$teacher['marital_status'] == 'Widowed' ? 'selected' : ''?>>Widowed</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Bank Name</label>
                        <input type="text" class="form-control" value="<?=$teacher['bank_name']?>" name="bank_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Bank Account</label>
                        <input type="text" class="form-control" value="<?=$teacher['bank_account']?>" name="bank_account">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Emergency Contact</label>
                        <input type="text" class="form-control" value="<?=$teacher['emergency_contact']?>" name="emergency_contact">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Emergency Phone</label>
                        <input type="text" class="form-control" value="<?=$teacher['emergency_phone']?>" name="emergency_phone">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Notes</label>
                <textarea class="form-control" name="notes" rows="2"><?=$teacher['notes']?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Subjects</label>
                <div class="row row-cols-1 row-cols-md-3 g-2">
                    <?php 
                    $teacherSubjects = !empty($teacher['subjects']) ? explode(',', $teacher['subjects']) : [];
                    foreach ($subjects as $subject): 
                        $checked = in_array($subject['subject_id'], $teacherSubjects);
                    ?>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="subjects[]" 
                                   value="<?=$subject['subject_id']?>" <?=$checked ? 'checked' : ''?>>
                            <label class="form-check-label">
                                <?=$subject['subject_name']?> (<?=$subject['subject_code']?>)
                            </label>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Classes Assigned</label>
                <div class="row row-cols-1 row-cols-md-3 g-2">
                    <?php 
                    $teacherClasses = !empty($teacher['classes_assigned']) ? explode(',', $teacher['classes_assigned']) : [];
                    foreach ($classes as $class): 
                        $checked = in_array($class['class_id'], $teacherClasses);
                    ?>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="classes[]" 
                                   value="<?=$class['class_id']?>" <?=$checked ? 'checked' : ''?>>
                            <label class="form-check-label">
                                <?=$class['class_name']?>
                            </label>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Teacher Image</label>
                <div class="mb-3">
                    <div class="border rounded p-4 text-center bg-light mb-3">
                        <i class="fas fa-user-circle fa-5x text-muted mb-3"></i>
                        <p class="text-muted">No image selected</p>
                    </div>
                    <input type="file" class="form-control" name="image" accept="image/*">
                    <small class="text-muted">Recommended size: 400x400px (square image)</small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <form method="post" class="shadow p-3 my-5 form-w" action="req/teacher-change.php" id="change_password">
            <h3>Change Password</h3><hr>
            <?php if (isset($_GET['perror'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_GET['perror']?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['psuccess'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?=$_GET['psuccess']?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">Admin password</label>
                <input type="password" class="form-control" name="admin_pass" required>
            </div>

            <div class="mb-3">
                <label class="form-label">New password</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="new_pass" id="passInput">
                    <button class="btn btn-secondary" id="gBtn">Random</button>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Confirm new password</label>
                <input type="text" class="form-control" name="c_new_pass" id="passInput2">
            </div>
            
            <input type="hidden" name="teacher_id" value="<?=$teacher['teacher_id']?>">
            <button type="submit" class="btn btn-primary">Change</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(2) a").addClass('active');
        });

        function makePass(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            document.getElementById('passInput').value = result;
            document.getElementById('passInput2').value = result;
        }

        document.getElementById('gBtn').addEventListener('click', function(e){
            e.preventDefault();
            makePass(8);
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