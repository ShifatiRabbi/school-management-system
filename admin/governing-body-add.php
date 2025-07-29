<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/governing_body.php";

// For edit.php
if (isset($_GET['id'])) {
    $member = getGoverningMemberById($conn, $_GET['id']);
    if (!$member) {
        header("Location: governing-body.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle file upload
    $uploadDir = '../uploads/governing_body/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $imagePath = isset($member['image_path']) ? $member['image_path'] : '';
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Delete old image if exists
        if (!empty($imagePath) && file_exists("../".$imagePath)) {
            unlink("../".$imagePath);
        }
        
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = str_replace('../', '', $targetPath);
        } else {
            header("Location: governing-body.php?error=Failed to upload image");
            exit;
        }
    }
    
    $data = [
        'name' => $_POST['name'],
        'position' => $_POST['position'],
        'contact' => $_POST['contact'],
        'role' => $_POST['role'],
        'image_path' => $imagePath
    ];
    
    if (isset($_GET['id'])) {
        // Update existing member
        if (updateGoverningMember($conn, $_GET['id'], $data)) {
            header("Location: governing-body.php?success=Member updated successfully");
        } else {
            header("Location: governing-body.php?error=Failed to update member");
        }
    } else {
        // Add new member
        if (empty($imagePath)) {
            header("Location: governing-body.php?error=Member image is required");
            exit;
        }
        
        if (createGoverningMember($conn, $data)) {
            header("Location: governing-body.php?success=Member added successfully");
        } else {
            header("Location: governing-body.php?error=Failed to add member");
        }
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= isset($member) ? 'Edit' : 'Add' ?> Governing Body Member</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .image-preview {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .img-upload-container {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php" ?>
    
    <div class="container mt-5">
        <h2><?= isset($member) ? 'Edit' : 'Add' ?> Governing Body Member</h2>
        
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-upload-container">
                        <label class="form-label">Member Image</label>
                        <div class="mb-3">
                            <?php if (isset($member) && !empty($member['image_path'])): ?>
                                <img src="../<?= htmlspecialchars($member['image_path']) ?>" class="image-preview" id="imagePreview">
                            <?php else: ?>
                                <img src="" class="image-preview d-none" id="imagePreview">
                                <div class="border rounded p-4 text-center bg-light">
                                    <i class="fas fa-user-circle fa-5x text-muted mb-3"></i>
                                    <p class="text-muted">No image selected</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="file" class="form-control" name="image" id="imageUpload" accept="image/*" <?= !isset($member) ? 'required' : '' ?>>
                        <small class="text-muted">Recommended size: 400x400px (square image)</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" 
                               value="<?= isset($member) ? htmlspecialchars($member['name']) : '' ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <select class="form-select" name="position" required>
                            <option value="Chairman" <?= isset($member) && $member['position'] == 'Chairman' ? 'selected' : '' ?>>Chairman</option>
                            <option value="Member" <?= isset($member) && $member['position'] == 'Member' ? 'selected' : '' ?>>Member</option>
                            <option value="Others Member" <?= isset($member) && $member['position'] == 'Others Member' ? 'selected' : '' ?>>Others Member</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="contact" 
                               value="<?= isset($member) ? htmlspecialchars($member['contact']) : '' ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" name="role" 
                               value="<?= isset($member) ? htmlspecialchars($member['role']) : '' ?>" required>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="governing-body.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview functionality
        document.getElementById('imageUpload').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    
                    // Hide placeholder if it exists
                    const placeholder = preview.nextElementSibling;
                    if (placeholder && placeholder.classList.contains('p-4')) {
                        placeholder.classList.add('d-none');
                    }
                }
                
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>