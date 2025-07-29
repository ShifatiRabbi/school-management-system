<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/class.php";
include "data/section.php";
include "data/routine.php";

$routines = getAllRoutines($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Class Routines</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .routine-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .routine-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .routine-img {
            height: 200px;
            object-fit: contain;
            background-color: #f8f9fa;
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manage Class Routines</h2>
            <a href="routine-add.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Routine
            </a>
        </div>
        
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?=htmlspecialchars($_GET['error'])?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?=htmlspecialchars($_GET['success'])?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        
        <div class="row">
            <?php if ($routines && count($routines) > 0): ?>
                <?php foreach ($routines as $routine): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card routine-card h-100">
                        <div class="card-img-top">
                            <img src="../<?=htmlspecialchars($routine['routine_image'])?>" class="routine-img w-100" alt="Routine for <?=htmlspecialchars($routine['class_name'])?> <?=htmlspecialchars($routine['section_name'])?>">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?=htmlspecialchars($routine['class_name'])?> - <?=htmlspecialchars($routine['section_name'])?></h5>
                            <p class="card-text text-muted">
                                <small>Uploaded on: <?=date('M d, Y', strtotime($routine['upload_date']))?></small>
                            </p>
                            <span class="badge <?=$routine['is_active'] ? 'bg-success' : 'bg-secondary'?> status-badge">
                                <?=$routine['is_active'] ? 'Active' : 'Inactive'?>
                            </span>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between">
                                <a href="../<?=htmlspecialchars($routine['routine_image'])?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <div>
                                    <a href="routine-edit.php?id=<?=$routine['routine_id']?>" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="routine-delete.php?id=<?=$routine['routine_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this routine?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center py-4" role="alert">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h4>No routines found</h4>
                        <p class="mb-0">Click "Add New Routine" to upload a class routine</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>