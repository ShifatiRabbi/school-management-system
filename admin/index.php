<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Home</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
     ?>
   <section class="quick-links-section">
      <div class="container">
         <h2 class="text-center section-title">Quick Access</h2>
         <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">

            <div class="col">
               <a href="teacher" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-chalkboard-teacher"></i>
                  <span>All Teachers</span>
               </a>
            </div>
            
            <div class="col">
               <a href="staff" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-chalkboard-teacher"></i>
                  <span>All Staff</span>
               </a>
            </div>
            
            <div class="col">
               <a href="student" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-user-graduate"></i>
                  <span>All Students</span>
               </a>
            </div>

            <div class="col">
               <a href="governing-body" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-users-cog"></i>
                  <span>Governing Body</span>
               </a>
            </div>

            <div class="col">
               <a href="ragistrar-office" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-file-signature"></i>
                  <span>Registrar Office</span>
               </a>
            </div>

            <div class="col">
               <a href="events" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-calendar-alt"></i>
                  <span>Events</span>
               </a>
            </div>

            <div class="col">
               <a href="news" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-bullhorn"></i>
                  <span>News</span>
               </a>
            </div>

            <div class="col">
               <a href="notices" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-newspaper"></i>
                  <span>Notices</span>
               </a>
            </div>

            <div class="col">
               <a href="gallery-manage" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-images"></i>
                  <span>Gallery</span>
               </a>
            </div>

            <div class="col">
               <a href="course" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-book-open"></i>
                  <span>All Subjects</span>
               </a>
            </div>
            
            <div class="col">
               <a href="class" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-school"></i>
                  <span>Class</span>
               </a>
            </div>
            <div class="col">
               <a href="section" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-school"></i>
                  <span>Section</span>
               </a>
            </div>

            <div class="col">
               <a href="routine" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-bell"></i>
                  <span>Routine</span>
               </a>
            </div>

            <div class="col">
               <a href="manage-results" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-chart-line"></i>
                  <span>Public Results</span>
               </a>
            </div>

            <div class="col">
               <a href="message" class="btn quick-link-btn d-flex flex-column align-items-center justify-content-center">
                  <i class="fas fa-envelope"></i>
                  <span>Message</span>
               </a>
            </div>

            
               <a href="settings.php" class="col btn btn-primary m-2 py-3">
                 <i class="fa fa-cogs fs-1" aria-hidden="true"></i><br>
                  Settings
               </a> 
               <a href="../logout.php" class="col btn btn-danger m-2 py-3">
                 <i class="fa fa-sign-in fs-1" aria-hidden="true"></i><br>
                  Logout
               </a> 
         </div>
      </div>
   </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(1) a").addClass('active');
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