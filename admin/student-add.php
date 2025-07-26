<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../DB_connection.php";
       include "data/class.php";
       include "data/section.php";
       $classes = getAllClasses($conn);
       $sections = getAllSections($conn);

       $fname = '';
       $lname = '';
       $uname = '';
       $address = '';
       $email = '';
       $father_name = '';
       $mother_name = '';
       $parent_phone = '';

       if (isset($_GET['fname'])) $fname = $_GET['fname'];
       if (isset($_GET['lname'])) $lname = $_GET['lname'];
       if (isset($_GET['uname'])) $uname = $_GET['uname'];
       if (isset($_GET['address'])) $address = $_GET['address'];
       if (isset($_GET['email'])) $email = $_GET['email'];
       if (isset($_GET['father_name'])) $father_name = $_GET['father_name'];
       if (isset($_GET['mother_name'])) $mother_name = $_GET['mother_name'];
       if (isset($_GET['parent_phone'])) $parent_phone = $_GET['parent_phone'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
     ?>
     <div class="container mt-5">
        <a href="student.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/student-add.php">
        <h3>Add New Student</h3><hr>
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
          <label class="form-label">First name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$fname?>" 
                 name="fname">
        </div>
        <div class="mb-3">
          <label class="form-label">Last name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$lname?>"
                 name="lname">
        </div>
        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$address?>"
                 name="address">
        </div>
        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$email?>"
                 name="email_address">
        </div>
        <div class="mb-3">
          <label class="form-label">Date of birth</label>
          <input type="date" 
                 class="form-control"
                 name="date_of_birth">
        </div>
        <div class="mb-3">
          <label class="form-label">Gender</label><br>
          <input type="radio"
                 value="Male"
                 checked 
                 name="gender"> Male
                 &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio"
                 value="Female"
                 name="gender"> Female
        </div><br><hr>
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$uname?>"
                 name="username">
        </div>
        <div class="mb-3">
          <label class="form-label">Roll Number</label>
          <input type="number" 
                 class="form-control"
                 name="roll_number">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="input-group mb-3">
              <input type="text" 
                     class="form-control"
                     name="pass"
                     id="passInput">
              <button class="btn btn-secondary"
                      id="gBtn">
                      Random</button>
          </div>
          
        </div><br><hr>
        <div class="mb-3">
          <label class="form-label">Father's Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$father_name?>"
                 name="father_name">
        </div>
        <div class="mb-3">
          <label class="form-label">Mother's Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$mother_name?>"
                 name="mother_name">
        </div>
        <div class="mb-3">
          <label class="form-label">Parent phone number</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$parent_phone?>"
                 name="parent_phone_number">
        </div><br><hr>
        <div class="mb-3">
          <label class="form-label">Class</label>
          <select name="class_id" class="form-control">
              <?php foreach ($classes as $class) { ?>
              <option value="<?=$class['class_id']?>">
                <?=$class['class_name']?> <?=$class['discipline']?>
              </option>
              <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Section</label>
          <select name="section_id" class="form-control">
              <?php foreach ($sections as $section) { 
              $class = getClassById($section['class_id'], $conn);  ?>
              <option value="<?=$section['section_id']?>">
                <?=$class['class_name']?> <?=$class['discipline']?> -> <?=$section['section_name']?>
              </option>
              <?php } ?>
          </select>
        </div>

      <button type="submit" class="btn btn-primary">Register</button>
     </form>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>    
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(3) a").addClass('active');
        });

        function makePass(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * 
         charactersLength));

           }
           var passInput = document.getElementById('passInput');
           passInput.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e){
          e.preventDefault();
          makePass(4);
        });
    </script>

</body>
</html>
<?php 
  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
    header("Location: ../login.php");
    exit;
} 
?>