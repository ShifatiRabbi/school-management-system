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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" />
    <!-- LightGallery CSS -->
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" href="logo.png">
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #ff6600;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        #about p {
            text-align: justify;
            margin-top: 0;
            margin-bottom: 2rem;
        }
        
        .navbar {
            background-color: var(--primary-color) !important;
            padding: 0;
        }
        
        .navbar-brand img {
            height: 80px;
        }
        
        .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 8px 15px !important;
        }
        
        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        /* Dropdown on hover */
        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            transition: all 0.3s ease;
        }

        /* Smooth dropdown appearance */
        .dropdown-menu {
            display: none;
            border-radius: 0;
            background-color: var(--primary-color);
        }

        .dropdown-item {
            color: white;
            padding: 10px 20px;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-color);
            color: white;
        }


        .hero-section {
            background: linear-gradient(rgba(0, 51, 102, 0.4), rgba(0, 51, 102, 0.4)), url('img/campus.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background-color: var(--secondary-color);
            bottom: -10px;
            left: 0;
        }
        
        .feature-box {
            text-align: center;
            padding: 30px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }
        
        .about-section {
            padding: 80px 0;
            background-color: var(--light-color);
        }
        
        .event-card {
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .event-date {
            background-color: var(--primary-color);
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 0 0 5px;
        }
        
        .event-day {
            font-size: 2rem;
            font-weight: 700;
            display: block;
        }
        
        .event-month {
            font-size: 1rem;
            display: block;
        }
        
        .news-section {
            padding: 80px 0;
        }
        
        .news-card {
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .news-img {
            height: 200px;
            object-fit: cover;
        }
        
        .contact-section {
            padding: 80px 0;
            background-color: var(--light-color);
        }
        
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 50px 0 20px;
        }
        
        .footer-links h5 {
            color: var(--secondary-color);
            margin-bottom: 20px;
        }
        
        .footer-links ul {
            list-style: none;
            padding-left: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: color 0.3s;
        }
        
        .social-icons a:hover {
            color: var(--secondary-color);
        }
        
        .copyright {
            border-top: 1px solid #495057;
            padding-top: 20px;
            margin-top: 30px;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
        }

        /* Basic Info and People Info Page Styles */
.basic-info-section, .people-info-section {
    background-color: #f8f9fa;
    min-height: calc(100vh - 150px);
}

.card-header h4 {
    margin: 0;
    font-weight: 600;
}

.table th {
    background-color: #f1f1f1;
    font-weight: 600;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}

.table-responsive {
    overflow-x: auto;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .basic-info-section .col-md-6,
    .people-info-section .col-md-6 {
        margin-bottom: 20px;
    }
    
    .people-info-section .table-responsive {
        margin-bottom: 15px;
    }
}



/* Public Results Page Styles */
.public-results-section {
    background-color: #f8f9fa;
    min-height: calc(100vh - 150px);
}

.stats-box {
    border: 1px solid #dee2e6;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
}

.table th {
    background-color: #f1f1f1;
    font-weight: 600;
    text-align: center;
}

.table td {
    text-align: center;
    vertical-align: middle;
}

.table tfoot {
    background-color: #f8f9fa;
}

.table-responsive {
    overflow-x: auto;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .stats-box .row {
        margin-bottom: 10px;
    }
    
    .stat-value {
        font-size: 1.2rem;
    }
    
    .stat-label {
        font-size: 0.8rem;
    }
}



.gallery-img {
    height: 270px;
    object-fit: cover;
    width: 100%;
    border-radius: 6px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}

.gallery-img:hover {
    transform: scale(1.02);
}

@media (max-width: 768px) {
    .gallery-img {
        height: 200px;
    }
}

.shadow-1-strong {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    border-radius: 6px;
}

#bootstrap-image-gallery img {
    transition: transform 0.3s ease;
    cursor: pointer;
}

#bootstrap-image-gallery img:hover {
    transform: scale(1.02);
}
.shadow-1-strong {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 6px;
    transition: transform 0.3s ease;
}

.shadow-1-strong:hover {
    transform: scale(1.02);
}
.video-thumb {
    width: 100%;
    height: 270px;
    object-fit: cover;
    cursor: pointer;
    border-radius: 6px;
    transition: transform 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}
.video-thumb:hover {
    transform: scale(1.03);
}

@media (max-width: 768px) {
    .video-thumb {
        height: 200px;
    }
}



    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
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
                        <a class="nav-link" href="#about">About</a>
                    </li>

                    <!-- Institute Info Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="instituteDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Institute Info
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="instituteDropdown">
                            <li><a class="dropdown-item" href="/school-management-system/basic_info.php">Basic Info</a></li>
                            <li><a class="dropdown-item" href="/school-management-system/people_info.php">Teacher, Student & Staff Info</a></li>
                        </ul>
                    </li>

                    <!-- Public Result Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="resultDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Public Result
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="resultDropdown">
                            <li><a class="dropdown-item" href="/school-management-system/public_results_ssc.php">SSC Details</a></li>
                            <li><a class="dropdown-item" href="/school-management-system/public_results_jsc.php">JSC Details</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/school-management-system/gallery.php">Gallery</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
