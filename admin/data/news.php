<?php
function getAllNews($conn, $limit = null) {
    $sql = "SELECT * FROM news ORDER BY publish_date DESC";
    if ($limit) {
        $sql .= " LIMIT $limit";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getNewsById($conn, $id) {
    $sql = "SELECT * FROM news WHERE news_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createNews($conn, $data) {
    $sql = "INSERT INTO news (title, content, short_description, image_path, publish_date, is_featured) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        $data['title'],
        $data['content'],
        $data['short_description'],
        $data['image_path'],
        $data['publish_date'],
        $data['is_featured']
    ]);
}

function updateNews($conn, $id, $data) {
    $sql = "UPDATE news SET 
            title = ?, 
            content = ?, 
            short_description = ?, 
            image_path = ?, 
            publish_date = ?, 
            is_featured = ?,
            updated_at = CURRENT_TIMESTAMP
            WHERE news_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        $data['title'],
        $data['content'],
        $data['short_description'],
        $data['image_path'],
        $data['publish_date'],
        $data['is_featured'],
        $id
    ]);
}

function deleteNews($conn, $id) {
    $sql = "DELETE FROM news WHERE news_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}
?>