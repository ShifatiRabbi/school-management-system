<?php 
include "DB_connection.php";
include "data/setting.php";
$setting = getSetting($conn);

if ($setting == 0) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$setting['school_name']?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" />
    <!-- LightGallery CSS -->
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="logo.png">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/school-management-system">
                <img src="logo.png" alt="<?=$setting['school_name']?>" class="navbar-logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/school-management-system">
                            <i class="fas fa-home d-lg-none me-2"></i>Home
                        </a>
                    </li>

                    <!-- Institute Info Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="instituteDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-school d-lg-none me-2"></i>About Institution
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="instituteDropdown">
                            <li>    
                                <a class="dropdown-item" href="about">
                                    <i class="fas fa-info-circle me-2"></i>About Us
                                </a>
                            </li>
                            <li>    
                                <a class="dropdown-item" href="basic-info">
                                    <i class="fas fa-info me-2"></i>School Details
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="people_info">
                                    <i class="fas fa-users me-2"></i> Staff Details
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="teacher-info">
                                    <i class="fas fa-chalkboard-teacher me-2"></i> All Teachers
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="governing-body">
                                    <i class="fas fa-users-cog me-2"></i> Governing Body
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- Academic Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="instituteDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-school d-lg-none me-2"></i>Academic
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="instituteDropdown">
                            <li>    
                                <a class="dropdown-item" href="student-info">
                                    <i class="fas fa-user-graduate me-2"></i>All Students
                                </a>
                            </li>
                            <li>    
                                <a class="dropdown-item" href="class-info">
                                    <i class="fas fa-school me-2"></i>All Class Details
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="all-subject">
                                    <i class="fas fa-book-open me-2"></i> All Subjects
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="routine">
                                    <i class="fas fa-bell me-2"></i> All Class Routine
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Notice & News Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="instituteDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-school d-lg-none me-2"></i>Notice & News
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="instituteDropdown">
                            <li>    
                                <a class="dropdown-item" href="events">
                                    <i class="fas fa-calendar-alt me-2"></i>All Events
                                </a>
                            </li>
                            <li>    
                                <a class="dropdown-item" href="notices">
                                    <i class="fas fa-newspaper me-2"></i>All Notice
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="news">
                                    <i class="fas fa-bullhorn me-2"></i> All News
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Public Result Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="resultDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-award d-lg-none me-2"></i>Public Result
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="resultDropdown">
                            <li><a class="dropdown-item" href="public_results_ssc">
                                <i class="fas fa-graduation-cap me-2"></i>SSC Details
                            </a></li>
                            <li><a class="dropdown-item" href="public_results_jsc">
                                <i class="fas fa-user-graduate me-2"></i>JSC Details
                            </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="gallery">
                            <i class="fas fa-images d-lg-none me-2"></i>Gallery
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact">
                            <i class="fas fa-envelope d-lg-none me-2"></i>Contact
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login">
                            <i class="fas fa-sign-in-alt d-lg-none me-2"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>