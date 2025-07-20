<?php
function getAllNews($conn, $limit = null, $category = null) {
    $sql = "SELECT * FROM news";
    if ($category) {
        $sql .= " WHERE news_category = ?";
    }
    $sql .= " ORDER BY publish_date DESC";
    if ($limit) {
        $sql .= " LIMIT $limit";
    }
    
    $stmt = $conn->prepare($sql);
    if ($category) {
        $stmt->execute([$category]);
    } else {
        $stmt->execute();
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFeaturedNews($conn, $limit = 3) {
    $sql = "SELECT * FROM news WHERE is_featured = 1 ORDER BY publish_date DESC LIMIT $limit";
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
    $sql = "INSERT INTO news (title, content, short_description, image_path, publish_date, is_featured, news_category, author) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        $data['title'],
        $data['content'],
        $data['short_description'],
        $data['image_path'],
        $data['publish_date'],
        $data['is_featured'],
        $data['news_category'],
        $data['author']
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
            news_category = ?,
            author = ?,
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
        $data['news_category'],
        $data['author'],
        $id
    ]);
}

function deleteNews($conn, $id) {
    $sql = "DELETE FROM news WHERE news_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}
?>