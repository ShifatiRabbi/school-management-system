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
                $result = uploadGalleryFile($file, 'image', $conn, $caption);
                if ($result['status'] === 'success') {
                    $uploaded_files[] = $result;
                } else {
                    $error_messages[] = "Image {$file['name']}: " . $result['message'];
                }
            }
        }
        
        // Handle video uploads
        if (!empty($_FILES['videos']['name'][0])) {
            $video_files = reArrayFiles($_FILES['videos']);
            $video_thumbnails = !empty($_FILES['video_thumbnails']['name'][0]) ? reArrayFiles($_FILES['video_thumbnails']) : [];
            
            foreach ($video_files as $index => $file) {
                $caption = $captions[$index] ?? '';
                $thumbnail = $video_thumbnails[$index] ?? null;
                
                $result = uploadGalleryFile($file, 'video', $conn, $caption, $thumbnail);
                if ($result['status'] === 'success') {
                    $uploaded_files[] = $result;
                } else {
                    $error_messages[] = "Video {$file['name']}: " . $result['message'];
                }
            }
        }
        
        if (!empty($uploaded_files)) {
            $success_msg = count($uploaded_files) . " files uploaded successfully!";
        }
        if (!empty($error_messages)) {
            $error_msg = implode("<br>", $error_messages);
        }
        
        if (empty($uploaded_files) && empty($error_messages)) {
            $error_msg = "No files were selected for upload.";
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

// Get gallery items
$images = getAllGalleryItems('image', $conn);
$videos = getAllGalleryItems('video', $conn);

// Reformat $_FILES
function reArrayFiles($file_post) {
    $file_ary = [];
    if (isset($file_post['name']) && is_array($file_post['name'])) {
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
    }
    return $file_ary;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .thumbnail-preview {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php include "inc/navbar.php"; ?>

<div class="container mt-4">
    <h2>Manage Gallery</h2>

    <?php if (isset($success_msg)): ?>
        <div class="alert alert-success"><?= $success_msg ?></div>
    <?php endif; ?>
    <?php if (isset($error_msg)): ?>
        <div class="alert alert-danger"><?= $error_msg ?></div>
    <?php endif; ?>

    <!-- Upload Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Upload Files</h4>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="upload-form">
                <div class="mb-3">
                    <label class="form-label">Images (JPG, PNG, JPEG, WEBP, SVG)</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*" id="image-files">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Videos (MP4, WEBM, MOV)</label>
                    <input type="file" name="videos[]" class="form-control" multiple accept="video/*" id="video-files">
                </div>
                
                <div class="mb-3" id="video-thumbnails-container" style="display: none;">
                    <label class="form-label">Video Thumbnails (One per video)</label>
                    <input type="file" name="video_thumbnails[]" class="form-control" multiple accept="image/*" id="video-thumbnails">
                    <small class="text-muted">Upload thumbnails in the same order as videos</small>
                </div>
                
                <div id="caption-container" class="mb-3">
                    <!-- Captions will be generated dynamically -->
                </div>

                <button type="submit" name="upload_files" class="btn btn-primary">Upload Files</button>
            </form>
        </div>
    </div>

    <!-- Gallery Display -->
    <div class="row">
        <!-- Images -->
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

        <!-- Videos -->
        <div class="col-md-3">
            <h3>Videos</h3>
            <div class="row">
                <?php foreach ($videos as $video): ?>
                    <div class="col-md-12 gallery-item">
                        <img src="../<?= $video['thumbnail_path'] ?>" alt="<?= $video['caption'] ?>">
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
    // Show/hide video thumbnail field based on video selection
    document.getElementById('video-files').addEventListener('change', function() {
        const thumbContainer = document.getElementById('video-thumbnails-container');
        thumbContainer.style.display = this.files.length > 0 ? 'block' : 'none';
        generateCaptions();
    });

    // Generate caption fields for all files
    function generateCaptions() {
        const container = document.getElementById('caption-container');
        container.innerHTML = '';
        
        const imageFiles = document.getElementById('image-files').files;
        const videoFiles = document.getElementById('video-files').files;
        const totalFiles = (imageFiles ? imageFiles.length : 0) + (videoFiles ? videoFiles.length : 0);
        
        for (let i = 0; i < totalFiles; i++) {
            const div = document.createElement('div');
            div.className = 'mb-2';
            
            let fileName = '';
            if (i < (imageFiles ? imageFiles.length : 0)) {
                fileName = imageFiles[i].name;
            } else {
                const videoIndex = i - (imageFiles ? imageFiles.length : 0);
                fileName = videoFiles[videoIndex].name;
            }
            
            div.innerHTML = `
                <label class="form-label">Caption for ${fileName}</label>
                <input type="text" name="caption[]" class="form-control" placeholder="Enter caption (optional)">
            `;
            container.appendChild(div);
        }
    }

    // Initialize caption fields
    document.getElementById('image-files').addEventListener('change', generateCaptions);
</script>
</body>
</html>