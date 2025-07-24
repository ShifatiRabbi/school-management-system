<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/subject.php";
        include "data/class.php";
        
        $subjects = getAllSubjects($conn);
        $classes = getAllClasses($conn);

        $fname = $_GET['fname'] ?? '';
        $lname = $_GET['lname'] ?? '';
        $uname = $_GET['uname'] ?? '';
        $address = $_GET['address'] ?? '';
        $employee_number = $_GET['en'] ?? '';
        $phone_number = $_GET['pn'] ?? '';
        $qualification = $_GET['qf'] ?? '';
        $email = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Teacher</title>
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

        <form method="post" class="shadow p-3 mt-5 form-w" action="req/teacher-add.php">
            <h3>Add New Teacher</h3><hr>
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
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">First name</label>
                        <input type="text" class="form-control" value="<?=$fname?>" name="fname" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Last name</label>
                        <input type="text" class="form-control" value="<?=$lname?>" name="lname" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?=$uname?>" name="username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="pass" id="passInput" required>
                            <button class="btn btn-secondary" id="gBtn">Random</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Teacher Index</label>
                        <input type="text" class="form-control" name="teacher_index" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Salary Code</label>
                        <input type="text" class="form-control" name="salary_code">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Salary</label>
                        <input type="number" step="0.01" class="form-control" name="salary">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Highest Qualification</label>
                <input type="text" class="form-control" name="highest_qualification" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Qualification Details</label>
                <textarea class="form-control" name="qualification_details" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" value="<?=$address?>" name="address" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Employee Number</label>
                        <input type="text" class="form-control" value="<?=$employee_number?>" name="employee_number" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" value="<?=$phone_number?>" name="phone_number" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Male" checked>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Female">
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" value="<?=$email?>" name="email_address" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Date Joined</label>
                        <input type="date" class="form-control" name="date_of_joined" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Years of Experience</label>
                        <input type="number" class="form-control" name="years_of_experience">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Marital Status</label>
                <select class="form-control" name="marital_status">
                    <option value="">Select</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Bank Name</label>
                        <input type="text" class="form-control" name="bank_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Bank Account</label>
                        <input type="text" class="form-control" name="bank_account">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Emergency Contact</label>
                        <input type="text" class="form-control" name="emergency_contact">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Emergency Phone</label>
                        <input type="text" class="form-control" name="emergency_phone">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Notes</label>
                <textarea class="form-control" name="notes" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Subjects</label>
                <div class="row row-cols-1 row-cols-md-3 g-2">
                    <?php foreach ($subjects as $subject): ?>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="subjects[]" value="<?=$subject['subject_id']?>">
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
                    <?php foreach ($classes as $class): ?>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="classes[]" value="<?=$class['class_id']?>">
                            <label class="form-check-label">
                                <?=$class['class_name']?>
                            </label>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Teacher</button>
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
        header("Location: ../login.php");
        exit;
    } 
} else {
    header("Location: ../login.php");
    exit;
}
?>