<?php

function uploadGalleryFile($file, $type, $caption, $conn) {
    $upload_dir = '../uploads/gallery/';
    $allowed_image_types = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
    $allowed_video_types = ['mp4', 'webm'];
    
    // Create upload directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    
    // Get file extension
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    // Validate file type
    if ($type == 'image' && !in_array($file_ext, $allowed_image_types)) {
        return ['status' => 'error', 'message' => 'Invalid image file type'];
    }
    
    if ($type == 'video' && !in_array($file_ext, $allowed_video_types)) {
        return ['status' => 'error', 'message' => 'Invalid video file type'];
    }
    
    // Check for errors
    if ($file_error !== 0) {
        return ['status' => 'error', 'message' => 'File upload error'];
    }
    
    // Validate file size (5MB for images, 50MB for videos)
    $max_size = ($type == 'image') ? 5 * 1024 * 1024 : 50 * 1024 * 1024;
    if ($file_size > $max_size) {
        return ['status' => 'error', 'message' => 'File is too large'];
    }
    
    // Generate unique filename
    $new_filename = uniqid('', true) . '.' . $file_ext;
    $destination = $upload_dir . $new_filename;
    
    // Move uploaded file
    if (move_uploaded_file($file_tmp, $destination)) {
        // Save to database
        $relative_path = 'uploads/gallery/' . $new_filename;
        $sql = "INSERT INTO gallery_images (file_name, file_path, caption, file_type) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$file_name, $relative_path, $caption, $type]);
        
        return [
            'status' => 'success',
            'file_name' => $file_name,
            'file_path' => $relative_path,
            'caption' => $caption,
            'type' => $type
        ];
    } else {
        return ['status' => 'error', 'message' => 'Failed to move uploaded file'];
    }
}

function getAllGalleryItems($type, $conn) {
    $sql = "SELECT * FROM gallery_images WHERE file_type = ? ORDER BY upload_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$type]);
    return $stmt->fetchAll();
}

function deleteGalleryFile($id, $type, $conn) {
    // First get file path
    $sql = "SELECT file_path FROM gallery_images WHERE id = ? AND file_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $type]);
    $file = $stmt->fetch();
    
    if ($file) {
        // Delete file from server
        if (file_exists('../' . $file['file_path'])) {
            unlink('../' . $file['file_path']);
        }
        
        // Delete record from database
        $sql = "DELETE FROM gallery_images WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    return false;
}