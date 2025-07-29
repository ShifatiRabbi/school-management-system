<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/notice.php";

if (isset($_GET['id'])) {
    $notice = getNoticeById($conn, $_GET['id']);
    if (!$notice) {
        header("Location: notices.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'notice_date' => $_POST['notice_date']
    ];
    
    // Handle file upload
    if (isset($_FILES['notice_image']) && $_FILES['notice_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/notices/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = basename($_FILES['notice_image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['notice_image']['tmp_name'], $targetPath)) {
            $data['image_path'] = $targetPath;
        }
    }
    
    if (isset($_GET['id'])) {
        // Update existing notice
        if (updateNotice($conn, $_GET['id'], $data)) {
            header("Location: notices.php?success=Notice updated successfully");
        } else {
            header("Location: notices.php?error=Failed to update notice");
        }
    } else {
        // Add new notice
        if (createNotice($conn, $data)) {
            header("Location: notices.php?success=Notice added successfully");
        } else {
            header("Location: notices.php?error=Failed to add notice");
        }
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= isset($notice) ? 'Edit' : 'Add' ?> Notice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include "inc/navbar.php" ?>
    
    <div class="container mt-5">
        <h2><?= isset($notice) ? 'Edit' : 'Add' ?> Notice</h2>
        
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" 
                       value="<?= isset($notice) ? htmlspecialchars($notice['title']) : '' ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="5" required><?= isset($notice) ? htmlspecialchars($notice['description']) : '' ?></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Notice Date</label>
                <input type="date" class="form-control" name="notice_date" 
                       value="<?= isset($notice) ? $notice['notice_date'] : date('Y-m-d') ?>" required>
            </div>
             
            <div class="mb-3">
                <label class="form-label">Notice Image (Optional)</label>
                <input type="file" class="form-control" name="notice_image" accept="image/*">
                <?php if (isset($notice) && !empty($notice['image_path'])): ?>
                <div class="mt-2">
                    <img src="<?= htmlspecialchars($notice['image_path']) ?>" class="img-thumbnail" style="max-height: 150px;">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                        <label class="form-check-label" for="remove_image">Remove current image</label>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="notices.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>