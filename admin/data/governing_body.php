<?php
function getAllGoverningMembers($conn) {
    $sql = "SELECT * FROM governing_body ORDER BY 
            CASE position 
                WHEN 'Chairman' THEN 1
                WHEN 'Member' THEN 2
                ELSE 3
            END, name ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getGoverningMemberById($conn, $id) {
    $sql = "SELECT * FROM governing_body WHERE member_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createGoverningMember($conn, $data) {
    $sql = "INSERT INTO governing_body (name, position, contact, role, image_path) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$data['name'], $data['position'], $data['contact'], $data['role'], $data['image_path']]);
}

function updateGoverningMember($conn, $id, $data) {
    $sql = "UPDATE governing_body SET name=?, position=?, contact=?, role=?, image_path=? WHERE member_id=?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$data['name'], $data['position'], $data['contact'], $data['role'], $data['image_path'], $id]);
}

function deleteGoverningMember($conn, $id) {
    // First get the image path to delete the file
    $member = getGoverningMemberById($conn, $id);
    if ($member && !empty($member['image_path']) && file_exists("../".$member['image_path'])) {
        unlink("../".$member['image_path']);
    }
    
    $sql = "DELETE FROM governing_body WHERE member_id=?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}
?>