<?php

function uploadGalleryFile($file, $type, $conn, $caption = '', $thumbnail = null) {
    // Validate file upload
    if (!isset($file['error']) || is_array($file['error'])) {
        return ['status' => 'error', 'message' => 'Invalid file parameters'];
    }

    // Check for upload errors
    switch ($file['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            return ['status' => 'error', 'message' => 'No file was uploaded'];
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return ['status' => 'error', 'message' => 'File is too large (exceeds server limits)'];
        default:
            return ['status' => 'error', 'message' => 'File upload error'];
    }

    $upload_dir = '../uploads/gallery/';
    $allowed_image_types = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
    $allowed_video_types = ['mp4', 'webm', 'mov'];
    
    // Create upload directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            return ['status' => 'error', 'message' => 'Failed to create upload directory'];
        }
    }
    
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    
    // Get file extension
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    // Validate file type
    if ($type == 'image' && !in_array($file_ext, $allowed_image_types)) {
        return ['status' => 'error', 'message' => 'Invalid image file type (allowed: ' . implode(', ', $allowed_image_types) . ')'];
    }
    
    if ($type == 'video' && !in_array($file_ext, $allowed_video_types)) {
        return ['status' => 'error', 'message' => 'Invalid video file type (allowed: ' . implode(', ', $allowed_video_types) . ')'];
    }
    
    // Validate file size (15MB for images, 500MB for videos)
    $max_image_size = 15 * 1024 * 1024; // 15MB
    $max_video_size = 500 * 1024 * 1024; // 500MB
    $max_size = ($type == 'image') ? $max_image_size : $max_video_size;
    
    if ($file_size > $max_size) {
        $max_size_mb = ($type == 'image') ? 15 : 500;
        return ['status' => 'error', 'message' => "File is too large (max {$max_size_mb}MB)"];
    }
    
    // Generate unique filename
    $new_filename = uniqid('', true) . '.' . $file_ext;
    $destination = $upload_dir . $new_filename;
    
    // Move uploaded file
    if (!move_uploaded_file($file_tmp, $destination)) {
        return ['status' => 'error', 'message' => 'Failed to move uploaded file'];
    }

    // Handle video thumbnail
    $thumbnail_path = null;
    if ($type == 'video') {
        if ($thumbnail && isset($thumbnail['error']) && $thumbnail['error'] === UPLOAD_ERR_OK) {
            $thumb_ext = strtolower(pathinfo($thumbnail['name'], PATHINFO_EXTENSION));
            if (in_array($thumb_ext, $allowed_image_types)) {
                $thumb_filename = uniqid('', true) . '_thumb.' . $thumb_ext;
                $thumb_destination = $upload_dir . $thumb_filename;
                if (move_uploaded_file($thumbnail['tmp_name'], $thumb_destination)) {
                    $thumbnail_path = 'uploads/gallery/' . $thumb_filename;
                }
            }
        }
        
        // Use default thumbnail if none provided or if upload failed
        if (!$thumbnail_path) {
            $thumbnail_path = 'img/video-thumb-placeholder.jpg';
        }
    }
    
    // Save to database
    $relative_path = 'uploads/gallery/' . $new_filename;
    $sql = "INSERT INTO gallery_images 
            (file_name, file_path, thumbnail_path, caption, file_type) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt->execute([$file_name, $relative_path, $thumbnail_path, $caption, $type])) {
        // Clean up uploaded file if DB insert failed
        unlink($destination);
        if ($thumbnail_path && strpos($thumbnail_path, 'video-thumb-placeholder.jpg') === false) {
            unlink('../' . $thumbnail_path);
        }
        return ['status' => 'error', 'message' => 'Database error: ' . $stmt->errorInfo()[2]];
    }
    
    return [
        'status' => 'success',
        'file_name' => $file_name,
        'file_path' => $relative_path,
        'thumbnail_path' => $thumbnail_path,
        'caption' => $caption,
        'type' => $type
    ];
}

function getAllGalleryItems($type, $conn) {
    $sql = "SELECT * FROM gallery_images WHERE file_type = ? ORDER BY upload_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$type]);
    return $stmt->fetchAll();
}

function deleteGalleryFile($id, $type, $conn) {
    // First get file path
    $sql = "SELECT file_path, thumbnail_path FROM gallery_images WHERE id = ? AND file_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $type]);
    $file = $stmt->fetch();
    
    if ($file) {
        // Delete main file from server
        if (file_exists('../' . $file['file_path'])) {
            unlink('../' . $file['file_path']);
        }
        
        // Delete thumbnail if it exists and isn't the default placeholder
        if ($file['thumbnail_path'] && $file['thumbnail_path'] !== 'img/video-thumb-placeholder.jpg') {
            if (file_exists('../' . $file['thumbnail_path'])) {
                unlink('../' . $file['thumbnail_path']);
            }
        }
        
        // Delete record from database
        $sql = "DELETE FROM gallery_images WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    return false;
}