<?php
function getAllEvents($conn, $limit = null) {
    $sql = "SELECT * FROM events ORDER BY event_date DESC";
    if ($limit) {
        $sql .= " LIMIT $limit";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getEventById($conn, $id) {
    $sql = "SELECT * FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createEvent($conn, $data) {
    $sql = "INSERT INTO events (title, description, event_date, start_time, end_time, location, is_online) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        $data['title'],
        $data['description'],
        $data['event_date'],
        $data['start_time'],
        $data['end_time'],
        $data['location'],
        $data['is_online']
    ]);
}

function updateEvent($conn, $id, $data) {
    $sql = "UPDATE events SET 
            title = ?, 
            description = ?, 
            event_date = ?, 
            start_time = ?, 
            end_time = ?, 
            location = ?, 
            is_online = ?,
            updated_at = CURRENT_TIMESTAMP
            WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        $data['title'],
        $data['description'],
        $data['event_date'],
        $data['start_time'],
        $data['end_time'],
        $data['location'],
        $data['is_online'],
        $id
    ]);
}

function deleteEvent($conn, $id) {
    $sql = "DELETE FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}
?>