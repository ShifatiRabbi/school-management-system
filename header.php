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
                <img src="logo.png" alt="<?=$setting['school_name']?>">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/school-management-system">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about">About</a>
                    </li>

                    <!-- Institute Info Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="instituteDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Institute Info
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="instituteDropdown">
                            <li><a class="dropdown-item" href="/school-management-system/basic-info">Basic Info</a></li>
                            <li><a class="dropdown-item" href="/school-management-system/people_info">Teacher, Student & Staff Info</a></li>
                        </ul>
                    </li>

                    <!-- Public Result Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="resultDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Public Result
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="resultDropdown">
                            <li><a class="dropdown-item" href="/school-management-system/public_results_ssc">SSC Details</a></li>
                            <li><a class="dropdown-item" href="/school-management-system/public_results_jsc">JSC Details</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/school-management-system/gallery">Gallery</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/school-management-system/contact">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login">Login</a>
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