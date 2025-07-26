<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/gallery.php";

// Handle file uploads
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['upload_files'])) {
        $uploaded_files = [];
        $captions = $_POST['caption'] ?? [];
        
        // Handle image uploads
        if (!empty($_FILES['images']['name'][0])) {
            $image_files = reArrayFiles($_FILES['images']);
            foreach ($image_files as $index => $file) {
                $caption = $captions[$index] ?? '';
                $result = uploadGalleryFile($file, 'image', $caption, $conn);
                if ($result['status'] == 'success') {
                    $uploaded_files[] = $result;
                }
            }
        }
        
        // Handle video uploads
        if (!empty($_FILES['videos']['name'][0])) {
            $video_files = reArrayFiles($_FILES['videos']);
            foreach ($video_files as $index => $file) {
                $caption = $captions[$index] ?? '';
                $result = uploadGalleryFile($file, 'video', $caption, $conn);
                if ($result['status'] == 'success') {
                    $uploaded_files[] = $result;
                }
            }
        }
        
        if (!empty($uploaded_files)) {
            $success_msg = count($uploaded_files) . " files uploaded successfully!";
        } else {
            $error_msg = "No files were uploaded or there was an error.";
        }
    }
    
    // Handle delete
    if (isset($_POST['delete_file'])) {
        $file_id = $_POST['file_id'];
        $file_type = $_POST['file_type'];
        if (deleteGalleryFile($file_id, $file_type, $conn)) {
            $success_msg = "File deleted successfully!";
        } else {
            $error_msg = "Failed to delete file.";
        }
    }
}

// Get all gallery items
$images = getAllGalleryItems('image', $conn);
$videos = getAllGalleryItems('video', $conn);

// Function to reorganize $_FILES array
function reArrayFiles($file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .gallery-item {
            position: relative;
            margin-bottom: 20px;
        }
        .gallery-item img, .gallery-item video {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }
        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px;
            font-size: 14px;
        }
        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255,0,0,0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <?php 
        include "inc/navbar.php";
     ?>
    <div class="container mt-4">
        <h2>Manage Gallery</h2>
        
        <?php if (isset($success_msg)): ?>
            <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger"><?= $error_msg ?></div>
        <?php endif; ?>
        
        <div class="card mb-4">
            <div class="card-header">
                <h4>Upload Files</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Images (JPG, PNG, JPEG, WEBP, SVG)</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Videos (MP4, WEBM)</label>
                        <input type="file" name="videos[]" class="form-control" multiple accept="video/*">
                    </div>
                    
                    <div id="caption-container" class="mb-3">
                        <!-- Caption inputs will be added here dynamically -->
                    </div>
                    
                    <button type="submit" name="upload_files" class="btn btn-primary">Upload Files</button>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-9">
                <h3>Images</h3>
                <div class="row">
                    <?php foreach ($images as $image): ?>
                        <div class="col-md-4 gallery-item">
                            <img src="../<?= $image['file_path'] ?>" alt="<?= $image['caption'] ?>">
                            <?php if ($image['caption']): ?>
                                <div class="gallery-caption"><?= $image['caption'] ?></div>
                            <?php endif; ?>
                            <form method="post" class="delete-form">
                                <input type="hidden" name="file_id" value="<?= $image['id'] ?>">
                                <input type="hidden" name="file_type" value="image">
                                <button type="submit" name="delete_file" class="delete-btn" 
                                        onclick="return confirm('Are you sure you want to delete this image?')">×</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="col-md-3">
                <h3>Videos</h3>
                <div class="row">
                    <?php foreach ($videos as $video): ?>
                        <div class="col-md-6 gallery-item">
                            <video controls>
                                <source src="../<?= $video['file_path'] ?>" type="video/mp4">
                            </video>
                            <?php if ($video['caption']): ?>
                                <div class="gallery-caption"><?= $video['caption'] ?></div>
                            <?php endif; ?>
                            <form method="post" class="delete-form">
                                <input type="hidden" name="file_id" value="<?= $video['id'] ?>">
                                <input type="hidden" name="file_type" value="video">
                                <button type="submit" name="delete_file" class="delete-btn" 
                                        onclick="return confirm('Are you sure you want to delete this video?')">×</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dynamic caption inputs (optional)
        document.querySelector('input[name="images[]"]').addEventListener('change', function(e) {
            updateCaptionInputs(this.files, 'image');
        });
        
        document.querySelector('input[name="videos[]"]').addEventListener('change', function(e) {
            updateCaptionInputs(this.files, 'video');
        });
        
        function updateCaptionInputs(files, type) {
            const container = document.getElementById('caption-container');
            container.innerHTML = '';
            
            for (let i = 0; i < files.length; i++) {
                const div = document.createElement('div');
                div.className = 'mb-2';
                div.innerHTML = `
                    <label class="form-label">Caption for ${files[i].name}</label>
                    <input type="text" name="caption[]" class="form-control" placeholder="Enter caption (optional)">
                `;
                container.appendChild(div);
            }
        }
    </script>
</body>
</html>