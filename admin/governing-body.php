<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/governing_body.php";

$members = getAllGoverningMembers($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Governing Body</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .member-card {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .position-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .member-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            object-position: top;
        }
        .img-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #f5f5f5, #e0e0e0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php" ?>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manage Governing Body</h2>
            <a href="governing-body-add.php" class="btn btn-primary">Add New Member</a>
        </div>
        
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php } ?>
        
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php } ?>
        
        <div class="row">
            <?php foreach ($members as $member): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card member-card h-100">
                    <?php if (!empty($member['image_path'])): ?>
                        <img src="../<?= htmlspecialchars($member['image_path']) ?>" class="member-img" alt="<?= htmlspecialchars($member['name']) ?>">
                    <?php else: ?>
                        <div class="img-placeholder">
                            <i class="fas fa-user-circle fa-4x"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title mb-0"><?= htmlspecialchars($member['name']) ?></h5>
                            <span class="badge bg-primary position-badge"><?= htmlspecialchars($member['position']) ?></span>
                        </div>
                        <p class="card-text text-muted mb-1">
                            <i class="fas fa-user-tag me-2"></i><?= htmlspecialchars($member['role']) ?>
                        </p>
                        <p class="card-text">
                            <i class="fas fa-phone me-2"></i><?= htmlspecialchars($member['contact']) ?>
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <div class="d-flex justify-content-end">
                            <a href="governing-body-add.php?id=<?= $member['member_id'] ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                            <a href="governing-body-delete.php?id=<?= $member['member_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>