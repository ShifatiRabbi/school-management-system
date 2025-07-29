<?php
function getAllNotices($conn) {
    $sql = "SELECT * FROM notices ORDER BY notice_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getLatestNotices($conn, $limit = 3) {
    $limit = (int)$limit; // ensure it's an integer
    $sql = "SELECT * FROM notices ORDER BY created_at DESC LIMIT $limit";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function getNoticeById($conn, $id) {
    $sql = "SELECT * FROM notices WHERE notice_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createNotice($conn, $data) {
    $sql = "INSERT INTO notices (title, description, notice_date, image_path) 
            VALUES (:title, :description, :notice_date, :image_path)";
    $stmt = $conn->prepare($sql);
    
    return $stmt->execute($data);
}

function updateNotice($conn, $id, $data) {
    // Handle image removal if requested
    if (isset($_POST['remove_image']) && $_POST['remove_image'] == 'on') {
        // First get current image path to delete the file
        $current = getNoticeById($conn, $id);
        if ($current && !empty($current['image_path'])) {
            if (file_exists($current['image_path'])) {
                unlink($current['image_path']);
            }
        }
        $data['image_path'] = null;
    } elseif (empty($data['image_path'])) {
        // Keep existing image if not uploading new one and not removing
        $current = getNoticeById($conn, $id);
        $data['image_path'] = $current['image_path'];
    }
    
    $sql = "UPDATE notices SET 
            title = :title, 
            description = :description, 
            notice_date = :notice_date, 
            image_path = :image_path 
            WHERE notice_id = :id";
    
    $data['id'] = $id;
    $stmt = $conn->prepare($sql);
    
    return $stmt->execute($data);
}

function deleteNotice($conn, $id) {
    // First get the notice to delete the image file if exists
    $notice = getNoticeById($conn, $id);
    if ($notice && !empty($notice['image_path'])) {
        if (file_exists($notice['image_path'])) {
            unlink($notice['image_path']);
        }
    }
    
    $sql = "DELETE FROM notices WHERE notice_id = ?";
    $stmt = $conn->prepare($sql);
    
    return $stmt->execute([$id]);
}
?>